$(".parent-wrapper").scroll(function () {
  if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
  } else {
  }
  console.log($(this).scrollTop(), $(this).innerHeight(), $(this)[0].scrollHeight);
});

$(".next-page").on("click", function (e) {
  const page = $(this).closest(".page").next();
  page.addClass("active");
});
$(".back-page").on("click", function (e) {
  const page = $(this).closest(".page");
  page.removeClass("active");
});

$("form#form-diagnosa").on("submit", function (e) {
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

      Swal.fire({
        title: "Berhasil di diagnosa",
        text: `Ayam anda mengidap penyakit ${res.result[0].penyakit.name} dengan nilai Certainty Factor sebesar ${res.result[0].cfcombine > 10 ? 100 : (res.result[0].cfcombine * 10).toFixed(2)}%`,
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
      const tableDisease = $("table#disease tbody");
      let num = 1;
      tableDisease.empty();
      $.each(disease, function (i, d) {
        tableDisease.append(`
          <tr>
            <td class="center">${num}</td>
            <td>${d.name}</td>
          </tr>
        `);
        num++;
      });
    });

  cloud
    .add(origin + "/api/symptom", {
      name: "symptom",
      callback: (data) => {
        table.symptom.ajax.reload();
      },
    })
    .then((symptom) => {
      $.each(symptom, function (i, symp) {
        if (symp) {
          const form = $(`form#form-diagnosa .question`);
          form.append(`
                    <div class="input-field col s12">
                        <select name="${symp.code}" id="${symp.code}">
                            <option value="0.0"selected>Pilih Jawaban</option>
                            <option value="1.0">Ya</option>
                            <option value="0.0">Tidak</option>
                        </select>
                        <label for="${symp.code}">Apakah Ayam Anda mengalami gejala ${symp.name}?</label>
                    </div>
            `);
        }
      });
      $("select").formSelect();
    });

  $(".preloader").slideUp();
});
