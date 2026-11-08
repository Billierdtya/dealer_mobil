/**
 * PT PENCARI CINTA SEJATI - LUXURY & SUPERCAR DEALER
 * Frontend Interactive Controller (App.js)
 * Implements Use Cases, Booking & Credit Simulation Workflows, and Admin CRUD.
 */

// Initial Cars Master Data (55 cars: 5 per brand × 11 brands)
let currentCars = [
  // ── BUGATTI (kategori_id: 1) ──
  {
    id: 1,
    kategori_id: 1,
    brand: 'Bugatti',
    model: 'Chiron Super Sport',
    tahun: 2025,
    harga_otr: 78000000000,
    spesifikasi: 'W16 8.0L Quad-Turbo | 1578 HP | 1600 Nm | 0-100 km/h: 2.3s | Top Speed: 440 km/h | Limited 60 Units',
    deskripsi: 'Hypercar paling eksklusif di muka bumi. Hanya 60 unit diproduksi dengan performa yang melampaui batas fisika.',
    stok: 1,
    gambar_utama: 'assets/images/cars/bugatti_chiron_super_sport.jpg'
  },
  {
    id: 12,
    kategori_id: 1,
    brand: 'Bugatti',
    model: 'W16 Mistral Roadster',
    tahun: 2025,
    harga_otr: 85000000000,
    spesifikasi: 'W16 8.0L Quad-Turbo | 1600 HP | 1600 Nm | 0-100 km/h: 2.4s | The Ultimate Open-Top Hypercar',
    deskripsi: 'Roadster pamungkas bertenaga W16 legendaris Bugatti. Diproduksi terbatas hanya 99 unit di seluruh dunia.',
    stok: 1,
    gambar_utama: 'https://images.unsplash.com/photo-1544829099-b9a0c07fad1a?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 13,
    kategori_id: 1,
    brand: 'Bugatti',
    model: 'Divo Cornering Specialist',
    tahun: 2024,
    harga_otr: 95000000000,
    spesifikasi: 'W16 8.0L Quad-Turbo | 1500 HP | Cornering Specialist | Lateral Accel 1.6G | Downforce +90kg',
    deskripsi: 'Hypercar berkarakter sirkuit dengan aerodinamika agresif dan downforce ekstra dibanding Chiron standar.',
    stok: 1,
    gambar_utama: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 14,
    kategori_id: 1,
    brand: 'Bugatti',
    model: 'Bolide Track-Only Megacar',
    tahun: 2025,
    harga_otr: 72000000000,
    spesifikasi: 'W16 8.0L Quad-Turbo | 1850 HP | Weight: 1240 kg | 0.67 kg/HP | FIA Le Mans Safety Standards',
    deskripsi: 'Monster trek tanpa kompromi dengan rasio bobot tenaga 0.67 kg per HP dan transmisi balap FIA Le Mans.',
    stok: 1,
    gambar_utama: 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 15,
    kategori_id: 1,
    brand: 'Bugatti',
    model: 'Tourbillon V16 Hybrid',
    tahun: 2026,
    harga_otr: 88000000000,
    spesifikasi: 'V16 8.3L Cosworth NA + 3 Motors | 1800 HP | 0-100 km/h: 2.0s | Horology-Inspired Cockpit',
    deskripsi: 'Era baru hypercar Bugatti dengan instrumen analog karya pembuat jam tangan Swiss dan mesin naturally aspirated V16 Cosworth.',
    stok: 1,
    gambar_utama: 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?auto=format&fit=crop&w=800&q=80'
  },

  // ── PAGANI (kategori_id: 2) ──
  {
    id: 2,
    kategori_id: 2,
    brand: 'Pagani',
    model: 'Huayra Roadster BC',
    tahun: 2024,
    harga_otr: 60000000000,
    spesifikasi: 'AMG V12 6.0L Twin-Turbo | 802 HP | 1050 Nm | Carbon-Titanium Carbo-Triax HP62 Monocoque',
    deskripsi: 'Karya seni otomotif dari Horacio Pagani. Desain aerodinamis mutakhir dengan balutan serat karbon terhalus.',
    stok: 1,
    gambar_utama: 'assets/images/cars/pagani_huayra_roadster_bc.jpg'
  },
  {
    id: 16,
    kategori_id: 2,
    brand: 'Pagani',
    model: 'Utopia Gated Manual Coupé',
    tahun: 2025,
    harga_otr: 65000000000,
    spesifikasi: 'Mercedes-AMG V12 6.0L Twin-Turbo | 864 HP | 1100 Nm | 7-Speed Gated Manual Transverse',
    deskripsi: 'Karya seni purist Horacio Pagani yang menolak elektrifikasi, menghadirkan tuas transmisi manual terbuka yang mempesona.',
    stok: 1,
    gambar_utama: 'https://images.unsplash.com/photo-1647413554479-7df9fcebeab8?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 17,
    kategori_id: 2,
    brand: 'Pagani',
    model: 'Huayra R Track Pure V12',
    tahun: 2024,
    harga_otr: 58000000000,
    spesifikasi: 'V12-R 6.0L Naturally Aspirated | 850 HP | 9000 RPM | Weight 1050 kg | Inconel Exhaust Symphonic',
    deskripsi: 'Mobil trek bertenaga V12 atmosferik dengan suara knalpot bernada Formula 1 era 1990-an dan bobot hanya 1050 kg.',
    stok: 1,
    gambar_utama: 'https://images.unsplash.com/photo-1608821946397-f6556156cebb?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 18,
    kategori_id: 2,
    brand: 'Pagani',
    model: 'Zonda Cinque Roadster',
    tahun: 2023,
    harga_otr: 75000000000,
    spesifikasi: 'AMG V12 7.3L NA | 678 HP | 780 Nm | 1 of 5 Worldwide | Carbo-Titanium Monocoque | Roof-Scoop Aero',
    deskripsi: 'Salah satu Zonda paling langka dan dicari kolektor dunia. Hanya ada 5 unit di dunia dengan aerodinamika atap roof-scoop.',
    stok: 1,
    gambar_utama: 'https://images.unsplash.com/photo-1544829099-b9a0c07fad1a?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 19,
    kategori_id: 2,
    brand: 'Pagani',
    model: 'Imola Roadster Aero-Lab',
    tahun: 2025,
    harga_otr: 82000000000,
    spesifikasi: 'Mercedes-AMG V12 Twin-Turbo | 850 HP | 1100 Nm | Extreme Ground Effect Aero | Limited 8 Units',
    deskripsi: 'Laboratorium berjalan Pagani yang diuji di Sirkuit Imola dengan downforce ekstrem dan teknologi suspensi aktif tercanggih.',
    stok: 1,
    gambar_utama: 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?auto=format&fit=crop&w=800&q=80'
  },

  // ── KOENIGSEGG (kategori_id: 3) ──
  {
    id: 3,
    kategori_id: 3,
    brand: 'Koenigsegg',
    model: 'Jesko Absolut',
    tahun: 2025,
    harga_otr: 65000000000,
    spesifikasi: 'V8 5.0L Twin-Turbo | 1600 HP (E85) | Top Speed: 500+ km/h | LST 9-Speed (Light Speed Transmission)',
    deskripsi: 'Megacar tercepat dari Swedia dengan transmisi 9-percepatan LST (Light Speed Transmission).',
    stok: 1,
    gambar_utama: 'assets/images/cars/koenigsegg_jesko_absolut.jpg'
  },
  {
    id: 20,
    kategori_id: 3,
    brand: 'Koenigsegg',
    model: 'Gemera 4-Seater Megacar',
    tahun: 2025,
    harga_otr: 48000000000,
    spesifikasi: 'HV8 5.0L Twin-Turbo Hybrid | 2300 HP | 2750 Nm | 4-Seater Mega-GT | All-Wheel Drive & Steering',
    deskripsi: 'Megacar 4 penumpang pertama di dunia dengan pintu dihedral autoskin dan tenaga fantastis 2300 horsepower.',
    stok: 2,
    gambar_utama: 'https://images.unsplash.com/photo-1616782298751-24bb688e1462?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 21,
    kategori_id: 3,
    brand: 'Koenigsegg',
    model: 'CC850 ESS Shift by Wire',
    tahun: 2025,
    harga_otr: 62000000000,
    spesifikasi: 'V8 5.0L Twin-Turbo | 1385 HP | 1385 kg (1:1 Ratio) | Engage Shift System (ESS) Dual-Mode Gated Manual',
    deskripsi: 'Penghormatan 20 tahun CC8S dengan teknologi revolusioner transmisi manual simulasi dengan kopling fisik asli.',
    stok: 1,
    gambar_utama: 'https://images.unsplash.com/photo-1608821946397-f6556156cebb?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 22,
    kategori_id: 3,
    brand: 'Koenigsegg',
    model: 'Jesko Attack High-Downforce',
    tahun: 2025,
    harga_otr: 63000000000,
    spesifikasi: 'V8 5.0L Twin-Turbo | 1600 HP | 1400 kg Downforce | Active Rear Wing | Triplex Damper Suspension',
    deskripsi: 'Varian Jesko yang dioptimalkan untuk lap time sirkuit dengan sayap ganda raksasa dan triplex damper suspension.',
    stok: 1,
    gambar_utama: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 23,
    kategori_id: 3,
    brand: 'Koenigsegg',
    model: 'Regera DirectDrive Ghost',
    tahun: 2024,
    harga_otr: 45000000000,
    spesifikasi: 'V8 5.0L Twin-Turbo + Direct Drive | 1500 HP | 2000 Nm | 0-400-0 km/h: 28.8s | Autoskin Hydraulic Doors',
    deskripsi: 'Megacar revolusioner tanpa gearbox (Koenigsegg Direct Drive) dengan sistem hidrolik robotik Autoskin di seluruh pintu.',
    stok: 1,
    gambar_utama: 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80'
  },

  // ── FERRARI (kategori_id: 4) ──
  {
    id: 4,
    kategori_id: 4,
    brand: 'Ferrari',
    model: 'SF90 Stradale Assetto Fiorano',
    tahun: 2025,
    harga_otr: 18500000000,
    spesifikasi: 'V8 4.0L Twin-Turbo Plug-in Hybrid | 986 HP | 0-100 km/h: 2.5s | Top Speed: 340 km/h | eAWD System',
    deskripsi: 'Hypercar hybrid buatan Maranello dengan akselerasi instan dan downforce tingkat balap balap Formula 1.',
    stok: 1,
    gambar_utama: 'assets/images/ferrari_sf90.jpg'
  },
  {
    id: 24,
    kategori_id: 4,
    brand: 'Ferrari',
    model: 'Purosangue SUV V12',
    tahun: 2026,
    harga_otr: 25900000000,
    spesifikasi: 'V12 6.5L Naturally Aspirated | 715 HP | 716 Nm | 0-100 km/h: 3.3s | Multimatic Active Suspension',
    deskripsi: 'SUV empat pintu pertama dalam sejarah Ferrari dengan mesin naturally aspirated V12 murni dan suspensi aktif Multimatic.',
    stok: 2,
    gambar_utama: 'https://images.unsplash.com/photo-1632245889029-e406faaa34cd?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 25,
    kategori_id: 4,
    brand: 'Ferrari',
    model: '296 GTB Assetto Fiorano',
    tahun: 2025,
    harga_otr: 14200000000,
    spesifikasi: 'V6 3.0L 120° Twin-Turbo PHEV | 819 HP | 740 Nm | 0-100 km/h: 2.9s | Top Speed: 330 km/h',
    deskripsi: 'Piccolo V12 berlinetta bermesin tengah dengan efisiensi plug-in hybrid dan kelincahan berkendara legendaris.',
    stok: 2,
    gambar_utama: 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 26,
    kategori_id: 4,
    brand: 'Ferrari',
    model: '812 Competizione V12',
    tahun: 2024,
    harga_otr: 22000000000,
    spesifikasi: 'V12 6.5L Naturally Aspirated | 819 HP | 9500 RPM | Independent 4-Wheel Steering | Carbon Wheels',
    deskripsi: 'Edisi terbatas front-mid V12 paling bertenaga yang pernah dibuat di Maranello dengan putaran mesin hingga 9.500 RPM.',
    stok: 1,
    gambar_utama: 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 27,
    kategori_id: 4,
    brand: 'Ferrari',
    model: 'Roma Spider Dolce Vita',
    tahun: 2025,
    harga_otr: 11800000000,
    spesifikasi: 'V8 3.9L Twin-Turbo | 612 HP | 760 Nm | 0-100 km/h: 3.4s | Soft-Top Convertible 5-Layer Fabric',
    deskripsi: 'Kembalinya era La Nuova Dolce Vita dengan atap kain elegan 5 lapis yang dapat dibuka dalam 13.5 detik pada kecepatan 60 km/h.',
    stok: 2,
    gambar_utama: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=800&q=80'
  },

  // ── LAMBORGHINI (kategori_id: 5) ──
  {
    id: 5,
    kategori_id: 5,
    brand: 'Lamborghini',
    model: 'Revuelto V12 Hybrid',
    tahun: 2026,
    harga_otr: 21000000000,
    spesifikasi: 'V12 6.5L Naturally Aspirated + 3 Electric Motors | 1001 HP | 0-100 km/h: 2.5s | Monofuselage Carbon',
    deskripsi: 'Supercar V12 hybrid pertama dari Sant\'Agata Bolognese. Desain futuristik dengan performa tanpa batas.',
    stok: 1,
    gambar_utama: 'assets/images/lamborghini_revuelto.jpg'
  },
  {
    id: 28,
    kategori_id: 5,
    brand: 'Lamborghini',
    model: 'Urus Performante Super SUV',
    tahun: 2025,
    harga_otr: 13800000000,
    spesifikasi: 'V8 4.0L Twin-Turbo | 657 HP | 850 Nm | 0-100 km/h: 3.3s | Akrapovic Titanium Exhaust | Rally Mode',
    deskripsi: 'Super SUV pemecah rekor Pikes Peak dengan kap mesin serat karbon, knalpot titanium Akrapovic, dan mode berkendara Rally.',
    stok: 2,
    gambar_utama: 'https://images.unsplash.com/photo-1544829099-b9a0c07fad1a?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 29,
    kategori_id: 5,
    brand: 'Lamborghini',
    model: 'Huracán STO Super Trofeo',
    tahun: 2024,
    harga_otr: 14500000000,
    spesifikasi: 'V10 5.2L Naturally Aspirated | 631 HP | 565 Nm | RWD | Cofango One-Piece Hood | 75% Carbon Fiber',
    deskripsi: 'Mobil balap homologasi jalan raya dengan bodi 75% serat karbon dan pendinginan aerodinamika Squadra Corse.',
    stok: 1,
    gambar_utama: 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 30,
    kategori_id: 5,
    brand: 'Lamborghini',
    model: 'Temerario V8 Twin-Turbo',
    tahun: 2026,
    harga_otr: 17500000000,
    spesifikasi: 'V8 4.0L Twin-Turbo + 3 Motors | 907 HP | 10000 RPM Redline | High-Revving Flat-Plane Crank',
    deskripsi: 'Penerus resmi Huracán dengan mesin flat-plane crank baru yang sanggup berputar hingga 10.000 RPM fantastis.',
    stok: 2,
    gambar_utama: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 31,
    kategori_id: 5,
    brand: 'Lamborghini',
    model: 'Sián FKP 37 Roadster',
    tahun: 2024,
    harga_otr: 42000000000,
    spesifikasi: 'V12 6.5L + Supercapacitor Hybrid | 808 HP | 0-100 km/h: 2.8s | 1 of 19 Worldwide | Terzo Millennio Aero',
    deskripsi: 'Hypercar superkapasitor pertama di dunia berdesain radikal Terzo Millennio. Hanya diproduksi 19 unit di seluruh dunia.',
    stok: 1,
    gambar_utama: 'https://images.unsplash.com/photo-1608821946397-f6556156cebb?auto=format&fit=crop&w=800&q=80'
  },

  // ── MERCEDES (kategori_id: 6) ──
  {
    id: 6,
    kategori_id: 6,
    brand: 'Mercedes',
    model: 'AMG GT Black Series',
    tahun: 2024,
    harga_otr: 15000000000,
    spesifikasi: 'V8 4.0L Biturbo Flat-Plane | 720 HP | 800 Nm | 0-100 km/h: 3.2s | Nurburgring Record King',
    deskripsi: 'Supercar track-focused dari Affalterbach dengan aerodinamika agresif dan mesin flat-plane crank buas.',
    stok: 1,
    gambar_utama: 'assets/images/cars/mercedes_amg_gt_black_series.jpg'
  },
  {
    id: 32,
    kategori_id: 6,
    brand: 'Mercedes',
    model: 'Maybach S-Class S680 V12',
    tahun: 2025,
    harga_otr: 9800000000,
    spesifikasi: 'V12 6.0L Biturbo | 621 HP | 900 Nm | 4MATIC | Burmester 4D Audio | First-Class Rear Suite',
    deskripsi: 'Puncak kemewahan sedan eksekutif Jerman dengan cat two-tone artisan, sistem audio Burmester 4D, dan pintu belakang elektrik.',
    stok: 2,
    gambar_utama: 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 33,
    kategori_id: 6,
    brand: 'Mercedes',
    model: 'AMG G 63 4x4² Squared',
    tahun: 2025,
    harga_otr: 12500000000,
    spesifikasi: 'V8 4.0L Biturbo | 577 HP | 850 Nm | Portal Axles | Ground Clearance 351mm | 22" Forged Wheels',
    deskripsi: 'SUV segala medan paling perkasa dengan gardan portal tinggi, velg forged 22 inci, dan kemampuan menerjang banjir 91 cm.',
    stok: 2,
    gambar_utama: 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 34,
    kategori_id: 6,
    brand: 'Mercedes',
    model: 'AMG SL 63 4MATIC+ Roadster',
    tahun: 2025,
    harga_otr: 7900000000,
    spesifikasi: 'V8 4.0L Biturbo | 577 HP | 800 Nm | 0-100 km/h: 3.6s | Composite Aluminum Chassis | 2+2 Seats',
    deskripsi: 'Roadster sport ikonik generasi terbaru dengan arsitektur komposit aluminium ringan dan sistem all-wheel drive cerdas.',
    stok: 3,
    gambar_utama: 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 35,
    kategori_id: 6,
    brand: 'Mercedes',
    model: 'AMG ONE Formula 1 Hypercar',
    tahun: 2025,
    harga_otr: 55000000000,
    spesifikasi: 'V6 1.6L Turbo F1 + 4 Electric Motors | 1049 HP | 11000 RPM Redline | Mercedes-AMG Petronas F1 Tech',
    deskripsi: 'Hypercar sejati bermesin Formula 1 langsung dari tim Mercedes-AMG Petronas F1 dengan rekor lap time Nürburgring Nordschleife.',
    stok: 1,
    gambar_utama: 'https://images.unsplash.com/photo-1608821946397-f6556156cebb?auto=format&fit=crop&w=800&q=80'
  },

  // ── ROLLS-ROYCE (kategori_id: 7) ──
  {
    id: 7,
    kategori_id: 7,
    brand: 'Rolls-Royce',
    model: 'Phantom VIII Extended',
    tahun: 2025,
    harga_otr: 24500000000,
    spesifikasi: 'V12 6.75L Twin-Turbo | 563 HP | 900 Nm | 0-100 km/h: 5.4s | Starlight Headliner | Whisper Quiet Cabin',
    deskripsi: 'Standard emas kemewahan dunia otomotif. Menyajikan kenyamanan tiada tanding dengan peredaman suara kabin tingkat tertinggi.',
    stok: 2,
    gambar_utama: 'assets/images/rolls_royce_phantom.jpg'
  },
  {
    id: 36,
    kategori_id: 7,
    brand: 'Rolls-Royce',
    model: 'Cullinan Black Badge SUV',
    tahun: 2026,
    harga_otr: 32000000000,
    spesifikasi: 'V12 6.75L Twin-Turbo | 600 HP | 900 Nm | Air Suspension | Viewing Suite Luggage Seats | All-Wheel Drive',
    deskripsi: 'SUV termewah di dunia dengan paket Black Badge berkarakter misterius, kursi Viewing Suite di bagasi, dan Starlight roof.',
    stok: 1,
    gambar_utama: 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 37,
    kategori_id: 7,
    brand: 'Rolls-Royce',
    model: 'Spectre Electric Coupé',
    tahun: 2025,
    harga_otr: 21000000000,
    spesifikasi: 'Dual Electric Motors | 577 HP | 900 Nm | 0-100 km/h: 4.5s | Drag Coeff 0.25cd | Illuminated Fascia 5500 Stars',
    deskripsi: 'Super-coupe listrik ultra-mewah pertama Rolls-Royce dengan koefisien drag 0.25cd dan Illuminated Fascia berisi 5.500 bintang.',
    stok: 2,
    gambar_utama: 'https://images.unsplash.com/photo-1508210331008-5d2bc5038c64?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 38,
    kategori_id: 7,
    brand: 'Rolls-Royce',
    model: 'Ghost Extended Series II',
    tahun: 2025,
    harga_otr: 19500000000,
    spesifikasi: 'V12 6.75L Twin-Turbo | 563 HP | 850 Nm | Planar Suspension System | Post-Opulence Pure Architecture',
    deskripsi: 'Sedan kemewahan modern dengan filosofi Post-Opulence, pintu buka tutup otomatis elektrik, dan peredam suspensi wishbone atas.',
    stok: 2,
    gambar_utama: 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 39,
    kategori_id: 7,
    brand: 'Rolls-Royce',
    model: 'Dawn Black Badge Convertible',
    tahun: 2024,
    harga_otr: 23000000000,
    spesifikasi: 'V12 6.6L Twin-Turbo | 593 HP | 840 Nm | The Silent Drophead Tourer | Acoustic French-Seam Soft Top',
    deskripsi: 'Konvertibel paling senyap di dunia saat atap ditutup, menyajikan kenikmatan berkendara grand touring tanpa gangguan suara angin.',
    stok: 1,
    gambar_utama: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=800&q=80'
  },

  // ── MCLAREN (kategori_id: 8) ──
  {
    id: 8,
    kategori_id: 8,
    brand: 'McLaren',
    model: '750S Spider',
    tahun: 2025,
    harga_otr: 15300000000,
    spesifikasi: 'V8 4.0L Twin-Turbo | 750 HP | 800 Nm | 0-100 km/h: 2.8s | Top Speed: 331 km/h | Carbon MonoCell III',
    deskripsi: 'Convertible supercar dengan chassis serat karbon MonoCell III. Atap folding elektrik dalam 11 detik tanpa mengorbankan kekakuan.',
    stok: 2,
    gambar_utama: 'assets/images/cars/mclaren_750s_spider.jpg'
  },
  {
    id: 40,
    kategori_id: 8,
    brand: 'McLaren',
    model: 'Senna Ultimate Track-Weapon',
    tahun: 2024,
    harga_otr: 32000000000,
    spesifikasi: 'V8 4.0L Twin-Turbo | 789 HP | 800 Nm | 800 kg Downforce | Carbon MonoCage III | 1 of 500 Worldwide',
    deskripsi: 'Dinamai untuk mengenang legenda F1 Ayrton Senna. Fokus mutlak pada lap time tercepat tanpa kompromi.',
    stok: 1,
    gambar_utama: 'https://images.unsplash.com/photo-1609521263047-f8f205293f24?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 41,
    kategori_id: 8,
    brand: 'McLaren',
    model: 'Artura Spider High-Perf Hybrid',
    tahun: 2025,
    harga_otr: 11500000000,
    spesifikasi: 'V6 3.0L 120° Twin-Turbo PHEV | 690 HP | 720 Nm | 0-100 km/h: 3.0s | Carbon Lightweight Architecture MCLA',
    deskripsi: 'High-performance hybrid convertible pertama McLaren dengan handling presisi dan bobot paling ringan di kelasnya.',
    stok: 2,
    gambar_utama: 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 42,
    kategori_id: 8,
    brand: 'McLaren',
    model: '765LT Longtail Coupe',
    tahun: 2024,
    harga_otr: 18800000000,
    spesifikasi: 'V8 4.0L Twin-Turbo | 755 HP | 800 Nm | 0-100 km/h: 2.7s | Quad Titanium Exhaust | Active Longtail Wing',
    deskripsi: 'Edisi Longtail legendaris dengan bobot terpangkas 80 kg, rasio transmisi balap lebih rapat, dan sayap aktif Longtail khas Woking.',
    stok: 1,
    gambar_utama: 'https://images.unsplash.com/photo-1544829099-b9a0c07fad1a?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 43,
    kategori_id: 8,
    brand: 'McLaren',
    model: 'GT Luxe Grand Tourer',
    tahun: 2025,
    harga_otr: 9500000000,
    spesifikasi: 'V8 4.0L Twin-Turbo | 612 HP | 630 Nm | Proactive Damping Control | 570L Cargo Space | Nappa Leather Interior',
    deskripsi: 'Supercar harian dengan ruang kargo bagasi berlapis kulit terluas di kelasnya, memadukan performa McLaren dengan kenyamanan touring.',
    stok: 3,
    gambar_utama: 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?auto=format&fit=crop&w=800&q=80'
  },

  // ── PORSCHE (kategori_id: 9) ──
  {
    id: 9,
    kategori_id: 9,
    brand: 'Porsche',
    model: '911 GT3 RS (992)',
    tahun: 2025,
    harga_otr: 11200000000,
    spesifikasi: 'Flat-6 4.0L NA | 518 HP | 9,000 RPM Redline | DRS Aero Wing | PDK 7-Speed | Carbon Door & Fenders',
    deskripsi: 'Mobil balap sirkuit yang legal digunakan di jalan raya. Dilengkapi sistem aerodinamika aktif DRS.',
    stok: 3,
    gambar_utama: 'assets/images/porsche_911_gt3.jpg'
  },
  {
    id: 44,
    kategori_id: 9,
    brand: 'Porsche',
    model: '911 Turbo S Coupe (992)',
    tahun: 2025,
    harga_otr: 12800000000,
    spesifikasi: 'Boxer-6 3.8L Twin-Turbo | 640 HP | 800 Nm | 0-100 km/h: 2.6s | All-Wheel Drive | Ceramic Composite Brakes PCCB',
    deskripsi: 'Tolok ukur performa supercar harian di dunia. Akselerasi roket dari diam dengan stabilitas traksi all-wheel drive tanpa cela.',
    stok: 2,
    gambar_utama: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 45,
    kategori_id: 9,
    brand: 'Porsche',
    model: 'Taycan Turbo GT Weissach',
    tahun: 2025,
    harga_otr: 10500000000,
    spesifikasi: 'Dual Electric Motors | 1092 HP Attack Mode | 1340 Nm | 0-100 km/h: 2.2s | Carbon Aerokit | EV Nurburgring King',
    deskripsi: 'Mobil listrik 4-pintu tercepat di Nürburgring dan Laguna Seca dengan paket Weissach aerodinamika karbon ultra-ringan.',
    stok: 2,
    gambar_utama: 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 46,
    kategori_id: 9,
    brand: 'Porsche',
    model: '718 Cayman GT4 RS Mid-Engine',
    tahun: 2024,
    harga_otr: 8900000000,
    spesifikasi: 'Mid-Engine Flat-6 4.0L NA | 493 HP | 9000 RPM | Air Intake Side Windows | Titanium Rollcage Option',
    deskripsi: 'Coupe bermesin tengah dengan intake udara tepat di samping telinga pengemudi, menghasilkan sensasi akustik mekanis tak tertandingi.',
    stok: 2,
    gambar_utama: 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 47,
    kategori_id: 9,
    brand: 'Porsche',
    model: 'Cayenne Turbo E-Hybrid GT',
    tahun: 2025,
    harga_otr: 9400000000,
    spesifikasi: 'V8 4.0L Twin-Turbo PHEV | 729 HP | 950 Nm | 0-100 km/h: 3.6s | Ceramic Brakes | Titanium Center Exhaust',
    deskripsi: 'SUV terkuat yang pernah diproduksi Porsche dengan paduan mesin V8 biturbo dan motor listrik bertenaga buas.',
    stok: 2,
    gambar_utama: 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?auto=format&fit=crop&w=800&q=80'
  },

  // ── ASTON MARTIN (kategori_id: 10) ──
  {
    id: 10,
    kategori_id: 10,
    brand: 'Aston Martin',
    model: 'DB12 Volante Super Tourer',
    tahun: 2026,
    harga_otr: 13500000000,
    spesifikasi: 'V8 4.0L Twin-Turbo | 671 HP | 800 Nm | 0-100 km/h: 3.6s | Top Speed: 325 km/h | K-Fold Roof in 14s',
    deskripsi: 'Gran Tourer konvertibel ikonik dari Gaydon. Dikenal sebagai The World\'s Most Beautiful Grand Tourer dengan kemewahan interior bespoke.',
    stok: 2,
    gambar_utama: 'assets/images/cars/aston_martin_db12_volante.jpg'
  },
  {
    id: 48,
    kategori_id: 10,
    brand: 'Aston Martin',
    model: 'Valkyrie Adrian Newey Hypercar',
    tahun: 2024,
    harga_otr: 52000000000,
    spesifikasi: 'Cosworth V12 6.5L NA + Rimac KERS | 1140 HP | 11100 RPM Redline | Full Venturi Tunnel Underfloor Ground Effect',
    deskripsi: 'Mahakarya aerodinamika dari desainer F1 Adrian Newey. Mesin V12 Cosworth paling tinggi putarannya di dunia untuk mobil jalan raya.',
    stok: 1,
    gambar_utama: 'https://images.unsplash.com/photo-1608821946397-f6556156cebb?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 49,
    kategori_id: 10,
    brand: 'Aston Martin',
    model: 'DBX707 High-Output Luxury SUV',
    tahun: 2025,
    harga_otr: 11200000000,
    spesifikasi: 'V8 4.0L Twin-Turbo | 697 HP (707 PS) | 900 Nm | 0-100 km/h: 3.3s | Wet-Clutch 9-Speed | Carbon Ceramic Brakes',
    deskripsi: 'Salah satu SUV termewah dan terkencang di dunia dengan rem Carbon Ceramic standar dan interior bespoke Q by Aston Martin.',
    stok: 2,
    gambar_utama: 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 50,
    kategori_id: 10,
    brand: 'Aston Martin',
    model: 'Vantage F1 Edition Aero',
    tahun: 2025,
    harga_otr: 8800000000,
    spesifikasi: 'V8 4.0L Twin-Turbo | 528 HP | 685 Nm | Official FIA F1 Safety Car Dynamics | Full Aero Kit 200kg Downforce',
    deskripsi: 'Edisi spesial yang dikembangkan langsung dari Safety Car Formula 1 resmi dengan sasis lebih kaku dan sayap aerodinamika balap.',
    stok: 2,
    gambar_utama: 'https://images.unsplash.com/photo-1563720223185-11003d516935?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 51,
    kategori_id: 10,
    brand: 'Aston Martin',
    model: 'DBS 770 Ultimate Coupe',
    tahun: 2024,
    harga_otr: 16500000000,
    spesifikasi: 'V12 5.2L Twin-Turbo | 759 HP (770 PS) | 900 Nm | Top Speed: 340 km/h | 1 of 300 Worldwide | Horseshoe Hood Vent',
    deskripsi: 'Perpisahan paling megah untuk generasi DBS V12. Diproduksi terbatas dengan kap mesin clashing horseshoe dan interior sports plus.',
    stok: 1,
    gambar_utama: 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80'
  },

  // ── BENTLEY (kategori_id: 11) ──
  {
    id: 11,
    kategori_id: 11,
    brand: 'Bentley',
    model: 'Continental GT Speed W12',
    tahun: 2025,
    harga_otr: 16800000000,
    spesifikasi: 'W12 6.0L Twin-Turbo | 659 HP | 900 Nm | 0-100 km/h: 3.6s | Top Speed: 335 km/h | Electronic All-Wheel Steering',
    deskripsi: 'Grand tourer terkencang Bentley sepanjang masa. Memadukan kemewahan hand-crafted interior dengan performa supercar kelas dunia.',
    stok: 2,
    gambar_utama: 'assets/images/cars/bentley_continental_gt_speed_w12.jpg'
  },
  {
    id: 52,
    kategori_id: 11,
    brand: 'Bentley',
    model: 'Bentayga EWB Azure Airline Seat',
    tahun: 2025,
    harga_otr: 14500000000,
    spesifikasi: 'V8 4.0L Twin-Turbo | 542 HP | 770 Nm | Airline Seat Specification | 22-Way Adjustment & Postural Massage',
    deskripsi: 'SUV ultra-mewah dengan kabin belakang terlapang di kelasnya, kursi Airline Seat dengan 22 pengaturan dan deteksi postural otomatis.',
    stok: 2,
    gambar_utama: 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 53,
    kategori_id: 11,
    brand: 'Bentley',
    model: 'Flying Spur Mulliner W12',
    tahun: 2025,
    harga_otr: 17900000000,
    spesifikasi: 'W12 6.0L Twin-Turbo | 626 HP | 900 Nm | Mulliner Diamond-in-Diamond Quilting | Illuminated Flying B Mascot',
    deskripsi: 'Sedan flagship 4 pintu karya divisi bespoke Mulliner di Crewe. Menghadirkan trim kayu walnut langka dan emblem Flying B bercahaya.',
    stok: 2,
    gambar_utama: 'https://images.unsplash.com/photo-1580274455191-1c62238fa333?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 54,
    kategori_id: 11,
    brand: 'Bentley',
    model: 'Batur Coachbuilt by Mulliner',
    tahun: 2025,
    harga_otr: 38000000000,
    spesifikasi: 'W12 6.0L Twin-Turbo Hand-Built | 740 HP | 1000 Nm | 1 of 18 Worldwide | 3D-Printed 18K Gold Interior Accents',
    deskripsi: 'Karya seni coachbuilt bespoke Mulliner hanya 18 unit di dunia dengan tombol instrumen emas murni 18 karat cetak 3D.',
    stok: 1,
    gambar_utama: 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 55,
    kategori_id: 11,
    brand: 'Bentley',
    model: 'Continental GTC V8 S Convertible',
    tahun: 2025,
    harga_otr: 13900000000,
    spesifikasi: 'V8 4.0L Twin-Turbo | 542 HP | 770 Nm | Sport Exhaust with Dark Tint Quads | 48V Active Anti-Roll Dynamic Ride',
    deskripsi: 'Grand tourer atap terbuka dengan raungan knalpot V8 sporty, velg 22 inci black polished, dan suspensi udara dinamis 48V.',
    stok: 2,
    gambar_utama: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=800&q=80'
  }
];

