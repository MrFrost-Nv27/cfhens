const table = {
  order: $("#table-report").DataTable({
    responsive: true,
    ajax: {
      url: origin + "/api/order/payed",
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
      { title: "Bayar", data: "pay.pay" },
      { title: "Tanggal", data: "date" },
    ],
  }),
};

const datePicker = M.Datepicker.init(document.querySelectorAll(".report-datepicker"), {
  format: "yyyy-mm-dd",
  autoClose: true,
});

$("body").on("click", ".btn-action", function (e) {
  e.preventDefault();
  const action = $(this).data("action");
  switch (action) {
    case "filter":
      const startDate = moment($("[name=report-start]").val()).format("YYYY-MM-DD");
      const endDate = moment($("[name=report-end]").val()).format("YYYY-MM-DD");
      table.order.ajax.url(origin + "/api/order/payed?start=" + startDate + "&end=" + endDate).load();
      break;
    default:
      break;
  }
  M.updateTextFields();
});

$(document).ready(function () {
  $(".preloader").slideUp();
});
