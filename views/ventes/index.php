<?php
$activeMenu = 'vente';
$pageTitle  = 'Ventes';
include ROOT . '/views/layout/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 style="color:#e2e8f0;font-weight:800;">
    <i class="bi bi-cash-register me-2" style="color:#00d4aa;"></i>Ventes
  </h4>
  <a href="index.php?controller=vente&action=create"
     class="btn btn-accent">
    <i class="bi bi-plus-lg me-1"></i> Nouvelle Vente
  </a>
</div>

<div class="card">
  <div class="card-header">
    <i class="bi bi-table me-2" style="color:#00d4aa;"></i>
    Liste des Ventes
    <span style="background:#00d4aa;color:#0f172a;padding:2px 10px;
                 border-radius:10px;font-size:0.75rem;float:right;">
      <?= count($ventes) ?>
    </span>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table mb-0">
        <thead>
          <tr>
            <th>#</th>
            <th>Article</th>
            <th>Client</th>
            <th>Quantité</th>
            <th>Prix</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($ventes)): ?>
            <tr>
              <td colspan="7" class="text-center py-4"
                  style="color:#475569;">
                Aucune vente trouvée
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($ventes as $v): ?>
            <tr>
              <td style="color:#00d4aa;font-weight:700;">
                #<?= $v['id'] ?>
              </td>
              <td>
                <strong style="color:#e2e8f0;">
                  <?= htmlspecialchars($v['nom_article'] ?? '—') ?>
                </strong>
              </td>
              <td style="color:#94a3b8;">
                <?= htmlspecialchars($v['client_nom'] ?? '—') ?>
                <?= htmlspecialchars($v['client_prenom'] ?? '') ?>
              </td>
              <td>
                <span style="color:#10b981;font-weight:700;">
                  <?= $v['quantite'] ?>
                </span>
              </td>
              <td style="color:#f59e0b;font-weight:700;">
                <?= number_format($v['prix'], 0, ',', ' ') ?> FCFA
              </td>
              <td style="color:#64748b;">
                <?= date('d/m/Y', strtotime($v['date_vente'])) ?>
              </td>
              <td>
                <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                <a href="index.php?controller=vente&action=delete&id=<?= $v['id'] ?>"
                   class="btn btn-sm btn-danger"
                   onclick="return confirm('Supprimer cette vente ?')">
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