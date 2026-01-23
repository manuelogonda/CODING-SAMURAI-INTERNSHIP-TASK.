<?php if ($action == 'add'): ?>
  <div class="col-md-6 mx-auto mb-4">
    <form method="post">
      <h1 class="h3 mb-3 fw-normal">Add Category
</h1>

      <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">Please fix the errors below.</div>
      <?php endif; ?>

      <!-- category -->
      <div class="form-floating my-2">
        <select id="addCategoryName" name="category" class="form-control">
          <option value="">-- Please choose a category --</option>
          <option value="Web and Software Development"
            <?= old_select('category', 'Web and Software Development') ?>>
            Web and Software Development
          </option>
          <option value="National Politics"
            <?= old_select('category', 'National Politics') ?>>
            National Politics
          </option>
          <option value="Education"
            <?= old_select('category', 'Education') ?>>
            Education
          </option>
          <option value="AI"
            <?= old_select('category', 'AI') ?>>
            AI
          </option>
          <option value="Information Technology"
            <?= old_select('category', 'Information Technology') ?>>
            Information Technology
          </option>
        </select>
        <label for="addCategoryName">Category</label>
      </div>
      <?php if (!empty($errors['category'])): ?>
        <div class="text text-danger"><?= $errors['category'] ?></div>
      <?php endif; ?>

      <!-- slug -->
      <div class="form-floating my-2">
        <input value="<?= old_value('slug') ?>" name="slug" type="text"
               class="form-control" id="addSlugName"
               placeholder="slug-name">
        <label for="addSlugName">Slug</label>
      </div>
      <?php if (!empty($errors['slug'])): ?>
        <div class="text text-danger"><?= $errors['slug'] ?></div>
      <?php endif; ?>

      <!-- disabled -->
      <div class="form-floating my-2">
        <select name="disabled" id="addDisabled" class="form-control">
          <option value="0" <?= old_select('disabled', '0', '0') ?>>Allowed</option>
          <option value="1" <?= old_select('disabled', '1') ?>>Disallowed</option>
        </select>
        <label for="addDisabled">Status</label>
      </div>
      <?php if (!empty($errors['disabled'])): ?>
        <div class="text text-danger"><?= $errors['disabled'] ?></div>
      <?php endif; ?>

      <button class="btn btn-lg btn-primary mx-2 w-70" type="submit">Save Category</button>
      <a href="<?= ROOT ?>/index.php?url=admin/categories">
        <button type="button" class="btn btn-lg btn-secondary mx-2 w-70">Cancel</button>
      </a>
    </form>
  </div>


 <?php elseif ($action == 'edit'): ?>

  <div class="col-md-6 mx-auto mb-4">
    <form method="post">
      <h1 class="h3 mb-3 fw-normal">Edit Category</h1>

      <?php if (!empty($category)): ?>
        <?php if (!empty($errors)): ?>
          <div class="alert alert-danger">Please fix the errors below.</div>
        <?php endif; ?>

        <!-- category -->
        <div class="form-floating my-2">
          <select id="editCategoryName" name="category" class="form-control">
            <option value="">-- Please choose a category --</option>
            <option value="Web and Software Development"
              <?= old_select('category', 'Web and Software Development', $category['category']) ?>>
              Web and Software Development
            </option>
            <option value="National Politics"
              <?= old_select('category', 'National Politics', $category['category']) ?>>
              National Politics
            </option>
            <option value="Education"
              <?= old_select('category', 'Education', $category['category']) ?>>
              Education
            </option>
            <option value="AI"
              <?= old_select('category', 'AI', $category['category']) ?>>
              AI
            </option>
            <option value="Information Technology"
              <?= old_select('category', 'Information Technology', $category['category']) ?>>
              Information Technology
            </option>
          </select>
          <label for="editCategoryName">Category</label>
        </div>
        <?php if (!empty($errors['category'])): ?>
          <div class="text text-danger"><?= $errors['category'] ?></div>
        <?php endif; ?>

        <!-- slug -->
        <div class="form-floating my-2">
          <input value="<?= old_value('slug', $category['slug']) ?>" name="slug"
                 type="text" class="form-control" id="editSlugName"
                 placeholder="slug-name">
          <label for="editSlugName">Slug</label>
        </div>
        <?php if (!empty($errors['slug'])): ?>
          <div class="text text-danger"><?= $errors['slug'] ?></div>
        <?php endif; ?>

        <!-- disabled -->
        <div class="form-floating my-2">
          <select name="disabled" id="editDisabled" class="form-control">
            <option value="0"
              <?= old_select('disabled', '0', (string)$category['disabled']) ?>>
              Allowed
            </option>
            <option value="1"
              <?= old_select('disabled', '1', (string)$category['disabled']) ?>>
              Disallowed
            </option>
          </select>
          <label for="editDisabled">Status</label>
        </div>
        <?php if (!empty($errors['disabled'])): ?>
          <div class="text text-danger"><?= $errors['disabled'] ?></div>
        <?php endif; ?>

        <button class="btn btn-lg btn-primary mx-2 w-70" type="submit">Save</button>
        <a href="<?= ROOT ?>/index.php?url=admin/categories">
          <button type="button" class="btn btn-lg btn-secondary mx-2 w-70">Cancel</button>
        </a>

      <?php else: ?>
        <div class="alert alert-danger text-center">Category not found.</div>
      <?php endif; ?>
    </form>
  </div>

  <?php elseif ($action == 'delete'): ?>
  <div class="col-md-6 mx-auto">
    <form method="post" action="<?= ROOT ?>/admin/categories/delete/<?= $category['id']; ?>">
      <h1 class="h3 mb-3 fw-normal">Delete Category</h1>

      <?php if (!empty($category)): ?>

        <p>Are you sure you want to delete this category?</p>

        <div class="form-floating my-2">
          <input value="<?= htmlspecialchars($category['category']) ?>" type="text"
                 class="form-control" id="deleteCategoryName" disabled>
          <label for="deleteCategoryName">Category</label>
        </div>

        <div class="form-floating my-2">
          <input value="<?= htmlspecialchars($category['slug']) ?>" type="text"
                 class="form-control" id="deleteSlug" disabled>
          <label for="deleteSlug">Slug</label>
        </div>

        <div class="form-floating my-2">
          <input value="<?= $category['disabled'] ? 'Disallowed' : 'Allowed' ?>"
                 type="text" class="form-control" id="deleteStatus" disabled>
          <label for="deleteStatus">Status</label>
        </div>

        <button class="btn btn-lg btn-danger mx-2 w-70" type="submit"
                onclick="return confirm('Are you sure you want to delete this category?');">
          Delete
        </button>
        <a href="<?= ROOT ?>/index.php?url=admin/categories">
          <button type="button" class="btn btn-lg btn-secondary mx-2 w-70">Cancel</button>
        </a>

      <?php else: ?>
        <div class="alert alert-danger text-center">Category not found.</div>
      <?php endif; ?>
    </form>
  </div>

  <?php else: ?>

  <h2>Categories
    <a href="<?= ROOT ?>/index.php?url=admin/categories/add" class="text text-white">
      <button class="btn btn-primary">Add Category</button>
    </a>
  </h2>
