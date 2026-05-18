<?php
$activeMenu = 'utilisateur';
$pageTitle  = 'Utilisateurs';
include ROOT . '/views/layout/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 style="color:#e2e8f0;font-weight:800;">
    <i class="bi bi-person-gear me-2" style="color:#00d4aa;"></i>Utilisateurs
  </h4>
  <a href="index.php?controller=utilisateur&action=create"
     class="btn btn-accent">
    <i class="bi bi-plus-lg me-1"></i> Nouvel Utilisateur
  </a>
</div>

<div class="card">
  <div class="card-header">
    <i class="bi bi-table me-2" style="color:#00d4aa;"></i>
    Liste des Utilisateurs
    <span style="background:#00d4aa;color:#0f172a;padding:2px 10px;
                 border-radius:10px;font-size:0.75rem;float:right;">
      <?= count($utilisateurs) ?>
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
            <th>Email</th>
            <th>Rôle</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($utilisateurs)): ?>
            <tr>
              <td colspan="6" class="text-center py-4"
                  style="color:#475569;">
                Aucun utilisateur trouvé
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($utilisateurs as $u): ?>
            <tr>
              <td style="color:#00d4aa;font-weight:700;">
                #<?= $u['id'] ?>
              </td>
              <td>
                <strong style="color:#e2e8f0;">
                  <?= htmlspecialchars($u['nom']) ?>
                </strong>
              </td>
              <td><?= htmlspecialchars($u['prenom']) ?></td>
              <td style="color:#94a3b8;">
                <?= htmlspecialchars($u['email'] ?? '—') ?>
              </td>
              <td>
                <?php if ($u['role'] === 'admin'): ?>
                  <span style="background:rgba(0,212,170,0.2);
                               color:#00d4aa;padding:3px 10px;
                               border-radius:10px;font-size:0.8rem;">
                    ⭐ Admin
                  </span>
                <?php else: ?>
                  <span style="background:rgba(148,163,184,0.2);
                               color:#94a3b8;padding:3px 10px;
                               border-radius:10px;font-size:0.8rem;">
                    👤 User
                  </span>
                <?php endif; ?>
              </td>
              <td>
                <?php if ($u['id'] != $_SESSION['user']['id']): ?>
                  <a href="index.php?controller=utilisateur&action=delete&id=<?= $u['id'] ?>"
                     class="btn btn-sm btn-danger"
                     onclick="return confirm('Supprimer cet utilisateur ?')">
                    <i class="bi bi-trash"></i>
                  </a>
                <?php else: ?>
                  <span style="color:#475569;font-size:0.8rem;">
                    <i class="bi bi-person me-1"></i>Vous
                  </span>
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