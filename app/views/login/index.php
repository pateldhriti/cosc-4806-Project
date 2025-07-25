<div class="container mt-5" style="max-width: 400px;">
  <h2 class="mb-4">Login</h2>

  <?php if (!empty($data['error'])): ?>
    <div class="alert alert-danger"><?= $data['error'] ?></div>
  <?php endif; ?>

  <form method="post" action="/index.php?url=login/auth">
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" name="username" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-dark">Login</button>
  </form>

  <p class="mt-3">
    Don’t have an account? <a href="/index.php?url=register">Register here</a>
  </p>
</div>
