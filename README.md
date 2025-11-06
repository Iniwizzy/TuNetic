# TuNetic - Sistem Manajemen Persampahan

![Laravel](https://img.shields.io/badge/Laravel-11.0-red?style=flat&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2%2B-blue?style=flat&logo=php)
![License](https://img.shields.io/badge/License-MIT-green?style=flat)

TuNetic adalah sistem manajemen persampahan berbasis web yang membantu dalam pengelolaan pengambilan sampah, penjadwalan armada, tracking kendaraan, dan pelaporan dari warga. Sistem ini dibangun menggunakan framework Laravel dengan fitur-fitur modern untuk memudahkan pengelolaan sampah di tingkat pemerintahan daerah.

## 📋 Fitur Utama

### 🔐 Manajemen Pengguna & Akses
- Multi-role authentication (Admin Pusat, Admin TPST, Petugas, User/Warga)
- Role-based permissions dengan Spatie Permission
- Dynamic menu system berdasarkan role
- Profile management
- Email verification & password reset

### 🚛 Manajemen Armada & Rute
- Kelola data armada pengangkut sampah
- Tracking armada secara real-time
- Manajemen rute pengambilan sampah
- Integrasi dengan TPS (Tempat Pembuangan Sementara)
- Penjadwalan rute otomatis

### 📅 Sistem Penjadwalan
- Jadwal operasional armada
- Template jadwal untuk pengulangan
- Penugasan petugas ke jadwal
- Jadwal pengambilan sampah per rute
- Manajemen jadwal template

### 📍 Manajemen Lokasi
- Integrasi wilayah administratif (Provinsi, Kabupaten/Kota, Kecamatan, Kelurahan)
- Manajemen lokasi TPS
- Mapping rute ke TPS

### 📊 Pelaporan
- Laporan dari warga terkait sampah
- Laporan kondisi TPS
- Dashboard statistik
- Database backup

### 📰 Informasi & Edukasi
- Manajemen artikel tentang persampahan
- Dashboard artikel untuk public

## 🛠️ Teknologi yang Digunakan

### Backend
- **Laravel 11.0** - PHP Framework
- **PHP 8.2+** - Programming Language
- **MySQL** - Database
- **Spatie Laravel Permission** - Role & Permission Management
- **Laravel Sanctum** - API Authentication
- **Laravel Socialite** - Social Authentication
- **Nwidart Laravel Modules** - Modular Structure

### Frontend
- **Bootstrap 5.2** - CSS Framework
- **Vite** - Asset Bundling
- **Axios** - HTTP Client
- **Sass** - CSS Preprocessor
- **Toastr** - Notification Library

## 📦 Persyaratan Sistem

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL >= 5.7 atau MariaDB >= 10.3
- Web Server (Apache/Nginx)

## 🚀 Instalasi

### 1. Clone Repository
```bash
git clone <repository-url>
cd TuNetic
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### 3. Konfigurasi Environment
```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database
Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tunetic
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migrasi & Seeder
```bash
# Jalankan migrasi database
php artisan migrate

# Jalankan seeder (opsional)
php artisan db:seed
```

### 6. Link Storage
```bash
php artisan storage:link
```

### 7. Build Assets
```bash
# Development
npm run dev

# Production
npm run build
```

### 8. Jalankan Aplikasi
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## 👥 Default User Accounts

Setelah menjalankan seeder, Anda dapat login menggunakan akun berikut:

| Role | Email | Password |
|------|-------|----------|
| Admin Pusat | admin@tunetic.com | password |
| Admin TPST | admintpst@tunetic.com | password |
| Petugas | petugas@tunetic.com | password |
| User/Warga | user@tunetic.com | password |

> **Note:** Segera ubah password default setelah login pertama kali!

## 📁 Struktur Proyek

```
TuNetic/
├── app/
│   ├── Console/          # Artisan commands
│   ├── Exceptions/       # Exception handlers
│   ├── Helpers/          # Helper classes
│   ├── Http/
│   │   ├── Controllers/  # Controllers
│   │   ├── Middleware/   # Middleware
│   │   └── Resources/    # API resources
│   ├── Models/           # Eloquent models
│   ├── Notifications/    # Custom notifications
│   ├── Providers/        # Service providers
│   └── Rules/            # Validation rules
├── config/               # Configuration files
├── database/
│   ├── migrations/       # Database migrations
│   ├── seeders/          # Database seeders
│   └── factories/        # Model factories
├── public/               # Public assets
│   ├── assets/           # Custom assets
│   ├── uploads/          # User uploads
│   └── plugins/          # Third-party plugins
├── resources/
│   ├── views/            # Blade templates
│   ├── css/              # CSS files
│   ├── js/               # JavaScript files
│   └── sass/             # Sass files
├── routes/
│   ├── web.php           # Web routes
│   ├── api.php           # API routes
│   └── channels.php      # Broadcast channels
└── storage/              # Storage directory
```

## 🔧 Konfigurasi

### Mail Configuration
Edit `.env` untuk konfigurasi email:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@tunetic.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Session & Cache
```env
SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```

## 🗃️ Database Seeder

Sistem menyediakan beberapa seeder untuk data awal:
- `MasterSeeder` - Data master sistem
- `UserSeeder` - User default
- `ArmadaSeeder` - Data armada sample
- `PetugasSeeder` - Data petugas sample
- `LokasiTpsSeeder` - Data lokasi TPS sample
- `RuteSeeder` - Data rute sample
- `JadwalSeeder` - Data jadwal sample
- `MenuSeeder` - Menu sistem berdasarkan role

Jalankan seeder spesifik:
```bash
php artisan db:seed --class=MasterSeeder
```

## 🧪 Testing

```bash
# Jalankan semua tests
php artisan test

# Jalankan test spesifik
php artisan test --filter=NamaTest
```

## 📝 API Documentation

API endpoints tersedia untuk integrasi mobile atau third-party:
- Base URL: `http://localhost:8000/api`
- Authentication: Laravel Sanctum (Token-based)

## 🤝 Kontribusi

Kontribusi selalu diterima! Silakan ikuti langkah berikut:
1. Fork repository ini
2. Buat branch feature (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 🐛 Bug Reports & Feature Requests

Jika Anda menemukan bug atau ingin request fitur baru, silakan buat issue di repository ini.

## 📄 License

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

## 👨‍💻 Developer

Dikembangkan dengan ❤️ untuk Hackathon Blackbox

## 📞 Kontak & Support

Untuk pertanyaan atau dukungan, silakan hubungi tim developer melalui:
- Email: support@tunetic.com
- Website: [Coming Soon]

## 🙏 Acknowledgments

- Laravel Framework
- Bootstrap
- Spatie Laravel Permission
- Seluruh kontributor open source

---

**TuNetic** - Menuju Lingkungan Bersih dan Sehat 🌱
