<?php  include "layouts/header.php";?>
<link rel="stylesheet" href="assets/style.css">
<h1 class="principal_title">Pàgina d'inici</h1>

<div class="container">
    <div class="row-4">
        <!-- Contenedor de 1/4 de pantalla (3 de 12 columnas) -->
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
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
    </div>
        <!-- El Gráfico de Queso (1/4) -->
        <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h6 class="text-muted text-uppercase small fw-bold mb-3">Total de productes</h6>
                    <!-- Contenedor del gráfico -->
                    <div style="position: relative; height: 200px;">
                        <canvas id="graficoGastos"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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