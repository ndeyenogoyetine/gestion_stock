<?php
$activeMenu = 'article';
$pageTitle  = 'Nouvel Article';
include ROOT . '/views/layout/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 style="color:#e2e8f0;font-weight:800;">
    <i class="bi bi-box-seam me-2" style="color:#00d4aa;"></i>
    Nouvel Article
  </h4>
  <a href="index.php?controller=article&action=index"
     class="btn btn-secondary">
    <i class="bi bi-arrow-left me-1"></i> Retour
  </a>
</div>

<div class="row justify-content-center">
  <div class="col-md-7">
    <div class="card">
      <div class="card-header">
        <i class="bi bi-box-seam me-2" style="color:#00d4aa;"></i>
        Informations de l'article
      </div>
      <div class="card-body">

        <?php if (isset($error)): ?>
          <div class="flash-error">
            ⚠️ <?= htmlspecialchars($error) ?>
          </div>
        <?php endif; ?>

        <form method="POST"
              action="index.php?controller=article&action=create">

          <div class="mb-3">
            <label class="form-label">Nom Article *</label>
            <input type="text" name="nom_article"
                   class="form-control"
                   placeholder="Ex: Riz 25kg" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Catégorie *</label>
            <input type="text" name="categorie"
                   class="form-control"
                   placeholder="Ex: Alimentaire" required>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Quantité *</label>
              <input type="number" name="quantite"
                     class="form-control"
                     min="0" placeholder="0" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Prix Unitaire (FCFA) *</label>
              <input type="number" name="prix_unitaire"
                     class="form-control"
                     min="0" step="0.01"
                     placeholder="0" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Date Fabrication *</label>
              <input type="date" name="date_fabrication"
                     class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Date Expiration *</label>
              <input type="date" name="date_expiration"
                     class="form-control" required>
            </div>
          </div>

          <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-accent px-4">
              <i class="bi bi-save me-1"></i> Enregistrer
            </button>
            <a href="index.php?controller=article&action=index"
               class="btn btn-secondary px-4">
              Annuler
            </a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<?php include ROOT . '/views/layout/footer.php'; ?>