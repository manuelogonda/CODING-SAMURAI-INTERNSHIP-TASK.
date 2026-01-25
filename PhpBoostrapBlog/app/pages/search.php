<div class="mx-auto col-md-6 justify-content-center">
  <h3 class="mx-2 text-center">Search Result</h3>

<?php
// var_dump($_SERVER['REQUEST_METHOD'], $_POST);
$term  = $_POST['search'] ?? '';    
$post = [];

if ($term !== '') {

    $like = "%{$term}%";

    $sql = "
      SELECT p.id, p.title, p.content, p.image, p.date,
             u.username, c.category
      FROM posts AS p
      INNER JOIN users AS u ON p.user_id = u.id
      INNER JOIN categories AS c ON p.category_id = c.id
      WHERE p.title   LIKE :find
         OR p.content LIKE :find
      LIMIT 1
    ";

    $post = querry__row($sql, ['find' => $like]);
}


?>

<?php if ($post): ?>

  <div class="col-md-8 col-lg-6">
    <div class="card mb-4">
      <img src="<?= htmlspecialchars(get_image($post['image'])) ?>"
           class="card-img-top search-img"
           alt="Post image">
      <div class="card-body">
        <h3 class="card-title h5"><?= htmlspecialchars($post['title']) ?></h3>
        <p class="text-muted mb-2 small">
          <?= htmlspecialchars($post['date']) ?> ·
          <?= htmlspecialchars($post['username']) ?> ·
          <span class="badge text-bg-primary">
            <?= htmlspecialchars($post['category']) ?>
          </span>
        </p>
        <p class="card-text text-truncate">
          <?= nl2br(htmlspecialchars($post['content'])) ?>
        </p>
      </div>
    </div>
  </div>
</div>

<?php elseif ($term !== ''): ?>

  <div class="alert alert-warning">No post found for that search.</div>

<?php endif; ?>