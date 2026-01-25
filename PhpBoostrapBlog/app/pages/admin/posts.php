<?php if ($action == 'add'): ?>

  <div class="col-md-8 mx-auto mb-4">
    <form method="post" enctype="multipart/form-data">
      <h1 class="h3 mb-3 fw-normal">Add Post</h1>

      <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">Please fix the errors below.</div>
      <?php endif; ?>

      <div class="my-2">
        <label>
          <img src="<?= isset($post['image']) ? get_image($post['image']) : get_image('') ?>" 
               alt="Post Image" 
               class="mx-auto d-block image-preview-edit" 
               style="width: 300px; cursor: pointer; height: 300px; object-fit: cover;"
          >
          <input onchange="display_image_edit(this.files[0])" type="file" name="image" class="d-none">
        </label>
        <script>
          function display_image_edit(file) {
            document.querySelector('.image-preview-edit').src = URL.createObjectURL(file);
          }
        </script>
      </div>

      <div class="form-floating">
        <input value="<?= old_value('user_id') ?>" name="user_id" type="number"
               class="form-control my-2" id="addUserid" placeholder="Userid">
        <label for="Userid">UserID</label>
      </div>
      <?php if (!empty($errors['user_id'])): ?>
        <div class="text text-danger"><?= $errors['user_id'] ?></div>
      <?php endif; ?>

      <div class="form-floating">
        <input value="<?= old_value('category_id') ?>" name="category_id" type="number"
               class="form-control my-2" id="addCategory" placeholder="Post category id">
        <label for="addCategory">CategoryID</label>
      </div>
      <?php if (!empty($errors['category_id'])): ?>
        <div class="text text-danger"><?= $errors['category_id'] ?></div>
      <?php endif; ?>

      <div class="form-floating">
        <input value="<?= old_value('title') ?>" name="title" type="text"
               class="form-control my-2" id="addTitle" placeholder="Post title">
        <label for="addTitle">Title</label>
      </div>
      <?php if (!empty($errors['title'])): ?>
        <div class="text text-danger"><?= $errors['title'] ?></div>
      <?php endif; ?>

      <div class="form-floating">
        <textarea name="content" class="form-control my-2" id="addContent"
                  style="height: 150px;"
                  placeholder="Write your post here..."><?= old_value('content') ?></textarea>
        <label for="addContent">Content</label>
      </div>
      <?php if (!empty($errors['content'])): ?>
        <div class="text text-danger"><?= $errors['content'] ?></div>
      <?php endif; ?>

      <button class="btn btn-lg btn-primary mx-2 w-70" type="submit">Save Post</button>
      <a href="<?= ROOT ?>/index.php?url=admin/posts">
        <button type="button" class="btn btn-lg btn-secondary mx-2 w-70">Cancel</button>
      </a>
    </form>
  </div>

<?php elseif ($action == 'edit'): ?>

  <div class="col-md-8 mx-auto mb-4">
    <form method="post" enctype="multipart/form-data">
      <h1 class="h3 mb-3 fw-normal">Edit Post</h1>

      <?php if (!empty($post)): ?>
        <?php if (!empty($errors)): ?>
          <div class="alert alert-danger">Please fix the errors below.</div>
        <?php endif; ?>

         <div class="my-2">
          <label>
            <img src="<?= get_image($post['image']) ?>" 
                 alt="Post Image" 
                 class="mx-auto d-block image-preview-edit" 
                 style="width: 100%; cursor: pointer; height: 150px; object-fit: cover;">
            <input onchange="display_image_edit(this.files[0])" type="file" name="image" class="d-none">
          </label>
          <script>
            function display_image_edit(file) {
              document.querySelector('.image-preview-edit').src = URL.createObjectURL(file);
            }
          </script>
        </div>

        <div class="form-floating">
          <input value="<?= old_value('title', $post['title']) ?>" name="title"
                 type="text" class="form-control my-2" id="editTitle"
                 placeholder="Post title">
          <label for="editTitle">Title</label>
        </div>
        <?php if (!empty($errors['title'])): ?>
          <div class="text text-danger"><?= $errors['title'] ?></div>
        <?php endif; ?>

        <!-- user_id -->
       <div class="form-floating">
          <input value="<?= old_value('user_id', $post['user_id']) ?>" name="user_id"
                 type="number" class="form-control my-2" id="editUserId"
                 placeholder="User ID">
          <label for="editUserId">User ID</label>
        </div>
        <?php if (!empty($errors['user_id'])): ?>
          <div class="text text-danger"><?= $errors['user_id'] ?></div>
        <?php endif; ?>

        <!-- category_id -->
         <div class="form-floating">
          <input value="<?= old_value('user_id', $post['category_id']) ?>" name="category_id"
                 type="number" class="form-control my-2" id="editCategoryId"
                 placeholder="Post Category ID">
          <label for="editCategoryId">Category ID</label>
        </div>
        <?php if (!empty($errors['category_id'])): ?>
          <div class="text text-danger"><?= $errors['category_id'] ?></div>
        <?php endif; ?>


        <div class="form-floating">
          <textarea name="content" class="form-control my-2" id="editContent"
                    style="height: 150px;"
                    placeholder="Write your post here..."><?= old_value('content', $post['content']) ?></textarea>
          <label for="editContent">Content</label>
        </div>
        <?php if (!empty($errors['content'])): ?>
          <div class="text text-danger"><?= $errors['content'] ?></div>
        <?php endif; ?>

        <button class="btn btn-lg btn-primary mx-2 w-70" type="submit">Save</button>
        <a href="<?= ROOT ?>/index.php?url=admin/posts">
          <button type="button" class="btn btn-lg btn-secondary mx-2 w-70">Cancel</button>
        </a>

      <?php else: ?>
        <div class="alert alert-danger text-center">Post not found.</div>
      <?php endif; ?>
    </form>
  </div>

