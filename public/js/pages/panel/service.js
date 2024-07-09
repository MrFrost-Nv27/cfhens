const table = {
  service: $("#table-service").DataTable({
    responsive: true,
    ajax: {
      url: origin + "/api/service",
      dataSrc: "",
    },
    columns: [
      {
        title: "#",
        data: "name",
        render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        },
      },
      { title: "Nama Layanan", data: "name" },
      {
        title: "Aksi",
        data: "id",
        render: (data, type, row) => {
          return `<div class="table-control">
          <a role="button" class="btn waves-effect waves-light btn-slider btn-action blue" data-action="edit" data-target="form" data-id="${data}"><i class="material-icons">edit</i></a>
          <a role="button" class="btn waves-effect waves-light btn-action red" data-action="delete" data-id="${data}"><i class="material-icons">delete</i></a>
          </div>`;
        },
      },
    ],
  }),
};

$("form#form-service").on("submit", function (e) {
  e.preventDefault();
  const form = $(this)[0];
  const elements = form.elements;
  for (let i = 0, len = elements.length; i < len; ++i) {
    elements[i].readOnly = true;
  }
  const data = new FormData(this);
  $.ajax({
    type: "POST",
    url: origin + "/api/service" + (data.get("id") ? "/" + data.get("id") : ""),
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: (data) => {
      $(this)[0].reset();
      $(this).find("input[name=id]").val("");
      cloud.pull("service");
      if (data.messages) {
        $.each(data.messages, function (icon, text) {
          Toast.fire({
            icon: icon,
            title: text,
          });
        });
      }
      $(this).closest(".page.slider").removeClass("active");
      $(".upload-image img").addClass("hide");
    },
    complete: () => {
      for (let i = 0, len = elements.length; i < len; ++i) {
        elements[i].readOnly = false;
      }
    },
  });
});

$("body").on("click", ".btn-upload", function (e) {
  e.preventDefault();
  let input = document.createElement("input");
  input.type = "file";
  input.onchange = (_) => {
    // you can use this method to get file and perform respective operations
    let files = Array.from(input.files);
    $("input[name=image]")[0].files = input.files;
    $(".fancy-image").attr("data-src", URL.createObjectURL(input.files[0]));
    $(".upload-image img").removeClass("hide").attr("src", URL.createObjectURL(input.files[0]));
  };
  input.click();
});

$("body").on("click", ".btn-action", function (e) {
  e.preventDefault();
  const action = $(this).data("action");
  const id = $(this).data("id");
  switch (action) {
    case "add":
      $(".page.slider[data-page=form]").find("h1").text("Tambah Data Layanan");
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
            url: origin + "/api/service/" + id,
            cache: false,
            success: (data) => {
              table.service.ajax.reload();
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
    case "edit":
      $(".page.slider[data-page=form]").find("h1").text("Edit Data Layanan");
      let dataEdit = cloud.get("service").find((x) => x.id == id);
      $.each(dataEdit, function (n, v) {
        if (n !== "image") {
          $("form#form-service").find("[name=" + n + "]").val(v);
          return
        }
        if (v) {
          $(".fancy-image").attr("data-src", v + "?random=" + Math.random());
          $(".upload-image img").removeClass("hide").attr("src", v + "?random=" + Math.random());
        }
      });
      M.updateTextFields();
      M.textareaAutoResize($("textarea"));
      break;
    default:
      break;
  }
});

$("body").on("click", ".btn-slider-close", function () {
  $(".upload-image img").addClass("hide");
  $("form#form-service")[0].reset();
  $("form#form-service").find("input[name=id]").val("");
});

$(document).ready(function () {
  cloud
    .add(origin + "/api/service", {
      name: "service",
      callback: (data) => {
        table.service.ajax.reload();
      },
    })
    .then((service) => {});
  $(".preloader").slideUp();
  Fancybox.bind("[data-fancybox]", {
    // Your custom options
  });
});
