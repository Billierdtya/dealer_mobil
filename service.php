<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Service & Maintenance | PCS Edition</title>
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
    .service-hero-banner {
      background: linear-gradient(135deg, #111111 0%, #1f1f1f 100%);
      color: var(--white);
      padding: 50px 24px;
      border-radius: 8px;
      margin-bottom: 36px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 24px;
    }
    .service-hero-text h2 {
      font-family: var(--font-serif);
      font-size: 2rem;
      font-weight: 500;
      margin-bottom: 8px;
      color: var(--white);
    }
    .service-hero-text p {
      font-size: 0.95rem;
      color: var(--gray-400);
      max-width: 600px;
      line-height: 1.6;
    }
    .service-badge-pill {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(217, 119, 6, 0.15);
      color: #f59e0b;
      padding: 6px 14px;
      border-radius: 100px;
      font-size: 0.8rem;
      font-weight: 600;
      margin-bottom: 12px;
      border: 1px solid rgba(217, 119, 6, 0.3);
    }
    .service-grid-layout {
      display: grid;
      grid-template-columns: 1fr 380px;
      gap: 36px;
      margin-bottom: 60px;
    }
    @media (max-width: 992px) {
      .service-grid-layout {
        grid-template-columns: 1fr;
      }
    }
    .service-card-box {
      background: var(--white);
      border: 1px solid var(--gray-200);
      padding: 32px;
      border-radius: 6px;
    }
    .service-feature-item {
      display: flex;
      gap: 14px;
      padding: 16px 0;
      border-bottom: 1px solid var(--gray-100);
    }
    .service-feature-item:last-child {
      border-bottom: none;
    }
    .service-feature-icon {
      width: 40px;
      height: 40px;
      border-radius: 6px;
      background: var(--gray-100);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }
    .service-feature-icon svg {
      width: 20px;
      height: 20px;
      stroke: var(--black);
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
      <a class="sidebar-nav-item highlight" href="service.php">
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
      <a class="sidebar-nav-item" href="sell.php">
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
          <a href="service.php" class="desktop-nav-link active">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
            Service
          </a>
          <a href="insurance.php" class="desktop-nav-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
            Insurance
          </a>
          <a href="sell.php" class="desktop-nav-link">
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
          <button id="navMyBookingsBtn" onclick="openMyBookingsModal('service')" class="btn-login" style="display:none; font-size:0.75rem; padding:6px 12px;">Aktivitas Saya</button>
          <button class="btn-login" onclick="userLogout()" style="font-size:0.75rem; padding:6px 12px;">Logout</button>
        </div>
      </div>
    </nav>
  </div>

  <!-- Page Header -->
  <div class="page-header container" style="padding-top: 36px; padding-bottom: 24px;">
    <div class="page-breadcrumbs">
      <a href="index.php" style="color:inherit; text-decoration:none;">Home</a> &nbsp;/&nbsp; Service & Maintenance
    </div>
    <h1 class="page-title" style="margin-top: 8px;">Bengkel Resmi Supercar & Luxury</h1>
    <p style="color: var(--gray-500); font-size: 0.95rem; margin-top: 6px;">
      Layanan perawatan berkala, ganti oli performa tinggi, dan servis rem bersertifikasi pabrikan resmi APM.
    </p>
  </div>

  <!-- Main Content Container -->
  <main class="container" style="max-width: var(--container-max); margin: 0 auto; padding: 0 24px 60px;">

    <!-- Hero Banner -->
    <div class="service-hero-banner">
      <div class="service-hero-text">
        <div class="service-badge-pill">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
          APM Certified Master Technicians
        </div>
        <h2>Perawatan Standar Pabrikan Tanpa Kompromi</h2>
        <p>
          Setiap kendaraan ditangani langsung oleh teknisi bersertifikasi dengan alat diagnostik komputer resmi Ferrari, Lamborghini, Porsche, dan Rolls-Royce.
        </p>
      </div>
      <div>
        <button type="button" onclick="document.getElementById('custSrvName').focus()" class="btn-gold" style="padding: 14px 28px; font-size: 0.9rem;">
          Isi Formulir Booking &darr;
        </button>
      </div>
    </div>

    <!-- 2-Column Grid: Form + Info Sidebar -->
    <div class="service-grid-layout">
      
      <!-- Left Column: Booking Form -->
      <div class="service-card-box">
        <h3 style="font-family:var(--font-serif); font-size:1.4rem; margin-bottom:6px;">Formulir Reservasi Servis</h3>
        <p style="font-size:0.85rem; color:var(--gray-500); margin-bottom:24px;">
          Pilih paket servis yang Anda butuhkan. Biaya di bawah transparan mencakup estimasi jasa teknisi dan parts OEM.
        </p>

        <form id="customerServiceForm" onsubmit="submitCustomerServiceBooking(event)">
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label">Nama Pemilik Kendaraan *</label>
              <input type="text" id="custSrvName" class="form-control" required placeholder="Nama lengkap Anda">
            </div>
            <div class="form-group">
              <label class="form-label">Nomor WhatsApp *</label>
              <input type="text" id="custSrvPhone" class="form-control" required placeholder="0812-xxxx-xxxx">
            </div>
          </div>

          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label">Model Kendaraan *</label>
              <input type="text" id="custSrvCarModel" class="form-control" required placeholder="Contoh: Ferrari Roma / Porsche 911">
            </div>
            <div class="form-group">
              <label class="form-label">Nomor Polisi (Plat Nomor) *</label>
              <input type="text" id="custSrvNopol" class="form-control" required placeholder="B 1234 PCS" style="text-transform:uppercase;">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Pilih Paket Layanan Servis *</label>
            <select id="custSrvType" class="form-control" onchange="updateServiceEstimatePreview()" style="padding:12px; font-family:inherit; font-size:0.92rem;" required>
              <option value="ganti_oli">Ganti Oli Mesin Performa Tinggi (Motul 300V / Castrol Edge Supercar + Filter OEM)</option>
              <option value="tune_up">Tune Up Komprehensif (Busi Racing Iridium, Throttle & Injector Clean, Sensor ECU)</option>
              <option value="servis_umum">Servis Umum & General Inspection 150 Titik (Suspensi, Radiator, Transmisi)</option>
              <option value="perbaikan_rem">Perbaikan Rem (Brembo Brake Pad + Minyak Rem Dot 5.1 Racing)</option>
              <option value="servis_ac">Servis AC & Evaporator Ultrasonic + Flushing Freon</option>
              <option value="kelistrikan">Diagnostik Kelistrikan & Reset Modul ECU Scanner APM</option>
              <option value="lainnya">Servis Khusus / Konsultasi Kendala Spesifik</option>
            </select>
          </div>

          <!-- Dynamic Transparent Cost Estimate Preview Box -->
          <div id="custSrvEstimateBox" style="background:var(--gray-100); padding:18px; border:1px solid var(--gray-200); border-radius:4px; margin-bottom:20px;"></div>

          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label">Tanggal Kedatangan *</label>
              <input type="date" id="custSrvDate" class="form-control" required style="padding:10px;">
            </div>
            <div class="form-group">
              <label class="form-label">Pilihan Slot Waktu *</label>
              <select id="custSrvTime" class="form-control" style="padding:11px; font-family:inherit; font-size:0.9rem;">
                <option value="09:00 WIB">Pagi: 09:00 WIB (Stall Prioritas)</option>
                <option value="10:30 WIB">Pagi: 10:30 WIB</option>
                <option value="13:30 WIB">Siang: 13:30 WIB</option>
                <option value="15:00 WIB">Sore: 15:00 WIB</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Email Konfirmasi E-Receipt</label>
            <input type="email" id="custSrvEmail" class="form-control" placeholder="nama@email.com">
          </div>

          <div class="form-group">
            <label class="form-label">Keluhan atau Catatan Tambahan</label>
            <textarea id="custSrvNotes" class="form-control" rows="3" placeholder="Jelaskan kendala, suara, atau permintaan khusus yang dirasakan saat mengemudi..."></textarea>
          </div>

          <button type="submit" class="btn-gold" style="width:100%; padding:14px; font-size:0.95rem; font-weight:600;">
            Konfirmasi Booking Servis Sekarang &rarr;
          </button>
        </form>
      </div>

      <!-- Right Column: Standards & Guarantees -->
      <div>
        <div class="service-card-box" style="margin-bottom:24px;">
          <h4 style="font-family:var(--font-serif); font-size:1.15rem; margin-bottom:16px;">Standar Bengkel PCS Edition</h4>
          
          <div class="service-feature-item">
            <div class="service-feature-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
            </div>
            <div>
              <div style="font-weight:600; font-size:0.88rem; margin-bottom:2px;">100% Genuine OEM Parts</div>
              <div style="font-size:0.78rem; color:var(--gray-500); line-height:1.5;">Seluruh suku cadang diimpor resmi dengan garansi keaslian dari APM.</div>
            </div>
          </div>

          <div class="service-feature-item">
            <div class="service-feature-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            </div>
            <div>
              <div style="font-weight:600; font-size:0.88rem; margin-bottom:2px;">Same-Day Routine Service</div>
              <div style="font-size:0.78rem; color:var(--gray-500); line-height:1.5;">Layanan ganti oli & tune-up selesai dalam 2-3 jam di ruang tunggu VIP.</div>
            </div>
          </div>

          <div class="service-feature-item">
            <div class="service-feature-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
            </div>
            <div>
              <div style="font-weight:600; font-size:0.88rem; margin-bottom:2px;">Towing Antar-Jemput Gratis</div>
              <div style="font-size:0.78rem; color:var(--gray-500); line-height:1.5;">Single towing tertutup khusus area Jabodetabek untuk pelanggan VIP.</div>
            </div>
          </div>
        </div>

        <!-- Direct Concierge Help Box -->
        <div class="service-card-box" style="background:var(--gray-100); text-align:center;">
          <h4 style="font-family:var(--font-serif); font-size:1.1rem; margin-bottom:6px;">Butuh Bantuan Mendesak?</h4>
          <p style="font-size:0.82rem; color:var(--gray-500); margin-bottom:16px;">
            Hubungi Service Advisor kami via WhatsApp untuk konsultasi teknis darurat atau towing 24 jam.
          </p>
          <a href="https://wa.me/6281299887766?text=Halo%20PCS%20Edition,%20saya%20ingin%20konsultasi%20servis%20mobil%20saya" target="_blank" class="btn-login" style="width:100%; justify-content:center; padding:12px; font-weight:600; background:var(--white);">
            💬 Chat Service Advisor WhatsApp
          </a>
        </div>
      </div>

    </div>
  </main>

  <!-- Service Success Receipt Modal -->
  <div class="modal-overlay" id="serviceSuccessModal">
    <div class="modal-container" style="max-width:460px;">
      <div class="modal-header">
        <h3 class="modal-title">Booking Servis Terkonfirmasi</h3>
        <button class="modal-close" onclick="closeModal('serviceSuccessModal')">&times;</button>
      </div>
      <div class="modal-body">
        <div style="text-align:center; padding:16px 0 24px;">
          <div style="width:56px; height:56px; background:#ecfdf5; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
          </div>
          <h4 style="font-family:var(--font-serif); font-size:1.3rem; margin-bottom:4px;">Reservasi Berhasil Didaftarkan</h4>
          <p style="font-size:0.83rem; color:var(--gray-500);">Tim service advisor kami akan menyiapkan stall pengerjaan.</p>
        </div>

        <div style="background:var(--gray-100); border:1px solid var(--gray-200); padding:16px; margin-bottom:20px; font-size:0.85rem; line-height:1.8;">
          <div style="display:flex; justify-content:space-between;"><span style="color:var(--gray-500);">Kode Booking</span><strong id="srvReceiptCode">-</strong></div>
          <div style="display:flex; justify-content:space-between;"><span style="color:var(--gray-500);">Kendaraan</span><strong id="srvReceiptCar">-</strong></div>
          <div style="display:flex; justify-content:space-between;"><span style="color:var(--gray-500);">Paket Servis</span><strong id="srvReceiptType">-</strong></div>
          <div style="display:flex; justify-content:space-between;"><span style="color:var(--gray-500);">Jadwal</span><strong id="srvReceiptSchedule">-</strong></div>
          <div style="display:flex; justify-content:space-between; border-top:1px dashed var(--gray-300); margin-top:8px; padding-top:8px;"><span style="color:var(--gray-500);">Estimasi Total</span><strong style="color:var(--black); font-size:1.05rem;" id="srvReceiptCost">Rp 0</strong></div>
        </div>

        <div style="display:flex; gap:10px;">
          <button class="btn-outline" style="flex:1;" onclick="closeModal('serviceSuccessModal'); openMyBookingsModal('service');">Lihat Status Servis</button>
          <button class="btn-login" style="flex:1; background:var(--black); color:var(--white);" onclick="closeModal('serviceSuccessModal'); window.location.href='index.php';">Selesai</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Shared Customer Modals (Login, My Bookings, etc.) -->
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
      // Set min date to today
      const dateField = document.getElementById('custSrvDate');
      if (dateField) {
        const today = new Date().toISOString().split('T')[0];
        dateField.min = today;
        if (!dateField.value) dateField.value = today;
      }
      // Pre-fill user data if logged in
      const user = getLoggedInUser();
      if (user) {
        const cleanName = (user.nama || '').replace(/\s*\([^)]*\)/g, '').trim();
        const nameField = document.getElementById('custSrvName');
        const emailField = document.getElementById('custSrvEmail');
        const phoneField = document.getElementById('custSrvPhone');
        if (nameField && !nameField.value) nameField.value = cleanName;
        if (emailField && !emailField.value) emailField.value = user.email || '';
        if (phoneField && !phoneField.value) phoneField.value = user.phone || user.no_telepon || '081299887766';
      }
      updateServiceEstimatePreview();
    });
  </script>
</body>
</html>

