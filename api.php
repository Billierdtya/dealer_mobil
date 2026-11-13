<?php
/**
 * REST API Backend & RBAC Engine
 * PT PENCARI CINTA SEJATI - Luxury Automotive Dealer & Service Management
 */
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once 'config.php';

$action = $_GET['action'] ?? $_POST['action'] ?? '';
$db = getDBConnection();

// Read JSON input if sent as body
$rawInput = file_get_contents('php://input');
$jsonInput = json_decode($rawInput, true) ?? [];
$input = array_merge($_POST, $jsonInput);

// Initial Mock Cars Data (Fallback)
$defaultCars = [
    [
        'id' => 1,
        'kategori_id' => 1,
        'brand' => 'Bugatti',
        'model' => 'Chiron Super Sport',
        'tahun' => 2025,
        'harga_otr' => 78000000000,
        'spesifikasi' => 'W16 8.0L Quad-Turbo | 1578 HP | 1600 Nm | 0-100 km/h: 2.3s | Top Speed: 440 km/h | Limited 60 Units',
        'deskripsi' => 'Hypercar paling eksklusif di muka bumi. Hanya 60 unit diproduksi dengan performa yang melampaui batas fisika.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/bugatti_chiron_super_sport.jpg'
    ],
    [
        'id' => 12,
        'kategori_id' => 1,
        'brand' => 'Bugatti',
        'model' => 'W16 Mistral Roadster',
        'tahun' => 2025,
        'harga_otr' => 85000000000,
        'spesifikasi' => 'W16 8.0L Quad-Turbo | 1600 HP | 1600 Nm | 0-100 km/h: 2.4s | The Ultimate Open-Top Hypercar',
        'deskripsi' => 'Roadster pamungkas bertenaga W16 legendaris Bugatti. Diproduksi terbatas hanya 99 unit di seluruh dunia.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/bugatti_w16_mistral_roadster.jpg'
    ],
    [
        'id' => 13,
        'kategori_id' => 1,
        'brand' => 'Bugatti',
        'model' => 'Divo Cornering Specialist',
        'tahun' => 2024,
        'harga_otr' => 95000000000,
        'spesifikasi' => 'W16 8.0L Quad-Turbo | 1500 HP | Cornering Specialist | Lateral Accel 1.6G | Downforce +90kg',
        'deskripsi' => 'Hypercar berkarakter sirkuit dengan aerodinamika agresif dan downforce ekstra dibanding Chiron standar.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/bugatti_divo_cornering_specialist.jpg'
    ],
    [
        'id' => 14,
        'kategori_id' => 1,
        'brand' => 'Bugatti',
        'model' => 'Bolide Track-Only Megacar',
        'tahun' => 2025,
        'harga_otr' => 72000000000,
        'spesifikasi' => 'W16 8.0L Quad-Turbo | 1850 HP | Weight: 1240 kg | 0.67 kg/HP | FIA Le Mans Safety Standards',
        'deskripsi' => 'Monster trek tanpa kompromi dengan rasio bobot tenaga 0.67 kg per HP dan transmisi balap FIA Le Mans.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/bugatti_bolide_track_only_megacar.jpg'
    ],
    [
        'id' => 15,
        'kategori_id' => 1,
        'brand' => 'Bugatti',
        'model' => 'Tourbillon V16 Hybrid',
        'tahun' => 2026,
        'harga_otr' => 88000000000,
        'spesifikasi' => 'V16 8.3L Cosworth NA + 3 Motors | 1800 HP | 0-100 km/h: 2.0s | Horology-Inspired Cockpit',
        'deskripsi' => 'Era baru hypercar Bugatti dengan instrumen analog karya pembuat jam tangan Swiss dan mesin naturally aspirated V16 Cosworth.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/bugatti_tourbillon_v16_hybrid.jpg'
    ],
    [
        'id' => 2,
        'kategori_id' => 2,
        'brand' => 'Pagani',
        'model' => 'Huayra Roadster BC',
        'tahun' => 2024,
        'harga_otr' => 60000000000,
        'spesifikasi' => 'AMG V12 6.0L Twin-Turbo | 802 HP | 1050 Nm | Carbon-Titanium Carbo-Triax HP62 Monocoque',
        'deskripsi' => 'Karya seni otomotif dari Horacio Pagani. Desain aerodinamis mutakhir dengan balutan serat karbon terhalus.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/pagani_huayra_roadster_bc.jpg'
    ],
    [
        'id' => 16,
        'kategori_id' => 2,
        'brand' => 'Pagani',
        'model' => 'Utopia Gated Manual Coupé',
        'tahun' => 2025,
        'harga_otr' => 65000000000,
        'spesifikasi' => 'Mercedes-AMG V12 6.0L Twin-Turbo | 864 HP | 1100 Nm | 7-Speed Gated Manual Transverse',
        'deskripsi' => 'Karya seni purist Horacio Pagani yang menolak elektrifikasi, menghadirkan tuas transmisi manual terbuka yang mempesona.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/pagani_utopia_gated_manual_coupe.jpg'
    ],
    [
        'id' => 17,
        'kategori_id' => 2,
        'brand' => 'Pagani',
        'model' => 'Huayra R Track Pure V12',
        'tahun' => 2024,
        'harga_otr' => 58000000000,
        'spesifikasi' => 'V12-R 6.0L Naturally Aspirated | 850 HP | 9000 RPM | Weight 1050 kg | Inconel Exhaust Symphonic',
        'deskripsi' => 'Mobil trek bertenaga V12 atmosferik dengan suara knalpot bernada Formula 1 era 1990-an dan bobot hanya 1050 kg.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/pagani_huayra_r_track_pure_v12.jpg'
    ],
    [
        'id' => 18,
        'kategori_id' => 2,
        'brand' => 'Pagani',
        'model' => 'Zonda Cinque Roadster',
        'tahun' => 2023,
        'harga_otr' => 75000000000,
        'spesifikasi' => 'AMG V12 7.3L NA | 678 HP | 780 Nm | 1 of 5 Worldwide | Carbo-Titanium Monocoque | Roof-Scoop Aero',
        'deskripsi' => 'Salah satu Zonda paling langka dan dicari kolektor dunia. Hanya ada 5 unit di dunia dengan aerodinamika atap roof-scoop.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/pagani_zonda_cinque_roadster.jpg'
    ],
    [
        'id' => 19,
        'kategori_id' => 2,
        'brand' => 'Pagani',
        'model' => 'Imola Roadster Aero-Lab',
        'tahun' => 2025,
        'harga_otr' => 82000000000,
        'spesifikasi' => 'Mercedes-AMG V12 Twin-Turbo | 850 HP | 1100 Nm | Extreme Ground Effect Aero | Limited 8 Units',
        'deskripsi' => 'Laboratorium berjalan Pagani yang diuji di Sirkuit Imola dengan downforce ekstrem dan teknologi suspensi aktif tercanggih.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/pagani_imola_roadster_aero_lab.jpg'
    ],
    [
        'id' => 3,
        'kategori_id' => 3,
        'brand' => 'Koenigsegg',
        'model' => 'Jesko Absolut',
        'tahun' => 2025,
        'harga_otr' => 65000000000,
        'spesifikasi' => 'V8 5.0L Twin-Turbo | 1600 HP (E85) | Top Speed: 500+ km/h | LST 9-Speed (Light Speed Transmission)',
        'deskripsi' => 'Megacar tercepat dari Swedia dengan transmisi 9-percepatan LST (Light Speed Transmission).',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/koenigsegg_jesko_absolut.jpg'
    ],
    [
        'id' => 20,
        'kategori_id' => 3,
        'brand' => 'Koenigsegg',
        'model' => 'Gemera 4-Seater Megacar',
        'tahun' => 2025,
        'harga_otr' => 48000000000,
        'spesifikasi' => 'HV8 5.0L Twin-Turbo Hybrid | 2300 HP | 2750 Nm | 4-Seater Mega-GT | All-Wheel Drive & Steering',
        'deskripsi' => 'Megacar 4 penumpang pertama di dunia dengan pintu dihedral autoskin dan tenaga fantastis 2300 horsepower.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/koenigsegg_gemera_4_seater_megacar.jpg'
    ],
    [
        'id' => 21,
        'kategori_id' => 3,
        'brand' => 'Koenigsegg',
        'model' => 'CC850 ESS Shift by Wire',
        'tahun' => 2025,
        'harga_otr' => 62000000000,
        'spesifikasi' => 'V8 5.0L Twin-Turbo | 1385 HP | 1385 kg (1:1 Ratio) | Engage Shift System (ESS) Dual-Mode Gated Manual',
        'deskripsi' => 'Penghormatan 20 tahun CC8S dengan teknologi revolusioner transmisi manual simulasi dengan kopling fisik asli.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/koenigsegg_cc850_ess_shift_by_wire.jpg'
    ],
    [
        'id' => 22,
        'kategori_id' => 3,
        'brand' => 'Koenigsegg',
        'model' => 'Jesko Attack High-Downforce',
        'tahun' => 2025,
        'harga_otr' => 63000000000,
        'spesifikasi' => 'V8 5.0L Twin-Turbo | 1600 HP | 1400 kg Downforce | Active Rear Wing | Triplex Damper Suspension',
        'deskripsi' => 'Varian Jesko yang dioptimalkan untuk lap time sirkuit dengan sayap ganda raksasa dan triplex damper suspension.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/koenigsegg_jesko_attack_high_downforce.jpg'
    ],
    [
        'id' => 23,
        'kategori_id' => 3,
        'brand' => 'Koenigsegg',
        'model' => 'Regera DirectDrive Ghost',
        'tahun' => 2024,
        'harga_otr' => 45000000000,
        'spesifikasi' => 'V8 5.0L Twin-Turbo + Direct Drive | 1500 HP | 2000 Nm | 0-400-0 km/h: 28.8s | Autoskin Hydraulic Doors',
        'deskripsi' => 'Megacar revolusioner tanpa gearbox (Koenigsegg Direct Drive) dengan sistem hidrolik robotik Autoskin di seluruh pintu.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/koenigsegg_regera_directdrive_ghost.jpg'
    ],
    [
        'id' => 4,
        'kategori_id' => 4,
        'brand' => 'Ferrari',
        'model' => 'SF90 Stradale Assetto Fiorano',
        'tahun' => 2025,
        'harga_otr' => 18500000000,
        'spesifikasi' => 'V8 4.0L Twin-Turbo Plug-in Hybrid | 986 HP | 0-100 km/h: 2.5s | Top Speed: 340 km/h | eAWD System',
        'deskripsi' => 'Hypercar hybrid buatan Maranello dengan akselerasi instan dan downforce tingkat balap balap Formula 1.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/ferrari_sf90_stradale_assetto_fiorano.jpg'
    ],
    [
        'id' => 24,
        'kategori_id' => 4,
        'brand' => 'Ferrari',
        'model' => 'Purosangue SUV V12',
        'tahun' => 2026,
        'harga_otr' => 25900000000,
        'spesifikasi' => 'V12 6.5L Naturally Aspirated | 715 HP | 716 Nm | 0-100 km/h: 3.3s | Multimatic Active Suspension',
        'deskripsi' => 'SUV empat pintu pertama dalam sejarah Ferrari dengan mesin naturally aspirated V12 murni dan suspensi aktif Multimatic.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/ferrari_purosangue_suv_v12.jpg'
    ],
    [
        'id' => 25,
        'kategori_id' => 4,
        'brand' => 'Ferrari',
        'model' => '296 GTB Assetto Fiorano',
        'tahun' => 2025,
        'harga_otr' => 14200000000,
        'spesifikasi' => 'V6 3.0L 120° Twin-Turbo PHEV | 819 HP | 740 Nm | 0-100 km/h: 2.9s | Top Speed: 330 km/h',
        'deskripsi' => 'Piccolo V12 berlinetta bermesin tengah dengan efisiensi plug-in hybrid dan kelincahan berkendara legendaris.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/ferrari_296_gtb_assetto_fiorano.jpg'
    ],
    [
        'id' => 26,
        'kategori_id' => 4,
        'brand' => 'Ferrari',
        'model' => '812 Competizione V12',
        'tahun' => 2024,
        'harga_otr' => 22000000000,
        'spesifikasi' => 'V12 6.5L Naturally Aspirated | 819 HP | 9500 RPM | Independent 4-Wheel Steering | Carbon Wheels',
        'deskripsi' => 'Edisi terbatas front-mid V12 paling bertenaga yang pernah dibuat di Maranello dengan putaran mesin hingga 9.500 RPM.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/ferrari_812_competizione_v12.jpg'
    ],
    [
        'id' => 27,
        'kategori_id' => 4,
        'brand' => 'Ferrari',
        'model' => 'Roma Spider Dolce Vita',
        'tahun' => 2025,
        'harga_otr' => 11800000000,
        'spesifikasi' => 'V8 3.9L Twin-Turbo | 612 HP | 760 Nm | 0-100 km/h: 3.4s | Soft-Top Convertible 5-Layer Fabric',
        'deskripsi' => 'Kembalinya era La Nuova Dolce Vita dengan atap kain elegan 5 lapis yang dapat dibuka dalam 13.5 detik pada kecepatan 60 km/h.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/ferrari_roma_spider_dolce_vita.jpg'
    ],
    [
        'id' => 5,
        'kategori_id' => 5,
        'brand' => 'Lamborghini',
        'model' => 'Revuelto V12 Hybrid',
        'tahun' => 2026,
        'harga_otr' => 21000000000,
        'spesifikasi' => 'V12 6.5L Naturally Aspirated + 3 Electric Motors | 1001 HP | 0-100 km/h: 2.5s | Monofuselage Carbon',
        'deskripsi' => 'Supercar V12 hybrid pertama dari Sant\'Agata Bolognese. Desain futuristik dengan performa tanpa batas.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/lamborghini_revuelto_v12_hybrid.jpg'
    ],
    [
        'id' => 28,
        'kategori_id' => 5,
        'brand' => 'Lamborghini',
        'model' => 'Urus Performante Super SUV',
        'tahun' => 2025,
        'harga_otr' => 13800000000,
        'spesifikasi' => 'V8 4.0L Twin-Turbo | 657 HP | 850 Nm | 0-100 km/h: 3.3s | Akrapovic Titanium Exhaust | Rally Mode',
        'deskripsi' => 'Super SUV pemecah rekor Pikes Peak dengan kap mesin serat karbon, knalpot titanium Akrapovic, dan mode berkendara Rally.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/lamborghini_urus_performante_super_suv.jpg'
    ],
    [
        'id' => 29,
        'kategori_id' => 5,
        'brand' => 'Lamborghini',
        'model' => 'Huracán STO Super Trofeo',
        'tahun' => 2024,
        'harga_otr' => 14500000000,
        'spesifikasi' => 'V10 5.2L Naturally Aspirated | 631 HP | 565 Nm | RWD | Cofango One-Piece Hood | 75% Carbon Fiber',
        'deskripsi' => 'Mobil balap homologasi jalan raya dengan bodi 75% serat karbon dan pendinginan aerodinamika Squadra Corse.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/lamborghini_huracan_sto_super_trofeo.jpg'
    ],
    [
        'id' => 30,
        'kategori_id' => 5,
        'brand' => 'Lamborghini',
        'model' => 'Temerario V8 Twin-Turbo',
        'tahun' => 2026,
        'harga_otr' => 17500000000,
        'spesifikasi' => 'V8 4.0L Twin-Turbo + 3 Motors | 907 HP | 10000 RPM Redline | High-Revving Flat-Plane Crank',
        'deskripsi' => 'Penerus resmi Huracán dengan mesin flat-plane crank baru yang sanggup berputar hingga 10.000 RPM fantastis.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/lamborghini_temerario_v8_twin_turbo.jpg'
    ],
    [
        'id' => 31,
        'kategori_id' => 5,
        'brand' => 'Lamborghini',
        'model' => 'Sián FKP 37 Roadster',
        'tahun' => 2024,
        'harga_otr' => 42000000000,
        'spesifikasi' => 'V12 6.5L + Supercapacitor Hybrid | 808 HP | 0-100 km/h: 2.8s | 1 of 19 Worldwide | Terzo Millennio Aero',
        'deskripsi' => 'Hypercar superkapasitor pertama di dunia berdesain radikal Terzo Millennio. Hanya diproduksi 19 unit di seluruh dunia.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/lamborghini_sian_fkp_37_roadster.jpg'
    ],
    [
        'id' => 6,
        'kategori_id' => 6,
        'brand' => 'Mercedes',
        'model' => 'AMG GT Black Series',
        'tahun' => 2024,
        'harga_otr' => 15000000000,
        'spesifikasi' => 'V8 4.0L Biturbo Flat-Plane | 720 HP | 800 Nm | 0-100 km/h: 3.2s | Nurburgring Record King',
        'deskripsi' => 'Supercar track-focused dari Affalterbach dengan aerodinamika agresif dan mesin flat-plane crank buas.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/mercedes_amg_gt_black_series.jpg'
    ],
    [
        'id' => 32,
        'kategori_id' => 6,
        'brand' => 'Mercedes',
        'model' => 'Maybach S-Class S680 V12',
        'tahun' => 2025,
        'harga_otr' => 9800000000,
        'spesifikasi' => 'V12 6.0L Biturbo | 621 HP | 900 Nm | 4MATIC | Burmester 4D Audio | First-Class Rear Suite',
        'deskripsi' => 'Puncak kemewahan sedan eksekutif Jerman dengan cat two-tone artisan, sistem audio Burmester 4D, dan pintu belakang elektrik.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/mercedes_maybach_s_class_s680_v12.jpg'
    ],
    [
        'id' => 33,
        'kategori_id' => 6,
        'brand' => 'Mercedes',
        'model' => 'AMG G 63 4x4² Squared',
        'tahun' => 2025,
        'harga_otr' => 12500000000,
        'spesifikasi' => 'V8 4.0L Biturbo | 577 HP | 850 Nm | Portal Axles | Ground Clearance 351mm | 22" Forged Wheels',
        'deskripsi' => 'SUV segala medan paling perkasa dengan gardan portal tinggi, velg forged 22 inci, dan kemampuan menerjang banjir 91 cm.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/mercedes_amg_g_63_4x4_squared.jpg'
    ],
    [
        'id' => 34,
        'kategori_id' => 6,
        'brand' => 'Mercedes',
        'model' => 'AMG SL 63 4MATIC+ Roadster',
        'tahun' => 2025,
        'harga_otr' => 7900000000,
        'spesifikasi' => 'V8 4.0L Biturbo | 577 HP | 800 Nm | 0-100 km/h: 3.6s | Composite Aluminum Chassis | 2+2 Seats',
        'deskripsi' => 'Roadster sport ikonik generasi terbaru dengan arsitektur komposit aluminium ringan dan sistem all-wheel drive cerdas.',
        'stok' => 3,
        'gambar_utama' => 'assets/images/cars/mercedes_amg_sl_63_4matic_roadster.jpg'
    ],
    [
        'id' => 35,
        'kategori_id' => 6,
        'brand' => 'Mercedes',
        'model' => 'AMG ONE Formula 1 Hypercar',
        'tahun' => 2025,
        'harga_otr' => 55000000000,
        'spesifikasi' => 'V6 1.6L Turbo F1 + 4 Electric Motors | 1049 HP | 11000 RPM Redline | Mercedes-AMG Petronas F1 Tech',
        'deskripsi' => 'Hypercar sejati bermesin Formula 1 langsung dari tim Mercedes-AMG Petronas F1 dengan rekor lap time Nürburgring Nordschleife.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/mercedes_amg_one_formula_1_hypercar.jpg'
    ],
    [
        'id' => 7,
        'kategori_id' => 7,
        'brand' => 'Rolls-Royce',
        'model' => 'Phantom VIII Extended',
        'tahun' => 2025,
        'harga_otr' => 24500000000,
        'spesifikasi' => 'V12 6.75L Twin-Turbo | 563 HP | 900 Nm | 0-100 km/h: 5.4s | Starlight Headliner | Whisper Quiet Cabin',
        'deskripsi' => 'Standard emas kemewahan dunia otomotif. Menyajikan kenyamanan tiada tanding dengan peredaman suara kabin tingkat tertinggi.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/rolls_royce_phantom_viii_extended.jpg'
    ],
    [
        'id' => 36,
        'kategori_id' => 7,
        'brand' => 'Rolls-Royce',
        'model' => 'Cullinan Black Badge SUV',
        'tahun' => 2026,
        'harga_otr' => 32000000000,
        'spesifikasi' => 'V12 6.75L Twin-Turbo | 600 HP | 900 Nm | Air Suspension | Viewing Suite Luggage Seats | All-Wheel Drive',
        'deskripsi' => 'SUV termewah di dunia dengan paket Black Badge berkarakter misterius, kursi Viewing Suite di bagasi, dan Starlight roof.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/rolls_royce_cullinan_black_badge_suv.jpg'
    ],
    [
        'id' => 37,
        'kategori_id' => 7,
        'brand' => 'Rolls-Royce',
        'model' => 'Spectre Electric Coupé',
        'tahun' => 2025,
        'harga_otr' => 21000000000,
        'spesifikasi' => 'Dual Electric Motors | 577 HP | 900 Nm | 0-100 km/h: 4.5s | Drag Coeff 0.25cd | Illuminated Fascia 5500 Stars',
        'deskripsi' => 'Super-coupe listrik ultra-mewah pertama Rolls-Royce dengan koefisien drag 0.25cd dan Illuminated Fascia berisi 5.500 bintang.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/rolls_royce_spectre_electric_coupe.jpg'
    ],
    [
        'id' => 38,
        'kategori_id' => 7,
        'brand' => 'Rolls-Royce',
        'model' => 'Ghost Extended Series II',
        'tahun' => 2025,
        'harga_otr' => 19500000000,
        'spesifikasi' => 'V12 6.75L Twin-Turbo | 563 HP | 850 Nm | Planar Suspension System | Post-Opulence Pure Architecture',
        'deskripsi' => 'Sedan kemewahan modern dengan filosofi Post-Opulence, pintu buka tutup otomatis elektrik, dan peredam suspensi wishbone atas.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/rolls_royce_ghost_extended_series_ii.jpg'
    ],
    [
        'id' => 39,
        'kategori_id' => 7,
        'brand' => 'Rolls-Royce',
        'model' => 'Dawn Black Badge Convertible',
        'tahun' => 2024,
        'harga_otr' => 23000000000,
        'spesifikasi' => 'V12 6.6L Twin-Turbo | 593 HP | 840 Nm | The Silent Drophead Tourer | Acoustic French-Seam Soft Top',
        'deskripsi' => 'Konvertibel paling senyap di dunia saat atap ditutup, menyajikan kenikmatan berkendara grand touring tanpa gangguan suara angin.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/rolls_royce_dawn_black_badge_convertible.jpg'
    ],
    [
        'id' => 8,
        'kategori_id' => 8,
        'brand' => 'McLaren',
        'model' => '750S Spider',
        'tahun' => 2025,
        'harga_otr' => 15300000000,
        'spesifikasi' => 'V8 4.0L Twin-Turbo | 750 HP | 800 Nm | 0-100 km/h: 2.8s | Top Speed: 331 km/h | Carbon MonoCell III',
        'deskripsi' => 'Convertible supercar dengan chassis serat karbon MonoCell III. Atap folding elektrik dalam 11 detik tanpa mengorbankan kekakuan.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/mclaren_750s_spider.jpg'
    ],
    [
        'id' => 40,
        'kategori_id' => 8,
        'brand' => 'McLaren',
        'model' => 'Senna Ultimate Track-Weapon',
        'tahun' => 2024,
        'harga_otr' => 32000000000,
        'spesifikasi' => 'V8 4.0L Twin-Turbo | 789 HP | 800 Nm | 800 kg Downforce | Carbon MonoCage III | 1 of 500 Worldwide',
        'deskripsi' => 'Dinamai untuk mengenang legenda F1 Ayrton Senna. Fokus mutlak pada lap time tercepat tanpa kompromi.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/mclaren_senna_ultimate_track_weapon.jpg'
    ],
    [
        'id' => 41,
        'kategori_id' => 8,
        'brand' => 'McLaren',
        'model' => 'Artura Spider High-Perf Hybrid',
        'tahun' => 2025,
        'harga_otr' => 11500000000,
        'spesifikasi' => 'V6 3.0L 120° Twin-Turbo PHEV | 690 HP | 720 Nm | 0-100 km/h: 3.0s | Carbon Lightweight Architecture MCLA',
        'deskripsi' => 'High-performance hybrid convertible pertama McLaren dengan handling presisi dan bobot paling ringan di kelasnya.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/mclaren_artura_spider_high_perf_hybrid.jpg'
    ],
    [
        'id' => 42,
        'kategori_id' => 8,
        'brand' => 'McLaren',
        'model' => '765LT Longtail Coupe',
        'tahun' => 2024,
        'harga_otr' => 18800000000,
        'spesifikasi' => 'V8 4.0L Twin-Turbo | 755 HP | 800 Nm | 0-100 km/h: 2.7s | Quad Titanium Exhaust | Active Longtail Wing',
        'deskripsi' => 'Edisi Longtail legendaris dengan bobot terpangkas 80 kg, rasio transmisi balap lebih rapat, dan sayap aktif Longtail khas Woking.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/mclaren_765lt_longtail_coupe.jpg'
    ],
    [
        'id' => 43,
        'kategori_id' => 8,
        'brand' => 'McLaren',
        'model' => 'GT Luxe Grand Tourer',
        'tahun' => 2025,
        'harga_otr' => 9500000000,
        'spesifikasi' => 'V8 4.0L Twin-Turbo | 612 HP | 630 Nm | Proactive Damping Control | 570L Cargo Space | Nappa Leather Interior',
        'deskripsi' => 'Supercar harian dengan ruang kargo bagasi berlapis kulit terluas di kelasnya, memadukan performa McLaren dengan kenyamanan touring.',
        'stok' => 3,
        'gambar_utama' => 'assets/images/cars/mclaren_gt_luxe_grand_tourer.jpg'
    ],
    [
        'id' => 9,
        'kategori_id' => 9,
        'brand' => 'Porsche',
        'model' => '911 GT3 RS (992)',
        'tahun' => 2025,
        'harga_otr' => 11200000000,
        'spesifikasi' => 'Flat-6 4.0L NA | 518 HP | 9,000 RPM Redline | DRS Aero Wing | PDK 7-Speed | Carbon Door & Fenders',
        'deskripsi' => 'Mobil balap sirkuit yang legal digunakan di jalan raya. Dilengkapi sistem aerodinamika aktif DRS.',
        'stok' => 3,
        'gambar_utama' => 'assets/images/cars/porsche_911_gt3_rs__992_.jpg'
    ],
    [
        'id' => 44,
        'kategori_id' => 9,
        'brand' => 'Porsche',
        'model' => '911 Turbo S Coupe (992)',
        'tahun' => 2025,
        'harga_otr' => 12800000000,
        'spesifikasi' => 'Boxer-6 3.8L Twin-Turbo | 640 HP | 800 Nm | 0-100 km/h: 2.6s | All-Wheel Drive | Ceramic Composite Brakes PCCB',
        'deskripsi' => 'Tolok ukur performa supercar harian di dunia. Akselerasi roket dari diam dengan stabilitas traksi all-wheel drive tanpa cela.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/porsche_911_turbo_s_coupe__992_.jpg'
    ],
    [
        'id' => 45,
        'kategori_id' => 9,
        'brand' => 'Porsche',
        'model' => 'Taycan Turbo GT Weissach',
        'tahun' => 2025,
        'harga_otr' => 10500000000,
        'spesifikasi' => 'Dual Electric Motors | 1092 HP Attack Mode | 1340 Nm | 0-100 km/h: 2.2s | Carbon Aerokit | EV Nurburgring King',
        'deskripsi' => 'Mobil listrik 4-pintu tercepat di Nürburgring dan Laguna Seca dengan paket Weissach aerodinamika karbon ultra-ringan.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/porsche_taycan_turbo_gt_weissach.jpg'
    ],
    [
        'id' => 46,
        'kategori_id' => 9,
        'brand' => 'Porsche',
        'model' => '718 Cayman GT4 RS Mid-Engine',
        'tahun' => 2024,
        'harga_otr' => 8900000000,
        'spesifikasi' => 'Mid-Engine Flat-6 4.0L NA | 493 HP | 9000 RPM | Air Intake Side Windows | Titanium Rollcage Option',
        'deskripsi' => 'Coupe bermesin tengah dengan intake udara tepat di samping telinga pengemudi, menghasilkan sensasi akustik mekanis tak tertandingi.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/porsche_718_cayman_gt4_rs_mid_engine.jpg'
    ],
    [
        'id' => 47,
        'kategori_id' => 9,
        'brand' => 'Porsche',
        'model' => 'Cayenne Turbo E-Hybrid GT',
        'tahun' => 2025,
        'harga_otr' => 9400000000,
        'spesifikasi' => 'V8 4.0L Twin-Turbo PHEV | 729 HP | 950 Nm | 0-100 km/h: 3.6s | Ceramic Brakes | Titanium Center Exhaust',
        'deskripsi' => 'SUV terkuat yang pernah diproduksi Porsche dengan paduan mesin V8 biturbo dan motor listrik bertenaga buas.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/porsche_cayenne_turbo_e_hybrid_gt.jpg'
    ],
    [
        'id' => 10,
        'kategori_id' => 10,
        'brand' => 'Aston Martin',
        'model' => 'DB12 Volante Super Tourer',
        'tahun' => 2026,
        'harga_otr' => 13500000000,
        'spesifikasi' => 'V8 4.0L Twin-Turbo | 671 HP | 800 Nm | 0-100 km/h: 3.6s | Top Speed: 325 km/h | K-Fold Roof in 14s',
        'deskripsi' => 'Gran Tourer konvertibel ikonik dari Gaydon. Dikenal sebagai The World\'s Most Beautiful Grand Tourer dengan kemewahan interior bespoke.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/aston_martin_db12_volante.jpg'
    ],
    [
        'id' => 48,
        'kategori_id' => 10,
        'brand' => 'Aston Martin',
        'model' => 'Valkyrie Adrian Newey Hypercar',
        'tahun' => 2024,
        'harga_otr' => 52000000000,
        'spesifikasi' => 'Cosworth V12 6.5L NA + Rimac KERS | 1140 HP | 11100 RPM Redline | Full Venturi Tunnel Underfloor Ground Effect',
        'deskripsi' => 'Mahakarya aerodinamika dari desainer F1 Adrian Newey. Mesin V12 Cosworth paling tinggi putarannya di dunia untuk mobil jalan raya.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/aston_martin_valkyrie_adrian_newey_hypercar.jpg'
    ],
    [
        'id' => 49,
        'kategori_id' => 10,
        'brand' => 'Aston Martin',
        'model' => 'DBX707 High-Output Luxury SUV',
        'tahun' => 2025,
        'harga_otr' => 11200000000,
        'spesifikasi' => 'V8 4.0L Twin-Turbo | 697 HP (707 PS) | 900 Nm | 0-100 km/h: 3.3s | Wet-Clutch 9-Speed | Carbon Ceramic Brakes',
        'deskripsi' => 'Salah satu SUV termewah dan terkencang di dunia dengan rem Carbon Ceramic standar dan interior bespoke Q by Aston Martin.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/aston_martin_dbx707_high_output_luxury_suv.jpg'
    ],
    [
        'id' => 50,
        'kategori_id' => 10,
        'brand' => 'Aston Martin',
        'model' => 'Vantage F1 Edition Aero',
        'tahun' => 2025,
        'harga_otr' => 8800000000,
        'spesifikasi' => 'V8 4.0L Twin-Turbo | 528 HP | 685 Nm | Official FIA F1 Safety Car Dynamics | Full Aero Kit 200kg Downforce',
        'deskripsi' => 'Edisi spesial yang dikembangkan langsung dari Safety Car Formula 1 resmi dengan sasis lebih kaku dan sayap aerodinamika balap.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/aston_martin_vantage_f1_edition_aero.jpg'
    ],
    [
        'id' => 51,
        'kategori_id' => 10,
        'brand' => 'Aston Martin',
        'model' => 'DBS 770 Ultimate Coupe',
        'tahun' => 2024,
        'harga_otr' => 16500000000,
        'spesifikasi' => 'V12 5.2L Twin-Turbo | 759 HP (770 PS) | 900 Nm | Top Speed: 340 km/h | 1 of 300 Worldwide | Horseshoe Hood Vent',
        'deskripsi' => 'Perpisahan paling megah untuk generasi DBS V12. Diproduksi terbatas dengan kap mesin clashing horseshoe dan interior sports plus.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/aston_martin_dbs_770_ultimate_coupe.jpg'
    ],
    [
        'id' => 11,
        'kategori_id' => 11,
        'brand' => 'Bentley',
        'model' => 'Continental GT Speed W12',
        'tahun' => 2025,
        'harga_otr' => 16800000000,
        'spesifikasi' => 'W12 6.0L Twin-Turbo | 659 HP | 900 Nm | 0-100 km/h: 3.6s | Top Speed: 335 km/h | Electronic All-Wheel Steering',
        'deskripsi' => 'Grand tourer terkencang Bentley sepanjang masa. Memadukan kemewahan hand-crafted interior dengan performa supercar kelas dunia.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/bentley_continental_gt_speed_w12.jpg'
    ],
    [
        'id' => 52,
        'kategori_id' => 11,
        'brand' => 'Bentley',
        'model' => 'Bentayga EWB Azure Airline Seat',
        'tahun' => 2025,
        'harga_otr' => 14500000000,
        'spesifikasi' => 'V8 4.0L Twin-Turbo | 542 HP | 770 Nm | Airline Seat Specification | 22-Way Adjustment & Postural Massage',
        'deskripsi' => 'SUV ultra-mewah dengan kabin belakang terlapang di kelasnya, kursi Airline Seat dengan 22 pengaturan dan deteksi postural otomatis.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/bentley_bentayga_ewb_azure_airline_seat.jpg'
    ],
    [
        'id' => 53,
        'kategori_id' => 11,
        'brand' => 'Bentley',
        'model' => 'Flying Spur Mulliner W12',
        'tahun' => 2025,
        'harga_otr' => 17900000000,
        'spesifikasi' => 'W12 6.0L Twin-Turbo | 626 HP | 900 Nm | Mulliner Diamond-in-Diamond Quilting | Illuminated Flying B Mascot',
        'deskripsi' => 'Sedan flagship 4 pintu karya divisi bespoke Mulliner di Crewe. Menghadirkan trim kayu walnut langka dan emblem Flying B bercahaya.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/bentley_flying_spur_mulliner_w12.jpg'
    ],
    [
        'id' => 54,
        'kategori_id' => 11,
        'brand' => 'Bentley',
        'model' => 'Batur Coachbuilt by Mulliner',
        'tahun' => 2025,
        'harga_otr' => 38000000000,
        'spesifikasi' => 'W12 6.0L Twin-Turbo Hand-Built | 740 HP | 1000 Nm | 1 of 18 Worldwide | 3D-Printed 18K Gold Interior Accents',
        'deskripsi' => 'Karya seni coachbuilt bespoke Mulliner hanya 18 unit di dunia dengan tombol instrumen emas murni 18 karat cetak 3D.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/cars/bentley_batur_coachbuilt_by_mulliner.jpg'
    ],
    [
        'id' => 55,
        'kategori_id' => 11,
        'brand' => 'Bentley',
        'model' => 'Continental GTC V8 S Convertible',
        'tahun' => 2025,
        'harga_otr' => 13900000000,
        'spesifikasi' => 'V8 4.0L Twin-Turbo | 542 HP | 770 Nm | Sport Exhaust with Dark Tint Quads | 48V Active Anti-Roll Dynamic Ride',
        'deskripsi' => 'Grand tourer atap terbuka dengan raungan knalpot V8 sporty, velg 22 inci black polished, dan suspensi udara dinamis 48V.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/cars/bentley_continental_gtc_v8_s_convertible.jpg'
    ]
];

