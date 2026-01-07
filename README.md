# Alfa Frozen Jaya (AFJ) - Digital Portal

> **Repository Name:** `alfa-frozen-jaya-web`  
> **Description:** Platform terpadu untuk Alfa Frozen Jaya yang menggabungkan E-Katalog produk sembako/frozen food dengan Sistem Absensi karyawan berbasis web.

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/tailwindcss-%2338B2AC.svg?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)

---

## 🌟 Fitur Utama

### 1. Digital Katalog (Customer Facing)
* **Seamless Browsing:** Antarmuka modern untuk menjelajahi produk frozen food dan sembako.
* **Responsive Dual-Nav:** * **Desktop:** Header elegan dengan logo ganda (AFJ & Sembako).
    * **Mobile:** Bottom navigation bar yang intuitif untuk pengalaman layaknya aplikasi mobile asli.
* **Reseller Gateway:** Halaman khusus informasi kemitraan dan pendaftaran reseller.

### 2. Sistem Absensi (Internal Operations)
* **Pencatatan Kehadiran:** Sistem login karyawan untuk melakukan absensi masuk dan pulang secara digital.
* **Manajemen Data Staf:** Monitoring kehadiran harian oleh admin untuk efisiensi penggajian dan disiplin kerja.
* **Security Auth:** Proteksi halaman absensi sehingga hanya bisa diakses oleh staf resmi.

---

## 🛠️ Stack Teknologi

* **Framework:** Laravel 10 (PHP 8.1+)
* **Frontend:** Tailwind CSS & Alpine.js
* **Database:** MySQL
* **Icons:** Heroicons

---

## 🚀 Panduan Instalasi

### Prasyarat
* PHP >= 8.1
* Composer
* Node.js & NPM
* MySQL Server

### Langkah-langkah
1.  **Clone Repository**
    ```bash
    git clone [https://github.com/username/alfa-frozen-jaya-portal.git](https://github.com/username/alfa-frozen-jaya-portal.git)
    cd alfa-frozen-jaya-portal
    ```

2.  **Instalasi Dependency**
    ```bash
    composer install
    npm install && npm run build
    ```

3.  **Konfigurasi Environment**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Sesuaikan variabel `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` di file `.env`.*

4.  **Migrasi Database**
    ```bash
    php artisan migrate --seed
    ```

5.  **Jalankan Server**
    ```bash
    php artisan serve
    ```
    Akses aplikasi di: `http://localhost:8000`

---

## 📂 Struktur Penting
* `resources/views/components/`: Berisi komponen Navbar Desktop dan Mobile.
* `app/Http/Controllers/`: Logika sistem katalog dan algoritma absensi.
* `public/images/`: Penyimpanan aset visual (logoafj.jpg dan logo pendukung).

## 📄 Status Proyek & Lisensi
Proyek ini dikembangkan dalam rangka program **Project Based Learning (PBL) / On the Job Training (OJT)**.

* **Pengembang:** Tommy Oktoriyan Ketaren
* **Institusi:** BBPVP Bekasi
* **Mitra Industri:** Alfa Frozen Jaya (AFJ)

Seluruh hak cipta atas aset desain dan kode sumber ini mengikuti kebijakan kesepakatan antara pihak institusi pendidikan dan mitra industri terkait. Penggunaan di luar kepentingan edukasi dan operasional AFJ memerlukan izin tertulis.

---
**Maintained by:** Tommy Oktoriyan Ketaren ([@tommoriaren](https://github.com/tommoriaren))