<div class="table-responsive">
  <table class="table table-striped table-hover">
        <tr>
          <th>#</th>
          <th>Category</th>
          <th>Slug</th>
          <th>Disabled</th>
          <th>Actions</th>
        </tr>
        <?php
        $limit = 6;
        $offset = ($PAGE['current_page_number'] - 1) * $limit;
          $selectCategories = "SELECT * FROM categories ORDER BY id limit $limit offset $offset";
          $categories = querry_db($selectCategories);
        ?>
         <?php if (empty($categories)): ?>
        <tr>
          <td colspan="5">No categories found.</td>
        </tr>
      <?php else: ?>
        <?php foreach ($categories as $category): ?>
          <tr>
            <td><?= $category['id']; ?></td>
            <td><?= htmlspecialchars($category['category']); ?></td>
            <td><?= htmlspecialchars($category['slug']); ?></td>
            <td><?= $category['disabled'] ? 'Yes' : 'No'; ?></td>
            <td>
             <a href="<?= ROOT; ?>/index.php?url=admin/categories/edit/<?= $category['id']; ?>" class="btn btn-sm btn-warning text-white btn-small">
            <i class="bi bi-pencil-square"></i>
          </a> |
          <a href="<?= ROOT; ?>/index.php?url=admin/categories/delete/<?= $category['id']; ?>"
          class="btn btn-sm btn-danger text-white btn-small" 
          onclick="return confirm('Are you sure you want to delete this post?');">
          <i class="bi bi-trash"></i>
          </a>
            </td>
          </tr>
        <?php endforeach; ?>
    <?php endif; ?>
  </table>
</div>

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

<?php endif; ?>