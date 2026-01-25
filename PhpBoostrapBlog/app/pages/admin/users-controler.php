<?php

if ($action == "add") {

  // add new user logic
  if (!empty($_POST)) {

    $errors = [];

    // username validation
    if (empty($_POST['username'])) {
      $errors['username'] = "Username is required.";
    } elseif (strlen($_POST['username']) < 4) {
      $errors['username'] = "Username must be at least 4 characters.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
      $errors['username'] = "Username must not contain spaces.";
    }

    // check if email already exists
    $email_check_query = "SELECT id FROM users WHERE email = :email LIMIT 1";
    $email_exists = querry_db($email_check_query, ['email' => $_POST['email']]);

    if (empty($_POST['email'])) {
      $errors['email'] = "Email is required.";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "Invalid email format.";
    } elseif ($email_exists) {
      $errors['email'] = "Email is already registered,take another.";
    }

    // password validation
    if (empty($_POST['password'])) {
      $errors['password'] = "Password is required.";
    } elseif (strlen($_POST['password']) < 6) {
      $errors['password'] = "Password must be at least 6 characters.";
    } elseif ($_POST['password'] !== $_POST['retype_password']) {
      $errors['retype_password'] = "Passwords do not match.";
    }

    if (empty($_POST['retype_password'])) {
      $errors['retype_password'] = "Please retype your password.";
    }

    // image validation
    $destination = $user['image'] ?? null;
       $filename = null;

    if (!empty($_FILES['image']['name'])) {
      $allowed_types = ['image/jpeg', 'image/png', 'image/webp', 'image/gif', 'image/jpg'];

      if (in_array($_FILES['image']['type'], $allowed_types)) {

        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = 'user_' . time() . '_' . rand(1000, 9999) . '.' . $ext;

        $destination_dir = BASE_PATH . '/public/assets/images/';
        $destination_path = $destination_dir . $filename;

        if (!is_dir($destination_dir)) {
          mkdir($destination_dir, 0777, true);
        }

        if (move_uploaded_file($_FILES['image']['tmp_name'], $destination_path)) {
          $destination = $filename;
        } else {
          $errors['image'] = "Failed to upload image.";
        }
      } else {
        $errors['image'] = "Image format not supported, please upload jpg, jpeg, png, webp or gif.";
      }
    }
     

    if (empty($errors)) {
      // save to database
      $data = [];
      $data['username'] = $_POST['username'];
      $data['email'] = $_POST['email'];
      $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $data['role'] = 'user';
      $data['image'] = $destination;

      $insert_query = "INSERT INTO users (username, email, password, image, role) 
                       VALUES (:username, :email, :password, :image, :role)";
      querry_db($insert_query, $data);

      redirect(ROOT . '/admin/users');
    }
  }

} elseif ($action == "edit") {

  // edit user logic
  $edit_query = "SELECT * FROM users WHERE id = :id LIMIT 1";
  $user = querry__row($edit_query, ['id' => $id]);

  if (!empty($_POST)) {
    if ($user) {

      $errors = [];

      // username validation
      if (empty($_POST['username'])) {
        $errors['username'] = "Username is required.";
      } elseif (strlen($_POST['username']) < 4) {
        $errors['username'] = "Username must be at least 4 characters.";
      } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
        $errors['username'] = "Username must not contain spaces.";
      }

      // check if email already exists
      $email_check_query = "SELECT id FROM users WHERE email = :email AND id != :id LIMIT 1";
      $email_exists = querry_db($email_check_query, ['email' => $_POST['email'], 'id' => $id]);

      if (empty($_POST['email'])) {
        $errors['email'] = "Email is required.";
      } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
      } elseif ($email_exists) {
        $errors['email'] = "Email is already registered,take another.";
      }

      // password validation
      if (!empty($_POST['password']) || !empty($_POST['retype_password'])) {
        if (empty($_POST['password'])) {
          $errors['password'] = "Password is required.";
        } elseif (strlen($_POST['password']) < 6) {
          $errors['password'] = "Password must be at least 6 characters.";
        } elseif ($_POST['password'] !== $_POST['retype_password']) {
          $errors['retype_password'] = "Passwords do not match.";
        }

        if (empty($_POST['retype_password'])) {
          $errors['retype_password'] = "Please retype your password.";
        }
      }

      // validate image
      $destination = $user['image'] ?? null;
       $filename = null;

    if (!empty($_FILES['image']['name'])) {
      $allowed_types = ['image/jpeg', 'image/png', 'image/webp', 'image/gif', 'image/jpg'];

      if (in_array($_FILES['image']['type'], $allowed_types)) {

        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = 'user_' . time() . '_' . rand(1000, 9999) . '.' . $ext;

        $destination_dir = BASE_PATH . '/public/assets/images/';
        $destination_path = $destination_dir . $filename;

        if (!is_dir($destination_dir)) {
          mkdir($destination_dir, 0777, true);
        }

        if (move_uploaded_file($_FILES['image']['tmp_name'], $destination_path)) {
          $destination = $filename;
        } else {
          $errors['image'] = "Failed to upload image.";
        }
      } else {
        $errors['image'] = "Image format not supported, please upload jpg, jpeg, png, webp or gif.";
      }
    }
      // when saving
       $data['image'] = $filename;
      

      if (empty($errors)) {
        // save to database
        $data = [];
        $data['username'] = $_POST['username'];
        $data['password'] = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $data['image'] = $destination;
        $data['email'] = $_POST['email'];
        $data['role'] = $user['role'];
        $data['id'] = $id;

        $update_query = "UPDATE users 
                           SET username = :username, 
                           email = :email, image = :image, 
                           password = :password, role = :role 
                           WHERE id = :id";

        querry_db($update_query, $data);

        redirect(ROOT . '/admin/users');
      }
    }
  }

} elseif ($action == "delete") {

           
  $select_query = "SELECT * FROM users WHERE id = :id LIMIT 1";
  $user = querry__row($select_query, ['id' => $id]);

  if (!$user) {
    redirect(ROOT . '/admin/users');
    exit;
  }

  var_dump($_POST, $user);
          
   
  // delete user logic
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [];
        $data['id'] = $id;

        $delete_query = "DELETE FROM users WHERE id = :id LIMIT 1";
        querry_db($delete_query, $data);
        redirect(ROOT . '/admin/users');
        exit();
      }
}