<?php elseif ($action == 'delete'): ?>

  <div class="col-md-6 mx-auto">
    <form method="post" action="<?= ROOT ?>/admin/posts/delete/<?= $post['id']; ?>">
      <h1 class="h3 mb-3 fw-normal">Delete Post</h1>

      <?php if (!empty($post)): ?>

        <p>Are you sure you want to delete this post?</p>

        <div class="form-floating">
          <input value="<?= htmlspecialchars($post['title']) ?>" type="text"
                 class="form-control my-2" id="deleteTitle" disabled>
          <label for="deleteTitle">Title</label>
        </div>

        <button class="btn btn-lg btn-danger mx-2 w-70" type="submit"
                onclick="return confirm('Are you sure you want to delete this post?');">
          Delete
        </button>
        <a href="<?= ROOT ?>/index.php?url=admin/posts">
          <button type="button" class="btn btn-lg btn-secondary mx-2 w-70">Cancel</button>
        </a>

      <?php else: ?>
        <div class="alert alert-danger text-center">Post not found.</div>
      <?php endif; ?>
    </form>
  </div>
<?php else: ?>
<h2>My Posts 
  <a href="<?= ROOT ?>/index.php?url=admin/posts/add">
    <button class="btn btn-primary">Add Post</button>
  </a>
</h2>
<table class="table">
  <thead class="table-dark">
      
    <tr>
      <th>#</th>
      <th>User_ID</th>
      <th>Category_ID</th>
      <th>TItle</th>
      <th>Content</th>
      <th>Date</th>
      <th>Image Posted</th>
      <th>Actions</th>
    </tr>
    <?php
    if($action == 'view'){
    $limit = 6;
    $offset = ($PAGE['current_page_number'] - 1) * $limit;
    $selectPosts = "SELECT p.id,p.user_id,p.category_id,p.title,p.content,p.image,p.date
      FROM posts p
      limit $limit offset $offset
      ";
    $posts = querry_db($selectPosts);
    }
    ?>
     <?php if(empty($posts)): ?>
      <tr><td colspan='6'>No posts found.</td></tr>;
    <?php else: ?> 
  </thead>
  <tbody>
    <?php foreach ($posts as $post): ?>
      <tr>
        <td><?= $post['id']; ?></td>
        <td><?= esc($post['user_id']); ?></td>
        <td><?= esc($post['category_id']); ?></td>
        <td><?= esc($post['title']); ?></td>
        <td><?= esc($post['content']); ?></td>
        <td><?= esc(date("jS M, Y", strtotime($post['date'])))  ?></td>
        <td>
              <img src="<?= get_image($post['image']) ?>" style="width: 100px; height: 100px; object-fit: cover; d-block;" alt="Post Image">
        </td>
        <td>
          <a href="<?= ROOT; ?>/index.php?url=admin/posts/edit/<?= $post['id']; ?>" class="btn btn-sm btn-warning text-white btn-small">
            <i class="bi bi-pencil-square"></i>
          </a> 
          <br> <br>
          <a href="<?= ROOT; ?>/index.php?url=admin/posts/delete/<?= $post['id']; ?>"
          class="btn btn-sm btn-danger text-white btn-small" 
          onclick="return confirm('Are you sure you want to delete this post?');">
          <i class="bi bi-trash"></i>
          </a>
        </td>
      </tr>
    <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>

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
  </div>

<?php endif; ?>