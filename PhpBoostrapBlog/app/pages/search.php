<?php
$limit  = $PAGE['limit'];
$offset = $PAGE['offset'];

$term  = $_POST['find'] ?? '';    
$posts = [];

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
      ORDER BY p.id DESC
      LIMIT $limit OFFSET $offset
    ";

    $posts = querry_db($sql, ['find' => $like]);
}
?>