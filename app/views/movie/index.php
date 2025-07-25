<?php include_once(__DIR__ . '/../includes/header_public.php'); ?>

<div class="container mt-5">
  <h2 class="mb-4 text-center">Search for a movie</h2>
  <form action="/Movie/search" method="get">
    <input type="text" name="movie" placeholder="Please enter movie title" class="form-control">
    <button type="submit" class="btn btn-primary">Search</button>
  </form>
</div>

<?php include_once(__DIR__ . '/../includes/footer.php'); ?>
