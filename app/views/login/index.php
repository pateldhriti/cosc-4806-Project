<div class="container d-flex justify-content-center align-items-center" style="min-height: 85vh;">
  <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
    <h3 class="text-center mb-4">🔐 Login</h3>

    <?php if (!empty($data['error'])): ?>
      <div class="alert alert-danger"><?= $data['error'] ?></div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['flash'])): ?>
      <div class="alert alert-success"><?= $_SESSION['flash'] ?></div>
      <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <form method="post" action="/index.php?url=login/auth">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
      </div>

      <button type="submit" class="btn btn-dark w-100">Login</button>
    </form>

    <p class="mt-3 text-center">
      Don’t have an account? <a href="/index.php?url=register">Register here</a>
    </p>
  </div>
</div>