let testDriveBookings = [
  { id: 'BK-1092', mobil_name: 'Ferrari SF90 Stradale', nama: 'Budi Santoso', kontak: '081299887766', tanggal: '2026-10-05', jam: '14:00 WIB', status: 'confirmed' },
  { id: 'BK-1104', mobil_name: 'Rolls-Royce Phantom VIII', nama: 'Dra. Hendra Syahputra', kontak: '081122334455', tanggal: '2026-10-06', jam: '11:00 WIB', status: 'pending' }
];

let vipReservations = [
  { id: 'VIP-402', nama: 'Ir. Ahmad Wijaya', kontak: '081877665544', mobil_name: 'Lamborghini Revuelto', catatan: 'Meminta inspeksi privat di showroom malam hari.', status: 'pending' }
];

let urlParams = new URLSearchParams(window.location.search);
let selectedBrand = urlParams.get('brand') || 'All';
let searchQuery = urlParams.get('search') || '';
let selectedYear = 'All';
let selectedPrice = 'All';
let selectedSort = 'default';

let selectedTenor = 36; // Default 36 months
let currentCalcCar = null;

// Format Currency IDR
function formatIDR(number) {
  return new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    maximumFractionDigits: 0
  }).format(number);
}

// ── USER AUTH SYSTEM ──
let toastTimeout;
function showToast(message) {
  const toast = document.getElementById('customToast');
  const toastMsg = document.getElementById('customToastMessage');
  if (!toast || !toastMsg) return;
  
  toastMsg.innerText = message;
  toast.classList.add('show');
  
  clearTimeout(toastTimeout);
  toastTimeout = setTimeout(() => {
    toast.classList.remove('show');
  }, 4000);
}

