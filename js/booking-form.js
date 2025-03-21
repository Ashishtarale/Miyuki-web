document.addEventListener("DOMContentLoaded", function () {
  "use strict";

  const form = document.querySelector(".booking-form");
  const resetBtn = document.getElementById("reset");
  const loadingMessage = document.querySelector(".loading");

  function showError(input) {
    input.classList.add("error");
    input.focus();
  }

  function showSuccess(input) {
    input.classList.remove("error");
    input.classList.add("success");
  }

  function validateFields(fields) {
    let isValid = true;

    fields.forEach((field) => {
      if (!field.value.trim()) {
        showError(field);
        isValid = false;
      } else {
        showSuccess(field);
      }
    });

    return isValid;
  }

  function submitForm(event) {
    event.preventDefault();

    const fields = [
      "firstname",
      "lastname",
      "email",
      "phone",
      "service",
      "staff",
      "date",
    ].map((id) => document.querySelector(`.${id}`));

    if (!validateFields(fields)) return;

    const formData = new FormData(form);

    loadingMessage.style.display = "block";
    loadingMessage.innerHTML = "Loading...";

    fetch("php/bookingForm.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        fields.forEach((field) => field.classList.remove("success"));
        loadingMessage.innerHTML =
          data === "success"
            ? "<span style='color:#48af4b'>Mail sent successfully.</span>"
            : "<span style='color:#ff5607'>Mail not sent.</span>";
        setTimeout(() => (loadingMessage.style.display = "none"), 3000);
      })
      .catch((error) => {
        loadingMessage.innerHTML =
          "<span style='color:#ff5607'>Error occurred.</span>";
        setTimeout(() => (loadingMessage.style.display = "none"), 3000);
      });
  }

  function resetForm() {
    document.querySelectorAll(".form-control").forEach((input) => {
      input.classList.remove("error", "success");
    });
  }

  form.addEventListener("submit", submitForm);
  resetBtn.addEventListener("click", resetForm);
});
