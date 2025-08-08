<?php
/**
 * File: watch.php
 * Description: Handles the movie selection process based on user preferences.
 * Displays a form to choose preferences or shows a random movie based on saved preferences.
 */

session_start(); // Start session
require_once "db_connect.php"; // Include DB connection

// Redirect to login if user not logged in
if (!isset($_SESSION["user_id"])) {
  header("Location: ../Html/login.html");
  exit;
}

// Store user ID from session
$user_id = $_SESSION["user_id"];

// Fetch user from DB
$res = $conn->query("SELECT * FROM users WHERE id = $user_id");
$user = $res ? $res->fetch_assoc() : null;

// Fetch all movies from DB
$movies = [];
$res = $conn->query("SELECT * FROM movies");
if ($res) {
  while ($row = $res->fetch_assoc()) {
    $movies[] = $row;
  }
}

// Filter movies by preferences
function filterMovies($movies, $prefs): array {
  return array_values(array_filter($movies, function ($m) use ($prefs) {
    return $m["genre"] === $prefs["genre"]
      && $m["mood"] === $prefs["mood"]
      && $m["runtime"] >= $prefs["min_runtime"]
      && $m["runtime"] <= $prefs["max_runtime"];
  }));
}

// Pick one random movie
function pickRandom($movies): mixed {
  return empty($movies) ? null : $movies[array_rand($movies)];
}

$selected = null;
$showFilterForm = false;
$showResult = false;