function getLoggedInUser() {
  try {
    const data = localStorage.getItem('pcsUser');
    if (!data) return null;
    const user = JSON.parse(data);
    if (!user || typeof user !== 'object') return null;
    if (!user.phone) {
      user.phone = user.no_telepon || (user.email === 'user@luxury.com' ? '081299887766' : '081299887766');
    }
    return user;
  } catch (e) {
    console.warn('[PCS] Error reading user session:', e);
    return null;
  }
}

function isUserLoggedIn() {
  return getLoggedInUser() !== null;
}

function updateNavbarAuth() {
  const user = getLoggedInUser();
  const btnLogin = document.getElementById('navBtnLogin');
  const divLoggedIn = document.getElementById('navUserLoggedIn');
  const navUserName = document.getElementById('navUserName');
  const navPortalLink = document.getElementById('navPortalLink');
  const navMyBookingsBtn = document.getElementById('navMyBookingsBtn');
  const desktopSearch = document.querySelector('.search-bar.desktop-search');

  if (!btnLogin || !divLoggedIn) return;

  if (user) {
    btnLogin.style.display = 'none';
    divLoggedIn.style.display = 'flex';
    // Hide desktop search to free navbar space when logged in
    if (desktopSearch) desktopSearch.style.display = 'none';
    
    const roleTag = user.role ? ` [${user.role.toUpperCase()}]` : '';
    const shortName = user.nama ? user.nama.replace(/\s*\([^)]*\)/g, '').trim().split(' ')[0] : '';
    if (navUserName) navUserName.innerText = `${shortName}${roleTag}`;

    // Show Management Portal button for Admin, Sales, Owner
    if (navPortalLink) {
      if (user.role === 'admin' || user.role === 'sales' || user.role === 'owner') {
        navPortalLink.style.display = 'inline-flex';
        navPortalLink.innerText = (user.role === 'owner') ? 'Portal Owner' : (user.role === 'sales' ? 'Portal Sales' : 'Portal Manajemen');
      } else {
        navPortalLink.style.display = 'none';
      }
    }

    // Show My Bookings button for Customer
    if (navMyBookingsBtn) {
      navMyBookingsBtn.style.display = (user.role === 'user' || !user.role) ? 'inline-flex' : 'none';
    }
  } else {
    btnLogin.style.display = '';
    divLoggedIn.style.display = 'none';
    if (navPortalLink) navPortalLink.style.display = 'none';
    if (navMyBookingsBtn) navMyBookingsBtn.style.display = 'none';
    // Restore desktop search when logged out
    if (desktopSearch) desktopSearch.style.display = '';
  }
}

function requireLogin(actionCallback) {
  if (isUserLoggedIn()) {
    actionCallback();
  } else {
    openModal('loginModal');
  }
}

function handleUserLogin(e) {
  e.preventDefault();
  const email = document.getElementById('userLoginEmail').value.trim();
  const password = document.getElementById('userLoginPassword').value;
  const alertBox = document.getElementById('loginAlert');

  // RBAC Default Demo Accounts
  const demoAccounts = {
    'admin@luxury.com': { nama: 'Super Admin (Billie)', email: 'admin@luxury.com', role: 'admin', pass: 'admin123' },
    'admin':            { nama: 'Super Admin (Billie)', email: 'admin@luxury.com', role: 'admin', pass: 'admin' },
    'sales@luxury.com': { nama: 'Arya Pratama (Sales Rep)', email: 'sales@luxury.com', role: 'sales', pass: 'sales123' },
    'sales':            { nama: 'Arya Pratama (Sales Rep)', email: 'sales@luxury.com', role: 'sales', pass: 'sales' },
    'owner@luxury.com': { nama: 'Dra. Hendra Wijaya (Owner)', email: 'owner@luxury.com', role: 'owner', pass: 'owner123' },
    'owner':            { nama: 'Dra. Hendra Wijaya (Owner)', email: 'owner@luxury.com', role: 'owner', pass: 'owner' },
    'user@luxury.com':  { nama: 'Budi Santoso (Customer)', email: 'user@luxury.com', role: 'user', pass: 'user123' },
    'user':             { nama: 'Budi Santoso (Customer)', email: 'user@luxury.com', role: 'user', pass: 'user' }
  };

  if (demoAccounts[email] && (demoAccounts[email].pass === password || password === 'admin123')) {
    const matched = demoAccounts[email];
    localStorage.setItem('pcsUser', JSON.stringify({ nama: matched.nama, email: matched.email, role: matched.role }));
    if (matched.role === 'admin') localStorage.setItem('adminLoggedIn', 'true');
    alertBox.style.display = 'none';
    closeModal('loginModal');
    updateNavbarAuth();
    updateSidebarAuth();
    showToast(`Selamat datang, ${matched.nama} (${matched.role.toUpperCase()})`);
    if (matched.role === 'admin' || matched.role === 'sales' || matched.role === 'owner') {
      setTimeout(() => { window.location.href = 'dashboard.php'; }, 400);
    }
    return;
  }

  // Check registered users from localStorage
  const users = JSON.parse(localStorage.getItem('pcsUsers') || '[]');
  const found = users.find(u => u.email === email && u.password === password);

  if (found) {
    localStorage.setItem('pcsUser', JSON.stringify({ nama: found.nama, email: found.email, role: found.role || 'user' }));
    alertBox.style.display = 'none';
    closeModal('loginModal');
    updateNavbarAuth();
    updateSidebarAuth();
    showToast(`Selamat datang, ${found.nama}`);
  } else {
    alertBox.style.display = 'block';
    alertBox.innerText = 'Email atau password salah. Coba: admin@luxury.com / admin123 atau user@luxury.com / user123';
  }
}

function handleUserSignup(e) {
  e.preventDefault();
  const nama = document.getElementById('signupName').value.trim();
  const email = document.getElementById('signupEmail').value.trim();
  const password = document.getElementById('signupPassword').value;
  const alertBox = document.getElementById('signupAlert');

  const users = JSON.parse(localStorage.getItem('pcsUsers') || '[]');

  if (users.find(u => u.email === email)) {
    alertBox.style.display = 'block';
    alertBox.innerText = 'Email ini sudah terdaftar. Silakan login.';
    return;
  }

  users.push({ nama, email, password, role: 'user' });
  localStorage.setItem('pcsUsers', JSON.stringify(users));
  localStorage.setItem('pcsUser', JSON.stringify({ nama, email, role: 'user' }));

  alertBox.style.display = 'none';
  closeModal('signupModal');
  updateNavbarAuth();
  updateSidebarAuth();
  showToast(`Akun berhasil dibuat! Selamat datang, ${nama}`);
}

function userLogout() {
  localStorage.removeItem('pcsUser');
  localStorage.removeItem('adminLoggedIn');
  updateNavbarAuth();
  updateSidebarAuth();
  showToast('Anda telah logout.');
}

function submitContactForm(e) {
  e.preventDefault();
  const user = getLoggedInUser();
  if (!user) {
    showToast('Silakan login terlebih dahulu.');
    openModal('loginModal');
    return;
  }
  const messageEl = document.getElementById('bookingMessage');
  const message = messageEl ? messageEl.value.trim() : 'Konsultasi unit supercar';
  const car = currentCalcCar;
  const carName = car ? `${car.brand} ${car.model}` : 'Unit Supercar';
  const cleanName = (user.nama || '').replace(/\s*\([^)]*\)/g, '').trim();

  const ticketId = 'TKT-' + Math.floor(10000 + Math.random() * 90000);
  const messages = JSON.parse(localStorage.getItem('pcsContactMessages') || '[]');
  const newMsg = {
    id: ticketId,
    subject: `Konsultasi: ${carName}`,
    name: cleanName,
    email: user.email,
    phone: user.phone || user.no_telepon || '081299887766',
    message: message,
    status: 'open',
    reply: null,
    repliedAt: null,
    repliedBy: null,
    createdAt: new Date().toISOString()
  };
  messages.unshift(newMsg);
  localStorage.setItem('pcsContactMessages', JSON.stringify(messages));

  try {
    fetch('api.php?action=submit_contact_message', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(newMsg)
    });
  } catch (err) {}

  closeModal('bookingModal');
  showToast(`Pesan konsultasi ${ticketId} terkirim! Tim concierge kami akan merespons dalam 24 jam.`);
  setTimeout(() => {
    openMyBookingsModal('contact');
  }, 400);
}

// DOM Loaded Initialization
document.addEventListener('DOMContentLoaded', () => {
  fetchCars();
  initCalculator();
  setupEventListeners();
  updateAdminTables();
  updateNavbarAuth();
  ensureCustomerDataInitialized();
  
  // Sync search input with URL
  const searchInput = document.querySelector('.search-bar input');
  if (searchInput && searchQuery) {
    searchInput.value = searchQuery;
  }

  // Auto-open modals if requested via URL params or hash
  const openParam = (urlParams.get('open') || (window.location.hash ? window.location.hash.replace('#', '') : '')).toLowerCase();
  const carParam = urlParams.get('car_id');
  const carIdInt = carParam ? parseInt(carParam) : null;

  if (openParam === 'service') {
    setTimeout(() => openCustomerServiceModal(carIdInt), 350);
  } else if (openParam === 'insurance') {
    setTimeout(() => openInsuranceModal(carIdInt), 350);
  } else if (openParam === 'sell') {
    setTimeout(() => openSellCarModal(), 350);
  } else if (openParam === 'testdrive') {
    setTimeout(() => openTestDriveModal(carIdInt), 350);
  } else if (openParam === 'contact') {
    setTimeout(() => openContactUsModal(), 350);
  } else if (openParam === 'bookings' || openParam === 'activity') {
    setTimeout(() => openMyBookingsModal(), 350);
  }
});

// Fetch Cars from API or Local
async function fetchCars() {
  try {
    const response = await fetch('api.php?action=get_cars');
    const result = await response.json();
    if (result.status === 'success' && result.data.length > 0) {
      currentCars = result.data;
    }
  } catch (err) {
    console.log('Using local client cars data');
  }
  renderCatalog();
  populateCalculatorSelect();
}

// Render Catalog Cards
// Render Catalog Cards with Multi-Faceted Filters & Sorting
function renderCatalog() {
  const container = document.getElementById('catalogGrid');
  if (!container) return;

  let filtered = [...currentCars];
  
  // 1. Brand Filter
  if (selectedBrand !== 'All') {
    filtered = filtered.filter(c => c.brand.toLowerCase() === selectedBrand.toLowerCase());
  }
  
  // 2. Year Filter
  if (selectedYear !== 'All') {
    filtered = filtered.filter(c => String(c.tahun) === String(selectedYear));
  }

  // 3. Price Filter
  if (selectedPrice === 'under20') {
    filtered = filtered.filter(c => c.harga_otr < 20000000000);
  } else if (selectedPrice === '20to50') {
    filtered = filtered.filter(c => c.harga_otr >= 20000000000 && c.harga_otr <= 50000000000);
  } else if (selectedPrice === '50to75') {
    filtered = filtered.filter(c => c.harga_otr > 50000000000 && c.harga_otr <= 75000000000);
  } else if (selectedPrice === 'over75') {
    filtered = filtered.filter(c => c.harga_otr > 75000000000);
  }

  // 4. Search Filter
  if (searchQuery.trim() !== '') {
    const q = searchQuery.toLowerCase().trim();
    filtered = filtered.filter(c => 
      c.brand.toLowerCase().includes(q) || 
      c.model.toLowerCase().includes(q) ||
      String(c.tahun).includes(q)
    );
  }

  // 5. Sorting
  if (selectedSort === 'price-desc') {
    filtered.sort((a, b) => b.harga_otr - a.harga_otr);
  } else if (selectedSort === 'price-asc') {
    filtered.sort((a, b) => a.harga_otr - b.harga_otr);
  } else if (selectedSort === 'year-desc') {
    filtered.sort((a, b) => b.tahun - a.tahun);
  } else if (selectedSort === 'name-asc') {
    filtered.sort((a, b) => (a.brand + ' ' + a.model).localeCompare(b.brand + ' ' + b.model));
  }

  // ── Sync UI Indicators ──
  // 1. Dynamic Listing Count
  const listingCountEl = document.getElementById('listing-count');
  if (listingCountEl) {
    listingCountEl.textContent = `${filtered.length} listings`;
  }

  // 2. Dynamic Page Title
  const pageTitleEl = document.getElementById('page-title-heading');
  if (pageTitleEl) {
    pageTitleEl.textContent = selectedBrand !== 'All' ? `Luxury ${selectedBrand} Cars for Sale` : 'Luxury Cars for Sale';
  }

  // 3. Breadcrumb trail
  const breadcrumbBrand = document.getElementById('page-breadcrumb-brand');
  if (breadcrumbBrand) {
    breadcrumbBrand.innerHTML = selectedBrand !== 'All' ? ` &nbsp;/&nbsp; <span>${selectedBrand}</span>` : '';
  }

  // 4. Highlight active brand link in Subnav
  document.querySelectorAll('.subnav a').forEach(a => {
    try {
      const u = new URL(a.href, window.location.origin);
      const brandParam = u.searchParams.get('brand');
      if (brandParam && selectedBrand !== 'All' && brandParam.toLowerCase() === selectedBrand.toLowerCase()) {
        a.classList.add('active');
      } else {
        a.classList.remove('active');
      }
    } catch (e) {}
  });

  // 5. Update Filter Pill Labels & Active states
  const pillMakeText = document.getElementById('filterPillMakeText');
  const pillMake = document.getElementById('filterPillMake');
  if (pillMakeText) pillMakeText.textContent = selectedBrand !== 'All' ? `Make: ${selectedBrand}` : 'All Makes';
  if (pillMake) pillMake.classList.toggle('active', selectedBrand !== 'All');

  const pillYearText = document.getElementById('filterPillYearText');
  const pillYear = document.getElementById('filterPillYear');
  if (pillYearText) pillYearText.textContent = selectedYear !== 'All' ? `Year: ${selectedYear}` : 'Year';
  if (pillYear) pillYear.classList.toggle('active', selectedYear !== 'All');

  const pillPriceText = document.getElementById('filterPillPriceText');
  const pillPrice = document.getElementById('filterPillPrice');
  const priceLabels = {
    'under20': '< Rp 20 M',
    '20to50': 'Rp 20M - 50M',
    '50to75': 'Rp 50M - 75M',
    'over75': '> Rp 75 M'
  };
  if (pillPriceText) pillPriceText.textContent = selectedPrice !== 'All' ? `Price: ${priceLabels[selectedPrice] || selectedPrice}` : 'Price';
  if (pillPrice) pillPrice.classList.toggle('active', selectedPrice !== 'All');

  // 6. Reset Pill visibility
  const pillReset = document.getElementById('filterPillReset');
  if (pillReset) {
    const hasActiveFilters = (selectedBrand !== 'All' || selectedYear !== 'All' || selectedPrice !== 'All' || searchQuery.trim() !== '');
    pillReset.style.display = hasActiveFilters ? 'inline-flex' : 'none';
  }

  // 7. Sort text
  const sortCurrentText = document.getElementById('sortCurrentText');
  const sortLabels = {
    'default': 'Premium',
    'price-desc': 'Price: High to Low',
    'price-asc': 'Price: Low to High',
    'year-desc': 'Newest First',
    'name-asc': 'Brand A-Z'
  };
  if (sortCurrentText) sortCurrentText.textContent = sortLabels[selectedSort] || 'Premium';

  // ── Render Cards ──
  if (filtered.length === 0) {
    container.innerHTML = `
      <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px; color: var(--gray-500);">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom:12px; opacity:0.5;">
          <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <h3 style="font-family:var(--font-serif); font-size:1.25rem; margin-bottom:8px; color:var(--black);">No Vehicles Matching Criteria</h3>
        <p style="font-size:0.85rem; margin-bottom:20px;">Try adjusting your filters or search keywords.</p>
        <button class="btn-gold" onclick="resetAllFilters()" style="padding:8px 20px;">Reset All Filters</button>
      </div>`;
    return;
  }

  container.innerHTML = filtered.map(car => {
    const photoCount = Math.floor(Math.random() * 40) + 10;
    
    return `
    <div class="car-card fade-in" onclick="openDetailModal(${car.id})">
      <div class="car-card-img-wrap">
        <div class="card-badge">New 5 hours ago</div>
        <button class="card-favorite ${isFavorited(car.id) ? 'active' : ''}" onclick="event.stopPropagation(); toggleFavorite(${car.id}, this)">
          <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
        </button>
        <div class="card-photo-count">1/${photoCount}</div>
        <img src="${car.gambar_utama}" alt="${car.brand} ${car.model}" onerror="this.src='https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80'">
      </div>
      <div class="car-card-body">
        <div class="card-price-row">
          <div class="car-price">${formatIDR(car.harga_otr)}</div>
          <div style="display:flex; gap:6px;">
            <button class="card-contact-btn" style="padding:6px 10px; background:var(--off-white); border-color:var(--gray-300); color:var(--black);" title="Simulasi & Ajukan Asuransi" onclick="event.stopPropagation(); openInsuranceModal(${car.id})">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#b45309" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
              Insure
            </button>
            <button class="card-contact-btn" onclick="event.stopPropagation(); requireLogin(() => openBookingModal(${car.id}))">
              Contact 
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
            </button>
          </div>
        </div>
        <div class="car-title">${car.tahun} ${car.brand} ${car.model}</div>
        <div class="car-location">Jakarta, Indonesia</div>
      </div>
    </div>
  `}).join('');
}

