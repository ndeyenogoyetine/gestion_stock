<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GestStock — Connexion</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      background: #0f172a;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }
    .login-box {
      background: #1e293b;
      border-radius: 16px;
      padding: 2.5rem;
      width: 100%;
      max-width: 420px;
      box-shadow: 0 25px 60px rgba(0,0,0,0.5);
    }
    .login-box h1 {
      color: #00d4aa;
      font-weight: 800;
      text-align: center;
      margin-bottom: 0.3rem;
    }
    .login-box p {
      color: #64748b;
      text-align: center;
      margin-bottom: 2rem;
    }
    .form-label { color: #94a3b8; font-weight: 600; }
    .form-control {
      background: #0f172a !important;
      border: 1px solid #2d3f57 !important;
      color: #e2e8f0 !important;
      border-radius: 8px !important;
      padding: 12px !important;
    }
    .form-control:focus {
      border-color: #00d4aa !important;
      box-shadow: 0 0 0 3px rgba(0,212,170,0.15) !important;
    }
    .btn-login {
      background: #00d4aa;
      color: #0f172a;
      font-weight: 800;
      width: 100%;
      padding: 13px;
      border: none;
      border-radius: 10px;
      font-size: 1rem;
      margin-top: 1rem;
    }
    .btn-login:hover { background: #00b894; color: #fff; }
    .alert-error {
      background: rgba(239,68,68,0.15);
      border-left: 4px solid #ef4444;
      color: #ef4444;
      border-radius: 8px;
      padding: 10px 16px;
      margin-bottom: 1.5rem;
      font-weight: 600;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h1>🏪 GestStock</h1>
    <p>Système de Gestion de Stock</p>

    <?php if (isset($error)): ?>
      <div class="alert-error">
        ⚠️ <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=auth&action=login">
      <div class="mb-3">
        <label class="form-label">Login</label>
        <input type="text" name="login" class="form-control"
               placeholder="Votre login" required autofocus>
      </div>
      <div class="mb-3">
        <label class="form-label">Mot de passe</label>
        <input type="password" name="password" class="form-control"
               placeholder="••••••••" required>
      </div>
      <button type="submit" class="btn-login">
        Se connecter →
      </button>
    </form>
  </div>
</body>
</html>