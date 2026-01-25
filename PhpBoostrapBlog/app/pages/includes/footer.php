
  <div class="container">
      <footer class="py-5">
          <div class="row">
              <div class="col-6 col-md-2 mb-3">
                  <h5>Useful Links</h5>
                  <ul class="nav flex-column">
                      <li class="nav-item mb-2">
                          <a href="<?= ROOT; ?>/index.php?url=home" class="nav-link p-0 text-body-secondary">Home</a>
                      </li>
                      <li class="nav-item mb-2">
                          <a href="<?= ROOT; ?>/index.php?url=login" class="nav-link p-0 text-body-secondary">Login</a>
                      </li>

                      <li class="nav-item mb-2">
                          <a href="<?= ROOT ?>/index.php?url=contact" class="nav-link p-0 text-body-secondary">Contact</a>
                      </li>
                  </ul>
              </div>
              <div class="col-md-5 offset-md-1 mb-3">
                  <form method="post" action="<?= ROOT ?>/index.php?url=home">
                      <h5>Subscribe to our newsletter</h5>
                      <p>Monthly digest of what's new and exciting from us.</p>
                      <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                          <label for="newsletter1" class="visually-hidden">Email address</label>
                          <input
                              id="newsletter1"
                              name="subscribe_email"
                              type="email"
                              class="form-control"
                              placeholder="Email address" />
                          <button class="btn btn-primary" type="submit" name="subscribe_submit">Subscribe</button>
                      </div>
                  </form>
                  <?php if ($subscribe_success): ?>
  <div class="text-success">
    Thank you for subscribing!
  </div>
<?php elseif ($subscribe_error): ?>
  <div class="text-danger">
    <?= htmlspecialchars($subscribe_error, ENT_QUOTES, 'UTF-8') ?>
  </div>
<?php endif; ?>
              </div>
          </div>
          <div
              class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
              <p>&copy; <?= date("Y") ?>, Manuel.Ogonda All rights reserved.</p>
              <ul class="list-unstyled d-flex">
                  <li class="ms-3">
                      <a class="link-body-emphasis" href="#" aria-label="Instagram"><svg class="bi" width="24" height="24">
                              <use xlink:href="#instagram"></use>
                          </svg></a>
                  </li>
                  <li class="ms-3">
                      <a class="link-body-emphasis" href="#" aria-label="Facebook"><svg class="bi" width="24" height="24" aria-hidden="true">
                              <use xlink:href="#facebook"></use>
                          </svg></a>
                  </li>
              </ul>
          </div>
      </footer>
  </div>

  <script src="<?= ROOT; ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>


  </body>

  </html>