/*
File: spin.js
Description: Animates a spinning wheel and, after the animation ends, fetches and displays a random movie from the server.
*/

// Track total wheel rotation in degrees
let currentRotation = 0;

// Get references to DOM elements
const wheel = document.getElementById("wheel");
const spinBtn = document.getElementById("spinBtn");
const card = document.getElementById("movieCard");

// Handle spin button click
spinBtn.addEventListener("click", () => {
  // Instantly reset wheel's current rotation (no animation)
  wheel.style.transition = "none";
  wheel.style.transform = `rotate(${currentRotation}deg)`;
  void wheel.offsetWidth; // Force browser reflow to apply reset

  // Add spin animation
  // Use cubic-bezier for a smooth spin effect
  // Transition duration is 4 seconds
  // Spin 5 full turns plus a random offset
  // This creates a more dynamic and unpredictable spin
  wheel.style.transition = "transform 4s cubic-bezier(0.33, 1, 0.68, 1)";
  const spinAmount = 360 * 5 + Math.floor(Math.random() * 360); // Spin 5 full turns + random offset
  // Update current rotation to include the new spin
  currentRotation += spinAmount;
  wheel.style.transform = `rotate(${currentRotation}deg)`; // Apply new rotation

  // After spin completes (4.2 seconds), fetch a random movie
  setTimeout(() => {
    fetch("../Server/spin_wheel.php") // Call server to get a random movie
      .then((response) => response.json())
      .then((data) => {
        // Fill in movie card with fetched data
        document.getElementById("title").textContent = data.title;
        document.getElementById("genre").textContent = data.genre;
        document.getElementById("mood").textContent = data.mood;
        document.getElementById("runtime").textContent = data.runtime + " min";
        document.getElementById("poster").src = data.poster_url;

        // Show the movie card
        card.style.display = "flex";
      });
  }, 4200); // Wait until after wheel animation ends
});
