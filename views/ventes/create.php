<?php
$activeMenu = 'vente';
$pageTitle  = 'Nouvelle Vente';
include ROOT . '/views/layout/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 style="color:#e2e8f0;font-weight:800;">
    <i class="bi bi-cash-register me-2" style="color:#00d4aa;"></i>
    Nouvelle Vente
  </h4>
  <a href="index.php?controller=vente&action=index"
     class="btn btn-secondary">
    <i class="bi bi-arrow-left me-1"></i> Retour
  </a>
</div>

<div class="row justify-content-center">
  <div class="col-md-7">
    <div class="card">
      <div class="card-header">
        <i class="bi bi-cash-register me-2" style="color:#00d4aa;"></i>
        Informations de la vente
      </div>
      <div class="card-body">

        <?php if (isset($error)): ?>
          <div class="flash-error">
            ⚠️ <?= htmlspecialchars($error) ?>
          </div>
        <?php endif; ?>

        <form method="POST"
              action="index.php?controller=vente&action=create">

          <div class="mb-3">
            <label class="form-label">Article *</label>
            <select name="id_article" class="form-select" required>
              <option value="">— Sélectionner un article —</option>
              <?php foreach ($articles as $a): ?>
                <option value="<?= $a['id'] ?>"
                        data-prix="<?= $a['prix_unitaire'] ?>">
                  <?= htmlspecialchars($a['nom_article']) ?>
                  (Stock: <?= $a['quantite'] ?>)
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Client *</label>
            <select name="id_client" class="form-select" required>
              <option value="">— Sélectionner un client —</option>
              <?php foreach ($clients as $c): ?>
                <option value="<?= $c['id'] ?>">
                  <?= htmlspecialchars($c['nom'].' '.$c['prenom']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="row">
            <div class="col-md-4 mb-3">
              <label class="form-label">Quantité *</label>
              <input type="number" name="quantite"
                     id="quantite"
                     class="form-control"
                     min="1" value="1" required>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Prix (FCFA) *</label>
              <input type="number" name="prix"
                     id="prix"
                     class="form-control"
                     min="0" step="0.01"
                     placeholder="0" required>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Date Vente *</label>
              <input type="date" name="date_vente"
                     class="form-control"
                     value="<?= date('Y-m-d') ?>" required>
            </div>
          </div>

          <!-- Total automatique -->
          <div class="mb-3 p-3"
               style="background:#0f172a;border-radius:10px;
                      border:1px solid #2d3f57;">
            <div style="color:#64748b;font-size:0.85rem;">
              Total estimé
            </div>
            <div id="total"
                 style="color:#00d4aa;font-size:1.5rem;font-weight:800;">
              0 FCFA
            </div>
          </div>

          <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-accent px-4">
              <i class="bi bi-save me-1"></i> Enregistrer
            </button>
            <a href="index.php?controller=vente&action=index"
               class="btn btn-secondary px-4">
              Annuler
            </a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<!-- Script calcul total automatique -->
<script>
  // Remplir prix auto quand on choisit un article
  document.querySelector('[name="id_article"]')
    .addEventListener('change', function() {
      const prix = this.options[this.selectedIndex]
                       .getAttribute('data-prix');
      if (prix) {
        document.getElementById('prix').value = prix;
        calculTotal();
      }
  });

  // Calcul total automatique
  function calculTotal() {
    const quantite = parseFloat(
      document.getElementById('quantite').value
    ) || 0;
    const prix = parseFloat(
      document.getElementById('prix').value
    ) || 0;
    const total = quantite * prix;
    document.getElementById('total').textContent =
      total.toLocaleString('fr-FR') + ' FCFA';
  }

  document.getElementById('quantite')
    .addEventListener('input', calculTotal);
  document.getElementById('prix')
    .addEventListener('input', calculTotal);
</script>

<?php include ROOT . '/views/layout/footer.php'; ?>