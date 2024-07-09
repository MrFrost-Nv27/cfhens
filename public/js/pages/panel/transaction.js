const table = {
  transaction: $("#table-transaction").DataTable({
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
          <a role="button" class="btn waves-effect waves-light btn-action btn-popup green" data-target="pay" data-action="pay" data-id="${data}"><i class="material-icons">payment</i></a>
          </div>`;
        },
      },
    ],
  }),
};

$("body").on("reset", "form#form-payment", function (e) {
  $.each($("input[type=hidden]"), function (i, e) { 
    $(e).val("");
  });
});

$("form#form-payment").on("submit", function (e) {
  e.preventDefault();
  const data = new FormData(this);
  if (data.get("pay") < $("input[name=total]").val()) {
    console.log(data.get("pay"), $("input[name=total]").val());
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
    url: origin + "/api/transaction",
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
    case "pay":
      const detailData = cloud.get("order").find((x) => x.id == id);
      console.log(detailData);
      const detailForm = $("form#form-payment");
      detailForm.find(`input[name="order_id"]`).val(detailData.id);
      detailForm.find(`input[name="total"]`).val(detailData.total);
      M.updateTextFields();
      break;
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

$("body").on("click", ".popup[data-page=pay] .btn-popup-close", function (e) {
  $("form#form-payment")[0].reset();
});

$("body").on("keyup", "input[name=pay]", function (e) {
  const total = $("input[name=total]").val();
  const pay = $(this).val();
  $("input[name=return]").val(pay - total);
  M.updateTextFields();
});

$(document).ready(function () {
  cloud
    .add(origin + "/api/order", {
      name: "order",
      callback: (data) => {
        table.transaction.ajax.reload();
      },
    })
    .then((order) => {});
  cloud
    .add(origin + "/api/customer", {
      name: "customer",
      callback: (data) => {
      },
    })
    .then((customer) => {
    });
  cloud
    .add(origin + "/api/service", {
      name: "service",
      callback: (data) => {
      },
    })
    .then((service) => {
    });
  $(".preloader").slideUp();
});
