/*
File: register.js
Description: Handles user registration with validation for required fields, email format, password confirmation, and runtime limits.
Submits the form via AJAX and displays error messages without reloading the page.
*/

// Wait for the DOM to fully load
document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form"); // The registration form element

  // All field IDs involved in validation
  const fields = [
    "username",
    "email",
    "password",
    "confirm_password",
    "genre",
    "mood",
    "min_runtime",
    "max_runtime",
  ];

  // Helper function to get the associated error message <div> for a given field
  const getErrorElement = (id) => {
    const input = document.getElementById(id);
    return input.closest(".form-group").querySelector(".error-message");
  };

  // Clear error feedback as the user types or changes the field
  fields.forEach((id) => {
    const input = document.getElementById(id);
    input.addEventListener("input", () => {
      input.classList.remove("invalid"); // Remove red border
      getErrorElement(id).textContent = ""; // Clear error message
    });
  });

  // When the form is reset, remove all validation styles and messages
  form.addEventListener("reset", () => {
    fields.forEach((id) => {
      const input = document.getElementById(id);
      input.classList.remove("invalid");
      getErrorElement(id).textContent = "";
    });
  });

  // Handle form submission
  form.addEventListener("submit", (e) => {
    e.preventDefault(); // Prevent default page reload
    let valid = true; // Flag to track overall form validity

    // Validate required fields, email format, and runtime limits
    fields.forEach((id) => {
      const input = document.getElementById(id);
      const error = getErrorElement(id);
      input.classList.remove("invalid");
      error.textContent = "";

      // Field is required
      if (!input.value.trim()) {
        input.classList.add("invalid");
        error.textContent = "This field is required.";
        valid = false;
      }

      // Check for valid email format
      if (id === "email" && input.value.trim()) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(input.value.trim())) {
          input.classList.add("invalid");
          error.textContent = "Please enter a valid email address.";
          valid = false;
        }
      }

      // Check that runtime values are positive
      if ((id === "min_runtime" || id === "max_runtime") && input.value < 1) {
        input.classList.add("invalid");
        error.textContent = "Must be a positive number.";
        valid = false;
      }
    });

    // Confirm that password and confirmation match
    const password = document.getElementById("password");
    const confirm = document.getElementById("confirm_password");
    if (password.value && confirm.value && password.value !== confirm.value) {
      confirm.classList.add("invalid");
      getErrorElement("confirm_password").textContent = "Passwords do not match.";
      valid = false;
    }

    // Validate that min_runtime < max_runtime
    const min = parseInt(document.getElementById("min_runtime").value);
    const max = parseInt(document.getElementById("max_runtime").value);
    if (min && max && min > max) {
      document.getElementById("min_runtime").classList.add("invalid");
      document.getElementById("max_runtime").classList.add("invalid");
      getErrorElement("min_runtime").textContent = "Min must be less than Max.";
      getErrorElement("max_runtime").textContent = "Max must be greater than Min.";
      valid = false;
    }

    // Stop submission if any validation failed
    if (!valid) return;

    // Prepare form data to send to the server
    const formData = new URLSearchParams();
    fields.forEach((id) => {
      formData.append(id, document.getElementById(id).value);
    });

    // Send AJAX request to registration handler
    fetch("../Server/register.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        // If registration failed, highlight the field and show the message
        if (!data.success) {
          const input = document.getElementById(data.field);
          input.classList.add("invalid");
          getErrorElement(data.field).textContent = data.message;
          return;
        }

        // On success, show alert and redirect to login page
        alert("✅ Registered Successfully!");
        window.location.href = "../Html/login.html";
      });
  });
});
