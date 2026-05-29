<?php  include "layouts/header.php";?>
<link rel="stylesheet" href="assets/style.css">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <div>
        <h1 class="h3 fw-bold text-dark mb-1">Nova Categoria</h1>
        <p class="text-muted small">Gestiona i organitza los tipus d'actius del teu inventari</p>
    </div>
    <div>
        <a href="index.php?action=list_categories" class="btn btn-outline-secondary btn-sm px-3 rounded-2 fw-medium">
            <i class="bi bi-arrow-left me-1"></i> Tornar al llistat
        </a>
    </div>
</div>

<div class="row justify-content-start">
    <div class="col-12 col-xl-6">
        <div class="card border-0 shadow-sm p-4 text-dark" style="border-radius: 12px; background: #ffffff;">
            
            <div class="d-flex align-items-center mb-4">
                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2 me-3">
                    <i class="bi bi-tags-fill fs-4"></i>
                </div>
                <div>
                    <h5 class="card-title fw-bold mb-0">Detalls de la Categoria</h5>
                    <small class="text-muted">Tots els camps són obligatoris</small>
                </div>
            </div>

            <form action="index.php?action=store_category" method="POST" autocomplete="off">
                
                <div class="mb-4">
                    <label for="id" class="form-label fw-semibold text-secondary small mb-1">Identificador (ID)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 8px 0 0 8px;">
                            <i class="bi bi-hash"></i>
                        </span>
                        <input type="text" 
                               class="form-control bg-light border-start-0" 
                               id="id" 
                               name="id" 
                               placeholder="Ex: 1, 20..." 
                               required 
                               style="border-radius: 0 8px 8px 0; padding: 0.6rem 0.75rem;">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="name" class="form-label fw-semibold text-secondary small mb-1">Nom de la Categoria</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 8px 0 0 8px;">
                            <i class="bi bi-bookmark-fill"></i>
                        </span>
                        <input type="text" 
                               class="form-control bg-light border-start-0" 
                               id="name" 
                               name="name" 
                               placeholder="Ex: Portàtils, Servidors, Perifèrics..." 
                               required 
                               style="border-radius: 0 8px 8px 0; padding: 0.6rem 0.75rem;">
                    </div>
                </div>

                <div class="d-flex gap-2 pt-2 border-top">
                    <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold shadow-sm" style="border-radius: 8px;">
                        <i class="bi bi-cloud-check-fill me-2"></i>Desar Categoria
                    </button>
                    <button type="reset" class="btn btn-light text-secondary px-4 py-2 fw-semibold" style="border-radius: 8px;">
                        Netejar
                    </button>
                </div>
                
            </form>
        </div>
    </div>
</div>
<?php include "layouts/footer.php"?>