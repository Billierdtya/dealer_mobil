<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dealer Management Portal — PT PENCARI CINTA SEJATI</title>
  <link rel="icon" type="image/png" href="assets/images/logo_pcs.png">
  <link rel="stylesheet" href="assets/css/style.css?v=20261107">
  <style>
    body { background: var(--off-white) !important; background-image: none !important; margin: 0; padding: 0; font-family: var(--font-sans); color: var(--black); }
    .portal-layout { display: flex; min-height: 100vh; }
    
    /* SIDEBAR */
    .portal-sidebar {
      width: 270px;
      background: var(--white);
      border-right: 1px solid var(--gray-200);
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0; left: 0; bottom: 0;
      z-index: 100;
      overflow-y: auto;
    }
    .sidebar-brand-box {
      padding: 24px 24px 20px;
      border-bottom: 1px solid var(--gray-200);
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .sidebar-brand-name { font-family: var(--font-serif); font-size: 1.15rem; font-weight: 700; color: var(--black); line-height: 1.2; letter-spacing: -0.01em; }
    .sidebar-brand-role {
      font-size: 0.68rem; font-weight: 700; text-transform: uppercase;
      letter-spacing: 0.08em; display: inline-block; padding: 2px 8px;
      border-radius: 3px; margin-top: 4px;
    }
    .role-badge-admin { background: #18181b; color: #fef08a; }
    .role-badge-sales { background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .role-badge-owner { background: #fef3c7; color: #b45309; border: 1px solid #fde68a; }
    .role-badge-user  { background: #f4f4f5; color: #52525b; border: 1px solid #e4e4e7; }

    .sidebar-section-title {
      font-size: 0.68rem; font-weight: 700; text-transform: uppercase;
      letter-spacing: 0.08em; color: var(--gray-400); padding: 16px 24px 6px;
    }
    .portal-menu { list-style: none; padding: 0 12px; margin: 0; }
    .portal-menu li { margin: 2px 0; }
    .portal-nav-item {
      display: flex; align-items: center; gap: 12px;
      padding: 10px 14px; border-radius: 4px;
      font-size: 0.84rem; font-weight: 500;
      color: var(--gray-600); cursor: pointer;
      transition: all 0.2s ease; text-decoration: none;
    }
    .portal-nav-item:hover { background: var(--gray-100); color: var(--black); }
    .portal-nav-item.active { background: var(--black); color: var(--white); font-weight: 600; }
    .portal-nav-item svg { width: 16px; height: 16px; flex-shrink: 0; }
    .portal-nav-item .menu-badge {
      margin-left: auto; font-size: 0.68rem; font-weight: 700;
      padding: 1px 7px; border-radius: 10px; background: var(--gray-200); color: var(--black);
    }
    .portal-nav-item.active .menu-badge { background: var(--white); color: var(--black); }

    .sidebar-bottom {
      margin-top: auto; padding: 20px 20px;
      border-top: 1px solid var(--gray-200); background: #fafafa;
    }
    .current-user-box { display: flex; align-items: center; gap: 10px; margin-bottom: 14px; }
    .user-avatar-circle {
      width: 34px; height: 34px; border-radius: 50%;
      background: var(--black); color: var(--gold);
      display: flex; align-items: center; justify-content: center;
      font-weight: 700; font-size: 0.85rem; flex-shrink: 0;
    }

    /* MAIN CONTENT */
    .portal-main { margin-left: 270px; flex: 1; padding: 36px 44px; min-height: 100vh; box-sizing: border-box; }
    
    /* TOP BAR */
    .portal-topbar {
      display: flex; justify-content: space-between; align-items: center;
      margin-bottom: 32px; padding-bottom: 20px;
      border-bottom: 1px solid var(--gray-200);
    }
    .portal-page-heading { font-family: var(--font-serif); font-size: 1.85rem; font-weight: 400; color: var(--black); margin: 0 0 4px; }
    .portal-page-sub { font-size: 0.85rem; color: var(--gray-500); margin: 0; }

    /* STATS GRID */
    .portal-stats-grid {
      display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
      gap: 20px; margin-bottom: 32px;
    }
    .portal-stat-card {
      background: var(--white); border: 1px solid var(--gray-200);
      padding: 24px 20px; display: flex; flex-direction: column; gap: 6px;
      position: relative; overflow: hidden;
    }
    .portal-stat-card::before {
      content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
      background: transparent;
    }
    .portal-stat-card.accent-gold::before { background: var(--gold); }
    .portal-stat-card.accent-blue::before { background: #3b82f6; }
    .portal-stat-card.accent-green::before { background: #10b981; }
    .portal-stat-card.accent-purple::before { background: #8b5cf6; }

    .stat-label { font-size: 0.72rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; color: var(--gray-400); }
    .stat-value { font-family: var(--font-serif); font-size: 2.1rem; color: var(--black); line-height: 1.1; font-weight: 600; }
    .stat-sub { font-size: 0.78rem; color: var(--gray-500); margin-top: 4px; }

    /* PANELS */
    .portal-panel { background: var(--white); border: 1px solid var(--gray-200); margin-bottom: 28px; }
    .portal-panel-header {
      padding: 20px 24px; border-bottom: 1px solid var(--gray-200);
      display: flex; align-items: center; justify-content: space-between;
      background: #fbfbfb;
    }
    .portal-panel-title { font-family: var(--font-serif); font-size: 1.2rem; color: var(--black); margin: 0; font-weight: 600; }
    .portal-panel-body { padding: 0; }

    /* TABLE */
    .portal-table { width: 100%; border-collapse: collapse; font-size: 0.83rem; }
    .portal-table th {
      text-align: left; padding: 14px 20px;
      font-size: 0.72rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase;
      color: var(--gray-400); border-bottom: 1px solid var(--gray-200); background: #fbfbfb;
    }
    .portal-table td { padding: 16px 20px; border-bottom: 1px solid var(--gray-200); color: var(--black); vertical-align: middle; }
    .portal-table tr:last-child td { border-bottom: none; }
    .portal-table tr:hover td { background: #f9f9f9; }

    /* BADGES */
    .badge-status {
      display: inline-block; padding: 3px 10px; font-size: 0.68rem; font-weight: 700;
      letter-spacing: 0.05em; text-transform: uppercase; border-radius: 2px;
    }
    .badge-pending { background: #f4f4f5; color: #52525b; border: 1px solid #e4e4e7; }
    .badge-dikonfirmasi, .badge-confirmed, .badge-approved { background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; }
    .badge-in_progress, .badge-survey, .badge-negosiasi { background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .badge-selesai, .badge-completed, .badge-closed_won { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
    .badge-dibatalkan, .badge-cancelled, .badge-rejected, .badge-closed_lost { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }
    .badge-baru, .badge-contacted { background: #fffbeb; color: #b45309; border: 1px solid #fde68a; }

    /* BUTTONS */
    .btn-action {
      display: inline-flex; align-items: center; justify-content: center;
      font-size: 0.72rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.04em;
      padding: 5px 12px; border: 1px solid var(--gray-300); background: var(--white);
      color: var(--black); cursor: pointer; transition: all 0.15s ease; border-radius: 2px;
    }
    .btn-action:hover { border-color: var(--black); background: var(--gray-100); }
    .btn-action-primary { background: var(--black); color: var(--white); border-color: var(--black); }
    .btn-action-primary:hover { background: #27272a; color: var(--white); }
    .btn-action-danger { color: #dc2626; border-color: #fca5a5; }
    .btn-action-danger:hover { background: #dc2626; color: var(--white); border-color: #dc2626; }
    .btn-action-success { color: #059669; border-color: #6ee7b7; }
    .btn-action-success:hover { background: #059669; color: var(--white); border-color: #059669; }

    /* ROLE SWITCHER DEMO BAR */
    .role-switcher-banner {
      background: #18181b; color: #fff; padding: 10px 24px;
      display: flex; align-items: center; justify-content: space-between;
      font-size: 0.8rem; margin-bottom: 24px; border-radius: 4px;
    }
    .role-switcher-buttons { display: flex; gap: 8px; }
    .btn-role-switch {
      padding: 4px 12px; font-size: 0.72rem; font-weight: 700;
      border: 1px solid rgba(255,255,255,0.25); background: transparent; color: #fff;
      cursor: pointer; border-radius: 2px; transition: all 0.2s;
    }
    .btn-role-switch:hover, .btn-role-switch.active { background: var(--gold); color: #000; border-color: var(--gold); }

    /* READ ONLY WATERMARK */
    .read-only-pill {
      font-size: 0.68rem; font-weight: 700; text-transform: uppercase;
      letter-spacing: 0.05em; background: #fef3c7; color: #92400e;
      border: 1px solid #fde68a; padding: 3px 8px; border-radius: 2px; display: inline-flex; align-items: center; gap: 4px;
    }

    /* PRINT STYLES */
    @media print {
      .portal-sidebar, .role-switcher-banner, .btn-action, .portal-topbar button, .sidebar-bottom { display: none !important; }
      .portal-main { margin-left: 0 !important; padding: 0 !important; }
      body { background: white !important; }
      .portal-panel { border: 1px solid #ccc !important; break-inside: avoid; }
    }

    @media (max-width: 1024px) {
      .portal-sidebar { display: none; }
      .portal-main { margin-left: 0; padding: 24px 16px; }
    }
  </style>
</head>
<body>

  <!-- Ensure user session exists; default to admin if not set -->
  <script>
    (function checkPortalAuth() {
      const pcsUser = localStorage.getItem('pcsUser');
      const adminLoggedIn = localStorage.getItem('adminLoggedIn');
      let currentUser = pcsUser ? JSON.parse(pcsUser) : null;

      if (!currentUser) {
        if (adminLoggedIn === 'true') {
          currentUser = { nama: 'Super Admin (Billie)', email: 'admin@luxury.com', role: 'admin' };
          localStorage.setItem('pcsUser', JSON.stringify(currentUser));
        } else {
          // If nobody is logged in, redirect to login page
          window.location.href = 'login.php';
          return;
        }
      }

      // If user role is 'user', customer has their own booking dashboard on index.php / cars.php or can view limited portal
      window.PORTAL_USER = currentUser;
    })();
  </script>

  <div class="portal-layout">

    <!-- ═══ SIDEBAR RBAC ═══ -->
    <aside class="portal-sidebar">
      <div class="sidebar-brand-box">
        <a href="index.php" style="display:flex; align-items:center; gap:10px; text-decoration:none;">
          <img src="assets/images/logo_pcs.png" alt="PCS Logo" style="width: 36px; height: 36px; object-fit: contain;">
          <div>
            <div class="sidebar-brand-name">PCS EDITION</div>
            <div id="sidebarRoleBadge" class="sidebar-brand-role role-badge-admin">Super User</div>
          </div>
        </a>
      </div>

      <!-- Navigation Menus dynamically shown/hidden per RBAC -->
      <div style="flex: 1; padding: 12px 0;">

        <!-- 1. GENERAL -->
        <div class="sidebar-section-title">Overview</div>
        <ul class="portal-menu">
          <li data-role="all">
            <a href="#" class="portal-nav-item active" onclick="switchSection('dashboard', this); return false;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
              Dashboard
            </a>
          </li>
          <li data-role="all">
            <a href="cars.php" class="portal-nav-item" target="_blank">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"></path><circle cx="7" cy="17" r="2"></circle><path d="M9 17h6"></path><circle cx="17" cy="17" r="2"></circle></svg>
              Katalog Mobil
              <span style="margin-left:auto; font-size:0.7rem; opacity:0.6;">↗</span>
            </a>
          </li>
        </ul>

        <!-- 2. SALES & TRANSACTIONS (Admin, Sales, Owner Read-Only) -->
        <div class="sidebar-section-title" id="secTitleSales">Penjualan & Klien</div>
        <ul class="portal-menu">
          <li data-role="admin,sales" id="menuItemProspek">
            <a href="#" class="portal-nav-item" onclick="switchSection('prospek', this); return false;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
              Prospek Customer
              <span id="badgeProspekCount" class="menu-badge">0</span>
            </a>
          </li>
          <li data-role="admin,sales,owner" id="menuItemTransaksi">
            <a href="#" class="portal-nav-item" onclick="switchSection('transaksi', this); return false;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
              Transaksi Penjualan
              <span id="badgeTrxCount" class="menu-badge">0</span>
            </a>
          </li>
          <li data-role="admin,sales,owner" id="menuItemLaporanPenjualan">
            <a href="#" class="portal-nav-item" onclick="switchSection('laporan-penjualan', this); return false;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
              Laporan Penjualan Unit
            </a>
          </li>
          <li data-role="admin,sales" id="menuItemTestDrive">
            <a href="#" class="portal-nav-item" onclick="switchSection('testdrive', this); return false;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
              Jadwal Test Drive
              <span id="badgeTestDrivePending" class="menu-badge" style="background:#fef3c7; color:#92400e;">0</span>
            </a>
          </li>
          <li data-role="admin,sales" id="menuItemSellCars">
            <a href="#" class="portal-nav-item" onclick="switchSection('sellcars', this); return false;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
              Titip Jual Mobil
              <span id="badgeSellReview" class="menu-badge" style="background:#fee2e2; color:#991b1b;">0</span>
            </a>
          </li>
          <li data-role="admin,sales" id="menuItemContactMessages">
            <a href="#" class="portal-nav-item" onclick="switchSection('contactmessages', this); return false;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
              Pesan & Pertanyaan
              <span id="badgeContactOpen" class="menu-badge" style="background:#e0e7ff; color:#3730a3;">0</span>
            </a>
          </li>
        </ul>

        <!-- 3. SERVICE WORKSHOP & BOOKING (Admin, Owner, User) -->
        <div class="sidebar-section-title" id="secTitleServis">Bengkel & Servis</div>
        <ul class="portal-menu">
          <li data-role="admin" id="menuItemKelolaServis">
            <a href="#" class="portal-nav-item" onclick="switchSection('servis-kelola', this); return false;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
              Manajemen Servis
              <span id="badgeServisPending" class="menu-badge" style="background:#fee2e2; color:#b91c1c;">0</span>
            </a>
          </li>
          <li data-role="admin,owner" id="menuItemLaporanServis">
            <a href="#" class="portal-nav-item" onclick="switchSection('laporan-servis', this); return false;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
              Laporan Pemasukan Servis
            </a>
          </li>
          <li data-role="user" id="menuItemBookingUser" style="display:none;">
            <a href="#" class="portal-nav-item" onclick="switchSection('customer-service', this); return false;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
              Booking & Riwayat Servis
            </a>
          </li>
        </ul>

        <!-- 4. FINANCIAL REPORTS (Admin & Owner) -->
        <div class="sidebar-section-title" id="secTitleKeuangan">Keuangan & Eksekutif</div>
        <ul class="portal-menu">
          <li data-role="admin,owner" id="menuItemKeuangan">
            <a href="#" class="portal-nav-item" onclick="switchSection('laporan-keuangan', this); return false;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
              Laporan Keuangan Terpadu
            </a>
          </li>
        </ul>

        <!-- 5. MASTER DATA & SYSTEM (Admin Only) -->
        <div class="sidebar-section-title" id="secTitleMaster">Master & Pengaturan</div>
        <ul class="portal-menu">
          <li data-role="admin" id="menuItemInventory">
            <a href="#" class="portal-nav-item" onclick="switchSection('inventory', this); return false;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
              Inventory Mobil
            </a>
          </li>
          <li data-role="admin" id="menuItemUsers">
            <a href="#" class="portal-nav-item" onclick="switchSection('users', this); return false;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
              Manajemen User & Role
            </a>
          </li>
          <li data-role="admin" id="menuItemAsuransi">
            <a href="#" class="portal-nav-item" onclick="switchSection('asuransi', this); return false;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
              Pengajuan Asuransi
            </a>
          </li>
          <li data-role="admin" id="menuItemSettings">
            <a href="#" class="portal-nav-item" onclick="switchSection('pengaturan', this); return false;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
              Pengaturan Sistem
            </a>
          </li>
        </ul>

      </div>

      <!-- SIDEBAR FOOTER -->
      <div class="sidebar-bottom">
        <div class="current-user-box">
          <div class="user-avatar-circle" id="sidebarUserInitial">A</div>
          <div style="overflow:hidden;">
            <div id="sidebarUserName" style="font-size:0.83rem; font-weight:700; white-space:nowrap; text-overflow:ellipsis; overflow:hidden;">Admin</div>
            <div id="sidebarUserEmail" style="font-size:0.72rem; color:var(--gray-500); white-space:nowrap; text-overflow:ellipsis; overflow:hidden;">admin@luxury.com</div>
          </div>
        </div>
        <div style="display:flex; gap:8px;">
          <a href="index.php" class="btn-action" style="flex:1; text-align:center; text-decoration:none;">Website</a>
          <button class="btn-action btn-action-danger" onclick="handlePortalLogout()" style="flex:1;">Logout</button>
        </div>
      </div>
    </aside>

    <!-- ═══ MAIN PORTAL CONTENT ═══ -->
    <main class="portal-main">

      <!-- DEMO ROLE SWITCHER (Interactive Testing Bar) -->
      <div class="role-switcher-banner">
        <div style="display:flex; align-items:center; gap:8px;">
          <span style="color:var(--gold); font-weight:700;">✦ Mode RBAC Aktif:</span>
          <span id="bannerActiveRoleText">Admin (Super User)</span>
          <span style="opacity:0.6; font-size:0.75rem;">(Beralih role instan untuk memverifikasi hak akses & menu)</span>
        </div>
        <div class="role-switcher-buttons">
          <button class="btn-role-switch active" id="btnSwitchAdmin" onclick="switchDemoRole('admin')">Admin</button>
          <button class="btn-role-switch" id="btnSwitchSales" onclick="switchDemoRole('sales')">Sales</button>
          <button class="btn-role-switch" id="btnSwitchOwner" onclick="switchDemoRole('owner')">Owner</button>
          <button class="btn-role-switch" id="btnSwitchUser" onclick="switchDemoRole('user')">User (Customer)</button>
        </div>
      </div>

      <!-- ═════════════════════════════════════════════════════════════════
           1. SECTION DASHBOARD (Dynamic per Role)
           ═════════════════════════════════════════════════════════════════ -->
      <section id="section-dashboard" class="portal-section">
        <div class="portal-topbar">
          <div>
            <h1 class="portal-page-heading" id="dashHeading">Executive Dashboard</h1>
            <p class="portal-page-sub" id="dashSubheading">Pantauan performa komprehensif showroom mobil mewah & bengkel servis.</p>
          </div>
          <div style="display:flex; gap:10px;">
            <button class="btn-action" onclick="window.print()">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:6px;"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
              Cetak / PDF
            </button>
            <button class="btn-action btn-action-primary" id="btnDashQuickAction" onclick="handleDashboardQuickAction()">
              + Input Data Baru
            </button>
          </div>
        </div>

        <!-- STAT CARDS (Role Specific) -->
        <div class="portal-stats-grid" id="dashStatsGrid">
          <!-- Dynamically populated via JS for Admin, Sales, Owner, User -->
        </div>

        <!-- RECENT ACTIVITY PANELS (2-column on desktop) -->
        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:24px;">
          <!-- Left: Recent Sales / Prospects -->
          <div class="portal-panel">
            <div class="portal-panel-header">
              <h3 class="portal-panel-title">Transaksi Penjualan Terkini</h3>
              <a href="#" onclick="switchSection('transaksi'); return false;" style="font-size:0.75rem; color:var(--black); font-weight:600;">Lihat Semua &rarr;</a>
            </div>
            <div class="portal-panel-body">
              <table class="portal-table">
                <thead>
                  <tr><th>No. Transaksi</th><th>Customer</th><th>Unit Mobil</th><th>Nilai</th><th>Status</th></tr>
                </thead>
                <tbody id="dashTblRecentSales"></tbody>
              </table>
            </div>
          </div>

          <!-- Right: Recent Service Appointments -->
          <div class="portal-panel">
            <div class="portal-panel-header">
              <h3 class="portal-panel-title">Aktivitas Servis Bengkel Terkini</h3>
              <a href="#" onclick="switchSection('laporan-servis'); return false;" style="font-size:0.75rem; color:var(--black); font-weight:600;">Laporan Servis &rarr;</a>
            </div>
            <div class="portal-panel-body">
              <table class="portal-table">
                <thead>
                  <tr><th>Kode Servis</th><th>Customer & Mobil</th><th>Jenis Servis</th><th>Biaya</th><th>Status</th></tr>
                </thead>
                <tbody id="dashTblRecentServices"></tbody>
              </table>
            </div>
          </div>
        </div>
      </section>

      <!-- ═════════════════════════════════════════════════════════════════
           2. SECTION PROSPEK CUSTOMER (Admin & Sales)
           ═════════════════════════════════════════════════════════════════ -->
      <section id="section-prospek" class="portal-section" style="display:none;">
        <div class="portal-topbar">
          <div>
            <h1 class="portal-page-heading">Pipeline & Prospek Customer</h1>
            <p class="portal-page-sub">Kelola calon pembeli potensial, jadwal follow-up, dan konversi ke transaksi penjualan.</p>
          </div>
          <button class="btn-action btn-action-primary" onclick="openAddProspectModal()">+ Tambah Prospek Baru</button>
        </div>

        <!-- Pipeline Stats -->
        <div class="portal-stats-grid">
          <div class="portal-stat-card accent-blue">
            <div class="stat-label">Total Leads Aktif</div>
            <div class="stat-value" id="statProspectTotal">0</div>
            <div class="stat-sub">Calon pembeli terdata</div>
          </div>
          <div class="portal-stat-card accent-gold">
            <div class="stat-label">Tahap Negosiasi</div>
            <div class="stat-value" id="statProspectNegosiasi">0</div>
            <div class="stat-sub">Peluang closing tinggi</div>
          </div>
          <div class="portal-stat-card accent-green">
            <div class="stat-label">Closed Won (Deal)</div>
            <div class="stat-value" id="statProspectWon">0</div>
            <div class="stat-sub">Berhasil jadi transaksi</div>
          </div>
          <div class="portal-stat-card">
            <div class="stat-label">Estimasi Pipeline Value</div>
            <div class="stat-value" id="statProspectValue" style="font-size:1.6rem; padding-top:6px;">Rp 0</div>
            <div class="stat-sub">Potensi omset berjalan</div>
          </div>
        </div>

        <div class="portal-panel">
          <div class="portal-panel-header">
            <div style="display:flex; gap:8px;">
              <button class="btn-action active" onclick="filterProspectTable('all', this)">Semua Status</button>
              <button class="btn-action" onclick="filterProspectTable('baru', this)">Baru</button>
              <button class="btn-action" onclick="filterProspectTable('dihubungi', this)">Dihubungi</button>
              <button class="btn-action" onclick="filterProspectTable('test_drive', this)">Test Drive</button>
              <button class="btn-action" onclick="filterProspectTable('negosiasi', this)">Negosiasi</button>
              <button class="btn-action" onclick="filterProspectTable('closed_won', this)">Closed Won</button>
            </div>
            <input type="text" id="searchProspectInput" onkeyup="searchProspects()" placeholder="Cari prospek..." class="form-control" style="width:220px; padding:6px 12px; font-size:0.8rem;">
          </div>
          <div class="portal-panel-body">
            <table class="portal-table">
              <thead>
                <tr>
                  <th>Nama Prospek</th>
                  <th>Kontak & Email</th>
                  <th>Unit Minat</th>
                  <th>Sales PIC</th>
                  <th>Estimasi Budget</th>
                  <th>Status Pipeline</th>
                  <th>Catatan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="tblProspectsBody"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- ═════════════════════════════════════════════════════════════════
           3. SECTION TRANSAKSI PENJUALAN (Admin, Sales, Owner Read-Only)
           ═════════════════════════════════════════════════════════════════ -->
      <section id="section-transaksi" class="portal-section" style="display:none;">
        <div class="portal-topbar">
          <div>
            <h1 class="portal-page-heading">Transaksi Penjualan Unit</h1>
            <p class="portal-page-sub">Catatan resmi penjualan mobil, pembayaran tunai/kredit, dan penerbitan SPK.</p>
          </div>
          <div style="display:flex; gap:10px; align-items:center;">
            <div id="trxReadOnlyNotice" style="display:none;">
              <span class="read-only-pill">🔒 Mode Owner (Hanya Lihat)</span>
            </div>
            <button class="btn-action" onclick="exportTransactionsCSV()">Export CSV</button>
            <button class="btn-action btn-action-primary" id="btnInputTransaksiBaru" onclick="openAddTransactionModal()">+ Input Transaksi Penjualan</button>
          </div>
        </div>

        <div class="portal-panel">
          <div class="portal-panel-body">
            <table class="portal-table">
              <thead>
                <tr>
                  <th>No. Transaksi</th>
                  <th>Tanggal</th>
                  <th>Customer</th>
                  <th>Unit Kendaraan</th>
                  <th>Sales PIC</th>
                  <th>Metode Bayar</th>
                  <th>Harga Kesepakatan</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="tblTransactionsBody"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- ═════════════════════════════════════════════════════════════════
           4. SECTION LAPORAN PENJUALAN UNIT (Admin, Sales, Owner)
           ═════════════════════════════════════════════════════════════════ -->
      <section id="section-laporan-penjualan" class="portal-section" style="display:none;">
        <div class="portal-topbar">
          <div>
            <h1 class="portal-page-heading">Laporan Penjualan Unit Mobil</h1>
            <p class="portal-page-sub">Analisis komprehensif omset penjualan, pergerakan unit per merek, dan kinerja sales.</p>
          </div>
          <div style="display:flex; gap:10px;">
            <button class="btn-action" onclick="window.print()">Cetak Laporan</button>
            <button class="btn-action btn-action-primary" onclick="exportSalesReportsCSV()">Unduh CSV</button>
          </div>
        </div>

        <!-- Ringkasan Metrik Laporan Penjualan -->
        <div class="portal-stats-grid">
          <div class="portal-stat-card accent-gold">
            <div class="stat-label">Total Unit Terjual</div>
            <div class="stat-value" id="reportSalesTotalUnits">0</div>
            <div class="stat-sub">Mobil luxury terkirim</div>
          </div>
          <div class="portal-stat-card accent-green">
            <div class="stat-label">Total Omset Penjualan Mobil</div>
            <div class="stat-value" id="reportSalesTotalRevenue" style="font-size:1.7rem; padding-top:6px;">Rp 0</div>
            <div class="stat-sub">Gross unit sales</div>
          </div>
          <div class="portal-stat-card">
            <div class="stat-label">Rata-Rata Nilai Transaksi</div>
            <div class="stat-value" id="reportSalesAvgTicket" style="font-size:1.6rem; padding-top:6px;">Rp 0</div>
            <div class="stat-sub">Per unit kendaraan</div>
          </div>
          <div class="portal-stat-card accent-blue">
            <div class="stat-label">Metode Pembayaran</div>
            <div class="stat-value" id="reportSalesCashRatio" style="font-size:1.4rem; padding-top:8px;">0% Cash / 0% Kredit</div>
            <div class="stat-sub">Distribusi pendanaan</div>
          </div>
        </div>

        <div class="portal-panel">
          <div class="portal-panel-header">
            <h3 class="portal-panel-title">Tabel Laporan Lengkap Penjualan Unit</h3>
            <div style="font-size:0.8rem; color:var(--gray-500);">Periode: Tahun Berjalan 2026</div>
          </div>
          <div class="portal-panel-body">
            <table class="portal-table">
              <thead>
                <tr>
                  <th>No. SPK / Transaksi</th>
                  <th>Tanggal</th>
                  <th>Customer</th>
                  <th>Brand & Model</th>
                  <th>Sales Rep</th>
                  <th>Pembayaran</th>
                  <th>Down Payment</th>
                  <th>Total Nilai OTR</th>
                </tr>
              </thead>
              <tbody id="tblReportSalesBody"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- ═════════════════════════════════════════════════════════════════
           5. SECTION MANAJEMEN SERVIS (Admin Super User)
           ═════════════════════════════════════════════════════════════════ -->
      <section id="section-servis-kelola" class="portal-section" style="display:none;">
        <div class="portal-topbar">
          <div>
            <h1 class="portal-page-heading">Manajemen Servis & Workshop</h1>
            <p class="portal-page-sub">Kelola antrean booking servis, alokasi mekanik, penetapan biaya jasa & sparepart.</p>
          </div>
          <button class="btn-action btn-action-primary" onclick="openAddServiceBookingModal()">+ Buat Booking Servis</button>
        </div>

        <!-- Filter Tab Servis -->
        <div class="portal-panel">
          <div class="portal-panel-header">
            <div style="display:flex; gap:8px;">
              <button class="btn-action active" onclick="filterServiceTable('all', this)">Semua Servis</button>
              <button class="btn-action" onclick="filterServiceTable('pending', this)">Pending</button>
              <button class="btn-action" onclick="filterServiceTable('dikonfirmasi', this)">Dikonfirmasi</button>
              <button class="btn-action" onclick="filterServiceTable('in_progress', this)">Sedang Dikerjakan</button>
              <button class="btn-action" onclick="filterServiceTable('selesai', this)">Selesai</button>
            </div>
            <div style="font-size:0.8rem; color:var(--gray-500); font-weight:600;">Bengkel Resmi PCS Edition</div>
          </div>
          <div class="portal-panel-body">
            <table class="portal-table">
              <thead>
                <tr>
                  <th>Kode Booking</th>
                  <th>Jadwal</th>
                  <th>Customer & Nopol</th>
                  <th>Kendaraan</th>
                  <th>Jenis Servis</th>
                  <th>Biaya Jasa</th>
                  <th>Sparepart</th>
                  <th>Total Biaya</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="tblManageServiceBody"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- ═════════════════════════════════════════════════════════════════
           6. SECTION LAPORAN PEMASUKAN SERVIS (Admin & Owner)
           ═════════════════════════════════════════════════════════════════ -->
      <section id="section-laporan-servis" class="portal-section" style="display:none;">
        <div class="portal-topbar">
          <div>
            <h1 class="portal-page-heading">Laporan Pemasukan Servis Bengkel</h1>
            <p class="portal-page-sub">Rincian pendapatan pengerjaan servis: ganti oli, tune up, servis umum, biaya jasa & sparepart.</p>
          </div>
          <div style="display:flex; gap:10px; align-items:center;">
            <div id="serviceReadOnlyNotice" style="display:none;">
              <span class="read-only-pill">🔒 Mode Owner (Hanya Lihat)</span>
            </div>
            <button class="btn-action" onclick="window.print()">Cetak</button>
            <button class="btn-action btn-action-primary" onclick="exportServiceReportsCSV()">Unduh CSV</button>
          </div>
        </div>

        <!-- STATS SERVIS SUMMARY -->
        <div class="portal-stats-grid">
          <div class="portal-stat-card accent-blue">
            <div class="stat-label">Total Booking Servis</div>
            <div class="stat-value" id="reportSrvTotalCount">0</div>
            <div class="stat-sub">Seluruh pengerjaan masuk</div>
          </div>
          <div class="portal-stat-card accent-green">
            <div class="stat-label">Total Pemasukan Servis</div>
            <div class="stat-value" id="reportSrvTotalRevenue" style="font-size:1.7rem; padding-top:6px;">Rp 0</div>
            <div class="stat-sub">Jasa + Sparepart terbayar</div>
          </div>
          <div class="portal-stat-card">
            <div class="stat-label">Total Biaya Jasa Mekanik</div>
            <div class="stat-value" id="reportSrvTotalJasa" style="font-size:1.6rem; padding-top:6px;">Rp 0</div>
            <div class="stat-sub">Pendapatan murni workshop</div>
          </div>
          <div class="portal-stat-card accent-gold">
            <div class="stat-label">Total Penjualan Sparepart</div>
            <div class="stat-value" id="reportSrvTotalParts" style="font-size:1.6rem; padding-top:6px;">Rp 0</div>
            <div class="stat-sub">Oli, filter, part racing</div>
          </div>
        </div>

        <!-- BREAKDOWN PER JENIS SERVIS (Ganti Oli, Tune Up, Servis Umum, dll.) -->
        <div class="portal-panel">
          <div class="portal-panel-header">
            <h3 class="portal-panel-title">Breakdown Pendapatan Berdasarkan Jenis Servis</h3>
            <div style="font-size:0.8rem; color:var(--gray-500);">Ganti Oli, Tune Up, Servis Umum, dsb.</div>
          </div>
          <div class="portal-panel-body" style="padding:24px;">
            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap:20px;" id="srvBreakdownCards">
              <!-- Rendered via JS -->
            </div>
          </div>
        </div>

        <!-- TABEL RINCIAN TRANSAKSI SERVIS -->
        <div class="portal-panel">
          <div class="portal-panel-header">
            <h3 class="portal-panel-title">Tabel Rincian Riwayat Servis Lengkap</h3>
            <div style="font-size:0.8rem; color:var(--gray-500);">Mencakup teknisi, nomor polisi, dan suku cadang</div>
          </div>
          <div class="portal-panel-body">
            <table class="portal-table">
              <thead>
                <tr>
                  <th>Kode Servis</th>
                  <th>Tanggal</th>
                  <th>Customer</th>
                  <th>Kendaraan & Nopol</th>
                  <th>Jenis Servis</th>
                  <th>Mekanik PIC</th>
                  <th>Biaya Jasa</th>
                  <th>Biaya Parts</th>
                  <th>Total Pemasukan</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="tblReportServiceBody"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- ═════════════════════════════════════════════════════════════════
           7. SECTION LAPORAN KEUANGAN TERPADU (Admin & Owner)
           ═════════════════════════════════════════════════════════════════ -->
      <section id="section-laporan-keuangan" class="portal-section" style="display:none;">
        <div class="portal-topbar">
          <div>
            <h1 class="portal-page-heading">Laporan Keuangan Terpadu</h1>
            <p class="portal-page-sub">Konsolidasi pendapatan penjualan unit mobil dan pemasukan divisi servis bengkel.</p>
          </div>
          <div style="display:flex; gap:10px;">
            <button class="btn-action" onclick="window.print()">Cetak Financial Statement</button>
            <button class="btn-action btn-action-primary" onclick="exportFinancialCSV()">Unduh CSV</button>
          </div>
        </div>

        <!-- Financial Statement Summary Cards -->
        <div class="portal-stats-grid">
          <div class="portal-stat-card accent-gold">
            <div class="stat-label">Pemasukan Penjualan Unit</div>
            <div class="stat-value" id="finSalesRev" style="font-size:1.6rem; padding-top:6px;">Rp 0</div>
            <div class="stat-sub">Divisi Car Showroom</div>
          </div>
          <div class="portal-stat-card accent-blue">
            <div class="stat-label">Pemasukan Servis Bengkel</div>
            <div class="stat-value" id="finServiceRev" style="font-size:1.6rem; padding-top:6px;">Rp 0</div>
            <div class="stat-sub">Divisi Aftersales & Workshop</div>
          </div>
          <div class="portal-stat-card accent-green">
            <div class="stat-label">TOTAL PENDAPATAN KOTOR (GROSS)</div>
            <div class="stat-value" id="finGrossRev" style="font-size:1.8rem; padding-top:6px;">Rp 0</div>
            <div class="stat-sub">Penjualan + Servis (Tanpa Duplikasi)</div>
          </div>
          <div class="portal-stat-card accent-purple">
            <div class="stat-label">ESTIMASI LABA BERSIH (NET)</div>
            <div class="stat-value" id="finNetProfit" style="font-size:1.7rem; padding-top:6px; color:#15803d;">Rp 0</div>
            <div class="stat-sub">Margin Showroom 12% + Servis 45%</div>
          </div>
        </div>

        <!-- Financial Statement Structure Table -->
        <div class="portal-panel">
          <div class="portal-panel-header">
            <h3 class="portal-panel-title">Ringkasan Arus Kas & Laba Rugi Dealer (YTD 2026)</h3>
            <span class="read-only-pill">Laporan Resmi Manajemen</span>
          </div>
          <div class="portal-panel-body" style="padding:24px;">
            <table style="width:100%; border-collapse:collapse; font-size:0.9rem; line-height:2.2;">
              <tr style="border-bottom:2px solid var(--black); font-weight:700; font-family:var(--font-serif); font-size:1.05rem;">
                <td>KOMPONEN KEUANGAN</td>
                <td style="text-align:right;">JUMLAH (IDR)</td>
              </tr>
              <tr>
                <td><strong>1. Pendapatan Penjualan Unit Mobil</strong> (Car Sales Revenue)</td>
                <td style="text-align:right; font-weight:600;" id="finRowSales">Rp 0</td>
              </tr>
              <tr>
                <td><strong>2. Pendapatan Jasa Servis</strong> (Labor Workshop Revenue)</td>
                <td style="text-align:right; font-weight:600;" id="finRowJasa">Rp 0</td>
              </tr>
              <tr style="border-bottom:1px solid var(--gray-200);">
                <td><strong>3. Pendapatan Suku Cadang & Oli</strong> (Parts Sales Revenue)</td>
                <td style="text-align:right; font-weight:600;" id="finRowParts">Rp 0</td>
              </tr>
              <tr style="background:#f9f9f9; font-weight:700;">
                <td style="padding-left:8px;">TOTAL PENDAPATAN OPERASIONAL (GROSS REVENUE)</td>
                <td style="text-align:right; font-size:1.05rem; padding-right:8px;" id="finRowGross">Rp 0</td>
              </tr>
              <tr>
                <td style="color:var(--gray-600);">Estimasi Beban Pokok Penjualan Unit (COGS 88%)</td>
                <td style="text-align:right; color:#dc2626;" id="finRowCogsCars">(Rp 0)</td>
              </tr>
              <tr style="border-bottom:1px solid var(--gray-200);">
                <td style="color:var(--gray-600);">Estimasi Beban Pokok Sparepart & Workshop (55%)</td>
                <td style="text-align:right; color:#dc2626;" id="finRowCogsService">(Rp 0)</td>
              </tr>
              <tr style="background:#f0fdf4; border-top:2px solid #16a34a; font-weight:700; font-family:var(--font-serif); font-size:1.15rem; color:#15803d;">
                <td style="padding:12px 8px;">ESTIMASI LABA OPERASIONAL BERSIH (NET INCOME)</td>
                <td style="text-align:right; padding:12px 8px;" id="finRowNet">Rp 0</td>
              </tr>
            </table>
          </div>
        </div>
      </section>

      <!-- ═════════════════════════════════════════════════════════════════
           8. SECTION CUSTOMER SERVICE (Khusus Role User)
           ═════════════════════════════════════════════════════════════════ -->
      <section id="section-customer-service" class="portal-section" style="display:none;">
        <div class="portal-topbar">
          <div>
            <h1 class="portal-page-heading">Booking & Riwayat Servis Anda</h1>
            <p class="portal-page-sub">Pantau proses pengerjaan mobil kesayangan Anda di bengkel resmi PCS Edition.</p>
          </div>
          <button class="btn-action btn-action-primary" onclick="openAddServiceBookingModal()">+ Booking Servis Baru</button>
        </div>

        <div class="portal-panel">
          <div class="portal-panel-header">
            <h3 class="portal-panel-title">Daftar Reservasi Servis Saya</h3>
          </div>
          <div class="portal-panel-body">
            <table class="portal-table">
              <thead>
                <tr>
                  <th>Kode Booking</th>
                  <th>Tanggal & Jam</th>
                  <th>Kendaraan & Nopol</th>
                  <th>Jenis Servis</th>
                  <th>Status Pengerjaan</th>
                  <th>Estimasi Biaya</th>
                  <th>Catatan Teknisi</th>
                </tr>
              </thead>
              <tbody id="tblCustomerServiceBody"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- ═════════════════════════════════════════════════════════════════
           9. SECTION INVENTORY MOBIL (Admin Only)
           ═════════════════════════════════════════════════════════════════ -->
      <section id="section-inventory" class="portal-section" style="display:none;">
        <div class="portal-topbar">
          <div>
            <h1 class="portal-page-heading">Inventory Management</h1>
            <p class="portal-page-sub">Kelola stok mobil luxury, spesifikasi mesin, penetapan harga OTR, dan unit aktif.</p>
          </div>
          <button class="btn-action btn-action-primary" onclick="openAddCarModal()">+ Tambah Unit Mobil</button>
        </div>

        <div class="portal-panel">
          <div class="portal-panel-body">
            <table class="portal-table">
              <thead>
                <tr>
                  <th>ID</th><th>Brand & Model</th><th>Tahun</th><th>Harga OTR</th><th>Stok</th><th>Aksi</th>
                </tr>
              </thead>
              <tbody id="tblInventoryBody"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- ═════════════════════════════════════════════════════════════════
           10. SECTION MANAJEMEN USER & ROLE (Admin Only)
           ═════════════════════════════════════════════════════════════════ -->
      <section id="section-users" class="portal-section" style="display:none;">
        <div class="portal-topbar">
          <div>
            <h1 class="portal-page-heading">Manajemen User & Hak Akses (RBAC)</h1>
            <p class="portal-page-sub">Kelola akun Admin, Sales, Owner, dan Customer yang terdaftar di sistem.</p>
          </div>
          <button class="btn-action btn-action-primary" onclick="openAddUserModal()">+ Tambah Pengguna Baru</button>
        </div>

        <div class="portal-panel">
          <div class="portal-panel-body">
            <table class="portal-table">
              <thead>
                <tr>
                  <th>ID</th><th>Nama Lengkap</th><th>Email</th><th>Role Akses</th><th>No. Telepon</th><th>Status</th><th>Aksi</th>
                </tr>
              </thead>
              <tbody id="tblUsersBody"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- ═════════════════════════════════════════════════════════════════
           11. SECTION TEST DRIVE & VIP (Admin & Sales)
           ═════════════════════════════════════════════════════════════════ -->
      <section id="section-testdrive" class="portal-section" style="display:none;">
        <div class="portal-topbar">
          <div>
            <h1 class="portal-page-heading">Jadwal Test Drive & Konsultasi VIP</h1>
            <p class="portal-page-sub">Kelola permintaan uji kemudi supercar dan inspeksi privat klien eksekutif di showroom SCBD.</p>
          </div>
          <div>
            <button class="btn-portal btn-portal-primary" onclick="openTestDriveModal()">+ Jadwal Test Drive Baru</button>
          </div>
        </div>

        <div class="portal-panel">
          <div class="portal-panel-header">
            <h3 class="portal-panel-title">Jadwal Test Drive Klien</h3>
            <span style="font-size:0.8rem; color:var(--gray-500);">Terhubung langsung dengan formulir Test Drive di website</span>
          </div>
          <div class="portal-panel-body">
            <table class="portal-table">
              <thead>
                <tr><th>ID</th><th>Nama Pemesan</th><th>Kontak & Email</th><th>Unit Supercar</th><th>Jadwal</th><th>Catatan</th><th>Status</th><th>Aksi</th></tr>
              </thead>
              <tbody id="tblTestDriveBody"></tbody>
            </table>
          </div>
        </div>

        <div class="portal-panel">
          <div class="portal-panel-header"><h3 class="portal-panel-title">Permintaan Reservasi VIP Konsultasi</h3></div>
          <div class="portal-panel-body">
            <table class="portal-table">
              <thead>
                <tr><th>ID</th><th>Nama Klien</th><th>Kontak</th><th>Unit Minat</th><th>Catatan</th><th>Status</th><th>Aksi</th></tr>
              </thead>
              <tbody id="tblVipBody"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- ═════════════════════════════════════════════════════════════════
           11b. SECTION TITIP JUAL / KONSINYASI (Admin & Sales)
           ═════════════════════════════════════════════════════════════════ -->
      <section id="section-sellcars" class="portal-section" style="display:none;">
        <div class="portal-topbar">
          <div>
            <h1 class="portal-page-heading">Titip Jual Kendaraan (Konsinyasi Klien)</h1>
            <p class="portal-page-sub">Kurasi pengajuan mobil mewah dari klien, verifikasi kondisi fisik 150 titik, dan tambahkan unit ke katalog inventaris.</p>
          </div>
          <div>
            <button class="btn-portal btn-portal-primary" onclick="openSellCarModal()">+ Ajukan Titip Jual</button>
          </div>
        </div>

        <div class="portal-panel">
          <div class="portal-panel-header">
            <h3 class="portal-panel-title">Daftar Pengajuan Titip Jual Klien</h3>
            <span style="font-size:0.8rem; color:var(--gray-500);">Data otomatis terisi saat klien submit formulir Sell Your Car</span>
          </div>
          <div class="portal-panel-body">
            <table class="portal-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Unit Kendaraan</th>
                  <th>Pemilik & Kontak</th>
                  <th>Harga Penawaran</th>
                  <th>Kondisi & Deskripsi</th>
                  <th>Status Kurasi</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="tblSellCarsBody"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- ═════════════════════════════════════════════════════════════════
           11c. SECTION PESAN & PERTANYAAN KLIEN (Admin & Sales)
           ═════════════════════════════════════════════════════════════════ -->
      <section id="section-contactmessages" class="portal-section" style="display:none;">
        <div class="portal-topbar">
          <div>
            <h1 class="portal-page-heading">Pesan & Pertanyaan Klien (Concierge CRM)</h1>
            <p class="portal-page-sub">Tanggapi tiket pertanyaan klien, permintaan private viewing VIP, dan pertanyaan spesifikasi dari formulir Contact Us.</p>
          </div>
        </div>

        <div class="portal-panel">
          <div class="portal-panel-header">
            <h3 class="portal-panel-title">Tiket Pesan Customer Masuk</h3>
            <span style="font-size:0.8rem; color:var(--gray-500);">Respon Anda otomatis tersinkronisasi ke tab Aktivitas Klien</span>
          </div>
          <div class="portal-panel-body">
            <table class="portal-table">
              <thead>
                <tr>
                  <th>ID Tiket</th>
                  <th>Waktu</th>
                  <th>Pengirim & Kontak</th>
                  <th>Subjek</th>
                  <th>Isi Pesan Klien</th>
                  <th>Status & Balasan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="tblContactMessagesBody"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- ═════════════════════════════════════════════════════════════════
           12. SECTION ASURANSI (Admin Only)
           ═════════════════════════════════════════════════════════════════ -->
      <section id="section-asuransi" class="portal-section" style="display:none;">
        <div class="portal-topbar">
          <div>
            <h1 class="portal-page-heading">Pengajuan Asuransi Kendaraan</h1>
            <p class="portal-page-sub">Verifikasi berkas, survei kondisi, dan penerbitan polis perlindungan komprehensif.</p>
          </div>
        </div>
        <div class="portal-panel">
          <div class="portal-panel-body">
            <table class="portal-table">
              <thead>
                <tr><th>No. Polis</th><th>Pemohon</th><th>Kendaraan</th><th>Coverage</th><th>Total Premi</th><th>Status</th><th>Aksi</th></tr>
              </thead>
              <tbody id="tblAsuransiBody"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- ═════════════════════════════════════════════════════════════════
           13. SECTION PENGATURAN SISTEM (Admin Only)
           ═════════════════════════════════════════════════════════════════ -->
      <section id="section-pengaturan" class="portal-section" style="display:none;">
        <div class="portal-topbar">
          <div>
            <h1 class="portal-page-heading">Pengaturan Sistem Dealer</h1>
            <p class="portal-page-sub">Konfigurasi operasional dealer, informasi showroom, dan manajemen database.</p>
          </div>
        </div>
        <div class="portal-panel" style="max-width:700px;">
          <div class="portal-panel-header"><h3 class="portal-panel-title">Informasi Dealer & Showroom</h3></div>
          <div class="portal-panel-body" style="padding:24px;">
            <div class="form-group"><label class="form-label">Nama Showroom</label><input type="text" class="form-control" value="PT PENCARI CINTA SEJATI (PCS EDITION)"></div>
            <div class="form-group"><label class="form-label">Alamat Galeri Utama</label><input type="text" class="form-control" value="Jl. Jend. Sudirman Kav. 52-53, SCBD, Jakarta Selatan"></div>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
              <div class="form-group"><label class="form-label">WhatsApp Concierge</label><input type="text" class="form-control" value="+62 811 2233 4455"></div>
              <div class="form-group"><label class="form-label">Email Resmi</label><input type="text" class="form-control" value="concierge@pcsedition.com"></div>
            </div>
            <div class="form-group"><label class="form-label">Jam Operasional Bengkel & Servis</label><input type="text" class="form-control" value="Senin - Sabtu: 08:30 - 17:00 WIB (Minggu By Appointment)"></div>
            <button class="btn-action btn-action-primary" onclick="alert('Pengaturan dealer berhasil disimpan!')">Simpan Perubahan</button>

            <hr style="border:0; border-top:1px solid var(--gray-200); margin:24px 0 16px;">
            <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; color:var(--gray-500); margin-bottom:6px;">Database & Sinkronisasi MySQL</div>
            <p style="font-size:0.82rem; color:var(--gray-600); margin-bottom:14px;">Inisialisasi tabel dan data awal dari schema.sql ke MySQL XAMPP secara otomatis.</p>
            <div style="display:flex; gap:10px; flex-wrap:wrap;">
              <button type="button" class="btn-action" style="background:#fafafa;" onclick="initDatabaseFromSchema()">⚡ Inisialisasi / Migrate MySQL</button>
              <button type="button" class="btn-action btn-action-danger" onclick="resetLocalData()">Reset Data Demo</button>
            </div>
          </div>
        </div>
      </section>

    </main>
  </div>

  <!-- ═════════════════════════════════════════════════════════════════
       MODALS: Form Prospek, Transaksi, Servis, Billing, User, Mobil
       ═════════════════════════════════════════════════════════════════ -->

  <!-- Modal Tambah/Edit Prospek -->
  <div class="modal-overlay" id="modalProspect">
    <div class="modal-container" style="max-width:540px;">
      <div class="modal-header">
        <h3 class="modal-title" id="modalProspectTitle">Tambah Prospek Customer</h3>
        <button class="modal-close" onclick="closeModal('modalProspect')">&times;</button>
      </div>
      <div class="modal-body">
        <form id="formProspect" onsubmit="saveProspectForm(event)">
          <input type="hidden" id="prospectId">
          <div class="form-group">
            <label class="form-label">Nama Calon Pembeli *</label>
            <input type="text" id="prospectNama" class="form-control" required placeholder="Nama lengkap">
          </div>
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label">Nomor WhatsApp / HP *</label>
              <input type="text" id="prospectKontak" class="form-control" required placeholder="0812...">
            </div>
            <div class="form-group">
              <label class="form-label">Email</label>
              <input type="email" id="prospectEmail" class="form-control" placeholder="email@domain.com">
            </div>
          </div>
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label">Mobil Diminati</label>
              <select id="prospectMobilSelect" class="form-control" style="padding:10px;"></select>
            </div>
            <div class="form-group">
              <label class="form-label">Status Pipeline</label>
              <select id="prospectStatus" class="form-control" style="padding:10px;">
                <option value="baru">Baru</option>
                <option value="dihubungi">Dihubungi</option>
                <option value="test_drive">Test Drive</option>
                <option value="negosiasi">Negosiasi</option>
                <option value="closed_won">Closed Won (Deal)</option>
                <option value="closed_lost">Closed Lost (Gagal)</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Estimasi Budget (IDR)</label>
            <input type="number" id="prospectNominal" class="form-control" placeholder="Contoh: 15000000000">
          </div>
          <div class="form-group">
            <label class="form-label">Catatan Kebutuhan / Preferensi</label>
            <textarea id="prospectCatatan" class="form-control" rows="3" placeholder="Warna interior, preferensi cash/kredit, dsb."></textarea>
          </div>
          <button type="submit" class="btn btn-gold" style="width:100%;">Simpan Prospek</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Input Transaksi Penjualan -->
  <div class="modal-overlay" id="modalTransaction">
    <div class="modal-container" style="max-width:620px;">
      <div class="modal-header">
        <h3 class="modal-title">Input Transaksi Penjualan Unit</h3>
        <button class="modal-close" onclick="closeModal('modalTransaction')">&times;</button>
      </div>
      <div class="modal-body">
        <form id="formTransaction" onsubmit="saveTransactionForm(event)">
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label">Nama Pembeli *</label>
              <input type="text" id="trxCustNama" class="form-control" required placeholder="Nama customer">
            </div>
            <div class="form-group">
              <label class="form-label">No. Telepon / WhatsApp *</label>
              <input type="text" id="trxCustKontak" class="form-control" required placeholder="0812...">
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Pilih Unit Mobil Tersedia *</label>
            <select id="trxMobilSelect" class="form-control" onchange="syncTrxPriceFromCar()" required style="padding:10px;"></select>
          </div>
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label">Harga Kesepakatan (IDR) *</label>
              <input type="number" id="trxHarga" class="form-control" required placeholder="Harga OTR final">
            </div>
            <div class="form-group">
              <label class="form-label">Metode Pembayaran</label>
              <select id="trxMetode" class="form-control" onchange="toggleTrxCreditFields()" style="padding:10px;">
                <option value="cash">Cash / Transfer Tunai</option>
                <option value="kredit">Kredit Leasing</option>
              </select>
            </div>
          </div>
          <!-- Dynamic Credit Fields -->
          <div id="trxCreditFields" style="display:none; background:#f9f9f9; padding:16px; border:1px solid var(--gray-200); margin-bottom:16px;">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Down Payment (DP)</label>
                <input type="number" id="trxDp" class="form-control" placeholder="Nominal DP (Rp)">
              </div>
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Tenor Pembiayaan</label>
                <select id="trxTenor" class="form-control" style="padding:10px;">
                  <option value="12">12 Bulan (1 Tahun)</option>
                  <option value="24">24 Bulan (2 Tahun)</option>
                  <option value="36" selected>36 Bulan (3 Tahun)</option>
                  <option value="48">48 Bulan (4 Tahun)</option>
                  <option value="60">60 Bulan (5 Tahun)</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Catatan Transaksi / Nomor SPK</label>
            <textarea id="trxCatatan" class="form-control" rows="2" placeholder="Nomor BPKB, STNK, bonus aksesoris, dll."></textarea>
          </div>
          <button type="submit" class="btn btn-gold" style="width:100%;">Terbitkan Transaksi & Kurangi Stok</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Booking Servis (Untuk Customer & Admin) -->
  <div class="modal-overlay" id="modalServiceBooking">
    <div class="modal-container" style="max-width:580px;">
      <div class="modal-header">
        <h3 class="modal-title">Formulir Booking Servis Bengkel</h3>
        <button class="modal-close" onclick="closeModal('modalServiceBooking')">&times;</button>
      </div>
      <div class="modal-body">
        <form id="formServiceBooking" onsubmit="saveServiceBookingForm(event)">
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label">Nama Pemilik Kendaraan *</label>
              <input type="text" id="srvNama" class="form-control" required placeholder="Nama customer">
            </div>
            <div class="form-group">
              <label class="form-label">Nomor WhatsApp *</label>
              <input type="text" id="srvKontak" class="form-control" required placeholder="0812...">
            </div>
          </div>
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label">Model Kendaraan *</label>
              <input type="text" id="srvKendaraan" class="form-control" required placeholder="Ferrari 296 GTB / Porsche 911">
            </div>
            <div class="form-group">
              <label class="form-label">Nomor Polisi (Plat) *</label>
              <input type="text" id="srvNopol" class="form-control" required placeholder="B 1234 PCS" style="text-transform:uppercase;">
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Pilih Jenis Servis Utama *</label>
            <select id="srvJenis" class="form-control" style="padding:10px;" required>
              <option value="ganti_oli">Ganti Oli (Motul 300V / Castrol Edge Supercar + Filter)</option>
              <option value="tune_up">Tune Up (Busi Iridium Racing, Throttle Body, Injector Clean)</option>
              <option value="servis_umum">Servis Umum & General Inspection 150 Titik</option>
              <option value="perbaikan_rem">Perbaikan Rem & Penggantian Kampas Rem Brembo/Carbon</option>
              <option value="servis_ac">Servis AC & Flushing Kompresor Freon</option>
              <option value="kelistrikan">Diagnostik Kelistrikan & Modul ECU OBD</option>
              <option value="lainnya">Servis Khusus / Keluhan Lainnya</option>
            </select>
          </div>
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label">Tanggal Servis *</label>
              <input type="date" id="srvTanggal" class="form-control" required>
            </div>
            <div class="form-group">
              <label class="form-label">Pilihan Jam Slot *</label>
              <select id="srvJam" class="form-control" style="padding:10px;">
                <option value="09:00 WIB">09:00 WIB</option>
                <option value="10:30 WIB">10:30 WIB</option>
                <option value="13:30 WIB">13:30 WIB</option>
                <option value="15:00 WIB">15:00 WIB</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Keluhan atau Catatan Tambahan</label>
            <textarea id="srvKeluhan" class="form-control" rows="2" placeholder="Gejala suara mesin, getaran rem, dsb."></textarea>
          </div>
          <button type="submit" class="btn btn-gold" style="width:100%;">Konfirmasi Booking Servis</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Kelola Biaya Servis (Admin Only) -->
  <div class="modal-overlay" id="modalServiceBilling">
    <div class="modal-container" style="max-width:520px;">
      <div class="modal-header">
        <h3 class="modal-title">Kelola Rincian Biaya Servis</h3>
        <button class="modal-close" onclick="closeModal('modalServiceBilling')">&times;</button>
      </div>
      <div class="modal-body">
        <form id="formServiceBilling" onsubmit="saveServiceBillingForm(event)">
          <input type="hidden" id="billingSrvId">
          <div style="background:#fafafa; padding:12px; border:1px solid var(--gray-200); margin-bottom:16px;">
            <div style="font-size:0.75rem; text-transform:uppercase; color:var(--gray-500); font-weight:700;">Kode Servis:</div>
            <div id="billingKodeDisplay" style="font-family:var(--font-serif); font-size:1.1rem; font-weight:700;"></div>
            <div id="billingCarDisplay" style="font-size:0.85rem; color:var(--gray-600);"></div>
          </div>
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label">Biaya Jasa Mekanik (IDR)</label>
              <input type="number" id="billingJasa" class="form-control" required oninput="calculateBillingTotal()">
            </div>
            <div class="form-group">
              <label class="form-label">Biaya Sparepart (IDR)</label>
              <input type="number" id="billingSparepart" class="form-control" required oninput="calculateBillingTotal()">
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Rincian Sparepart yang Digunakan</label>
            <textarea id="billingPartsDetail" class="form-control" rows="2" placeholder="Oli Motul 300V 8L, Filter Oli OEM, Busi..."></textarea>
          </div>
          <div style="background:var(--black); color:white; padding:14px; margin-bottom:20px; display:flex; justify-content:space-between; align-items:center;">
            <div>
              <div style="font-size:0.72rem; text-transform:uppercase; color:var(--gold);">TOTAL TAGIHAN SERVIS</div>
              <div style="font-size:0.78rem; opacity:0.8;">Jasa + Suku Cadang</div>
            </div>
            <div style="font-family:var(--font-serif); font-size:1.4rem; font-weight:700; color:var(--gold);" id="billingTotalDisplay">Rp 0</div>
          </div>
          <button type="submit" class="btn btn-gold" style="width:100%;">Simpan Rincian Biaya</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Tambah/Edit User & RBAC (Admin Only) -->
  <div class="modal-overlay" id="modalUserForm">
    <div class="modal-container" style="max-width:480px;">
      <div class="modal-header">
        <h3 class="modal-title" id="modalUserTitle">Tambah Pengguna Baru</h3>
        <button class="modal-close" onclick="closeModal('modalUserForm')">&times;</button>
      </div>
      <div class="modal-body">
        <form id="formUser" onsubmit="saveUserForm(event)">
          <input type="hidden" id="userId">
          <div class="form-group">
            <label class="form-label">Nama Lengkap *</label>
            <input type="text" id="userNama" class="form-control" required placeholder="Nama user">
          </div>
          <div class="form-group">
            <label class="form-label">Email Login *</label>
            <input type="email" id="userEmail" class="form-control" required placeholder="user@luxury.com">
          </div>
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label">Role Akses *</label>
              <select id="userRole" class="form-control" style="padding:10px;" required>
                <option value="admin">Admin (Super User)</option>
                <option value="sales">Sales (Penjualan)</option>
                <option value="owner">Owner (Read-Only)</option>
                <option value="user">User (Customer)</option>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">No. Telepon</label>
              <input type="text" id="userPhone" class="form-control" placeholder="0812...">
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" id="userPassword" class="form-control" placeholder="Kosongkan jika tidak diubah">
          </div>
          <button type="submit" class="btn btn-gold" style="width:100%;">Simpan Akun Pengguna</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Tambah/Edit Mobil (Inventory) -->
  <div class="modal-overlay" id="carFormModal">
    <div class="modal-container">
      <div class="modal-header">
        <h3 class="modal-title">Formulir Inventory Kendaraan</h3>
        <button class="modal-close" onclick="closeModal('carFormModal')">&times;</button>
      </div>
      <div class="modal-body">
        <form id="formCarAdmin" onsubmit="saveCarInventoryForm(event)">
          <input type="hidden" id="carFormId">
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label">Merek (Brand)</label>
              <input type="text" id="carFormBrand" class="form-control" required placeholder="Ferrari">
            </div>
            <div class="form-group">
              <label class="form-label">Model Kendaraan</label>
              <input type="text" id="carFormModel" class="form-control" required placeholder="SF90 Stradale">
            </div>
          </div>
          <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label">Tahun</label>
              <input type="number" id="carFormTahun" class="form-control" value="2026" required>
            </div>
            <div class="form-group">
              <label class="form-label">Harga OTR (IDR)</label>
              <input type="number" id="carFormHarga" class="form-control" required placeholder="18500000000">
            </div>
            <div class="form-group">
              <label class="form-label">Jumlah Stok</label>
              <input type="number" id="carFormStok" class="form-control" value="1" required>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Deskripsi Singkat</label>
            <textarea id="carFormDesc" class="form-control" rows="3" required></textarea>
          </div>
          <button type="submit" class="btn btn-gold" style="width:100%;">Simpan Unit ke Inventory</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Balas Pesan Customer (Concierge CRM) -->
  <div class="modal-overlay" id="modalReplyContact">
    <div class="modal-container" style="max-width:540px;">
      <div class="modal-header">
        <h3 class="modal-title">Kirim Balasan Resmi ke Customer</h3>
        <button class="modal-close" onclick="closeModal('modalReplyContact')">&times;</button>
      </div>
      <div class="modal-body">
        <form onsubmit="submitReplyContactMessage(event)">
          <input type="hidden" id="replyContactId">
          <div style="background:#f8fafc; border:1px solid #e2e8f0; padding:12px; margin-bottom:16px; font-size:0.83rem;">
            <div style="display:flex; justify-content:space-between; margin-bottom:4px;">
              <span style="font-weight:700; color:var(--black);" id="replyCustomerName">Nama Customer</span>
              <span style="color:var(--gold); font-weight:700;" id="replyCustomerTicket">TKT-xxxxx</span>
            </div>
            <div style="color:var(--gray-500); font-size:0.75rem;" id="replyCustomerContact">email@domain.com</div>
            <div style="margin-top:8px; font-style:italic; color:#334155; border-top:1px dashed #cbd5e1; padding-top:6px;" id="replyOriginalMessage">"Pesan klien..."</div>
          </div>
          <div class="form-group">
            <label class="form-label">Tuliskan Balasan Resmi Concierge</label>
            <textarea id="replyTextContent" class="form-control" rows="4" required placeholder="Tuliskan jawaban lengkap, konfirmasi jadwal, atau nomor kontak sales..."></textarea>
          </div>
          <div style="display:flex; justify-content:flex-end; gap:8px;">
            <button type="button" class="btn-action" onclick="closeModal('modalReplyContact')">Batal</button>
            <button type="submit" class="btn-action btn-action-primary">Kirim Balasan ke Klien</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="assets/js/app.js"></script>
  <script>
    // ═════════════════════════════════════════════════════════════════
    // PORTAL RBAC CONTROLLER & STATE
    // ═════════════════════════════════════════════════════════════════
    let currentRole = 'admin';
    let portalProspects = [];
    let portalTransactions = [];
    let portalServices = [];
    let portalUsers = [];

    document.addEventListener('DOMContentLoaded', () => {
      // Set initial user info
      const u = window.PORTAL_USER || JSON.parse(localStorage.getItem('pcsUser') || '{"role":"admin"}');
      currentRole = u.role || 'admin';
      
      // Sync date picker min to today
      const srvDate = document.getElementById('srvTanggal');
      if (srvDate) srvDate.value = new Date().toISOString().split('T')[0];

      // Populate mobil dropdowns
      populateMobilSelects();

      // Apply RBAC permissions to UI
      applyRolePermissions(currentRole);

      // Load initial data
      loadAllPortalData();
    });

    function applyRolePermissions(role) {
      currentRole = role;
      const u = window.PORTAL_USER || {};
      u.role = role;
      localStorage.setItem('pcsUser', JSON.stringify(u));

      // 1. Update user info on sidebar & top banner
      const badge = document.getElementById('sidebarRoleBadge');
      const bannerText = document.getElementById('bannerActiveRoleText');
      const initial = document.getElementById('sidebarUserInitial');
      const nameEl = document.getElementById('sidebarUserName');
      const emailEl = document.getElementById('sidebarUserEmail');

      const roleDisplayNames = {
        'admin': 'Super User (Admin)',
        'sales': 'Sales Representative',
        'owner': 'Owner (Read-Only)',
        'user': 'Customer'
      };

      if (badge) {
        badge.className = `sidebar-brand-role role-badge-${role}`;
        badge.innerText = roleDisplayNames[role] || role.toUpperCase();
      }
      if (bannerText) bannerText.innerText = roleDisplayNames[role] || role;
      if (initial) initial.innerText = (u.nama ? u.nama.charAt(0) : role.charAt(0)).toUpperCase();
      if (nameEl) nameEl.innerText = u.nama || (role.toUpperCase() + ' User');
      if (emailEl) emailEl.innerText = u.email || `${role}@luxury.com`;

      // Update switcher active button
      document.querySelectorAll('.btn-role-switch').forEach(b => b.classList.remove('active'));
      const activeBtn = document.getElementById(`btnSwitch${role.charAt(0).toUpperCase() + role.slice(1)}`);
      if (activeBtn) activeBtn.classList.add('active');

      // 2. Hide / Show Sidebar Menus based on data-role
      document.querySelectorAll('.portal-menu li').forEach(li => {
        const allowed = li.getAttribute('data-role');
        if (!allowed || allowed === 'all') {
          li.style.display = '';
        } else {
          const roles = allowed.split(',').map(r => r.trim());
          li.style.display = roles.includes(role) ? '' : 'none';
        }
      });

      // Section titles visibility
      const secSales = document.getElementById('secTitleSales');
      const secServis = document.getElementById('secTitleServis');
      const secKeuangan = document.getElementById('secTitleKeuangan');
      const secMaster = document.getElementById('secTitleMaster');

      if (secMaster) secMaster.style.display = (role === 'admin') ? '' : 'none';
      if (secKeuangan) secKeuangan.style.display = (role === 'admin' || role === 'owner') ? '' : 'none';

      // 3. Read-Only Notices & Action buttons
      const trxBtn = document.getElementById('btnInputTransaksiBaru');
      const trxNotice = document.getElementById('trxReadOnlyNotice');
      if (trxBtn) trxBtn.style.display = (role === 'owner') ? 'none' : '';
      if (trxNotice) trxNotice.style.display = (role === 'owner') ? 'inline-block' : 'none';

      const srvNotice = document.getElementById('serviceReadOnlyNotice');
      if (srvNotice) srvNotice.style.display = (role === 'owner') ? 'inline-block' : 'none';

      // Re-render dashboard stats for the selected role
      renderRoleDashboard(role);
    }

    function switchDemoRole(role) {
      applyRolePermissions(role);
      switchSection('dashboard');
    }

    function switchSection(secId, menuElem) {
      document.querySelectorAll('.portal-nav-item').forEach(a => a.classList.remove('active'));
      if (menuElem) menuElem.classList.add('active');

      document.querySelectorAll('.portal-section').forEach(s => s.style.display = 'none');
      const target = document.getElementById(`section-${secId}`);
      if (target) {
        target.style.display = 'block';
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }

      // Refresh corresponding tables
      if (secId === 'prospek') renderProspectTable();
      if (secId === 'transaksi') renderTransactionsTable();
      if (secId === 'laporan-penjualan') renderSalesReportTable();
      if (secId === 'servis-kelola') renderManageServiceTable();
      if (secId === 'laporan-servis') renderServiceReportTable();
      if (secId === 'laporan-keuangan') renderFinancialTable();
      if (secId === 'inventory') renderInventoryTable();
      if (secId === 'users') renderUsersTable();
      if (secId === 'customer-service') renderCustomerServiceTable();
      if (secId === 'testdrive') renderTestDriveTable();
      if (secId === 'sellcars') renderSellCarsTable();
      if (secId === 'contactmessages') renderContactMessagesTable();
    }

    // ═════════════════════════════════════════════════════════════════
    // DATA LOADER & LOCALSTORAGE SYNC
    // ═════════════════════════════════════════════════════════════════
    function loadAllPortalData() {
      // 1. Prospek
      const savedPros = localStorage.getItem('pcsProspects');
      if (savedPros) {
        portalProspects = JSON.parse(savedPros);
      } else {
        portalProspects = [
          { id: 1, nama_prospek: 'Raden Mas Suryo', kontak: '081198765432', email: 'suryo@menteng.co.id', mobil_id: 1, mobil_nama: 'Rolls-Royce Phantom VIII', status: 'negosiasi', sales_nama: 'Arya Pratama', estimasi_nominal: 24500000000, catatan: 'Meminta skema DP 30% tenor 3 tahun.' },
          { id: 2, nama_prospek: 'Dr. Jessica Tanuwidjaja', kontak: '081288990011', email: 'jessica@cardio.id', mobil_id: 4, mobil_nama: 'Ferrari SF90 Stradale', status: 'closed_won', sales_nama: 'Arya Pratama', estimasi_nominal: 18500000000, catatan: 'Deal via SPK #TRX-2026-901.' },
          { id: 3, nama_prospek: 'Hartono Setiawan', kontak: '081765432100', email: 'hartono@djarum.com', mobil_id: 3, mobil_nama: 'Koenigsegg Jesko Absolut', status: 'test_drive', sales_nama: 'Billie (Super User)', estimasi_nominal: 65000000000, catatan: 'Jadwal test drive weekend ini.' },
          { id: 4, nama_prospek: 'Kevin Anggara', kontak: '081912345678', email: 'kevin@creator.id', mobil_id: 9, mobil_nama: 'Porsche 911 GT3 RS', status: 'baru', sales_nama: 'Arya Pratama', estimasi_nominal: 11200000000, catatan: 'Inquiry via form website.' }
        ];
        localStorage.setItem('pcsProspects', JSON.stringify(portalProspects));
      }

      // 2. Transaksi Penjualan
      const savedTrx = localStorage.getItem('pcsTransactions');
      if (savedTrx) {
        portalTransactions = JSON.parse(savedTrx);
      } else {
        portalTransactions = [
          { id: 1, nomor_transaksi: 'TRX-20260301-4491', customer_nama: 'Dr. Jessica Tanuwidjaja', customer_kontak: '081288990011', mobil_nama: 'Ferrari SF90 Stradale Assetto Fiorano', sales_nama: 'Arya Pratama', harga_kesepakatan: 18500000000, metode_pembayaran: 'cash', down_payment: 18500000000, status: 'completed', tanggal_transaksi: '2026-03-01' },
          { id: 2, nomor_transaksi: 'TRX-20260214-8812', customer_nama: 'Budi Santoso', customer_kontak: '081299887766', mobil_nama: 'Porsche 911 GT3 RS (992)', sales_nama: 'Arya Pratama', harga_kesepakatan: 11200000000, metode_pembayaran: 'kredit', down_payment: 2240000000, status: 'completed', tanggal_transaksi: '2026-02-14' },
          { id: 3, nomor_transaksi: 'TRX-20260119-1029', customer_nama: 'Ir. Ahmad Wijaya', customer_kontak: '081877665544', mobil_nama: 'Bentley Continental GT Speed', sales_nama: 'Billie (Super User)', harga_kesepakatan: 16800000000, metode_pembayaran: 'cash', down_payment: 16800000000, status: 'completed', tanggal_transaksi: '2026-01-19' }
        ];
        localStorage.setItem('pcsTransactions', JSON.stringify(portalTransactions));
      }

      // 3. Service Bookings (Ganti Oli, Tune Up, dll.)
      const savedSrv = localStorage.getItem('pcsServices');
      if (savedSrv) {
        portalServices = JSON.parse(savedSrv);
      } else {
        portalServices = [
          { id: 1, booking_kode: 'SRV-20260305-101', nama_customer: 'Dr. Jessica Tanuwidjaja', kontak: '081288990011', kendaraan_model: 'Ferrari SF90 Stradale', nomor_polisi: 'B 1 JSS', jenis_servis: 'ganti_oli', tanggal_servis: '2026-03-05', jam_servis: '10:00 WIB', mekanik_nama: 'Agus Subekti (Master Tech)', biaya_jasa: 750000, biaya_sparepart: 2500000, total_biaya: 3250000, rincian_sparepart: 'Oli Motul 300V Competition 8L + Filter Oli OEM Ferrari', status: 'selesai', keluhan: 'Penggantian oli rutin 5.000 KM' },
          { id: 2, booking_kode: 'SRV-20260306-204', nama_customer: 'Budi Santoso', kontak: '081299887766', kendaraan_model: 'Porsche 911 GT3 RS', nomor_polisi: 'B 911 BDS', jenis_servis: 'tune_up', tanggal_servis: '2026-03-06', jam_servis: '13:30 WIB', mekanik_nama: 'Faisal Akbar (Tech Specialist)', biaya_jasa: 1500000, biaya_sparepart: 3200000, total_biaya: 4700000, rincian_sparepart: 'Busi Iridium Racing + Throttle Body Cleaner + Filter Udara BMC', status: 'selesai', keluhan: 'Persiapan trackday di Sirkuit Mandalika' },
          { id: 3, booking_kode: 'SRV-20260308-311', nama_customer: 'Ir. Ahmad Wijaya', kontak: '081877665544', kendaraan_model: 'Bentley Continental GT', nomor_polisi: 'B 888 WIJ', jenis_servis: 'servis_umum', tanggal_servis: '2026-03-08', jam_servis: '09:00 WIB', mekanik_nama: 'Agus Subekti (Master Tech)', biaya_jasa: 2000000, biaya_sparepart: 4500000, total_biaya: 6500000, rincian_sparepart: 'General Check 150 titik + Kuras Air Radiator Coolant + Filter Kabin', status: 'in_progress', keluhan: 'Servis berkala tahunan' },
          { id: 4, booking_kode: 'SRV-20260309-405', nama_customer: 'Hartono Setiawan', kontak: '081765432100', kendaraan_model: 'Rolls-Royce Ghost', nomor_polisi: 'B 1 HTN', jenis_servis: 'ganti_oli', tanggal_servis: '2026-03-09', jam_servis: '10:30 WIB', mekanik_nama: 'Mekanik Senior', biaya_jasa: 750000, biaya_sparepart: 2800000, total_biaya: 3550000, rincian_sparepart: 'Castrol Edge Supercar 10W-60 + Filter Oli Rolls-Royce', status: 'dikonfirmasi', keluhan: 'Ganti oli mesin & pengecekan level fluida' },
          { id: 5, booking_kode: 'SRV-20260310-512', nama_customer: 'Kevin Anggara', kontak: '081912345678', kendaraan_model: 'Lamborghini Huracán', nomor_polisi: 'B 777 KVN', jenis_servis: 'perbaikan_rem', tanggal_servis: '2026-03-10', jam_servis: '14:00 WIB', mekanik_nama: 'Mekanik Senior', biaya_jasa: 1200000, biaya_sparepart: 5500000, total_biaya: 6700000, rincian_sparepart: 'Brake Pad Brembo Ceramic + Kuras Minyak Rem Dot 5.1', status: 'pending', keluhan: 'Bunyi decit saat pengereman kecepatan tinggi' }
        ];
        localStorage.setItem('pcsServices', JSON.stringify(portalServices));
      }

      // 4. Users (RBAC)
      const savedUsers = localStorage.getItem('pcsUsersList');
      if (savedUsers) {
        portalUsers = JSON.parse(savedUsers);
      } else {
        portalUsers = [
          { id: 1, nama: 'Super Admin (Billie)', email: 'admin@luxury.com', role: 'admin', no_telepon: '081199887766', is_active: 1 },
          { id: 2, nama: 'Arya Pratama (Sales Rep)', email: 'sales@luxury.com', role: 'sales', no_telepon: '081234567890', is_active: 1 },
          { id: 3, nama: 'Dra. Hendra Wijaya (Owner)', email: 'owner@luxury.com', role: 'owner', no_telepon: '081398765432', is_active: 1 },
          { id: 4, nama: 'Budi Santoso (Customer)', email: 'user@luxury.com', role: 'user', no_telepon: '081299887766', is_active: 1 }
        ];
        localStorage.setItem('pcsUsersList', JSON.stringify(portalUsers));
      }

      // Update badge counts in sidebar
      updateSidebarBadges();
      renderRoleDashboard(currentRole);
    }

    function updateSidebarBadges() {
      const bPros = document.getElementById('badgeProspekCount');
      const bTrx = document.getElementById('badgeTrxCount');
      const bSrv = document.getElementById('badgeServisPending');
      const bTd = document.getElementById('badgeTestDrivePending');
      const bSell = document.getElementById('badgeSellReview');
      const bCu = document.getElementById('badgeContactOpen');

      if (bPros) bPros.innerText = portalProspects.length;
      if (bTrx) bTrx.innerText = portalTransactions.length;
      if (bSrv) {
        const pending = portalServices.filter(s => s.status === 'pending').length;
        bSrv.innerText = pending;
      }
      if (bTd) {
        const list = JSON.parse(localStorage.getItem('pcsTestDrives') || '[]');
        bTd.innerText = list.filter(t => t.status === 'pending').length;
      }
      if (bSell) {
        const list = JSON.parse(localStorage.getItem('pcsSellListings') || '[]');
        bSell.innerText = list.filter(l => l.status === 'under_review').length;
      }
      if (bCu) {
        const list = JSON.parse(localStorage.getItem('pcsContactMessages') || '[]');
        bCu.innerText = list.filter(m => m.status === 'open').length;
      }
    }

    function populateMobilSelects() {
      const selects = [document.getElementById('prospectMobilSelect'), document.getElementById('trxMobilSelect')];
      selects.forEach(sel => {
        if (!sel) return;
        sel.innerHTML = currentCars.map(c => `
          <option value="${c.id}" data-price="${c.harga_otr}">${c.brand} ${c.model} (${c.tahun}) - ${formatIDR(c.harga_otr)} [Stok: ${c.stok}]</option>
        `).join('');
      });
    }

    function syncTrxPriceFromCar() {
      const sel = document.getElementById('trxMobilSelect');
      const prcInput = document.getElementById('trxHarga');
      if (sel && prcInput) {
        const opt = sel.options[sel.selectedIndex];
        if (opt) {
          prcInput.value = opt.getAttribute('data-price') || '';
        }
      }
    }

    function toggleTrxCreditFields() {
      const m = document.getElementById('trxMetode').value;
      const box = document.getElementById('trxCreditFields');
      if (box) box.style.display = (m === 'kredit') ? 'block' : 'none';
    }

    // ═════════════════════════════════════════════════════════════════
    // RENDER ROLE-SPECIFIC DASHBOARD
    // ═════════════════════════════════════════════════════════════════
    function renderRoleDashboard(role) {
      const grid = document.getElementById('dashStatsGrid');
      const heading = document.getElementById('dashHeading');
      const subheading = document.getElementById('dashSubheading');
      if (!grid) return;

      const totalSalesRev = portalTransactions.reduce((acc, t) => acc + (t.status === 'completed' ? parseFloat(t.harga_kesepakatan) : 0), 0);
      const totalServiceRev = portalServices.reduce((acc, s) => acc + (s.status === 'selesai' ? parseFloat(s.total_biaya) : 0), 0);
      const grossRev = totalSalesRev + totalServiceRev;
      const netProfit = (totalSalesRev * 0.12) + (totalServiceRev * 0.45);

      if (role === 'admin') {
        heading.innerText = 'Executive Super User Dashboard';
        subheading.innerText = 'Akses kontrol penuh seluruh divisi: showroom penjualan, workshop bengkel, dan keuangan.';
        grid.innerHTML = `
          <div class="portal-stat-card accent-green">
            <div class="stat-label">Total Omset Gross</div>
            <div class="stat-value" style="font-size:1.8rem; padding-top:4px;">${formatIDR(grossRev)}</div>
            <div class="stat-sub">Penjualan Unit + Servis Bengkel</div>
          </div>
          <div class="portal-stat-card accent-gold">
            <div class="stat-label">Unit Mobil Terjual</div>
            <div class="stat-value">${portalTransactions.length}</div>
            <div class="stat-sub">Total deal selesai</div>
          </div>
          <div class="portal-stat-card accent-blue">
            <div class="stat-label">Pemasukan Servis</div>
            <div class="stat-value" style="font-size:1.6rem; padding-top:6px;">${formatIDR(totalServiceRev)}</div>
            <div class="stat-sub">${portalServices.length} reservasi workshop</div>
          </div>
          <div class="portal-stat-card">
            <div class="stat-label">Prospek Leads Aktif</div>
            <div class="stat-value">${portalProspects.length}</div>
            <div class="stat-sub">Pipeline penjualan berjalan</div>
          </div>
        `;
      } else if (role === 'sales') {
        heading.innerText = 'Sales Performance Dashboard';
        subheading.innerText = 'Fokus aktivitas penjualan, pipeline prospek calon pembeli, dan pencapaian komisi.';
        grid.innerHTML = `
          <div class="portal-stat-card accent-gold">
            <div class="stat-label">Target Sales Bulan Ini</div>
            <div class="stat-value" style="font-size:1.8rem; padding-top:4px;">Rp 30.0 M</div>
            <div class="stat-sub">Pencapaian: 98.4% tercapai</div>
          </div>
          <div class="portal-stat-card accent-blue">
            <div class="stat-label">Prospek Aktif Saya</div>
            <div class="stat-value">${portalProspects.length}</div>
            <div class="stat-sub">Calon pembeli dalam follow-up</div>
          </div>
          <div class="portal-stat-card accent-green">
            <div class="stat-label">Unit Terjual (Closed Won)</div>
            <div class="stat-value">${portalTransactions.length} Unit</div>
            <div class="stat-sub">Total omset: ${formatIDR(totalSalesRev)}</div>
          </div>
          <div class="portal-stat-card">
            <div class="stat-label">Estimasi Insentif & Komisi</div>
            <div class="stat-value" style="font-size:1.6rem; padding-top:6px; color:#15803d;">${formatIDR(totalSalesRev * 0.015)}</div>
            <div class="stat-sub">1.5% dari deal yang selesai</div>
          </div>
        `;
      } else if (role === 'owner') {
        heading.innerText = 'Owner & Investor Financial Dashboard';
        subheading.innerText = 'Ringkasan eksekutif pendapatan dealer, pembagian pemasukan servis & penjualan, serta laba bersih.';
        grid.innerHTML = `
          <div class="portal-stat-card accent-green">
            <div class="stat-label">TOTAL OMSET BISNIS (GROSS)</div>
            <div class="stat-value" style="font-size:1.8rem; padding-top:4px;">${formatIDR(grossRev)}</div>
            <div class="stat-sub">Penjualan Mobil + Bengkel Servis</div>
          </div>
          <div class="portal-stat-card accent-gold">
            <div class="stat-label">Pendapatan Penjualan Unit</div>
            <div class="stat-value" style="font-size:1.6rem; padding-top:6px;">${formatIDR(totalSalesRev)}</div>
            <div class="stat-sub">${portalTransactions.length} unit mobil terkirim</div>
          </div>
          <div class="portal-stat-card accent-blue">
            <div class="stat-label">Pendapatan Servis Bengkel</div>
            <div class="stat-value" style="font-size:1.6rem; padding-top:6px;">${formatIDR(totalServiceRev)}</div>
            <div class="stat-sub">Aftersales & workshop resmi</div>
          </div>
          <div class="portal-stat-card accent-purple">
            <div class="stat-label">ESTIMASI LABA BERSIH (NET PROFIT)</div>
            <div class="stat-value" style="font-size:1.7rem; padding-top:6px; color:#15803d;">${formatIDR(netProfit)}</div>
            <div class="stat-sub">Laba bersih operasional dealer</div>
          </div>
        `;
      } else if (role === 'user') {
        heading.innerText = 'Customer Dashboard';
        subheading.innerText = 'Status servis kendaraan Anda, jadwal test drive, dan riwayat transaksi.';
        const myServices = portalServices.slice(0, 2);
        grid.innerHTML = `
          <div class="portal-stat-card accent-blue">
            <div class="stat-label">Servis Aktif Saya</div>
            <div class="stat-value">${myServices.length}</div>
            <div class="stat-sub">Dalam pengerjaan workshop</div>
          </div>
          <div class="portal-stat-card accent-gold">
            <div class="stat-label">Kendaraan Terdaftar</div>
            <div class="stat-value">1 Unit</div>
            <div class="stat-sub">Ferrari SF90 Stradale</div>
          </div>
          <div class="portal-stat-card accent-green">
            <div class="stat-label">Status Garansi Authorized</div>
            <div class="stat-value" style="font-size:1.5rem; padding-top:6px; color:#15803d;">Aktif</div>
            <div class="stat-sub">Perlindungan 3 tahun</div>
          </div>
        `;
      }

      // Render mini tables on dashboard
      renderDashboardRecentTables();
    }

    function renderDashboardRecentTables() {
      const tblSales = document.getElementById('dashTblRecentSales');
      const tblSrv = document.getElementById('dashTblRecentServices');

      if (tblSales) {
        tblSales.innerHTML = portalTransactions.slice(0, 3).map(t => `
          <tr>
            <td><strong>${t.nomor_transaksi}</strong></td>
            <td>${t.customer_nama}</td>
            <td>${t.mobil_nama}</td>
            <td><strong>${formatIDR(t.harga_kesepakatan)}</strong></td>
            <td><span class="badge-status badge-${t.status}">${t.status}</span></td>
          </tr>
        `).join('');
      }

      if (tblSrv) {
        tblSrv.innerHTML = portalServices.slice(0, 3).map(s => `
          <tr>
            <td><strong>${s.booking_kode}</strong></td>
            <td>${s.nama_customer}<br><small style="color:var(--gray-500);">${s.kendaraan_model}</small></td>
            <td><span style="font-weight:600; text-transform:capitalize;">${s.jenis_servis.replace('_', ' ')}</span></td>
            <td><strong>${formatIDR(s.total_biaya)}</strong></td>
            <td><span class="badge-status badge-${s.status}">${s.status}</span></td>
          </tr>
        `).join('');
      }
    }

    function handleDashboardQuickAction() {
      if (currentRole === 'sales') {
        openAddProspectModal();
      } else if (currentRole === 'owner') {
        alert('Role Owner memiliki akses Read-Only untuk memantau data.');
      } else {
        openAddTransactionModal();
      }
    }

    // ═════════════════════════════════════════════════════════════════
    // PROSPEK CUSTOMER (Sales & Admin)
    // ═════════════════════════════════════════════════════════════════
    let currentProspectFilter = 'all';

    function renderProspectTable() {
      const tbl = document.getElementById('tblProspectsBody');
      if (!tbl) return;

      const filtered = portalProspects.filter(p => {
        if (currentProspectFilter === 'all') return true;
        return p.status === currentProspectFilter;
      });

      // Update stat cards
      document.getElementById('statProspectTotal').innerText = portalProspects.length;
      document.getElementById('statProspectNegosiasi').innerText = portalProspects.filter(p => p.status === 'negosiasi').length;
      document.getElementById('statProspectWon').innerText = portalProspects.filter(p => p.status === 'closed_won').length;
      const totalVal = portalProspects.reduce((a, b) => a + (parseFloat(b.estimasi_nominal) || 0), 0);
      document.getElementById('statProspectValue').innerText = formatIDR(totalVal);

      if (filtered.length === 0) {
        tbl.innerHTML = `<tr><td colspan="8" style="text-align:center; padding:32px; color:var(--gray-500);">Tidak ada data prospek pada filter ini.</td></tr>`;
        return;
      }

      tbl.innerHTML = filtered.map(p => `
        <tr>
          <td><strong style="color:var(--black); font-size:0.9rem;">${p.nama_prospek}</strong></td>
          <td>
            <div>${p.kontak}</div>
            <small style="color:var(--gray-500);">${p.email || '-'}</small>
          </td>
          <td><strong>${p.mobil_nama || 'Unit Belum Dipilih'}</strong></td>
          <td>${p.sales_nama || '-'}</td>
          <td><strong style="color:var(--gold);">${formatIDR(p.estimasi_nominal || 0)}</strong></td>
          <td><span class="badge-status badge-${p.status}">${p.status.replace('_', ' ')}</span></td>
          <td><small style="color:var(--gray-600);">${p.catatan || '-'}</small></td>
          <td>
            <div style="display:flex; gap:6px;">
              ${p.status !== 'closed_won' ? `<button class="btn-action btn-action-success" title="Deal & Buat Transaksi" onclick="convertProspectToDeal(${p.id})">Deal</button>` : ''}
              <button class="btn-action" onclick="editProspect(${p.id})">Edit</button>
              <button class="btn-action btn-action-danger" onclick="deleteProspect(${p.id})">&times;</button>
            </div>
          </td>
        </tr>
      `).join('');
    }

    function filterProspectTable(status, btn) {
      currentProspectFilter = status;
      if (btn) {
        btn.parentElement.querySelectorAll('button').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
      }
      renderProspectTable();
    }

    function searchProspects() {
      const q = document.getElementById('searchProspectInput').value.toLowerCase();
      const rows = document.querySelectorAll('#tblProspectsBody tr');
      rows.forEach(r => {
        const text = r.innerText.toLowerCase();
        r.style.display = text.includes(q) ? '' : 'none';
      });
    }

    function openAddProspectModal() {
      document.getElementById('prospectId').value = '';
      document.getElementById('prospectNama').value = '';
      document.getElementById('prospectKontak').value = '';
      document.getElementById('prospectEmail').value = '';
      document.getElementById('prospectNominal').value = '';
      document.getElementById('prospectCatatan').value = '';
      document.getElementById('modalProspectTitle').innerText = 'Tambah Prospek Customer';
      openModal('modalProspect');
    }

    function editProspect(id) {
      const p = portalProspects.find(x => x.id == id);
      if (!p) return;
      document.getElementById('prospectId').value = p.id;
      document.getElementById('prospectNama').value = p.nama_prospek;
      document.getElementById('prospectKontak').value = p.kontak;
      document.getElementById('prospectEmail').value = p.email || '';
      document.getElementById('prospectMobilSelect').value = p.mobil_id || '';
      document.getElementById('prospectStatus').value = p.status;
      document.getElementById('prospectNominal').value = p.estimasi_nominal || '';
      document.getElementById('prospectCatatan').value = p.catatan || '';
      document.getElementById('modalProspectTitle').innerText = 'Edit Prospek Customer';
      openModal('modalProspect');
    }

    function saveProspectForm(e) {
      e.preventDefault();
      const id = document.getElementById('prospectId').value;
      const nama = document.getElementById('prospectNama').value.trim();
      const kontak = document.getElementById('prospectKontak').value.trim();
      const email = document.getElementById('prospectEmail').value.trim();
      const mobilSel = document.getElementById('prospectMobilSelect');
      const mobilId = mobilSel.value;
      const mobilNama = mobilSel.options[mobilSel.selectedIndex]?.text?.split('-')[0]?.trim() || '';
      const status = document.getElementById('prospectStatus').value;
      const nominal = parseFloat(document.getElementById('prospectNominal').value) || 0;
      const catatan = document.getElementById('prospectCatatan').value.trim();
      const u = window.PORTAL_USER || {};

      if (id) {
        const item = portalProspects.find(p => p.id == id);
        if (item) {
          item.nama_prospek = nama; item.kontak = kontak; item.email = email;
          item.mobil_id = mobilId; item.mobil_nama = mobilNama;
          item.status = status; item.estimasi_nominal = nominal; item.catatan = catatan;
        }
      } else {
        portalProspects.unshift({
          id: Date.now(),
          nama_prospek: nama,
          kontak: kontak,
          email: email,
          mobil_id: mobilId,
          mobil_nama: mobilNama,
          sales_nama: u.nama || 'Sales Representative',
          status: status,
          estimasi_nominal: nominal,
          catatan: catatan
        });
      }

      localStorage.setItem('pcsProspects', JSON.stringify(portalProspects));
      closeModal('modalProspect');
      renderProspectTable();
      updateSidebarBadges();
      alert('Data prospek berhasil disimpan!');
    }

    function convertProspectToDeal(id) {
      const p = portalProspects.find(x => x.id == id);
      if (!p) return;
      p.status = 'closed_won';
      localStorage.setItem('pcsProspects', JSON.stringify(portalProspects));

      // Open transaction modal pre-filled
      openAddTransactionModal();
      document.getElementById('trxCustNama').value = p.nama_prospek;
      document.getElementById('trxCustKontak').value = p.kontak;
      if (p.mobil_id) {
        document.getElementById('trxMobilSelect').value = p.mobil_id;
        syncTrxPriceFromCar();
      }
      renderProspectTable();
    }

    function deleteProspect(id) {
      if (!confirm('Hapus data prospek ini?')) return;
      portalProspects = portalProspects.filter(p => p.id != id);
      localStorage.setItem('pcsProspects', JSON.stringify(portalProspects));
      renderProspectTable();
      updateSidebarBadges();
    }

    // ═════════════════════════════════════════════════════════════════
    // TRANSAKSI PENJUALAN (Admin, Sales, Owner Read-Only)
    // ═════════════════════════════════════════════════════════════════
    function renderTransactionsTable() {
      const tbl = document.getElementById('tblTransactionsBody');
      if (!tbl) return;

      if (portalTransactions.length === 0) {
        tbl.innerHTML = `<tr><td colspan="9" style="text-align:center; padding:32px; color:var(--gray-500);">Belum ada transaksi penjualan unit.</td></tr>`;
        return;
      }

      tbl.innerHTML = portalTransactions.map(t => `
        <tr>
          <td><strong style="letter-spacing:0.04em;">${t.nomor_transaksi}</strong></td>
          <td>${t.tanggal_transaksi}</td>
          <td>
            <div style="font-weight:600;">${t.customer_nama}</div>
            <small style="color:var(--gray-500);">${t.customer_kontak}</small>
          </td>
          <td><strong>${t.mobil_nama}</strong></td>
          <td>${t.sales_nama}</td>
          <td><span style="text-transform:uppercase; font-size:0.75rem; font-weight:700;">${t.metode_pembayaran}</span></td>
          <td><strong style="font-size:0.95rem; color:var(--black);">${formatIDR(t.harga_kesepakatan)}</strong></td>
          <td><span class="badge-status badge-${t.status}">${t.status}</span></td>
          <td>
            <button class="btn-action" onclick="printSPK('${t.nomor_transaksi}')">Cetak SPK</button>
          </td>
        </tr>
      `).join('');
    }

    function openAddTransactionModal() {
      if (currentRole === 'owner') {
        alert('Role Owner memiliki akses Read-Only dan tidak dapat menambahkan transaksi.');
        return;
      }
      document.getElementById('trxCustNama').value = '';
      document.getElementById('trxCustKontak').value = '';
      document.getElementById('trxCatatan').value = '';
      syncTrxPriceFromCar();
      openModal('modalTransaction');
    }

    function saveTransactionForm(e) {
      e.preventDefault();
      const custNama = document.getElementById('trxCustNama').value.trim();
      const custKontak = document.getElementById('trxCustKontak').value.trim();
      const mobilSel = document.getElementById('trxMobilSelect');
      const mobilId = mobilSel.value;
      const mobilNama = mobilSel.options[mobilSel.selectedIndex]?.text?.split('-')[0]?.trim() || '';
      const harga = parseFloat(document.getElementById('trxHarga').value) || 0;
      const metode = document.getElementById('trxMetode').value;
      const dp = parseFloat(document.getElementById('trxDp').value) || 0;
      const u = window.PORTAL_USER || {};
      const noTrx = 'TRX-' + new Date().toISOString().slice(0,10).replace(/-/g,'') + '-' + Math.floor(1000 + Math.random()*9000);

      portalTransactions.unshift({
        id: Date.now(),
        nomor_transaksi: noTrx,
        customer_nama: custNama,
        customer_kontak: custKontak,
        mobil_id: mobilId,
        mobil_nama: mobilNama,
        sales_nama: u.nama || 'Sales Representative',
        harga_kesepakatan: harga,
        metode_pembayaran: metode,
        down_payment: dp,
        status: 'completed',
        tanggal_transaksi: new Date().toISOString().split('T')[0]
      });

      // Reduce stock of car
      const car = currentCars.find(c => c.id == mobilId);
      if (car && car.stok > 0) car.stok -= 1;

      localStorage.setItem('pcsTransactions', JSON.stringify(portalTransactions));
      closeModal('modalTransaction');
      renderTransactionsTable();
      renderSalesReportTable();
      updateSidebarBadges();
      alert(`Transaksi ${noTrx} berhasil disimpan dan unit mobil telah dialokasikan!`);
    }

    function printSPK(noTrx) {
      const t = portalTransactions.find(x => x.nomor_transaksi === noTrx);
      if (!t) return;
      alert(`Surat Pemesanan Kendaraan (SPK)\nNomor: ${t.nomor_transaksi}\nCustomer: ${t.customer_nama}\nKendaraan: ${t.mobil_nama}\nNilai: ${formatIDR(t.harga_kesepakatan)}\nSales: ${t.sales_nama}\nStatus: ${t.status.toUpperCase()}`);
    }

    function exportTransactionsCSV() {
      let csv = "Nomor Transaksi,Tanggal,Customer,Kontak,Kendaraan,Sales,Metode,Harga Kesepakatan,Status\n";
      portalTransactions.forEach(t => {
        csv += `"${t.nomor_transaksi}","${t.tanggal_transaksi}","${t.customer_nama}","${t.customer_kontak}","${t.mobil_nama}","${t.sales_nama}","${t.metode_pembayaran}","${t.harga_kesepakatan}","${t.status}"\n`;
      });
      downloadCSV(csv, 'Laporan_Transaksi_Penjualan.csv');
    }

    // ═════════════════════════════════════════════════════════════════
    // LAPORAN PENJUALAN UNIT
    // ═════════════════════════════════════════════════════════════════
    function renderSalesReportTable() {
      const tbl = document.getElementById('tblReportSalesBody');
      if (!tbl) return;

      const totalUnits = portalTransactions.length;
      const totalRev = portalTransactions.reduce((a, b) => a + parseFloat(b.harga_kesepakatan || 0), 0);
      const avg = totalUnits > 0 ? totalRev / totalUnits : 0;
      const cashCount = portalTransactions.filter(t => t.metode_pembayaran === 'cash').length;
      const cashPct = totalUnits > 0 ? Math.round((cashCount / totalUnits) * 100) : 0;

      document.getElementById('reportSalesTotalUnits').innerText = totalUnits;
      document.getElementById('reportSalesTotalRevenue').innerText = formatIDR(totalRev);
      document.getElementById('reportSalesAvgTicket').innerText = formatIDR(avg);
      document.getElementById('reportSalesCashRatio').innerText = `${cashPct}% Cash / ${100 - cashPct}% Kredit`;

      tbl.innerHTML = portalTransactions.map(t => `
        <tr>
          <td><strong>${t.nomor_transaksi}</strong></td>
          <td>${t.tanggal_transaksi}</td>
          <td>${t.customer_nama}</td>
          <td><strong>${t.mobil_nama}</strong></td>
          <td>${t.sales_nama}</td>
          <td><span style="text-transform:uppercase;">${t.metode_pembayaran}</span></td>
          <td>${formatIDR(t.down_payment || 0)}</td>
          <td><strong style="color:var(--black); font-size:0.95rem;">${formatIDR(t.harga_kesepakatan)}</strong></td>
        </tr>
      `).join('');
    }

    function exportSalesReportsCSV() {
      exportTransactionsCSV();
    }

    // ═════════════════════════════════════════════════════════════════
    // MANAJEMEN SERVIS (Admin Super User)
    // ═════════════════════════════════════════════════════════════════
    let currentServiceFilter = 'all';

    function renderManageServiceTable() {
      const tbl = document.getElementById('tblManageServiceBody');
      if (!tbl) return;

      const filtered = portalServices.filter(s => {
        if (currentServiceFilter === 'all') return true;
        return s.status === currentServiceFilter;
      });

      if (filtered.length === 0) {
        tbl.innerHTML = `<tr><td colspan="10" style="text-align:center; padding:32px; color:var(--gray-500);">Tidak ada data servis pada kategori ini.</td></tr>`;
        return;
      }

      tbl.innerHTML = filtered.map(s => `
        <tr>
          <td><strong style="letter-spacing:0.04em;">${s.booking_kode}</strong></td>
          <td>
            <div>${s.tanggal_servis}</div>
            <small style="color:var(--gray-500);">${s.jam_servis}</small>
          </td>
          <td>
            <div style="font-weight:600;">${s.nama_customer}</div>
            <small style="color:var(--gold); font-weight:700;">${s.nomor_polisi}</small>
          </td>
          <td>${s.kendaraan_model}</td>
          <td><span style="font-weight:600; text-transform:capitalize;">${s.jenis_servis.replace('_', ' ')}</span></td>
          <td>${formatIDR(s.biaya_jasa || 0)}</td>
          <td>${formatIDR(s.biaya_sparepart || 0)}</td>
          <td><strong style="color:var(--black);">${formatIDR(s.total_biaya || 0)}</strong></td>
          <td><span class="badge-status badge-${s.status}">${s.status}</span></td>
          <td>
            <div style="display:flex; gap:6px; flex-wrap:wrap;">
              <button class="btn-action" title="Kelola Biaya Jasa & Parts" onclick="openBillingModal('${s.booking_kode}')">Biaya</button>
              ${s.status === 'pending' ? `<button class="btn-action btn-action-success" onclick="updateServiceStatus('${s.booking_kode}', 'dikonfirmasi')">Konfirmasi</button>` : ''}
              ${s.status === 'dikonfirmasi' ? `<button class="btn-action btn-action-primary" onclick="updateServiceStatus('${s.booking_kode}', 'in_progress')">Kerjakan</button>` : ''}
              ${s.status === 'in_progress' ? `<button class="btn-action btn-action-success" onclick="updateServiceStatus('${s.booking_kode}', 'selesai')">Selesai</button>` : ''}
            </div>
          </td>
        </tr>
      `).join('');
    }

    function filterServiceTable(status, btn) {
      currentServiceFilter = status;
      if (btn) {
        btn.parentElement.querySelectorAll('button').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
      }
      renderManageServiceTable();
    }

    function openAddServiceBookingModal() {
      document.getElementById('srvNama').value = '';
      document.getElementById('srvKontak').value = '';
      document.getElementById('srvKendaraan').value = '';
      document.getElementById('srvNopol').value = '';
      document.getElementById('srvKeluhan').value = '';
      openModal('modalServiceBooking');
    }

    function saveServiceBookingForm(e) {
      e.preventDefault();
      const nama = document.getElementById('srvNama').value.trim();
      const kontak = document.getElementById('srvKontak').value.trim();
      const kendaraan = document.getElementById('srvKendaraan').value.trim();
      const nopol = document.getElementById('srvNopol').value.trim().toUpperCase();
      const jenis = document.getElementById('srvJenis').value;
      const tgl = document.getElementById('srvTanggal').value;
      const jam = document.getElementById('srvJam').value;
      const keluhan = document.getElementById('srvKeluhan').value.trim();

      const rates = {
        'ganti_oli': { jasa: 750000, parts: 2500000, desc: 'Motul 300V Supercar Oil + Filter OEM' },
        'tune_up': { jasa: 1500000, parts: 3200000, desc: 'Busi Racing + Injector Cleaner + Filter' },
        'servis_umum': { jasa: 2000000, parts: 4500000, desc: 'General Inspection 150 Titik + Cairan Fluida' },
        'perbaikan_rem': { jasa: 1200000, parts: 5000000, desc: 'Brembo Pad + Kuras Minyak Rem' },
        'servis_ac': { jasa: 900000, parts: 1800000, desc: 'Flushing Freon R134a + Filter Kabin' },
        'kelistrikan': { jasa: 1800000, parts: 3500000, desc: 'OBD Factory Diagnostic Scan' },
        'lainnya': { jasa: 1000000, parts: 2000000, desc: 'Servis Khusus Sesuai Keluhan' }
      };

      const r = rates[jenis] || rates['ganti_oli'];
      const kode = 'SRV-' + tgl.replace(/-/g, '') + '-' + Math.floor(100 + Math.random() * 900);

      portalServices.unshift({
        id: Date.now(),
        booking_kode: kode,
        nama_customer: nama,
        kontak: kontak,
        kendaraan_model: kendaraan,
        nomor_polisi: nopol,
        jenis_servis: jenis,
        tanggal_servis: tgl,
        jam_servis: jam,
        keluhan: keluhan,
        mekanik_nama: 'Mekanik Senior (Master Tech)',
        biaya_jasa: r.jasa,
        biaya_sparepart: r.parts,
        total_biaya: r.jasa + r.parts,
        rincian_sparepart: r.desc,
        status: (currentRole === 'admin') ? 'dikonfirmasi' : 'pending'
      });

      localStorage.setItem('pcsServices', JSON.stringify(portalServices));
      closeModal('modalServiceBooking');
      renderManageServiceTable();
      renderServiceReportTable();
      renderCustomerServiceTable();
      updateSidebarBadges();
      alert(`Booking servis berhasil didaftarkan dengan nomor: ${kode}!`);
    }

    function updateServiceStatus(kode, newStatus) {
      const s = portalServices.find(x => x.booking_kode === kode);
      if (!s) return;
      s.status = newStatus;
      localStorage.setItem('pcsServices', JSON.stringify(portalServices));
      renderManageServiceTable();
      renderServiceReportTable();
      updateSidebarBadges();
      alert(`Status servis ${kode} diubah menjadi: ${newStatus.toUpperCase()}`);
    }

    function openBillingModal(kode) {
      const s = portalServices.find(x => x.booking_kode === kode);
      if (!s) return;
      document.getElementById('billingSrvId').value = s.booking_kode;
      document.getElementById('billingKodeDisplay').innerText = s.booking_kode;
      document.getElementById('billingCarDisplay').innerText = `${s.nama_customer} • ${s.kendaraan_model} (${s.nomor_polisi})`;
      document.getElementById('billingJasa').value = s.biaya_jasa || 0;
      document.getElementById('billingSparepart').value = s.biaya_sparepart || 0;
      document.getElementById('billingPartsDetail').value = s.rincian_sparepart || '';
      calculateBillingTotal();
      openModal('modalServiceBilling');
    }

    function calculateBillingTotal() {
      const j = parseFloat(document.getElementById('billingJasa').value) || 0;
      const p = parseFloat(document.getElementById('billingSparepart').value) || 0;
      document.getElementById('billingTotalDisplay').innerText = formatIDR(j + p);
    }

    function saveServiceBillingForm(e) {
      e.preventDefault();
      const kode = document.getElementById('billingSrvId').value;
      const s = portalServices.find(x => x.booking_kode === kode);
      if (!s) return;

      const j = parseFloat(document.getElementById('billingJasa').value) || 0;
      const p = parseFloat(document.getElementById('billingSparepart').value) || 0;
      s.biaya_jasa = j;
      s.biaya_sparepart = p;
      s.total_biaya = j + p;
      s.rincian_sparepart = document.getElementById('billingPartsDetail').value.trim();

      localStorage.setItem('pcsServices', JSON.stringify(portalServices));
      closeModal('modalServiceBilling');
      renderManageServiceTable();
      renderServiceReportTable();
      alert('Rincian biaya servis berhasil diperbarui!');
    }

    // ═════════════════════════════════════════════════════════════════
    // LAPORAN PEMASUKAN SERVIS (Admin & Owner)
    // ═════════════════════════════════════════════════════════════════
    function renderServiceReportTable() {
      const tbl = document.getElementById('tblReportServiceBody');
      const breakdownWrap = document.getElementById('srvBreakdownCards');
      if (!tbl) return;

      const totalCount = portalServices.length;
      const totalRev = portalServices.reduce((a, b) => a + (parseFloat(b.total_biaya) || 0), 0);
      const totalJasa = portalServices.reduce((a, b) => a + (parseFloat(b.biaya_jasa) || 0), 0);
      const totalParts = portalServices.reduce((a, b) => a + (parseFloat(b.biaya_sparepart) || 0), 0);

      document.getElementById('reportSrvTotalCount').innerText = totalCount;
      document.getElementById('reportSrvTotalRevenue').innerText = formatIDR(totalRev);
      document.getElementById('reportSrvTotalJasa').innerText = formatIDR(totalJasa);
      document.getElementById('reportSrvTotalParts').innerText = formatIDR(totalParts);

      // Breakdown Cards per Jenis Servis (Ganti Oli, Tune Up, Servis Umum, dll.)
      if (breakdownWrap) {
        const types = [
          { key: 'ganti_oli', name: 'Ganti Oli Mesin', desc: 'Motul 300V / Castrol Edge Supercar', color: '#b45309' },
          { key: 'tune_up', name: 'Tune Up Performance', desc: 'Busi Iridium, Throttle, Injector', color: '#1d4ed8' },
          { key: 'servis_umum', name: 'Servis Umum & Inspection', desc: '150-Point Factory Inspection', color: '#047857' },
          { key: 'perbaikan_rem', name: 'Perbaikan Rem & Kaliper', desc: 'Brembo Pad & Fluid Replacement', color: '#b91c1c' }
        ];

        breakdownWrap.innerHTML = types.map(t => {
          const list = portalServices.filter(s => s.jenis_servis === t.key);
          const count = list.length;
          const rev = list.reduce((a, b) => a + (parseFloat(b.total_biaya) || 0), 0);
          const pct = totalRev > 0 ? Math.round((rev / totalRev) * 100) : 0;
          return `
            <div style="background:#fafafa; border:1px solid var(--gray-200); padding:16px;">
              <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                <span style="font-size:0.75rem; font-weight:700; text-transform:uppercase; color:${t.color};">${t.name}</span>
                <span style="font-size:0.75rem; font-weight:700; background:var(--white); padding:2px 8px; border:1px solid var(--gray-300);">${count} Unit</span>
              </div>
              <div style="font-family:var(--font-serif); font-size:1.35rem; font-weight:700; color:var(--black); margin-bottom:6px;">${formatIDR(rev)}</div>
              <div style="background:var(--gray-200); height:5px; border-radius:3px; overflow:hidden; margin-bottom:6px;">
                <div style="background:${t.color}; height:100%; width:${pct}%;"></div>
              </div>
              <div style="display:flex; justify-content:space-between; font-size:0.72rem; color:var(--gray-500);">
                <span>${t.desc}</span>
                <span><strong>${pct}%</strong> dari servis</span>
              </div>
            </div>
          `;
        }).join('');
      }

      tbl.innerHTML = portalServices.map(s => `
        <tr>
          <td><strong style="letter-spacing:0.04em;">${s.booking_kode}</strong></td>
          <td>${s.tanggal_servis}</td>
          <td>${s.nama_customer}</td>
          <td>
            <div style="font-weight:600;">${s.kendaraan_model}</div>
            <small style="color:var(--gold); font-weight:700;">${s.nomor_polisi}</small>
          </td>
          <td><span style="font-weight:600; text-transform:capitalize;">${s.jenis_servis.replace('_', ' ')}</span></td>
          <td>${s.mekanik_nama || '-'}</td>
          <td>${formatIDR(s.biaya_jasa || 0)}</td>
          <td>${formatIDR(s.biaya_sparepart || 0)}</td>
          <td><strong style="color:var(--black); font-size:0.95rem;">${formatIDR(s.total_biaya || 0)}</strong></td>
          <td><span class="badge-status badge-${s.status}">${s.status}</span></td>
        </tr>
      `).join('');
    }

    function exportServiceReportsCSV() {
      let csv = "Kode Servis,Tanggal,Customer,Kontak,Kendaraan,Nomor Polisi,Jenis Servis,Mekanik,Biaya Jasa,Biaya Sparepart,Total Biaya,Status\n";
      portalServices.forEach(s => {
        csv += `"${s.booking_kode}","${s.tanggal_servis}","${s.nama_customer}","${s.kontak}","${s.kendaraan_model}","${s.nomor_polisi}","${s.jenis_servis}","${s.mekanik_nama || ''}","${s.biaya_jasa}","${s.biaya_sparepart}","${s.total_biaya}","${s.status}"\n`;
      });
      downloadCSV(csv, 'Laporan_Pemasukan_Servis_Bengkel.csv');
    }

    // ═════════════════════════════════════════════════════════════════
    // LAPORAN KEUANGAN TERPADU (Admin & Owner)
    // ═════════════════════════════════════════════════════════════════
    function renderFinancialTable() {
      const salesRev = portalTransactions.reduce((a, b) => a + (b.status === 'completed' ? parseFloat(b.harga_kesepakatan || 0) : 0), 0);
      const srvRev = portalServices.reduce((a, b) => a + (b.status === 'selesai' ? parseFloat(b.total_biaya || 0) : 0), 0);
      const srvJasa = portalServices.reduce((a, b) => a + (b.status === 'selesai' ? parseFloat(b.biaya_jasa || 0) : 0), 0);
      const srvParts = portalServices.reduce((a, b) => a + (b.status === 'selesai' ? parseFloat(b.biaya_sparepart || 0) : 0), 0);
      const gross = salesRev + srvRev;

      // Deducting COGS
      const cogsCars = salesRev * 0.88;
      const cogsSrv = srvRev * 0.55;
      const netProfit = gross - (cogsCars + cogsSrv);

      document.getElementById('finSalesRev').innerText = formatIDR(salesRev);
      document.getElementById('finServiceRev').innerText = formatIDR(srvRev);
      document.getElementById('finGrossRev').innerText = formatIDR(gross);
      document.getElementById('finNetProfit').innerText = formatIDR(netProfit);

      document.getElementById('finRowSales').innerText = formatIDR(salesRev);
      document.getElementById('finRowJasa').innerText = formatIDR(srvJasa);
      document.getElementById('finRowParts').innerText = formatIDR(srvParts);
      document.getElementById('finRowGross').innerText = formatIDR(gross);
      document.getElementById('finRowCogsCars').innerText = `(${formatIDR(cogsCars)})`;
      document.getElementById('finRowCogsService').innerText = `(${formatIDR(cogsSrv)})`;
      document.getElementById('finRowNet').innerText = formatIDR(netProfit);
    }

    function exportFinancialCSV() {
      const salesRev = portalTransactions.reduce((a, b) => a + parseFloat(b.harga_kesepakatan || 0), 0);
      const srvRev = portalServices.reduce((a, b) => a + parseFloat(b.total_biaya || 0), 0);
      const gross = salesRev + srvRev;
      const net = (salesRev * 0.12) + (srvRev * 0.45);

      let csv = "POS KEUANGAN,JUMLAH (IDR)\n";
      csv += `"Pendapatan Penjualan Mobil","${salesRev}"\n`;
      csv += `"Pendapatan Servis Bengkel","${srvRev}"\n`;
      csv += `"TOTAL GROSS REVENUE","${gross}"\n`;
      csv += `"ESTIMASI NET PROFIT","${net}"\n`;
      downloadCSV(csv, 'Laporan_Keuangan_Terpadu.csv');
    }

    // ═════════════════════════════════════════════════════════════════
    // CUSTOMER SERVICE SECTION (Role User)
    // ═════════════════════════════════════════════════════════════════
    function renderCustomerServiceTable() {
      const tbl = document.getElementById('tblCustomerServiceBody');
      if (!tbl) return;

      const u = window.PORTAL_USER || {};
      // Filter for customer
      const myBookings = portalServices.filter(s => {
        if (!u.email) return true;
        return s.email === u.email || s.nama_customer.toLowerCase().includes(u.nama?.toLowerCase() || '');
      });

      const dataToRender = myBookings.length > 0 ? myBookings : portalServices.slice(0, 3);

      tbl.innerHTML = dataToRender.map(s => `
        <tr>
          <td><strong style="letter-spacing:0.04em;">${s.booking_kode}</strong></td>
          <td>${s.tanggal_servis} @ ${s.jam_servis}</td>
          <td>
            <strong>${s.kendaraan_model}</strong>
            <div><small style="color:var(--gold); font-weight:700;">${s.nomor_polisi}</small></div>
          </td>
          <td><span style="font-weight:600; text-transform:capitalize;">${s.jenis_servis.replace('_', ' ')}</span></td>
          <td><span class="badge-status badge-${s.status}">${s.status}</span></td>
          <td><strong>${formatIDR(s.total_biaya || 0)}</strong></td>
          <td><small style="color:var(--gray-600);">${s.rincian_sparepart || 'Pengerjaan reguler'}</small></td>
        </tr>
      `).join('');
    }

    // ═════════════════════════════════════════════════════════════════
    // INVENTORY MANAGEMENT (Admin Only)
    // ═════════════════════════════════════════════════════════════════
    function renderInventoryTable() {
      const tbl = document.getElementById('tblInventoryBody');
      if (!tbl) return;

      tbl.innerHTML = currentCars.map(c => `
        <tr>
          <td>#${c.id}</td>
          <td><strong>${c.brand} ${c.model}</strong></td>
          <td>${c.tahun}</td>
          <td>${formatIDR(c.harga_otr)}</td>
          <td>${c.stok} Unit</td>
          <td>
            <button class="btn-action" onclick="editCarInventory(${c.id})">Edit</button>
            <button class="btn-action btn-action-danger" onclick="deleteCarInventory(${c.id})">Hapus</button>
          </td>
        </tr>
      `).join('');
    }

    function openAddCarModal() {
      document.getElementById('carFormId').value = '';
      document.getElementById('carFormBrand').value = '';
      document.getElementById('carFormModel').value = '';
      document.getElementById('carFormTahun').value = '2026';
      document.getElementById('carFormHarga').value = '';
      document.getElementById('carFormStok').value = '1';
      document.getElementById('carFormDesc').value = '';
      openModal('carFormModal');
    }

    function editCarInventory(id) {
      const c = currentCars.find(x => x.id == id);
      if (!c) return;
      document.getElementById('carFormId').value = c.id;
      document.getElementById('carFormBrand').value = c.brand;
      document.getElementById('carFormModel').value = c.model;
      document.getElementById('carFormTahun').value = c.tahun;
      document.getElementById('carFormHarga').value = c.harga_otr;
      document.getElementById('carFormStok').value = c.stok;
      document.getElementById('carFormDesc').value = c.deskripsi;
      openModal('carFormModal');
    }

    function saveCarInventoryForm(e) {
      e.preventDefault();
      saveCarForm(e);
      renderInventoryTable();
      populateMobilSelects();
    }

    function deleteCarInventory(id) {
      deleteCar(id);
      renderInventoryTable();
      populateMobilSelects();
    }

    // ═════════════════════════════════════════════════════════════════
    // USER MANAGEMENT & RBAC (Admin Only)
    // ═════════════════════════════════════════════════════════════════
    function renderUsersTable() {
      const tbl = document.getElementById('tblUsersBody');
      if (!tbl) return;

      tbl.innerHTML = portalUsers.map(u => `
        <tr>
          <td><strong>#${u.id}</strong></td>
          <td><strong>${u.nama}</strong></td>
          <td>${u.email}</td>
          <td><span class="sidebar-brand-role role-badge-${u.role}">${u.role.toUpperCase()}</span></td>
          <td>${u.no_telepon || '-'}</td>
          <td><span style="color:#059669; font-weight:700;">Aktif</span></td>
          <td>
            <div style="display:flex; gap:6px;">
              <button class="btn-action" onclick="editUserModal(${u.id})">Edit</button>
              ${u.id !== 1 ? `<button class="btn-action btn-action-danger" onclick="deleteUser(${u.id})">Hapus</button>` : ''}
            </div>
          </td>
        </tr>
      `).join('');
    }

    function openAddUserModal() {
      document.getElementById('userId').value = '';
      document.getElementById('userNama').value = '';
      document.getElementById('userEmail').value = '';
      document.getElementById('userPhone').value = '';
      document.getElementById('userPassword').value = '';
      document.getElementById('modalUserTitle').innerText = 'Tambah Pengguna Baru';
      openModal('modalUserForm');
    }

    function editUserModal(id) {
      const u = portalUsers.find(x => x.id == id);
      if (!u) return;
      document.getElementById('userId').value = u.id;
      document.getElementById('userNama').value = u.nama;
      document.getElementById('userEmail').value = u.email;
      document.getElementById('userRole').value = u.role;
      document.getElementById('userPhone').value = u.no_telepon || '';
      document.getElementById('userPassword').value = '';
      document.getElementById('modalUserTitle').innerText = 'Edit Akun Pengguna';
      openModal('modalUserForm');
    }

    function saveUserForm(e) {
      e.preventDefault();
      const id = document.getElementById('userId').value;
      const nama = document.getElementById('userNama').value.trim();
      const email = document.getElementById('userEmail').value.trim();
      const role = document.getElementById('userRole').value;
      const phone = document.getElementById('userPhone').value.trim();

      if (id) {
        const u = portalUsers.find(x => x.id == id);
        if (u) {
          u.nama = nama; u.email = email; u.role = role; u.no_telepon = phone;
        }
      } else {
        portalUsers.push({
          id: Date.now(),
          nama: nama,
          email: email,
          role: role,
          no_telepon: phone,
          is_active: 1
        });
      }

      localStorage.setItem('pcsUsersList', JSON.stringify(portalUsers));
      closeModal('modalUserForm');
      renderUsersTable();
      alert('Pengguna berhasil disimpan!');
    }

    function deleteUser(id) {
      if (id == 1) {
        alert('Super Admin utama tidak dapat dihapus!');
        return;
      }
      if (!confirm('Hapus akun pengguna ini?')) return;
      portalUsers = portalUsers.filter(x => x.id != id);
      localStorage.setItem('pcsUsersList', JSON.stringify(portalUsers));
      renderUsersTable();
    }

    // ═════════════════════════════════════════════════════════════════
    // 10. TEST DRIVE & VIP CLIENT TABLES (Admin & Sales)
    // ═════════════════════════════════════════════════════════════════
    function renderTestDriveTable() {
      const tbody = document.getElementById('tblTestDriveBody');
      if (!tbody) return;

      const list = JSON.parse(localStorage.getItem('pcsTestDrives') || '[]');
      if (list.length === 0) {
        tbody.innerHTML = `<tr><td colspan="8" style="text-align:center; padding:32px; color:var(--gray-500);">Belum ada jadwal test drive dari klien.</td></tr>`;
        return;
      }

      const tdBadges = {
        'pending': '<span class="badge-status badge-pending">Menunggu Konfirmasi</span>',
        'confirmed': '<span class="badge-status badge-approved">Dikonfirmasi</span>',
        'completed': '<span class="badge-status" style="background:#e0f2fe; color:#0369a1; border:1px solid #bae6fd;">Selesai</span>',
        'cancelled': '<span class="badge-status badge-rejected">Dibatalkan</span>'
      };

      tbody.innerHTML = list.map(t => `
        <tr>
          <td><strong>${t.id}</strong></td>
          <td>
            <strong>${t.name}</strong>
            <div style="font-size:0.75rem; color:var(--gray-500);">${t.email || '-'}</div>
          </td>
          <td>
            <a href="https://wa.me/${(t.phone || '').replace(/[^0-9]/g, '')}" target="_blank" style="color:var(--gold); font-weight:600; text-decoration:none;">
              ${t.phone} ↗
            </a>
          </td>
          <td><strong>${t.carName}</strong></td>
          <td>
            ${t.date}<br>
            <small style="color:var(--gray-600); font-weight:600;">${t.time}</small>
          </td>
          <td style="max-width:200px; font-size:0.78rem; color:var(--gray-600);">${t.notes || '-'}</td>
          <td>${tdBadges[t.status] || t.status}</td>
          <td>
            <div style="display:flex; gap:6px; flex-wrap:wrap;">
              ${t.status === 'pending' ? `
                <button class="btn-action btn-action-primary" onclick="changeTestDriveStatus('${t.id}', 'confirmed')">Konfirmasi</button>
              ` : ''}
              ${t.status === 'confirmed' ? `
                <button class="btn-action" style="background:#e0f2fe; color:#0369a1;" onclick="changeTestDriveStatus('${t.id}', 'completed')">Selesai</button>
              ` : ''}
              ${t.status !== 'cancelled' && t.status !== 'completed' ? `
                <button class="btn-action btn-action-danger" onclick="changeTestDriveStatus('${t.id}', 'cancelled')">Batal</button>
              ` : ''}
            </div>
          </td>
        </tr>
      `).join('');
    }

    function changeTestDriveStatus(id, newStatus) {
      const list = JSON.parse(localStorage.getItem('pcsTestDrives') || '[]');
      const item = list.find(t => t.id === id);
      if (item) {
        item.status = newStatus;
        localStorage.setItem('pcsTestDrives', JSON.stringify(list));
        updateSidebarBadges();
        renderTestDriveTable();
        alert(`Status Test Drive ${id} diperbarui menjadi: ${newStatus.toUpperCase()}`);
      }
    }

    // ═════════════════════════════════════════════════════════════════
    // 11. TITIP JUAL / KONSINYASI (Admin & Sales)
    // ═════════════════════════════════════════════════════════════════
    function renderSellCarsTable() {
      const tbody = document.getElementById('tblSellCarsBody');
      if (!tbody) return;

      const list = JSON.parse(localStorage.getItem('pcsSellListings') || '[]');
      if (list.length === 0) {
        tbody.innerHTML = `<tr><td colspan="7" style="text-align:center; padding:32px; color:var(--gray-500);">Belum ada permohonan titip jual mobil dari klien.</td></tr>`;
        return;
      }

      const sellBadges = {
        'under_review': '<span class="badge-status badge-pending">Dalam Kurasi</span>',
        'approved': '<span class="badge-status badge-approved">Disetujui / Di Katalog</span>',
        'sold': '<span class="badge-status" style="background:#fef3c7; color:#92400e; border:1px solid #fde68a;">Unit Terjual ✨</span>',
        'rejected': '<span class="badge-status badge-rejected">Ditolak</span>',
        'cancelled': '<span class="badge-status badge-rejected">Dibatalkan Klien</span>'
      };

      tbody.innerHTML = list.map(l => `
        <tr>
          <td><strong>${l.id}</strong></td>
          <td>
            <strong>${l.brand} ${l.model} (${l.year})</strong>
            <div style="font-size:0.75rem; color:var(--gray-500);">${l.mileage} • ${l.color}</div>
          </td>
          <td>
            <strong>${l.ownerName}</strong>
            <div style="font-size:0.75rem; color:var(--gray-500);">${l.ownerEmail}</div>
            <a href="https://wa.me/${(l.ownerPhone || '').replace(/[^0-9]/g, '')}?text=Halo%20${encodeURIComponent(l.ownerName)},%20kami%20dari%20PCS%20Edition%20mengenai%20unit%20titip%20jual%20${l.id}" target="_blank" style="color:var(--gold); font-size:0.75rem; font-weight:700; text-decoration:none;">
              WA: ${l.ownerPhone} ↗
            </a>
          </td>
          <td>
            <strong style="font-family:var(--font-serif); font-size:0.95rem;">${formatIDR(l.askingPrice)}</strong>
          </td>
          <td style="max-width:240px; font-size:0.78rem;">
            <span style="font-weight:700; text-transform:capitalize; color:#047857;">Kondisi: ${l.condition}</span>
            <div style="color:var(--gray-600); margin-top:2px;">${l.description || '-'}</div>
            ${l.technicianNotes ? `<div style="color:#b45309; font-size:0.72rem; margin-top:4px;"><strong>Catatan:</strong> ${l.technicianNotes}</div>` : ''}
          </td>
          <td>${sellBadges[l.status] || l.status}</td>
          <td>
            <div style="display:flex; gap:6px; flex-wrap:wrap;">
              ${l.status === 'under_review' ? `
                <button class="btn-action btn-action-primary" onclick="approveSellListing('${l.id}')">Setujui & Katalog</button>
                <button class="btn-action btn-action-danger" onclick="rejectSellListing('${l.id}')">Tolak</button>
              ` : ''}
              ${l.status === 'approved' ? `
                <button class="btn-action" style="background:#fef3c7; color:#92400e;" onclick="markSellAsSold('${l.id}')">Tandai Terjual</button>
              ` : ''}
            </div>
          </td>
        </tr>
      `).join('');
    }

    function approveSellListing(id) {
      if (!confirm(`Setujui pengajuan titip jual ${id} dan masukkan unit langsung ke inventaris showroom?`)) return;
      const list = JSON.parse(localStorage.getItem('pcsSellListings') || '[]');
      const item = list.find(l => l.id === id);
      if (!item) return;

      item.status = 'approved';
      item.inspectionDate = 'Inspeksi Fisik Selesai';
      item.technicianNotes = 'Lolos inspeksi 150 titik showroom SCBD & telah tayang di katalog etalase';
      localStorage.setItem('pcsSellListings', JSON.stringify(list));

      // Also automatically add to currentCars inventory!
      const newCarId = Math.max(...currentCars.map(c => c.id || 0), 0) + 1;
      currentCars.unshift({
        id: newCarId,
        brand: item.brand,
        model: item.model,
        tahun: item.year,
        tipe: 'Consignment Supercar',
        harga_otr: item.askingPrice,
        gambar_utama: 'assets/img/cars/ferrari-sf90.png',
        transmisi: 'Dual-Clutch F1',
        bahan_bakar: 'Hybrid Petrol',
        stok: 1,
        warna: item.color,
        deskripsi: item.description || `Unit konsinyasi eksklusif dari klien PCS Edition. ${item.mileage}, full record.`
      });

      try {
        fetch('api.php?action=update_sell_status', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ id: id, status: 'approved', catatan_kurasi: item.technicianNotes })
        });
      } catch (e) {}

      updateSidebarBadges();
      renderSellCarsTable();
      renderInventoryTable();
      populateMobilSelects();
      alert(`Unit ${item.brand} ${item.model} berhasil disetujui dan ditambahkan ke inventaris showroom (#${newCarId})!`);
    }

    function rejectSellListing(id) {
      const reason = prompt('Masukkan alasan penolakan untuk klien (misal: kondisi dokumen tidak lengkap, harga di atas estimasi pasar):', 'Kondisi dokumen legalitas belum lengkap.');
      if (reason === null) return;

      const list = JSON.parse(localStorage.getItem('pcsSellListings') || '[]');
      const item = list.find(l => l.id === id);
      if (item) {
        item.status = 'rejected';
        item.technicianNotes = `Ditolak oleh Kurator: ${reason}`;
        localStorage.setItem('pcsSellListings', JSON.stringify(list));

        try {
          fetch('api.php?action=update_sell_status', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id, status: 'rejected', catatan_kurasi: reason })
          });
        } catch (e) {}

        updateSidebarBadges();
        renderSellCarsTable();
        alert(`Pengajuan ${id} ditolak dengan alasan: ${reason}`);
      }
    }

    function markSellAsSold(id) {
      if (!confirm(`Tandai unit ${id} sebagai TERJUAL?`)) return;
      const list = JSON.parse(localStorage.getItem('pcsSellListings') || '[]');
      const item = list.find(l => l.id === id);
      if (item) {
        item.status = 'sold';
        item.technicianNotes = 'Unit berhasil terjual ke klien VIP PCS Edition';
        localStorage.setItem('pcsSellListings', JSON.stringify(list));
        updateSidebarBadges();
        renderSellCarsTable();
        alert(`Unit ${id} berhasil ditandai sebagai TERJUAL!`);
      }
    }

    // ═════════════════════════════════════════════════════════════════
    // 12. PESAN & PERTANYAAN KLIEN (Admin & Sales)
    // ═════════════════════════════════════════════════════════════════
    function renderContactMessagesTable() {
      const tbody = document.getElementById('tblContactMessagesBody');
      if (!tbody) return;

      const list = JSON.parse(localStorage.getItem('pcsContactMessages') || '[]');
      if (list.length === 0) {
        tbody.innerHTML = `<tr><td colspan="7" style="text-align:center; padding:32px; color:var(--gray-500);">Belum ada tiket pesan klien masuk.</td></tr>`;
        return;
      }

      const msgBadges = {
        'open': '<span class="badge-status badge-pending">Menunggu Respon</span>',
        'replied': '<span class="badge-status badge-approved">Sudah Dibalas</span>',
        'resolved': '<span class="badge-status" style="background:#e5e7eb; color:#374151;">Selesai</span>'
      };

      tbody.innerHTML = list.map(m => `
        <tr>
          <td><strong>${m.id}</strong></td>
          <td style="font-size:0.78rem; color:var(--gray-600);">${m.createdAt ? m.createdAt.substring(0, 10) : '-'}</td>
          <td>
            <strong>${m.name}</strong>
            <div style="font-size:0.75rem; color:var(--gray-500);">${m.email}</div>
            ${m.phone ? `<a href="https://wa.me/${m.phone.replace(/[^0-9]/g, '')}" target="_blank" style="color:var(--gold); font-size:0.75rem; font-weight:700; text-decoration:none;">WA: ${m.phone} ↗</a>` : ''}
          </td>
          <td>
            <span class="badge-status" style="background:#f1f5f9; color:#334155; text-transform:uppercase;">${m.subject || 'GENERAL'}</span>
          </td>
          <td style="max-width:280px; font-size:0.82rem;">
            <div style="font-style:italic; color:#1e293b;">"${m.message}"</div>
          </td>
          <td>
            ${msgBadges[m.status] || m.status}
            ${m.reply ? `
              <div style="font-size:0.75rem; color:#065f46; background:#ecfdf5; padding:6px 8px; border-left:2px solid #10b981; margin-top:4px;">
                <strong>Balasan (${m.repliedBy || 'Concierge'}):</strong> ${m.reply}
              </div>
            ` : ''}
          </td>
          <td>
            <div style="display:flex; gap:6px; flex-wrap:wrap;">
              <button class="btn-action btn-action-primary" onclick="openReplyContactModal('${m.id}')">Balas Pesan</button>
              ${m.status !== 'resolved' ? `
                <button class="btn-action" onclick="resolveContactMessage('${m.id}')">Tandai Selesai</button>
              ` : ''}
              <button class="btn-action btn-action-danger" onclick="deleteContactMessage('${m.id}')">Hapus</button>
            </div>
          </td>
        </tr>
      `).join('');
    }

    function openReplyContactModal(id) {
      const list = JSON.parse(localStorage.getItem('pcsContactMessages') || '[]');
      const msg = list.find(m => m.id === id);
      if (!msg) return;

      document.getElementById('replyContactId').value = msg.id;
      document.getElementById('replyCustomerName').innerText = msg.name;
      document.getElementById('replyCustomerTicket').innerText = msg.id;
      document.getElementById('replyCustomerContact').innerText = `${msg.email} ${msg.phone ? '• ' + msg.phone : ''}`;
      document.getElementById('replyOriginalMessage').innerText = `"${msg.message}"`;
      document.getElementById('replyTextContent').value = msg.reply || '';

      openModal('modalReplyContact');
    }

    function submitReplyContactMessage(e) {
      e.preventDefault();
      const id = document.getElementById('replyContactId').value;
      const replyText = document.getElementById('replyTextContent').value.trim();

      const list = JSON.parse(localStorage.getItem('pcsContactMessages') || '[]');
      const msg = list.find(m => m.id === id);
      if (msg) {
        msg.reply = replyText;
        msg.repliedAt = new Date().toLocaleDateString('id-ID', { day:'numeric', month:'short', year:'numeric', hour:'2-digit', minute:'2-digit' }) + ' WIB';
        msg.repliedBy = (currentRole === 'sales') ? 'Senior Sales Advisor' : 'PCS Concierge Luxury';
        msg.status = 'replied';

        localStorage.setItem('pcsContactMessages', JSON.stringify(list));

        try {
          fetch('api.php?action=reply_contact_message', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
              id: id,
              balasan: replyText,
              replied_by: msg.repliedBy
            })
          });
        } catch (e) {}

        closeModal('modalReplyContact');
        updateSidebarBadges();
        renderContactMessagesTable();
        alert(`Balasan resmi berhasil dikirim ke tiket customer ${id}!`);
      }
    }

    function resolveContactMessage(id) {
      const list = JSON.parse(localStorage.getItem('pcsContactMessages') || '[]');
      const msg = list.find(m => m.id === id);
      if (msg) {
        msg.status = 'resolved';
        localStorage.setItem('pcsContactMessages', JSON.stringify(list));
        updateSidebarBadges();
        renderContactMessagesTable();
      }
    }

    function deleteContactMessage(id) {
      if (!confirm(`Hapus tiket pesan ${id}?`)) return;
      let list = JSON.parse(localStorage.getItem('pcsContactMessages') || '[]');
      list = list.filter(m => m.id !== id);
      localStorage.setItem('pcsContactMessages', JSON.stringify(list));
      updateSidebarBadges();
      renderContactMessagesTable();
    }

    // ═════════════════════════════════════════════════════════════════
    // HELPER UTILITIES
    // ═════════════════════════════════════════════════════════════════
    function downloadCSV(csvContent, filename) {
      const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
      const link = document.createElement("a");
      const url = URL.createObjectURL(blob);
      link.setAttribute("href", url);
      link.setAttribute("download", filename);
      link.style.visibility = 'hidden';
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    }

    function handlePortalLogout() {
      if (confirm('Keluar dari Portal Manajemen?')) {
        localStorage.removeItem('pcsUser');
        localStorage.removeItem('adminLoggedIn');
        window.location.href = 'index.php';
      }
    }

    async function initDatabaseFromSchema() {
      if (!confirm('Jalankan migrasi MySQL schema.sql ke database? Pastikan Apache dan MySQL di XAMPP sudah berjalan.')) return;
      try {
        const res = await fetch('api.php?action=init_db');
        const json = await res.json();
        if (json.status === 'success') {
          alert('Berhasil: ' + json.message);
        } else {
          alert('Info/Catatan: ' + json.message);
        }
      } catch (e) {
        alert('Gagal menghubungi API: ' + e.message);
      }
    }

    function resetLocalData() {
      if (!confirm('Reset semua data prospek, transaksi, dan servis demo ke nilai default?')) return;
      localStorage.removeItem('pcsProspects');
      localStorage.removeItem('pcsTransactions');
      localStorage.removeItem('pcsServices');
      localStorage.removeItem('pcsUsersList');
      location.reload();
    }
  </script>
</body>
</html>