// ── Dropdown & Filter Handlers ──
function toggleFilterMenu(e, menuId) {
  if (e) e.stopPropagation();
  const menu = document.getElementById(menuId);
  if (!menu) return;
  const isShown = menu.style.display === 'block';
  closeAllFilterMenus();
  if (!isShown) menu.style.display = 'block';
}

function closeAllFilterMenus() {
  document.querySelectorAll('.filter-dropdown-menu').forEach(m => m.style.display = 'none');
}

document.addEventListener('click', closeAllFilterMenus);

function setBrandFilter(brand) {
  closeAllFilterMenus();
  selectedBrand = brand;
  
  if (window.location.pathname.includes('cars.php')) {
    const newUrl = new URL(window.location);
    if (brand === 'All') newUrl.searchParams.delete('brand');
    else newUrl.searchParams.set('brand', brand);
    window.history.pushState({}, '', newUrl);
    renderCatalog();
  } else {
    window.location.href = brand === 'All' ? 'cars.php' : 'cars.php?brand=' + encodeURIComponent(brand);
  }
}

function setYearFilter(year) {
  closeAllFilterMenus();
  selectedYear = year;
  renderCatalog();
}

function setPriceFilter(price) {
  closeAllFilterMenus();
  selectedPrice = price;
  renderCatalog();
}

function setSortOption(sortKey) {
  closeAllFilterMenus();
  selectedSort = sortKey;
  renderCatalog();
}

function resetAllFilters() {
  closeAllFilterMenus();
  selectedBrand = 'All';
  selectedYear = 'All';
  selectedPrice = 'All';
  selectedSort = 'default';
  searchQuery = '';
  
  if (window.location.pathname.includes('cars.php')) {
    const newUrl = new URL(window.location);
    newUrl.searchParams.delete('brand');
    newUrl.searchParams.delete('search');
    window.history.pushState({}, '', newUrl);
  }
  
  const searchInput = document.querySelector('.search-bar input');
  if (searchInput) searchInput.value = '';
  
  renderCatalog();
}

// Filter Brand Handler (Legacy support)
function filterCategory(brand, btnElement = null) {
  setBrandFilter(brand);
}

// Calculator Logic (Activity Diagram 2)
function populateCalculatorSelect() {
  const select = document.getElementById('calcCarSelect');
  if (!select) return;

  select.innerHTML = currentCars.map(c => `
    <option value="${c.id}">${c.brand} ${c.model} - ${formatIDR(c.harga_otr)}</option>
  `).join('');

  if (currentCars.length > 0) {
    currentCalcCar = currentCars[0];
    calculateCredit();
  }
}

function initCalculator() {
  const calcDp = document.getElementById('calcDp');
  const calcTenor = document.getElementById('calcTenor');
  
  if (calcDp) {
    calcDp.addEventListener('input', (e) => {
      document.getElementById('dpValueDisplay').innerText = e.target.value + '%';
      calculateCredit();
    });
  }
  
  if (calcTenor) {
    calcTenor.addEventListener('change', (e) => {
      selectedTenor = parseInt(e.target.value);
      calculateCredit();
    });
  }
}

function calculateCredit() {
  if (!currentCalcCar) return;

  const hargaOTR = parseFloat(currentCalcCar.harga_otr);
  
  const dpInput = document.getElementById('calcDp');
  const dpPercent = dpInput ? parseFloat(dpInput.value) : 20;
  const nominalDP = (hargaOTR * dpPercent) / 100;
  const sisaPokok = hargaOTR - nominalDP;

  // Bunga Flat Rate 5.5% per tahun
  const interestRatePerYear = 0.055;
  const tenorYears = selectedTenor / 12;
  const totalBunga = sisaPokok * interestRatePerYear * tenorYears;
  const totalHutang = sisaPokok + totalBunga;
  const cicilanPerBulan = totalHutang / selectedTenor;

  const dpAmountDisplay = document.getElementById('dpAmountDisplay');
  const calcResult = document.getElementById('calcResult');
  
  if (dpAmountDisplay) dpAmountDisplay.innerText = formatIDR(nominalDP);
  if (calcResult) calcResult.innerText = formatIDR(cicilanPerBulan) + ' / mo';
}

// Redirect Credit Simulasi to VIP Consultation (Activity Diagram 2 Step)
function proceedToVIPFromCalc() {
  if (!currentCalcCar) return;
  const dpPercent = document.getElementById('dpRange').value;
  const cicilanText = document.getElementById('calcCicilanDisplay').innerText;
  
  const note = `Pengajuan Simulasi Kredit untuk unit ${currentCalcCar.brand} ${currentCalcCar.model} dengan DP ${dpPercent}% dan estimasi cicilan ${cicilanText} / bulan (${selectedTenor} Bulan).`;
  
  openVipModal(currentCalcCar.id, note);
}

// Modal Handlers
function openModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.add('active');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
  } else {
    console.error('[PCS] openModal: element not found -> #' + modalId);
  }
}

function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.remove('active');
    modal.style.display = 'none';
    document.body.style.overflow = '';
  }
}

// Contact Seller Modal (requires login)
function openBookingModal(carId) {
  if (!isUserLoggedIn()) {
    openModal('loginModal');
    return;
  }
  const user = getLoggedInUser();
  const userDisplay = document.getElementById('bookingUserDisplay');
  if (userDisplay) userDisplay.innerText = `${user.nama} (${user.email})`;
  openModal('bookingModal');
}

async function submitBookingForm(e) {
  e.preventDefault();
  const carId = document.getElementById('bookingCarId').value;
  const car = currentCars.find(c => c.id == carId);
  const nama = document.getElementById('bookingNama').value;
  const kontak = document.getElementById('bookingKontak').value;
  const tanggal = document.getElementById('bookingTanggal').value;
  const jam = document.getElementById('bookingJam').value;

  // Simulate Schedule Check (Activity Diagram 1 Decision Node)
  if (tanggal && jam === '10:00') {
    const alertBox = document.getElementById('bookingAlertBox');
    alertBox.style.display = 'flex';
    alertBox.className = 'alert-box alert-warning';
    alertBox.innerHTML = `âš ï¸ <strong>Jadwal Tidak Tersedia:</strong> Slot jam 10:00 pada tanggal tersebut penuh. Silakan pilih slot alternatif: <strong>13:00 WIB</strong> atau <strong>15:30 WIB</strong>.`;
    return;
  }

  const bookingId = 'BK-' + Math.floor(1000 + Math.random() * 9000);
  testDriveBookings.unshift({
    id: bookingId,
    mobil_name: `${car.brand} ${car.model}`,
    nama: nama,
    kontak: kontak,
    tanggal: tanggal,
    jam: jam,
    status: 'pending'
  });

  updateAdminTables();
  closeModal('bookingModal');

  // Show Success Receipt
  document.getElementById('receiptBookingId').innerText = bookingId;
  document.getElementById('receiptCarName').innerText = `${car.brand} ${car.model}`;
  document.getElementById('receiptDateTime').innerText = `${tanggal} @ ${jam}`;
  document.getElementById('receiptName').innerText = nama;
  openModal('bookingSuccessModal');
}

// Detail Specs Modal
function openDetailModal(carId) {
  const car = currentCars.find(c => c.id == carId);
  if (!car) return;

  // Set for calculator
  currentCalcCar = car;
  
  // Reset calculator defaults
  const calcDp = document.getElementById('calcDp');
  const calcTenor = document.getElementById('calcTenor');
  if (calcDp) {
    calcDp.value = 20;
    document.getElementById('dpValueDisplay').innerText = '20%';
  }
  if (calcTenor) {
    calcTenor.value = 36;
    selectedTenor = 36;
  }
  calculateCredit();

  document.getElementById('detailCarImg').src = car.gambar_utama;
  document.getElementById('detailCarTitle').innerText = `${car.brand} ${car.model}`;
  document.getElementById('detailCarPrice').innerText = formatIDR(car.harga_otr);
  document.getElementById('detailCarSpecs').innerText = car.spesifikasi;
  document.getElementById('detailCarDesc').innerText = car.deskripsi;
  
  const btnBooking = document.getElementById('detailCarBtnBooking');
  const btnVIP = document.getElementById('detailCarBtnVIP');
  const btnIns = document.getElementById('detailCarBtnInsurance');
  if (btnBooking) {
    btnBooking.onclick = () => {
      requireLogin(() => {
        closeModal('detailModal');
        openBookingModal(car.id);
      });
    };
  }
  if (btnVIP) {
    btnVIP.onclick = () => {
      requireLogin(() => {
        closeModal('detailModal');
        openBookingModal(car.id);
      });
    };
  }
  if (btnIns) {
    btnIns.onclick = () => {
      closeModal('detailModal');
      openInsuranceModal(car.id);
    };
  }

  openModal('detailModal');
}

// VIP Consultation Modal
function openVipModal(carId = null, prefilledNote = '') {
  document.getElementById('vipCarId').value = carId || '';
  if (prefilledNote) {
    document.getElementById('vipCatatan').value = prefilledNote;
  } else {
    document.getElementById('vipCatatan').value = '';
  }
  openModal('vipModal');
}

function submitVipForm(e) {
  e.preventDefault();
  const carId = document.getElementById('vipCarId').value;
  const car = currentCars.find(c => c.id == carId);
  const nama = document.getElementById('vipNama').value;
  const kontak = document.getElementById('vipKontak').value;
  const catatan = document.getElementById('vipCatatan').value;

  const vipId = 'VIP-' + Math.floor(100 + Math.random() * 900);
  vipReservations.unshift({
    id: vipId,
    nama: nama,
    kontak: kontak,
    mobil_name: car ? `${car.brand} ${car.model}` : 'Umum / All Units',
    catatan: catatan,
    status: 'pending'
  });

  updateAdminTables();
  closeModal('vipModal');
  alert(`Permintaan Reservasi VIP berhasil dikirim dengan ID: ${vipId}. Konsultan Executive kami akan segera menghubungi Anda.`);
}

// Admin Section & Tables
function updateAdminTables() {
  // 1. Table Mobil CRUD
  const tblMobil = document.getElementById('adminTblMobil');
  if (tblMobil) {
    tblMobil.innerHTML = currentCars.map(c => `
      <tr>
        <td>#${c.id}</td>
        <td><strong>${c.brand} ${c.model}</strong></td>
        <td>${c.tahun}</td>
        <td>${formatIDR(c.harga_otr)}</td>
        <td>${c.stok} Unit</td>
        <td>
          <button class="btn btn-glass btn-sm" onclick="editCar(${c.id})">Edit</button>
          <button class="btn btn-glass btn-sm" style="color:#ef4444;" onclick="deleteCar(${c.id})">Hapus</button>
        </td>
      </tr>
    `).join('');
  }

  // 2. Table Booking Test Drive
  const tblBooking = document.getElementById('adminTblBooking');
  if (tblBooking) {
    tblBooking.innerHTML = testDriveBookings.map(b => `
      <tr>
        <td><strong>${b.id}</strong></td>
        <td>${b.nama}<br><small style="color:var(--text-muted);">${b.kontak}</small></td>
        <td>${b.mobil_name}</td>
        <td>${b.tanggal}<br><small>${b.jam}</small></td>
        <td><span class="badge-status badge-${b.status}">${b.status}</span></td>
        <td>
          <button class="btn btn-glass btn-sm" onclick="changeBookingStatus('${b.id}', 'confirmed')">Approve</button>
          <button class="btn btn-glass btn-sm" onclick="changeBookingStatus('${b.id}', 'cancelled')">Cancel</button>
        </td>
      </tr>
    `).join('');
  }

  // 3. Table Reservasi VIP
  const tblVip = document.getElementById('adminTblVip');
  if (tblVip) {
    tblVip.innerHTML = vipReservations.map(v => `
      <tr>
        <td><strong>${v.id}</strong></td>
        <td>${v.nama}<br><small style="color:var(--text-muted);">${v.kontak}</small></td>
        <td>${v.mobil_name}</td>
        <td><small>${v.catatan || '-'}</small></td>
        <td><span class="badge-status badge-${v.status}">${v.status}</span></td>
        <td>
          <button class="btn btn-glass btn-sm" onclick="changeVipStatus('${v.id}', 'contacted')">Contacted</button>
        </td>
      </tr>
    `).join('');
  }
}

function switchAdminTab(tabName, btnElement) {
  document.querySelectorAll('.admin-tab-btn').forEach(b => b.classList.remove('active'));
  btnElement.classList.add('active');

  document.querySelectorAll('.admin-tab-content').forEach(c => c.style.display = 'none');
  document.getElementById(`tab-${tabName}`).style.display = 'block';
}

function handleAdminLogin(e) {
  e.preventDefault();
  const email = document.getElementById('adminEmail').value;
  const pass = document.getElementById('adminPassword').value;

  if (email === 'admin@luxury.com' && pass === 'admin123') {
    closeModal('loginModal');
    openModal('adminModal');
    updateAdminTables();
  } else {
    alert('Email atau Password Admin salah! (Gunakan email: admin@luxury.com / pass: admin123)');
  }
}

function changeBookingStatus(id, newStatus) {
  const item = testDriveBookings.find(b => b.id === id);
  if (item) {
    item.status = newStatus;
    updateAdminTables();
  }
}

function changeVipStatus(id, newStatus) {
  const item = vipReservations.find(v => v.id === id);
  if (item) {
    item.status = newStatus;
    updateAdminTables();
  }
}

function deleteCar(carId) {
  if (confirm('Apakah Anda yakin ingin menghapus mobil ini dari katalog?')) {
    currentCars = currentCars.filter(c => c.id !== carId);
    renderCatalog();
    populateCalculatorSelect();
    updateAdminTables();
  }
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

function saveCarForm(e) {
  e.preventDefault();
  const id = document.getElementById('carFormId').value;
  const brand = document.getElementById('carFormBrand').value;
  const model = document.getElementById('carFormModel').value;
  const tahun = parseInt(document.getElementById('carFormTahun').value);
  const harga = parseInt(document.getElementById('carFormHarga').value);
  const stok = parseInt(document.getElementById('carFormStok').value);
  const desc = document.getElementById('carFormDesc').value;

  if (id) {
    const car = currentCars.find(c => c.id == id);
    if (car) {
      car.brand = brand;
      car.model = model;
      car.tahun = tahun;
      car.harga_otr = harga;
      car.stok = stok;
      car.deskripsi = desc;
    }
  } else {
    const newCar = {
      id: currentCars.length + 1,
      kategori_id: 1,
      brand: brand,
      model: model,
      tahun: tahun,
      harga_otr: harga,
      spesifikasi: `${brand} ${model} Edition | Ultra Specs`,
      deskripsi: desc,
      stok: stok,
      gambar_utama: 'assets/images/rolls_royce_phantom.jpg'
    };
    currentCars.unshift(newCar);
  }

  renderCatalog();
  populateCalculatorSelect();
  updateAdminTables();
  closeModal('carFormModal');
}

function editCar(carId) {
  const car = currentCars.find(c => c.id == carId);
  if (!car) return;

  document.getElementById('carFormId').value = car.id;
  document.getElementById('carFormBrand').value = car.brand;
  document.getElementById('carFormModel').value = car.model;
  document.getElementById('carFormTahun').value = car.tahun;
  document.getElementById('carFormHarga').value = car.harga_otr;
  document.getElementById('carFormStok').value = car.stok;
  document.getElementById('carFormDesc').value = car.deskripsi;

  openModal('carFormModal');
}

function setupEventListeners() {
  document.getElementById('bookingForm')?.addEventListener('submit', submitBookingForm);
  document.getElementById('vipForm')?.addEventListener('submit', submitVipForm);
  document.getElementById('loginForm')?.addEventListener('submit', handleAdminLogin);
  document.getElementById('carForm')?.addEventListener('submit', saveCarForm);

  // Live real-time search filtering
  const searchInput = document.querySelector('.search-bar input');
  if (searchInput && window.location.pathname.includes('cars.php')) {
    searchInput.addEventListener('input', (e) => {
      searchQuery = e.target.value;
      renderCatalog();
    });
  }
}


// Navbar scroll shadow effect
window.addEventListener('scroll', () => {
  const navbar = document.querySelector('.navbar');
  if (navbar) {
    if (window.scrollY > 20) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  }
});

// ── SIDEBAR DRAWER ──
function toggleSidebar() {
  const drawer = document.getElementById('sidebarDrawer');
  const overlay = document.getElementById('sidebarOverlay');
  const menuIcon = document.querySelector('.menu-icon');

  if (!drawer || !overlay) return;

  const isOpen = drawer.classList.contains('active');

  if (isOpen) {
    drawer.classList.remove('active');
    overlay.classList.remove('active');
    if (menuIcon) menuIcon.classList.remove('active');
    document.body.style.overflow = '';
  } else {
    drawer.classList.add('active');
    overlay.classList.add('active');
    if (menuIcon) menuIcon.classList.add('active');
    document.body.style.overflow = 'hidden';
    updateSidebarAuth();
  }
}

function updateSidebarAuth() {
  const user = getLoggedInUser();
  const loginBtn = document.getElementById('sidebarLoginBtn');
  const logoutBtn = document.getElementById('sidebarLogoutBtn');

  if (!loginBtn || !logoutBtn) return;

  if (user) {
    loginBtn.style.display = 'none';
    logoutBtn.style.display = 'flex';
  } else {
    loginBtn.style.display = 'flex';
    logoutBtn.style.display = 'none';
  }
}

// Attach click to menu icon
document.addEventListener('DOMContentLoaded', () => {
  const menuIcon = document.querySelector('.menu-icon');
  if (menuIcon) {
    menuIcon.addEventListener('click', toggleSidebar);
  }
});

// Close sidebar on Escape key
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    const drawer = document.getElementById('sidebarDrawer');
    if (drawer && drawer.classList.contains('active')) {
      toggleSidebar();
    }
  }
});


// ── INSURANCE APPLICATION FEATURE ──
let insuranceCurrentStep = 1;
let insuranceCoverageType = 'comprehensive';

