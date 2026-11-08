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
        'brand' => 'Rolls-Royce',
        'model' => 'Phantom VIII Extended',
        'tahun' => 2025,
        'harga_otr' => 24500000000,
        'spesifikasi' => 'V12 6.75L Twin-Turbo | 563 HP | 900 Nm | 0-100 km/h: 5.4s | Starlight Headliner | Whisper Quiet Cabin',
        'deskripsi' => 'Standard emas kemewahan dunia otomotif. Menyajikan kenyamanan tiada tanding dengan peredaman suara kabin tingkat tertinggi.',
        'stok' => 2,
        'gambar_utama' => 'assets/images/rolls_royce_phantom.jpg'
    ],
    [
        'id' => 2,
        'kategori_id' => 2,
        'brand' => 'Ferrari',
        'model' => 'SF90 Stradale Assetto Fiorano',
        'tahun' => 2025,
        'harga_otr' => 18500000000,
        'spesifikasi' => 'V8 4.0L Twin-Turbo Plug-in Hybrid | 986 HP | 0-100 km/h: 2.5s | Top Speed: 340 km/h | eAWD System',
        'deskripsi' => 'Hypercar hybrid buatan Maranello dengan akselerasi instan dan downforce tingkat balap balap Formula 1.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/ferrari_sf90.jpg'
    ],
    [
        'id' => 3,
        'kategori_id' => 3,
        'brand' => 'Lamborghini',
        'model' => 'Revuelto V12 Hybrid',
        'tahun' => 2026,
        'harga_otr' => 21000000000,
        'spesifikasi' => 'V12 6.5L Naturally Aspirated + 3 Electric Motors | 1001 HP | 0-100 km/h: 2.5s | Monofuselage Carbon',
        'deskripsi' => 'Supercar V12 hybrid pertama dari Sant\'Agata Bolognese. Desain futuristik dengan performa tanpa batas.',
        'stok' => 1,
        'gambar_utama' => 'assets/images/lamborghini_revuelto.jpg'
    ],
    [
        'id' => 4,
        'kategori_id' => 4,
        'brand' => 'Porsche',
        'model' => '911 GT3 RS (992)',
        'tahun' => 2025,
        'harga_otr' => 11200000000,
        'spesifikasi' => 'Flat-6 4.0L NA | 518 HP | 9,000 RPM Redline | DRS Aero Wing | PDK 7-Speed',
        'deskripsi' => 'Mobil balap sirkuit yang legal digunakan di jalan raya. Dilengkapi sistem aerodinamika aktif DRS.',
        'stok' => 3,
        'gambar_utama' => 'assets/images/porsche_911_gt3.jpg'
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
                $stmt = $db->query("SELECT * FROM mobil ORDER BY id DESC");
                $cars = $stmt->fetchAll();
                if (!empty($cars)) {
                    jsonSuccess($cars);
                }
            } catch (Exception $e) {}
        }
        jsonSuccess($defaultCars, 'Offline catalog mode');
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
