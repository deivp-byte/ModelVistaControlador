<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IT Asset Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="assets/style.css">
    
    <style>
        :root { 
            --it-primary: #1e293b; /* Un azul oscuro/pizarra moderno */
            --it-accent: #0d6efd;  /* Azul Bootstrap eléctrico */
            --sidebar-bg: #ffffff; /* Fondo blanco limpio para un look moderno */
        }
        
        body { 
            background-color: #f8fafc; /* Gris ligeramente azulado muy limpio */
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }
        
        /* Sidebar Modernizada */
        .sidebar { 
            min-height: 100vh; 
            background: var(--sidebar-bg); 
            border-right: 1px solid #e2e8f0; /* Línea divisoria sutil en vez de sombra pesada */
        }
        
        /* Enlaces del Menú */
        .sidebar .nav-link { 
            color: #64748b; /* Gris texto elegante */
            font-weight: 500;
            border-radius: 8px; 
            margin-bottom: 6px; 
            padding: 0.75rem 1rem;
            transition: all 0.2s ease-in-out;
        }
        
        /* Efecto Hover */
        .sidebar .nav-link:hover { 
            background-color: #f1f5f9; 
            color: var(--it-primary);
            transform: translateX(3px); /* Pequeño desplazamiento animado */
        }
        
        /* Enlace Activo */
        .sidebar .nav-link.active { 
            background-color: #e0f2fe; /* Azul cielo muy suave de fondo */
            color: #0369a1;            /* Texto azul oscuro contrastado */
            font-weight: 600;
        }
        
        /* Iconos del menú */
        .sidebar .nav-link i {
            font-size: 1.1rem;
            vertical-align: middle;
        }

        .main-content { 
            background: #f8fafc; 
            min-height: 100vh; 
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse p-4">
            <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                <div class="bg-primary bg-gradient text-white d-flex align-items-center justify-content-center rounded-3 me-2" style="width: 40px; height: 40px;">
                    <i class="bi bi-cpu-fill fs-5"></i>
                </div>
                <div>
                    <span class="fs-6 fw-bold text-dark d-block" style="letter-spacing: -0.5px;">IT Inventari</span>
                    <small class="text-muted" style="font-size: 0.75rem;">Asset Manager</small>
                </div>
            </div>
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= (!isset($_GET['action']) || $_GET['action'] == 'dashboard') ? 'active' : '' ?>" href="index.php?action=dashboard">
                        <i class="bi bi-grid-1x2-fill me-3"></i><span>Inici</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (!isset($_GET['action']) || $_GET['action'] == 'list') ? 'active' : '' ?>" href="index.php?action=list">
                        <i class="bi bi-hdd-network-fill me-3"></i><span>Inventari Actius</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['action']) && $_GET['action'] == 'create') ? 'active' : '' ?>" href="index.php?action=create">
                        <i class="bi bi-plus-circle-fill me-3"></i><span>Nou Actiu</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['action']) && $_GET['action'] == 'createCategory') ? 'active' : '' ?>" href="index.php?action=createCategory">
                        <i class="bi bi-plus-circle-fill me-3"></i><span>Nova Categoria</span>
                    </a>
                </li>
            </ul>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
        <div class="container-fluid pt-4">
            
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show border-0 shadow-sm content-alert" role="alert" style="border-radius: 10px;">
                <i class="bi <?= $_SESSION['message_type'] == 'success' ? 'bi-check-circle-fill text-success' : 'bi-exclamation-triangle-fill text-danger' ?> me-2"></i>
                <span class="text-dark fw-medium"><?= $_SESSION['message'] ?></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                unset($_SESSION['message']); 
                unset($_SESSION['message_type']); 
            ?>
        <?php endif; ?>