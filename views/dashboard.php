<?php  include "layouts/header.php";?>
<link rel="stylesheet" href="assets/style.css">
<h1 class="principal_title">Pàgina d'inici</h1>

<!-- views/dashboard.php -->
<div class="container py-4">
    <!-- Fila principal que divide la pantalla en Izquierda (Bloques) y Derecha (Tabla) -->
    <div class="row g-4">
        
        <!-- COLUMNA IZQUIERDA: Ocupa la mitad de la pantalla (6 de 12 columnas en pantallas grandes) -->
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="row g-4">
                
                <!-- 1. Bloque de Balance Total -->
                <div class="col-12">
                    <div class="card shadow-sm border-0 bg-white text-dark">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="icon-shape bg-success bg-opacity-10 text-success p-2 rounded-circle me-3">
                                    <i class="bi bi-cash-stack fs-4"></i>
                                </div>
                                <h6 class="card-title text-uppercase text-muted mb-0 fw-bold" style="font-size: 0.8rem;">
                                    Balance Total
                                </h6>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <span class="display-6 fw-bold text-dark" id="contador-dinero">
                                    <?php echo number_format($balance, 2, ',', '.'); ?>
                                </span>
                                <span class="ms-2 fs-4 fw-medium text-success">€</span>
                            </div>
                            <div class="mt-3">
                                <span class="text-success fw-bold small">
                                    <i class="bi bi-arrow-up"></i> +12%
                                </span>
                                <span class="text-muted small ms-1">respecto al mes anterior</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Bloque del Gráfico de Queso -->
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h6 class="text-muted text-uppercase small fw-bold mb-3">Total de productes</h6>
                            <div style="position: relative; height: 200px;">
                                <canvas id="graficoGastos"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- COLUMNA DERECHA: Ocupa la otra mitad de la pantalla (6 de 12 columnas) -->
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                        <div>
                            <h6 class="text-muted text-uppercase small fw-bold mb-1">Cercador de Productes per Categoria</h6>
                            <p class="text-muted small mb-0">Introdueix el nom d'una categoria per filtrar els actius</p>
                        </div>
                        
                        <form action="index.php" method="GET" class="d-flex align-items-center gap-2" style="max-width: 350px; width: 100%;">
                            <input type="hidden" name="action" value="dashboard"> 
                            
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 8px 0 0 8px;">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" 
                                    name="search_category" 
                                    class="form-control bg-light border-start-0 ps-1" 
                                    placeholder="Ex: Portàtils, Servidors..." 
                                    value="<?= isset($_GET['search_category']) ? htmlspecialchars($_GET['search_category']) : '' ?>"
                                    style="border-radius: 0 8px 8px 0; font-size: 0.9rem;">
                                
                                <?php if (!empty($_GET['search_category'])): ?>
                                    <a href="index.php?action=dashboard" class="btn btn-light border d-flex align-items-center justify-content-center" title="Netejar filtre">
                                        <i class="bi bi-x-lg text-secondary"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm px-3 py-2 fw-semibold" style="border-radius: 8px;">
                                Filtrar
                            </button>
                        </form>
                    </div>
                    
                    <?php if (!empty($monitor)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="small text-uppercase fw-bold text-muted" style="padding: 1rem 0.75rem;">Codi (Short)</th>
                                        <th scope="col" class="small text-uppercase fw-bold text-muted">Nom del Producte</th>
                                        <th scope="col" class="small text-uppercase fw-bold text-muted">Categoria</th>
                                        <th scope="col" class="small text-uppercase fw-bold text-muted text-end" style="padding: 1rem 0.75rem;">PVP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($monitor as $monitores): ?>
                                        <tr>
                                            <td class="fw-medium text-secondary" style="padding: 0.85rem 0.75rem;">
                                                <code><?php echo htmlspecialchars($monitores->getProductShortName()); ?></code>
                                            </td>
                                            <td class="fw-bold text-dark">
                                                <?php echo htmlspecialchars($monitores->getProductName()); ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary bg-opacity-10 text-secondary border px-2.5 py-1.5" style="border-radius: 6px; font-weight: 500;">
                                                    <i class="bi bi-tag-fill me-1 text-muted"></i>
                                                    <?php echo htmlspecialchars($monitores->getProductCategory()); ?>
                                                </span>
                                            </td>
                                            <td class="text-end fw-bold text-success" style="padding: 0.85rem 0.75rem;">
                                                <?php echo number_format($monitores->getProductPvp(), 2, ',', '.'); ?> €
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <div class="text-muted mb-3">
                                <i class="bi bi-folder-x fs-1 opacity-50"></i>
                            </div>
                            <p class="text-secondary fw-medium mb-1">No s'han trobat actius</p>
                            <p class="text-muted small mb-0">
                                <?= !empty($_GET['search_category']) 
                                    ? "Cap coincidència amb la categoria '" . htmlspecialchars($_GET['search_category']) . "'." 
                                    : "No hi ha productes disponibles a l'inventari." ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div> <!-- Fin Row principal -->
</div> <!-- Fin Container -->

<!-- Aquí abajo continuaría tu etiqueta <script> de Chart.js sin cambios -->
<script>

    const ctx = document.getElementById('graficoGastos').getContext('2d');
    const etiquetas = <?php echo json_encode($namesToChart); ?>;
    const valores = <?php echo json_encode($pvpChart); ?>;
    
    new Chart(ctx, {
        type: 'pie', // Tipo "queso"
        data: {
            labels: etiquetas,
            datasets: [{
                data: valores, // Los valores en €
                backgroundColor: [
                    '#4e73df', '#1cc88a', '#f6c23e', '#e74a3b', 
                    '#36b9cc', '#6610f2', '#fd7e14', '#20c997'
                ],
                hoverOffset: 10,
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            maintainAspectRatio: false, // Importante para controlar el alto
            plugins: {
                legend: {
                    position: 'bottom', // Etiquetas abajo para que no roben espacio
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: { size: 11 }
                    }
                }
            }
        }
    });
</script>

<?php include "layouts/footer.php"?>