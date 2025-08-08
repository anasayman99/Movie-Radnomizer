/*
File: collection.js
Description: Manages the user's movie collection with live search functionality, adding/removing movies, and displaying the collection.
Submits requests to the server via AJAX and updates the UI dynamically without reloading the page.
*/
// Wait until the DOM is fully loaded
document.addEventListener("DOMContentLoaded", () => {
  // Reference key DOM elements
  const searchForm = document.getElementById("searchForm");
  const searchInput = document.getElementById("searchInput");
  const searchResults = document.getElementById("searchResults");
  const searchHeader = document.getElementById("searchResultsHeader");
  const noResultsMessage = document.getElementById("noResultsMessage");
  const collectionList = document.getElementById("collectionList");
  const emptyMessage = document.getElementById("emptyMessage");

  // Fetch and display the user's current collection
  function fetchCollection() {
    collectionList.classList.remove("show");

    fetch("../Server/collection_get.php")
      .then((r) => r.json())
      .then((data) => {
        collectionList.style.opacity = 0;
        collectionList.innerHTML = "";

        // Show message if no movies found
        if (data.length === 0) {
          emptyMessage.style.display = "block";
          collectionList.style.opacity = 1;
          document.getElementById("page-content").style.display = "block";
          return;
        }

        // Hide message if movies exist
        emptyMessage.style.display = "none";

        // Generate HTML for each movie
        const html = data
          .map(
            (m) => `
        <li class="movie-entry">
          <img src="${m.poster_url}" alt="Poster">
          <span><strong>${m.title}</strong> (${m.genre}, ${m.mood}, ${m.runtime} min)</span>
          <button onclick="removeFromCollection(${m.id})">Remove</button>
        </li>`
          )
          .join("");
        // Inject the generated movie list HTML into the collection container
        collectionList.innerHTML = html;

        // Wait until all poster images load or fail before making the collection visible
        // This ensures the collection list is only shown after all images are loaded
        const images = collectionList.querySelectorAll("img");
        let loaded = 0;

        // Count each image load (or error); once all are done, reveal the collection
        images.forEach((img) => {
          img.onload = img.onerror = () => {
            loaded++;
            if (loaded === images.length) {
              collectionList.style.opacity = 1;
              document.getElementById("page-content").style.display = "block";
            }
          };
        });

        // If no images exist, just show the list immediately
        if (images.length === 0) {
          collectionList.classList.add("show");
        }
      });
  }

  // Live search handler (runs on each keystroke)
  searchInput.addEventListener("input", () => {
    const q = searchInput.value.trim();

    // Clear results if input is empty
    if (!q) {
      searchResults.innerHTML = "";
      searchHeader.style.display = "none";
      noResultsMessage.style.display = "none";
      return;
    }

    // Send query to backend and show results
    fetch(`../Server/search_movies.php?search=${encodeURIComponent(q)}`)
      .then((r) => r.json())
      .then((data) => {
        searchResults.innerHTML = "";

        // Show search results header if there are results
        if (data.length > 0) {
          searchHeader.style.display = "block";
          noResultsMessage.style.display = "none";

          // Add each result to the results list
          data.forEach((m) => {
            const li = document.createElement("li");
            li.className = "movie-entry";

            // Check if the movie is already in the collection
            let actionHTML = "";
            if (m.in_collection) {
              // If already in collection, show a message instead of button
              actionHTML = "<em>Already in collection</em>";
            } else {
              // If not in collection, show "Add" button
              actionHTML = `<button onclick="addToCollection(${m.id})">Add</button>`;
            }
            // Construct the movie entry HTML
            li.innerHTML = `
    <img src="${m.poster_url}" alt="Poster">
    <span><strong>${m.title}</strong> (${m.genre}, ${m.mood}, ${m.runtime} min)</span>
    ${actionHTML}
  `;
            searchResults.appendChild(li);
          });
        } else {
          // Show message if no matching movies
          searchHeader.style.display = "none";
          noResultsMessage.style.display = "block";
        }
      });
  });

  // Add a movie to the collection
  window.addToCollection = function (id) {
    // Send POST request to add movie to collection
    fetch("../Server/collection_add.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `movie_id=${id}`,
    }).then(() => {
      fetchCollection(); // Refresh collection
      searchInput.dispatchEvent(new Event("input")); // Re-run search
    });
  };

  // Remove a movie from the collection
  window.removeFromCollection = function (id) {
    // Send POST request to remove movie from collection
    fetch("../Server/collection_remove.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `movie_id=${id}`,
    }).then(() => {
      fetchCollection(); // Refresh collection
      searchInput.dispatchEvent(new Event("input")); // Re-run search
    });
  };

  // Load the collection when the page is ready
  fetchCollection();
});
