<div class="container d-flex justify-content-center align-items-center" style="min-height: 85vh;">
  <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
    <h3 class="text-center mb-4">📝 Register</h3>

    <?php if (!empty($data['error'])): ?>
      <div class="alert alert-danger"><?= $data['error'] ?></div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['flash'])): ?>
      <div class="alert alert-success"><?= $_SESSION['flash'] ?></div>
      <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <form action="/index.php?url=register/create" method="post">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" placeholder="Choose a username" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Create a password" required>
      </div>

      <button type="submit" class="btn btn-success w-100">Register</button>
    </form>

    <p class="mt-3 text-center">
      Already registered? <a href="/index.php?url=login">Login here</a>
    </p>
  </div>
</div>
