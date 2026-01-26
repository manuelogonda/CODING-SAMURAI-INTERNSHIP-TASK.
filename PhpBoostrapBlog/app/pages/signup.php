<?php
if(!empty($_POST)){
  //The easy way to validate is to negate things
  // Process signup logic here and validate inputs
  $errors = [];
  //username validation
  if(empty($_POST['username'])){
    $errors['username'] = "Username is required.";
  }elseif(strlen($_POST['username']) < 4){
    $errors['username'] = "Username must be at least 4 characters.";
  }elseif(!preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])){
    $errors['username'] = "Username must not contain spaces.";
  }
  //check if email already exists
  $email_check_query = "SELECT id FROM users WHERE email = :email LIMIT 1";
  $email_exists = querry_db($email_check_query, ['email' => $_POST['email']]);
  if(empty($_POST['email'])){
    $errors['email'] = "Email is required.";
  }elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $errors['email'] = "Invalid email format.";
  }elseif($email_exists){
    $errors['email'] = "Email is already registered,take another.";
  }
  //password validation
  if(empty($_POST['password'])){
    $errors['password'] = "Password is required.";
  }elseif(strlen($_POST['password']) < 6){
    $errors['password'] = "Password must be at least 6 characters.";
  }elseif($_POST['password'] !== $_POST['retype_password']){
    $errors['retype_password'] = "Passwords do not match.";
  }
  if(empty($_POST['retype_password'])){
    $errors['retype_password'] = "Please retype your password.";
  }
  //terms and conditions
  if(empty($_POST['terms'])){
    $errors['terms'] = "You must accept the terms and conditions.";
  }


  if(empty($errors)){
    //save to database
    $data = [];
    $data['username'] = $_POST['username'];
    $data['email'] = $_POST['email'];
    $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $data['role'] = 'user';

    $insert_query = "INSERT INTO users (username, email, password, role) 
    VALUES (:username, :email, :password, :role)";
    querry_db($insert_query, $data);
    //echo "Account created successfully.";
    redirect('login');
}

}
  
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Signup . <?= APP_NAME ?></title>

    <!-- Bootstrap core CSS -->
<link href="<?= ROOT;?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">

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
    <link href="<?= ROOT;?>/css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form method="post">
    <a href="home">
    <img class="mb-4 rounded-circle shadow" src="<?= ROOT;?>/images/manulogo.png" alt="my logo" width="190" height="170" style="object-fit: cover;">
    </a>
    <h1 class="h3 mb-3 fw-normal">Create Account</h1>

  <?php if(!empty($errors)): ?>
    <div class="alert alert-danger">Please fix the errors below.</div>
  <?php endif; ?>

    <div class="form-floating">
      <input value="<?= old_value('username') ?>" name="username" type="text" class="form-control my-2" id="floatingInput" placeholder="Daniel123">
      <label for="floatingInput">Username</label>
    </div>
     <?php if(!empty($errors['username'])): ?>
       <div class="text text-danger"><?= $errors['username'] ?></div>
    <?php endif; ?>
    <div class="form-floating">
      <input value="<?= old_value('email') ?>" name="email" type="email" class="form-control my-2" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
     <?php if(!empty($errors['email'])): ?>
       <div class="text text-danger"><?= $errors['email'] ?></div>
    <?php endif; ?>
    <div class="form-floating">
      <input value="<?= old_value('password') ?>" name="password" type="password" class="form-control my-2" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
      <?php if(!empty($errors['password'])): ?>
        <div class="text text-danger"><?= $errors['password'] ?></div>
    <?php endif; ?>
    <div class="form-floating">
      <input value="<?= old_value('retype_password') ?>" name="retype_password" type="password" class="form-control my-2" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Retype Password</label>
    </div>
     <?php if(!empty($errors['retype_password'])): ?>
       <div class="text text-danger"><?= $errors['retype_password'] ?></div>
    <?php endif; ?>
    <div class="my-2">Already have an account? <a href="<?= ROOT;?>/index.php?url=login">Login Here</a></div>

    <div class="checkbox mb-3">
      <label>
        <input <?= old_checked('terms') ?> name="terms" type="checkbox" value="remember-me"> Accept Terms & Conditions
      </label>
    </div>
     <?php if(!empty($errors['terms'])): ?>
    <div class="text text-danger"><?= $errors['terms'] ?></div>
  <?php endif; ?>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Create Account</button>
    <p class="mt-5 mb-3 text-muted">&copy; <?= date("Y") ?></p>
  </form>
</main>
</body>
</html>
