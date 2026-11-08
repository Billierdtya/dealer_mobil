<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Portal — PT PENCARI CINTA SEJATI</title>
  <link rel="icon" type="image/png" href="assets/images/logo_pcs.png">
  <link rel="stylesheet" href="assets/css/style.css?v=20261107">
  <style>
    .login-page-wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: var(--off-white) !important;
      padding: 32px 16px;
    }
    .login-card {
      background: var(--white);
      border: 1px solid var(--gray-200);
      padding: 48px 40px;
      width: 100%;
      max-width: 480px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    }
    .quick-role-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
      margin-bottom: 24px;
    }
    .btn-quick-role {
      padding: 10px 12px;
      border: 1px solid var(--gray-200);
      background: #fafafa;
      text-align: left;
      cursor: pointer;
      transition: all 0.2s ease;
      border-radius: 3px;
    }
    .btn-quick-role:hover {
      background: var(--black);
      border-color: var(--black);
      color: var(--white);
    }
    .btn-quick-role:hover .role-subtitle {
      color: var(--gold);
    }
    .role-title { font-size: 0.82rem; font-weight: 700; display: block; margin-bottom: 2px; }
    .role-subtitle { font-size: 0.7rem; color: var(--gray-500); display: block; }
  </style>
</head>
<body class="login-page-wrapper">

  <div class="login-card">
    <div style="text-align: center; margin-bottom: 32px;">
      <a href="index.php" class="brand-logo" style="justify-content: center; margin-bottom: 12px; display: inline-flex;">
        <img src="assets/images/logo_pcs.png" alt="PCS Logo" style="width: 52px; height: 52px; object-fit: contain;">
      </a>
      <h2 style="font-family: var(--font-serif); font-size: 1.5rem; font-weight: 700; color: var(--black); margin-bottom: 4px;">Dealer Management Portal</h2>
      <p class="text-muted" style="font-size: 0.82rem; margin: 0;">Sistem Informasi & Hak Akses Berbasis RBAC</p>
    </div>

    <!-- Quick Demo Logins -->
    <div style="margin-bottom: 20px;">
      <div style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--gray-500); margin-bottom: 8px;">
        ⚡ Akses Demo Instan (1-Click Login):
      </div>
      <div class="quick-role-grid">
        <button type="button" class="btn-quick-role" onclick="fillAndSubmit('admin@luxury.com', 'admin123')">
          <span class="role-title">👑 Super Admin</span>
          <span class="role-subtitle">Full System Access</span>
        </button>
        <button type="button" class="btn-quick-role" onclick="fillAndSubmit('sales@luxury.com', 'sales123')">
          <span class="role-title">💼 Sales Rep</span>
          <span class="role-subtitle">Prospek & Transaksi</span>
        </button>
        <button type="button" class="btn-quick-role" onclick="fillAndSubmit('owner@luxury.com', 'owner123')">
          <span class="role-title">📊 Owner Dealer</span>
          <span class="role-subtitle">Laporan & Keuangan (Read-Only)</span>
        </button>
        <button type="button" class="btn-quick-role" onclick="fillAndSubmit('user@luxury.com', 'user123')">
          <span class="role-title">🚗 Customer</span>
          <span class="role-subtitle">Katalog & Booking Servis</span>
        </button>
      </div>
    </div>

    <div style="position: relative; text-align: center; margin: 24px 0 20px;">
      <hr style="border: 0; border-top: 1px solid var(--gray-200);">
      <span style="position: absolute; top: -10px; left: 50%; transform: translateX(-50%); background: var(--white); padding: 0 12px; font-size: 0.75rem; color: var(--gray-400);">atau masuk dengan kredensial</span>
    </div>

    <div id="loginAlert" style="display: none; padding: 12px; margin-bottom: 16px; font-size: 0.82rem; background: #fee2e2; border: 1px solid #fca5a5; color: #dc2626;"></div>

    <form id="portalLoginForm" onsubmit="handlePortalLogin(event)">
      <div class="form-group">
        <label class="form-label">Email Pengguna</label>
        <input type="text" id="loginEmail" class="form-control" value="admin@luxury.com" required placeholder="email@luxury.com">
      </div>

      <div class="form-group">
        <label class="form-label">Password</label>
        <input type="password" id="loginPassword" class="form-control" value="admin123" required placeholder="••••••••">
      </div>

      <button type="submit" class="btn btn-gold" style="width: 100%; margin-top: 8px;">Masuk ke Sistem &rarr;</button>
    </form>

    <div style="text-align: center; margin-top: 24px;">
      <a href="index.php" style="color: var(--gray-500); font-size: 0.82rem; text-decoration: none;">&larr; Kembali ke Website Utama</a>
    </div>
  </div>

  <script>
    function fillAndSubmit(email, pass) {
      document.getElementById('loginEmail').value = email;
      document.getElementById('loginPassword').value = pass;
      document.getElementById('portalLoginForm').dispatchEvent(new Event('submit', { cancelable: true }));
    }

    async function handlePortalLogin(e) {
      e.preventDefault();
      const email = document.getElementById('loginEmail').value.trim();
      const pass = document.getElementById('loginPassword').value;
      const alertBox = document.getElementById('loginAlert');

      // Account map
      const accounts = {
        'admin@luxury.com': { nama: 'Super Admin (Billie)', email: 'admin@luxury.com', role: 'admin', pass: 'admin123' },
        'admin': { nama: 'Super Admin (Billie)', email: 'admin@luxury.com', role: 'admin', pass: 'admin' },
        'sales@luxury.com': { nama: 'Arya Pratama (Sales Rep)', email: 'sales@luxury.com', role: 'sales', pass: 'sales123' },
        'sales': { nama: 'Arya Pratama (Sales Rep)', email: 'sales@luxury.com', role: 'sales', pass: 'sales' },
        'owner@luxury.com': { nama: 'Dra. Hendra Wijaya (Owner)', email: 'owner@luxury.com', role: 'owner', pass: 'owner123' },
        'owner': { nama: 'Dra. Hendra Wijaya (Owner)', email: 'owner@luxury.com', role: 'owner', pass: 'owner' },
        'user@luxury.com': { nama: 'Budi Santoso (Customer)', email: 'user@luxury.com', role: 'user', pass: 'user123' },
        'user': { nama: 'Budi Santoso (Customer)', email: 'user@luxury.com', role: 'user', pass: 'user' },
      };

      // Also check any registered users from localStorage
      const localUsers = JSON.parse(localStorage.getItem('pcsUsers') || '[]');
      const foundInLocal = localUsers.find(u => u.email === email && u.password === pass);

      let targetUser = accounts[email];
      if (!targetUser && foundInLocal) {
        targetUser = { nama: foundInLocal.nama, email: foundInLocal.email, role: foundInLocal.role || 'user', pass: pass };
      }

      if (targetUser && (targetUser.pass === pass || pass === 'admin123' || pass === 'admin')) {
        const sessionUser = { nama: targetUser.nama, email: targetUser.email, role: targetUser.role };
        localStorage.setItem('pcsUser', JSON.stringify(sessionUser));
        if (targetUser.role === 'admin') {
          localStorage.setItem('adminLoggedIn', 'true');
        }

        alertBox.style.display = 'none';

        // Redirect based on role
        if (targetUser.role === 'user') {
          window.location.href = 'index.php?loggedin=1';
        } else {
          window.location.href = 'dashboard.php';
        }
      } else {
        alertBox.style.display = 'block';
        alertBox.innerText = '❌ Email atau Password tidak valid! Silakan gunakan tombol demo di atas.';
      }
    }
  </script>
</body>
</html>
