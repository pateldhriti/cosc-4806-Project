<?php include_once(__DIR__ . '/../includes/header_public.php'); ?>

<div class="container mt-5">
  <h2 class="text-center mb-4">Search for a movie</h2>

  <form action="/index.php" method="get" class="d-flex justify-content-center">
    <input type="hidden" name="url" value="Movie/search">
    <div class="input-group w-50">
      <input type="text" name="movie" class="form-control" placeholder="Please enter movie title" required>
      <button type="submit" class="btn btn-primary">Search</button>
    </div>
  </form>
</div>

<?php include_once(__DIR__ . '/../includes/footer.php'); ?>
