<?php include_once(__DIR__ . '/../includes/header_public.php'); ?>

<div class="container mt-4">
  <h2><?= htmlspecialchars($data['title']) ?></h2>

  <div class="row mt-3">
    <div class="col-md-4">
      <?php if (!empty($data['movie']['Poster']) && $data['movie']['Poster'] !== "N/A"): ?>
        <img src="<?= htmlspecialchars($data['movie']['Poster']) ?>" class="img-fluid" alt="Poster">
      <?php else: ?>
        <p><em>No poster available.</em></p>
      <?php endif; ?>
    </div>

    <div class="col-md-8">
      <p><strong>Year:</strong> <?= $data['movie']['Year'] ?? 'N/A' ?></p>
      <p><strong>Genre:</strong> <?= $data['movie']['Genre'] ?? 'N/A' ?></p>
      <p><strong>Director:</strong> <?= $data['movie']['Director'] ?? 'N/A' ?></p>
      <p><strong>IMDB Rating:</strong> <?= $data['movie']['imdbRating'] ?? 'N/A' ?>/10</p>
      <p><strong>Plot:</strong> <?= $data['movie']['Plot'] ?? 'N/A' ?></p>

      <hr>
      <h4>⭐ Rate this Movie</h4>
      <?php if (isset($_SESSION['user'])): ?>
        <form method="post" action="/index.php">
          <input type="hidden" name="url" value="Movie/saveRating">
          <input type="hidden" name="title" value="<?= htmlspecialchars($data['title']) ?>">

          <div class="d-flex gap-2 mt-2">
            <?php for ($i = 1; $i <= 5; $i++): ?>
              <button type="submit" name="rating" value="<?= $i ?>" class="btn btn-outline-warning"><?= $i ?> Star</button>
            <?php endfor; ?>
          </div>
        </form>
      <?php else: ?>
        <p class="text-muted mt-3">🔒 You must be logged in to rate this movie.</p>
      <?php endif; ?>

      <?php if (!empty($data['review'])): ?>
        <hr>
        <h4>🧠 Gemini AI Review</h4>
        <p><?= nl2br(htmlspecialchars($data['review'])) ?></p>
      <?php else: ?>
        <p><em>No AI review available.</em></p>
      <?php endif; ?>


<?php include_once(__DIR__ . '/../includes/footer.php'); ?>
