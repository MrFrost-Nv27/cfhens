const elDisease = $("[data-entity=disease]");
const elSymptom = $("[data-entity=symptom]");
const elRule = $("[data-entity=rule]");
$(document).ready(function () {
  cloud
    .add(origin + "/api/disease", {
      name: "disease",
      callback: (data) => {
        elDisease.text(service.length).counterUp();
      },
    })
    .then((service) => {
      elDisease.text(service.length).counterUp();
    });
  cloud
    .add(origin + "/api/symptom", {
      name: "symptom",
      callback: (data) => {
        elSymptom.text(customer.length).counterUp();
      },
    })
    .then((customer) => {
      elSymptom.text(customer.length).counterUp();
    });
  cloud
    .add(origin + "/api/rule", {
      name: "symptom",
      callback: (data) => {
        elRule.text(customer.length).counterUp();
      },
    })
    .then((customer) => {
      elRule.text(customer.length).counterUp();
    });
});