// Logic: form submission or result view
if (isset($_GET["result"])) {
  $selected = $_SESSION["selected_movie"] ?? null;
  $showResult = true;
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {

  // Use saved preferences
  if (isset($_POST["use_saved"])) {
    $prefs = [
      "genre" => $user["genre"],
      "mood" => $user["mood"],
      "min_runtime" => $user["min_runtime"],
      "max_runtime" => $user["max_runtime"]
    ];

    // Check if preferences are incomplete
    if (in_array(null, $prefs, true) || !$prefs["min_runtime"] || !$prefs["max_runtime"]) {
      echo "<p>⚠ Your saved preferences are incomplete. Please choose new ones.</p>";
      $showFilterForm = true;
    } else {
      $filtered = filterMovies($movies, $prefs);
      $selected = pickRandom($filtered);
      $showResult = true;
    }

  // Choose new preferences
  } elseif (isset($_POST["choose_new"])) {
    $showFilterForm = true;

  // Save new preferences and redirect
  } elseif (isset($_POST["genre"], $_POST["mood"], $_POST["min_runtime"], $_POST["max_runtime"])) {
    $prefs = [
      "genre" => $_POST["genre"],
      "mood" => $_POST["mood"],
      "min_runtime" => (int)$_POST["min_runtime"],
      "max_runtime" => (int)$_POST["max_runtime"]
    ];

    $conn->query("UPDATE users SET 
            genre = '{$prefs["genre"]}', 
            mood = '{$prefs["mood"]}', 
            min_runtime = {$prefs["min_runtime"]}, 
            max_runtime = {$prefs["max_runtime"]}
            WHERE id = $user_id");

    $filtered = filterMovies($movies, $prefs);
    $selected = pickRandom($filtered);

    $_SESSION["selected_movie"] = $selected;
    header("Location: watch.php?result=1");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Movie Randomizer</title>
  <!-- External stylesheet -->
  <link rel="stylesheet" href="../Styles/style.css">
</head>

<body>
  <!-- Navigation bar -->
  <header>
    <nav class="main-nav" aria-label="Main Navigation">
      <ul>
        <li><a href="manage_collection.php" class="cta-btn">🎬 Your Collection</a></li>
        <li><a href="watch.php" class="cta-btn">🎲 Watch a Movie</a></li>
        <li><a href="main_menu.php" class="cta-btn">📋 Main Menu</a></li>
        <li><a href="logout.php" class="cta-btn">🚪 Logout</a></li>
      </ul>
    </nav>
  </header>

  <!-- Hero banner with background image -->
  <section class="hero">
    <img src="../Images/hero.jpg" alt="Hero Image" class="hero-bg">
    <div class="hero-text">🍿 Discover Your Next Movie Night</div>
  </section>

  <!-- Main movie interaction logic -->
  <main class="watch-main">

    <!-- Prompt to use saved or choose new preferences -->
    <?php if (!$showFilterForm && !$showResult): ?>
      <section class="action-form-section">
        <form method="POST">
          <h2>What would you like to do?</h2>
          <!-- Use saved preferences -->
          <button name="use_saved" value="1" class="watch-button">Use Saved Preferences</button>
          <!-- Choose new preferences -->
          <button name="choose_new" value="1" class="watch-button">Choose New Preferences</button>
          <!-- Spin the wheel -->
          <button name="spin_wheel" value="1" class="watch-button" formaction="spin.php">🎯 Spin the Wheel (Random)</button>
        </form>
      </section>
    <?php endif; ?>

    <!-- Form for entering new preferences -->
    <?php if ($showFilterForm): ?>
      <section class="preferences-form-section">
        <form method="POST">

          <!-- Genre select -->
          <div class="form-group">
            <label for="genre">Genre</label>
            <select id="genre" name="genre" required>
              <option value="Action">Action</option>
              <option value="Drama">Drama</option>
              <option value="Animation">Animation</option>
              <option value="Thriller">Thriller</option>
              <option value="Sci-Fi">Sci-Fi</option>
              <option value="Romance">Romance</option>
              <option value="Comedy">Comedy</option>
              <option value="Crime">Crime</option>
              <option value="Family">Family</option>
              <option value="War">War</option>
              <option value="Adventure">Adventure</option>
              <option value="Horror">Horror</option>
              <option value="Biography">Biography</option>
            </select>
          </div>

          <!-- Mood select -->
          <div class="form-group">
            <label for="mood">Mood</label>
            <select id="mood" name="mood" required>
              <option value="Mind-Bending">Mind-Bending</option>
              <option value="Chill">Chill</option>
              <option value="Exciting">Exciting</option>
              <option value="Tense">Tense</option>
              <option value="Feel-Good">Feel-Good</option>
            </select>
          </div>

          <!-- Min runtime -->
          <div class="form-group">
            <label for="min_runtime">Min Runtime</label>
            <input type="number" id="min_runtime" name="min_runtime" required>
          </div>

          <!-- Max runtime -->
          <div class="form-group">
            <label for="max_runtime">Max Runtime</label>
            <input type="number" id="max_runtime" name="max_runtime" required>
          </div>

          <!-- Submit -->
          <button type="submit">Save & Randomize</button>
        </form>
      </section>
    <?php endif; ?>

    <!-- Display result if movie selected -->
    <?php if ($showResult): ?>
      <section class="result-section">
        <header>
          <h3>🎬 Your Random Movie:</h3>
        </header>

        <?php if ($selected): ?>
          <div class="movie-card">

            <!-- Movie title -->
            <div class="movie-title-row">
              <span class="icon">🎬</span>
              <h2><?= htmlspecialchars($selected["title"]) ?></h2>
            </div>

            <!-- Movie poster -->
            <img src="<?= htmlspecialchars($selected["poster_url"]) ?>"
                 alt="Poster for <?= htmlspecialchars($selected["title"]) ?>"
                 class="movie-poster poster-hover">

            <!-- Genre -->
            <div class="movie-detail-row">
              <span class="icon">🎭</span>
              <span class="label">Genre:</span>
              <span class="value"><?= htmlspecialchars($selected["genre"]) ?></span>
            </div>

            <!-- Mood -->
            <div class="movie-detail-row">
              <span class="icon">🧠</span>
              <span class="label">Mood:</span>
              <span class="value"><?= htmlspecialchars($selected["mood"]) ?></span>
            </div>

            <!-- Runtime -->
            <div class="movie-detail-row">
              <span class="icon">⏱️</span>
              <span class="label">Runtime:</span>
              <span class="value"><?= htmlspecialchars($selected["runtime"]) ?> min</span>
            </div>
          </div>

        <!-- If no result -->
        <?php else: ?>
          <p>No matching movie was found in your collection.</p>
        <?php endif; ?>
      </section>
    <?php endif; ?>
  </main>
</body>
</html>
