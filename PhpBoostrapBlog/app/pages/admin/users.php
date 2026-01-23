<?php if ($action == 'add'): ?>
  <div class="col-md-6 mx-auto mb-4">
    <form method="post" enctype="multipart/form-data">

      <h1 class="h3 mb-3 fw-normal">Create Account</h1>

      <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">Please fix the errors below.</div>
      <?php endif; ?>

      <div class="my-2">
        <label>
          <img src="<?= isset($user['image']) ? get_image($user['image']) : get_image('') ?>" 
               alt="User Image" 
               class="mx-auto d-block image-preview-edit" 
               style="width: 150px; cursor: pointer; height: 150px; object-fit: cover;"
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
        <input value="<?= old_value('username') ?>" name="username" type="text" class="form-control my-2" id="addUsername" placeholder="Daniel123">
        <label for="addUsername">Username</label>
      </div>
      <?php if (!empty($errors['username'])): ?>
        <div class="text text-danger"><?= $errors['username'] ?></div>
      <?php endif; ?>

      <div class="form-floating">
        <input value="<?= old_value('email') ?>" name="email" type="email" class="form-control my-2" id="addEmail" placeholder="name@example.com">
        <label for="addEmail">Email address</label>
      </div>
      <?php if (!empty($errors['email'])): ?>
        <div class="text text-danger"><?= $errors['email'] ?></div>
      <?php endif; ?>

      <div class="form-floating">
        <input value="<?= old_value('password') ?>" name="password" type="password" class="form-control my-2" id="addPassword" placeholder="Password">
        <label for="addPassword">Password</label>
      </div>
      <?php if (!empty($errors['password'])): ?>
        <div class="text text-danger"><?= $errors['password'] ?></div>
      <?php endif; ?>

      <div class="form-floating">
        <input value="<?= old_value('retype_password') ?>" name="retype_password" type="password" class="form-control my-2" id="addRetypePassword" placeholder="Password">
        <label for="addRetypePassword">Retype Password</label>
      </div>
      <?php if (!empty($errors['retype_password'])): ?>
        <div class="text text-danger"><?= $errors['retype_password'] ?></div>
      <?php endif; ?>

      <button class="btn btn-lg btn-primary mx-2 w-70" type="submit">Create Account</button>
      <a href="<?= ROOT ?>/index.php?url=admin/users">
        <button type="button" class="btn btn-lg btn-secondary mx-2 w-70" type="button">Cancel</button>
      </a>

    </form>
  </div>

<?php elseif ($action == 'edit'): ?>

  <div class="col-md-6 mx-auto">
    <form method="post" enctype="multipart/form-data">
      <h1 class="h3 mb-3 fw-normal">Edit Account</h1>

      <?php if (!empty($user)): ?>
        <?php if (!empty($errors)): ?>
          <div class="alert alert-danger">Please fix the errors below.</div>
        <?php endif; ?>

        <div class="my-2">
          <label>
            <img src="<?= get_image($user['image']) ?>" 
                 alt="User Image" 
                 class="mx-auto d-block image-preview-edit" 
                 style="width: 150px; cursor: pointer; height: 150px; object-fit: cover;">
            <input onchange="display_image_edit(this.files[0])" type="file" name="image" class="d-none">
          </label>
          <script>
            function display_image_edit(file) {
              document.querySelector('.image-preview-edit').src = URL.createObjectURL(file);
            }
          </script>
        </div>

        <div class="form-floating">
          <input value="<?= old_value('username', $user['username']) ?>" name="username" type="text" class="form-control my-2" id="editUsername" placeholder="Daniel123">
          <label for="editUsername">Username</label>
        </div>
        <?php if (!empty($errors['username'])): ?>
          <div class="text text-danger"><?= $errors['username'] ?></div>
        <?php endif; ?>

        <div class="form-floating">
          <input value="<?= old_value('email', $user['email']) ?>" name="email" type="email" class="form-control my-2" id="editEmail" placeholder="name@example.com">
          <label for="editEmail">Email address</label>
        </div>
        <?php if (!empty($errors['email'])): ?>
          <div class="text text-danger"><?= $errors['email'] ?></div>
        <?php endif; ?>

        <div class="form-floating">
          <input value="<?= old_value('password') ?>" name="password" type="password" class="form-control my-2" id="editPassword" placeholder="Password">
          <label for="editPassword">Password [Leave blank to keep current]</label>
        </div>
        <?php if (!empty($errors['password'])): ?>
          <div class="text text-danger"><?= $errors['password'] ?></div>
        <?php endif; ?>

        <div class="form-floating">
          <input value="<?= old_value('retype_password') ?>" name="retype_password" type="password" class="form-control my-2" id="editRetypePassword" placeholder="Password">
          <label for="editRetypePassword">Retype Password</label>
        </div>
        <?php if (!empty($errors['retype_password'])): ?>
          <div class="text text-danger"><?= $errors['retype_password'] ?></div>
        <?php endif; ?>

        <button class="btn btn-lg btn-primary mx-2 w-70" type="submit">Save</button>
        <a href="<?= ROOT ?>/index.php?url=admin/users">
          <button type="button" class="btn btn-lg btn-secondary mx-2 w-70">Cancel</button>
        </a>

      <?php else: ?>
        <div class="alert alert-danger text-center">User not found.</div>
      <?php endif; ?>
    </form>
  </div>

