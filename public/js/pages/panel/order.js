const table = {
  order: $("#table-order").DataTable({
    responsive: true,
    ajax: {
      url: origin + "/api/order/pending",
      dataSrc: "",
    },
    columns: [
      {
        title: "#",
        data: "id",
        render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        },
      },
      { title: "Nama Pelanggan", data: "customer.name", defaultContent: "-" },
      { title: "Layanan", data: "service.name" },
      { title: "Harga", data: "total" },
      { title: "Tanggal", data: "date" },
      {
        title: "Aksi",
        data: "id",
        render: (data, type, row) => {
          return `<div class="table-control">
          <a role="button" class="btn waves-effect waves-light btn-action btn-popup blue" data-target="detail" data-action="detail" data-id="${data}"><i class="material-icons">info</i></a>
          <a role="button" class="btn waves-effect waves-light btn-action red" data-action="delete" data-id="${data}"><i class="material-icons">delete</i></a>
          </div>`;
        },
      },
    ],
  }),
};

const datePicker = M.Datepicker.init(document.querySelectorAll(".order-datepicker"), {
  format: "yyyy-mm-dd",
  defaultDate: new Date(),
  setDefaultDate: true,
  autoClose: true,
});

$("body").on("reset", "form#form-order", function (e) {
  $.each($("input[type=hidden]"), function (i, e) { 
    $(e).val("");
  });
});

$("form#form-order").on("submit", function (e) {
  e.preventDefault();
  const form = $(this)[0];
  const elements = form.elements;
  for (let i = 0, len = elements.length; i < len; ++i) {
    elements[i].readOnly = true;
  }
  const data = new FormData(this);
  $.ajax({
    type: "POST",
    url: origin + "/api/order" + (data.get("id") ? "/" + data.get("id") : ""),
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: (data) => {
      $(this)[0].reset();
      cloud.pull("order");
      if (data.messages) {
        $.each(data.messages, function (icon, text) {
          Toast.fire({
            icon: icon,
            title: text,
          });
        });
      }
      $(this).closest(".page.slider").removeClass("active");
    },
    complete: () => {
      for (let i = 0, len = elements.length; i < len; ++i) {
        elements[i].readOnly = false;
      }
    },
  });
});

$("body").on("click", ".btn-action", function (e) {
  e.preventDefault();
  const action = $(this).data("action");
  const id = $(this).data("id");
  switch (action) {
    case "add":
      $(".page.slider[data-page=form]").find("h1").text("Tambah Data Layanan");
      break;
    case "customer":
      $("#customer-query").val("");
      renderCustomerPicker();
      break;
    case "service":
      $("#customer-query").val("");
      renderServicePicker();
      break;
    case "detail":
      const detailData = cloud.get("order").find((x) => x.id == id);
      console.log(detailData);
      const detailForm = $("form#detail-order");
      detailForm.find(`input[name="customer.name"]`).val(detailData.customer?.name ?? "-");
      detailForm.find(`[name="customer.address"]`).val(detailData.customer?.address ?? "-");
      detailForm.find(`input[name="service.name"]`).val(detailData.service.name);
      detailForm.find(`input[name="detail-total"]`).val(detailData.total);
      detailForm.find(`input[name="detail-date"]`).val(detailData.date);
      detailForm.find(`[name="detail-note"]`).val(detailData.note ?? "-");
      M.updateTextFields();
      M.textareaAutoResize($("textarea"));
      break;
    case "delete":
      Swal.fire({
        title: "Apakah anda yakin ingin menghapus data ini ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "DELETE",
            url: origin + "/api/order/" + id,
            cache: false,
            success: (data) => {
              table.order.ajax.reload();
              if (data.messages) {
                $.each(data.messages, function (icon, text) {
                  Toast.fire({
                    icon: icon,
                    title: text,
                  });
                });
              }
            },
          });
        }
      });
      break;
    default:
      break;
  }
  M.updateTextFields();
});

$("body").on("click", ".btn-slider-close", function () {
  $("form#form-order")[0].reset();
});

function renderCustomerPicker(q = "") {
  const customers = q == "" ? cloud.get("customer") : cloud.get("customer").filter((x) => x.name.toLowerCase().includes(q.toLowerCase()));
  const picker = $("#picker-customer");
  picker.find(".collection").empty();
  if (customers.length == 0) {
    picker.find(".collection").append(`<p>Tidak ada data pelanggan yang tersedia</p>`);
    return;
  }
  customers.forEach((customer) => {
    picker.find(".collection").append(`<a href="#" class="collection-item" data-id="${customer.id}">${customer.name}</a>`);
  });
}

function renderServicePicker(q = "") {
  const services = q == "" ? cloud.get("service") : cloud.get("service").filter((x) => x.name.toLowerCase().includes(q.toLowerCase()));
  const picker = $("#picker-service");
  picker.find(".collection").empty();
  if (services.length == 0) {
    picker.find(".collection").append(`<p>Tidak ada data layanan yang tersedia</p>`);
    return;
  }
  services.forEach((service) => {
    picker.find(".collection").append(`<a href="#" class="collection-item" data-id="${service.id}">${service.name}</a>`);
  });
}

$("body").on("keyup", "#customer-query", function (e) {
  renderCustomerPicker($(this).val());
});
$("body").on("click", "#picker-customer .collection a", function (e) {
  e.preventDefault();
  const customer = cloud.get("customer").find((x) => x.id == $(this).data("id"));
  $("input[name=customer_display]").val(customer.name);
  $("input[name=customer_id]").val(customer.id);
  $(this).closest(".popup").find(".btn-popup-close").trigger("click");
  M.updateTextFields();
});
$("body").on("click", "#picker-service .collection a", function (e) {
  e.preventDefault();
  const service = cloud.get("service").find((x) => x.id == $(this).data("id"));
  $("input[name=service_display]").val(service.name);
  $("input[name=service_id]").val(service.id);
  $("input[name=total_display]").val(service.price);
  $("input[name=total]").val(service.price);
  $(this).closest(".popup").find(".btn-popup-close").trigger("click");
  M.updateTextFields();
});

$("body").on("keyup", "#service-query", function (e) {
  renderServicePicker($(this).val());
});

$(document).ready(function () {
  cloud
    .add(origin + "/api/order", {
      name: "order",
      callback: (data) => {
        table.order.ajax.reload();
      },
    })
    .then((order) => {});
  cloud
    .add(origin + "/api/customer", {
      name: "customer",
      callback: (data) => {
        renderCustomerPicker();
      },
    })
    .then((customer) => {
      $(".btn-popup[data-target=customer]").removeClass("disabled");
    });
  cloud
    .add(origin + "/api/service", {
      name: "service",
      callback: (data) => {
        renderServicePicker();
      },
    })
    .then((service) => {
      $(".btn-popup[data-target=service]").removeClass("disabled");
    });
  $(".preloader").slideUp();
  Fancybox.bind("[data-fancybox]", {
    // Your custom options
  });
});
