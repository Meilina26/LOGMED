# 💊 LOGMED

LOGMED (Logistic Medicine) adalah aplikasi berbasis web yang digunakan untuk mengelola distribusi obat antar gedung atau unit pelayanan kesehatan. Sistem ini dibangun menggunakan Laravel dan menyediakan fitur monitoring stok, distribusi obat, penggunaan obat, serta laporan administrasi.

---

## ✨ Fitur

### Admin
- Dashboard interaktif
- Kelola data obat (CRUD)
- Kelola data gedung (CRUD)
- Kelola data user (CRUD)
- Menyetujui atau menolak permintaan distribusi
- Monitoring stok seluruh gedung
- Laporan distribusi obat
- Laporan penggunaan obat
- Laporan stok gedung
- Export laporan ke PDF

### User Gedung
- Login
- Mengajukan permintaan distribusi obat
- Melihat status permintaan
- Mengelola penggunaan obat
- Melihat stok obat gedung

---

## 🛠️ Teknologi

- Laravel 12
- PHP 8.2
- MySQL
- Bootstrap
- Chart.js
- DomPDF
- Font Awesome

---

## 📁 Struktur Fitur

```
Dashboard
├── Statistik
├── Grafik Distribusi
├── Grafik Penggunaan
└── Notifikasi Pengajuan

Master Data
├── Data Obat
├── Data Gedung
└── Data User

Distribusi
├── Permintaan
├── Persetujuan
└── Riwayat

Monitoring
└── Stok Obat

Laporan
├── Distribusi
├── Penggunaan
└── Stok Gedung
```

---

## 🚀 Cara Menjalankan Project

### 1. Clone Repository

```bash
git clone https://github.com/Meilina26/LOGMED.git
```

Masuk ke folder project

```bash
cd LOGMED
```

---

### 2. Install Dependency

```bash
composer install
```

```bash
npm install
```

---

### 3. Copy File Environment

```bash
cp .env.example .env
```

---

### 4. Generate Application Key

```bash
php artisan key:generate
```

---

### 5. Konfigurasi Database

Buka file `.env` kemudian sesuaikan konfigurasi database.

```env
DB_DATABASE=logmed
DB_USERNAME=root
DB_PASSWORD=
```

---

### 6. Import Database

Import file database SQL melalui phpMyAdmin.

---

### 7. Jalankan Project

```bash
php artisan serve
```

Buka browser

```
http://127.0.0.1:8000
```

---

## 📊 Tampilan

- Dashboard Admin
- Dashboard User Gedung
- Monitoring Stok
- Distribusi Obat
- Penggunaan Obat
- Laporan PDF

---

## 📌 Status Project

✅ Selesai untuk kebutuhan tugas kuliah.

---

## 👩‍💻 Developer

**Meilina Fajrianu Lativa**
