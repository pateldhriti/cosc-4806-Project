<?php include_once(__DIR__ . '/../includes/header_public.php'); ?>

<div class=" container mt-4">
  <h2><?= htmlspecialchars($data['title']) ?></h2>
  <div class= "row mt-3">
  <div class="col-md-4">
    <img src="<?= $data['movie']['Poster'] ?>" class="img-fluid" alt="Poster">  
    </div>  
    <div class="col-md-8">
      <p><strong>Year:</strong> <?= $data['movie']['Year'] ?></p>
      <p><strong>Genre:</strong> <?= $data['movie']['Genre'] ?></p>
      <p><strong>Director:</strong> <?=  $data['movie']['Director'] ?></p>
      <p><strong>IMDB Rating:</strong> <?= $data['movie']['imdbRating'] ?>/10</p>
      <p><strong>Plot:</strong> <?= $data['movie']['Plot'] ?></p>

      <hr>
      <h4>⭐ Rate this Movie</h4>
      <?php for ($i = 1; $i <= 5; $i++): ?>
        <a href="/Movie/review/<?= urlencode($data['title']) ?>/<?= $i ?>" class="btn btn-outline-warning me-1"><?= $i ?> Star</a>
      <?php endfor; ?>

      <?php if (!empty($data['review'])): ?>
          <hr>
          <h4>🧠 Gemini AI Review</h4>
          <p><?= nl2br(htmlspecialchars($data['review'])) ?></p>
      <?php endif; ?>

      
</div>
    </div>
    </div>
<?php include_once(__DIR__ . '/../includes/footer.php'); ?>