function openInsuranceModal(preselectedCarId = null) {
  try {
    // Populate vehicle select
    const select = document.getElementById('insVehicleSelect');
    if (select && Array.isArray(currentCars)) {
      select.innerHTML = currentCars.map(c =>
        `<option value="${c.id}" ${preselectedCarId && c.id == preselectedCarId ? 'selected' : ''}>${c.brand} ${c.model} (${c.tahun})</option>`
      ).join('');
      if (preselectedCarId) {
        select.value = preselectedCarId;
      }
    }

    // Pre-fill user data if logged in
    const user = getLoggedInUser();
    if (user) {
      const nameField = document.getElementById('insName');
      const emailField = document.getElementById('insEmail');
      if (nameField && !nameField.value) nameField.value = user.nama || '';
      if (emailField && !emailField.value) emailField.value = user.email || '';
    }

    // Reset to step 1
    insuranceCurrentStep = 1;
    insuranceCoverageType = 'comprehensive';
    
    // Reset coverage cards active selection
    document.querySelectorAll('.coverage-card').forEach(c => {
      if (c.getAttribute('data-type') === 'comprehensive') c.classList.add('selected');
      else c.classList.remove('selected');
    });

    updateInsuranceStepUI();
    updateInsurancePremium();
  } catch (err) {
    console.error('[PCS] Error in openInsuranceModal:', err);
  }

  openModal('insuranceModal');
}

function insuranceNextStep(step) {
  if (step === 2) {
    const select = document.getElementById('insVehicleSelect');
    if (!select || !select.value) {
      alert('Silakan pilih unit kendaraan terlebih dahulu.');
      return;
    }
  } else if (step === 3) {
    // Validate that a coverage is selected
    if (!insuranceCoverageType) {
      alert('Silakan tentukan jenis paket pertanggungan asuransi.');
      return;
    }
  }
  insuranceCurrentStep = step;
  updateInsuranceStepUI();
  updateInsurancePremium();
}

function updateInsuranceStepUI() {
  // Hide all step contents
  for (let i = 1; i <= 3; i++) {
    const content = document.getElementById(`insStepContent${i}`);
    if (content) content.style.display = i === insuranceCurrentStep ? 'block' : 'none';
  }

  // Update step indicators
  for (let i = 1; i <= 3; i++) {
    const num = document.getElementById(`insStep${i}Num`);
    const label = document.getElementById(`insStep${i}Label`);

    if (num) {
      num.classList.remove('active', 'done');
      if (i < insuranceCurrentStep) {
        num.classList.add('done');
        num.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>';
      } else if (i === insuranceCurrentStep) {
        num.classList.add('active');
        num.textContent = i;
      } else {
        num.textContent = i;
      }
    }
    if (label) {
      label.classList.toggle('active', i === insuranceCurrentStep);
    }
  }

  // Update step lines
  const line1 = document.getElementById('insLine1');
  const line2 = document.getElementById('insLine2');
  if (line1) line1.classList.toggle('done', insuranceCurrentStep > 1);
  if (line2) line2.classList.toggle('done', insuranceCurrentStep > 2);
}

function selectCoverage(element, type) {
  insuranceCoverageType = type;
  document.querySelectorAll('.coverage-card').forEach(c => c.classList.remove('selected'));
  element.classList.add('selected');
  updateInsurancePremium();
}

function updateInsurancePremium() {
  const select = document.getElementById('insVehicleSelect');
  if (!select) return;

  const carId = parseInt(select.value);
  const car = currentCars.find(c => c.id === carId);
  if (!car) return;

  const harga = parseFloat(car.harga_otr);

  // Show vehicle value
  const valueDisplay = document.getElementById('insVehicleValue');
  if (valueDisplay) valueDisplay.textContent = formatIDR(harga);

  // Calculate premium rate based on OJK luxury standards:
  // Comprehensive: ~2.85% (OJK Tier 5 > Rp 800M for luxury)
  // TLO: ~0.45%
  let baseRate = insuranceCoverageType === 'comprehensive' ? 0.0285 : 0.0045;
  let annualPremium = harga * baseRate;

  // Add-ons
  const addonFlood = document.getElementById('insAddonFlood');
  const addonRiot = document.getElementById('insAddonRiot');
  const addonPassenger = document.getElementById('insAddonPassenger');
  const addonTPL = document.getElementById('insAddonTPL');

  if (addonFlood && addonFlood.checked) annualPremium += harga * 0.00075;
  if (addonRiot && addonRiot.checked) annualPremium += harga * 0.0005;
  if (addonPassenger && addonPassenger.checked) annualPremium += 2500000; // flat per year
  if (addonTPL && addonTPL.checked) annualPremium += 5000000; // flat per year

  // Update annual premium display
  const premiumDisplay = document.getElementById('insPremiumAmount');
  if (premiumDisplay) premiumDisplay.textContent = formatIDR(annualPremium);

  // Total premium with multi-year savings
  const periodSelect = document.getElementById('insPeriod');
  const period = periodSelect ? parseInt(periodSelect.value) : 1;

  let discountMultiplier = 1.0;
  if (period === 2) discountMultiplier = 0.95; // 5% discount
  if (period >= 3) discountMultiplier = 0.90; // 10% discount

  const totalPremium = Math.round(annualPremium * period * discountMultiplier);
  const totalDisplay = document.getElementById('insTotalPremium');
  const periodDisplay = document.getElementById('insTotalPeriod');

  if (totalDisplay) totalDisplay.textContent = formatIDR(totalPremium);
  if (periodDisplay) {
    const discountNote = discountMultiplier < 1.0 ? ` (${Math.round((1 - discountMultiplier) * 100)}% multi-year discount applied)` : '';
    periodDisplay.textContent = `for ${period} year${period > 1 ? 's' : ''}${discountNote}`;
  }
}

async function submitInsuranceForm(e) {
  e.preventDefault();

  const select = document.getElementById('insVehicleSelect');
  const carId = parseInt(select.value);
  const car = currentCars.find(c => c.id === carId);

  const name = document.getElementById('insName').value.trim();
  const phone = document.getElementById('insPhone').value.trim();
  const email = document.getElementById('insEmail').value.trim();
  const ktp = document.getElementById('insKTP').value.trim();
  const address = document.getElementById('insAddress').value.trim();
  const period = parseInt(document.getElementById('insPeriod')?.value || 1);
  const notes = document.getElementById('insNotes').value.trim();

  // Validate KTP
  if (ktp.length < 16) {
    alert('Nomor KTP harus 16 digit sesuai e-KTP Republik Indonesia.');
    return;
  }

  const harga = car ? parseFloat(car.harga_otr) : 0;
  let baseRate = insuranceCoverageType === 'comprehensive' ? 0.0285 : 0.0045;
  let annualPremium = harga * baseRate;

  const addons = [];
  if (document.getElementById('insAddonFlood')?.checked) {
    annualPremium += harga * 0.00075;
    addons.push('flood');
  }
  if (document.getElementById('insAddonRiot')?.checked) {
    annualPremium += harga * 0.0005;
    addons.push('riot');
  }
  if (document.getElementById('insAddonPassenger')?.checked) {
    annualPremium += 2500000;
    addons.push('passenger');
  }
  if (document.getElementById('insAddonTPL')?.checked) {
    annualPremium += 5000000;
    addons.push('tpl');
  }

  let discountMultiplier = 1.0;
  if (period === 2) discountMultiplier = 0.95;
  if (period >= 3) discountMultiplier = 0.90;

  const totalPremium = Math.round(annualPremium * period * discountMultiplier);
  let insId = 'INS-2026-' + Math.floor(10000 + Math.random() * 90000);

  // Send to Backend API
  const payload = {
    mobil_id: carId,
    tipe_coverage: insuranceCoverageType,
    addons: addons,
    harga_kendaraan: harga,
    premi_tahunan: Math.round(annualPremium),
    durasi_tahun: period,
    total_premi: totalPremium,
    nama_pemohon: name,
    no_telepon: phone,
    email: email,
    no_ktp: ktp,
    alamat: address,
    catatan: notes
  };

  try {
    const res = await fetch('api.php?action=submit_insurance', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });
    const result = await res.json();
    if (result.status === 'success' && result.data?.nomor_polis) {
      insId = result.data.nomor_polis;
    }
  } catch (err) {
    console.warn('API submit fallback:', err);
  }

  // Save to LocalStorage for persistence
  const applications = JSON.parse(localStorage.getItem('pcsInsuranceApps') || '[]');
  const newApp = {
    id: insId,
    nomor_polis: insId,
    mobil_id: carId,
    carName: car ? `${car.brand} ${car.model}` : 'Unknown',
    carYear: car ? car.tahun : 2025,
    carValue: harga,
    coverageType: insuranceCoverageType === 'comprehensive' ? 'Comprehensive (All Risk)' : 'Total Loss Only (TLO)',
    tipe_coverage: insuranceCoverageType,
    addons: addons,
    name: name,
    nama_pemohon: name,
    phone: phone,
    no_telepon: phone,
    email: email,
    ktp: ktp,
    no_ktp: ktp,
    address: address,
    alamat: address,
    period: period + ' Year' + (period > 1 ? 's' : ''),
    durasi_tahun: period,
    premi_tahunan: Math.round(annualPremium),
    total_premi: totalPremium,
    notes: notes,
    catatan: notes,
    status: 'pending',
    date: new Date().toISOString().split('T')[0]
  };
  applications.unshift(newApp);
  localStorage.setItem('pcsInsuranceApps', JSON.stringify(applications));

  // Close modal and reset
  closeModal('insuranceModal');
  document.getElementById('insuranceForm').reset();
  insuranceCurrentStep = 1;
  updateInsuranceStepUI();

  // Show digital confirmation dossier modal
  showInsuranceSuccessModal(newApp);
}

function showInsuranceSuccessModal(app) {
  const container = document.getElementById('insuranceSuccessModalContent');
  if (container) {
    const addonsList = Array.isArray(app.addons) ? app.addons : [];
    const addonNames = {
      'flood': 'Flood & Typhoon Protection',
      'riot': 'Civil Commotion & Riot (SRCC)',
      'passenger': 'Passenger Personal Accident',
      'tpl': 'Third-Party Liability (TPL)'
    };
    const addonsText = addonsList.length > 0 ? addonsList.map(a => addonNames[a] || a).join(', ') : 'Standard Comprehensive Inclusions';

    container.innerHTML = `
      <div style="text-align:center; margin-bottom:24px;">
        <div style="display:inline-flex; align-items:center; justify-content:center; width:56px; height:56px; background:#ecfdf5; border-radius:50%; margin-bottom:12px;">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        </div>
        <h3 style="font-family:var(--font-serif); font-size:1.4rem; margin-bottom:6px; color:var(--black);">Insurance Application Registered</h3>
        <p style="font-size:0.85rem; color:var(--gray-500);">Your luxury protection policy dossier has been submitted to executive underwriters.</p>
      </div>

      <div style="background:var(--black); color:var(--white); padding:20px; border-radius:4px; margin-bottom:20px;">
        <div style="font-size:0.7rem; text-transform:uppercase; letter-spacing:0.12em; color:var(--gold); margin-bottom:4px;">OFFICIAL POLICY DOSSIER NO.</div>
        <div style="font-family:var(--font-serif); font-size:1.5rem; font-weight:700; letter-spacing:0.04em;">${app.nomor_polis || app.id}</div>
        <div style="display:flex; justify-content:space-between; margin-top:16px; padding-top:12px; border-top:1px solid rgba(255,255,255,0.12); font-size:0.8rem;">
          <div><span style="opacity:0.6;">Applicant:</span> <strong>${app.nama_pemohon || app.name}</strong></div>
          <div><span style="opacity:0.6;">Status:</span> <span style="color:var(--gold); font-weight:600;">PENDING SURVEY</span></div>
        </div>
      </div>

      <div style="border:1px solid var(--gray-200); padding:18px; margin-bottom:24px; font-size:0.85rem; line-height:1.8;">
        <div style="display:flex; justify-content:space-between; border-bottom:1px solid var(--gray-200); padding-bottom:6px; margin-bottom:6px;">
          <span style="color:var(--gray-500);">Insured Asset:</span>
          <strong>${app.carName} (${app.carYear || 2025})</strong>
        </div>
        <div style="display:flex; justify-content:space-between; border-bottom:1px solid var(--gray-200); padding-bottom:6px; margin-bottom:6px;">
          <span style="color:var(--gray-500);">Agreed Vehicle Value (OTR):</span>
          <strong>${formatIDR(app.carValue || 0)}</strong>
        </div>
        <div style="display:flex; justify-content:space-between; border-bottom:1px solid var(--gray-200); padding-bottom:6px; margin-bottom:6px;">
          <span style="color:var(--gray-500);">Coverage Plan:</span>
          <strong style="color:var(--gold);">${app.coverageType}</strong>
        </div>
        <div style="display:flex; justify-content:space-between; border-bottom:1px solid var(--gray-200); padding-bottom:6px; margin-bottom:6px;">
          <span style="color:var(--gray-500);">Policy Duration:</span>
          <strong>${app.period || (app.durasi_tahun + ' Year(s)')}</strong>
        </div>
        <div style="display:flex; justify-content:space-between; border-bottom:1px solid var(--gray-200); padding-bottom:6px; margin-bottom:6px;">
          <span style="color:var(--gray-500);">Endorsements:</span>
          <span style="font-size:0.8rem; text-align:right; max-width:60%; color:var(--black);">${addonsText}</span>
        </div>
        <div style="display:flex; justify-content:space-between; padding-top:6px; font-size:1rem;">
          <span style="font-weight:600; color:var(--black);">Total Premium Payable:</span>
          <strong style="color:var(--black); font-family:var(--font-serif); font-size:1.3rem;">${formatIDR(app.total_premi || 0)}</strong>
        </div>
      </div>

      <div style="display:flex; gap:12px;">
        <button class="btn-outline-gold" style="flex:1;" onclick="window.print()">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle; margin-right:4px;"><path d="M6 9V2h12v7"></path><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><path d="M6 14h12v8H6z"></path></svg>
          Print Dossier
        </button>
        <button class="btn-gold" style="flex:1;" onclick="closeModal('insuranceSuccessModal')">Complete</button>
      </div>
    `;
    openModal('insuranceSuccessModal');
  } else {
    showToast(`Insurance application ${app.nomor_polis || app.id} submitted successfully!`);
  }
}


// ── FAVORITES SYSTEM ──
function getFavorites() {
  return JSON.parse(localStorage.getItem('pcsFavorites') || '[]');
}

function isFavorited(carId) {
  return getFavorites().includes(carId);
}

function toggleFavorite(carId, btnElement) {
  requireLogin(() => {
    let favs = getFavorites();
    const index = favs.indexOf(carId);
    if (index > -1) {
      favs.splice(index, 1);
      if (btnElement) btnElement.classList.remove('active');
      showToast('Removed from favorites');
    } else {
      favs.push(carId);
      if (btnElement) btnElement.classList.add('active');
      showToast('Saved to favorites');
    }
    localStorage.setItem('pcsFavorites', JSON.stringify(favs));
  });
}

function openFavoritesModal() {
  const favs = getFavorites();
  const container = document.getElementById('favoritesContent');
  if (!container) return;

  if (favs.length === 0) {
    container.innerHTML = `
      <div style="text-align:center; padding:40px 20px;">
        <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="var(--gray-300)" stroke-width="1.2" style="margin-bottom:16px;"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
        <h4 style="font-family:var(--font-serif); font-size:1.1rem; margin-bottom:8px;">No Favorites Yet</h4>
        <p style="font-size:0.85rem; color:var(--gray-500); line-height:1.5;">Tap the \u2661 icon on any vehicle card to save it here for quick access.</p>
      </div>
    `;
  } else {
    const favCars = currentCars.filter(c => favs.includes(c.id));
    container.innerHTML = `
      <div style="font-size:0.82rem; color:var(--gray-500); margin-bottom:16px;">${favCars.length} saved vehicle${favCars.length > 1 ? 's' : ''}</div>
      ${favCars.map(car => `
        <div style="display:flex; gap:16px; padding:16px 0; border-bottom:1px solid var(--gray-200); align-items:center;">
          <img src="${car.gambar_utama}" alt="${car.brand}" style="width:100px; height:68px; object-fit:cover; background:var(--gray-200); flex-shrink:0;" onerror="this.src='https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=200&q=60'">
          <div style="flex:1; min-width:0;">
            <div style="font-weight:600; font-size:0.9rem; margin-bottom:2px;">${car.brand} ${car.model}</div>
            <div style="font-size:0.82rem; color:var(--gray-500);">${car.tahun}</div>
            <div style="font-family:var(--font-serif); font-size:0.95rem; font-weight:600; margin-top:4px;">${formatIDR(car.harga_otr)}</div>
          </div>
          <div style="display:flex; flex-direction:column; gap:6px; flex-shrink:0;">
            <button onclick="closeModal('favoritesModal'); openDetailModal(${car.id})" style="background:var(--black); color:#fff; border:none; padding:6px 12px; font-size:0.75rem; cursor:pointer; font-family:inherit;">View</button>
            <button onclick="removeFavoriteAndRefresh(${car.id})" style="background:none; border:1px solid var(--gray-300); padding:6px 12px; font-size:0.75rem; cursor:pointer; color:var(--gray-600); font-family:inherit;">Remove</button>
          </div>
        </div>
      `).join('')}
    `;
  }

  openModal('favoritesModal');
}

function removeFavoriteAndRefresh(carId) {
  let favs = getFavorites();
  favs = favs.filter(id => id !== carId);
  localStorage.setItem('pcsFavorites', JSON.stringify(favs));
  renderCatalog(); // refresh heart icons
  openFavoritesModal(); // refresh the modal
  showToast('Removed from favorites');
}


