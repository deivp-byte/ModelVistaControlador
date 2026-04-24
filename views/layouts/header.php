<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IT Asset Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/style.css">
    <style>
        :root { --it-primary: #2c3e50; --it-accent: #3498db; }
        body { background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; background: var(--it-primary); color: white; }
        .sidebar .nav-link { color: #bdc3c7; border-radius: 5px; margin-bottom: 5px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: var(--it-accent); color: white; }
        .main-content { background: #f8f9fa; min-height: 100vh; }
        
    </style>
</head>
<body>
    <!-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid" style="background-color: #2c3e50;" >
    <a class="navbar-brand" href="#">IT</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav> -->
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse p-3 shadow">
            <div class="d-flex align-items-center mb-4 px-2">
                <i class="bi bi-cpu-fill fs-3 text-info me-2"></i>
                <span class="fs-5 fw-bold">IT ASSET MGMT</span>
            </div>
            <ul class="nav flex-column mt-2">
                <li class="nav-item">
                    <a class="nav-link <?= (!isset($_GET['action']) || $_GET['action'] == 'list') ? 'active' : '' ?>" href="index.php">
                        <i class="bi bi-pc-display me-2"></i> Inventari Actius
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['action']) && $_GET['action'] == 'create') ? 'active' : '' ?>" href="index.php?action=create">
                        <i class="bi bi-plus-circle me-2"></i> Nou Actiu
                    </a>
                </li>
            </ul>
        </nav>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
        <div class="container-fluid pt-3">
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi <?= $_SESSION['message_type'] == 'success' ? 'bi-check-circle' : 'bi-exclamation-triangle' ?> me-2"></i>
            <?= $_SESSION['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php 
            // Crucial: Esborrem el missatge perquè no surti més
            unset($_SESSION['message']); 
            unset($_SESSION['message_type']); 
        ?>
    <?php endif; ?>
</div>