<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GestStock</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
  <style>
    body { background: #0f172a; color: #e2e8f0; font-family: 'Segoe UI', sans-serif; }
    .sidebar {
      background: #1e293b;
      min-height: 100vh;
      width: 250px;
      position: fixed;
      top: 0; left: 0;
      padding: 1.5rem 0;
      border-right: 1px solid #2d3f57;
    }
    .sidebar .brand {
      color: #00d4aa;
      font-weight: 800;
      font-size: 1.4rem;
      padding: 0 1.5rem 1.5rem;
      border-bottom: 1px solid #2d3f57;
      display: block;
    }
    .sidebar .nav-link {
      color: #94a3b8;
      padding: 0.7rem 1.5rem;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: all 0.2s;
    }
    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
      color: #fff;
      background: rgba(0,212,170,0.1);
      border-left: 3px solid #00d4aa;
    }
    .sidebar .nav-header {
      color: #475569;
      font-size: 0.7rem;
      letter-spacing: 2px;
      padding: 1rem 1.5rem 0.3rem;
      text-transform: uppercase;
    }
    .main-content {
      margin-left: 250px;
      padding: 2rem;
    }
    .topbar {
      background: #1e293b;
      border-bottom: 1px solid #2d3f57;
      padding: 1rem 2rem;
      margin-left: 250px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .card {
      background: #1e293b !important;
      border: 1px solid #2d3f57 !important;
      border-radius: 12px !important;
    }
    .card-header {
      background: transparent !important;
      border-bottom: 1px solid #2d3f57 !important;
      color: #e2e8f0 !important;
      font-weight: 700;
    }
    .table { color: #cbd5e1 !important; }
    .table thead th {
      background: #0f172a !important;
      color: #94a3b8 !important;
      border-color: #2d3f57 !important;
      font-size: 0.75rem;
      text-transform: uppercase;
    }
    .table td { border-color: #2d3f57 !important; vertical-align: middle !important; }
    .flash-success {
      background: rgba(16,185,129,0.15);
      border-left: 4px solid #10b981;
      color: #10b981;
      border-radius: 8px;
      padding: 10px 16px;
      margin-bottom: 1rem;
      font-weight: 600;
    }
    .flash-error {
      background: rgba(239,68,68,0.15);
      border-left: 4px solid #ef4444;
      color: #ef4444;
      border-radius: 8px;
      padding: 10px 16px;
      margin-bottom: 1rem;
      font-weight: 600;
    }
    .form-control, .form-select {
      background: #0f172a !important;
      border: 1px solid #2d3f57 !important;
      color: #e2e8f0 !important;
      border-radius: 8px !important;
    }
    .form-control:focus, .form-select:focus {
      border-color: #00d4aa !important;
      box-shadow: 0 0 0 3px rgba(0,212,170,0.15) !important;
    }
    .form-label { color: #94a3b8 !important; font-weight: 600; }
    .btn-accent {
      background: #00d4aa;
      color: #0f172a;
      font-weight: 700;
      border: none;
    }
    .btn-accent:hover { background: #00b894; color: #fff; }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <a href="index.php" class="brand">🏪 GestStock</a>

  <div class="nav-header">Principal</div>
  <a href="index.php?controller=dashboard&action=index"
     class="nav-link <?= (isset($activeMenu) && $activeMenu==='dashboard') ? 'active' : '' ?>">
    <i class="bi bi-speedometer2"></i> Dashboard
  </a>

  <div class="nav-header">Stock</div>
  <a href="index.php?controller=article&action=index"
     class="nav-link <?= (isset($activeMenu) && $activeMenu==='article') ? 'active' : '' ?>">
    <i class="bi bi-box-seam"></i> Articles
  </a>
  <a href="index.php?controller=fournisseur&action=index"
     class="nav-link <?= (isset($activeMenu) && $activeMenu==='fournisseur') ? 'active' : '' ?>">
    <i class="bi bi-truck"></i> Fournisseurs
  </a>
  <a href="index.php?controller=commande&action=index"
     class="nav-link <?= (isset($activeMenu) && $activeMenu==='commande') ? 'active' : '' ?>">
    <i class="bi bi-cart3"></i> Commandes
  </a>

  <div class="nav-header">Ventes</div>
  <a href="index.php?controller=vente&action=index"
     class="nav-link <?= (isset($activeMenu) && $activeMenu==='vente') ? 'active' : '' ?>">
    <i class="bi bi-cash-register"></i> Ventes
  </a>
  <a href="index.php?controller=client&action=index"
     class="nav-link <?= (isset($activeMenu) && $activeMenu==='client') ? 'active' : '' ?>">
    <i class="bi bi-people"></i> Clients
  </a>

  <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
  <div class="nav-header">Administration</div>
  <a href="index.php?controller=utilisateur&action=index"
     class="nav-link <?= (isset($activeMenu) && $activeMenu==='utilisateur') ? 'active' : '' ?>">
    <i class="bi bi-person-gear"></i> Utilisateurs
  </a>
  <?php endif; ?>

  <div style="position:absolute;bottom:20px;left:0;right:0;padding:0 1.5rem;">
    <a href="index.php?controller=auth&action=logout"
       class="nav-link" style="color:#ef4444;">
      <i class="bi bi-box-arrow-left"></i> Déconnexion
    </a>
  </div>
</div>

<!-- Topbar -->
<div class="topbar">
  <h6 style="margin:0;color:#e2e8f0;">
    <?= isset($pageTitle) ? $pageTitle : 'Dashboard' ?>
  </h6>
  <div style="color:#94a3b8;font-size:0.9rem;">
    <i class="bi bi-person-circle me-1"></i>
    <?= htmlspecialchars($_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']) ?>
    <span style="background:#00d4aa;color:#0f172a;padding:2px 8px;border-radius:10px;font-size:0.75rem;margin-left:8px;">
      <?= $_SESSION['user']['role'] ?>
    </span>
  </div>
</div>

<!-- Contenu principal -->
<div class="main-content">

  <?php if (isset($_SESSION['flash'])): ?>
    <div class="flash-<?= $_SESSION['flash']['type'] ?>">
      <?= htmlspecialchars($_SESSION['flash']['message']) ?>
    </div>
    <?php unset($_SESSION['flash']); ?>
  <?php endif; ?>