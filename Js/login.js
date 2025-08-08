/*
File: login.js
Description: Handles user login with validation for required fields and sends login request to the server.
Submits the form via AJAX and displays error messages without reloading the page.
*/

// Wait for the DOM to be fully loaded before executing logic
document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form"); // Login form element
  const username = document.getElementById("username"); // Username input field
  const password = document.getElementById("password"); // Password input field

  // These assume the error message <div> is the immediate sibling of the input
  const usernameError = username.nextElementSibling;
  const passwordError = password.nextElementSibling;

  // Form submission handler
  form.addEventListener("submit", (e) => {
    e.preventDefault(); // Prevent form from submitting normally

    // Clear previous validation states
    username.classList.remove("invalid");
    password.classList.remove("invalid");
    usernameError.textContent = "";
    passwordError.textContent = "";

    let hasError = false;

    // Validate username
    if (!username.value.trim()) {
      username.classList.add("invalid");
      usernameError.textContent = "Username is required.";
      hasError = true;
    }

    // Validate password
    if (!password.value.trim()) {
      password.classList.add("invalid");
      passwordError.textContent = "Password is required.";
      hasError = true;
    }

    // Stop here if validation failed
    if (hasError) return;

    // Send login request to PHP backend
    fetch("../Server/login.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: new URLSearchParams({
        username: username.value,
        password: password.value,
      }),
    })
      // Handle the response from the server
      .then((res) => res.json())
      .then((data) => {
        if (data.success) {
          window.location.href = "../Server/main_menu.php";
        } else {
          // Display error on both fields for failed login
          username.classList.add("invalid");
          password.classList.add("invalid");
          usernameError.textContent = "❌ " + data.message;
          passwordError.textContent = "❌ " + data.message;
        }
      })
      .catch(() => {
        // Show fallback error if fetch fails (e.g. server down)
        passwordError.textContent = "Something went wrong. Please try again.";
      });
  });
});
