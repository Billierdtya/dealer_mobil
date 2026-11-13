<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sell Your Car (Titip Jual) | PCS Edition</title>
  <link rel="icon" type="image/png" href="assets/images/logo_pcs.png">
  <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
  <style>
    #customToast {
      position: fixed;
      bottom: -100px;
      left: 50%;
      transform: translateX(-50%);
      background: var(--black);
      color: var(--white);
      padding: 16px 24px;
      font-size: 0.9rem;
      border-radius: 4px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.15);
      z-index: 9999;
      opacity: 0;
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      display: flex;
      align-items: center;
      gap: 12px;
    }
    #customToast.show {
      bottom: 32px;
      opacity: 1;
    }
    .sell-hero-banner {
      background: linear-gradient(135deg, #1c1408 0%, #35210d 100%);
      color: var(--white);
      padding: 48px 32px;
      border-radius: 8px;
      margin-bottom: 36px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 24px;
      border: 1px solid rgba(217, 119, 6, 0.3);
    }
    .sell-hero-text h2 {
      font-family: var(--font-serif);
      font-size: 2rem;
      font-weight: 500;
      margin-bottom: 8px;
      color: var(--white);
    }
    .sell-hero-text p {
      font-size: 0.95rem;
      color: #fed7aa;
      max-width: 620px;
      line-height: 1.6;
    }
    .sell-badge-pill {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(245, 158, 11, 0.2);
      color: #fbbf24;
      padding: 6px 14px;
      border-radius: 100px;
      font-size: 0.8rem;
      font-weight: 600;
      margin-bottom: 12px;
      border: 1px solid rgba(251, 191, 36, 0.4);
    }
    .sell-grid-layout {
      display: grid;
      grid-template-columns: 1fr 380px;
      gap: 36px;
      margin-bottom: 60px;
    }
    @media (max-width: 992px) {
      .sell-grid-layout {
        grid-template-columns: 1fr;
      }
    }
    .sell-card-box {
      background: var(--white);
      border: 1px solid var(--gray-200);
      padding: 32px;
      border-radius: 6px;
    }
    .sell-feature-item {
      display: flex;
      gap: 14px;
      padding: 16px 0;
      border-bottom: 1px solid var(--gray-100);
    }
    .sell-feature-item:last-child {
      border-bottom: none;
    }
    .sell-feature-icon {
      width: 40px;
      height: 40px;
      border-radius: 6px;
      background: rgba(245, 158, 11, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }
    .sell-feature-icon svg {
      width: 20px;
      height: 20px;
      stroke: #d97706;
    }
    .timeline-step {
      display: flex;
      gap: 14px;
      position: relative;
      padding-bottom: 20px;
    }
    .timeline-step:last-child {
      padding-bottom: 0;
    }
    .timeline-step::before {
      content: '';
      position: absolute;
      top: 24px;
      left: 14px;
      bottom: 0;
      width: 2px;
      background: var(--gray-200);
    }
    .timeline-step:last-child::before {
      display: none;
    }
    .timeline-circle {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background: var(--black);
      color: var(--white);
      font-size: 0.78rem;
      font-weight: 700;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      z-index: 2;
    }
  </style>
</head>

<body>

  <!-- Sidebar Overlay -->
  <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

  <!-- Sidebar Drawer -->
  <aside class="sidebar-drawer" id="sidebarDrawer">
    <div class="sidebar-header">
      <img src="assets/images/logo_pcs.png" alt="PCS Logo">
      <div class="sidebar-header-text">PCS<span>EDITION</span></div>
      <button class="sidebar-close" onclick="toggleSidebar()"><span></span><span></span></button>
    </div>
    <nav class="sidebar-nav">
      <div class="sidebar-nav-section">
        <div class="sidebar-nav-section-title">Browse</div>
      </div>
      <a class="sidebar-nav-item" href="index.php">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
        Home
      </a>
      <a class="sidebar-nav-item" href="cars.php">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"></path><circle cx="7" cy="17" r="2"></circle><path d="M9 17h6"></path><circle cx="17" cy="17" r="2"></circle></svg>
        Cars
      </a>
      <a class="sidebar-nav-item" href="favorites.php">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
        My Favorites
      </a>

      <div class="sidebar-nav-divider"></div>

            <div class="sidebar-nav-section">
        <div class="sidebar-nav-section-title">Services</div>
      </div>
      <a class="sidebar-nav-item" href="service.php">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
        Book Service (Oli / Tune Up)
      </a>
      <button class="sidebar-nav-item" onclick="toggleSidebar(); openMyBookingsModal();">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
        Riwayat & Aktivitas Saya
      </button>
      <a class="sidebar-nav-item" href="insurance.php">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
        Insurance Application
      </a>
      <a class="sidebar-nav-item highlight" href="sell.php">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
        Sell Your Car
      </a>
      <a class="sidebar-nav-item" href="testdrive.php">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        Book Test Drive
      </a>
      <a class="sidebar-nav-item" href="contact.php">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
        Contact Us
      </a>

      <div class="sidebar-nav-divider"></div>

      <div class="sidebar-nav-section">
        <div class="sidebar-nav-section-title">Account</div>
      </div>
      <button class="sidebar-nav-item" id="sidebarLoginBtn" onclick="toggleSidebar(); openModal('loginModal');">
        <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        Log In / Sign Up
      </button>
      <button class="sidebar-nav-item" id="sidebarLogoutBtn" style="display:none;" onclick="toggleSidebar(); userLogout();">
        <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
        Logout
      </button>
      <a class="sidebar-nav-item" href="dashboard.php">
        <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
        Portal Manajemen Dealer
      </a>
    </nav>
    <div class="sidebar-footer">
      © 2026 PT Pencari Cinta Sejati
    </div>
  </aside>

  <!-- Header Wrapper -->
  <div class="header-wrapper">
    <nav class="navbar">
      <div class="navbar-left">
        <div class="menu-icon mobile-only" onclick="toggleSidebar()">
          <span></span><span></span><span></span>
        </div>
        <a href="index.php" class="brand-logo" style="display: flex; align-items: center; gap: 8px;">
          <img src="assets/images/logo_pcs.png" alt="PCS Logo" style="height: 32px; width: auto;">
          PCS<span>EDITION</span>
        </a>
      </div>

      <div class="navbar-center">
        <!-- Desktop Navigation Links -->
                <div class="desktop-nav-links">
          <a href="index.php" class="desktop-nav-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            Home
          </a>
          <a href="cars.php" class="desktop-nav-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"></path><circle cx="7" cy="17" r="2"></circle><path d="M9 17h6"></path><circle cx="17" cy="17" r="2"></circle></svg>
            Cars
          </a>
          <a href="favorites.php" class="desktop-nav-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
            Favorites
          </a>
          <a href="service.php" class="desktop-nav-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
            Service
          </a>
          <a href="insurance.php" class="desktop-nav-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
            Insurance
          </a>
          <a href="sell.php" class="desktop-nav-link active">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
            Sell
          </a>
          <a href="testdrive.php" class="desktop-nav-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            Test Drive
          </a>
          <a href="contact.php" class="desktop-nav-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
            Contact
          </a>
        </div>
      </div>

      <div class="navbar-right">
        <!-- Logged out state -->
        <button class="btn-login" id="navBtnLogin" onclick="openModal('loginModal')">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
          </svg>
          <span class="btn-login-text">Log In / Demo</span>
        </button>
        <!-- Logged in state -->
        <div id="navUserLoggedIn" style="display:none; align-items:center; gap:8px;">
          <span style="font-size:0.83rem; font-weight:600; color:var(--black);" id="navUserName"></span>
          <a href="dashboard.php" id="navPortalLink" class="btn-login" style="display:none; font-size:0.75rem; padding:6px 12px; background:var(--black); color:var(--white); text-decoration:none;">Portal Manajemen</a>
          <button id="navMyBookingsBtn" onclick="openMyBookingsModal('sell')" class="btn-login" style="display:none; font-size:0.75rem; padding:6px 12px;">Aktivitas Saya</button>
          <button class="btn-login" onclick="userLogout()" style="font-size:0.75rem; padding:6px 12px;">Logout</button>
        </div>
      </div>
    </nav>
  </div>

  <!-- Page Header -->
  <div class="page-header container" style="padding-top: 36px; padding-bottom: 24px;">
    <div class="page-breadcrumbs">
      <a href="index.php" style="color:inherit; text-decoration:none;">Home</a> &nbsp;/&nbsp; Sell Your Car (Titip Jual)
    </div>
    <h1 class="page-title" style="margin-top: 8px;">Konsinyasi & Titip Jual Mobil Mewah</h1>
    <p style="color: var(--gray-500); font-size: 0.95rem; margin-top: 6px;">
      Pasarkan koleksi supercar & kendaraan mewah Anda ke ribuan kolektor kualifikasi tinggi di jaringan eksklusif PCS Edition.
    </p>
  </div>

  <!-- Main Content Container -->
  <main class="container" style="max-width: var(--container-max); margin: 0 auto; padding: 0 24px 60px;">

    <!-- Hero Banner -->
    <div class="sell-hero-banner">
      <div class="sell-hero-text">
        <div class="sell-badge-pill">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
          Global Luxury Marketplace
        </div>
        <h2>Jual Koleksi Berharga Anda dengan Nilai Tertinggi</h2>
        <p>
          Kami mengurus seluruh proses dari kurasi fisik, pemotretan studio profesional, legalitas kepemilikan, hingga transaksi escrow aman dengan komisi transparan.
        </p>
      </div>
      <div>
        <button type="button" onclick="document.getElementById('sellBrand').focus()" class="btn-gold" style="padding: 14px 28px; font-size: 0.9rem;">
          Mulai Ajukan Titip Jual &darr;
        </button>
      </div>
    </div>

    <!-- 2-Column Grid: Form + Info Sidebar -->
    <div class="sell-grid-layout">
      
      <!-- Left Column: Form -->
      <div class="sell-card-box">
        <h3 style="font-family:var(--font-serif); font-size:1.4rem; margin-bottom:6px;">Formulir Pendaftaran Titip Jual Kendaraan</h3>
        <p style="font-size:0.85rem; color:var(--gray-500); margin-bottom:24px;">
          Lengkapi data spesifikasi kendaraan Anda. Tim kurator spesialis kami akan melakukan evaluasi nilai pasar dalam 48 jam.
        </p>

        <form id="sellCarForm" onsubmit="submitSellCarForm(event)">
          <div style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.08em; color:var(--gray-500); font-weight:700; margin-bottom:14px; border-bottom:1px solid var(--gray-200); padding-bottom:6px;">
            1. Informasi Spesifikasi Mobil
          </div>

          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label">Merek Mobil (Brand) *</label>
              <input type="text" id="sellBrand" class="form-control" required placeholder="Contoh: Ferrari, Porsche, Rolls-Royce">
            </div>
            <div class="form-group">
              <label class="form-label">Tipe / Model Mobil *</label>
              <input type="text" id="sellModel" class="form-control" required placeholder="Contoh: 296 GTB / 911 GT3 RS">
            </div>
          </div>

          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label">Tahun Pembuatan *</label>
              <input type="number" id="sellYear" class="form-control" required placeholder="2024" min="1990" max="2027">
            </div>
            <div class="form-group">
              <label class="form-label">Jarak Tempuh / Odometer (km) *</label>
              <input type="number" id="sellMileage" class="form-control" required placeholder="Contoh: 4500">
            </div>
          </div>

          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label">Warna Eksterior *</label>
              <input type="text" id="sellColor" class="form-control" required placeholder="Contoh: Rosso Corsa / Black Sapphire">
            </div>
            <div class="form-group">
              <label class="form-label">Harga Penawaran / Asking Price (IDR) *</label>
              <input type="number" id="sellPrice" class="form-control" required placeholder="Contoh: 12500000000">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Kondisi Fisik & Mesin *</label>
            <select id="sellCondition" class="form-control" style="padding:11px; font-family:inherit; font-size:0.9rem;" required>
              <option value="excellent">Excellent – Seperti Baru (Koleksi / Jarang Pakai / Full Record APM)</option>
              <option value="good">Good – Kondisi Terawat Baik (Pemakaian Normal / Bebas Banjir & Tabrakan)</option>
              <option value="fair">Fair – Butuh Perawatan Minor (Kosmetik Ringan)</option>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Deskripsi Lengkap, Opsi Spesifikasi & Riwayat Perawatan *</label>
            <textarea id="sellDescription" class="form-control" rows="3" required placeholder="Jelaskan opsi pabrikan khusus (Carbon pack, Ceramic Brakes, Exhaust), riwayat servis resmi APM, status pajak STNK, dsb..."></textarea>
          </div>

          <div style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.08em; color:var(--gray-500); font-weight:700; margin-top:28px; margin-bottom:14px; border-bottom:1px solid var(--gray-200); padding-bottom:6px;">
            2. Kontak Pemilik Kendaraan
          </div>

          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label">Nama Pemilik / PIC *</label>
              <input type="text" id="sellOwnerName" class="form-control" required placeholder="Nama lengkap Anda">
            </div>
            <div class="form-group">
              <label class="form-label">Nomor WhatsApp Aktif *</label>
              <input type="tel" id="sellOwnerPhone" class="form-control" required placeholder="0812-xxxx-xxxx">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Alamat Email *</label>
            <input type="email" id="sellOwnerEmail" class="form-control" required placeholder="nama@email.com">
          </div>

          <div style="background:linear-gradient(135deg, #1c1408 0%, #291b0d 100%); color:#fff; padding:18px; border-radius:4px; margin-bottom:24px; font-size:0.83rem; line-height:1.6; border:1px solid rgba(245, 158, 11, 0.3);">
            <strong style="color:#fbbf24; display:block; margin-bottom:4px;">✨ Komitmen Konsinyasi PCS Edition:</strong>
            Unit Anda akan diinspeksi secara menyeluruh dalam 48 jam kerja. Tidak ada biaya di muka (No upfront fees). Biaya jasa konsinyasi dealer sebesar 3% – 5% hanya dipotong saat unit berhasil terjual lunas ke pembeli.
          </div>

          <button type="submit" class="btn-gold" style="width:100%; padding:14px; font-size:0.95rem; font-weight:600;">
            Kirim Pengajuan Titip Jual &rarr;
          </button>
        </form>
      </div>

      <!-- Right Column: Process & Contact -->
      <div>
        <div class="sell-card-box" style="margin-bottom:24px;">
          <h4 style="font-family:var(--font-serif); font-size:1.15rem; margin-bottom:18px;">Alur Konsinyasi PCS Edition</h4>
          
          <div class="timeline-step">
            <div class="timeline-circle">1</div>
            <div>
              <div style="font-weight:600; font-size:0.88rem; margin-bottom:2px;">Registrasi Online</div>
              <div style="font-size:0.78rem; color:var(--gray-500); line-height:1.5;">Kirim detail mobil Anda melalui formulir di halaman ini.</div>
            </div>
          </div>

          <div class="timeline-step">
            <div class="timeline-circle">2</div>
            <div>
              <div style="font-weight:600; font-size:0.88rem; margin-bottom:2px;">Inspeksi 150 Titik</div>
              <div style="font-size:0.78rem; color:var(--gray-500); line-height:1.5;">Kurator kami memeriksa fisik mesin, cat, ECU scanner, dan surat kepemilikan.</div>
            </div>
          </div>

          <div class="timeline-step">
            <div class="timeline-circle">3</div>
            <div>
              <div style="font-weight:600; font-size:0.88rem; margin-bottom:2px;">Studio Photoshoot & Showcase</div>
              <div style="font-size:0.78rem; color:var(--gray-500); line-height:1.5;">Mobil difoto di studio profesional dan dipajang di showroom SCBD serta katalog online.</div>
            </div>
          </div>

          <div class="timeline-step">
            <div class="timeline-circle">4</div>
            <div>
              <div style="font-weight:600; font-size:0.88rem; margin-bottom:2px;">Deal & Pencairan Dana Aman</div>
              <div style="font-size:0.78rem; color:var(--gray-500); line-height:1.5;">Transaksi difasilitasi escrow perbankan resmi tanpa resiko pembayaran bodong.</div>
            </div>
          </div>
        </div>

        <!-- Direct Concierge Help Box -->
        <div class="sell-card-box" style="background:var(--gray-100); text-align:center;">
          <h4 style="font-family:var(--font-serif); font-size:1.1rem; margin-bottom:6px;">Konsultasi Penaksiran Nilai Pasar</h4>
          <p style="font-size:0.82rem; color:var(--gray-500); margin-bottom:16px;">
            Ingin estimasi valuasi pasar instan untuk supercar Anda? Hubungi Luxury Consignment Specialist kami.
          </p>
          <a href="https://wa.me/6281299887766?text=Halo%20PCS%20Edition,%20saya%20ingin%20konsultasi%20titip%20jual%20mobil%20saya" target="_blank" class="btn-login" style="width:100%; justify-content:center; padding:12px; font-weight:600; background:var(--white);">
            💬 Chat Consignment Specialist
          </a>
        </div>
      </div>

    </div>
  </main>

  <!-- Login Modal -->
  <div class="modal-overlay" id="loginModal">
    <div class="modal-container" style="max-width:400px;">
      <div class="modal-header">
        <h3 class="modal-title">Sign In to PCS Edition</h3>
        <button class="modal-close" onclick="closeModal('loginModal')">&times;</button>
      </div>
      <div class="modal-body">
        <form id="loginForm">
          <div class="form-group">
            <label class="form-label">Email Address</label>
            <input type="email" id="loginEmail" class="form-control" required placeholder="name@example.com">
          </div>
          <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" id="loginPassword" class="form-control" required placeholder="••••••••">
          </div>
          <button type="submit" class="btn-gold" style="width:100%; margin-top:8px;">Sign In &rarr;</button>
          <div style="margin-top:16px; font-size:0.8rem; color:var(--gray-500); text-align:center;">
            Customer Demo: <a href="javascript:void(0)" onclick="demoLoginCustomer()" style="color:var(--black); text-decoration:underline;">Budi Santoso</a>
          </div>
        </form>
      </div>
    </div>
  </div>

    <!-- My Bookings Modal (Customer Riwayat & Aktivitas) -->
  <div class="modal-overlay" id="myBookingsModal">
    <div class="modal-container" style="max-width:700px;">
      <div class="modal-header">
        <h3 class="modal-title">Riwayat & Aktivitas Saya</h3>
        <button class="modal-close" onclick="closeModal('myBookingsModal')">&times;</button>
      </div>
      <div class="my-bookings-tabbar">
        <button class="my-tab-btn active" id="myTabBtn-service" onclick="switchMyBookingsTab('service')">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
          Servis <span class="tab-badge" id="tabBadgeService">0</span>
        </button>
        <button class="my-tab-btn" id="myTabBtn-testdrive" onclick="switchMyBookingsTab('testdrive')">
          Test Drive <span class="tab-badge" id="tabBadgeTestDrive">0</span>
        </button>
        <button class="my-tab-btn" id="myTabBtn-sell" onclick="switchMyBookingsTab('sell')">
          Titip Jual <span class="tab-badge" id="tabBadgeSell">0</span>
        </button>
        <button class="my-tab-btn" id="myTabBtn-contact" onclick="switchMyBookingsTab('contact')">
          Pesan <span class="tab-badge" id="tabBadgeContact">0</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="myBookingsTopAction" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; flex-wrap:wrap; gap:8px;"></div>
        <div id="myBookingsContent"></div>
      </div>
    </div>
  </div>
  </div>

  <!-- Toast Notification -->
  <div id="customToast">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2">
      <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
      <polyline points="22 4 12 14.01 9 11.01"></polyline>
    </svg>
    <span id="customToastMessage">Notification message here</span>
  </div>

  <script src="assets/js/app.js?v=<?php echo time(); ?>"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Pre-fill user data if logged in
      const user = getLoggedInUser();
      if (user) {
        const cleanName = (user.nama || '').replace(/\s*\([^)]*\)/g, '').trim();
        const nameField = document.getElementById('sellOwnerName');
        const emailField = document.getElementById('sellOwnerEmail');
        const phoneField = document.getElementById('sellOwnerPhone');
        if (nameField && !nameField.value) nameField.value = cleanName;
        if (emailField && !emailField.value) emailField.value = user.email || '';
        if (phoneField && !phoneField.value) phoneField.value = user.phone || user.no_telepon || '081299887766';
      }
    });
  </script>
</body>
</html>