// ── BOOK TEST DRIVE ──
function openTestDriveModal(carId = null) {
  try {
    // Populate vehicle select
    const select = document.getElementById('tdVehicleSelect');
    if (select && Array.isArray(currentCars) && currentCars.length > 0) {
      select.innerHTML = currentCars.map(c =>
        `<option value="${c.id}" ${carId && String(c.id) === String(carId) ? 'selected' : ''}>${c.brand} ${c.model} (${c.tahun}) - ${formatIDR(c.harga_otr)}</option>`
      ).join('');
    }

    // Set min date to tomorrow
    const dateInput = document.getElementById('tdDate');
    if (dateInput) {
      const tomorrow = new Date();
      tomorrow.setDate(tomorrow.getDate() + 1);
      const tomorrowStr = tomorrow.toISOString().split('T')[0];
      dateInput.min = tomorrowStr;
      if (!dateInput.value || dateInput.value < tomorrowStr) {
        dateInput.value = tomorrowStr;
      }
    }

    // Pre-fill if logged in
    const user = getLoggedInUser();
    const nameField = document.getElementById('tdName');
    const emailField = document.getElementById('tdEmail');
    const phoneField = document.getElementById('tdPhone');

    if (user) {
      const cleanName = (user.nama || '').replace(/\s*\([^)]*\)/g, '').trim();
      if (nameField) nameField.value = cleanName;
      if (emailField) emailField.value = user.email || '';
      if (phoneField) phoneField.value = user.phone || user.no_telepon || '081299887766';
    }

    // Hide alert
    const alert = document.getElementById('tdAlert');
    if (alert) alert.style.display = 'none';
  } catch (err) {
    console.error('[PCS] Error in openTestDriveModal:', err);
  }

  openModal('testDriveModal');
}

function submitTestDriveForm(e) {
  e.preventDefault();

  const select = document.getElementById('tdVehicleSelect');
  const carId = select ? parseInt(select.value) : 1;
  const car = currentCars.find(c => String(c.id) === String(carId));
  const name = document.getElementById('tdName').value.trim();
  const email = (document.getElementById('tdEmail')?.value || '').trim() || (getLoggedInUser()?.email || 'user@luxury.com');
  const phone = document.getElementById('tdPhone').value.trim();
  const date = document.getElementById('tdDate').value;
  const time = document.getElementById('tdTime').value;
  const notes = document.getElementById('tdNotes')?.value.trim() || '';
  const alertBox = document.getElementById('tdAlert');

  // Simulate schedule conflict for 10:00 slot on current date
  if (time === '10:00' && date === new Date().toISOString().split('T')[0]) {
    if (alertBox) {
      alertBox.style.display = 'block';
      alertBox.style.background = '#fef3c7';
      alertBox.style.borderColor = '#f59e0b';
      alertBox.style.color = '#92400e';
      alertBox.innerHTML = '⚠️ <strong>Jadwal Tidak Tersedia:</strong> Slot jam 10:00 pada tanggal tersebut sudah penuh. Silakan pilih slot alternatif: <strong>13:00 WIB</strong> atau <strong>15:00 WIB</strong>.';
    }
    return;
  }

  const bookingId = 'TD-' + Math.floor(10000 + Math.random() * 90000);

  // Store booking
  const bookings = JSON.parse(localStorage.getItem('pcsTestDrives') || '[]');
  const newBooking = {
    id: bookingId,
    carId: carId,
    carName: car ? `${car.brand} ${car.model}` : 'Luxury Supercar',
    name: name,
    email: email,
    phone: phone,
    date: date,
    time: time.includes('WIB') ? time : time + ' WIB',
    notes: notes,
    salesAdvisor: 'Arya Pratama (Senior Luxury Advisor)',
    status: 'pending',
    createdAt: new Date().toISOString()
  };
  bookings.unshift(newBooking);
  localStorage.setItem('pcsTestDrives', JSON.stringify(bookings));

  // Sync to admin testDriveBookings array
  if (typeof testDriveBookings !== 'undefined' && Array.isArray(testDriveBookings)) {
    testDriveBookings.unshift({
      id: bookingId,
      mobil_name: newBooking.carName,
      nama: name,
      kontak: phone,
      email: email,
      tanggal: date,
      jam: newBooking.time,
      status: 'pending'
    });
  }
  if (typeof updateAdminTables === 'function') {
    updateAdminTables();
  }

  closeModal('testDriveModal');
  const form = document.getElementById('testDriveForm');
  if (form) form.reset();

  // Call API
  try {
    fetch('api.php?action=book_test_drive', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        mobil_id: carId,
        nama_pemesan: name,
        email: email,
        kontak: phone,
        tanggal: date,
        jam: newBooking.time
      })
    });
  } catch (err) {}

  showToast(`Test drive ${bookingId} dijadwalkan! Lihat statusnya di tab Aktivitas.`);
  setTimeout(() => {
    openMyBookingsModal('testdrive');
  }, 400);
}

// Alias
function submitTestDrive(e) {
  return submitTestDriveForm(e);
}


// ── SELL YOUR CAR (TITIP JUAL) ──
function openSellCarModal() {
  try {
    const form = document.getElementById('sellCarForm');
    if (form) form.reset();

    // Pre-fill if logged in
    const user = getLoggedInUser();
    if (user) {
      const cleanName = (user.nama || '').replace(/\s*\([^)]*\)/g, '').trim();
      const nameField = document.getElementById('sellOwnerName');
      const emailField = document.getElementById('sellOwnerEmail');
      const phoneField = document.getElementById('sellOwnerPhone');
      if (nameField) nameField.value = cleanName;
      if (emailField) emailField.value = user.email || '';
      if (phoneField) phoneField.value = user.phone || user.no_telepon || '081299887766';
    }
  } catch (err) {
    console.error('[PCS] Error in openSellCarModal:', err);
  }

  openModal('sellCarModal');
}

function submitSellCarForm(e) {
  e.preventDefault();

  const brand = document.getElementById('sellBrand').value.trim();
  const model = document.getElementById('sellModel').value.trim();
  const year = document.getElementById('sellYear').value;
  const mileage = document.getElementById('sellMileage').value;
  const color = document.getElementById('sellColor').value.trim();
  const price = document.getElementById('sellPrice').value;
  const condition = document.getElementById('sellCondition').value;
  const description = document.getElementById('sellDescription').value.trim();
  const ownerName = document.getElementById('sellOwnerName').value.trim();
  const ownerPhone = document.getElementById('sellOwnerPhone').value.trim();
  const ownerEmail = document.getElementById('sellOwnerEmail').value.trim();

  const sellId = 'SELL-' + Math.floor(10000 + Math.random() * 90000);
  const user = getLoggedInUser();

  // Store consignment
  const listings = JSON.parse(localStorage.getItem('pcsSellListings') || '[]');
  const newListing = {
    id: sellId,
    brand,
    model,
    year: parseInt(year),
    mileage: mileage + ' km',
    color,
    askingPrice: parseInt(price),
    condition,
    description,
    ownerName,
    ownerPhone,
    ownerEmail: ownerEmail || (user ? user.email : 'user@luxury.com'),
    status: 'under_review',
    inspectionDate: 'Estimasi 48 Jam Kerja',
    technicianNotes: 'Menunggu jadwal kurasi fisik di showroom SCBD Jakarta Selatan',
    createdAt: new Date().toISOString()
  };
  listings.unshift(newListing);
  localStorage.setItem('pcsSellListings', JSON.stringify(listings));

  closeModal('sellCarModal');
  const form = document.getElementById('sellCarForm');
  if (form) form.reset();

  // Call API
  try {
    fetch('api.php?action=submit_sell_car', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(newListing)
    });
  } catch (err) {}

  showToast(`Pengajuan titip jual ${sellId} berhasil dikirim! Tim kami akan menginspeksi dalam 48 jam.`);
  setTimeout(() => {
    openMyBookingsModal('sell');
  }, 400);
}

// Alias
function submitSellCar(e) {
  return submitSellCarForm(e);
}


// ── CONTACT US ──
function openContactUsModal(subject = null) {
  try {
    const form = document.getElementById('contactUsForm');
    if (form) form.reset();

    if (subject) {
      const subSelect = document.getElementById('cuSubject');
      if (subSelect) subSelect.value = subject;
    }

    // Pre-fill if logged in
    const user = getLoggedInUser();
    if (user) {
      const cleanName = (user.nama || '').replace(/\s*\([^)]*\)/g, '').trim();
      const nameField = document.getElementById('cuName');
      const emailField = document.getElementById('cuEmail');
      const phoneField = document.getElementById('cuPhone');
      if (nameField) nameField.value = cleanName;
      if (emailField) emailField.value = user.email || '';
      if (phoneField) phoneField.value = user.phone || user.no_telepon || '081299887766';
    }
  } catch (err) {
    console.error('[PCS] Error in openContactUsModal:', err);
  }

  openModal('contactUsModal');
}

function submitContactUsForm(e) {
  e.preventDefault();

  const subject = document.getElementById('cuSubject').value;
  const name = document.getElementById('cuName').value.trim();
  const email = document.getElementById('cuEmail').value.trim();
  const phone = document.getElementById('cuPhone')?.value.trim() || '';
  const message = document.getElementById('cuMessage').value.trim();

  const ticketId = 'TKT-' + Math.floor(10000 + Math.random() * 90000);
  const user = getLoggedInUser();

  // Store message
  const messages = JSON.parse(localStorage.getItem('pcsContactMessages') || '[]');
  const newMsg = {
    id: ticketId,
    subject,
    name,
    email: email || (user ? user.email : 'user@luxury.com'),
    phone,
    message,
    status: 'open',
    reply: null,
    repliedAt: null,
    repliedBy: null,
    createdAt: new Date().toISOString()
  };
  messages.unshift(newMsg);
  localStorage.setItem('pcsContactMessages', JSON.stringify(messages));

  closeModal('contactUsModal');
  const form = document.getElementById('contactUsForm');
  if (form) form.reset();

  // Call API
  try {
    fetch('api.php?action=submit_contact_message', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(newMsg)
    });
  } catch (err) {}

  showToast(`Pesan terkirim (${ticketId})! Tim concierge kami akan merespons dalam 24 jam.`);
  setTimeout(() => {
    openMyBookingsModal('contact');
  }, 400);
}

// Alias
function submitContactUs(e) {
  return submitContactUsForm(e);
}


// ═════════════════════════════════════════════════════════════════
// ── CUSTOMER SERVICE BOOKING & MY BOOKINGS FEATURE ──
// ═════════════════════════════════════════════════════════════════

function openCustomerServiceModal(carId = null) {
  try {
    const form = document.getElementById('customerServiceForm');
    if (form) form.reset();

    // Prefill vehicle model if provided
    const carInput = document.getElementById('custSrvCarModel');
    if (carId && carInput && Array.isArray(currentCars)) {
      const car = currentCars.find(c => String(c.id) === String(carId));
      if (car) carInput.value = `${car.brand} ${car.model}`;
    }

    // Pre-fill user data if logged in
    const user = getLoggedInUser();
    if (user) {
      const cleanName = (user.nama || '').replace(/\s*\([^)]*\)/g, '').trim();
      const nameField = document.getElementById('custSrvName');
      const emailField = document.getElementById('custSrvEmail');
      const phoneField = document.getElementById('custSrvPhone');
      if (nameField) nameField.value = cleanName;
      if (emailField) emailField.value = user.email || '';
      if (phoneField) phoneField.value = user.phone || user.no_telepon || '081299887766';
    }

    // Set min date to today
    const dateField = document.getElementById('custSrvDate');
    if (dateField) {
      const today = new Date().toISOString().split('T')[0];
      dateField.min = today;
      if (!dateField.value) dateField.value = today;
    }

    updateServiceEstimatePreview();
  } catch (err) {
    console.error('[PCS] Error in openCustomerServiceModal:', err);
  }

  openModal('customerServiceModal');
}

function updateServiceEstimatePreview() {
  const typeSelect = document.getElementById('custSrvType');
  const previewBox = document.getElementById('custSrvEstimateBox') || document.getElementById('custSrvPricePreview');
  if (!typeSelect || !previewBox) return;

  const rates = {
    'ganti_oli': { jasa: 750000, parts: 2500000, desc: 'Penggantian oli sintesis performa tinggi (Motul 300V / Castrol Edge Supercar) + Filter oli OEM APM + Pembersihan filter udara.' },
    'tune_up': { jasa: 1500000, parts: 3200000, desc: 'Pemeriksaan pengapian, penggantian busi iridium racing, pembersihan throttle body, injector cleaner, dan kalibrasi sensor ECU.' },
    'servis_umum': { jasa: 2000000, parts: 4500000, desc: 'General inspection komprehensif 150 titik (rem, suspensi, transmisi, elektrikal) + kuras air radiator coolant + filter kabin.' },
    'perbaikan_rem': { jasa: 1200000, parts: 5000000, desc: 'Pengecekan piringan cakram carbon ceramic/steel, penggantian kampas rem Brembo, kuras minyak rem Dot 5.1 racing.' },
    'servis_ac': { jasa: 900000, parts: 1800000, desc: 'Flushing freon, pembersihan evaporator ultrasonik, antibakteri filter kabin, dan pengecekan oli kompresor AC.' },
    'kelistrikan': { jasa: 1800000, parts: 3500000, desc: 'Diagnostik OBD scanner pabrikan APM, reset trouble code, pengecekan modul sensor, dan pengujian voltase baterai.' },
    'lainnya': { jasa: 1000000, parts: 2000000, desc: 'Pemeriksaan dan penanganan spesifik sesuai kendala teknis yang dilaporkan.' }
  };

  const selected = rates[typeSelect.value] || rates['ganti_oli'];
  const total = selected.jasa + selected.parts;

  previewBox.innerHTML = `
    <div style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.06em; color:var(--gray-500); margin-bottom:4px; font-weight:700;">Estimasi Biaya Transparan:</div>
    <div style="font-size:0.83rem; color:var(--gray-600); margin-bottom:6px;">${selected.desc}</div>
    <div style="display:flex; justify-content:space-between; align-items:center; border-top:1px dashed var(--gray-300); padding-top:6px; margin-top:6px;">
      <span style="font-size:0.8rem; color:var(--gray-500);">Jasa: ${formatIDR(selected.jasa)} • Parts: ${formatIDR(selected.parts)}</span>
      <span style="font-family:var(--font-serif); font-size:1.1rem; font-weight:700; color:var(--black);">${formatIDR(total)}</span>
    </div>
  `;
}

async function submitCustomerServiceBooking(e) {
  e.preventDefault();

  const name = document.getElementById('custSrvName').value.trim();
  const phone = document.getElementById('custSrvPhone').value.trim();
  const email = document.getElementById('custSrvEmail').value.trim();
  const car = document.getElementById('custSrvCarModel').value.trim();
  const nopol = document.getElementById('custSrvNopol').value.trim().toUpperCase();
  const srvType = document.getElementById('custSrvType').value;
  const date = document.getElementById('custSrvDate').value;
  const time = document.getElementById('custSrvTime').value;
  const notes = document.getElementById('custSrvNotes').value.trim();

  const rates = {
    'ganti_oli': { jasa: 750000, parts: 2500000, desc: 'Oli Motul 300V / Castrol Edge + Filter OEM' },
    'tune_up': { jasa: 1500000, parts: 3200000, desc: 'Busi Iridium Racing + Throttle Body Clean' },
    'servis_umum': { jasa: 2000000, parts: 4500000, desc: 'Inspection 150 Titik + Filter Udara & Kabin' },
    'perbaikan_rem': { jasa: 1200000, parts: 5000000, desc: 'Brembo Brake Pad + Minyak Rem Dot 5.1' },
    'servis_ac': { jasa: 900000, parts: 1800000, desc: 'Flushing Freon + Filter Kabin Antibakteri' },
    'kelistrikan': { jasa: 1800000, parts: 3500000, desc: 'OBD Factory Diagnostics' },
    'lainnya': { jasa: 1000000, parts: 2000000, desc: 'Servis Penanganan Khusus' }
  };

  const rate = rates[srvType] || rates['ganti_oli'];
  const bookingCode = 'SRV-' + date.replace(/-/g, '') + '-' + Math.floor(100 + Math.random() * 900);

  const newBooking = {
    id: Date.now(),
    booking_kode: bookingCode,
    nama_customer: name,
    kontak: phone,
    email: email,
    kendaraan_model: car,
    nomor_polisi: nopol,
    jenis_servis: srvType,
    tanggal_servis: date,
    jam_servis: time,
    keluhan: notes,
    mekanik_nama: 'Master Technician (Workshop Resmi)',
    biaya_jasa: rate.jasa,
    biaya_sparepart: rate.parts,
    total_biaya: rate.jasa + rate.parts,
    rincian_sparepart: rate.desc,
    status: 'pending',
    created_at: new Date().toISOString()
  };

  // Try API first
  try {
    await fetch('api.php?action=save_service_booking', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(newBooking)
    });
  } catch (err) {}

  // Save to localStorage
  const existing = JSON.parse(localStorage.getItem('pcsServices') || '[]');
  existing.unshift(newBooking);
  localStorage.setItem('pcsServices', JSON.stringify(existing));

  closeModal('customerServiceModal');
  const form = document.getElementById('customerServiceForm');
  if (form) form.reset();

  // Show Success Receipt Modal
  const rcptCode = document.getElementById('srvReceiptCode');
  const rcptCar = document.getElementById('srvReceiptCar');
  const rcptType = document.getElementById('srvReceiptType');
  const rcptSchedule = document.getElementById('srvReceiptSchedule');
  const rcptCost = document.getElementById('srvReceiptCost');

  if (rcptCode) rcptCode.innerText = bookingCode;
  if (rcptCar) rcptCar.innerText = `${car} (${nopol})`;
  if (rcptType) rcptType.innerText = srvType.replace('_', ' ').toUpperCase();
  if (rcptSchedule) rcptSchedule.innerText = `${date} @ ${time}`;
  if (rcptCost) rcptCost.innerText = formatIDR(rate.jasa + rate.parts);

  openModal('serviceSuccessModal');
  showToast(`Booking servis ${bookingCode} berhasil didaftarkan!`);
}

// Alias
function submitCustomerService(e) {
  return submitCustomerServiceBooking(e);
}

