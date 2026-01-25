<?php
if ($action == "add") {

  // add new post logic
  if (!empty($_POST)) {
    $errors = [];

    // title validation
    if (empty($_POST['title'])) {
      $errors['title'] = "Title is required.";
    } elseif (strlen($_POST['title']) < 4) {
      $errors['title'] = "Title must be at least 4 characters.";
    }

    // category validation (category_id from a select)
    if (empty($_POST['category_id'])) {
      $errors['category_id'] = "Category is required.";
    } elseif (!filter_var($_POST['category_id'], FILTER_VALIDATE_INT)) {
      $errors['category_id'] = "Invalid category selected.";
    }

    // content/body validation
    if (empty($_POST['content'])) {
      $errors['content'] = "Content is required.";
    } elseif (strlen($_POST['content']) < 20) {
      $errors['content'] = "Content must be at least 20 characters.";
    }

    // author/user_id (usually from logged-in user)
    if (empty($_POST['user_id'])) {
      $errors['user_id'] = "Author is required.";
    } elseif (!filter_var($_POST['user_id'], FILTER_VALIDATE_INT)) {
      $errors['user_id'] = "Invalid author.";
    }

     //image validation 
     $destination = null;
     $filename = null;
      //  var_dump($_FILES['image']); exit;

    if (!empty($_FILES['image']['name'])) {
      $allowed_types = ['image/jpeg', 'image/png', 'image/webp', 'image/gif', 'image/jpg'];

      if (in_array($_FILES['image']['type'], $allowed_types)) {

        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = 'post_' . time() . '_' . rand(1000, 9999) . '.' . $ext;

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
    if (empty($errors)) {
      $data = [];
      $data['title']       = $_POST['title'];
      $data['category_id'] = $_POST['category_id'];
      $data['user_id']     = $_POST['user_id'];
      $data['content']     = $_POST['content'];
      $data['image']     = $destination;

      $insert_query = "INSERT INTO posts (title, category_id, user_id, content, image)
        VALUES (:title, :category_id, :user_id, :content, :image)
      ";
      querry_db($insert_query, $data);

      redirect(ROOT . '/admin/posts');
      
    
    }
  }

} elseif ($action == "edit") {

  // edit post logic
  $edit_query = "SELECT * FROM posts WHERE id = :id LIMIT 1";
  $post = querry__row($edit_query, ['id' => $id]);

  if (!empty($_POST)) {
    if ($post) {
      $errors = [];

      // title validation
      if (empty($_POST['title'])) {
        $errors['title'] = "Title is required.";
      } elseif (strlen($_POST['title']) < 4) {
        $errors['title'] = "Title must be at least 4 characters.";
      }

      // category validation
      if (empty($_POST['category_id'])) {
        $errors['category_id'] = "Category is required.";
      } elseif (!filter_var($_POST['category_id'], FILTER_VALIDATE_INT)) {
        $errors['category_id'] = "Invalid category selected.";
      }

      // content/body validation
      if (empty($_POST['content'])) {
        $errors['content'] = "Content is required.";
      } elseif (strlen($_POST['content']) < 20) {
        $errors['content'] = "Content must be at least 20 characters.";
      }

      // author/user_id (can be fixed to current user, or editable)
      if (empty($_POST['user_id'])) {
        $errors['user_id'] = "Author is required.";
      } elseif (!filter_var($_POST['user_id'], FILTER_VALIDATE_INT)) {
        $errors['user_id'] = "Invalid author.";
      }

      // validate image
      $destination = $post['image'] ?? null;
       $filename = null;

    if (!empty($_FILES['image']['name'])) {
      $allowed_types = ['image/jpeg', 'image/png', 'image/webp', 'image/gif', 'image/jpg'];

      if (in_array($_FILES['image']['type'], $allowed_types)) {

        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = 'post_' . time() . '_' . rand(1000, 9999) . '.' . $ext;

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
        $data = [];
        $data['title']       = $_POST['title'];
        $data['category_id'] = $_POST['category_id'];
        $data['user_id']     = $_POST['user_id'];
        $data['content']     = $_POST['content'];
        $data['image']       = $destination;
        $data['id']          = $id;

        $update_query = "UPDATE posts
               SET title = :title,
              category_id = :category_id,
              user_id = :user_id,
              image = :image,
              content = :content
          WHERE id = :id
        ";
        querry_db($update_query, $data);

        redirect(ROOT . '/admin/posts');
      }
    }
  }

} elseif ($action == "delete") {

  $select_query = "SELECT * FROM posts WHERE id = :id LIMIT 1";
  $post = querry__row($select_query, ['id' => $id]);

  if ($_SERVER['REQUEST_METHOD'] ==='POST') 
    {
        $data = ['id' => $id];
        $delete_query = "DELETE FROM posts WHERE id = :id LIMIT 1";
        querry_db($delete_query, $data);

        redirect(ROOT . '/admin/posts');
    }
}
