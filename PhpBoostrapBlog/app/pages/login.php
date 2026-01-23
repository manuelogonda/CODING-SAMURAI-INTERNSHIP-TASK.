<?php
if (!empty($_POST)) {
  //The easy way to validate is to negate things
  $errors = [];
  $select_query = "SELECT * FROM users WHERE email = :email LIMIT 1";
  $user = querry_db($select_query, ['email' => $_POST['email']]);
  if (!empty($user)) {
    $data = [];
    $data['email'] = $_POST['email'];
    $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (password_verify($_POST['password'], $user[0]['password'])) {
      //login successful
      authenticate($user[0]);
      redirect('admin');
      die();
    } else {
      $errors['password'] = "Invalid email or password.";
    }
  } else {
    $errors['email'] = "Invalid email or password.";
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <title>Login . <?= APP_NAME ?></title>

  <!-- Bootstrap core CSS -->
  <link href="<?= ROOT; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="<?= ROOT; ?>/css/signin.css" rel="stylesheet">
</head>

<body class="text-center">

  <main class="form-signin">
    <form method="post">
      <a href="index.php?url=home">
        <img class="mb-4 rounded-circle shadow" src="<?= ROOT; ?>/images/biemdoubleyulogo.jpg" alt="a work station" width="192" height="177" style="object-fit: cover;">
      </a>
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
      <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">Wrong email or password.</div>
      <?php endif; ?>

      <div class="form-floating">
        <input value="<?= old_value('email') ?>" name="email" type="email" class="form-control my-2" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
      </div>

      <div class="form-floating">
        <input value="<?= old_value('password') ?>" name="password" type="password" class="form-control my-2" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>

      <div class="my-2">Don't have an account? <a href="<?= ROOT; ?>/index.php?url=signup">Signup Here</a></div>
      <div class="checkbox mb-3">
        <label>
          <input value="<?= old_checked('remember') ?>" name="remember" type="checkbox" value="remember-me"> Remember me
        </label>
      </div>

      <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; <?= date("Y") ?></p>
    </form>
  </main>

</body>

</html>