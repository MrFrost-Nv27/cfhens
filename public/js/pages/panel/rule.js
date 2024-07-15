const table = {
  rule: $("#table-rule").DataTable({
    responsive: true,
    ajax: {
      url: origin + "/api/rule",
      dataSrc: "",
    },
    columns: [
      {
        title: "#",
        render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        },
      },
      {
        title: "Kode",
        render(data, type, row) {
          return row[0].code;
        },
      },
      {
        title: "Gejala",
        render(data, type, row) {
          if (row[0].symptom) {
            return `<ol class="collection"><li class="collection-item">` + row.map((x) => x.symptom?.name).join(`</li><li class="collection-item">`) + "</li></ol>";
          }
          return "-";
        },
      },
      {
        title: "Akibat",
        render(data, type, row) {
          return row[0].effect?.name ?? "-";
        },
      },
      {
        title: "Tipe",
        render(data, type, row) {
          return row[0].effect_type == "symptom" ? "Gejala" : "Penyakit";
        },
      },
      // { title: "Nama Penyakit", data: "name" },
      {
        title: "Aksi",
        render: (data, type, row) => {
          console.log(row);
          return `<div class="table-control">
          <a role="button" class="btn waves-effect waves-light btn-action red" data-action="delete" data-id="${row[0].code}"><i class="material-icons">delete</i></a>
          </div>`;
        },
      },
    ],
  }),
};

$("form#form-rule").on("submit", function (e) {
  e.preventDefault();
  const data = {};
  $(this)
    .serializeArray()
    .map(function (x) {
      data[x.name] = x.value;
    });

  const form = $(this)[0];
  const elements = form.elements;
  for (let i = 0, len = elements.length; i < len; ++i) {
    elements[i].readOnly = true;
  }

  $.ajax({
    type: "POST",
    url: origin + "/api/rule",
    data: data,
    cache: false,
    success: (data) => {
      $(this)[0].reset();
      cloud.pull("rule");
      if (data.messages) {
        $.each(data.messages, function (icon, text) {
          Toast.fire({
            icon: icon,
            title: text,
          });
        });
      }
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
            url: origin + "/api/rule/" + id,
            cache: false,
            success: (data) => {
              table.rule.ajax.reload();
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
});

$(document).ready(function () {
  cloud
    .add(origin + "/api/rule", {
      name: "rule",
      data: {
        group: "yes",
      },
      callback: (data) => {
        table.rule.ajax.reload();
      },
    })
    .then((rule) => {});
  $(".preloader").slideUp();
});
