<?php
$activeMenu = 'commande';
$pageTitle  = 'Commandes';
include ROOT . '/views/layout/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 style="color:#e2e8f0;font-weight:800;">
    <i class="bi bi-cart3 me-2" style="color:#00d4aa;"></i>Commandes
  </h4>
  <a href="index.php?controller=commande&action=create"
     class="btn btn-accent">
    <i class="bi bi-plus-lg me-1"></i> Nouvelle Commande
  </a>
</div>

<div class="card">
  <div class="card-header">
    <i class="bi bi-table me-2" style="color:#00d4aa;"></i>
    Liste des Commandes
    <span style="background:#00d4aa;color:#0f172a;padding:2px 10px;
                 border-radius:10px;font-size:0.75rem;float:right;">
      <?= count($commandes) ?>
    </span>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table mb-0">
        <thead>
          <tr>
            <th>#</th>
            <th>Article</th>
            <th>Fournisseur</th>
            <th>Quantité</th>
            <th>Prix</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($commandes)): ?>
            <tr>
              <td colspan="7" class="text-center py-4"
                  style="color:#475569;">
                Aucune commande trouvée
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($commandes as $c): ?>
            <tr>
              <td style="color:#00d4aa;font-weight:700;">
                #<?= $c['id'] ?>
              </td>
              <td>
                <strong style="color:#e2e8f0;">
                  <?= htmlspecialchars($c['nom_article'] ?? '—') ?>
                </strong>
              </td>
              <td style="color:#94a3b8;">
                <?= htmlspecialchars($c['fournisseur_nom'] ?? '—') ?>
              </td>
              <td>
                <span style="color:#10b981;font-weight:700;">
                  <?= $c['quantite'] ?>
                </span>
              </td>
              <td style="color:#f59e0b;font-weight:700;">
                <?= number_format($c['prix'], 0, ',', ' ') ?> FCFA
              </td>
              <td style="color:#64748b;">
                <?= date('d/m/Y', strtotime($c['date_commande'])) ?>
              </td>
              <td>
                <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                <a href="index.php?controller=commande&action=delete&id=<?= $c['id'] ?>"
                   class="btn btn-sm btn-danger"
                   onclick="return confirm('Supprimer cette commande ?')">
                  <i class="bi bi-trash"></i>
                </a>
                <?php endif; ?>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include ROOT . '/views/layout/footer.php'; ?>