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
<?php require_once __DIR__ .  '../includes/header.php' ?>

<?php if ($post): ?>
<div class="container my-4">
  <h3 class="mx-2 text-center">Search Result</h3>

  <div class="row justify-content-center">
    <div class="col-sm-10 col-md-8 col-lg-5">
      <div class="card mb-3 shadow-sm">
        <img src="<?= htmlspecialchars(get_image($post['image'])) ?>"
             class="card-img-top search-img"
             alt="Post image">

        <div class="card-body py-3">
          <h3 class="card-title h6 mb-2">
            <?= htmlspecialchars($post['title']) ?>
          </h3>

          <p class="text-muted mb-2 small">
            <?= htmlspecialchars($post['date']) ?> ·
            <?= htmlspecialchars($post['username']) ?> ·
            <span class="badge bg-primary">
              <?= htmlspecialchars($post['category']) ?>
            </span>
          </p>

          <p class="card-text multi-line-truncate small mb-0">
            <?= nl2br(htmlspecialchars($post['content'])) ?>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php elseif ($term !== ''): ?>

  <div class="alert alert-warning">No post found for that search.</div>

<?php endif; ?>