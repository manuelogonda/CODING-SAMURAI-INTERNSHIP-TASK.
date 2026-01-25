  <div class="row mb-2" style="justify-content: center;">
      <div class="col-md-6" >
          <div
              class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250  position-relative">
              <div class="col p-4 d-flex flex-column position-static">
                  <strong class="d-inline-block mb-2 text-primary-emphasis"> <?= $post['category'] ?> </strong>
                  <h3 class="mb-0"> <?= esc($post['title']) ?> </h3>
                  <div class="mb-1 text-body-secondary"><?= esc(date("jS M, Y", strtotime($post['date']))) ?></div>
                  <div class="mb-1 text-body-secondary"><?= esc($post['username']) ?></div>
                  <p class="card-text mb-auto">
                    <?= esc($post['content']) ?>
                  </p>
                  <a
                      href="<?= ROOT ?>/index.php?url=post/<?= $post['id']?>"
                      class="icon-link gap-1 icon-link-hover stretched-link">
                      Continue reading
                      <svg class="bi" aria-hidden="true">
                          <use xlink:href="#chevron-right"></use>
                      </svg>
                  </a>
              </div>
              <div class="col-lg-5 d-lg-block">
                <a href="<?= ROOT ?>/index.php?url=post/<?= $post['id']?>">
                  <img src="<?= esc(get_image($post['image'])) ?>"
                      alt="a post Image" height="250"
                      style="object-fit: cover;"
                      class="w-100 w-lg-50 h-100">
                      </a>
              </div>
          </div>
      </div>
  </div>
