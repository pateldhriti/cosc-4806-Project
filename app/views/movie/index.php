<?php include_once(__DIR__ . '/../includes/header_public.php'); ?>

<div class="container mt-5">
  <h2 class="mb-4 text-center">Search for a movie</h2>
  <form action="/index.php" method="get">
    <input type="hidden" name="url" value="Movie/search">
    <input type="text" name="movie" placeholder="Please enter movie title" class="form-control mt-2 mb-2">
    <button type="submit" class="btn btn-primary">Search</button>
  </form>
</div>

<?php include_once(__DIR__ . '/../includes/footer.php'); ?>
