const table = {
  customer: $("#table-customer").DataTable({
    responsive: true,
    ajax: {
      url: origin + "/api/customer",
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
      { title: "Nama", data: "name" },
      { title: "Username", data: "user.username" },
      {
        title: "Alamat",
        data: "address",
        render: (data, type, row) => {
          return data ? data : "-";
        },
      },
      {
        title: "Aksi",
        data: "id",
        render: (data, type, row) => {
          return `<div class="table-control">
          <a role="button" class="btn waves-effect waves-light btn-popup btn-action blue" data-action="edit" data-target="edit" data-id="${data}"><i class="material-icons">edit</i></a>
          <a role="button" class="btn waves-effect waves-light btn-popup btn-action orange darken-2" data-action="password"  data-target="password" data-id="${data}"><i class="material-icons">key</i></a>
          <a role="button" class="btn waves-effect waves-light btn-action red" data-action="delete" data-id="${data}"><i class="material-icons">delete</i></a>
          </div>`;
        },
      },
    ],
  }),
};

$("form#form-customer").on("submit", function (e) {
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
    url: origin + "/api/customer",
    data: data,
    cache: false,
    success: (data) => {
      $(this)[0].reset();
      cloud.pull("customer");
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
    url: origin + "/api/customer/" + data.id,
    data: data,
    cache: false,
    success: (data) => {
      $(this)[0].reset();
      cloud.pull("customer");
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
$("form#form-password").on("submit", function (e) {
  e.preventDefault();
  const data = {};
  $(this)
    .serializeArray()
    .map(function (x) {
      data[x.name] = x.value;
    });

  if (data.password !== data.password_confirm) {
    Toast.fire({
      icon: "error",
      title: "Konfirmasi Password tidak sesuai",
    });
    return false;
  }

  const form = $(this)[0];
  const elements = form.elements;
  for (let i = 0, len = elements.length; i < len; ++i) {
    elements[i].readOnly = true;
  }

  $.ajax({
    type: "POST",
    url: origin + "/api/customer/" + data.id,
    data: data,
    cache: false,
    success: (data) => {
      $(this)[0].reset();
      cloud.pull("customer");
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
            url: origin + "/api/customer/" + id,
            cache: false,
            success: (data) => {
              table.customer.ajax.reload();
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
      let dataEdit = cloud.get("customer").find((x) => x.id == id);
      $("form#form-edit").find("input[name=id]").val(dataEdit.id);
      $("form#form-edit").find("input[name=name]").val(dataEdit.name);
      $("form#form-edit").find("[name=address]").val(dataEdit.address);
      M.updateTextFields();
      M.textareaAutoResize($("textarea"));
      break;
    case "password":
      let dataPassword = cloud.get("customer").find((x) => x.id == id);
      $("form#form-password").find("input[name=id]").val(dataPassword.id);
      M.updateTextFields();
      break;
    default:
      break;
  }
});

$(document).ready(function () {
  cloud
    .add(origin + "/api/customer", {
      name: "customer",
      callback: (data) => {
        table.customer.ajax.reload();
      },
    })
    .then((customer) => {});
  $(".preloader").slideUp();
});
