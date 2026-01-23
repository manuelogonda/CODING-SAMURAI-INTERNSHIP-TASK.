<?php

if ($action == "add") {
if (!empty($_POST)) {
    $errors = [];

    // category
    if (empty($_POST['category'])) {
      $errors['category'] = "Category is required.";
    }

    // slug
    if (empty($_POST['slug'])) {
      $errors['slug'] = "Slug is required.";
    } elseif (!preg_match('/^[a-z0-9-]+$/', $_POST['slug'])) {
      $errors['slug'] = "Slug may contain only lowercase letters, numbers and hyphens.";
    }

    // disabled
    if (!isset($_POST['disabled']) || !in_array($_POST['disabled'], ['0','1'], true)) {
      $errors['disabled'] = "Invalid status.";
    }

    if (empty($errors)) {
      $data = [
        'category' => $_POST['category'],
        'slug'     => $_POST['slug'],
        'disabled' => $_POST['disabled'],
      ];

      $insert_query = "INSERT INTO categories (category, slug, disabled)
                       VALUES (:category, :slug, :disabled)";
      querry_db($insert_query, $data);

      redirect(ROOT . '/admin/categories');
    }
  }

 

} elseif ($action == "edit") {

  $edit_query = "SELECT * FROM categories WHERE id = :id LIMIT 1";
  $category = querry__row($edit_query, ['id' => $id]);

  if (!empty($_POST)) {
    $errors = [];

    // category
    if (empty($_POST['category'])) {
      $errors['category'] = "Category is required.";
    }

    // slug
    if (empty($_POST['slug'])) {
      $errors['slug'] = "Slug is required.";
    } elseif (!preg_match('/^[a-z0-9-]+$/', $_POST['slug'])) {
      $errors['slug'] = "Slug may contain only lowercase letters, numbers and hyphens.";
    }

    // disabled
    if (!isset($_POST['disabled']) || !in_array($_POST['disabled'], ['0','1'], true)) {
      $errors['disabled'] = "Invalid status.";
    }

    if (empty($errors)) {
      $data = [
        'category' => $_POST['category'],
        'slug'     => $_POST['slug'],
        'disabled' => $_POST['disabled'],
        'id'       => $id,
      ];

      $update_query = "UPDATE categories
                       SET category = :category, slug = :slug, disabled = :disabled
                       WHERE id = :id";
      querry_db($update_query, $data);

      redirect(ROOT . '/admin/categories');
    }
  }

} elseif ($action == "delete") {

  $select_query = "SELECT * FROM categories WHERE id = :id LIMIT 1";
  $category = querry__row($select_query, ['id' => $id]);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = ['id' => $id];

    $delete_query = "DELETE FROM categories WHERE id = :id LIMIT 1";
    querry_db($delete_query, $data);

    redirect(ROOT . '/admin/categories');
  }
}