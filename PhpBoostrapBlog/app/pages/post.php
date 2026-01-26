<?php
 require_once __DIR__ .  '../includes/header.php';

// parse id from URL
$id = isset($url[1]) ? (int)$url[1] : 0;
// $id = $url[1] ?? null;          
// $id = (int)$id;

$post = null;

if ($id > 0) {
    $sql = "
      SELECT p.id, p.title, p.content, p.date, p.image,
             c.category, u.username
      FROM posts p
      JOIN categories c ON p.category_id = c.id
      JOIN users      u ON p.user_id = u.id
      WHERE p.id = :id
      LIMIT 1
    ";
    $post = querry__row($sql, ['id' => $id]);
}
?>

<?php require_once __DIR__ .  '../includes/header.php' ?>
<div class="container my-4">

  <?php if (!$post): ?>
    <div class="alert alert-danger">Post not found.</div>
  <?php else: ?>

    <div class="mb-3">
        <a href="<?= ROOT ?>/index.php?url=blog">
        <button type="button" class="btn btn-primary">
      &larr; Back to blog
      </button>
      </a>
    </div>
    <h3 class="mx-2 text-center">Post Single View</h3>
<div class="row justify-content-center">
    <div class="col-sm-10 col-md-8 col-lg-5">
      <div class="card mb-3 shadow-sm">
         <div class="card-body py-3">
    <h1 class="mb-3"><?= htmlspecialchars($post['title']) ?></h1>

    <p class="text-muted mb-2">
      <?= htmlspecialchars(date("jS M, Y", strtotime($post['date']))) ?> ·
      <?= htmlspecialchars($post['username']) ?> ·
      <span class="badge text-bg-primary">
        <?= htmlspecialchars($post['category']) ?>
      </span>
    </p>

    <div class="mb-4">
      <img
        src="<?= htmlspecialchars(get_image($post['image'])) ?>"
        alt="Post image"
        class="card-img-top single-img"
        style="max-height: 400px; object-fit: cover;"
      >
    </div>

    <div class="fs-5">
      <?= nl2br(htmlspecialchars($post['content'])) ?>
    </div>
    </div>
    </div>
    </div>
    </div>

  <?php endif; ?>

</div>