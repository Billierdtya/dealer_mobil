<?php
require_once 'config.php';
$conn = getDBConnection();

$total_cars = 0;
$total_brands = 0;
$featured_cars = [];
$brands_list = [];

if ($conn) {
    // Total cars
    $stmt = $conn->query("SELECT COUNT(*) as total FROM mobil WHERE stok > 0");
    $row = $stmt->fetch();
    if ($row) $total_cars = $row['total'];
    
    // Total brands
    $stmt = $conn->query("SELECT COUNT(DISTINCT brand) as total FROM mobil WHERE stok > 0");
    $row = $stmt->fetch();
    if ($row) $total_brands = $row['total'];
    
    // Featured Cars (Most expensive)
    $stmt = $conn->query("SELECT * FROM mobil WHERE stok > 0 ORDER BY harga_otr DESC LIMIT 6");
    $featured_cars = $stmt->fetchAll();
    
    // Brands
    $stmt = $conn->query("SELECT DISTINCT brand FROM mobil WHERE stok > 0 ORDER BY brand ASC");
    $brands_list = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Luxury Cars for Sale | PCS Edition</title>
  <link rel="icon" type="image/png" href="assets/images/logo_pcs.png">
  <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
  <style>
    /* Custom Toast Notification */
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
  </style>
  <link rel="stylesheet" href="assets/css/home.css">
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
      <a class="sidebar-nav-item highlight" href="index.php">
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
      <button class="sidebar-nav-item" onclick="toggleSidebar(); openCustomerServiceModal();">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
        Book Service (Oli / Tune Up)
      </button>
      <button class="sidebar-nav-item" onclick="toggleSidebar(); openMyBookingsModal();">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
        Riwayat & Aktivitas Saya
      </button>
      <button class="sidebar-nav-item" onclick="toggleSidebar(); openInsuranceModal();">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
        Insurance Application
      </button>
      <button class="sidebar-nav-item" onclick="toggleSidebar(); openTestDriveModal();">
        <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        Book Test Drive
      </button>
      <button class="sidebar-nav-item" onclick="toggleSidebar(); openSellCarModal();">
        <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
        Sell Your Car
      </button>
      <button class="sidebar-nav-item" onclick="toggleSidebar(); openContactUsModal();">
        <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
        Contact Us
      </button>

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
      © 2026 PT Pencari Cinta Sejati
    </div>
  </aside>


  <!-- Header Wrapper -->
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
          <a href="index.php" class="desktop-nav-link active">
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
          <button type="button" id="navBtnService" data-open-modal="service" onclick="openCustomerServiceModal()" class="desktop-nav-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
            Service
          </button>
          <button type="button" id="navBtnInsurance" data-open-modal="insurance" onclick="openInsuranceModal()" class="desktop-nav-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
            Insurance
          </button>
          <button type="button" id="navBtnSell" data-open-modal="sell" onclick="openSellCarModal()" class="desktop-nav-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
            Sell
          </button>
          <button type="button" id="navBtnTestDrive" data-open-modal="testdrive" onclick="openTestDriveModal()" class="desktop-nav-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            Test Drive
          </button>
          <button type="button" id="navBtnContact" data-open-modal="contact" onclick="openContactUsModal()" class="desktop-nav-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
            Contact
          </button>
        </div>
        <!-- Mobile Search -->
        <form class="search-bar mobile-search" action="cars.php" method="GET">
          <svg viewBox="0 0 24 24">
            <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
          </svg>
          <input type="text" name="search" placeholder="Search Cars">
        </form>
      </div>

      <div class="navbar-right">
        <!-- Desktop Search -->
        <form class="search-bar desktop-search" action="cars.php" method="GET">
          <svg viewBox="0 0 24 24">
            <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
          </svg>
          <input type="text" name="search" placeholder="Search Cars">
        </form>
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
          <button id="navMyBookingsBtn" onclick="openMyBookingsModal()" class="btn-login" style="display:none; font-size:0.75rem; padding:6px 12px;">Aktivitas Saya</button>
          <button class="btn-login" onclick="userLogout()" style="font-size:0.75rem; padding:6px 12px;">Logout</button>
        </div>
      </div>
    </nav>
  </div>

  <!-- 1. Hero Section -->
  <section class="hero-section">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <h1 class="hero-title">Experience Automotive Excellence</h1>
      <p class="hero-subtitle">Discover the world's most prestigious collection of luxury vehicles, hypercars, and rare automotive masterpieces curated exclusively for you.</p>
      <div class="hero-actions">
        <a href="cars.php" class="hero-btn-primary">Explore Cars</a>
        <a href="#" onclick="openContactUsModal(); return false;" class="hero-btn-secondary">Contact Us</a>
      </div>
    </div>
  </section>

  <!-- 2. About Us -->
  <section class="home-section">
    <div class="about-grid">
      <div class="about-image-wrap">
        <img src="assets/images/cars/bentley_continental_gt_speed_w12.jpg" alt="PCS Edition Showroom" class="about-image" onerror="this.src='https://images.unsplash.com/photo-1563720223185-11003d516935?auto=format&fit=crop&w=800&q=80'">
      </div>
      <div class="about-text">
        <h2 class="section-title" style="text-align: left; margin-bottom: 24px;">The Pinnacle of Luxury Mobility</h2>
        <p>PT Pencari Cinta Sejati (PCS Edition) is the premier destination for extraordinary automobiles. Since our inception, we have been dedicated to uniting passionate drivers with the vehicles of their dreams.</p>
        <p>Our commitment to transparency, rigorous curation, and bespoke client services ensures that every acquisition is not merely a transaction, but the beginning of an exceptional journey.</p>
      </div>
    </div>
  </section>

  <!-- 3. Statistics -->
  <section class="home-section home-section-alt">
    <div class="stats-grid">
      <div class="stat-item">
        <div class="stat-number"><?php echo number_format($total_cars); ?></div>
        <div class="stat-label">Available Units</div>
      </div>
      <div class="stat-item">
        <div class="stat-number"><?php echo number_format($total_brands); ?></div>
        <div class="stat-label">Luxury Brands</div>
      </div>
      <div class="stat-item">
        <div class="stat-number">15+</div>
        <div class="stat-label">Years Experience</div>
      </div>
      <div class="stat-item">
        <div class="stat-number">100%</div>
        <div class="stat-label">Client Satisfaction</div>
      </div>
    </div>
  </section>

  <!-- 4. Featured Cars -->
  <section class="home-section">
    <div class="section-header">
      <h2 class="section-title">Featured Masterpieces</h2>
      <p class="section-subtitle">A handpicked selection of our most exquisite and sought-after vehicles currently available in our gallery.</p>
    </div>
    
    <div class="catalog-grid" id="featuredGrid" style="max-width: var(--container-max); margin: 0 auto 40px auto;">
      <?php if(empty($featured_cars)): ?>
        <div style="grid-column: 1/-1; text-align: center; color: var(--gray-500);">No featured cars available.</div>
      <?php else: ?>
        <?php foreach($featured_cars as $car): ?>
          <div class="car-card fade-in" onclick="openDetailModal(<?php echo $car['id']; ?>)">
            <div class="car-card-img-wrap">
              <div class="card-badge">Featured</div>
              <button class="card-favorite php-favorite-btn" data-id="<?php echo $car['id']; ?>" onclick="event.stopPropagation(); toggleFavorite(<?php echo $car['id']; ?>, this)">
                <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
              </button>
              <div class="card-photo-count">1/<?php echo rand(15, 30); ?></div>
              <img src="<?php echo htmlspecialchars($car['gambar_utama']); ?>" alt="<?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?>" onerror="this.src='https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80'">
            </div>
            <div class="car-card-body">
              <div class="card-price-row">
                <div class="car-price">Rp <?php echo number_format($car['harga_otr'], 0, ',', '.'); ?></div>
                <button class="card-contact-btn" onclick="event.stopPropagation(); requireLogin(() => openBookingModal(<?php echo $car['id']; ?>))">
                  Contact 
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                </button>
              </div>
              <div class="car-title"><?php echo htmlspecialchars($car['tahun'] . ' ' . $car['brand'] . ' ' . $car['model']); ?></div>
              <div class="car-location">Jakarta, Indonesia</div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
    
    <div style="text-align: center;">
      <a href="cars.php" class="hero-btn-primary" style="background: var(--black); color: var(--white);">View All Cars</a>
    </div>
  </section>

  <!-- 5. Browse by Brand -->
  <section class="brands-marquee">
    <div class="brands-track">
      <?php foreach($brands_list as $b): ?>
        <a href="cars.php?brand=<?php echo urlencode($b['brand']); ?>" class="brand-item"><?php echo htmlspecialchars($b['brand']); ?></a>
      <?php endforeach; ?>
      <!-- Duplicate for infinite scroll effect -->
      <?php foreach($brands_list as $b): ?>
        <a href="cars.php?brand=<?php echo urlencode($b['brand']); ?>" class="brand-item"><?php echo htmlspecialchars($b['brand']); ?></a>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- 6. Our Services -->
  <section class="home-section">
    <div class="section-header">
      <h2 class="section-title">Exclusive Services</h2>
      <p class="section-subtitle">Beyond acquisitions, PCS Edition offers a comprehensive suite of bespoke automotive services.</p>
    </div>
    <div class="services-grid">
      <a href="cars.php" class="service-card">
        <div class="service-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"></path><circle cx="7" cy="17" r="2"></circle><path d="M9 17h6"></path><circle cx="17" cy="17" r="2"></circle></svg>
        </div>
        <h3 class="service-title">Acquire</h3>
        <p class="service-desc">Explore our curated collection of pristine luxury vehicles and hypercars.</p>
      </a>
      <a href="#" onclick="openSellCarModal(); return false;" class="service-card">
        <div class="service-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
        </div>
        <h3 class="service-title">Consign</h3>
        <p class="service-desc">Leverage our global network to sell your exceptional vehicle discreetly.</p>
      </a>
      <a href="#" onclick="openInsuranceModal(); return false;" class="service-card">
        <div class="service-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
        </div>
        <h3 class="service-title">Insure</h3>
        <p class="service-desc">Bespoke insurance solutions tailored for high-value automotive assets.</p>
      </a>
      <a href="#" onclick="openTestDriveModal(); return false;" class="service-card">
        <div class="service-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        </div>
        <h3 class="service-title">Experience</h3>
        <p class="service-desc">Schedule a private viewing and test drive at your convenience.</p>
      </a>
    </div>
  </section>

  <!-- 7. Why Choose Us -->
  <section class="home-section home-section-alt">
    <div class="section-header">
      <h2 class="section-title">The PCS Difference</h2>
    </div>
    <div class="features-grid">
      <div class="feature-item">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
        <h3 class="feature-title">Uncompromising Quality</h3>
        <p class="feature-desc">Every vehicle undergoes a rigorous 200-point inspection by factory-trained technicians to guarantee impeccable condition.</p>
      </div>
      <div class="feature-item">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
        <h3 class="feature-title">Global Sourcing</h3>
        <p class="feature-desc">Can't find what you're looking for? Our international network allows us to source the rarest vehicles worldwide.</p>
      </div>
      <div class="feature-item">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
        <h3 class="feature-title">Complete Discretion</h3>
        <p class="feature-desc">We respect your privacy. All transactions and inquiries are handled with the highest level of confidentiality.</p>
      </div>
    </div>
  </section>

  <!-- 8. Testimonials -->
  <section class="home-section">
    <div class="section-header">
      <h2 class="section-title">Client Experiences</h2>
    </div>
    <div class="testi-grid">
      <div class="testi-card">
        <p class="testi-quote">"The level of professionalism at PCS Edition is unmatched. They sourced my exact specification Purosangue within weeks. Highly recommended."</p>
        <div class="testi-author">A. Wijaya</div>
        <div class="testi-car">Purchased Ferrari Purosangue</div>
      </div>
      <div class="testi-card">
        <p class="testi-quote">"Selling my GT3 RS through their consignment program was seamless. Absolute transparency and a very smooth transaction."</p>
        <div class="testi-author">B. Santoso</div>
        <div class="testi-car">Sold Porsche 911 GT3 RS</div>
      </div>
      <div class="testi-card">
        <p class="testi-quote">"From the private viewing to the delivery in an enclosed trailer, the attention to detail is truly world-class."</p>
        <div class="testi-author">C. Haryanto</div>
        <div class="testi-car">Purchased Rolls-Royce Cullinan</div>
      </div>
    </div>
  </section>

  <!-- 9. Contact & Location -->
  <section class="home-section home-section-alt">
    <div class="contact-grid">
      <div>
        <h2 class="section-title" style="text-align: left; margin-bottom: 32px;">Visit Our Gallery</h2>
        <div class="contact-info">
          <h4>Location</h4>
          <p>Jl. Jend. Sudirman Kav. 52-53</p>
          <p>SCBD, Jakarta Selatan 12190</p>
        </div>
        <div class="contact-info">
          <h4>Hours</h4>
          <p>Monday - Saturday: 10:00 - 19:00</p>
          <p>Sunday: By Appointment Only</p>
        </div>
        <div class="contact-info">
          <h4>Contact</h4>
          <p>+62 811 2233 4455</p>
          <p>concierge@pcsedition.com</p>
        </div>
        <div style="margin-top: 32px; display: flex; gap: 16px;">
          <a href="https://wa.me/6281122334455" class="btn-whatsapp" target="_blank">
            <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Chat on WhatsApp
          </a>
          <a href="#" onclick="openContactUsModal(); return false;" class="hero-btn-primary" style="background: var(--black); color: var(--white); display: inline-flex; align-items: center; justify-content: center; height: 48px; box-sizing: border-box;">Send Message</a>
        </div>
      </div>
      <div>
        <!-- Placeholder Map -->
        <div style="width: 100%; height: 400px; background: var(--gray-200); display: flex; align-items: center; justify-content: center; color: var(--gray-500);">
          [ Google Maps Embed Placeholder ]
        </div>
      </div>
    </div>
  </section>

  <script>
    // Sync favorites on featured cars after page load
    document.addEventListener('DOMContentLoaded', () => {
      const favs = JSON.parse(localStorage.getItem('pcsFavorites') || '[]');
      document.querySelectorAll('.php-favorite-btn').forEach(btn => {
        const id = parseInt(btn.getAttribute('data-id'));
        if (favs.includes(id)) {
          btn.classList.add('active');
        }
      });
    });
    // Smooth Parallax for Hero Image
    window.addEventListener('scroll', () => {
      const scrolled = window.scrollY;
      const heroBg = document.querySelector('.hero-bg');
      if (heroBg && scrolled < window.innerHeight) {
        heroBg.style.transform = `translateY(${scrolled * 0.4}px)`;
      }
    });
  </script>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-grid">
      <div>
        <h4 class="footer-title">PCS Edition</h4>
        <ul class="footer-links">
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
          <li><a href="#">Careers</a></li>
          <li><a href="#">Terms of use</a></li>
          <li><a href="#">Privacy policy</a></li>
        </ul>
      </div>
      <div>
        <h4 class="footer-title">Categories</h4>
        <ul class="footer-links">
          <li><a href="#">Real Estate</a></li>
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
    <div
      style="text-align: center; color: var(--gray-500); font-size: 0.85rem; border-top: 1px solid var(--gray-200); padding-top: 24px; max-width: var(--container-max); margin: 0 auto;">
      © 2026 PT Pencari Cinta Sejati. The World's Luxury Marketplace.
    </div>
  </footer>

  <!-- Modals -->
  <!-- Booking / Detail Modal (Simplified for the UI) -->
  <div class="modal-overlay" id="detailModal">
    <div class="modal-container">
      <div class="modal-header">
        <h3 class="modal-title" id="detailCarTitle">Vehicle Details</h3>
        <button class="modal-close" onclick="closeModal('detailModal')">&times;</button>
      </div>
      <div class="modal-body">
        <img id="detailCarImg" src="" alt="Car Image"
          style="width:100%; aspect-ratio: 3/2; object-fit:cover; margin-bottom:16px; background: var(--gray-200);">
        <div
          style="font-family:var(--font-serif); font-size:1.5rem; font-weight:600; color:var(--black); margin-bottom:16px;"
          id="detailCarPrice">$0</div>

        <p id="detailCarSpecs" style="font-size:0.9rem; color:var(--black); margin-bottom:16px;"></p>
        <p id="detailCarDesc" style="font-size:0.85rem; color:var(--gray-600); margin-bottom:24px; line-height:1.6;">
        </p>

        <!-- Credit Calculator / Simulasi Kredit -->
        <div style="margin-bottom: 32px; border-top: 1px solid var(--gray-200); padding-top: 24px;">
          <h4 style="font-family: var(--font-serif); font-size: 1.25rem; margin-bottom: 16px;">Finance Calculator</h4>
          <div style="display: flex; flex-direction: column; gap: 16px;">
            <div class="form-group" style="margin-bottom: 0;">
              <label class="form-label">Down Payment (%)</label>
              <input type="range" id="calcDp" min="10" max="90" step="5" value="20"
                style="width: 100%; margin-top: 8px;">
              <div
                style="display: flex; justify-content: space-between; font-size: 0.85rem; color: var(--gray-600); margin-top: 4px;">
                <span id="dpValueDisplay">20%</span>
                <span id="dpAmountDisplay">$0</span>
              </div>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
              <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label">Term</label>
                <select id="calcTenor" class="form-control"
                  style="padding: 10px; font-family: inherit; font-size: 0.9rem;">
                  <option value="12">12 Months</option>
                  <option value="24">24 Months</option>
                  <option value="36" selected>36 Months</option>
                  <option value="48">48 Months</option>
                  <option value="60">60 Months</option>
                </select>
              </div>
              <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label">Interest Rate</label>
                <div style="padding: 10px 0; font-size: 0.95rem; font-weight: 500;">5.5% (Flat)</div>
              </div>
            </div>

            <div
              style="background: var(--gray-100); padding: 20px; margin-top: 8px; border: 1px solid var(--gray-200);">
              <div
                style="font-size: 0.8rem; color: var(--gray-600); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">
                Estimated Monthly Payment</div>
              <div style="font-family: var(--font-serif); font-size: 1.75rem; color: var(--black);" id="calcResult">$0
              </div>
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

  <!-- Booking / Contact Seller Modal (logged-in users only) -->
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
          <p style="font-size:0.85rem; color:var(--gray-600);">Sign in to access favorites, save vehicles, and contact sellers.</p>
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
        <div style="text-align:center; margin-bottom:20px;">
          <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="1.5" style="margin-bottom:8px;"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
          <h4 style="font-family:var(--font-serif); font-size:1.15rem; margin-bottom:4px;">Bengkel Resmi Supercar & Luxury</h4>
          <p style="font-size:0.82rem; color:var(--gray-500);">Teknisi bersertifikasi APM, sparepart original, dan diagnostik komputer resmi</p>
        </div>

        <form id="customerServiceForm" onsubmit="submitCustomerServiceBooking(event)">
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label">Nama Pemilik *</label>
              <input type="text" id="custSrvName" class="form-control" required placeholder="Nama Anda">
            </div>
            <div class="form-group">
              <label class="form-label">Nomor WhatsApp *</label>
              <input type="text" id="custSrvPhone" class="form-control" required placeholder="08xx-xxxx-xxxx">
            </div>
          </div>

          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label">Model Kendaraan *</label>
              <input type="text" id="custSrvCarModel" class="form-control" required placeholder="Ferrari / Porsche / Rolls-Royce">
            </div>
            <div class="form-group">
              <label class="form-label">Nomor Polisi (Plat) *</label>
              <input type="text" id="custSrvNopol" class="form-control" required placeholder="B 1234 PCS" style="text-transform:uppercase;">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Pilih Paket Servis *</label>
            <select id="custSrvType" class="form-control" onchange="updateServiceEstimatePreview()" style="padding:10px; font-family:inherit; font-size:0.9rem;" required>
              <option value="ganti_oli">Ganti Oli Mesin (Motul 300V / Castrol Edge Supercar + Filter)</option>
              <option value="tune_up">Tune Up (Busi Racing Iridium, Throttle & Injector Clean)</option>
              <option value="servis_umum">Servis Umum & General Inspection 150 Titik</option>
              <option value="perbaikan_rem">Perbaikan Rem (Brembo Brake Pad + Minyak Rem Dot 5.1)</option>
              <option value="servis_ac">Servis AC & Flushing Freon</option>
              <option value="kelistrikan">Diagnostik Kelistrikan & Reset Modul ECU OBD</option>
              <option value="lainnya">Servis Khusus / Konsultasi Keluhan</option>
            </select>
          </div>

          <!-- Dynamic Transparent Cost Estimate Preview Box -->
          <div id="custSrvEstimateBox" style="background:var(--gray-100); padding:14px; border:1px solid var(--gray-200); margin-bottom:16px;"></div>

          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label">Tanggal Servis *</label>
              <input type="date" id="custSrvDate" class="form-control" required>
            </div>
            <div class="form-group">
              <label class="form-label">Pilihan Slot Waktu *</label>
              <select id="custSrvTime" class="form-control" style="padding:10px; font-family:inherit; font-size:0.9rem;">
                <option value="09:00 WIB">09:00 WIB</option>
                <option value="10:30 WIB">10:30 WIB</option>
                <option value="13:30 WIB">13:30 WIB</option>
                <option value="15:00 WIB">15:00 WIB</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Email Konfirmasi</label>
            <input type="email" id="custSrvEmail" class="form-control" placeholder="email@domain.com">
          </div>

          <div class="form-group">
            <label class="form-label">Keluhan atau Permintaan Khusus</label>
            <textarea id="custSrvNotes" class="form-control" rows="2" placeholder="Gejala yang dirasakan saat berkendara..."></textarea>
          </div>

          <button type="submit" class="btn-gold" style="width:100%;">Konfirmasi Booking Servis &rarr;</button>
        </form>
      </div>
    </div>
  </div>

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
          <div style="display:flex; justify-content:space-between; border-top:1px dashed var(--gray-300); margin-top:8px; padding-top:8px;"><span style="color:var(--gray-500);">Estimasi Total</span><strong style="color:var(--gold); font-size:1rem;" id="srvReceiptCost">Rp 0</strong></div>
        </div>

        <div style="display:flex; gap:10px;">
          <button class="btn-outline-gold" style="flex:1;" onclick="closeModal('serviceSuccessModal'); openMyBookingsModal();">Lihat Status Servis</button>
          <button class="btn-gold" style="flex:1;" onclick="closeModal('serviceSuccessModal')">Selesai</button>
        </div>
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
          Servis Bengkel <span class="tab-badge" id="tabBadgeService">0</span>
        </button>
        <button class="my-tab-btn" id="myTabBtn-testdrive" onclick="switchMyBookingsTab('testdrive')">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
          Jadwal Test Drive <span class="tab-badge" id="tabBadgeTestDrive">0</span>
        </button>
        <button class="my-tab-btn" id="myTabBtn-sell" onclick="switchMyBookingsTab('sell')">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
          Titip Jual <span class="tab-badge" id="tabBadgeSell">0</span>
        </button>
        <button class="my-tab-btn" id="myTabBtn-contact" onclick="switchMyBookingsTab('contact')">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
          Pesan Kontak <span class="tab-badge" id="tabBadgeContact">0</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="myBookingsTopAction" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; flex-wrap:wrap; gap:8px;">
          <span style="font-size:0.82rem; color:var(--gray-500);">Pantau progres pengerjaan servis dan biaya pengerjaan:</span>
          <button class="btn-action btn-action-primary" onclick="closeModal('myBookingsModal'); openCustomerServiceModal();">+ Booking Baru</button>
        </div>
        <div id="myBookingsContent">
          <!-- Rendered via JS -->
        </div>
      </div>
    </div>
  </div>

  <!-- Custom Toast Container -->
  <div id="customToast">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
      <polyline points="22 4 12 14.01 9 11.01"></polyline>
    </svg>
    <span id="customToastMessage">Notification message here</span>
  </div>

  <script src="assets/js/app.js?v=<?php echo time(); ?>"></script>
</body>

</html>