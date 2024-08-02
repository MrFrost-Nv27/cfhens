$(".parent-wrapper").scroll(function () {
  if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
  } else {
  }
  console.log($(this).scrollTop(), $(this).innerHeight(), $(this)[0].scrollHeight);
});

$("form#form-calculate").on("submit", function (e) {
  e.preventDefault();
  const data = {};
  $(this)
    .serializeArray()
    .map(function (x) {
      data[x.name] = parseFloat(x.value);
    });
  console.log(data);
  if (Object.keys(data).length === 0) {
    return;
  }
  $(this).find("input, select").attr("readonly", true);
  $(this).find("button[type=submit]").attr("disabled", true);
  $.ajax({
    type: "POST",
    url: origin + "/api/implementasi",
    data: data,
    success: (res) => {
      console.log(res);
      $(this).find("button[type=submit]").attr("disabled", false);
      $(this).find("input, select").attr("readonly", false);
      $(this)[0].reset();

      if (res.result.length == 0) {
        Swal.fire({
          title: "Mohon maaf",
          text: "Tidak ditemukan penyakit yang sesuai",
          icon: "warning",
        });
        return;
      }

      const tableResult = $("table#result");

      tableResult.find("tbody").empty();

      $.each(res.result, function (i, r) {
        tableResult
          .find("tbody")
          .append(
            `<tr>
              <td>${r.penyakit.code}</td>
              <td>${r.penyakit.name}</td>
              <td>${r.cfcombine > 10 ? 100 : (r.cfcombine * 10).toFixed(2)}%</td>
            </tr>`
          );
      });

      const hasil = res.result.filter((x) => x.cfcombine == res.result[0].cfcombine).sort((a, b) => a.cfhe.length - b.cfhe.length)[0];

      Swal.fire({
        title: "Berhasil di diagnosa",
        text: `Ayam anda mengidap penyakit ${hasil.penyakit.name} dengan nilai Certainty Factor sebesar ${hasil.cfcombine > 10 ? 100 : (hasil.cfcombine * 10).toFixed(2)}%`,
        icon: "info",
      });
    },
  });
});

$(document).ready(function () {
  $(".preloader").slideUp();
  cloud
    .add(origin + "/api/disease", {
      name: "disease",
      callback: (data) => {
        table.disease.ajax.reload();
      },
    })
    .then((disease) => {
      const tableRules = $("#table-rule");
      const tr = $(`<tr><th></th></tr>`);
      $.each(disease, function (i, d) {
        tr.append(`<th>${d.code}</th>`);
      });
      tableRules.find("thead").empty().append(tr);
      cloud
        .add(origin + "/api/symptom", {
          name: "symptom",
          callback: (data) => {
            table.symptom.ajax.reload();
          },
        })
        .then((symptom) => {
          $.each(symptom, function (j, s) {
            const tr = $(`<tr><td>${s.code}</td></tr>`);
            $.each(disease, function (j, d) {
              const ruleExist = d.rules.find((r) => r.symptom_id == s.id);
              tr.append(`<td>${ruleExist ? 1 : 0}</td>`);
            });
            tableRules.find("tbody").append(tr);

            const form = $(`form#form-calculate .question`);
            form.append(`
                    <div class="input-field col s12">
                        <select name="${s.code}" id="${s.code}">
                            <option value="0.0"selected>Pilih Jawaban</option>
                            <option value="1.0">Ya</option>
                            <option value="0.0">Tidak</option>
                        </select>
                        <label for="${s.code}">Apakah Ayam Anda mengalami gejala ${s.name}?</label>
                    </div>
            `);
          });
          $("select").formSelect();
        });
    });

  $(".preloader").slideUp();
});
