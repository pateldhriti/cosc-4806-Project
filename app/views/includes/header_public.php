<!DOCTYPE html>
<html lang="en">  
<head>
  <meta charset="UTF-8">
  <title>COSC Project Example</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>  
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
    <a class="navbar-brand text-white" href="/Movie">COSC4806 Project</a>

    <div class="ms-auto">
      <?php if (!isset($_SESSION['auth'])): ?>
        <a class="btn btn-outline-light me-2" href="/index.php?url=movie/myRatings">My Ratings</a>

        <a class="btn btn-outline-light" href="/index.php?url=login">Login</a>
      <?php else: ?>
        <a class="btn btn-outline-danger" href="/index.php?url=logout">Logout</a>
      <?php endif; ?>
    </div>
  </nav>