<?php elseif ($action == 'delete'): ?>

  <div class="col-md-6 mx-auto">
    <form method="post" action="<?= ROOT ?>/admin/users/delete/<?= $user['id']; ?>">
      <h1 class="h3 mb-3 fw-normal">Delete Account</h1>

      <?php if (!empty($user)): ?>
        <?php if (!empty($errors)): ?>
          <div class="alert alert-danger">Please fix the errors below.</div>
        <?php endif; ?>

        <div class="form-floating">
          <input value="<?= old_value('username', $user['username']) ?>" name="username" type="text" class="form-control my-2" id="deleteUsername" placeholder="Daniel123" disabled>
          <label for="deleteUsername">Username</label>
        </div>
        <?php if (!empty($errors['username'])): ?>
          <div class="text text-danger"><?= $errors['username'] ?></div>
        <?php endif; ?>

        <div class="form-floating">
          <input value="<?= old_value('email', $user['email']) ?>" name="email" type="email" class="form-control my-2" id="deleteEmail" placeholder="name@example.com" disabled>
          <label for="deleteEmail">Email address</label>
        </div>
        <?php if (!empty($errors['email'])): ?>
          <div class="text text-danger"><?= $errors['email'] ?></div>
        <?php endif; ?>
        <button class="btn btn-lg btn-danger mx-2 w-70" type="submit" onclick="return confirm('Are you sure you want to delete this user?');">
          Delete</button>
        <a href="<?= ROOT ?>/index.php?url=admin/users">
          <button type="button" class="btn btn-lg btn-secondary mx-2 w-70">Cancel</button>
          <?php 
           var_dump($_POST, $user);
           exit; 
          ?>
        </a>

      <?php else: ?>
        <div class="alert alert-danger text-center">User not found.</div>
      <?php endif; ?>
    </form>
  </div>

<?php else: ?>

  <h2>My Users
    <a href="<?= ROOT ?>/index.php?url=admin/users/add">
      <button class="btn btn-primary text-white" type="button">Add User</button>
    </a>
  </h2>

  <div class="table-responsive">
    <table class="table table-striped">
      <tr>
        <th>#</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Date Joined</th>
        <th>Image</th>
        <th>Actions</th>
      </tr>
      <?php
        $limit = 6;
        $offset = ($PAGE['current_page_number'] - 1) * $limit;
        $selectUsers = "SELECT * FROM users ORDER BY id ASC LIMIT $limit OFFSET $offset";
        $users = querry_db($selectUsers);
      ?>
      <?php if (empty($users)): ?>
        <tr>
          <td colspan="7">No users found.</td>
        </tr>
      <?php else: ?>
        <?php foreach ($users as $user): ?>
          <tr>
            <td><?= esc($user['id']) ?></td>
            <td><?= esc($user['username']) ?></td>
            <td><?= esc($user['email']) ?></td>
            <td><?= esc($user['role']) ?></td>
            <td><?= esc(date("jS M, Y", strtotime($user['date']))) ?></td>
            <td>
              <img src="<?= get_image($user['image']) ?>" style="width: 100px; height: 100px; object-fit: cover; d-block;" alt="User Image">
            </td>
            <td>
              <a href="<?= ROOT ?>/index.php?url=admin/users/edit/<?= $user['id'] ?>" class="btn btn-sm btn-warning text-white btn-small">
                <i class="bi bi-pencil-square"></i>
              </a>
              <a href="<?= ROOT ?>/index.php?url=admin/users/delete/<?= $user['id'] ?>" class="btn btn-sm btn-danger text-white btn-small">
                <i class="bi bi-trash"></i>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
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
