<?php include_once(__DIR__ . '/../includes/header_public.php'); ?>

<div class="container mt-5">
  <h2 class="mb-4">🧾 My Ratings</h2>

  <?php if (empty($data['ratings'])): ?>
    <p class="text-muted">You haven’t rated any movies yet.</p>
  <?php else: ?>
  <?php if (!empty($r['user_review'])): ?>
    <tr>
      <td colspan="3"><strong>Your Review:</strong> <?= htmlspecialchars($r['user_review']) ?></td>
    </tr>
  <?php endif; ?>

    <table class="table table-striped">
      <thead class="table-dark">
        <tr>
          <th>Movie Title</th>
          <th>Your Rating</th>
          <th>Date Rated</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data['ratings'] as $r): ?>
          <tr>
            <td><?= htmlspecialchars($r['movie_title']) ?></td>
            <td><?= $r['rating'] ?>/5</td>
            <td><?= date('M d, Y h:i A', strtotime($r['created_at'])) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php include_once(__DIR__ . '/../includes/footer.php'); ?>
