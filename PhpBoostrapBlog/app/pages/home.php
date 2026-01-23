<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Home · <?= APP_NAME ?></title>

    <!-- Bootstrap core CSS -->
<link href="<?= ROOT;?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: #0000001a;
        border: solid rgba(0, 0, 0, 0.15);
        border-width: 1px 0;
        box-shadow:
          inset 0 0.5em 1.5em #0000001a,
          inset 0 0.125em 0.5em #00000026;
      }
      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }
      .bi {
        vertical-align: -0.125em;
        fill: currentColor;
      }
      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }
      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }
      .bd-mode-toggle {
        z-index: 1500;
      }
      .bd-mode-toggle .bi {
        width: 1em;
        height: 1em;
      }
      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }
    </style>
    
    <!-- Custom styles for this template -->
    <link href="<?= ROOT;?>/css/headers.css" rel="stylesheet">
  </head>
  <body>
    
  <header class="p-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
          <img class="bi me-2" src="<?= ROOT;?>/images/benzologo.jpg" alt="mercedeslogo" style="object-fit: cover;" width="60" height="52">
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">Blog</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">Contact Us</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form>

        <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="<?= ROOT ?>/app/pages/admin">Admin</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= ROOT ?>/assets/logout">Sign out</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>
  <!-- slider -->
