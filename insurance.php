<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Insurance Application | PCS Edition</title>
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
    .ins-hero-banner {
      background: linear-gradient(135deg, #091e1d 0%, #113a38 100%);
      color: var(--white);
      padding: 48px 32px;
      border-radius: 8px;
      margin-bottom: 36px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 24px;
      border: 1px solid rgba(13, 148, 136, 0.3);
    }
    .ins-hero-text h2 {
      font-family: var(--font-serif);
      font-size: 2rem;
      font-weight: 500;
      margin-bottom: 8px;
      color: var(--white);
    }
    .ins-hero-text p {
      font-size: 0.95rem;
      color: #99f6e4;
      max-width: 620px;
      line-height: 1.6;
    }
    .ins-badge-pill {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(13, 148, 136, 0.2);
      color: #2dd4bf;
      padding: 6px 14px;
      border-radius: 100px;
      font-size: 0.8rem;
      font-weight: 600;
      margin-bottom: 12px;
      border: 1px solid rgba(45, 212, 191, 0.4);
    }
    .ins-grid-layout {
      display: grid;
      grid-template-columns: 1fr 380px;
      gap: 36px;
      margin-bottom: 60px;
    }
    @media (max-width: 992px) {
      .ins-grid-layout {
        grid-template-columns: 1fr;
      }
    }
    .ins-card-box {
      background: var(--white);
      border: 1px solid var(--gray-200);
      padding: 32px;
      border-radius: 6px;
    }
    .ins-feature-item {
      display: flex;
      gap: 14px;
      padding: 16px 0;
      border-bottom: 1px solid var(--gray-100);
    }
    .ins-feature-item:last-child {
      border-bottom: none;
    }
    .ins-feature-icon {
      width: 40px;
      height: 40px;
      border-radius: 6px;
      background: rgba(13, 148, 136, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }
    .ins-feature-icon svg {
      width: 20px;
      height: 20px;
      stroke: #0d9488;
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
      <a class="sidebar-nav-item highlight" href="insurance.php">
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
          <a href="service.php" class="desktop-nav-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
            Service
          </a>
          <a href="insurance.php" class="desktop-nav-link active">
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
      <a href="index.php" style="color:inherit; text-decoration:none;">Home</a> &nbsp;/&nbsp; Insurance Application
    </div>
    <h1 class="page-title" style="margin-top: 8px;">Proteksi Komprehensif Supercar</h1>
    <p style="color: var(--gray-500); font-size: 0.95rem; margin-top: 6px;">
      Skema asuransi All-Risk & TLO bersertifikasi dengan jaringan bengkel APM resmi Ferrari, Lamborghini, Rolls-Royce, dan Porsche.
    </p>
  </div>

  <!-- Main Content Container -->
  <main class="container" style="max-width: var(--container-max); margin: 0 auto; padding: 0 24px 60px;">

    <!-- Hero Banner -->
    <div class="ins-hero-banner">
      <div class="ins-hero-text">
        <div class="ins-badge-pill">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
          Underwriter Kemitraan APM Resmi
        </div>
        <h2>Lindungi Aset Supercar Anda Tanpa Kekhawatiran</h2>
        <p>
          Penggantian parts 100% original OEM baru dari pabrikan, klaim dedicated concierge tanpa antre, dan proteksi risiko khusus hidrometeorologi & kerusuhan.
        </p>
      </div>
      <div>
        <button type="button" onclick="document.getElementById('insVehicleSelect').focus()" class="btn-gold" style="padding: 14px 28px; font-size: 0.9rem;">
          Hitung Estimasi Premi &darr;
        </button>
      </div>
    </div>

    <!-- 2-Column Grid: Wizard + Info Sidebar -->
    <div class="ins-grid-layout">
      
      <!-- Left Column: 3-Step Wizard Box -->
      <div class="ins-card-box">
        <!-- Step Indicator -->
        <div class="insurance-step-indicator" style="margin-bottom:28px;">
          <div class="insurance-step">
            <div class="insurance-step-num active" id="insStep1Num">1</div>
            <div class="insurance-step-label active" id="insStep1Label">Pilih Mobil</div>
          </div>
          <div class="insurance-step-line" id="insLine1"></div>
          <div class="insurance-step">
            <div class="insurance-step-num" id="insStep2Num">2</div>
            <div class="insurance-step-label" id="insStep2Label">Paket Proteksi</div>
          </div>
          <div class="insurance-step-line" id="insLine2"></div>
          <div class="insurance-step">
            <div class="insurance-step-num" id="insStep3Num">3</div>
            <div class="insurance-step-label" id="insStep3Label">Data Pemohon</div>
          </div>
        </div>

        <!-- Step 1: Vehicle Selection -->
        <div id="insStepContent1">
          <div style="text-align:center; margin-bottom:24px;">
            <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#0d9488" stroke-width="1.5" style="margin-bottom:8px;"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
            <h4 style="font-family:var(--font-serif); font-size:1.25rem; margin-bottom:4px;">Tentukan Unit yang Ingin Diproteksi</h4>
            <p style="font-size:0.85rem; color:var(--gray-500);">Premi dihitung proporsional terhadap nilai pasar OTR kendaraan</p>
          </div>
          <div class="form-group">
            <label class="form-label">Pilih Kendaraan Supercar *</label>
            <select id="insVehicleSelect" class="form-control" onchange="updateInsurancePremium()" style="padding:12px; font-family:inherit; font-size:0.92rem;"></select>
          </div>
          <div class="form-group">
            <label class="form-label">Nilai Pertanggungan OTR Kendaraan</label>
            <div id="insVehicleValue" style="padding:12px 16px; background:var(--gray-100); border:1px solid var(--gray-200); border-radius:4px; font-family:var(--font-serif); font-size:1.2rem; font-weight:600; color:var(--black);">-</div>
          </div>
          <div style="display:flex; gap:12px; margin-top:28px;">
            <button class="btn-gold" style="width:100%; padding:14px; font-size:0.95rem;" onclick="insuranceNextStep(2)">Lanjut: Tentukan Paket Coverage &rarr;</button>
          </div>
        </div>

        <!-- Step 2: Coverage Selection -->
        <div id="insStepContent2" style="display:none;">
          <h4 style="font-family:var(--font-serif); font-size:1.15rem; margin-bottom:16px;">Pilih Jenis Polis Perlindungan</h4>
          <div class="coverage-cards" style="margin-bottom:24px;">
            <div class="coverage-card selected" onclick="selectCoverage(this, 'comprehensive')" data-type="comprehensive" style="cursor:pointer;">
              <div class="coverage-card-check">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
              </div>
              <div class="coverage-card-title" style="font-weight:600; margin-bottom:4px;">Comprehensive (All Risk)</div>
              <div class="coverage-card-desc" style="font-size:0.8rem; color:var(--gray-600); line-height:1.5;">Perlindungan total atas lecet, tabrakan, pencurian, kebakaran, hingga bencana alam. Sangat disarankan untuk supercar.</div>
            </div>
            <div class="coverage-card" onclick="selectCoverage(this, 'tlo')" data-type="tlo" style="cursor:pointer; margin-top:12px;">
              <div class="coverage-card-check">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
              </div>
              <div class="coverage-card-title" style="font-weight:600; margin-bottom:4px;">Total Loss Only (TLO)</div>
              <div class="coverage-card-desc" style="font-size:0.8rem; color:var(--gray-600); line-height:1.5;">Pertanggungan kerusakan fatal di atas 75% dari nilai kendaraan atau kehilangan total akibat pencurian.</div>
            </div>
          </div>

          <h4 style="font-family:var(--font-serif); font-size:1.1rem; margin-bottom:12px;">Perluasan Jaminan Tambahan (Add-ons)</h4>
          <div style="display:flex; flex-direction:column; gap:12px; margin-bottom:24px;">
            <label style="display:flex; align-items:center; gap:10px; font-size:0.88rem; cursor:pointer;">
              <input type="checkbox" id="insAddonFlood" onchange="updateInsurancePremium()" style="width:18px; height:18px;"> Banjir, Angin Topan & Bencana Alam (Act of God)
            </label>
            <label style="display:flex; align-items:center; gap:10px; font-size:0.88rem; cursor:pointer;">
              <input type="checkbox" id="insAddonRiot" onchange="updateInsurancePremium()" style="width:18px; height:18px;"> Kerusuhan, Huru-Hara & Terorisme (SRCC)
            </label>
            <label style="display:flex; align-items:center; gap:10px; font-size:0.88rem; cursor:pointer;">
              <input type="checkbox" id="insAddonPassenger" onchange="updateInsurancePremium()" style="width:18px; height:18px;"> Kecelakaan Diri Pengemudi & Penumpang (PA)
            </label>
            <label style="display:flex; align-items:center; gap:10px; font-size:0.88rem; cursor:pointer;">
              <input type="checkbox" id="insAddonTPL" onchange="updateInsurancePremium()" style="width:18px; height:18px;"> Tanggung Jawab Hukum Pihak Ketiga (TPL Rp 100 Juta)
            </label>
          </div>

          <div class="insurance-premium-box" style="background:var(--gray-100); border:1px solid var(--gray-200); padding:20px; border-radius:4px; text-align:center; margin-bottom:24px;">
            <div class="insurance-premium-label" style="font-size:0.8rem; text-transform:uppercase; letter-spacing:0.08em; color:var(--gray-500);">Estimasi Premi Tahunan</div>
            <div class="insurance-premium-amount" id="insPremiumAmount" style="font-family:var(--font-serif); font-size:1.8rem; font-weight:700; color:var(--black); margin:6px 0;">Rp 0</div>
            <div class="insurance-premium-per" style="font-size:0.8rem; color:var(--gray-500);">per tahun (sebelum diskon tenor)</div>
          </div>

          <div style="display:flex; gap:12px;">
            <button class="btn-login" style="flex:1; padding:12px; justify-content:center;" onclick="insuranceNextStep(1)">&larr; Kembali</button>
            <button class="btn-gold" style="flex:1; padding:12px; font-weight:600;" onclick="insuranceNextStep(3)">Lanjut: Data Pemohon &rarr;</button>
          </div>
        </div>

        <!-- Step 3: Personal Details -->
        <div id="insStepContent3" style="display:none;">
          <h4 style="font-family:var(--font-serif); font-size:1.15rem; margin-bottom:16px;">Data Pemohon Polis Asuransi</h4>
          <form id="insuranceForm" onsubmit="submitInsuranceForm(event)">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
              <div class="form-group">
                <label class="form-label">Nama Lengkap Sesuai KTP *</label>
                <input type="text" id="insName" class="form-control" required placeholder="Nama lengkap">
              </div>
              <div class="form-group">
                <label class="form-label">Nomor WhatsApp Aktif *</label>
                <input type="tel" id="insPhone" class="form-control" required placeholder="0812-xxxx-xxxx">
              </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
              <div class="form-group">
                <label class="form-label">Alamat Email *</label>
                <input type="email" id="insEmail" class="form-control" required placeholder="nama@email.com">
              </div>
              <div class="form-group">
                <label class="form-label">Nomor e-KTP (16 Digit) *</label>
                <input type="text" id="insKTP" class="form-control" required placeholder="16 digit NIK" maxlength="16">
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Alamat Domisili Kendaraan Sesuai STNK *</label>
              <textarea id="insAddress" class="form-control" rows="2" required placeholder="Alamat lengkap kota domisili..."></textarea>
            </div>

            <div class="form-group">
              <label class="form-label">Durasi Tenor Polis Pertanggungan</label>
              <select id="insPeriod" class="form-control" onchange="updateInsurancePremium()" style="padding:11px; font-family:inherit; font-size:0.9rem;">
                <option value="1">1 Tahun (Standar)</option>
                <option value="2">2 Tahun (Diskon 5%)</option>
                <option value="3">3 Tahun (Diskon 10% - Best Value)</option>
              </select>
            </div>

            <div class="form-group">
              <label class="form-label">Catatan Tambahan (Opsional)</label>
              <textarea id="insNotes" class="form-control" rows="2" placeholder="Permintaan khusus klausul polis..."></textarea>
            </div>

            <div class="insurance-premium-box" style="background:var(--gray-100); border:1px solid var(--gray-200); padding:20px; border-radius:4px; text-align:center; margin-bottom:24px;">
              <div class="insurance-premium-label" style="font-size:0.8rem; text-transform:uppercase; letter-spacing:0.08em; color:var(--gray-500);">Total Nilai Premi Final</div>
              <div class="insurance-premium-amount" id="insTotalPremium" style="font-family:var(--font-serif); font-size:1.8rem; font-weight:700; color:var(--black); margin:6px 0;">Rp 0</div>
              <div class="insurance-premium-per" id="insTotalPeriod" style="font-size:0.8rem; color:var(--gray-500);">untuk periode 1 tahun</div>
            </div>

            <div style="display:flex; gap:12px;">
              <button type="button" class="btn-login" style="flex:1; padding:12px; justify-content:center;" onclick="insuranceNextStep(2)">&larr; Kembali</button>
              <button type="submit" class="btn-gold" style="flex:1; padding:12px; font-weight:600;">Kirim Pengajuan Polis &rarr;</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Right Column: Standards & Guarantees -->
      <div>
        <div class="ins-card-box" style="margin-bottom:24px;">
          <h4 style="font-family:var(--font-serif); font-size:1.15rem; margin-bottom:16px;">Keunggulan Asuransi Supercar PCS</h4>
          
          <div class="ins-feature-item">
            <div class="ins-feature-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
            </div>
            <div>
              <div style="font-weight:600; font-size:0.88rem; margin-bottom:2px;">Bengkel Resmi APM Authorized</div>
              <div style="font-size:0.78rem; color:var(--gray-500); line-height:1.5;">Pengerjaan perbaikan langsung di bengkel resmi prinsipal tanpa mengurangi masa garansi pabrik.</div>
            </div>
          </div>

          <div class="ins-feature-item">
            <div class="ins-feature-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div>
              <div style="font-weight:600; font-size:0.88rem; margin-bottom:2px;">Garansi Spareparts OEM 100%</div>
              <div style="font-size:0.78rem; color:var(--gray-500); line-height:1.5;">Klausul New for Old tanpa pemotongan depresiasi suku cadang selama masa perlindungan.</div>
            </div>
          </div>

          <div class="ins-feature-item">
            <div class="ins-feature-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
            </div>
            <div>
              <div style="font-weight:600; font-size:0.88rem; margin-bottom:2px;">Single Flatbed Towing 24 Jam</div>
              <div style="font-size:0.78rem; color:var(--gray-500); line-height:1.5;">Evakuasi hidrolik rendah ground-clearance khusus supercar di seluruh Indonesia.</div>
            </div>
          </div>
        </div>

        <!-- Direct Concierge Help Box -->
        <div class="ins-card-box" style="background:var(--gray-100); text-align:center;">
          <h4 style="font-family:var(--font-serif); font-size:1.1rem; margin-bottom:6px;">Konsultasi Underwriter Ahli</h4>
          <p style="font-size:0.82rem; color:var(--gray-500); margin-bottom:16px;">
            Memiliki unit langka hypercar (Bugatti, Pagani, Koenigsegg)? Hubungi Senior Underwriter kami.
          </p>
          <a href="https://wa.me/6281299887766?text=Halo%20PCS%20Edition,%20saya%20ingin%20konsultasi%20asuransi%20supercar" target="_blank" class="btn-login" style="width:100%; justify-content:center; padding:12px; font-weight:600; background:var(--white);">
            💬 Chat Underwriter via WhatsApp
          </a>
        </div>
      </div>

    </div>
  </main>

  <!-- Insurance Application Confirmation / Dossier Modal -->
  <div class="modal-overlay" id="insuranceSuccessModal">
    <div class="modal-container" style="max-width:620px;">
      <div class="modal-header">
        <h3 class="modal-title">Insurance Dossier Confirmation</h3>
        <button class="modal-close" onclick="closeModal('insuranceSuccessModal')">&times;</button>
      </div>
      <div class="modal-body" id="insuranceSuccessModalContent">
        <!-- Rendered via JavaScript -->
      </div>
    </div>
  </div>

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
      // 1. Populate vehicle dropdown
      const select = document.getElementById('insVehicleSelect');
      const urlParams = new URLSearchParams(window.location.search);
      const preselectedCarId = urlParams.get('car_id');

      function populateSelect() {
        if (select && Array.isArray(currentCars) && currentCars.length > 0) {
          select.innerHTML = currentCars.map(c =>
            `<option value="${c.id}" ${preselectedCarId && String(c.id) === String(preselectedCarId) ? 'selected' : ''}>${c.brand} ${c.model} (${c.tahun})</option>`
          ).join('');
          updateInsurancePremium();
        }
      }

      populateSelect();
      setTimeout(populateSelect, 400);

      // 2. Pre-fill user data if logged in
      const user = getLoggedInUser();
      if (user) {
        const cleanName = (user.nama || '').replace(/\s*\([^)]*\)/g, '').trim();
        const nameField = document.getElementById('insName');
        const emailField = document.getElementById('insEmail');
        const phoneField = document.getElementById('insPhone');
        if (nameField && !nameField.value) nameField.value = cleanName;
        if (emailField && !emailField.value) emailField.value = user.email || '';
        if (phoneField && !phoneField.value) phoneField.value = user.phone || user.no_telepon || '081299887766';
      }
    });
  </script>
</body>
</html>