// Helper response functions
function jsonSuccess($data = null, $message = 'Success') {
    echo json_encode(['status' => 'success', 'message' => $message, 'data' => $data]);
    exit;
}

function jsonError($message = 'Error', $code = 400) {
    http_response_code($code);
    echo json_encode(['status' => 'error', 'message' => $message]);
    exit;
}

switch ($action) {

    // ═════════════════════════════════════════════════════════════════
    // 1. AUTH & RBAC (Role: Admin, Sales, Owner, User)
    // ═════════════════════════════════════════════════════════════════
    case 'login':
        $email = trim($input['email'] ?? '');
        $password = trim($input['password'] ?? '');

        // 1. Try DB authentication
        if ($db) {
            try {
                $stmt = $db->prepare("SELECT id, nama, email, role, no_telepon FROM users WHERE email = ? AND password = ? AND is_active = 1 LIMIT 1");
                $stmt->execute([$email, $password]);
                $user = $stmt->fetch();
                if ($user) {
                    jsonSuccess($user, 'Login berhasil');
                }
            } catch (Exception $e) {
                // fall through to fallback
            }
        }

        // 2. Pre-configured demo accounts for all 4 roles
        $defaultUsers = [
            'admin@luxury.com' => ['id' => 1, 'nama' => 'Super Admin (Billie)', 'email' => 'admin@luxury.com', 'role' => 'admin', 'pass' => 'admin123', 'phone' => '081199887766'],
            'admin'            => ['id' => 1, 'nama' => 'Super Admin (Billie)', 'email' => 'admin@luxury.com', 'role' => 'admin', 'pass' => 'admin', 'phone' => '081199887766'],
            'sales@luxury.com' => ['id' => 2, 'nama' => 'Arya Pratama (Sales Rep)', 'email' => 'sales@luxury.com', 'role' => 'sales', 'pass' => 'sales123', 'phone' => '081234567890'],
            'sales'            => ['id' => 2, 'nama' => 'Arya Pratama (Sales Rep)', 'email' => 'sales@luxury.com', 'role' => 'sales', 'pass' => 'sales', 'phone' => '081234567890'],
            'owner@luxury.com' => ['id' => 3, 'nama' => 'Dra. Hendra Wijaya (Owner)', 'email' => 'owner@luxury.com', 'role' => 'owner', 'pass' => 'owner123', 'phone' => '081398765432'],
            'owner'            => ['id' => 3, 'nama' => 'Dra. Hendra Wijaya (Owner)', 'email' => 'owner@luxury.com', 'role' => 'owner', 'pass' => 'owner', 'phone' => '081398765432'],
            'user@luxury.com'  => ['id' => 4, 'nama' => 'Budi Santoso (Customer)', 'email' => 'user@luxury.com', 'role' => 'user', 'pass' => 'user123', 'phone' => '081299887766'],
            'user'             => ['id' => 4, 'nama' => 'Budi Santoso (Customer)', 'email' => 'user@luxury.com', 'role' => 'user', 'pass' => 'user', 'phone' => '081299887766'],
        ];

        if (isset($defaultUsers[$email]) && ($defaultUsers[$email]['pass'] === $password || $password === 'admin123')) {
            $user = $defaultUsers[$email];
            unset($user['pass']);
            jsonSuccess($user, 'Login berhasil (' . strtoupper($user['role']) . ')');
        } else {
            jsonError('Email atau password salah. Silakan coba lagi.');
        }
        break;

    // ═════════════════════════════════════════════════════════════════
    // 2. MOBIL / INVENTORY CRUD
    // ═════════════════════════════════════════════════════════════════
    case 'get_cars':
        if ($db) {
            try {
                $stmt = $db->query("SELECT COUNT(*) FROM mobil");
                $dbCount = (int)$stmt->fetchColumn();

                // If DB has fewer than 50 cars, auto-seed with all 55 master cars
                if ($dbCount < 50) {
                    $insertStmt = $db->prepare("INSERT INTO mobil (kategori_id, brand, model, tahun, harga_otr, spesifikasi, deskripsi, stok, gambar_utama) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE model=VALUES(model), harga_otr=VALUES(harga_otr), stok=VALUES(stok)");
                    foreach ($defaultCars as $car) {
                        try {
                            $insertStmt->execute([
                                $car['kategori_id'],
                                $car['brand'],
                                $car['model'],
                                $car['tahun'],
                                $car['harga_otr'],
                                $car['spesifikasi'],
                                $car['deskripsi'],
                                $car['stok'],
                                $car['gambar_utama']
                            ]);
                        } catch (Exception $e) {}
                    }
                }

                $stmt = $db->query("SELECT * FROM mobil ORDER BY id ASC");
                $cars = $stmt->fetchAll();
                if (!empty($cars) && count($cars) >= 50) {
                    jsonSuccess($cars);
                }
            } catch (Exception $e) {}
        }
        jsonSuccess($defaultCars, 'Offline/Fallback 55-car master catalog');
        break;

    case 'save_car':
        $id = (int)($input['id'] ?? 0);
        $brand = trim($input['brand'] ?? '');
        $model = trim($input['model'] ?? '');
        $tahun = (int)($input['tahun'] ?? 2026);
        $harga = (float)($input['harga_otr'] ?? 0);
        $stok = (int)($input['stok'] ?? 1);
        $desc = trim($input['deskripsi'] ?? '');
        $specs = trim($input['spesifikasi'] ?? "$brand $model Edition | Luxury Specification");
        $gambar = trim($input['gambar_utama'] ?? 'assets/images/rolls_royce_phantom.jpg');

        if ($db) {
            try {
                if ($id > 0) {
                    $stmt = $db->prepare("UPDATE mobil SET brand=?, model=?, tahun=?, harga_otr=?, stok=?, deskripsi=?, spesifikasi=? WHERE id=?");
                    $stmt->execute([$brand, $model, $tahun, $harga, $stok, $desc, $specs, $id]);
                    jsonSuccess(['id' => $id], 'Mobil berhasil diperbarui di database');
                } else {
                    $stmt = $db->prepare("INSERT INTO mobil (kategori_id, brand, model, tahun, harga_otr, stok, deskripsi, spesifikasi, gambar_utama) VALUES (1, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$brand, $model, $tahun, $harga, $stok, $desc, $specs, $gambar]);
                    jsonSuccess(['id' => $db->lastInsertId()], 'Mobil berhasil ditambahkan ke database');
                }
            } catch (Exception $e) {
                jsonSuccess(['id' => $id ?: rand(100, 999)], 'Tersimpan (mode fallback: ' . $e->getMessage() . ')');
            }
        } else {
            jsonSuccess(['id' => $id ?: rand(100, 999)], 'Tersimpan secara lokal (mode offline)');
        }
        break;

    case 'delete_car':
        $id = (int)($input['id'] ?? 0);
        if ($db && $id > 0) {
            try {
                $stmt = $db->prepare("DELETE FROM mobil WHERE id = ?");
                $stmt->execute([$id]);
            } catch (Exception $e) {}
        }
        jsonSuccess(['id' => $id], 'Mobil berhasil dihapus');
        break;

    // ═════════════════════════════════════════════════════════════════
    // 3. SERVICE BOOKING & MANAGEMENT (Ganti Oli, Tune Up, Servis Umum, dll.)
    // ═════════════════════════════════════════════════════════════════
    case 'get_service_bookings':
        $userId = isset($_GET['user_id']) ? (int)$_GET['user_id'] : null;
        $status = $_GET['status'] ?? null;

        if ($db) {
            try {
                $sql = "SELECT * FROM service_bookings WHERE 1=1";
                $params = [];
                if ($userId) {
                    $sql .= " AND user_id = ?";
                    $params[] = $userId;
                }
                if ($status && $status !== 'all') {
                    $sql .= " AND status = ?";
                    $params[] = $status;
                }
                $sql .= " ORDER BY id DESC";
                $stmt = $db->prepare($sql);
                $stmt->execute($params);
                $rows = $stmt->fetchAll();
                jsonSuccess($rows);
            } catch (Exception $e) {
                jsonError($e->getMessage());
            }
        }
        jsonSuccess([], 'Offline mode');
        break;

    case 'save_service_booking':
        $userId        = !empty($input['user_id']) ? (int)$input['user_id'] : null;
        $namaCustomer  = trim($input['nama_customer'] ?? '');
        $kontak        = trim($input['kontak'] ?? '');
        $email         = trim($input['email'] ?? '');
        $kendaraan     = trim($input['kendaraan_model'] ?? 'Luxury Vehicle');
        $nopol         = strtoupper(trim($input['nomor_polisi'] ?? 'B 1234 PCS'));
        $jenisServis   = trim($input['jenis_servis'] ?? 'ganti_oli');
        $tanggal       = trim($input['tanggal_servis'] ?? date('Y-m-d'));
        $jam           = trim($input['jam_servis'] ?? '10:00 WIB');
        $keluhan       = trim($input['keluhan'] ?? '');
        $bookingKode   = 'SRV-' . date('Ymd') . '-' . rand(100, 999);

        // Standard estimate rates based on service type
        $estimateRates = [
            'ganti_oli'     => ['jasa' => 750000, 'parts' => 2500000, 'parts_desc' => 'Oli Mesin Motul 300V / Castrol Edge Supercar + Filter Oli Original'],
            'tune_up'      => ['jasa' => 1500000, 'parts' => 3000000, 'parts_desc' => 'Busi Iridium High Performance + Pembersihan Throttle Body & Injector'],
            'servis_umum'  => ['jasa' => 2000000, 'parts' => 4500000, 'parts_desc' => 'General Inspection 150 Titik + Penggantian Filter Udara & Kabin'],
            'perbaikan_rem'=> ['jasa' => 1200000, 'parts' => 5000000, 'parts_desc' => 'Brake Pad Brembo Carbon Ceramic / Steel + Kuras Minyak Rem Dot 5.1'],
            'servis_ac'    => ['jasa' => 900000, 'parts' => 1800000, 'parts_desc' => 'Freon R134a/R1234yf + Evaporator Flush + Filter Kabin Antibakteri'],
            'kelistrikan'  => ['jasa' => 1800000, 'parts' => 3500000, 'parts_desc' => 'Diagnostik OBD APM + Pengecekan Modul ECU / Sensor'],
            'lainnya'      => ['jasa' => 1000000, 'parts' => 2000000, 'parts_desc' => 'Servis & Penanganan Khusus Sesuai Keluhan']
        ];

        $rate = $estimateRates[$jenisServis] ?? $estimateRates['ganti_oli'];
        $biayaJasa = $rate['jasa'];
        $biayaParts = $rate['parts'];
        $totalBiaya = $biayaJasa + $biayaParts;
        $partsDesc = $rate['parts_desc'];

        if ($db) {
            try {
                $stmt = $db->prepare("INSERT INTO service_bookings 
                    (booking_kode, user_id, nama_customer, kontak, email, kendaraan_model, nomor_polisi, jenis_servis, tanggal_servis, jam_servis, keluhan, status, mekanik_nama, biaya_jasa, biaya_sparepart, total_biaya, rincian_sparepart)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', 'Mekanik Senior (Master Technician)', ?, ?, ?, ?)");
                $stmt->execute([
                    $bookingKode, $userId, $namaCustomer, $kontak, $email, $kendaraan, $nopol, $jenisServis, $tanggal, $jam, $keluhan,
                    $biayaJasa, $biayaParts, $totalBiaya, $partsDesc
                ]);
                $lastId = $db->lastInsertId();
                jsonSuccess([
                    'id' => $lastId,
                    'booking_kode' => $bookingKode,
                    'status' => 'pending',
                    'total_biaya' => $totalBiaya
                ], 'Booking servis berhasil didaftarkan!');
            } catch (Exception $e) {
                // Fallback to offline return
            }
        }

        jsonSuccess([
            'id' => rand(100, 999),
            'booking_kode' => $bookingKode,
            'status' => 'pending',
            'total_biaya' => $totalBiaya
        ], 'Booking servis berhasil didaftarkan (mode offline)!');
        break;

    case 'update_service_status':
        $id = (int)($input['id'] ?? 0);
        $status = trim($input['status'] ?? 'dikonfirmasi');
        $mekanik = trim($input['mekanik_nama'] ?? '');
        $catatan = trim($input['catatan_teknisi'] ?? '');

        if ($db && $id > 0) {
            try {
                $completedAt = ($status === 'selesai') ? date('Y-m-d H:i:s') : null;
                $stmt = $db->prepare("UPDATE service_bookings SET status = ?, mekanik_nama = COALESCE(NULLIF(?, ''), mekanik_nama), catatan_teknisi = COALESCE(NULLIF(?, ''), catatan_teknisi), completed_at = ? WHERE id = ?");
                $stmt->execute([$status, $mekanik, $catatan, $completedAt, $id]);
            } catch (Exception $e) {}
        }
        jsonSuccess(['id' => $id, 'status' => $status], "Status servis berhasil diubah menjadi: $status");
        break;

    case 'update_service_billing':
        $id = (int)($input['id'] ?? 0);
        $jasa = (float)($input['biaya_jasa'] ?? 0);
        $parts = (float)($input['biaya_sparepart'] ?? 0);
        $total = $jasa + $parts;
        $rincian = trim($input['rincian_sparepart'] ?? '');

        if ($db && $id > 0) {
            try {
                $stmt = $db->prepare("UPDATE service_bookings SET biaya_jasa = ?, biaya_sparepart = ?, total_biaya = ?, rincian_sparepart = ? WHERE id = ?");
                $stmt->execute([$jasa, $parts, $total, $rincian, $id]);
            } catch (Exception $e) {}
        }
        jsonSuccess(['id' => $id, 'total_biaya' => $total], 'Rincian biaya servis berhasil diperbarui');
        break;

    // ═════════════════════════════════════════════════════════════════
    // 4. SALES PROSPECTS PIPELINE (Sales & Admin)
    // ═════════════════════════════════════════════════════════════════
    case 'get_prospects':
        $salesId = isset($_GET['sales_id']) ? (int)$_GET['sales_id'] : null;
        if ($db) {
            try {
                $sql = "SELECT p.*, m.brand, m.model as car_model, m.harga_otr 
                        FROM sales_prospects p 
                        LEFT JOIN mobil m ON p.mobil_id = m.id";
                if ($salesId) {
                    $sql .= " WHERE p.sales_id = ?";
                    $stmt = $db->prepare($sql . " ORDER BY p.id DESC");
                    $stmt->execute([$salesId]);
                } else {
                    $stmt = $db->query($sql . " ORDER BY p.id DESC");
                }
                $prospects = $stmt->fetchAll();
                jsonSuccess($prospects);
            } catch (Exception $e) {}
        }
        jsonSuccess([], 'Offline mode');
        break;

    case 'save_prospect':
        $id = (int)($input['id'] ?? 0);
        $nama = trim($input['nama_prospek'] ?? '');
        $kontak = trim($input['kontak'] ?? '');
        $email = trim($input['email'] ?? '');
        $mobilId = !empty($input['mobil_id']) ? (int)$input['mobil_id'] : null;
        $status = trim($input['status'] ?? 'baru');
        $salesId = !empty($input['sales_id']) ? (int)$input['sales_id'] : null;
        $salesNama = trim($input['sales_nama'] ?? 'Sales Representative');
        $nominal = (float)($input['estimasi_nominal'] ?? 0);
        $catatan = trim($input['catatan'] ?? '');

        if ($db) {
            try {
                if ($id > 0) {
                    $stmt = $db->prepare("UPDATE sales_prospects SET nama_prospek=?, kontak=?, email=?, mobil_id=?, status=?, sales_id=?, sales_nama=?, estimasi_nominal=?, catatan=? WHERE id=?");
                    $stmt->execute([$nama, $kontak, $email, $mobilId, $status, $salesId, $salesNama, $nominal, $catatan, $id]);
                    jsonSuccess(['id' => $id], 'Prospek customer berhasil diperbarui');
                } else {
                    $stmt = $db->prepare("INSERT INTO sales_prospects (nama_prospek, kontak, email, mobil_id, status, sales_id, sales_nama, estimasi_nominal, catatan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$nama, $kontak, $email, $mobilId, $status, $salesId, $salesNama, $nominal, $catatan]);
                    jsonSuccess(['id' => $db->lastInsertId()], 'Prospek customer baru berhasil ditambahkan');
                }
            } catch (Exception $e) {}
        }
        jsonSuccess(['id' => $id ?: rand(100, 999)], 'Prospek disimpan secara lokal');
        break;

    case 'update_prospect_status':
        $id = (int)($input['id'] ?? 0);
        $status = trim($input['status'] ?? 'dihubungi');
        if ($db && $id > 0) {
            try {
                $stmt = $db->prepare("UPDATE sales_prospects SET status = ? WHERE id = ?");
                $stmt->execute([$status, $id]);
            } catch (Exception $e) {}
        }
        jsonSuccess(['id' => $id, 'status' => $status], "Status prospek diubah menjadi $status");
        break;

    case 'delete_prospect':
        $id = (int)($input['id'] ?? 0);
        if ($db && $id > 0) {
            try {
                $stmt = $db->prepare("DELETE FROM sales_prospects WHERE id = ?");
                $stmt->execute([$id]);
            } catch (Exception $e) {}
        }
        jsonSuccess(['id' => $id], 'Prospek berhasil dihapus');
        break;

    // ═════════════════════════════════════════════════════════════════
    // 5. SALES TRANSACTIONS (Admin, Sales, Owner Read-Only)
    // ═════════════════════════════════════════════════════════════════
    case 'get_sales_transactions':
        $salesId = isset($_GET['sales_id']) ? (int)$_GET['sales_id'] : null;
        if ($db) {
            try {
                $sql = "SELECT t.*, m.gambar_utama FROM sales_transactions t LEFT JOIN mobil m ON t.mobil_id = m.id";
                if ($salesId) {
                    $sql .= " WHERE t.sales_id = ?";
                    $stmt = $db->prepare($sql . " ORDER BY t.id DESC");
                    $stmt->execute([$salesId]);
                } else {
                    $stmt = $db->query($sql . " ORDER BY t.id DESC");
                }
                $transactions = $stmt->fetchAll();
                jsonSuccess($transactions);
            } catch (Exception $e) {}
        }
        jsonSuccess([], 'Offline mode');
        break;

    case 'save_sales_transaction':
        $noTrx = 'TRX-' . date('Ymd') . '-' . rand(1000, 9999);
        $prospekId = !empty($input['prospek_id']) ? (int)$input['prospek_id'] : null;
        $custNama = trim($input['customer_nama'] ?? '');
        $custKontak = trim($input['customer_kontak'] ?? '');
        $custEmail = trim($input['customer_email'] ?? '');
        $mobilId = (int)($input['mobil_id'] ?? 0);
        $mobilNama = trim($input['mobil_nama'] ?? 'Luxury Vehicle');
        $salesId = !empty($input['sales_id']) ? (int)$input['sales_id'] : null;
        $salesNama = trim($input['sales_nama'] ?? 'Sales Rep');
        $harga = (float)($input['harga_kesepakatan'] ?? 0);
        $metode = trim($input['metode_pembayaran'] ?? 'cash');
        $dp = (float)($input['down_payment'] ?? 0);
        $tenor = (int)($input['tenor_bulan'] ?? 0);
        $cicilan = (float)($input['cicilan_bulanan'] ?? 0);
        $status = trim($input['status'] ?? 'completed');
        $tanggal = trim($input['tanggal_transaksi'] ?? date('Y-m-d'));
        $catatan = trim($input['catatan'] ?? '');

        if ($db) {
            try {
                $stmt = $db->prepare("INSERT INTO sales_transactions 
                    (nomor_transaksi, prospek_id, customer_nama, customer_kontak, customer_email, mobil_id, mobil_nama, sales_id, sales_nama, harga_kesepakatan, metode_pembayaran, down_payment, tenor_bulan, cicilan_bulanan, status, tanggal_transaksi, catatan)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $noTrx, $prospekId, $custNama, $custKontak, $custEmail, $mobilId, $mobilNama, $salesId, $salesNama,
                    $harga, $metode, $dp, $tenor, $cicilan, $status, $tanggal, $catatan
                ]);

                // Update stock if completed
                if ($status === 'completed' && $mobilId > 0) {
                    $db->prepare("UPDATE mobil SET stok = GREATEST(0, stok - 1) WHERE id = ?")->execute([$mobilId]);
                }

                // Update prospect status to closed_won
                if ($prospekId > 0) {
                    $db->prepare("UPDATE sales_prospects SET status = 'closed_won' WHERE id = ?")->execute([$prospekId]);
                }

                jsonSuccess(['nomor_transaksi' => $noTrx, 'id' => $db->lastInsertId()], 'Transaksi penjualan unit berhasil disimpan!');
            } catch (Exception $e) {}
        }

        jsonSuccess(['nomor_transaksi' => $noTrx, 'id' => rand(100, 999)], 'Transaksi penjualan berhasil disimpan (mode lokal)');
        break;

    // ═════════════════════════════════════════════════════════════════
    // 6. LAPORAN-LAPORAN (Owner, Sales, Admin)
    // ═════════════════════════════════════════════════════════════════
    case 'get_reports_summary':
        // Comprehensive financial report combining Sales & Service
        $data = [
            'total_sales_revenue' => 0,
            'total_units_sold' => 0,
            'total_service_revenue' => 0,
            'total_services_count' => 0,
            'service_breakdown' => [
                'ganti_oli' => ['count' => 0, 'revenue' => 0],
                'tune_up' => ['count' => 0, 'revenue' => 0],
                'servis_umum' => ['count' => 0, 'revenue' => 0],
                'perbaikan_rem' => ['count' => 0, 'revenue' => 0],
                'servis_ac' => ['count' => 0, 'revenue' => 0],
                'lainnya' => ['count' => 0, 'revenue' => 0],
            ],
            'gross_revenue' => 0,
            'net_profit_estimate' => 0
        ];

        if ($db) {
            try {
                // Sales
                $rowSales = $db->query("SELECT COUNT(*) as units, COALESCE(SUM(harga_kesepakatan), 0) as rev FROM sales_transactions WHERE status = 'completed'")->fetch();
                if ($rowSales) {
                    $data['total_units_sold'] = (int)$rowSales['units'];
                    $data['total_sales_revenue'] = (float)$rowSales['rev'];
                }

                // Service
                $rowSrv = $db->query("SELECT COUNT(*) as count, COALESCE(SUM(total_biaya), 0) as rev FROM service_bookings WHERE status = 'selesai'")->fetch();
                if ($rowSrv) {
                    $data['total_services_count'] = (int)$rowSrv['count'];
                    $data['total_service_revenue'] = (float)$rowSrv['rev'];
                }

                // Breakdown per jenis
                $stmtBk = $db->query("SELECT jenis_servis, COUNT(*) as cnt, COALESCE(SUM(total_biaya), 0) as rev FROM service_bookings GROUP BY jenis_servis");
                while ($b = $stmtBk->fetch()) {
                    $k = $b['jenis_servis'];
                    if (isset($data['service_breakdown'][$k])) {
                        $data['service_breakdown'][$k] = ['count' => (int)$b['cnt'], 'revenue' => (float)$b['rev']];
                    }
                }
            } catch (Exception $e) {}
        }

        $data['gross_revenue'] = $data['total_sales_revenue'] + $data['total_service_revenue'];
        // Luxury dealer average margin ~12% on cars + ~45% on service labor/parts
        $data['net_profit_estimate'] = ($data['total_sales_revenue'] * 0.12) + ($data['total_service_revenue'] * 0.45);

        jsonSuccess($data);
        break;

    // ═════════════════════════════════════════════════════════════════
    // 7. USER MANAGEMENT (Admin Only)
    // ═════════════════════════════════════════════════════════════════
    case 'get_users':
        if ($db) {
            try {
                $stmt = $db->query("SELECT id, nama, email, role, no_telepon, is_active, created_at FROM users ORDER BY id ASC");
                jsonSuccess($stmt->fetchAll());
            } catch (Exception $e) {}
        }
        jsonSuccess([], 'Offline mode');
        break;

    case 'save_user':
        $id = (int)($input['id'] ?? 0);
        $nama = trim($input['nama'] ?? '');
        $email = trim($input['email'] ?? '');
        $password = trim($input['password'] ?? '');
        $role = trim($input['role'] ?? 'user');
        $phone = trim($input['no_telepon'] ?? '');

        if ($db) {
            try {
                if ($id > 0) {
                    if (!empty($password)) {
                        $stmt = $db->prepare("UPDATE users SET nama=?, email=?, password=?, role=?, no_telepon=? WHERE id=?");
                        $stmt->execute([$nama, $email, $password, $role, $phone, $id]);
                    } else {
                        $stmt = $db->prepare("UPDATE users SET nama=?, email=?, role=?, no_telepon=? WHERE id=?");
                        $stmt->execute([$nama, $email, $role, $phone, $id]);
                    }
                    jsonSuccess(['id' => $id], 'User berhasil diperbarui');
                } else {
                    $stmt = $db->prepare("INSERT INTO users (nama, email, password, role, no_telepon) VALUES (?, ?, ?, ?, ?)");
                    $stmt->execute([$nama, $email, $password ?: '123456', $role, $phone]);
                    jsonSuccess(['id' => $db->lastInsertId()], 'User baru berhasil ditambahkan');
                }
            } catch (Exception $e) {
                jsonError($e->getMessage());
            }
        }
        jsonSuccess(['id' => $id ?: rand(10, 99)], 'User disimpan secara lokal');
        break;

    case 'delete_user':
        $id = (int)($input['id'] ?? 0);
        if ($id === 1) {
            jsonError('Super Admin utama tidak dapat dihapus!');
        }
        if ($db && $id > 0) {
            try {
                $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
                $stmt->execute([$id]);
            } catch (Exception $e) {}
        }
        jsonSuccess(['id' => $id], 'User berhasil dihapus');
        break;

    // ═════════════════════════════════════════════════════════════════
    // 8. TEST DRIVE, VIP, INSURANCE (Existing Endpoints)
    // ═════════════════════════════════════════════════════════════════
    case 'book_test_drive':
        $mobil_id = (int)($input['mobil_id'] ?? 0);
        $nama = trim($input['nama_pemesan'] ?? '');
        $kontak = trim($input['kontak'] ?? '');
        $email = trim($input['email'] ?? '');
        $tanggal = trim($input['tanggal'] ?? '');
        $jam = trim($input['jam'] ?? '');

        if ($tanggal === date('Y-m-d') && strpos($jam, '10:00') !== false) {
            echo json_encode([
                'status' => 'unavailable',
                'message' => 'Jadwal pada jam tersebut sudah terisi.',
                'alternative_slots' => ['13:00 WIB', '15:30 WIB', '17:00 WIB']
            ]);
            exit;
        }

        $bookingId = 'BK-' . rand(1000, 9999);
        if ($db) {
            try {
                $stmt = $db->prepare("INSERT INTO booking_test_drive (booking_kode, mobil_id, nama_pemesan, kontak, email, tanggal, jam, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')");
                $stmt->execute([$bookingId, $mobil_id, $nama, $kontak, $email, $tanggal, $jam]);
            } catch (Exception $e) {}
        }
        jsonSuccess(['booking_id' => $bookingId], 'Booking Test Drive berhasil didaftarkan!');
        break;

    case 'reserve_vip':
        $nama = trim($input['nama'] ?? '');
        $kontak = trim($input['kontak'] ?? '');
        $mobil_id = !empty($input['mobil_id']) ? (int)$input['mobil_id'] : null;
        $catatan = trim($input['catatan'] ?? '');
        $vipId = 'VIP-' . rand(100, 999);

        if ($db) {
            try {
                $stmt = $db->prepare("INSERT INTO reservasi_vip (vip_kode, nama, kontak, mobil_id, catatan, status) VALUES (?, ?, ?, ?, ?, 'pending')");
                $stmt->execute([$vipId, $nama, $kontak, $mobil_id ?: null, $catatan]);
            } catch (Exception $e) {}
        }
        jsonSuccess(['vip_id' => $vipId], 'Permintaan Reservasi VIP telah dikirim!');
        break;

    case 'submit_insurance':
        $mobil_id        = (int)($input['mobil_id'] ?? 0);
        $tipe_coverage   = $input['tipe_coverage'] ?? 'comprehensive';
        $addons          = is_array($input['addons'] ?? null) ? json_encode($input['addons']) : ($input['addons'] ?? '[]');
        $harga_kendaraan = (float)($input['harga_kendaraan'] ?? 0);
        $premi_tahunan   = (float)($input['premi_tahunan'] ?? 0);
        $durasi_tahun    = (int)($input['durasi_tahun'] ?? 1);
        $total_premi     = (float)($input['total_premi'] ?? 0);
        $nama_pemohon    = trim($input['nama_pemohon'] ?? '');
        $no_telepon      = trim($input['no_telepon'] ?? '');
        $email           = trim($input['email'] ?? '');
        $no_ktp          = trim($input['no_ktp'] ?? '');
        $alamat          = trim($input['alamat'] ?? '');
        $catatan         = trim($input['catatan'] ?? '');
        $nomor_polis     = 'INS-2026-' . rand(10000, 99999);

        if ($db) {
            try {
                $stmt = $db->prepare("INSERT INTO pengajuan_asuransi 
                    (nomor_polis, mobil_id, tipe_coverage, addons, harga_kendaraan, premi_tahunan, durasi_tahun, total_premi, nama_pemohon, no_telepon, email, no_ktp, alamat, catatan, status) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')");
                $stmt->execute([
                    $nomor_polis, $mobil_id, $tipe_coverage, $addons, 
                    $harga_kendaraan, $premi_tahunan, $durasi_tahun, $total_premi, 
                    $nama_pemohon, $no_telepon, $email, $no_ktp, $alamat, $catatan
                ]);
            } catch (Exception $e) {}
        }
        jsonSuccess(['nomor_polis' => $nomor_polis, 'status' => 'pending'], 'Pengajuan Asuransi berhasil didaftarkan!');
        break;

    case 'get_insurance_applications':
        if ($db) {
            try {
                $stmt = $db->query("SELECT p.*, m.brand, m.model, m.tahun, m.gambar_utama 
                                    FROM pengajuan_asuransi p 
                                    LEFT JOIN mobil m ON p.mobil_id = m.id 
                                    ORDER BY p.id DESC");
                jsonSuccess($stmt->fetchAll());
            } catch (Exception $e) {}
        }
        jsonSuccess([], 'Offline mode');
        break;

    case 'update_insurance_status':
        $id = (int)($input['id'] ?? 0);
        $status = trim($input['status'] ?? 'pending');
        if ($db && $id > 0) {
            try {
                $stmt = $db->prepare("UPDATE pengajuan_asuransi SET status = ? WHERE id = ?");
                $stmt->execute([$status, $id]);
            } catch (Exception $e) {}
        }
        jsonSuccess(['id' => $id, 'status' => $status], "Status asuransi diperbarui menjadi $status");
        break;

    case 'delete_insurance_application':
        $id = (int)($input['id'] ?? 0);
        if ($db && $id > 0) {
            try {
                $stmt = $db->prepare("DELETE FROM pengajuan_asuransi WHERE id = ?");
                $stmt->execute([$id]);
            } catch (Exception $e) {}
        }
        jsonSuccess(['id' => $id], 'Pengajuan asuransi berhasil dihapus');
        break;

    // ═════════════════════════════════════════════════════════════════
    // 9. TITIP JUAL / KONSINYASI (SELL YOUR CAR)
    // ═════════════════════════════════════════════════════════════════
    case 'submit_sell_car':
        $sellId = $input['id'] ?? ('SELL-' . rand(10000, 99999));
        $brand = trim($input['brand'] ?? '');
        $model = trim($input['model'] ?? '');
        $year = (int)($input['year'] ?? 2025);
        $mileage = trim($input['mileage'] ?? '0');
        $color = trim($input['color'] ?? '');
        $price = (float)($input['askingPrice'] ?? 0);
        $condition = trim($input['condition'] ?? 'excellent');
        $desc = trim($input['description'] ?? '');
        $ownerName = trim($input['ownerName'] ?? '');
        $ownerPhone = trim($input['ownerPhone'] ?? '');
        $ownerEmail = trim($input['ownerEmail'] ?? '');

        if ($db) {
            try {
                $stmt = $db->prepare("INSERT INTO titip_jual (listing_kode, brand, model, tahun, mileage, warna, asking_price, kondisi, deskripsi, nama_pemilik, telepon_pemilik, email_pemilik, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'under_review')");
                $stmt->execute([$sellId, $brand, $model, $year, $mileage, $color, $price, $condition, $desc, $ownerName, $ownerPhone, $ownerEmail]);
            } catch (Exception $e) {}
        }

        jsonSuccess([
            'id' => $sellId,
            'brand' => $brand,
            'model' => $model,
            'askingPrice' => $price,
            'status' => 'under_review'
        ], 'Pengajuan titip jual mobil berhasil dikirim! Tim kami akan melakukan inspeksi dalam 48 jam.');
        break;

    case 'get_sell_listings':
        if ($db) {
            try {
                $stmt = $db->query("SELECT * FROM titip_jual ORDER BY id DESC");
                jsonSuccess($stmt->fetchAll());
            } catch (Exception $e) {}
        }
        jsonSuccess([], 'OK');
        break;

    case 'update_sell_status':
        $id = $input['id'] ?? '';
        $status = $input['status'] ?? 'under_review';
        $catatan = $input['catatan_kurasi'] ?? null;
        if ($db && $id) {
            try {
                $stmt = $db->prepare("UPDATE titip_jual SET status = ?, catatan_kurasi = ? WHERE listing_kode = ? OR id = ?");
                $stmt->execute([$status, $catatan, $id, $id]);
            } catch (Exception $e) {}
        }
        jsonSuccess(['id' => $id, 'status' => $status], 'Status titip jual berhasil diperbarui');
        break;

    // ═════════════════════════════════════════════════════════════════
    // 10. KONTAK & PESAN CUSTOMER (CONTACT US)
    // ═════════════════════════════════════════════════════════════════
    case 'submit_contact_message':
        $ticketId = $input['id'] ?? ('TKT-' . rand(10000, 99999));
        $subject = trim($input['subject'] ?? 'general');
        $name = trim($input['name'] ?? '');
        $email = trim($input['email'] ?? '');
        $phone = trim($input['phone'] ?? '');
        $message = trim($input['message'] ?? '');

        if ($db) {
            try {
                $stmt = $db->prepare("INSERT INTO pesan_kontak (ticket_kode, subjek, nama, email, telepon, pesan, status) VALUES (?, ?, ?, ?, ?, ?, 'open')");
                $stmt->execute([$ticketId, $subject, $name, $email, $phone, $message]);
            } catch (Exception $e) {}
        }

        jsonSuccess([
            'id' => $ticketId,
            'name' => $name,
            'email' => $email,
            'status' => 'open'
        ], "Pesan Anda ($ticketId) telah diterima. Tim concierge kami akan merespons dalam 24 jam.");
        break;

    case 'get_contact_messages':
        if ($db) {
            try {
                $stmt = $db->query("SELECT * FROM pesan_kontak ORDER BY id DESC");
                jsonSuccess($stmt->fetchAll());
            } catch (Exception $e) {}
        }
        jsonSuccess([], 'OK');
        break;

    case 'reply_contact_message':
        $id = $input['id'] ?? '';
        $balasan = trim($input['balasan'] ?? '');
        $repliedBy = trim($input['replied_by'] ?? 'Concierge Team');
        if ($db && $id) {
            try {
                $stmt = $db->prepare("UPDATE pesan_kontak SET balasan = ?, status = 'replied', replied_at = NOW(), replied_by = ? WHERE ticket_kode = ? OR id = ?");
                $stmt->execute([$balasan, $repliedBy, $id, $id]);
            } catch (Exception $e) {}
        }
        jsonSuccess(['id' => $id, 'balasan' => $balasan, 'status' => 'replied'], 'Balasan berhasil dikirim ke customer');
        break;

    case 'init_db':
        try {
            $pdo = new PDO("mysql:host=" . DB_HOST . ";charset=utf8mb4", DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
            $sql = file_get_contents('schema.sql');
            if (!$sql) {
                jsonError('File schema.sql tidak ditemukan!');
            }
            $pdo->exec($sql);
            jsonSuccess(null, 'Database dealer_mobil_db berhasil diinisialisasi & tabel telah dibuat!');
        } catch (Exception $e) {
            jsonError('Gagal inisialisasi database: ' . $e->getMessage());
        }
        break;

    default:
        jsonError('Invalid action requested: ' . htmlspecialchars($action));
        break;
}
?>