<iframe src="https://imageslidergenerator.shahmirfaisal.com/slider?image=https%3A%2F%2Fi.ibb.co%2FFkGQdzmq%2Ffotis-fotopoulos-6s-Al6a-Q4-OWI-unsplash.jpg&image=https%3A%2F%2Fi.ibb.co%2F7tnMntts%2Fmyke-simon-ats-Uq-Im3wxo-unsplash.jpg&image=https%3A%2F%2Fi.ibb.co%2F1GCbN18v%2Fvictor-freitas-q-Z-U9z4-TQ6-A-unsplash.jpg&image=https%3A%2F%2Fi.ibb.co%2FwFpPDbqz%2Ftom-briskey-HM3-WZ4-B1gv-M-unsplash.jpg&image=https%3A%2F%2Fimages.pexels.com%2Fphotos%2F4245826%2Fpexels-photo-4245826.jpeg%3Fauto%3Dcompress%26cs%3Dtinysrgb%26w%3D600&animationType=slide&autoPlay=true&radioButtonType=circle&radioButtonSize=60&radioButtonGap=24&arrowsType=arrow-circle&arrowsBackground=visible&arrowsBackgroundVisibility=212&arrowsSize=50&arrowsOffset=1&arrowsColor=%23fff" style="border: none; justify-content: center;"
      align="center" width="100%" height="500px"
        allowfullscreen

    ></iframe>

    <main class="my-2">
        <h3 class="mx-2">Featured Blogs</h3>
        <div class="row mb-2">
        <div class="col-md-6">
          <div
            class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250  position-relative"
          >
            <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-primary-emphasis"
                >World</strong
              >
              <h3 class="mb-0">Featured post</h3>
              <div class="mb-1 text-body-secondary">Nov 12</div>
              <p class="card-text mb-auto">
                This is a wider card with supporting text below as a natural
                lead-in to additional content.
              </p>
              <a
                href="#"
                class="icon-link gap-1 icon-link-hover stretched-link"
              >
                Continue reading
                <svg class="bi" aria-hidden="true">
                  <use xlink:href="#chevron-right"></use>
                </svg>
              </a>
            </div>
            <div class="col-lg-5 d-lg-block">
                <img src="<?= ROOT;?>/images/whitemanincape.jpg" 
                alt="a person on acape" height="250" 
                style="object-fit: cover;"
                class="w-100 w-lg-50 h-100"
                >
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div
            class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative"
          >
            <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-success-emphasis"
                >Design</strong
              >
              <h3 class="mb-0">Post title</h3>
              <div class="mb-1 text-body-secondary">Nov 11</div>
              <p class="mb-auto">
                This is a wider card with supporting text below as a natural
                lead-in to additional content.
              </p>
              <a
                href="#"
                class="icon-link gap-1 icon-link-hover stretched-link"
              >
                Continue reading
                <svg class="bi" aria-hidden="true">
                  <use xlink:href="#chevron-right"></use>
                </svg>
              </a>
            </div>
            <div class="col-lg-5 d-lg-block">
                <img src="<?= ROOT;?>/images/africanman.jpg" 
                alt="a person in a hoodie"  height="250"
                class="w-100 w-lg-50 h-100"
                style="object-fit: cover;"
                >
            </div>
                
            </div>
          </div>
        </div>
      </div>

    </main>

    <div class="container">
      <footer class="py-5">
        <div class="row">
          <div class="col-6 col-md-2 mb-3">
            <h5>Useful Links</h5>
            <ul class="nav flex-column">
              <li class="nav-item mb-2">
                <a href="<?= ROOT;?>/index.php?url=home" class="nav-link p-0 text-body-secondary">Home</a>
              </li>
              <li class="nav-item mb-2">
                <a href="<?= ROOT;?>/index.php?url=login" class="nav-link p-0 text-body-secondary"
                  >Login</a
                >
              </li>
              <li class="nav-item mb-2">
                <a href="#" class="nav-link p-0 text-body-secondary">Pricing</a>
              </li>
              <li class="nav-item mb-2">
                <a href="#" class="nav-link p-0 text-body-secondary">FAQs</a>
              </li>
              <li class="nav-item mb-2">
                <a href="#" class="nav-link p-0 text-body-secondary">About</a>
              </li>
            </ul>
          </div>
          <div class="col-6 col-md-2 mb-3">
            <h5>Section</h5>
            <ul class="nav flex-column">
              <li class="nav-item mb-2">
                <a href="#" class="nav-link p-0 text-body-secondary">Home</a>
              </li>
              <li class="nav-item mb-2">
                <a href="#" class="nav-link p-0 text-body-secondary"
                  >Features</a
                >
              </li>
              <li class="nav-item mb-2">
                <a href="#" class="nav-link p-0 text-body-secondary">Pricing</a>
              </li>
              <li class="nav-item mb-2">
                <a href="#" class="nav-link p-0 text-body-secondary">FAQs</a>
              </li>
              <li class="nav-item mb-2">
                <a href="#" class="nav-link p-0 text-body-secondary">About</a>
              </li>
            </ul>
          </div>
          <div class="col-6 col-md-2 mb-3">
            <h5>section</h5>
            <ul class="nav flex-column">
              <li class="nav-item mb-2">
                <a href="#" class="nav-link p-0 text-body-secondary">Home</a>
              </li>
              <li class="nav-item mb-2">
                <a href="#" class="nav-link p-0 text-body-secondary"
                  >Login</a
                >
              </li>
              <li class="nav-item mb-2">
                <a href="#" class="nav-link p-0 text-body-secondary">Pricing</a>
              </li>
              <li class="nav-item mb-2">
                <a href="#" class="nav-link p-0 text-body-secondary">FAQs</a>
              </li>
              <li class="nav-item mb-2">
                <a href="#" class="nav-link p-0 text-body-secondary">About</a>
              </li>
            </ul>
          </div>
          <div class="col-md-5 offset-md-1 mb-3">
            <form>
              <h5>Subscribe to our newsletter</h5>
              <p>Monthly digest of what's new and exciting from us.</p>
              <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                <label for="newsletter1" class="visually-hidden"
                  >Email address</label
                >
                <input
                  id="newsletter1"
                  type="email"
                  class="form-control"
                  placeholder="Email address"
                />
                <button class="btn btn-primary" type="button">Subscribe</button>
              </div>
            </form>
          </div>
        </div>
        <div
          class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top"
        >
          <p>&copy; <?= date("Y") ?>, Manuel.Ogonda All rights reserved.</p>
          <ul class="list-unstyled d-flex">
            <li class="ms-3">
              <a class="link-body-emphasis" href="#" aria-label="Instagram"
                ><svg class="bi" width="24" height="24">
                  <use xlink:href="#instagram"></use></svg
              ></a>
            </li>
            <li class="ms-3">
              <a class="link-body-emphasis" href="#" aria-label="Facebook"
                ><svg class="bi" width="24" height="24" aria-hidden="true">
                  <use xlink:href="#facebook"></use></svg
              ></a>
            </li>
          </ul>
        </div>
      </footer>
    </div>

    <script src="<?= ROOT;?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
