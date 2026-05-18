<?php
$activeMenu = 'article';
$pageTitle  = 'Articles';
include ROOT . '/views/layout/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 style="color:#e2e8f0;font-weight:800;">
    <i class="bi bi-box-seam me-2" style="color:#00d4aa;"></i>Articles
  </h4>
  <a href="index.php?controller=article&action=create"
     class="btn btn-accent">
    <i class="bi bi-plus-lg me-1"></i> Nouvel Article
  </a>
</div>

<div class="card">
  <div class="card-header">
    <i class="bi bi-table me-2" style="color:#00d4aa;"></i>
    Liste des Articles
    <span style="background:#00d4aa;color:#0f172a;padding:2px 10px;
                 border-radius:10px;font-size:0.75rem;float:right;">
      <?= count($articles) ?>
    </span>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table mb-0">
        <thead>
          <tr>
            <th>#</th>
            <th>Nom Article</th>
            <th>Catégorie</th>
            <th>Quantité</th>
            <th>Prix Unitaire</th>
            <th>Date Expiration</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($articles)): ?>
            <tr>
              <td colspan="7" class="text-center py-4"
                  style="color:#475569;">
                Aucun article trouvé
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($articles as $a): ?>
            <tr>
              <td style="color:#00d4aa;font-weight:700;">
                #<?= $a['id'] ?>
              </td>
              <td>
                <strong style="color:#e2e8f0;">
                  <?= htmlspecialchars($a['nom_article']) ?>
                </strong>
              </td>
              <td>
                <span style="background:rgba(108,99,255,0.2);
                             color:#6c63ff;padding:3px 10px;
                             border-radius:10px;font-size:0.8rem;">
                  <?= htmlspecialchars($a['categorie']) ?>
                </span>
              </td>
              <td>
                <span style="color:#10b981;font-weight:700;">
                  <?= $a['quantite'] ?>
                </span>
              </td>
              <td style="color:#f59e0b;font-weight:700;">
                <?= number_format($a['prix_unitaire'], 0, ',', ' ') ?> FCFA
              </td>
              <td style="color:#64748b;">
                <?= date('d/m/Y', strtotime($a['date_expiration'])) ?>
              </td>
              <td>
                <a href="index.php?controller=article&action=edit&id=<?= $a['id'] ?>"
                   class="btn btn-sm btn-warning me-1">
                  <i class="bi bi-pencil"></i>
                </a>
                <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                <a href="index.php?controller=article&action=delete&id=<?= $a['id'] ?>"
                   class="btn btn-sm btn-danger"
                   onclick="return confirm('Supprimer cet article ?')">
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