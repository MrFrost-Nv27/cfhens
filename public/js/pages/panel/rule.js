let inputTimeout;
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
            return (
              `<ol class="collection"><li class="collection-item">` +
              row
                .map((x) => x.symptom?.name)
                .join(`</li><li class="collection-item">`) +
              "</li></ol>"
            );
          }
          return "-";
        },
      },
      {
        title: "Penyakit",
        render(data, type, row) {
          return row[0].disease.name ?? "-";
        },
      },
      {
        title: "Aksi",
        render: (data, type, row) => {
          return `<div class="table-control">
          <a role="button" class="btn waves-effect waves-light btn-popup btn-action blue" data-target="edit" data-action="edit" data-id="${row[0].code}"><i class="material-icons">edit</i></a>
          <a role="button" class="btn waves-effect waves-light btn-action red" data-action="delete" data-id="${row[0].code}"><i class="material-icons">delete</i></a>
          </div>`;
        },
      },
    ],
  }),
};

$("form#form-add").on("submit", function (e) {
  e.preventDefault();
  const code = $(this).find("input[name=code]").val();
  const disease_id = $(this).find("select[name=disease_id]").val();
  const symptom_id = $(this)
    .find("input[name='symptom_id[]']:checked")
    .map((i, el) => $(el).val())
    .get();

  const row = symptom_id.map((id) => {
    return {
      code: code,
      disease_id: disease_id,
      symptom_id: id,
    };
  });

  $.ajax({
    type: "POST",
    url: origin + "/api/rule/creates",
    data: JSON.stringify(row),
    contentType: "application/json",
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
});

$("form#form-edit").on("submit", function (e) {
  e.preventDefault();
  const code = $(this).find("input[name=code_edit]").val();
  const disease_id = $(this).find("select[name=disease_id_edit]").val();
  const symptom_id = $(this)
    .find("input[name='symptom_id_edit[]']:checked")
    .map((i, el) => $(el).val())
    .get();

  const row = symptom_id.map((id) => {
    return {
      code: code,
      disease_id: disease_id,
      symptom_id: id,
    };
  });

  $.ajax({
    type: "POST",
    url: origin + "/api/rule/updates",
    data: JSON.stringify(row),
    contentType: "application/json",
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

    error: function (xhr, status, error) {
      console.log(xhr);
    },
  });
});

$("body").on("click", ".btn-action", function (e) {
  e.preventDefault();
  const action = $(this).data("action");
  const id = $(this).data("id");
  const rule = cloud.get("rule");
  const disease = cloud.get("disease");
  const symptom = cloud.get("symptom");
  switch (action) {
    case "add":
      $("#form-add select[name=disease_id]").empty();
      $.each(disease, function (i, v) {
        $("#form-add select[name=disease_id]").append(
          $("<option>", {
            value: v.id,
            text: v.name,
          })
        );
      });
      $("#form-add select[name=disease_id]").formSelect();

      const $addSymptom = $("#form-add #symptom");
      $addSymptom.empty();
      $.each(symptom, function (i, v) {
        $addSymptom.append(
          `<p><label><input type="checkbox" name="symptom_id[]" value="${v.id}" /><span>${v.name}</span></label></p>`
        );
      });
      break;

    case "edit":
      const data = rule[id];
      $("#form-edit input[name=code_edit]").val(data[0].code);
      $("#form-edit select[name=disease_id_edit]").empty();
      $.each(disease, function (i, v) {
        $("#form-edit select[name=disease_id_edit]").append(
          $("<option>", {
            value: v.id,
            text: v.name,
          })
        );
      });
      $("#form-edit select[name=disease_id_edit]").formSelect();

      const $editSymptom = $("#form-edit #symptom_edit");
      $editSymptom.empty();
      $.each(symptom, function (i, v) {
        const isChecked = data.some((d) => d.symptom_id === v.id)
          ? "checked"
          : "";
        $editSymptom.append(
          `<p><label><input type="checkbox" name="symptom_id_edit[]" value="${v.id}" ${isChecked} /><span>${v.name}</span></label></p>`
        );
      });
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
  cloud
    .add(origin + "/api/disease", {
      name: "disease",
      data: {
        group: "yes",
      },
      callback: (data) => {},
    })
    .then((disease) => {});
  cloud
    .add(origin + "/api/symptom", {
      name: "symptom",
      data: {
        group: "yes",
      },
      callback: (data) => {},
    })
    .then((symptom) => {});
  $(".preloader").slideUp();
});
