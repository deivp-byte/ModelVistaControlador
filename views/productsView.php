<?php  include "layouts/header.php"; 
$noms= [];
$preus=[];
foreach($products as $p){
    $noms[] = $p->getProductName();
    $preus[] = $p->getProductPvp();
}
?>
    <h1 class="principal_title">Inventari d'Actius IT</h1>
    <!-- <div class="subtitle"><p>Gestió de recursos i emagatzematge</p></div> -->
             <?php foreach( $products as $product ) : ?>
                <div class="product-card-row mb-4">
                    <div class="product-accent"></div> <div class="product-content">
                        <div class="product-data">
                            <div class="data-item">
                                <small class="text-secondary uppercase">Code</small>
                                <span class="value code">#<?= $product->getProductCode(); ?></span>
                            </div>
                            <div class="data-item">
                                <small class="text-secondary uppercase">Name</small>
                                <span class="value name"><?= $product->getProductName(); ?></span>
                            </div>
                            <div class="data-item">
                                <small class="text-secondary uppercase">Short Name</small>
                                <span class="value"><?= $product->getProductShortName(); ?></span>
                            </div>
                            <div class="data-item price-tag">
                                <small class="text-secondary uppercase">PVP</small>
                                <span class="value text-success"><?= $product->getProductPvp(); ?>€</span>
                            </div>
                        </div>
                        <div class="product-actions">
                            <form action="index.php? action=delete" method="POST" onsubmit="return confirm('¿Seguro que quieres borrar este actiu?');">
                                <input type="hidden" name="cod" value="<?= $product->getProductCode(); ?>">
                                <button type="submit" class="btn-delete-artistic">
                                    <i class="bi bi-trash">Eliminar</i> 
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <?php  endforeach; ?>
                <!-- <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item disabled"><a href="#" class="page-link">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item">
                        <a class="page-link" href="#" aria-current="page">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav> -->

<?php include "layouts/footer.php"?>