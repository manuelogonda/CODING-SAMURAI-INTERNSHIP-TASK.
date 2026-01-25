<?php
// app/pages/contact.php

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name    = trim($_POST['name']    ?? '');
    $email   = trim($_POST['email']   ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // basic validation
    if ($name === '') {
        $errors['name'] = "Name is required.";
    }

    if ($email === '') {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    if ($subject === '') {
        $errors['subject'] = "Subject is required.";
    }

    if ($message === '') {
        $errors['message'] = "Message is required.";
    }

    if (empty($errors)) {
        $data = [
        'name'    => $name,
        'email'   => $email,
        'subject' => $subject,
        'message' => $message,
    ];
        $insert = "
      INSERT INTO contacts (name, email, subject, message)
      VALUES (:name, :email, :subject, :message)
    ";
    querry_db($insert, $data);

        $success = true;
        redirect(ROOT . '/index.php?url=home');
    }
}

function old_value_contact($key)
{
    return htmlspecialchars($_POST[$key] ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Contact Me . <?= APP_NAME ?></title>

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
<div class="container my-5">
  <div class="row">
    <div class="col-md-8 mx-auto">

      <h1 class="mb-4">Contact Me</h1>

      <?php if ($success): ?>
        <div class="alert alert-success">
          Thank you for your message. We will get back to you soon.
        </div>
      <?php endif; ?>

      <?php if (!empty($errors) && !$success): ?>
        <div class="alert alert-danger">
          Please fix the errors below.
        </div>
      <?php endif; ?>

      <form method="post">
        <div class="form-floating mb-3">
          <input
            type="text"
            class="form-control"
            id="contactName"
            name="name"
            placeholder="Your name"
            value="<?= old_value_contact('name') ?>"
          >
          <label for="contactName">Name</label>
        </div>
        <?php if (!empty($errors['name'])): ?>
          <div class="text-danger mb-2"><?= $errors['name'] ?></div>
        <?php endif; ?>

        <div class="form-floating mb-3">
          <input
            type="email"
            class="form-control"
            id="contactEmail"
            name="email"
            placeholder="name@example.com"
            value="<?= old_value_contact('email') ?>"
          >
          <label for="contactEmail">Email</label>
        </div>
        <?php if (!empty($errors['email'])): ?>
          <div class="text-danger mb-2"><?= $errors['email'] ?></div>
        <?php endif; ?>

        <div class="form-floating mb-3">
          <input
            type="text"
            class="form-control"
            id="contactSubject"
            name="subject"
            placeholder="Subject"
            value="<?= old_value_contact('subject') ?>"
          >
          <label for="contactSubject">Subject</label>
        </div>
        <?php if (!empty($errors['subject'])): ?>
          <div class="text-danger mb-2"><?= $errors['subject'] ?></div>
        <?php endif; ?>

        <div class="form-floating mb-3">
          <textarea
            class="form-control"
            id="contactMessage"
            name="message"
            style="height: 150px;"
            placeholder="Your message..."
          ><?= old_value_contact('message') ?></textarea>
          <label for="contactMessage">Message</label>
        </div>
        <?php if (!empty($errors['message'])): ?>
          <div class="text-danger mb-2"><?= $errors['message'] ?></div>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary">Send Message</button>
      </form>

    </div>
  </div>
  </body>
</html>