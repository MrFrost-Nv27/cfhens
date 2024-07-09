const elCustomer = $("[data-entity=customer]");
const elService = $("[data-entity=service]");
const elUser = $("[data-entity=user]");
const elRepair = $("[data-entity=repair]");
$(document).ready(function () {
  cloud
    .add(origin + "/api/service", {
      name: "service",
      callback: (data) => {
        elService.text(service.length).counterUp();
      },
    })
    .then((service) => {
      elService.text(service.length).counterUp();
    });
  cloud
    .add(origin + "/api/customer", {
      name: "customer",
      callback: (data) => {
        elCustomer.text(customer.length).counterUp();
      },
    })
    .then((customer) => {
      elCustomer.text(customer.length).counterUp();
    });
  cloud
    .add(origin + "/api/user", {
      name: "user",
      callback: (data) => {
        elUser.text(user.length).counterUp();
      },
    })
    .then((user) => {
      elUser.text(user.length).counterUp();
    });
  cloud
    .add(origin + "/api/repair", {
      name: "repair",
      callback: (data) => {
        elRepair.text(repair.length).counterUp();
      },
    })
    .then((repair) => {
      elRepair.text(repair.length).counterUp();
    });
  $(".preloader").slideUp();
});
