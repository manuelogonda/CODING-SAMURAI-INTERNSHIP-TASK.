<?php require_once __DIR__ . '/includes/header.php' ?>
 

    <main class="my-2">
        <h3 class="mx-2" class="jutify-content-center" >Featured Blogs</h3>
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
        if($posts){
          foreach($posts as $post){
           require __DIR__ .  '../includes/post-card.php';
           }
        }else{
          echo "No items found!";
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