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
                    <h6 class="text-muted text-uppercase small fw-bold mb-3">Llistat de Monitors</h6>
                    
                    <?php if (!empty($monitor)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="small text-uppercase fw-bold text-muted">Codi (Short)</th>
                                        <th scope="col" class="small text-uppercase fw-bold text-muted">Nom del Producte</th>
                                        <th scope="col" class="small text-uppercase fw-bold text-muted text-end">PVP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($monitor as $monitores): ?>
                                        <tr>
                                            <td class="fw-medium text-secondary">
                                                <!-- Usamos tu función existente para el nombre corto -->
                                                <code><?php echo htmlspecialchars($monitores->getProductShortName()); ?></code>
                                            </td>
                                            <td class="fw-bold text-dark">
                                                <?php echo htmlspecialchars($monitores->getProductName()); ?>
                                            </td>
                                            <td class="text-end fw-bold text-success">
                                                <?php echo number_format($monitores->getProductPvp(), 2, ',', '.'); ?> €
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <p class="text-muted small mb-0">No s'han trobat monitors a la base de dades.</p>
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