<?php  include "layouts/header.php";?>
<link rel="stylesheet" href="assets/style.css">
<div class="principal_title"><?=  isset($product)? "Editar Actiu" : "Creació de nou actiu" ?></div>
        <div class="add_Product_Body artistic-card">
            <div class="card-header-artistic">
                <span class="icon">📁</span>
                <h5>Informació de l'Actiu</h5>
                <div class="header-line"></div>
            </div>

            <form action="" method="POST" class="artistic-form">
                <div class="form-floating mb-4">
                    <input type="text" name="nombre" 
                        value="<?= isset($product) ? $product->getProductName() : '' ?>" 
                        class="form-control artistic-input <?php echo isset($errors['nombre']) ? 'is-invalid' : ''; ?>" 
                        id="nameInput" placeholder="Pablito" required>
                    <label for="nameInput">Name</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="text" name="short_name" 
                        value="<?= isset($product) ? $product->getProductShortName() : '' ?>" 
                        class="form-control artistic-input <?php echo isset($errors['short']) ? 'is-invalid' : ''; ?>" 
                        id="ShortNameInput" placeholder="Carcasa" required>
                    <label for="ShortNameInput">Short Name</label>
                </div>

                <div class="form-floating mb-4">
                    <select name="category" 
                            class="form-select artistic-input <?php echo isset($errors['category']) ? 'is-invalid' : ''; ?>" 
                            id="categoryInput" 
                            required>
                        
                        <option value="" disabled <?= !isset($product) ? 'selected' : '' ?>>Selecciona una categoria...</option>
                        
                        <?php if (!empty($categoriesList)): ?>
                            <?php foreach ($categoriesList as $cat): ?>
                                <?php 
                                    // Comprobamos cuál debe estar seleccionada (en caso de edición)
                                    $selected = '';
                                    if (isset($product) && $product->getProductCategory() == $cat->getCategoryId()) {
                                        $selected = 'selected';
                                    }
                                ?>
                                <option value="<?= $cat->getCategoryId() ?>" <?= $selected ?>>
                                    <?= htmlspecialchars($cat->getCategoryName()) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </select>
                    <label for="categoryInput">Category</label>
                    
                    <?php if (isset($errors['category'])): ?>
                        <div class="invalid-feedback">
                            <?= $errors['category'] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="input-group mb-4 has-validation">
                    <span class="input-group-text artistic-addon">$</span>
                    <input type="number" step="0.01" 
                        value="<?= isset($product) ? $product-> getProductPvp() : '' ?>"
                        class="form-control artistic-input <?php echo isset($errors['Pvp']) ? 'is-invalid' : ''; ?>" 
                        name="pvp" id="PVPInput" placeholder="0.00" required>
                    <span class="input-group-text artistic-addon">.00</span>
                    
                    <?php if(isset($errors['Pvp'])): ?>
                        <div class="invalid-feedback"><?= $errors['Pvp'] ?></div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn-submit-artistic">
                    <span><?=  isset($product)? "Guardar dades" : "Enviar dades"?></span>
                    <i class="bi bi-send-fill"></i>
                </button>
            </form>
        </div>
<?php include "layouts/footer.php"?>