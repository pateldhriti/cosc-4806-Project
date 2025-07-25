<div class="container mt-5" style="max-width: 400px;">
  <h2 class="mb-4">Register</h2>

  <?php if (!empty($data['error'])): ?>
    <div class="alert alert-danger"><?= $data['error'] ?></div>
  <?php endif; ?>

  <form method="post" action="/index.php?url=register/create">
    <div class="mb-3">
      <label class="form-label">Username</label>
      <input type="text" name="username" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Register</button>
  </form>

  <p class="mt-3">Already have an account? <a href="/index.php?url=login">Login here</a></p>
</div>
