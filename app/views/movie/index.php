<?php include_once(__DIR__ . '/../includes/header_public.php'); ?>


<div class ="container mt-5">
  <h2 class="mb-4 text-center">Search for a movie</h2>
  <form action="/movie/search" method="post" class="d-flex justify-content-center">
    <input type="text" name="movie" class="form-control w-50 me-2" placeholder="Enter movie title" required>
    <button type="submit" class="btn btn-primary">Search</button>
    </form>
    </div>
    <?php include_once(__DIR__ . '/../includes/footer.php'); ?>