function ensureCustomerDataInitialized() {
  // 1. Initial Test Drives
  if (!localStorage.getItem('pcsTestDrives')) {
    const defaultTestDrives = [
      {
        id: 'TD-88192',
        carId: 4,
        carName: 'Ferrari SF90 Stradale Assetto Fiorano',
        name: 'Budi Santoso',
        email: 'user@luxury.com',
        phone: '081299887766',
        date: '2026-03-12',
        time: '14:00 WIB',
        notes: 'Mohon siapkan rute uji jalan tol lingkar dalam dan brief fitur hybrid e-AWD.',
        salesAdvisor: 'Arya Pratama (Senior Luxury Advisor)',
        status: 'confirmed',
        createdAt: '2026-03-08T09:30:00.000Z'
      },
      {
        id: 'TD-90214',
        carId: 1,
        carName: 'Rolls-Royce Phantom VIII Extended',
        name: 'Dra. Hendra Syahputra',
        email: 'owner@luxury.com',
        phone: '081122334455',
        date: '2026-03-15',
        time: '11:00 WIB',
        notes: 'Inspeksi kenyamanan privasi baris belakang dan bespoke sound system.',
        salesAdvisor: 'Billie (Super User)',
        status: 'pending',
        createdAt: '2026-03-08T10:15:00.000Z'
      }
    ];
    localStorage.setItem('pcsTestDrives', JSON.stringify(defaultTestDrives));
  }

  // 2. Initial Sell Listings (Titip Jual)
  if (!localStorage.getItem('pcsSellListings')) {
    const defaultSell = [
      {
        id: 'SELL-44910',
        brand: 'Mercedes-Benz',
        model: 'AMG GT R Pro Coupe',
        year: 2023,
        mileage: '4.200 km',
        color: 'Green Hell Magno (Matte)',
        askingPrice: 9800000000,
        condition: 'excellent',
        description: 'Tangan pertama dari baru, bodi full original terlindungi PPF XPEL Ultimate Plus, servis berkala rutin dealer resmi Mercedes-Benz.',
        ownerName: 'Budi Santoso',
        ownerPhone: '081299887766',
        ownerEmail: 'user@luxury.com',
        status: 'under_review',
        inspectionDate: '10 Maret 2026 @ 14:00 WIB',
        technicianNotes: 'Jadwal kurasi fisik 150 titik showroom SCBD sudah terkonfirmasi.',
        createdAt: '2026-03-07T14:20:00.000Z'
      },
      {
        id: 'SELL-31802',
        brand: 'Porsche',
        model: '911 Carrera S (992)',
        year: 2022,
        mileage: '8.500 km',
        color: 'Crayon Grey',
        askingPrice: 4650000000,
        condition: 'excellent',
        description: 'Sport Chrono Package, Sport Exhaust, BOSE Sound System, interior Bordeaux Red leather, garansi resmi aktif.',
        ownerName: 'Kevin Anggara',
        ownerPhone: '081912345678',
        ownerEmail: 'kevin@creator.id',
        status: 'approved',
        inspectionDate: 'Selesai Diinspeksi',
        technicianNotes: 'Kondisi grade A+ 99/100, siap tayang di etalase katalog.',
        createdAt: '2026-03-05T11:00:00.000Z'
      }
    ];
    localStorage.setItem('pcsSellListings', JSON.stringify(defaultSell));
  }

  // 3. Initial Contact Messages
  if (!localStorage.getItem('pcsContactMessages')) {
    const defaultMessages = [
      {
        id: 'TKT-55102',
        subject: 'vip_viewing',
        name: 'Budi Santoso',
        email: 'user@luxury.com',
        phone: '081299887766',
        message: 'Apakah memungkinkan mengatur jadwal inspeksi privat untuk unit Koenigsegg Jesko di luar jam operasional showroom SCBD?',
        status: 'replied',
        reply: 'Halo Pak Budi, terima kasih atas ketertarikan Anda. Kami dapat mengatur VIP Private Viewing setelah pukul 18:00 WIB di showroom private vault kami. Senior Advisor kami (Arya) telah menghubungi nomor Anda.',
        repliedAt: '08 Maret 2026 13:45 WIB',
        repliedBy: 'Concierge Team PCS',
        createdAt: '2026-03-08T08:00:00.000Z'
      },
      {
        id: 'TKT-78210',
        subject: 'trade_in',
        name: 'Hartono Setiawan',
        email: 'hartono@djarum.com',
        phone: '081765432100',
        message: 'Saya ingin konsultasi skema tukar tambah Bentley Flying Spur saya dengan unit Rolls-Royce Spectre yang ada di showroom.',
        status: 'open',
        reply: null,
        repliedAt: null,
        repliedBy: null,
        createdAt: '2026-03-08T10:30:00.000Z'
      }
    ];
    localStorage.setItem('pcsContactMessages', JSON.stringify(defaultMessages));
  }

  // 4. Initial Services (Bengkel & Perawatan)
  if (!localStorage.getItem('pcsServices')) {
    const defaultServices = [
      {
        id: 1,
        booking_kode: 'SRV-20260305-101',
        nama_customer: 'Dr. Jessica Tanuwidjaja',
        kontak: '081288990011',
        email: 'jessica@tanuwidjaja.med',
        kendaraan_model: 'Ferrari SF90 Stradale',
        nomor_polisi: 'B 1 JSS',
        jenis_servis: 'ganti_oli',
        tanggal_servis: '2026-03-05',
        jam_servis: '10:00 WIB',
        mekanik_nama: 'Agus Subekti (Master Tech)',
        biaya_jasa: 750000,
        biaya_sparepart: 2500000,
        total_biaya: 3250000,
        rincian_sparepart: 'Oli Motul 300V Competition 8L + Filter Oli OEM Ferrari',
        status: 'selesai',
        keluhan: 'Penggantian oli rutin 5.000 KM',
        created_at: '2026-03-04T08:00:00.000Z'
      },
      {
        id: 2,
        booking_kode: 'SRV-20260306-204',
        nama_customer: 'Budi Santoso',
        kontak: '081299887766',
        email: 'user@luxury.com',
        kendaraan_model: 'Porsche 911 GT3 RS',
        nomor_polisi: 'B 911 BDS',
        jenis_servis: 'tune_up',
        tanggal_servis: '2026-03-06',
        jam_servis: '13:30 WIB',
        mekanik_nama: 'Bambang Irawan (Dyno & ECU Specialist)',
        biaya_jasa: 1500000,
        biaya_sparepart: 3200000,
        total_biaya: 4700000,
        rincian_sparepart: 'Busi Iridium Racing Bosch + Throttle Body Cleaner + Motul Fuel System Clean',
        status: 'dikonfirmasi',
        keluhan: 'Tarikan RPM menengah agak tersendat, minta dyno tune dan kalibrasi sensor ECU.',
        created_at: '2026-03-05T09:15:00.000Z'
      },
      {
        id: 3,
        booking_kode: 'SRV-20260314-305',
        nama_customer: 'Budi Santoso',
        kontak: '081299887766',
        email: 'user@luxury.com',
        kendaraan_model: 'Lamborghini Revuelto',
        nomor_polisi: 'B 8888 RVT',
        jenis_servis: 'servis_umum',
        tanggal_servis: '2026-03-14',
        jam_servis: '09:00 WIB',
        mekanik_nama: 'Agus Subekti (Master Tech)',
        biaya_jasa: 2000000,
        biaya_sparepart: 4500000,
        total_biaya: 6500000,
        rincian_sparepart: 'General Inspection 150 Titik + Pengecekan Sistem Hybrid EV Battery',
        status: 'pending',
        keluhan: 'Pemeriksaan berkala sebelum touring akhir pekan.',
        created_at: '2026-03-08T07:30:00.000Z'
      }
    ];
    localStorage.setItem('pcsServices', JSON.stringify(defaultServices));
  }
}

let currentMyBookingsTab = 'service';

function openMyBookingsModal(defaultTab = 'service') {
  const user = getLoggedInUser();
  if (!user) {
    showToast('Silakan login terlebih dahulu untuk mengakses riwayat aktivitas.');
    openModal('loginModal');
    return;
  }

  try {
    ensureCustomerDataInitialized();
    updateMyBookingsBadges();
    switchMyBookingsTab(defaultTab);
  } catch (err) {
    console.error('[PCS] Error in openMyBookingsModal:', err);
  }

  openModal('myBookingsModal');
}

function updateMyBookingsBadges() {
  const user = getLoggedInUser();
  if (!user) return;

  const userEmail = (user.email || '').toLowerCase().trim();
  const cleanUserName = (user.nama || '').replace(/\s*\([^)]*\)/g, '').trim().toLowerCase();

  const services = JSON.parse(localStorage.getItem('pcsServices') || '[]').filter(s => {
    const sEmail = (s.email || '').toLowerCase().trim();
    const sName = (s.nama_customer || '').toLowerCase().trim();
    return (sEmail && sEmail === userEmail) || (sName && (sName.includes(cleanUserName) || cleanUserName.includes(sName)));
  });

  const testDrives = JSON.parse(localStorage.getItem('pcsTestDrives') || '[]').filter(t => {
    const tEmail = (t.email || '').toLowerCase().trim();
    const tName = (t.name || '').toLowerCase().trim();
    return (tEmail && tEmail === userEmail) || (tName && (tName.includes(cleanUserName) || cleanUserName.includes(tName))) || (user.phone && t.phone === user.phone);
  });

  const sellListings = JSON.parse(localStorage.getItem('pcsSellListings') || '[]').filter(l => {
    const lEmail = (l.ownerEmail || '').toLowerCase().trim();
    const lName = (l.ownerName || '').toLowerCase().trim();
    return (lEmail && lEmail === userEmail) || (lName && (lName.includes(cleanUserName) || cleanUserName.includes(lName))) || (user.phone && l.ownerPhone === user.phone);
  });

  const contactMsgs = JSON.parse(localStorage.getItem('pcsContactMessages') || '[]').filter(m => {
    const mEmail = (m.email || '').toLowerCase().trim();
    const mName = (m.name || '').toLowerCase().trim();
    return (mEmail && mEmail === userEmail) || (mName && (mName.includes(cleanUserName) || cleanUserName.includes(mName))) || (user.phone && m.phone === user.phone);
  });

  const bSrv = document.getElementById('tabBadgeService');
  const bTd = document.getElementById('tabBadgeTestDrive');
  const bSell = document.getElementById('tabBadgeSell');
  const bCu = document.getElementById('tabBadgeContact');

  if (bSrv) bSrv.innerText = services.length;
  if (bTd) bTd.innerText = testDrives.length;
  if (bSell) bSell.innerText = sellListings.length;
  if (bCu) bCu.innerText = contactMsgs.length;
}

function switchMyBookingsTab(tabName) {
  currentMyBookingsTab = tabName;

  // Update tab buttons
  document.querySelectorAll('.my-tab-btn').forEach(btn => btn.classList.remove('active'));
  const activeBtn = document.getElementById(`myTabBtn-${tabName}`);
  if (activeBtn) activeBtn.classList.add('active');

  // Update top action bar
  const topAction = document.getElementById('myBookingsTopAction');
  if (topAction) {
    if (tabName === 'service') {
      topAction.innerHTML = `
        <span style="font-size:0.82rem; color:var(--gray-500);">Pantau status pengerjaan servis bengkel, suku cadang, dan rincian biaya:</span>
        <button class="btn-action btn-action-primary" onclick="closeModal('myBookingsModal'); openCustomerServiceModal();">+ Booking Servis Baru</button>
      `;
    } else if (tabName === 'testdrive') {
      topAction.innerHTML = `
        <span style="font-size:0.82rem; color:var(--gray-500);">Jadwal uji kemudi supercar eksklusif di Showroom SCBD Jakarta Selatan:</span>
        <button class="btn-action btn-action-primary" onclick="closeModal('myBookingsModal'); openTestDriveModal();">+ Jadwalkan Test Drive</button>
      `;
    } else if (tabName === 'sell') {
      topAction.innerHTML = `
        <span style="font-size:0.82rem; color:var(--gray-500);">Pengajuan titip jual unit mobil mewah Anda ke jaringan kolektor global:</span>
        <button class="btn-action btn-action-primary" onclick="closeModal('myBookingsModal'); openSellCarModal();">+ Ajukan Titip Jual</button>
      `;
    } else if (tabName === 'contact') {
      topAction.innerHTML = `
        <span style="font-size:0.82rem; color:var(--gray-500);">Riwayat pesan & tiket konsultasi VIP langsung dengan Luxury Concierge:</span>
        <button class="btn-action btn-action-primary" onclick="closeModal('myBookingsModal'); openContactUsModal();">+ Kirim Pesan Baru</button>
      `;
    }
  }

  renderMyBookingsContent(tabName);
}

