// Run this code when the window finishes loading (after all assets like images)
window.addEventListener("load", () => {
  const images = document.querySelectorAll("img"); // Select all <img> elements on the page
  let loaded = 0; // Counter for loaded (or errored) images

  // If there are no images, show the page immediately
  if (images.length === 0) {
    document.getElementById("page-content").style.display = "block";
    return;
  }

  // Loop through all images
  images.forEach((img) => {
    // If image is already loaded (from cache), increment counter
    if (img.complete) {
      loaded++;
    } else {
      // If image loads successfully
      img.addEventListener("load", () => {
        loaded++;
        // Once all images are done, show the page
        if (loaded === images.length) {
          document.getElementById("page-content").style.display = "block";
        }
      });

      // If image fails to load (404, etc.), still count it
      img.addEventListener("error", () => {
        loaded++;
        // Once all images are done (even with errors), show the page
        if (loaded === images.length) {
          document.getElementById("page-content").style.display = "block";
        }
      });
    }
  });

  // In case all images were already loaded
  if (loaded === images.length) {
    document.getElementById("page-content").style.display = "block";
  }
});
