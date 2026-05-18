<?php
$activeMenu = 'client';
$pageTitle  = 'Clients';
include ROOT . '/views/layout/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 style="color:#e2e8f0;font-weight:800;">
    <i class="bi bi-people me-2" style="color:#00d4aa;"></i>Clients
  </h4>
  <a href="index.php?controller=client&action=create"
     class="btn btn-accent">
    <i class="bi bi-plus-lg me-1"></i> Nouveau Client
  </a>
</div>

<div class="card">
  <div class="card-header">
    <i class="bi bi-table me-2" style="color:#00d4aa;"></i>
    Liste des Clients
    <span style="background:#00d4aa;color:#0f172a;padding:2px 10px;
                 border-radius:10px;font-size:0.75rem;float:right;">
      <?= count($clients) ?>
    </span>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table mb-0">
        <thead>
          <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Téléphone</th>
            <th>Adresse</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($clients)): ?>
            <tr>
              <td colspan="6" class="text-center py-4"
                  style="color:#475569;">
                Aucun client trouvé
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($clients as $c): ?>
            <tr>
              <td style="color:#00d4aa;font-weight:700;">
                #<?= $c['id'] ?>
              </td>
              <td>
                <strong style="color:#e2e8f0;">
                  <?= htmlspecialchars($c['nom']) ?>
                </strong>
              </td>
              <td><?= htmlspecialchars($c['prenom']) ?></td>
              <td style="color:#94a3b8;">
                <?= htmlspecialchars($c['telephone'] ?? '—') ?>
              </td>
              <td style="color:#64748b;">
                <?= htmlspecialchars($c['adresse'] ?? '—') ?>
              </td>
              <td>
                <a href="index.php?controller=client&action=edit&id=<?= $c['id'] ?>"
                   class="btn btn-sm btn-warning me-1">
                  <i class="bi bi-pencil"></i>
                </a>
                <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                <a href="index.php?controller=client&action=delete&id=<?= $c['id'] ?>"
                   class="btn btn-sm btn-danger"
                   onclick="return confirm('Supprimer ce client ?')">
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