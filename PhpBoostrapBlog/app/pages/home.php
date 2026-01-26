<?php require_once __DIR__ . '/includes/header.php' ?>
<!-- slider -->
<iframe src="https://imageslidergenerator.shahmirfaisal.com/slider?image=https%3A%2F%2Fi.ibb.co%2FFkGQdzmq%2Ffotis-fotopoulos-6s-Al6a-Q4-OWI-unsplash.jpg&image=https%3A%2F%2Fi.ibb.co%2F7tnMntts%2Fmyke-simon-ats-Uq-Im3wxo-unsplash.jpg&image=https%3A%2F%2Fi.ibb.co%2F1GCbN18v%2Fvictor-freitas-q-Z-U9z4-TQ6-A-unsplash.jpg&image=https%3A%2F%2Fi.ibb.co%2FwFpPDbqz%2Ftom-briskey-HM3-WZ4-B1gv-M-unsplash.jpg&image=https%3A%2F%2Fimages.pexels.com%2Fphotos%2F4245826%2Fpexels-photo-4245826.jpeg%3Fauto%3Dcompress%26cs%3Dtinysrgb%26w%3D600&animationType=slide&autoPlay=true&radioButtonType=circle&radioButtonSize=60&radioButtonGap=24&arrowsType=arrow-circle&arrowsBackground=visible&arrowsBackgroundVisibility=212&arrowsSize=50&arrowsOffset=1&arrowsColor=%23fff" style="border: none; justify-content: center;"
  align="center" width="100%" height="500px"
  allowfullscreen></iframe>

<main class="my-2">
  <h3 class="mx-2 text-center">Featured Posts</h3>
  <?php
  $base_link = ROOT . "/index.php?url=home";
  $PAGE = get_pagination($base_link);

  $limit = 6;
  $offset = ($PAGE['current_page_number'] - 1) * $limit;
  $query = "SELECT p.id,p.title,p.content,p.date,p.image,c.category, u.username 
      FROM posts p
      INNER JOIN categories c
      ON p.category_id = c.id 
      INNER JOIN users u
      ON p.user_id = u.id 
      ORDER BY p.id limit $limit offset $offset";
  $posts = querry_db($query);
  if ($posts) {
    foreach ($posts as $post) {
      require __DIR__ .  '../includes/post-card.php';
    }
  } else {
    echo "No items found!";
  }

  //subscription using email address
  $subscribe_success = false;
  $subscribe_error   = '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subscribe_submit'])) {

    $email = trim($_POST['subscribe_email'] ?? '');

    if ($email === '') {
      $subscribe_error = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $subscribe_error = "Invalid email format.";
    } else {
      // check if already subscribed
      $exists = querry_db(
        "SELECT id FROM subscribers WHERE email = :email LIMIT 1",
        ['email' => $email]
      );

      if ($exists) {
        $subscribe_error = "You are already subscribed.";
      } else {
        querry_db(
          "INSERT INTO subscribers (email) VALUES (:email)",
          ['email' => $email]
        );
        $subscribe_success = true;
      }
    }
  }
  ?>
</main>
<div class="col-md-12 mb-3 d-flex justify-content-center">
  <a href="<?= $PAGE['first_page_link'] ?>">
    <button type="button" class="btn btn-primary mx-4">First Page</button>
  </a>
  <a href="<?= $PAGE['prev_page_link'] ?>">
    <button type="button" class="btn btn-primary mx-4">Previous Page</button>
  </a>
  <a href="<?= $PAGE['next_page_link'] ?>">
    <button type="button" class="btn btn-primary mx-4">Next Page</button>
  </a>
</div>
<?php require_once __DIR__ .  '../includes/footer.php' ?>