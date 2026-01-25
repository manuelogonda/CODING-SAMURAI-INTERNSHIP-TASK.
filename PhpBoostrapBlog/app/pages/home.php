<?php require_once __DIR__ . '/includes/header.php' ?>
  <!-- slider -->
<iframe src="https://imageslidergenerator.shahmirfaisal.com/slider?image=https%3A%2F%2Fi.ibb.co%2FFkGQdzmq%2Ffotis-fotopoulos-6s-Al6a-Q4-OWI-unsplash.jpg&image=https%3A%2F%2Fi.ibb.co%2F7tnMntts%2Fmyke-simon-ats-Uq-Im3wxo-unsplash.jpg&image=https%3A%2F%2Fi.ibb.co%2F1GCbN18v%2Fvictor-freitas-q-Z-U9z4-TQ6-A-unsplash.jpg&image=https%3A%2F%2Fi.ibb.co%2FwFpPDbqz%2Ftom-briskey-HM3-WZ4-B1gv-M-unsplash.jpg&image=https%3A%2F%2Fimages.pexels.com%2Fphotos%2F4245826%2Fpexels-photo-4245826.jpeg%3Fauto%3Dcompress%26cs%3Dtinysrgb%26w%3D600&animationType=slide&autoPlay=true&radioButtonType=circle&radioButtonSize=60&radioButtonGap=24&arrowsType=arrow-circle&arrowsBackground=visible&arrowsBackgroundVisibility=212&arrowsSize=50&arrowsOffset=1&arrowsColor=%23fff" style="border: none; justify-content: center;"
      align="center" width="100%" height="500px"
        allowfullscreen

    ></iframe>

    <main class="my-2">
        <h3 class="mx-2">Featured Posts</h3>
        <?php 
        $query = "SELECT p.id,p.title,p.content,p.date,p.image,c.category, u.username 
      FROM posts p
      INNER JOIN categories c
      ON p.category_id = c.id 
      INNER JOIN users u
      ON p.user_id = u.id 
      ORDER BY p.id limit 4";
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
<?php require_once __DIR__ .  '../includes/footer.php' ?>



  
          
          