function renderMyBookingsContent(activeTab = 'service') {
  const container = document.getElementById('myBookingsContent');
  if (!container) return;

  const user = getLoggedInUser();
  if (!user) {
    container.innerHTML = `<div style="text-align:center; padding:32px 16px; color:var(--gray-500);">Silakan login terlebih dahulu.</div>`;
    return;
  }

  const userEmail = (user.email || '').toLowerCase().trim();
  const cleanUserName = (user.nama || '').replace(/\s*\([^)]*\)/g, '').trim().toLowerCase();

  // ══════════════════════════════════════════════════════════════
  // TAB 1: SERVIS BENGKEL
  // ══════════════════════════════════════════════════════════════
  if (activeTab === 'service') {
    const allServices = JSON.parse(localStorage.getItem('pcsServices') || '[]');
    const myServices = allServices.filter(s => {
      const sEmail = (s.email || '').toLowerCase().trim();
      const sName = (s.nama_customer || '').toLowerCase().trim();
      return (sEmail && sEmail === userEmail) || (sName && (sName.includes(cleanUserName) || cleanUserName.includes(sName)));
    });
    const displayList = (myServices.length > 0) ? myServices : (user.role === 'admin' ? allServices.slice(0, 4) : []);

    if (displayList.length === 0) {
      container.innerHTML = `
        <div style="text-align:center; padding:48px 20px; color:var(--gray-500);">
          <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom:12px; opacity:0.5;"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
          <h4 style="font-family:var(--font-serif); font-size:1.15rem; color:var(--black); margin-bottom:4px;">Belum Ada Riwayat Servis</h4>
          <p style="font-size:0.83rem; margin-bottom:16px;">Jadwalkan servis berkala untuk menjaga performa optimal kendaraan supercar Anda.</p>
          <button class="btn btn-gold" onclick="closeModal('myBookingsModal'); openCustomerServiceModal();">Booking Servis Sekarang</button>
        </div>
      `;
      return;
    }

    const statusBadges = {
      'pending': '<span class="badge-status badge-pending">Menunggu Konfirmasi</span>',
      'dikonfirmasi': '<span class="badge-status badge-confirmed">Dikonfirmasi</span>',
      'in_progress': '<span class="badge-status badge-survey">Sedang Dikerjakan</span>',
      'selesai': '<span class="badge-status badge-approved">Selesai / Siap Ambil</span>',
      'dibatalkan': '<span class="badge-status badge-rejected">Dibatalkan</span>'
    };

    container.innerHTML = displayList.map(s => `
      <div style="background:var(--white); border:1px solid var(--gray-200); padding:20px; margin-bottom:16px; border-radius:3px;">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:12px; border-bottom:1px solid var(--gray-200); padding-bottom:10px;">
          <div>
            <div style="font-size:0.7rem; text-transform:uppercase; letter-spacing:0.08em; color:var(--gray-500); font-weight:700;">KODE RESERVASI</div>
            <div style="font-family:var(--font-serif); font-size:1.15rem; font-weight:700; color:var(--black);">${s.booking_kode}</div>
          </div>
          <div>${statusBadges[s.status] || s.status}</div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; font-size:0.85rem; line-height:1.7;">
          <div>
            <div style="color:var(--gray-500); font-size:0.75rem; text-transform:uppercase;">Kendaraan</div>
            <div style="font-weight:700; color:var(--black); font-size:1rem;">${s.kendaraan_model} (${s.nomor_polisi})</div>
            <div style="color:var(--gray-600); font-size:0.8rem;">Paket: <strong>${(s.jenis_servis || '').replace('_', ' ').toUpperCase()}</strong></div>
          </div>
          <div>
            <div style="color:var(--gray-500); font-size:0.75rem; text-transform:uppercase;">Jadwal Servis</div>
            <div style="font-weight:700; color:var(--black);">${s.tanggal_servis}</div>
            <div style="color:var(--gold); font-weight:700;">${s.jam_servis}</div>
          </div>
        </div>

        <div style="background:var(--gray-100); padding:12px; margin:12px 0; border:1px solid var(--gray-200); font-size:0.82rem;">
          <div style="color:var(--gray-600); margin-bottom:4px;"><strong>Rincian Suku Cadang & Jasa:</strong> ${s.rincian_sparepart || '-'}</div>
          <div style="display:flex; justify-content:space-between; align-items:center; border-top:1px dashed var(--gray-300); padding-top:6px; margin-top:6px;">
            <span style="color:var(--gray-500);">Jasa: ${formatIDR(s.biaya_jasa || 0)} • Sparepart: ${formatIDR(s.biaya_sparepart || 0)}</span>
            <span style="font-weight:700; font-size:0.95rem; color:var(--black);">Total: ${formatIDR(s.total_biaya || 0)}</span>
          </div>
        </div>

        ${s.mekanik_nama ? `
          <div style="font-size:0.8rem; color:var(--gray-600); margin-bottom:8px;">
            🧑‍🔧 <strong>Lead Technician:</strong> ${s.mekanik_nama}
          </div>
        ` : ''}

        <div style="display:flex; justify-content:flex-end; gap:8px; margin-top:14px; border-top:1px dashed var(--gray-200); padding-top:12px;">
          <a href="https://wa.me/6281299887766?text=Halo%20Bengkel%20PCS%20Edition,%20saya%20ingin%20konfirmasi%20servis%20${s.booking_kode}%20untuk%20mobil%20${encodeURIComponent(s.kendaraan_model)}" target="_blank" class="btn-action" style="text-decoration:none;">
            Chat Concierge Bengkel
          </a>
          ${s.status === 'pending' || s.status === 'dikonfirmasi' ? `
            <button class="btn-action btn-action-danger" onclick="cancelMyServiceBooking('${s.booking_kode}')">Batalkan</button>
          ` : ''}
        </div>
      </div>
    `).join('');
    return;
  }

  // ══════════════════════════════════════════════════════════════
  // TAB 2: JADWAL TEST DRIVE
  // ══════════════════════════════════════════════════════════════
  if (activeTab === 'testdrive') {
    const allTd = JSON.parse(localStorage.getItem('pcsTestDrives') || '[]');
    const myTd = allTd.filter(t => {
      const tEmail = (t.email || '').toLowerCase().trim();
      const tName = (t.name || '').toLowerCase().trim();
      return (tEmail && tEmail === userEmail) || (tName && (tName.includes(cleanUserName) || cleanUserName.includes(tName))) || (user.phone && t.phone === user.phone);
    });
    const displayList = (myTd.length > 0) ? myTd : (user.role === 'admin' ? allTd : []);

    if (displayList.length === 0) {
      container.innerHTML = `
        <div style="text-align:center; padding:48px 20px; color:var(--gray-500);">
          <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom:12px; opacity:0.5;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
          <h4 style="font-family:var(--font-serif); font-size:1.15rem; color:var(--black); margin-bottom:4px;">Belum Ada Jadwal Test Drive</h4>
          <p style="font-size:0.83rem; margin-bottom:16px;">Rasakan langsung sensasi performa supercar impian Anda dengan jadwal privat di showroom SCBD.</p>
          <button class="btn btn-gold" onclick="closeModal('myBookingsModal'); openTestDriveModal();">Jadwalkan Test Drive Sekarang</button>
        </div>
      `;
      return;
    }

    const tdBadges = {
      'pending': '<span class="badge-status badge-pending">Menunggu Konfirmasi</span>',
      'confirmed': '<span class="badge-status badge-approved">Jadwal Terkonfirmasi</span>',
      'completed': '<span class="badge-status" style="background:#e0f2fe; color:#0369a1; border:1px solid #bae6fd;">Selesai Dilakukan</span>',
      'cancelled': '<span class="badge-status badge-rejected">Dibatalkan</span>'
    };

    container.innerHTML = displayList.map(t => `
      <div style="background:var(--white); border:1px solid var(--gray-200); padding:20px; margin-bottom:16px; border-radius:3px;">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:12px; border-bottom:1px solid var(--gray-200); padding-bottom:10px;">
          <div>
            <div style="font-size:0.7rem; text-transform:uppercase; letter-spacing:0.08em; color:var(--gray-500); font-weight:700;">ID TIKET TEST DRIVE</div>
            <div style="font-family:var(--font-serif); font-size:1.15rem; font-weight:700; color:var(--black);">${t.id}</div>
          </div>
          <div>${tdBadges[t.status] || t.status}</div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; font-size:0.85rem; line-height:1.7;">
          <div>
            <div style="color:var(--gray-500); font-size:0.75rem; text-transform:uppercase;">Unit Supercar</div>
            <div style="font-weight:700; color:var(--black); font-size:1rem;">${t.carName}</div>
            <div style="color:var(--gray-600); font-size:0.8rem;">Showroom SCBD, Jakarta Selatan</div>
          </div>
          <div>
            <div style="color:var(--gray-500); font-size:0.75rem; text-transform:uppercase;">Waktu & Tanggal</div>
            <div style="font-weight:700; color:var(--black);">${t.date}</div>
            <div style="color:var(--gold); font-weight:700;">${t.time}</div>
          </div>
        </div>

        <div style="background:#f8fafc; padding:12px; margin:12px 0; border:1px solid #e2e8f0; font-size:0.82rem; line-height:1.6;">
          <div>👨‍💼 <strong>Senior Sales Advisor:</strong> ${t.salesAdvisor || 'Arya Pratama (Senior Luxury Advisor)'}</div>
          ${t.notes ? `<div style="color:var(--gray-600); margin-top:4px;"><strong>Catatan Permintaan:</strong> ${t.notes}</div>` : ''}
        </div>

        <div style="display:flex; justify-content:flex-end; gap:8px; margin-top:14px; border-top:1px dashed var(--gray-200); padding-top:12px;">
          <a href="https://wa.me/6281299887766?text=Halo%20PCS%20Edition,%20saya%20ingin%20konfirmasi%20jadwal%20test%20drive%20${t.id}%20untuk%20mobil%20${encodeURIComponent(t.carName)}" target="_blank" class="btn-action" style="text-decoration:none;">
            Chat WhatsApp Advisor
          </a>
          ${t.status === 'pending' || t.status === 'confirmed' ? `
            <button class="btn-action btn-action-danger" onclick="cancelMyTestDrive('${t.id}')">Batalkan</button>
          ` : ''}
        </div>
      </div>
    `).join('');
    return;
  }

  // ══════════════════════════════════════════════════════════════
  // TAB 3: TITIP JUAL MOBIL (SELL YOUR CAR)
  // ══════════════════════════════════════════════════════════════
  if (activeTab === 'sell') {
    const allSell = JSON.parse(localStorage.getItem('pcsSellListings') || '[]');
    const mySell = allSell.filter(l => {
      const lEmail = (l.ownerEmail || '').toLowerCase().trim();
      const lName = (l.ownerName || '').toLowerCase().trim();
      return (lEmail && lEmail === userEmail) || (lName && (lName.includes(cleanUserName) || cleanUserName.includes(lName))) || (user.phone && l.ownerPhone === user.phone);
    });
    const displayList = (mySell.length > 0) ? mySell : (user.role === 'admin' ? allSell : []);

    if (displayList.length === 0) {
      container.innerHTML = `
        <div style="text-align:center; padding:48px 20px; color:var(--gray-500);">
          <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom:12px; opacity:0.5;"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
          <h4 style="font-family:var(--font-serif); font-size:1.15rem; color:var(--black); margin-bottom:4px;">Belum Ada Pengajuan Titip Jual</h4>
          <p style="font-size:0.83rem; margin-bottom:16px;">Konsinyasikan supercar Anda ke jaringan kurasi pembeli terpercaya kami dengan komisi transparan.</p>
          <button class="btn btn-gold" onclick="closeModal('myBookingsModal'); openSellCarModal();">Ajukan Titip Jual Sekarang</button>
        </div>
      `;
      return;
    }

    const sellBadges = {
      'under_review': '<span class="badge-status badge-pending">Dalam Kurasi Penilai</span>',
      'approved': '<span class="badge-status badge-approved">Disetujui & Masuk Katalog</span>',
      'sold': '<span class="badge-status" style="background:#fef3c7; color:#92400e; border:1px solid #fde68a;">Unit Terjual ✨</span>',
      'rejected': '<span class="badge-status badge-rejected">Ditolak / Perlu Revisi</span>',
      'cancelled': '<span class="badge-status badge-rejected">Dibatalkan Klien</span>'
    };

    container.innerHTML = displayList.map(l => `
      <div style="background:var(--white); border:1px solid var(--gray-200); padding:20px; margin-bottom:16px; border-radius:3px;">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:12px; border-bottom:1px solid var(--gray-200); padding-bottom:10px;">
          <div>
            <div style="font-size:0.7rem; text-transform:uppercase; letter-spacing:0.08em; color:var(--gray-500); font-weight:700;">ID PENGAJUAN TITIP JUAL</div>
            <div style="font-family:var(--font-serif); font-size:1.15rem; font-weight:700; color:var(--black);">${l.id}</div>
          </div>
          <div>${sellBadges[l.status] || l.status}</div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; font-size:0.85rem; line-height:1.7;">
          <div>
            <div style="color:var(--gray-500); font-size:0.75rem; text-transform:uppercase;">Unit Kendaraan</div>
            <div style="font-weight:700; color:var(--black); font-size:1.05rem;">${l.brand} ${l.model} (${l.year})</div>
            <div style="color:var(--gray-600); font-size:0.8rem;">Warna: ${l.color} • Odo: ${l.mileage}</div>
          </div>
          <div>
            <div style="color:var(--gray-500); font-size:0.75rem; text-transform:uppercase;">Harga Penawaran Klien</div>
            <div style="font-family:var(--font-serif); font-weight:700; color:var(--black); font-size:1.15rem;">${formatIDR(l.askingPrice)}</div>
            <div style="color:#059669; font-size:0.8rem;">Estimasi Komisi Penjualan: 3.5%</div>
          </div>
        </div>

        <div style="background:var(--gray-100); padding:12px; margin:12px 0; border:1px solid var(--gray-200); font-size:0.82rem; line-height:1.6;">
          <div>📋 <strong>Kondisi:</strong> ${l.condition ? l.condition.toUpperCase() : 'EXCELLENT'}</div>
          <div>🔍 <strong>Status Kurasi:</strong> ${l.technicianNotes || 'Jadwal kurasi fisik sedang disiapkan'}</div>
          ${l.description ? `<div style="color:var(--gray-600); margin-top:4px;"><strong>Deskripsi Klien:</strong> "${l.description}"</div>` : ''}
        </div>

        <div style="display:flex; justify-content:flex-end; gap:8px; margin-top:14px; border-top:1px dashed var(--gray-200); padding-top:12px;">
          <a href="https://wa.me/6281299887766?text=Halo%20PCS%20Edition,%20saya%20ingin%20konsultasi%20titip%20jual%20${l.id}%20(${encodeURIComponent(l.brand + ' ' + l.model)})" target="_blank" class="btn-action" style="text-decoration:none;">
            Chat Tim Penilai
          </a>
          ${l.status === 'under_review' ? `
            <button class="btn-action btn-action-danger" onclick="cancelMySellListing('${l.id}')">Batalkan</button>
          ` : ''}
        </div>
      </div>
    `).join('');
    return;
  }

  // ══════════════════════════════════════════════════════════════
  // TAB 4: PESAN & KONSULTASI (CONTACT US)
  // ══════════════════════════════════════════════════════════════
  if (activeTab === 'contact') {
    const allMsgs = JSON.parse(localStorage.getItem('pcsContactMessages') || '[]');
    const myMsgs = allMsgs.filter(m => {
      const mEmail = (m.email || '').toLowerCase().trim();
      const mName = (m.name || '').toLowerCase().trim();
      return (mEmail && mEmail === userEmail) || (mName && (mName.includes(cleanUserName) || cleanUserName.includes(mName))) || (user.phone && m.phone === user.phone);
    });
    const displayList = (myMsgs.length > 0) ? myMsgs : (user.role === 'admin' ? allMsgs : []);

    if (displayList.length === 0) {
      container.innerHTML = `
        <div style="text-align:center; padding:48px 20px; color:var(--gray-500);">
          <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom:12px; opacity:0.5;"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
          <h4 style="font-family:var(--font-serif); font-size:1.15rem; color:var(--black); margin-bottom:4px;">Belum Ada Tiket Pesan</h4>
          <p style="font-size:0.83rem; margin-bottom:16px;">Ada pertanyaan tentang unit langka, spesifikasi bespoke, atau skema pembelian? Hubungi kami langsung.</p>
          <button class="btn btn-gold" onclick="closeModal('myBookingsModal'); openContactUsModal();">Kirim Pesan Konsultasi</button>
        </div>
      `;
      return;
    }

    const msgBadges = {
      'open': '<span class="badge-status badge-pending">Menunggu Respon</span>',
      'replied': '<span class="badge-status badge-approved">Dibalas Concierge</span>',
      'resolved': '<span class="badge-status" style="background:#e5e7eb; color:#374151;">Selesai</span>'
    };

    container.innerHTML = displayList.map(m => `
      <div style="background:var(--white); border:1px solid var(--gray-200); padding:20px; margin-bottom:16px; border-radius:3px;">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:12px; border-bottom:1px solid var(--gray-200); padding-bottom:10px;">
          <div>
            <div style="font-size:0.7rem; text-transform:uppercase; letter-spacing:0.08em; color:var(--gray-500); font-weight:700;">TIKET PESAN • ${m.subject ? m.subject.toUpperCase() : 'GENERAL'}</div>
            <div style="font-family:var(--font-serif); font-size:1.15rem; font-weight:700; color:var(--black);">${m.id}</div>
          </div>
          <div>${msgBadges[m.status] || m.status}</div>
        </div>

        <div style="font-size:0.85rem; line-height:1.6; margin-bottom:12px;">
          <div style="color:var(--gray-500); font-size:0.75rem; text-transform:uppercase; margin-bottom:2px;">Pesan Anda:</div>
          <div style="background:#f9fafb; padding:12px; border:1px solid var(--gray-200); font-style:italic; color:#1f2937;">
            "${m.message}"
          </div>
        </div>

        ${m.reply ? `
          <div style="background:#ecfdf5; border-left:3px solid #10b981; padding:12px; margin-top:8px; font-size:0.83rem; line-height:1.6;">
            <div style="font-weight:700; color:#047857; font-size:0.8rem; margin-bottom:4px; display:flex; justify-content:space-between;">
              <span>💬 Balasan Concierge (${m.repliedBy || m.replied_by || 'Concierge Team'}):</span>
              <span style="font-weight:400; font-size:0.75rem; color:#065f46;">${m.repliedAt || m.replied_at || 'Baru saja'}</span>
            </div>
            <div style="color:#064e3b;">${m.reply || m.balasan}</div>
          </div>
        ` : `
          <div style="background:#fffbeb; border-left:3px solid #f59e0b; padding:10px; margin-top:8px; font-size:0.8rem; color:#92400e;">
            ⏳ Tiket Anda sedang ditangani oleh Tim Konsultan. Kami akan segera menghubungi atau merespons via email / WhatsApp.
          </div>
        `}

        <div style="display:flex; justify-content:flex-end; gap:8px; margin-top:14px; border-top:1px dashed var(--gray-200); padding-top:12px;">
          <a href="https://wa.me/6281299887766?text=Halo%20PCS%20Edition,%20saya%20ingin%20menanyakan%20tiket%20${m.id}" target="_blank" class="btn-action" style="text-decoration:none;">
            Chat WhatsApp
          </a>
        </div>
      </div>
    `).join('');
    return;
  }
}

function cancelMyTestDrive(id) {
  if (!confirm(`Apakah Anda yakin ingin membatalkan jadwal test drive ${id}?`)) return;
  const list = JSON.parse(localStorage.getItem('pcsTestDrives') || '[]');
  const item = list.find(x => x.id === id);
  if (item) {
    item.status = 'cancelled';
    localStorage.setItem('pcsTestDrives', JSON.stringify(list));
    updateMyBookingsBadges();
    renderMyBookingsContent('testdrive');
    showToast(`Test drive ${id} telah dibatalkan.`);
  }
}

function cancelMySellListing(id) {
  if (!confirm(`Batalkan pengajuan titip jual ${id}?`)) return;
  const list = JSON.parse(localStorage.getItem('pcsSellListings') || '[]');
  const item = list.find(x => x.id === id);
  if (item) {
    item.status = 'cancelled';
    localStorage.setItem('pcsSellListings', JSON.stringify(list));
    updateMyBookingsBadges();
    renderMyBookingsContent('sell');
    showToast(`Pengajuan titip jual ${id} dibatalkan.`);
  }
}

function cancelMyServiceBooking(bookingCode) {
  if (!confirm(`Batalkan reservasi servis ${bookingCode}?`)) return;
  const list = JSON.parse(localStorage.getItem('pcsServices') || '[]');
  const item = list.find(x => x.booking_kode === bookingCode);
  if (item) {
    item.status = 'dibatalkan';
    localStorage.setItem('pcsServices', JSON.stringify(list));
    updateMyBookingsBadges();
    renderMyBookingsContent('service');
    showToast(`Reservasi servis ${bookingCode} dibatalkan.`);
  }
}

// ═════════════════════════════════════════════════════════════════
// ── EXPLICIT GLOBAL WINDOW EXPOSURES & DELEGATED CLICK LISTENER ──
// ═════════════════════════════════════════════════════════════════
window.openModal = openModal;
window.closeModal = closeModal;
window.openCustomerServiceModal = openCustomerServiceModal;
window.openInsuranceModal = openInsuranceModal;
window.openSellCarModal = openSellCarModal;
window.openTestDriveModal = openTestDriveModal;
window.openContactUsModal = openContactUsModal;
window.openMyBookingsModal = openMyBookingsModal;
window.submitCustomerServiceBooking = submitCustomerServiceBooking;
window.submitCustomerService = submitCustomerServiceBooking;
window.submitTestDriveForm = submitTestDriveForm;
window.submitTestDrive = submitTestDriveForm;
window.submitSellCarForm = submitSellCarForm;
window.submitSellCar = submitSellCarForm;
window.submitContactUsForm = submitContactUsForm;
window.submitContactUs = submitContactUsForm;
window.cancelMyServiceBooking = cancelMyServiceBooking;
window.cancelMyTestDrive = cancelMyTestDrive;
window.cancelMySellListing = cancelMySellListing;
window.switchMyBookingsTab = switchMyBookingsTab;
window.toggleSidebar = toggleSidebar;
window.updateServiceEstimatePreview = updateServiceEstimatePreview;

// Global Delegated Click Listener for customer modal triggers
document.addEventListener('click', (e) => {
  const trigger = e.target.closest('[data-open-modal]');
  if (trigger) {
    const modalTarget = trigger.getAttribute('data-open-modal');
    if (modalTarget === 'service') { e.preventDefault(); openCustomerServiceModal(); }
    else if (modalTarget === 'insurance') { e.preventDefault(); openInsuranceModal(); }
    else if (modalTarget === 'sell') { e.preventDefault(); openSellCarModal(); }
    else if (modalTarget === 'testdrive') { e.preventDefault(); openTestDriveModal(); }
    else if (modalTarget === 'contact') { e.preventDefault(); openContactUsModal(); }
    else if (modalTarget === 'bookings') { e.preventDefault(); openMyBookingsModal(); }
    else { openModal(modalTarget); }
  }

  // Close modal when clicking directly on the dark backdrop
  if (e.target.classList && e.target.classList.contains('modal-overlay')) {
    closeModal(e.target.id);
  }
});
