document.addEventListener("DOMContentLoaded", function () {
  "use strict";

  const form = document.querySelector(".booking-form");
  const loadingMessage = document.querySelector(".loading");

  if (!form) {
    console.error("Form not found in the DOM.");
    return;
  }

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
      "date",
    ].map((id) => document.querySelector(`.${id}`)).filter(Boolean); // Remove null fields

    if (!validateFields(fields)) return;

    const formData = new FormData(form);

    loadingMessage.style.display = "block";
    loadingMessage.innerHTML = "Loading...";

    fetch("php/bookingForm.php", {
      method: "POST", // ✅ Correct method
      body: formData,
    })
    
      .then((response) => response.text())
      .then((data) => {
        fields.forEach((field) => field.classList.remove("success"));
        loadingMessage.innerHTML =
          data.trim() === "success"
            ? "<span style='color:#48af4b'>Mail sent successfully.</span>"
            : "<span style='color:#ff5607'>Mail not sent. Please try again.</span>";
        setTimeout(() => (loadingMessage.style.display = "none"), 3000);
      })
      .catch((error) => {
        console.error("Fetch error:", error);
        loadingMessage.innerHTML =
          "<span style='color:#ff5607'>Error occurred. Please check the console.</span>";
        setTimeout(() => (loadingMessage.style.display = "none"), 3000);
      });
  }

  form.addEventListener("submit", submitForm);
});
