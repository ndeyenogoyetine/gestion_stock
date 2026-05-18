<?php
$activeMenu = 'commande';
$pageTitle  = 'Nouvelle Commande';
include ROOT . '/views/layout/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 style="color:#e2e8f0;font-weight:800;">
    <i class="bi bi-cart3 me-2" style="color:#00d4aa;"></i>
    Nouvelle Commande
  </h4>
  <a href="index.php?controller=commande&action=index"
     class="btn btn-secondary">
    <i class="bi bi-arrow-left me-1"></i> Retour
  </a>
</div>

<div class="row justify-content-center">
  <div class="col-md-7">
    <div class="card">
      <div class="card-header">
        <i class="bi bi-cart3 me-2" style="color:#00d4aa;"></i>
        Informations de la commande
      </div>
      <div class="card-body">

        <?php if (isset($error)): ?>
          <div class="flash-error">
            ⚠️ <?= htmlspecialchars($error) ?>
          </div>
        <?php endif; ?>

        <form method="POST"
              action="index.php?controller=commande&action=create">

          <div class="mb-3">
            <label class="form-label">Article *</label>
            <select name="id_article" class="form-select" required>
              <option value="">— Sélectionner un article —</option>
              <?php foreach ($articles as $a): ?>
                <option value="<?= $a['id'] ?>">
                  <?= htmlspecialchars($a['nom_article']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Fournisseur *</label>
            <select name="id_fournisseur" class="form-select" required>
              <option value="">— Sélectionner un fournisseur —</option>
              <?php foreach ($fournisseurs as $f): ?>
                <option value="<?= $f['id'] ?>">
                  <?= htmlspecialchars($f['nom']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="row">
            <div class="col-md-4 mb-3">
              <label class="form-label">Quantité *</label>
              <input type="number" name="quantite"
                     class="form-control"
                     min="1" value="1" required>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Prix (FCFA) *</label>
              <input type="number" name="prix"
                     class="form-control"
                     min="0" step="0.01"
                     placeholder="0" required>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Date Commande *</label>
              <input type="date" name="date_commande"
                     class="form-control"
                     value="<?= date('Y-m-d') ?>" required>
            </div>
          </div>

          <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-accent px-4">
              <i class="bi bi-save me-1"></i> Commander
            </button>
            <a href="index.php?controller=commande&action=index"
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