-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Nov 2026 pada 17.02
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dealer_mobil_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking_test_drive`
--

CREATE TABLE `booking_test_drive` (
  `id` int(11) NOT NULL,
  `mobil_id` int(11) NOT NULL,
  `nama_pemesan` varchar(100) NOT NULL,
  `kontak` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `status` enum('pending','confirmed','completed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri_mobil`
--

CREATE TABLE `galeri_mobil` (
  `id` int(11) NOT NULL,
  `mobil_id` int(11) NOT NULL,
  `url_gambar` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_brand`
--

CREATE TABLE `kategori_brand` (
  `id` int(11) NOT NULL,
  `nama_brand` varchar(100) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_brand`
--

INSERT INTO `kategori_brand` (`id`, `nama_brand`, `logo`, `created_at`) VALUES
(1, 'Bugatti', NULL, '2026-10-01 14:13:05'),
(2, 'Pagani', NULL, '2026-10-01 14:13:05'),
(3, 'Koenigsegg', NULL, '2026-10-01 14:13:05'),
(4, 'Ferrari', NULL, '2026-10-01 14:13:05'),
(5, 'Lamborghini', NULL, '2026-10-01 14:13:05'),
(6, 'Mercedes', NULL, '2026-10-01 14:13:05'),
(7, 'Rolls-Royce', NULL, '2026-10-01 14:13:05'),
(8, 'McLaren', NULL, '2026-10-01 14:13:05'),
(9, 'Porsche', NULL, '2026-10-01 14:13:05'),
(10, 'Aston Martin', NULL, '2026-10-01 14:13:05'),
(11, 'Bentley', NULL, '2026-10-01 14:13:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mobil`
--

CREATE TABLE `mobil` (
  `id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `tahun` int(11) NOT NULL,
  `harga_otr` bigint(20) NOT NULL,
  `spesifikasi` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `stok` int(11) DEFAULT 1,
  `gambar_utama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mobil`
--

INSERT INTO `mobil` (`id`, `kategori_id`, `brand`, `model`, `tahun`, `harga_otr`, `spesifikasi`, `deskripsi`, `stok`, `gambar_utama`, `created_at`) VALUES
(1, 1, 'Bugatti', 'Chiron Super Sport', 2025, 78000000000, 'W16 8.0L Quad-Turbo | 1578 HP | 1600 Nm | 0-100 km/h: 2.3s | Top Speed: 440 km/h | Limited 60 Units', 'Hypercar paling eksklusif di muka bumi. Hanya 60 unit diproduksi dengan performa yang melampaui batas fisika.', 1, 'assets/images/cars/bugatti_chiron_super_sport.jpg', '2026-10-01 14:13:05'),
(2, 2, 'Pagani', 'Huayra Roadster BC', 2024, 60000000000, 'AMG V12 6.0L Twin-Turbo | 802 HP | 1050 Nm | Carbon-Titanium Carbo-Triax HP62 Monocoque', 'Karya seni otomotif dari Horacio Pagani. Desain aerodinamis mutakhir dengan balutan serat karbon terhalus.', 1, 'assets/images/cars/pagani_huayra_roadster_bc.jpg', '2026-10-01 14:13:05'),
(3, 3, 'Koenigsegg', 'Jesko Absolut', 2025, 65000000000, 'V8 5.0L Twin-Turbo | 1600 HP (E85) | Top Speed: 500+ km/h | LST 9-Speed (Light Speed Transmission)', 'Megacar tercepat dari Swedia dengan transmisi 9-percepatan LST (Light Speed Transmission).', 1, 'assets/images/cars/koenigsegg_jesko_absolut.jpg', '2026-10-01 14:13:05'),
(4, 4, 'Ferrari', 'SF90 Stradale Assetto Fiorano', 2025, 18500000000, 'V8 4.0L Twin-Turbo Plug-in Hybrid | 986 HP | 0-100 km/h: 2.5s | Top Speed: 340 km/h | eAWD System', 'Hypercar hybrid buatan Maranello dengan akselerasi instan dan downforce tingkat balap balap Formula 1.', 1, 'assets/images/ferrari_sf90.jpg', '2026-10-01 14:13:05'),
(5, 5, 'Lamborghini', 'Revuelto V12 Hybrid', 2026, 21000000000, 'V12 6.5L Naturally Aspirated + 3 Electric Motors | 1001 HP | 0-100 km/h: 2.5s | Monofuselage Carbon', 'Supercar V12 hybrid pertama dari Sant Agata Bolognese. Desain futuristik dengan performa tanpa batas.', 1, 'assets/images/lamborghini_revuelto.jpg', '2026-10-01 14:13:05'),
(6, 6, 'Mercedes', 'AMG GT Black Series', 2024, 15000000000, 'V8 4.0L Biturbo Flat-Plane | 720 HP | 800 Nm | 0-100 km/h: 3.2s | Nurburgring Record King', 'Supercar track-focused dari Affalterbach dengan aerodinamika agresif dan mesin flat-plane crank buas.', 1, 'assets/images/cars/mercedes_amg_gt_black_series.jpg', '2026-10-01 14:13:05'),
(7, 7, 'Rolls-Royce', 'Phantom VIII Extended', 2025, 24500000000, 'V12 6.75L Twin-Turbo | 563 HP | 900 Nm | 0-100 km/h: 5.4s | Starlight Headliner | Whisper Quiet Cabin', 'Standard emas kemewahan dunia otomotif. Menyajikan kenyamanan tiada tanding dengan peredaman suara kabin tingkat tertinggi.', 2, 'assets/images/rolls_royce_phantom.jpg', '2026-10-01 14:13:05'),
(8, 8, 'McLaren', '750S Spider', 2025, 15300000000, 'V8 4.0L Twin-Turbo | 750 HP | 800 Nm | 0-100 km/h: 2.8s | Top Speed: 331 km/h | Carbon MonoCell III', 'Convertible supercar dengan chassis serat karbon MonoCell III. Atap folding elektrik dalam 11 detik tanpa mengorbankan kekakuan.', 2, 'assets/images/cars/mclaren_750s_spider.jpg', '2026-10-01 14:13:05'),
(9, 9, 'Porsche', '911 GT3 RS (992)', 2025, 11200000000, 'Flat-6 4.0L NA | 518 HP | 9,000 RPM Redline | DRS Aero Wing | PDK 7-Speed | Carbon Door & Fenders', 'Mobil balap sirkuit yang legal digunakan di jalan raya. Dilengkapi sistem aerodinamika aktif DRS.', 3, 'assets/images/porsche_911_gt3.jpg', '2026-10-01 14:13:05'),
(10, 10, 'Aston Martin', 'DB12 Volante Super Tourer', 2026, 13500000000, 'V8 4.0L Twin-Turbo | 671 HP | 800 Nm | 0-100 km/h: 3.6s | Top Speed: 325 km/h | K-Fold Roof in 14s', 'Gran Tourer konvertibel ikonik dari Gaydon. Dikenal sebagai The World\'s Most Beautiful Grand Tourer dengan kemewahan interior bespoke.', 2, 'assets/images/cars/aston_martin_db12_volante.jpg', '2026-10-01 14:13:05'),
(11, 11, 'Bentley', 'Continental GT Speed W12', 2025, 16800000000, 'W12 6.0L Twin-Turbo | 659 HP | 900 Nm | 0-100 km/h: 3.6s | Top Speed: 335 km/h | Electronic All-Wheel Steering', 'Grand tourer terkencang Bentley sepanjang masa. Memadukan kemewahan hand-crafted interior dengan performa supercar kelas dunia.', 2, 'assets/images/cars/bentley_continental_gt_speed_w12.jpg', '2026-10-01 14:13:05'),
(12, 1, 'Bugatti', 'W16 Mistral Roadster', 2025, 85000000000, 'W16 8.0L Quad-Turbo | 1600 HP | 1600 Nm | 0-100 km/h: 2.4s | The Ultimate Open-Top Hypercar', 'Roadster pamungkas bertenaga W16 legendaris Bugatti. Diproduksi terbatas hanya 99 unit di seluruh dunia.', 1, 'https://images.unsplash.com/photo-1544829099-b9a0c07fad1a?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(13, 1, 'Bugatti', 'Divo Cornering Specialist', 2024, 95000000000, 'W16 8.0L Quad-Turbo | 1500 HP | Cornering Specialist | Lateral Accel 1.6G | Downforce +90kg', 'Hypercar berkarakter sirkuit dengan aerodinamika agresif dan downforce ekstra dibanding Chiron standar.', 1, 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(14, 1, 'Bugatti', 'Bolide Track-Only Megacar', 2025, 72000000000, 'W16 8.0L Quad-Turbo | 1850 HP | Weight: 1240 kg | 0.67 kg/HP | FIA Le Mans Safety Standards', 'Monster trek tanpa kompromi dengan rasio bobot tenaga 0.67 kg per HP dan transmisi balap FIA Le Mans.', 1, 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(15, 1, 'Bugatti', 'Tourbillon V16 Hybrid', 2026, 88000000000, 'V16 8.3L Cosworth NA + 3 Motors | 1800 HP | 0-100 km/h: 2.0s | Horology-Inspired Cockpit', 'Era baru hypercar Bugatti dengan instrumen analog karya pembuat jam tangan Swiss dan mesin naturally aspirated V16 Cosworth.', 1, 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(16, 2, 'Pagani', 'Utopia Gated Manual Coupé', 2025, 65000000000, 'Mercedes-AMG V12 6.0L Twin-Turbo | 864 HP | 1100 Nm | 7-Speed Gated Manual Transverse', 'Karya seni purist Horacio Pagani yang menolak elektrifikasi, menghadirkan tuas transmisi manual terbuka yang mempesona.', 1, 'https://images.unsplash.com/photo-1647413554479-7df9fcebeab8?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(17, 2, 'Pagani', 'Huayra R Track Pure V12', 2024, 58000000000, 'V12-R 6.0L Naturally Aspirated | 850 HP | 9000 RPM | Weight 1050 kg | Inconel Exhaust Symphonic', 'Mobil trek bertenaga V12 atmosferik dengan suara knalpot bernada Formula 1 era 1990-an dan bobot hanya 1050 kg.', 1, 'https://images.unsplash.com/photo-1608821946397-f6556156cebb?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(18, 2, 'Pagani', 'Zonda Cinque Roadster', 2023, 75000000000, 'AMG V12 7.3L NA | 678 HP | 780 Nm | 1 of 5 Worldwide | Carbo-Titanium Monocoque | Roof-Scoop Aero', 'Salah satu Zonda paling langka dan dicari kolektor dunia. Hanya ada 5 unit di dunia dengan aerodinamika atap roof-scoop.', 1, 'https://images.unsplash.com/photo-1544829099-b9a0c07fad1a?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(19, 2, 'Pagani', 'Imola Roadster Aero-Lab', 2025, 82000000000, 'Mercedes-AMG V12 Twin-Turbo | 850 HP | 1100 Nm | Extreme Ground Effect Aero | Limited 8 Units', 'Laboratorium berjalan Pagani yang diuji di Sirkuit Imola dengan downforce ekstrem dan teknologi suspensi aktif tercanggih.', 1, 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(20, 3, 'Koenigsegg', 'Gemera 4-Seater Megacar', 2025, 48000000000, 'HV8 5.0L Twin-Turbo Hybrid | 2300 HP | 2750 Nm | 4-Seater Mega-GT | All-Wheel Drive & Steering', 'Megacar 4 penumpang pertama di dunia dengan pintu dihedral autoskin dan tenaga fantastis 2300 horsepower.', 2, 'https://images.unsplash.com/photo-1616782298751-24bb688e1462?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(21, 3, 'Koenigsegg', 'CC850 ESS Shift by Wire', 2025, 62000000000, 'V8 5.0L Twin-Turbo | 1385 HP | 1385 kg (1:1 Ratio) | Engage Shift System (ESS) Dual-Mode Gated Manual', 'Penghormatan 20 tahun CC8S dengan teknologi revolusioner transmisi manual simulasi dengan kopling fisik asli.', 1, 'https://images.unsplash.com/photo-1608821946397-f6556156cebb?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(22, 3, 'Koenigsegg', 'Jesko Attack High-Downforce', 2025, 63000000000, 'V8 5.0L Twin-Turbo | 1600 HP | 1400 kg Downforce | Active Rear Wing | Triplex Damper Suspension', 'Varian Jesko yang dioptimalkan untuk lap time sirkuit dengan sayap ganda raksasa dan triplex damper suspension.', 1, 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(23, 3, 'Koenigsegg', 'Regera DirectDrive Ghost', 2024, 45000000000, 'V8 5.0L Twin-Turbo + Direct Drive | 1500 HP | 2000 Nm | 0-400-0 km/h: 28.8s | Autoskin Hydraulic Doors', 'Megacar revolusioner tanpa gearbox (Koenigsegg Direct Drive) dengan sistem hidrolik robotik Autoskin di seluruh pintu.', 1, 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(24, 4, 'Ferrari', 'Purosangue SUV V12', 2026, 25900000000, 'V12 6.5L Naturally Aspirated | 715 HP | 716 Nm | 0-100 km/h: 3.3s | Multimatic Active Suspension', 'SUV empat pintu pertama dalam sejarah Ferrari dengan mesin naturally aspirated V12 murni dan suspensi aktif Multimatic.', 2, 'https://images.unsplash.com/photo-1632245889029-e406faaa34cd?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(25, 4, 'Ferrari', '296 GTB Assetto Fiorano', 2025, 14200000000, 'V6 3.0L 120° Twin-Turbo PHEV | 819 HP | 740 Nm | 0-100 km/h: 2.9s | Top Speed: 330 km/h', 'Piccolo V12 berlinetta bermesin tengah dengan efisiensi plug-in hybrid dan kelincahan berkendara legendaris.', 2, 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(26, 4, 'Ferrari', '812 Competizione V12', 2024, 22000000000, 'V12 6.5L Naturally Aspirated | 819 HP | 9500 RPM | Independent 4-Wheel Steering | Carbon Wheels', 'Edisi terbatas front-mid V12 paling bertenaga yang pernah dibuat di Maranello dengan putaran mesin hingga 9.500 RPM.', 1, 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(27, 4, 'Ferrari', 'Roma Spider Dolce Vita', 2025, 11800000000, 'V8 3.9L Twin-Turbo | 612 HP | 760 Nm | 0-100 km/h: 3.4s | Soft-Top Convertible 5-Layer Fabric', 'Kembalinya era La Nuova Dolce Vita dengan atap kain elegan 5 lapis yang dapat dibuka dalam 13.5 detik pada kecepatan 60 km/h.', 2, 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(28, 5, 'Lamborghini', 'Urus Performante Super SUV', 2025, 13800000000, 'V8 4.0L Twin-Turbo | 657 HP | 850 Nm | 0-100 km/h: 3.3s | Akrapovic Titanium Exhaust | Rally Mode', 'Super SUV pemecah rekor Pikes Peak dengan kap mesin serat karbon, knalpot titanium Akrapovic, dan mode berkendara Rally.', 2, 'https://images.unsplash.com/photo-1544829099-b9a0c07fad1a?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(29, 5, 'Lamborghini', 'Huracán STO Super Trofeo', 2024, 14500000000, 'V10 5.2L Naturally Aspirated | 631 HP | 565 Nm | RWD | Cofango One-Piece Hood | 75% Carbon Fiber', 'Mobil balap homologasi jalan raya dengan bodi 75% serat karbon dan pendinginan aerodinamika Squadra Corse.', 1, 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(30, 5, 'Lamborghini', 'Temerario V8 Twin-Turbo', 2026, 17500000000, 'V8 4.0L Twin-Turbo + 3 Motors | 907 HP | 10000 RPM Redline | High-Revving Flat-Plane Crank', 'Penerus resmi Huracán dengan mesin flat-plane crank baru yang sanggup berputar hingga 10.000 RPM fantastis.', 2, 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(31, 5, 'Lamborghini', 'Sián FKP 37 Roadster', 2024, 42000000000, 'V12 6.5L + Supercapacitor Hybrid | 808 HP | 0-100 km/h: 2.8s | 1 of 19 Worldwide | Terzo Millennio Aero', 'Hypercar superkapasitor pertama di dunia berdesain radikal Terzo Millennio. Hanya diproduksi 19 unit di seluruh dunia.', 1, 'https://images.unsplash.com/photo-1608821946397-f6556156cebb?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(32, 6, 'Mercedes', 'Maybach S-Class S680 V12', 2025, 9800000000, 'V12 6.0L Biturbo | 621 HP | 900 Nm | 4MATIC | Burmester 4D Audio | First-Class Rear Suite', 'Puncak kemewahan sedan eksekutif Jerman dengan cat two-tone artisan, sistem audio Burmester 4D, dan pintu belakang elektrik.', 2, 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(33, 6, 'Mercedes', 'AMG G 63 4x4² Squared', 2025, 12500000000, 'V8 4.0L Biturbo | 577 HP | 850 Nm | Portal Axles | Ground Clearance 351mm | 22\" Forged Wheels', 'SUV segala medan paling perkasa dengan gardan portal tinggi, velg forged 22 inci, dan kemampuan menerjang banjir 91 cm.', 2, 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(34, 6, 'Mercedes', 'AMG SL 63 4MATIC+ Roadster', 2025, 7900000000, 'V8 4.0L Biturbo | 577 HP | 800 Nm | 0-100 km/h: 3.6s | Composite Aluminum Chassis | 2+2 Seats', 'Roadster sport ikonik generasi terbaru dengan arsitektur komposit aluminium ringan dan sistem all-wheel drive cerdas.', 3, 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(35, 6, 'Mercedes', 'AMG ONE Formula 1 Hypercar', 2025, 55000000000, 'V6 1.6L Turbo F1 + 4 Electric Motors | 1049 HP | 11000 RPM Redline | Mercedes-AMG Petronas F1 Tech', 'Hypercar sejati bermesin Formula 1 langsung dari tim Mercedes-AMG Petronas F1 dengan rekor lap time Nürburgring Nordschleife.', 1, 'https://images.unsplash.com/photo-1608821946397-f6556156cebb?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(36, 7, 'Rolls-Royce', 'Cullinan Black Badge SUV', 2026, 32000000000, 'V12 6.75L Twin-Turbo | 600 HP | 900 Nm | Air Suspension | Viewing Suite Luggage Seats | All-Wheel Drive', 'SUV termewah di dunia dengan paket Black Badge berkarakter misterius, kursi Viewing Suite di bagasi, dan Starlight roof.', 1, 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(37, 7, 'Rolls-Royce', 'Spectre Electric Coupé', 2025, 21000000000, 'Dual Electric Motors | 577 HP | 900 Nm | 0-100 km/h: 4.5s | Drag Coeff 0.25cd | Illuminated Fascia 5500 Stars', 'Super-coupe listrik ultra-mewah pertama Rolls-Royce dengan koefisien drag 0.25cd dan Illuminated Fascia berisi 5.500 bintang.', 2, 'https://images.unsplash.com/photo-1508210331008-5d2bc5038c64?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(38, 7, 'Rolls-Royce', 'Ghost Extended Series II', 2025, 19500000000, 'V12 6.75L Twin-Turbo | 563 HP | 850 Nm | Planar Suspension System | Post-Opulence Pure Architecture', 'Sedan kemewahan modern dengan filosofi Post-Opulence, pintu buka tutup otomatis elektrik, dan peredam suspensi wishbone atas.', 2, 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(39, 7, 'Rolls-Royce', 'Dawn Black Badge Convertible', 2024, 23000000000, 'V12 6.6L Twin-Turbo | 593 HP | 840 Nm | The Silent Drophead Tourer | Acoustic French-Seam Soft Top', 'Konvertibel paling senyap di dunia saat atap ditutup, menyajikan kenikmatan berkendara grand touring tanpa gangguan suara angin.', 1, 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(40, 8, 'McLaren', 'Senna Ultimate Track-Weapon', 2024, 32000000000, 'V8 4.0L Twin-Turbo | 789 HP | 800 Nm | 800 kg Downforce | Carbon MonoCage III | 1 of 500 Worldwide', 'Dinamai untuk mengenang legenda F1 Ayrton Senna. Fokus mutlak pada lap time tercepat tanpa kompromi.', 1, 'https://images.unsplash.com/photo-1609521263047-f8f205293f24?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(41, 8, 'McLaren', 'Artura Spider High-Perf Hybrid', 2025, 11500000000, 'V6 3.0L 120° Twin-Turbo PHEV | 690 HP | 720 Nm | 0-100 km/h: 3.0s | Carbon Lightweight Architecture MCLA', 'High-performance hybrid convertible pertama McLaren dengan handling presisi dan bobot paling ringan di kelasnya.', 2, 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(42, 8, 'McLaren', '765LT Longtail Coupe', 2024, 18800000000, 'V8 4.0L Twin-Turbo | 755 HP | 800 Nm | 0-100 km/h: 2.7s | Quad Titanium Exhaust | Active Longtail Wing', 'Edisi Longtail legendaris dengan bobot terpangkas 80 kg, rasio transmisi balap lebih rapat, dan sayap aktif Longtail khas Woking.', 1, 'https://images.unsplash.com/photo-1544829099-b9a0c07fad1a?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(43, 8, 'McLaren', 'GT Luxe Grand Tourer', 2025, 9500000000, 'V8 4.0L Twin-Turbo | 612 HP | 630 Nm | Proactive Damping Control | 570L Cargo Space | Nappa Leather Interior', 'Supercar harian dengan ruang kargo bagasi berlapis kulit terluas di kelasnya, memadukan performa McLaren dengan kenyamanan touring.', 3, 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(44, 9, 'Porsche', '911 Turbo S Coupe (992)', 2025, 12800000000, 'Boxer-6 3.8L Twin-Turbo | 640 HP | 800 Nm | 0-100 km/h: 2.6s | All-Wheel Drive | Ceramic Composite Brakes PCCB', 'Tolok ukur performa supercar harian di dunia. Akselerasi roket dari diam dengan stabilitas traksi all-wheel drive tanpa cela.', 2, 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(45, 9, 'Porsche', 'Taycan Turbo GT Weissach', 2025, 10500000000, 'Dual Electric Motors | 1092 HP Attack Mode | 1340 Nm | 0-100 km/h: 2.2s | Carbon Aerokit | EV Nurburgring King', 'Mobil listrik 4-pintu tercepat di Nürburgring dan Laguna Seca dengan paket Weissach aerodinamika karbon ultra-ringan.', 2, 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(46, 9, 'Porsche', '718 Cayman GT4 RS Mid-Engine', 2024, 8900000000, 'Mid-Engine Flat-6 4.0L NA | 493 HP | 9000 RPM | Air Intake Side Windows | Titanium Rollcage Option', 'Coupe bermesin tengah dengan intake udara tepat di samping telinga pengemudi, menghasilkan sensasi akustik mekanis tak tertandingi.', 2, 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(47, 9, 'Porsche', 'Cayenne Turbo E-Hybrid GT', 2025, 9400000000, 'V8 4.0L Twin-Turbo PHEV | 729 HP | 950 Nm | 0-100 km/h: 3.6s | Ceramic Brakes | Titanium Center Exhaust', 'SUV terkuat yang pernah diproduksi Porsche dengan paduan mesin V8 biturbo dan motor listrik bertenaga buas.', 2, 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(48, 10, 'Aston Martin', 'Valkyrie Adrian Newey Hypercar', 2024, 52000000000, 'Cosworth V12 6.5L NA + Rimac KERS | 1140 HP | 11100 RPM Redline | Full Venturi Tunnel Underfloor Ground Effect', 'Mahakarya aerodinamika dari desainer F1 Adrian Newey. Mesin V12 Cosworth paling tinggi putarannya di dunia untuk mobil jalan raya.', 1, 'https://images.unsplash.com/photo-1608821946397-f6556156cebb?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(49, 10, 'Aston Martin', 'DBX707 High-Output Luxury SUV', 2025, 11200000000, 'V8 4.0L Twin-Turbo | 697 HP (707 PS) | 900 Nm | 0-100 km/h: 3.3s | Wet-Clutch 9-Speed | Carbon Ceramic Brakes', 'Salah satu SUV termewah dan terkencang di dunia dengan rem Carbon Ceramic standar dan interior bespoke Q by Aston Martin.', 2, 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(50, 10, 'Aston Martin', 'Vantage F1 Edition Aero', 2025, 8800000000, 'V8 4.0L Twin-Turbo | 528 HP | 685 Nm | Official FIA F1 Safety Car Dynamics | Full Aero Kit 200kg Downforce', 'Edisi spesial yang dikembangkan langsung dari Safety Car Formula 1 resmi dengan sasis lebih kaku dan sayap aerodinamika balap.', 2, 'https://images.unsplash.com/photo-1563720223185-11003d516935?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(51, 10, 'Aston Martin', 'DBS 770 Ultimate Coupe', 2024, 16500000000, 'V12 5.2L Twin-Turbo | 759 HP (770 PS) | 900 Nm | Top Speed: 340 km/h | 1 of 300 Worldwide | Horseshoe Hood Vent', 'Perpisahan paling megah untuk generasi DBS V12. Diproduksi terbatas dengan kap mesin clashing horseshoe dan interior sports plus.', 1, 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(52, 11, 'Bentley', 'Bentayga EWB Azure Airline Seat', 2025, 14500000000, 'V8 4.0L Twin-Turbo | 542 HP | 770 Nm | Airline Seat Specification | 22-Way Adjustment & Postural Massage', 'SUV ultra-mewah dengan kabin belakang terlapang di kelasnya, kursi Airline Seat dengan 22 pengaturan dan deteksi postural otomatis.', 2, 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:29'),
(53, 11, 'Bentley', 'Flying Spur Mulliner W12', 2025, 17900000000, 'W12 6.0L Twin-Turbo | 626 HP | 900 Nm | Mulliner Diamond-in-Diamond Quilting | Illuminated Flying B Mascot', 'Sedan flagship 4 pintu karya divisi bespoke Mulliner di Crewe. Menghadirkan trim kayu walnut langka dan emblem Flying B bercahaya.', 2, 'https://images.unsplash.com/photo-1580274455191-1c62238fa333?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:30'),
(54, 11, 'Bentley', 'Batur Coachbuilt by Mulliner', 2025, 38000000000, 'W12 6.0L Twin-Turbo Hand-Built | 740 HP | 1000 Nm | 1 of 18 Worldwide | 3D-Printed 18K Gold Interior Accents', 'Karya seni coachbuilt bespoke Mulliner hanya 18 unit di dunia dengan tombol instrumen emas murni 18 karat cetak 3D.', 1, 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:30'),
(55, 11, 'Bentley', 'Continental GTC V8 S Convertible', 2025, 13900000000, 'V8 4.0L Twin-Turbo | 542 HP | 770 Nm | Sport Exhaust with Dark Tint Quads | 48V Active Anti-Roll Dynamic Ride', 'Grand tourer atap terbuka dengan raungan knalpot V8 sporty, velg 22 inci black polished, dan suspensi udara dinamis 48V.', 2, 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=800&q=80', '2026-10-11 12:42:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_asuransi`
--

CREATE TABLE `pengajuan_asuransi` (
  `id` int(11) NOT NULL,
  `nomor_polis` varchar(50) NOT NULL,
  `mobil_id` int(11) NOT NULL,
  `tipe_coverage` enum('comprehensive','tlo') DEFAULT 'comprehensive',
  `addons` text DEFAULT NULL,
  `harga_kendaraan` bigint(20) NOT NULL,
  `premi_tahunan` bigint(20) NOT NULL,
  `durasi_tahun` int(11) DEFAULT 1,
  `total_premi` bigint(20) NOT NULL,
  `nama_pemohon` varchar(100) NOT NULL,
  `no_telepon` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_ktp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `catatan` text DEFAULT NULL,
  `status` enum('pending','survey','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengajuan_asuransi`
--

INSERT INTO `pengajuan_asuransi` (`id`, `nomor_polis`, `mobil_id`, `tipe_coverage`, `addons`, `harga_kendaraan`, `premi_tahunan`, `durasi_tahun`, `total_premi`, `nama_pemohon`, `no_telepon`, `email`, `no_ktp`, `alamat`, `catatan`, `status`, `created_at`) VALUES
(1, 'INS-2026-88192', 1, 'comprehensive', '[\"flood\",\"passenger\",\"tpl\"]', 78000000000, 2230500000, 1, 2230500000, 'Raden Mas Suryo Pranoto', '081198765432', 'suryo.pranoto@mentenggroup.co.id', '3171012304850001', 'Jl. Teuku Umar No. 18, Menteng, Jakarta Pusat', 'Mohon sertakan perluasan jaminan Authorized APM Body Repair & Emergency Towing 24 Jam.', 'pending', '2026-10-11 12:13:04'),
(2, 'INS-2026-44310', 2, 'comprehensive', '[\"flood\",\"riot\",\"tpl\"]', 60000000000, 1715000000, 2, 3258500000, 'Dr. Jessica Tanuwidjaja, Sp.JP', '081288990011', 'jessica.tan@cardio.id', '3174095508890002', 'Kebayoran Baru, Jakarta Selatan', 'Perlindungan komprehensif mobil sport weekend. Pembayaran premi via transfer korporat.', 'approved', '2026-10-11 12:13:04'),
(4, 'INS-2026-27918', 55, 'comprehensive', '[\"flood\",\"riot\",\"passenger\",\"tpl\"]', 13900000000, 421025000, 1, 421025000, 'Bill', '0999999', 'bill@gmail.com', '0000000000000000', '99999', '', 'pending', '2026-10-12 04:15:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasi_vip`
--

CREATE TABLE `reservasi_vip` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kontak` varchar(50) NOT NULL,
  `mobil_id` int(11) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `status` enum('pending','contacted','closed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--
-- Kesalahan membaca struktur untuk tabel dealer_mobil_db.users: #1932 - Table &#039;dealer_mobil_db.users&#039; doesn&#039;t exist in engine
-- Kesalahan membaca data untuk tabel dealer_mobil_db.users: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `dealer_mobil_db`.`users`&#039; at line 1

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `booking_test_drive`
--
ALTER TABLE `booking_test_drive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mobil_id` (`mobil_id`);

--
-- Indeks untuk tabel `galeri_mobil`
--
ALTER TABLE `galeri_mobil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mobil_id` (`mobil_id`);

--
-- Indeks untuk tabel `kategori_brand`
--
ALTER TABLE `kategori_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indeks untuk tabel `pengajuan_asuransi`
--
ALTER TABLE `pengajuan_asuransi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_polis` (`nomor_polis`),
  ADD KEY `mobil_id` (`mobil_id`);

--
-- Indeks untuk tabel `reservasi_vip`
--
ALTER TABLE `reservasi_vip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mobil_id` (`mobil_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `booking_test_drive`
--
ALTER TABLE `booking_test_drive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `galeri_mobil`
--
ALTER TABLE `galeri_mobil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori_brand`
--
ALTER TABLE `kategori_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `pengajuan_asuransi`
--
ALTER TABLE `pengajuan_asuransi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `reservasi_vip`
--
ALTER TABLE `reservasi_vip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `booking_test_drive`
--
ALTER TABLE `booking_test_drive`
  ADD CONSTRAINT `booking_test_drive_ibfk_1` FOREIGN KEY (`mobil_id`) REFERENCES `mobil` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `galeri_mobil`
--
ALTER TABLE `galeri_mobil`
  ADD CONSTRAINT `galeri_mobil_ibfk_1` FOREIGN KEY (`mobil_id`) REFERENCES `mobil` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mobil`
--
ALTER TABLE `mobil`
  ADD CONSTRAINT `mobil_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_brand` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengajuan_asuransi`
--
ALTER TABLE `pengajuan_asuransi`
  ADD CONSTRAINT `pengajuan_asuransi_ibfk_1` FOREIGN KEY (`mobil_id`) REFERENCES `mobil` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `reservasi_vip`
--
ALTER TABLE `reservasi_vip`
  ADD CONSTRAINT `reservasi_vip_ibfk_1` FOREIGN KEY (`mobil_id`) REFERENCES `mobil` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
