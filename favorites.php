<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Saved Vehicles | PCS Edition</title>
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
    .fav-empty {
      text-align: center;
      padding: 100px 24px 80px;
      max-width: 400px;
      margin: 0 auto;
    }
    .fav-empty h2 {
      font-family: var(--font-serif);
      font-size: 1.6rem;
      font-weight: 500;
      margin-bottom: 12px;
      color: var(--black);
    }
    .fav-empty p {
      font-size: 0.9rem;
      color: var(--gray-500);
      line-height: 1.7;
      margin-bottom: 36px;
    }
    .fav-empty-btn {
      display: inline-block;
      background: var(--black);
      color: var(--white);
      padding: 12px 32px;
      font-size: 0.88rem;
      font-weight: 500;
      font-family: inherit;
      text-decoration: none;
      transition: background 0.2s ease;
    }
    .fav-empty-btn:hover {
      background: var(--gray-800);
    }
    .fav-actions-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 24px 20px;
      max-width: var(--container-max);
      margin: 0 auto;
    }
    .fav-actions-bar span {
      font-size: 0.85rem;
      color: var(--gray-500);
    }
    .fav-clear-btn {
      font-size: 0.82rem;
      color: var(--gray-500);
      background: none;
      border: none;
      cursor: pointer;
      font-family: inherit;
      padding: 4px 0;
      transition: color 0.2s;
    }
    .fav-clear-btn:hover {
      color: var(--black);
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
      <a class="sidebar-nav-item highlight" href="favorites.php">
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
      <a class="sidebar-nav-item" href="dashboard.php" onclick="toggleSidebar();">
        <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
        Portal Manajemen Dealer
      </a>
    </nav>
    <div class="sidebar-footer">
      &copy; 2026 PT Pencari Cinta Sejati
    </div>
  </aside>

  <!-- Header -->
  <div class="header-wrapper">
    <nav class="navbar">
      <div class="navbar-left">
        <div class="menu-icon mobile-only">
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
          <a href="favorites.php" class="desktop-nav-link active">
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
        <button class="btn-login" id="navBtnLogin" onclick="openModal('loginModal')">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
          </svg>
          <span class="btn-login-text">Log In / Demo</span>
        </button>
        <div id="navUserLoggedIn" style="display:none; align-items:center; gap:8px;">
          <span style="font-size:0.83rem; font-weight:600; color:var(--black);" id="navUserName"></span>
          <a href="dashboard.php" id="navPortalLink" class="btn-login" style="display:none; font-size:0.75rem; padding:6px 12px; background:var(--black); color:var(--white); text-decoration:none;">Portal Manajemen</a>
          <button id="navMyBookingsBtn" onclick="openMyBookingsModal()" class="btn-login" style="display:none; font-size:0.75rem; padding:6px 12px;">Aktivitas Saya</button>
          <button class="btn-login" onclick="userLogout()" style="font-size:0.75rem; padding:6px 12px;">Logout</button>
        </div>
      </div>
    </nav>
  </div>


  <!-- Page Header -->
  <div class="page-header container">
    <div class="page-breadcrumbs"><a href="index.php" style="color:inherit; text-decoration:none;">Home</a> &nbsp;/&nbsp; <a href="cars.php" style="color:inherit; text-decoration:none;">Cars</a> &nbsp;/&nbsp; Saved</div>
    <h1 class="page-title">Saved Vehicles</h1>
  </div>

  <!-- Actions Bar -->
  <div class="fav-actions-bar" id="favActionsBar" style="display:none;">
    <span id="favCountText">0 vehicles</span>
    <button class="fav-clear-btn" onclick="clearAllFavorites()">Clear all</button>
  </div>

  <!-- Favorites Grid -->
  <section class="catalog-section container">
    <div class="catalog-grid" id="favoritesGrid"></div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-grid">
      <div>
        <h4 class="footer-title">PCS Edition</h4>
        <ul class="footer-links">
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
          <li><a href="#">Terms of use</a></li>
          <li><a href="#">Privacy policy</a></li>
        </ul>
      </div>
      <div>
        <h4 class="footer-title">Categories</h4>
        <ul class="footer-links">
          <li><a href="cars.php">Cars</a></li>
          <li><a href="#">Yachts</a></li>
          <li><a href="#">Jets</a></li>
          <li><a href="#">Watches</a></li>
        </ul>
      </div>
      <div>
        <h4 class="footer-title">For Sellers</h4>
        <ul class="footer-links">
          <li><a href="#">Sell with us</a></li>
          <li><a href="#">Agent Resources</a></li>
        </ul>
      </div>
      <div>
        <h4 class="footer-title">Follow us</h4>
        <ul class="footer-links">
          <li><a href="#">Instagram</a></li>
          <li><a href="#">Facebook</a></li>
          <li><a href="#">Twitter</a></li>
          <li><a href="#">LinkedIn</a></li>
        </ul>
      </div>
    </div>
    <div style="text-align:center; color:var(--gray-500); font-size:0.85rem; border-top:1px solid var(--gray-200); padding-top:24px; max-width:var(--container-max); margin:0 auto;">
      &copy; 2026 PT Pencari Cinta Sejati. The World's Luxury Marketplace.
    </div>
  </footer>

  <!-- Detail Modal -->
  <div class="modal-overlay" id="detailModal">
    <div class="modal-container">
      <div class="modal-header">
        <h3 class="modal-title" id="detailCarTitle">Vehicle Details</h3>
        <button class="modal-close" onclick="closeModal('detailModal')">&times;</button>
      </div>
      <div class="modal-body">
        <img id="detailCarImg" src="" alt="Car Image" style="width:100%; aspect-ratio:3/2; object-fit:cover; margin-bottom:16px; background:var(--gray-200);">
        <div style="font-family:var(--font-serif); font-size:1.5rem; font-weight:600; color:var(--black); margin-bottom:16px;" id="detailCarPrice">$0</div>
        <p id="detailCarSpecs" style="font-size:0.9rem; color:var(--black); margin-bottom:16px;"></p>
        <p id="detailCarDesc" style="font-size:0.85rem; color:var(--gray-600); margin-bottom:24px; line-height:1.6;"></p>
        <div style="margin-bottom:32px; border-top:1px solid var(--gray-200); padding-top:24px;">
          <h4 style="font-family:var(--font-serif); font-size:1.25rem; margin-bottom:16px;">Finance Calculator</h4>
          <div style="display:flex; flex-direction:column; gap:16px;">
            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label">Down Payment (%)</label>
              <input type="range" id="calcDp" min="10" max="90" step="5" value="20" style="width:100%; margin-top:8px;">
              <div style="display:flex; justify-content:space-between; font-size:0.85rem; color:var(--gray-600); margin-top:4px;">
                <span id="dpValueDisplay">20%</span>
                <span id="dpAmountDisplay">$0</span>
              </div>
            </div>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Term</label>
                <select id="calcTenor" class="form-control" style="padding:10px; font-family:inherit; font-size:0.9rem;">
                  <option value="12">12 Months</option>
                  <option value="24">24 Months</option>
                  <option value="36" selected>36 Months</option>
                  <option value="48">48 Months</option>
                  <option value="60">60 Months</option>
                </select>
              </div>
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Interest Rate</label>
                <div style="padding:10px 0; font-size:0.95rem; font-weight:500;">5.5% (Flat)</div>
              </div>
            </div>
            <div style="background:var(--gray-100); padding:20px; margin-top:8px; border:1px solid var(--gray-200);">
              <div style="font-size:0.8rem; color:var(--gray-600); text-transform:uppercase; letter-spacing:0.05em; margin-bottom:4px;">Estimated Monthly Payment</div>
              <div style="font-family:var(--font-serif); font-size:1.75rem; color:var(--black);" id="calcResult">$0</div>
            </div>
          </div>
        </div>
        <div style="display:flex; gap:10px; flex-wrap:wrap; margin-top:8px;">
          <button type="button" id="detailCarBtnBooking" class="btn-outline-gold" style="flex:1; min-width:110px;">❤️ Simpan</button>
          <button type="button" id="detailCarBtnTestDrive" class="btn-outline-gold" style="flex:1.2; min-width:140px; border-color:#0d9488; color:#0d9488;" onclick="closeModal('detailModal'); openTestDriveModal(currentCalcCar ? currentCalcCar.id : null);">📅 Test Drive</button>
          <button type="button" id="detailCarBtnInsurance" class="btn-outline-gold" style="flex:1.1; min-width:130px; border-color:#b45309; color:#b45309;" onclick="closeModal('detailModal'); openInsuranceModal(currentCalcCar ? currentCalcCar.id : null);">🛡️ Asuransi</button>
          <button type="button" id="detailCarBtnVIP" class="btn-gold" style="flex:1.3; min-width:150px;">💬 Contact Seller</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Login Modal -->
  <div class="modal-overlay" id="loginModal">
    <div class="modal-container" style="max-width:420px;">
      <div class="modal-header">
        <h3 class="modal-title">Welcome Back</h3>
        <button class="modal-close" onclick="closeModal('loginModal')">&times;</button>
      </div>
      <div class="modal-body">
        <div style="text-align:center; margin-bottom:24px;">
          <img src="assets/images/logo_pcs.png" alt="PCS" style="height:64px; margin-bottom:12px; display:block; margin-left:auto; margin-right:auto;">
          <div style="font-family:var(--font-serif); font-size:1.3rem; font-weight:700; color:var(--black); letter-spacing:0.1em; margin-bottom:8px;">PCS<span style="font-weight:400;">EDITION</span></div>
          <p style="font-size:0.85rem; color:var(--gray-600);">Sign in to access your saved vehicles.</p>
        </div>
        <div id="loginAlert" style="display:none; background:#fee2e2; border:1px solid #fca5a5; color:#dc2626; padding:12px; margin-bottom:16px; font-size:0.85rem;"></div>
        <form id="userLoginForm" onsubmit="handleUserLogin(event)">
          <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" id="userLoginEmail" class="form-control" required placeholder="you@example.com">
          </div>
          <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" id="userLoginPassword" class="form-control" required placeholder="Enter your password">
          </div>
          <button type="submit" class="btn btn-gold" style="width:100%;">Sign In</button>
        </form>
        <div style="text-align:center; margin-top:24px; padding-top:24px; border-top:1px solid var(--gray-200);">
          <span style="font-size:0.85rem; color:var(--gray-500);">Don't have an account?</span>
          <a href="#" onclick="closeModal('loginModal'); openModal('signupModal'); return false;" style="font-size:0.85rem; color:var(--black); font-weight:600; margin-left:4px;">Sign Up</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Sign Up Modal -->
  <div class="modal-overlay" id="signupModal">
    <div class="modal-container" style="max-width:420px;">
      <div class="modal-header">
        <h3 class="modal-title">Create Account</h3>
        <button class="modal-close" onclick="closeModal('signupModal')">&times;</button>
      </div>
      <div class="modal-body">
        <div style="text-align:center; margin-bottom:24px;">
          <img src="assets/images/logo_pcs.png" alt="PCS" style="height:64px; margin-bottom:12px; display:block; margin-left:auto; margin-right:auto;">
          <div style="font-family:var(--font-serif); font-size:1.3rem; font-weight:700; color:var(--black); letter-spacing:0.1em; margin-bottom:8px;">PCS<span style="font-weight:400;">EDITION</span></div>
          <p style="font-size:0.85rem; color:var(--gray-600);">Join PCS Edition to explore the world's finest vehicles.</p>
        </div>
        <div id="signupAlert" style="display:none; background:#fee2e2; border:1px solid #fca5a5; color:#dc2626; padding:12px; margin-bottom:16px; font-size:0.85rem;"></div>
        <form id="userSignupForm" onsubmit="handleUserSignup(event)">
          <div class="form-group">
            <label class="form-label">Full Name</label>
            <input type="text" id="signupName" class="form-control" required placeholder="Your full name">
          </div>
          <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" id="signupEmail" class="form-control" required placeholder="you@example.com">
          </div>
          <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" id="signupPassword" class="form-control" required placeholder="Min. 6 characters" minlength="6">
          </div>
          <button type="submit" class="btn btn-gold" style="width:100%;">Create Account</button>
        </form>
        <div style="text-align:center; margin-top:24px; padding-top:24px; border-top:1px solid var(--gray-200);">
          <span style="font-size:0.85rem; color:var(--gray-500);">Already have an account?</span>
          <a href="#" onclick="closeModal('signupModal'); openModal('loginModal'); return false;" style="font-size:0.85rem; color:var(--black); font-weight:600; margin-left:4px;">Sign In</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Contact Seller Modal -->
  <div class="modal-overlay" id="bookingModal">
    <div class="modal-container">
      <div class="modal-header">
        <h3 class="modal-title">Contact Seller</h3>
        <button class="modal-close" onclick="closeModal('bookingModal')">&times;</button>
      </div>
      <div class="modal-body">
        <div id="bookingUserInfo" style="background:var(--gray-100); padding:16px; margin-bottom:20px; border:1px solid var(--gray-200);">
          <div style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.05em; color:var(--gray-500); margin-bottom:8px;">Sending as</div>
          <div style="font-weight:600; color:var(--black);" id="bookingUserDisplay"></div>
        </div>
        <form id="bookingForm" onsubmit="submitContactForm(event)">
          <div class="form-group">
            <label class="form-label">Message</label>
            <textarea id="bookingMessage" class="form-control" rows="4" required>I am interested in this vehicle...</textarea>
          </div>
          <button type="submit" class="btn-gold" style="width:100%;">Send Message</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Toast -->
  <div id="customToast">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
      <polyline points="22 4 12 14.01 9 11.01"></polyline>
    </svg>
    <span id="customToastMessage">Notification message here</span>
  </div>

  <script src="assets/js/app.js?v=<?php echo time(); ?>"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      renderFavoritesPage();
    });

    function renderFavoritesPage() {
      const favs = getFavorites();
      const container = document.getElementById('favoritesGrid');
      const actionsBar = document.getElementById('favActionsBar');
      const countText = document.getElementById('favCountText');

      if (!container) return;

      if (favs.length === 0) {
        if (actionsBar) actionsBar.style.display = 'none';
        container.innerHTML = `
          <div style="grid-column: 1/-1;">
            <div class="fav-empty">
              <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="var(--gray-300)" stroke-width="1"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
              <h2>No saved vehicles</h2>
              <p>Browse our collection and save vehicles you're interested in by tapping the heart icon.</p>
              <a href="cars.php" class="fav-empty-btn">Browse collection</a>
            </div>
          </div>
        `;
        return;
      }

      if (actionsBar) actionsBar.style.display = 'flex';
      if (countText) countText.textContent = favs.length + ' vehicle' + (favs.length > 1 ? 's' : '');

      const favCars = currentCars.filter(c => favs.includes(c.id));

      if (favCars.length === 0) {
        container.innerHTML = `<div style="grid-column:1/-1; text-align:center; padding:60px; color:var(--gray-500);">Loading...</div>`;
        return;
      }

      container.innerHTML = favCars.map(car => {
        const photoCount = Math.floor(Math.random() * 40) + 10;
        return `
        <div class="car-card fade-in" onclick="openDetailModal(${car.id})">
          <div class="car-card-img-wrap">
            <div class="card-badge">Saved</div>
            <button class="card-favorite active" onclick="event.stopPropagation(); removeFavAndRefreshPage(${car.id})">
              <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
            </button>
            <div class="card-photo-count">1/${photoCount}</div>
            <img src="${car.gambar_utama}" alt="${car.brand} ${car.model}" onerror="this.src='https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80'">
          </div>
          <div class="car-card-body">
            <div class="card-price-row">
              <div class="car-price">${formatIDR(car.harga_otr)}</div>
              <button class="card-contact-btn" onclick="event.stopPropagation(); requireLogin(() => openBookingModal(${car.id}))">
                Contact
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
              </button>
            </div>
            <div class="car-title">${car.tahun} ${car.brand} ${car.model}</div>
            <div class="car-location">Jakarta, Indonesia</div>
          </div>
        </div>
      `}).join('');
    }

    function removeFavAndRefreshPage(carId) {
      let favs = getFavorites();
      favs = favs.filter(id => id !== carId);
      localStorage.setItem('pcsFavorites', JSON.stringify(favs));
      renderFavoritesPage();
      showToast('Removed from saved vehicles');
    }

    function clearAllFavorites() {
      if (confirm('Remove all saved vehicles?')) {
        localStorage.setItem('pcsFavorites', JSON.stringify([]));
        renderFavoritesPage();
        showToast('All saved vehicles cleared');
      }
    }
  </script>

  <!-- Insurance Application Modal -->
  <div class="modal-overlay" id="insuranceModal">
    <div class="modal-container" style="max-width:640px;">
      <div class="modal-header">
        <h3 class="modal-title">Insurance Application</h3>
        <button class="modal-close" onclick="closeModal('insuranceModal')">&times;</button>
      </div>
      <div class="modal-body">
        <!-- Step Indicator -->
        <div class="insurance-step-indicator">
          <div class="insurance-step">
            <div class="insurance-step-num active" id="insStep1Num">1</div>
            <div class="insurance-step-label active" id="insStep1Label">Vehicle</div>
          </div>
          <div class="insurance-step-line" id="insLine1"></div>
          <div class="insurance-step">
            <div class="insurance-step-num" id="insStep2Num">2</div>
            <div class="insurance-step-label" id="insStep2Label">Coverage</div>
          </div>
          <div class="insurance-step-line" id="insLine2"></div>
          <div class="insurance-step">
            <div class="insurance-step-num" id="insStep3Num">3</div>
            <div class="insurance-step-label" id="insStep3Label">Details</div>
          </div>
        </div>

        <!-- Step 1: Vehicle Selection -->
        <div id="insStepContent1">
          <div style="text-align:center; margin-bottom:20px;">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#0d9488" stroke-width="1.5" style="margin-bottom:8px;"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
            <h4 style="font-family:var(--font-serif); font-size:1.15rem; margin-bottom:4px;">Protect Your Investment</h4>
            <p style="font-size:0.82rem; color:var(--gray-500);">Comprehensive insurance tailored for luxury & supercars</p>
          </div>
          <div class="form-group">
            <label class="form-label">Select Vehicle</label>
            <select id="insVehicleSelect" class="form-control" onchange="updateInsurancePremium()" style="padding:10px; font-family:inherit; font-size:0.9rem;"></select>
          </div>
          <div class="form-group">
            <label class="form-label">Vehicle Value (OTR Price)</label>
            <div id="insVehicleValue" style="padding:10px 0; font-family:var(--font-serif); font-size:1.1rem; font-weight:600;">-</div>
          </div>
          <div style="display:flex; gap:12px;">
            <button class="btn-gold" style="flex:1;" onclick="insuranceNextStep(2)">Next: Choose Coverage →</button>
          </div>
        </div>

        <!-- Step 2: Coverage Selection -->
        <div id="insStepContent2" style="display:none;">
          <h4 style="font-family:var(--font-serif); font-size:1.05rem; margin-bottom:16px;">Select Coverage Type</h4>
          <div class="coverage-cards">
            <div class="coverage-card selected" onclick="selectCoverage(this, 'comprehensive')" data-type="comprehensive">
              <div class="coverage-card-check">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
              </div>
              <div class="coverage-card-title">Comprehensive (All Risk)</div>
              <div class="coverage-card-desc">Full protection against theft, accident, fire, and natural disasters. Recommended for luxury vehicles.</div>
            </div>
            <div class="coverage-card" onclick="selectCoverage(this, 'tlo')" data-type="tlo">
              <div class="coverage-card-check">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
              </div>
              <div class="coverage-card-title">Total Loss Only (TLO)</div>
              <div class="coverage-card-desc">Covers total loss from theft or damage exceeding 75% of vehicle value.</div>
            </div>
          </div>

          <h4 style="font-family:var(--font-serif); font-size:1.05rem; margin-bottom:12px;">Additional Protection</h4>
          <div style="display:flex; flex-direction:column; gap:10px; margin-bottom:20px;">
            <label style="display:flex; align-items:center; gap:10px; font-size:0.88rem; cursor:pointer;">
              <input type="checkbox" id="insAddonFlood" onchange="updateInsurancePremium()" style="width:16px; height:16px;"> Flood & Typhoon Protection
            </label>
            <label style="display:flex; align-items:center; gap:10px; font-size:0.88rem; cursor:pointer;">
              <input type="checkbox" id="insAddonRiot" onchange="updateInsurancePremium()" style="width:16px; height:16px;"> Civil Commotion & Riot
            </label>
            <label style="display:flex; align-items:center; gap:10px; font-size:0.88rem; cursor:pointer;">
              <input type="checkbox" id="insAddonPassenger" onchange="updateInsurancePremium()" style="width:16px; height:16px;"> Passenger Accident Coverage
            </label>
            <label style="display:flex; align-items:center; gap:10px; font-size:0.88rem; cursor:pointer;">
              <input type="checkbox" id="insAddonTPL" onchange="updateInsurancePremium()" style="width:16px; height:16px;"> Third-Party Liability (TPL)
            </label>
          </div>

          <div class="insurance-premium-box">
            <div class="insurance-premium-label">Estimated Annual Premium</div>
            <div class="insurance-premium-amount" id="insPremiumAmount">Rp0</div>
            <div class="insurance-premium-per">per year</div>
          </div>

          <div style="display:flex; gap:12px;">
            <button class="btn-outline-gold" style="flex:1;" onclick="insuranceNextStep(1)">← Back</button>
            <button class="btn-gold" style="flex:1;" onclick="insuranceNextStep(3)">Next: Your Details →</button>
          </div>
        </div>

        <!-- Step 3: Personal Details -->
        <div id="insStepContent3" style="display:none;">
          <h4 style="font-family:var(--font-serif); font-size:1.05rem; margin-bottom:16px;">Applicant Information</h4>
          <form id="insuranceForm" onsubmit="submitInsuranceForm(event)">
            <div class="insurance-form-row">
              <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" id="insName" class="form-control" required placeholder="Your full name">
              </div>
              <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input type="tel" id="insPhone" class="form-control" required placeholder="08xx-xxxx-xxxx">
              </div>
            </div>
            <div class="insurance-form-row">
              <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" id="insEmail" class="form-control" required placeholder="you@example.com">
              </div>
              <div class="form-group">
                <label class="form-label">ID Number (KTP)</label>
                <input type="text" id="insKTP" class="form-control" required placeholder="16 digit KTP" maxlength="16">
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Address</label>
              <textarea id="insAddress" class="form-control" rows="2" required placeholder="Your full address"></textarea>
            </div>
            <div class="form-group">
              <label class="form-label">Insurance Period</label>
              <select id="insPeriod" class="form-control" onchange="updateInsurancePremium()" style="padding:10px; font-family:inherit; font-size:0.9rem;">
                <option value="1">1 Year</option>
                <option value="2">2 Years</option>
                <option value="3">3 Years</option>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">Notes (Optional)</label>
              <textarea id="insNotes" class="form-control" rows="2" placeholder="Additional notes or requests..."></textarea>
            </div>

            <div class="insurance-premium-box">
              <div class="insurance-premium-label">Total Premium</div>
              <div class="insurance-premium-amount" id="insTotalPremium">Rp0</div>
              <div class="insurance-premium-per" id="insTotalPeriod">for 1 year</div>
            </div>

            <div style="display:flex; gap:12px;">
              <button type="button" class="btn-outline-gold" style="flex:1;" onclick="insuranceNextStep(2)">← Back</button>
              <button type="submit" class="btn-gold" style="flex:1;">Submit Application</button>
            </div>
          </form>
        </div>
      </div>
    </div>
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

  <!-- Favorites Modal -->
  <div class="modal-overlay" id="favoritesModal">
    <div class="modal-container" style="max-width:560px;">
      <div class="modal-header">
        <h3 class="modal-title">My Favorites</h3>
        <button class="modal-close" onclick="closeModal('favoritesModal')">&times;</button>
      </div>
      <div class="modal-body">
        <div id="favoritesContent">
          <div style="text-align:center; padding:40px 20px;">
            <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="var(--gray-300)" stroke-width="1.2" style="margin-bottom:16px;"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
            <h4 style="font-family:var(--font-serif); font-size:1.1rem; margin-bottom:8px;">No Favorites Yet</h4>
            <p style="font-size:0.85rem; color:var(--gray-500); line-height:1.5;">Tap the ♡ icon on any vehicle card to save it here for quick access.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Test Drive Booking Modal -->
  <div class="modal-overlay" id="testDriveModal">
    <div class="modal-container" style="max-width:520px;">
      <div class="modal-header">
        <h3 class="modal-title">Book a Test Drive</h3>
        <button class="modal-close" onclick="closeModal('testDriveModal')">&times;</button>
      </div>
      <div class="modal-body">
        <div style="text-align:center; margin-bottom:20px;">
          <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#0d9488" stroke-width="1.5" style="margin-bottom:8px;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
          <h4 style="font-family:var(--font-serif); font-size:1.05rem; margin-bottom:4px;">Experience the Drive</h4>
          <p style="font-size:0.82rem; color:var(--gray-500);">Schedule a private test drive at our showroom</p>
        </div>
        <div id="tdAlert" style="display:none; padding:12px; margin-bottom:16px; font-size:0.85rem; border:1px solid;"></div>
        <form id="testDriveForm" onsubmit="submitTestDriveForm(event)">
          <div class="form-group">
            <label class="form-label">Select Vehicle</label>
            <select id="tdVehicleSelect" class="form-control" style="padding:10px; font-family:inherit; font-size:0.9rem;"></select>
          </div>
          <div class="insurance-form-row">
            <div class="form-group">
              <label class="form-label">Full Name</label>
              <input type="text" id="tdName" class="form-control" required placeholder="Your full name">
            </div>
            <div class="form-group">
              <label class="form-label">Email Address</label>
              <input type="email" id="tdEmail" class="form-control" required placeholder="you@example.com">
            </div>
          </div>
          <div class="insurance-form-row">
            <div class="form-group">
              <label class="form-label">Phone Number (WhatsApp)</label>
              <input type="tel" id="tdPhone" class="form-control" required placeholder="08xx-xxxx-xxxx">
            </div>
            <div class="form-group">
              <label class="form-label">Preferred Date</label>
              <input type="date" id="tdDate" class="form-control" required style="padding:10px; font-family:inherit;">
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Preferred Time</label>
            <select id="tdTime" class="form-control" required style="padding:10px; font-family:inherit; font-size:0.9rem;">
              <option value="09:00">09:00 WIB</option>
              <option value="10:00">10:00 WIB</option>
              <option value="11:00">11:00 WIB</option>
              <option value="13:00" selected>13:00 WIB</option>
              <option value="14:00">14:00 WIB</option>
              <option value="15:00">15:00 WIB</option>
              <option value="16:00">16:00 WIB</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Notes (Optional)</label>
            <textarea id="tdNotes" class="form-control" rows="2" placeholder="Any special requests..."></textarea>
          </div>
          <div style="background:var(--gray-100); padding:14px; margin-bottom:20px; border:1px solid var(--gray-200); font-size:0.82rem; color:var(--gray-600); line-height:1.5;">
            <strong style="color:var(--black);">📍 Showroom Location:</strong><br>
            PCS Edition Showroom, Jl. Sudirman No. 88, SCBD, Jakarta Selatan<br>
            <strong>Open:</strong> Mon–Sat, 09:00–17:00 WIB
          </div>
          <button type="submit" class="btn-gold" style="width:100%;">Confirm Booking</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Sell Your Car Modal -->
  <div class="modal-overlay" id="sellCarModal">
    <div class="modal-container" style="max-width:560px;">
      <div class="modal-header">
        <h3 class="modal-title">Sell Your Car</h3>
        <button class="modal-close" onclick="closeModal('sellCarModal')">&times;</button>
      </div>
      <div class="modal-body">
        <div style="text-align:center; margin-bottom:20px;">
          <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#b45309" stroke-width="1.5" style="margin-bottom:8px;"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
          <h4 style="font-family:var(--font-serif); font-size:1.05rem; margin-bottom:4px;">Consign With PCS Edition</h4>
          <p style="font-size:0.82rem; color:var(--gray-500); max-width:380px; margin:0 auto;">List your luxury vehicle with us and reach thousands of qualified buyers worldwide.</p>
        </div>
        <form id="sellCarForm" onsubmit="submitSellCarForm(event)">
          <div style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.08em; color:var(--gray-500); font-weight:600; margin-bottom:12px;">Vehicle Information</div>
          <div class="insurance-form-row">
            <div class="form-group">
              <label class="form-label">Brand</label>
              <input type="text" id="sellBrand" class="form-control" required placeholder="e.g. Ferrari">
            </div>
            <div class="form-group">
              <label class="form-label">Model</label>
              <input type="text" id="sellModel" class="form-control" required placeholder="e.g. 296 GTB">
            </div>
          </div>
          <div class="insurance-form-row">
            <div class="form-group">
              <label class="form-label">Year</label>
              <input type="number" id="sellYear" class="form-control" required placeholder="2025" min="1990" max="2027">
            </div>
            <div class="form-group">
              <label class="form-label">Mileage (km)</label>
              <input type="number" id="sellMileage" class="form-control" required placeholder="e.g. 5000">
            </div>
          </div>
          <div class="insurance-form-row">
            <div class="form-group">
              <label class="form-label">Color</label>
              <input type="text" id="sellColor" class="form-control" required placeholder="e.g. Rosso Corsa">
            </div>
            <div class="form-group">
              <label class="form-label">Asking Price (IDR)</label>
              <input type="number" id="sellPrice" class="form-control" required placeholder="e.g. 15000000000">
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Vehicle Condition</label>
            <select id="sellCondition" class="form-control" style="padding:10px; font-family:inherit; font-size:0.9rem;">
              <option value="excellent">Excellent – Like New</option>
              <option value="good">Good – Minor Wear</option>
              <option value="fair">Fair – Needs Minor Work</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Description</label>
            <textarea id="sellDescription" class="form-control" rows="3" required placeholder="Describe your vehicle's condition, modifications, service history..."></textarea>
          </div>

          <div style="height:1px; background:var(--gray-200); margin:24px 0;"></div>
          <div style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.08em; color:var(--gray-500); font-weight:600; margin-bottom:12px;">Owner Contact</div>
          <div class="insurance-form-row">
            <div class="form-group">
              <label class="form-label">Full Name</label>
              <input type="text" id="sellOwnerName" class="form-control" required placeholder="Your full name">
            </div>
            <div class="form-group">
              <label class="form-label">Phone</label>
              <input type="tel" id="sellOwnerPhone" class="form-control" required placeholder="08xx-xxxx-xxxx">
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" id="sellOwnerEmail" class="form-control" required placeholder="you@example.com">
          </div>
          <div style="background: linear-gradient(135deg, #78350f 0%, #b45309 100%); color:#fff; padding:16px; margin-bottom:20px; font-size:0.82rem; line-height:1.5;">
            <strong>✨ PCS Edition Promise:</strong> Our team will inspect your vehicle within 48 hours and list it across our global network of luxury buyers. Commission: 3–5% upon successful sale.
          </div>
          <button type="submit" class="btn-gold" style="width:100%;">Submit for Review</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Contact Us Modal -->
  <div class="modal-overlay" id="contactUsModal">
    <div class="modal-container" style="max-width:480px;">
      <div class="modal-header">
        <h3 class="modal-title">Contact Us</h3>
        <button class="modal-close" onclick="closeModal('contactUsModal')">&times;</button>
      </div>
      <div class="modal-body">
        <div style="text-align:center; margin-bottom:24px;">
          <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="1.5" style="margin-bottom:8px;"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
          <h4 style="font-family:var(--font-serif); font-size:1.05rem; margin-bottom:4px;">We'd Love to Hear From You</h4>
          <p style="font-size:0.82rem; color:var(--gray-500);">Questions, feedback, or partnership inquiries</p>
        </div>
        <form id="contactUsForm" onsubmit="submitContactUsForm(event)">
          <div class="form-group">
            <label class="form-label">Subject</label>
            <select id="cuSubject" class="form-control" style="padding:10px; font-family:inherit; font-size:0.9rem;">
              <option value="general">General Inquiry</option>
              <option value="support">Customer Support</option>
              <option value="partnership">Business Partnership</option>
              <option value="feedback">Feedback & Suggestions</option>
              <option value="complaint">Complaint</option>
            </select>
          </div>
          <div class="insurance-form-row">
            <div class="form-group">
              <label class="form-label">Full Name</label>
              <input type="text" id="cuName" class="form-control" required placeholder="Your name">
            </div>
            <div class="form-group">
              <label class="form-label">Email</label>
              <input type="email" id="cuEmail" class="form-control" required placeholder="you@example.com">
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Phone (Optional)</label>
            <input type="tel" id="cuPhone" class="form-control" placeholder="08xx-xxxx-xxxx">
          </div>
          <div class="form-group">
            <label class="form-label">Message</label>
            <textarea id="cuMessage" class="form-control" rows="4" required placeholder="Tell us how we can help..."></textarea>
          </div>
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; background:var(--gray-100); padding:16px; margin-bottom:20px; border:1px solid var(--gray-200);">
            <div>
              <div style="font-size:0.72rem; text-transform:uppercase; letter-spacing:0.06em; color:var(--gray-500); margin-bottom:4px;">Email</div>
              <div style="font-size:0.85rem; font-weight:500;">hello@pcsedition.com</div>
            </div>
            <div>
              <div style="font-size:0.72rem; text-transform:uppercase; letter-spacing:0.06em; color:var(--gray-500); margin-bottom:4px;">WhatsApp</div>
              <div style="font-size:0.85rem; font-weight:500;">+62 812-9988-7766</div>
            </div>
          </div>
          <button type="submit" class="btn-gold" style="width:100%;">Send Message</button>
        </form>
      </div>
    </div>
  </div>

  
  <!-- Customer Service Booking Modal -->
  <div class="modal-overlay" id="customerServiceModal">
    <div class="modal-container" style="max-width:560px;">
      <div class="modal-header">
        <h3 class="modal-title">Book Service & Maintenance</h3>
        <button class="modal-close" onclick="closeModal('customerServiceModal')">&times;</button>
      </div>
      <div class="modal-body">
        <form id="customerServiceForm" onsubmit="submitCustomerServiceBooking(event)">
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group"><label class="form-label">Nama Pemilik *</label><input type="text" id="custSrvName" class="form-control" required placeholder="Nama Anda"></div>
            <div class="form-group"><label class="form-label">Nomor WhatsApp *</label><input type="text" id="custSrvPhone" class="form-control" required placeholder="08xx-xxxx"></div>
          </div>
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group"><label class="form-label">Model Kendaraan *</label><input type="text" id="custSrvCarModel" class="form-control" required placeholder="Ferrari / Porsche"></div>
            <div class="form-group"><label class="form-label">Nomor Polisi *</label><input type="text" id="custSrvNopol" class="form-control" required placeholder="B 1234 PCS" style="text-transform:uppercase;"></div>
          </div>
          <div class="form-group">
            <label class="form-label">Paket Servis *</label>
            <select id="custSrvType" class="form-control" onchange="updateServiceEstimatePreview()" style="padding:10px;" required>
              <option value="ganti_oli">Ganti Oli Mesin (Motul 300V / Castrol Edge Supercar + Filter)</option>
              <option value="tune_up">Tune Up (Busi Racing, Throttle, Injector Clean)</option>
              <option value="servis_umum">Servis Umum & General Inspection 150 Titik</option>
              <option value="perbaikan_rem">Perbaikan Rem & Kampas Brembo</option>
              <option value="servis_ac">Servis AC & Flushing Freon</option>
              <option value="kelistrikan">Diagnostik Kelistrikan & ECU OBD</option>
              <option value="lainnya">Servis Khusus / Konsultasi</option>
            </select>
          </div>
          <div id="custSrvEstimateBox" style="background:var(--gray-100); padding:14px; border:1px solid var(--gray-200); margin-bottom:16px;"></div>
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group"><label class="form-label">Tanggal Servis *</label><input type="date" id="custSrvDate" class="form-control" required></div>
            <div class="form-group"><label class="form-label">Slot Waktu *</label><select id="custSrvTime" class="form-control" style="padding:10px;"><option value="09:00 WIB">09:00 WIB</option><option value="10:30 WIB">10:30 WIB</option><option value="13:30 WIB">13:30 WIB</option><option value="15:00 WIB">15:00 WIB</option></select></div>
          </div>
          <div class="form-group"><label class="form-label">Email Konfirmasi</label><input type="email" id="custSrvEmail" class="form-control" placeholder="email@domain.com"></div>
          <div class="form-group"><label class="form-label">Keluhan Tambahan</label><textarea id="custSrvNotes" class="form-control" rows="2"></textarea></div>
          <button type="submit" class="btn-gold" style="width:100%;">Konfirmasi Booking Servis &rarr;</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Service Success Receipt Modal -->
  <div class="modal-overlay" id="serviceSuccessModal">
    <div class="modal-container" style="max-width:460px;">
      <div class="modal-header"><h3 class="modal-title">Booking Servis Terkonfirmasi</h3><button class="modal-close" onclick="closeModal('serviceSuccessModal')">&times;</button></div>
      <div class="modal-body">
        <div style="text-align:center; padding:16px 0 24px;">
          <h4 style="font-family:var(--font-serif); font-size:1.3rem; margin-bottom:4px;">Reservasi Berhasil Didaftarkan</h4>
          <p style="font-size:0.83rem; color:var(--gray-500);">Tim service advisor kami akan menyiapkan stall pengerjaan.</p>
        </div>
        <div style="background:var(--gray-100); border:1px solid var(--gray-200); padding:16px; margin-bottom:20px; font-size:0.85rem; line-height:1.8;">
          <div style="display:flex; justify-content:space-between;"><span style="color:var(--gray-500);">Kode Booking</span><strong id="srvReceiptCode">-</strong></div>
          <div style="display:flex; justify-content:space-between;"><span style="color:var(--gray-500);">Kendaraan</span><strong id="srvReceiptCar">-</strong></div>
          <div style="display:flex; justify-content:space-between;"><span style="color:var(--gray-500);">Paket Servis</span><strong id="srvReceiptType">-</strong></div>
          <div style="display:flex; justify-content:space-between;"><span style="color:var(--gray-500);">Jadwal</span><strong id="srvReceiptSchedule">-</strong></div>
          <div style="display:flex; justify-content:space-between; border-top:1px dashed var(--gray-300); margin-top:8px; padding-top:8px;"><span style="color:var(--gray-500);">Estimasi Total</span><strong style="color:var(--gold); font-size:1rem;" id="srvReceiptCost">Rp 0</strong></div>
        </div>
        <button class="btn-gold" style="width:100%;" onclick="closeModal('serviceSuccessModal')">Selesai</button>
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
</body>

</html>
