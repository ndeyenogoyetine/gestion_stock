<?php
$activeMenu = 'client';
$pageTitle  = 'Nouveau Client';
include ROOT . '/views/layout/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 style="color:#e2e8f0;font-weight:800;">
    <i class="bi bi-person-plus me-2" style="color:#00d4aa;"></i>
    Nouveau Client
  </h4>
  <a href="index.php?controller=client&action=index"
     class="btn btn-secondary">
    <i class="bi bi-arrow-left me-1"></i> Retour
  </a>
</div>

<div class="row justify-content-center">
  <div class="col-md-7">
    <div class="card">
      <div class="card-header">
        <i class="bi bi-people me-2" style="color:#00d4aa;"></i>
        Informations du client
      </div>
      <div class="card-body">

        <?php if (isset($error)): ?>
          <div class="flash-error">
            ⚠️ <?= htmlspecialchars($error) ?>
          </div>
        <?php endif; ?>

        <form method="POST"
              action="index.php?controller=client&action=create">

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Nom *</label>
              <input type="text" name="nom"
                     class="form-control"
                     placeholder="Nom" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Prénom *</label>
              <input type="text" name="prenom"
                     class="form-control"
                     placeholder="Prénom" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Téléphone</label>
            <input type="text" name="telephone"
                   class="form-control"
                   placeholder="77 000 00 00">
          </div>

          <div class="mb-3">
            <label class="form-label">Adresse</label>
            <textarea name="adresse"
                      class="form-control" rows="3"
                      placeholder="Adresse complète..."></textarea>
          </div>

          <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-accent px-4">
              <i class="bi bi-save me-1"></i> Enregistrer
            </button>
            <a href="index.php?controller=client&action=index"
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