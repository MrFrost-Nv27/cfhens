const table = {
  repair: $("#table-repair").DataTable({
    responsive: true,
    ajax: {
      url: origin + "/api/repair",
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
      { title: "Nama Service", data: "name", defaultContent: "-" },
      { title: "Harga", data: "price" },
      { title: "Tanggal Pesan", data: "date" },
      { title: "Tanggal Bayar", data: "paydate", defaultContent: "-" },
      { title: "Nominal Bayar", data: "pay", defaultContent: "-" },
      {
        title: "Aksi",
        data: "id",
        render: (data, type, row) => {
          if (row.pay != null) {
            return `<div class="table-control">
            <a role="button" class="btn waves-effect waves-light btn-action btn-popup blue" data-target="detail" data-action="detail" data-id="${data}"><i class="material-icons">info</i></a>
            </div>`;
          }
          return `<div class="table-control">
          <a role="button" class="btn waves-effect waves-light btn-action btn-popup blue" data-target="detail" data-action="detail" data-id="${data}"><i class="material-icons">info</i></a>
          <a role="button" class="btn waves-effect waves-light btn-action btn-popup orange darken-2" data-target="edit" data-action="edit" data-id="${data}"><i class="material-icons">edit</i></a>
          <a role="button" class="btn waves-effect waves-light btn-action btn-popup green" data-target="pay" data-action="pay" data-id="${data}"><i class="material-icons">payment</i></a>
          <a role="button" class="btn waves-effect waves-light btn-action red" data-action="delete" data-id="${data}"><i class="material-icons">delete</i></a>
          </div>`;
        },
      },
    ],
  }),
};

const datePicker = M.Datepicker.init(document.querySelectorAll(".repair-datepicker"), {
  format: "yyyy-mm-dd",
  defaultDate: new Date(),
  setDefaultDate: true,
  autoClose: true,
});

$("body").on("reset", "form#form-repair", function (e) {
  $.each($("input[type=hidden]"), function (i, e) {
    $(e).val("");
  });
});
$("body").on("reset", "form#form-edit", function (e) {
  $.each($("input[type=hidden]"), function (i, e) {
    $(e).val("");
  });
});

$("form#form-repair").on("submit", function (e) {
  e.preventDefault();
  const form = $(this)[0];
  const elements = form.elements;
  for (let i = 0, len = elements.length; i < len; ++i) {
    elements[i].readOnly = true;
  }
  const data = new FormData(this);
  $.ajax({
    type: "POST",
    url: origin + "/api/repair",
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: (data) => {
      $(this)[0].reset();
      cloud.pull("repair");
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
$("form#form-edit").on("submit", function (e) {
  e.preventDefault();
  const form = $(this)[0];
  const elements = form.elements;
  for (let i = 0, len = elements.length; i < len; ++i) {
    elements[i].readOnly = true;
  }
  const data = new FormData(this);
  $.ajax({
    type: "POST",
    url: origin + "/api/repair/" + data.get("id"),
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: (data) => {
      $(this)[0].reset();
      cloud.pull("repair");
      if (data.messages) {
        $.each(data.messages, function (icon, text) {
          Toast.fire({
            icon: icon,
            title: text,
          });
        });
      }
      $(this).closest(".popup").find(".btn-popup-close").trigger("click");
    },
    complete: () => {
      for (let i = 0, len = elements.length; i < len; ++i) {
        elements[i].readOnly = false;
      }
    },
  });
});

$("form#form-payment").on("submit", function (e) {
  e.preventDefault();
  const data = new FormData(this);
  const detail = cloud.get("repair").find((x) => x.id == data.get("id"));
  if (!(detail.price > 0)) {
    Toast.fire({
      icon: "error",
      title: "Harga Service harus diisi terlebih dahulu",
    });
    return;
  }
  if (data.get("pay") < detail.price) {
    Toast.fire({
      icon: "error",
      title: "Nominal tidak cukup untuk melakukan pembayaran",
    });
    return;
  }
  const form = $(this)[0];
  const elements = form.elements;
  for (let i = 0, len = elements.length; i < len; ++i) {
    elements[i].readOnly = true;
  }
  $.ajax({
    type: "POST",
    url: origin + "/api/repair/" + data.get("id"),
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: (data) => {
      $(this)[0].reset();
      cloud.pull("repair");
      if (data.messages) {
        $.each(data.messages, function (icon, text) {
          Toast.fire({
            icon: icon,
            title: text,
          });
        });
      }
      $(this).closest(".popup").find(".btn-popup-close").trigger("click");
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
    case "customer":
      $("#customer-query").val("");
      renderCustomerPicker();
      break;
    case "pay":
      const payData = cloud.get("repair").find((x) => x.id == id);
      console.log(payData);
      const payForm = $("form#form-payment");
      payForm.find(`input[name="id"]`).val(payData.id);
      payForm.find(`input[name="price"]`).val(payData.price);
      M.updateTextFields();
      break;
    case "edit":
      const editData = cloud.get("repair").find((x) => x.id == id);
      const editForm = $("form#form-edit");
      $.each(editData, function (n, v) {
        editForm.find(`[name="${n}"]`).val(v);
      });
      M.updateTextFields();
      M.textareaAutoResize($("textarea"));
      break;
    case "detail":
      const detailData = cloud.get("repair").find((x) => x.id == id);
      const detailForm = $("form#detail-repair");
      detailForm.find(`input[name="customer.name"]`).val(detailData.customer?.name ?? "-");
      detailForm.find(`[name="customer.address"]`).val(detailData.customer?.address ?? "-");
      $.each(detailData, function (n, v) {
        detailForm.find(`[name="detail-${n}"]`).val(v ?? "-");
      });
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
            url: origin + "/api/repair/" + id,
            cache: false,
            success: (data) => {
              table.repair.ajax.reload();
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
  $("form#form-repair")[0].reset();
});
$("body").on("click", ".popup[data-page=edit] .btn-popup-close", function () {
  $("form#form-edit")[0].reset();
});
$("body").on("click", ".popup[data-page=pay] .btn-popup-close", function () {
  $("form#form-payment")[0].reset();
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

$("body").on("keyup", "form#form-payment input[name=pay]", function (e) {
  const total = $("form#form-payment input[name=price]").val();
  const pay = $(this).val();
  $("form#form-payment input[name=return]").val(pay - total);
  M.updateTextFields();
});

$(document).ready(function () {
  cloud
    .add(origin + "/api/repair", {
      name: "repair",
      callback: (data) => {
        table.repair.ajax.reload();
      },
    })
    .then((repair) => {});
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
  $(".preloader").slideUp();
  Fancybox.bind("[data-fancybox]", {
    // Your custom options
  });
});
