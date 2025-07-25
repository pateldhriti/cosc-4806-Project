<h2>Login</h2>

<?php if (!empty($data['error'])): ?>
    <div style="color:red;"><?= $data['error'] ?></div>
<?php endif; ?>

<form method="POST" action="/index.php?url=login/auth">
  <input type="text" name="username" placeholder="Username" required><br><br>
  <input type="password" name="password" placeholder="Password" required><br><br>
  <button type="submit">Login</button>
</form>
