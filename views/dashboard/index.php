<?php 
$activeMenu = 'dashboard'; 
$pageTitle  = 'Dashboard';
include ROOT . '/views/layout/header.php'; 
?>

<!-- Statistiques -->
<div class="row mb-4">

  <div class="col-md-4 mb-3">
    <div class="card p-3">
      <div class="d-flex align-items-center gap-3">
        <div style="background:rgba(0,212,170,0.15);padding:15px;border-radius:12px;">
          <i class="bi bi-box-seam" style="color:#00d4aa;font-size:1.8rem;"></i>
        </div>
        <div>
          <div style="color:#64748b;font-size:0.85rem;">Articles</div>
          <div style="color:#fff;font-size:1.8rem;font-weight:800;">
            <?= $stats['nb_articles'] ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-3">
    <div class="card p-3">
      <div class="d-flex align-items-center gap-3">
        <div style="background:rgba(108,99,255,0.15);padding:15px;border-radius:12px;">
          <i class="bi bi-people" style="color:#6c63ff;font-size:1.8rem;"></i>
        </div>
        <div>
          <div style="color:#64748b;font-size:0.85rem;">Clients</div>
          <div style="color:#fff;font-size:1.8rem;font-weight:800;">
            <?= $stats['nb_clients'] ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-3">
    <div class="card p-3">
      <div class="d-flex align-items-center gap-3">
        <div style="background:rgba(245,158,11,0.15);padding:15px;border-radius:12px;">
          <i class="bi bi-truck" style="color:#f59e0b;font-size:1.8rem;"></i>
        </div>
        <div>
          <div style="color:#64748b;font-size:0.85rem;">Fournisseurs</div>
          <div style="color:#fff;font-size:1.8rem;font-weight:800;">
            <?= $stats['nb_fournisseurs'] ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6 mb-3">
    <div class="card p-3">
      <div class="d-flex align-items-center gap-3">
        <div style="background:rgba(16,185,129,0.15);padding:15px;border-radius:12px;">
          <i class="bi bi-cash-register" style="color:#10b981;font-size:1.8rem;"></i>
        </div>
        <div>
          <div style="color:#64748b;font-size:0.85rem;">Chiffre d'affaires ce mois</div>
          <div style="color:#10b981;font-size:1.8rem;font-weight:800;">
            <?= number_format($stats['ca_mois'], 0, ',', ' ') ?> FCFA
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6 mb-3">
    <div class="card p-3">
      <div class="d-flex align-items-center gap-3">
        <div style="background:rgba(59,130,246,0.15);padding:15px;border-radius:12px;">
          <i class="bi bi-cart3" style="color:#3b82f6;font-size:1.8rem;"></i>
        </div>
        <div>
          <div style="color:#64748b;font-size:0.85rem;">Commandes</div>
          <div style="color:#fff;font-size:1.8rem;font-weight:800;">
            <?= $stats['nb_commandes'] ?>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- Graphique + Ventes récentes -->
<div class="row">

  <!-- Graphique -->
  <div class="col-md-7 mb-4">
    <div class="card">
      <div class="card-header">
        <i class="bi bi-bar-chart me-2" style="color:#00d4aa;"></i>
        Ventes par mois
      </div>
      <div class="card-body">
        <canvas id="ventesChart" height="120"></canvas>
      </div>
    </div>
  </div>

  <!-- Ventes récentes -->
  <div class="col-md-5 mb-4">
    <div class="card">
      <div class="card-header">
        <i class="bi bi-clock-history me-2" style="color:#00d4aa;"></i>
        Ventes récentes
      </div>
      <div class="card-body p-0">
        <table class="table mb-0">
          <thead>
            <tr>
              <th>Article</th>
              <th>Client</th>
              <th>Prix</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($ventes_recentes)): ?>
              <tr>
                <td colspan="3" class="text-center py-3"
                    style="color:#475569;">
                  Aucune vente
                </td>
              </tr>
            <?php else: ?>
              <?php foreach ($ventes_recentes as $v): ?>
              <tr>
                <td><?= htmlspecialchars($v['nom_article'] ?? '—') ?></td>
                <td><?= htmlspecialchars($v['client_nom'] ?? '—') ?></td>
                <td style="color:#10b981;font-weight:700;">
                  <?= number_format($v['prix'], 0, ',', ' ') ?>
                </td>
              </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

<!-- Script graphique -->
<script>
const ventesData  = <?= json_encode($ventes_mois) ?>;
const moisLabels  = ['Jan','Fév','Mar','Avr','Mai','Jun',
                     'Jul','Aoû','Sep','Oct','Nov','Déc'];
const dataPoints  = Array(12).fill(0);
ventesData.forEach(v => {
    dataPoints[v.mois - 1] = parseFloat(v.total);
});

new Chart(document.getElementById('ventesChart'), {
    type: 'line',
    data: {
        labels: moisLabels,
        datasets: [{
            label: 'Ventes (FCFA)',
            data: dataPoints,
            borderColor: '#00d4aa',
            backgroundColor: 'rgba(0,212,170,0.1)',
            borderWidth: 2.5,
            pointBackgroundColor: '#00d4aa',
            tension: 0.4,
            fill: true,
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { labels: { color: '#94a3b8' } }
        },
        scales: {
            x: { ticks: { color: '#64748b' }, grid: { color: '#1e293b' } },
            y: { ticks: { color: '#64748b' }, grid: { color: '#1e293b' } }
        }
    }
});
</script>

<?php include ROOT . '/views/layout/footer.php'; ?>