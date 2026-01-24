<?php
// admin.php - main admin dashboard page
if (!logged_in()) {
  redirect(ROOT . '/index.php?url=login');
  exit();
}

$section = $url[1] ?? 'dashboard';
$action  = $url[2] ?? 'view';
$id      = $url[3] ?? 0;

$paginated_sections = ['users', 'categories', 'posts'];

// Set pagination vars (used by pages like admin/users)
if ($page_name === 'admin' && in_array($section, $paginated_sections, true) && 
     ($action === 'view' || $action === '' || $action === null)) {
         $base = ROOT . "/index.php?url=admin/{$section}";
         $PAGE = get_pagination($base);
} else {
    $PAGE = [
        'current_page_number' => 1,
        'first_page_link'     => '',
        'prev_page_link'      => '',
        'next_page_link'      => '',
    ];
}

$file_name = __DIR__ . "/admin/" . $section . ".php";
if (!is_file($file_name)) {
  $filename = __DIR__ . "/admin/404.php";
}

// include section controllers
if ($section == 'users') {
  require_once __DIR__ . "/admin/users-controler.php";
} elseif ($section == 'posts') {
  require_once __DIR__ . "/admin/posts-controller.php";
} elseif ($section == 'categories') {
  require_once __DIR__ . "/admin/categories-controller.php";
}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <title>Admin Dashboard · <?= APP_NAME ?></title>

  <!-- Bootstrap core CSS -->
  <link href="<?= ROOT; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= ROOT; ?>/css/bootstrap-icons.min.css" rel="stylesheet">

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

  <!-- Custom styles for this template -->
  <link href="<?= ROOT; ?>/css/dashboard.css" rel="stylesheet">
</head>
<body>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><?= APP_NAME ?></a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="<?= ROOT; ?>index.php?url=logout">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link <?= $section == 'dashboard' ? 'active' : '' ?>" aria-current="page" href="<?= ROOT; ?>/index.php?url=admin/dashboard">
              <i class="bi bi-speedometer2"></i>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $section == 'users' ? 'active' : '' ?>" href="<?= ROOT; ?>/index.php?url=admin/users">
              <i class="bi bi-person-circle"></i>
              Users
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $section == 'categories' ? 'active' : '' ?>" href="<?= ROOT; ?>/index.php?url=admin/categories">
              <i class="bi bi-book-marks"></i>
              Categories
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $section == 'posts' ? 'active' : '' ?>" href="<?= ROOT; ?>/index.php?url=admin/posts">
              <i class="bi bi-stickies-fill"></i>
              Posts
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file"></span>
              Orders
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>OTHERS</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="<?= ROOT; ?>/index.php?url=home">
              <i class="bi bi-globe"></i>
              Frontend View
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>

      <?php
         require_once $file_name;
      ?>

    </main>
  </div>
</div>

<script src="<?= ROOT; ?>/js/bootstrap.bundle.min.js"></script>
<script src="<?= ROOT; ?>/js/dashboard.js"></script>

</body>
</html>
