# 📚 PerpusOnline - Aplikasi Peminjaman Buku Online

![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php)
![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap)

Selamat datang di **PerpusOnline**, sebuah ekosistem perpustakaan digital yang dirancang untuk memberikan pengalaman terbaik bagi pembaca dan kontrol penuh bagi administrator.

![Pratinjau Admin Dashboard PerpusOnline](https://i.imgur.com/x2vY8aC.png)

---

## ✨ Fitur Unggulan: Ekosistem Perpustakaan Digital yang Lengkap

Aplikasi ini dirancang dengan dua pengalaman yang berbeda namun saling terintegrasi, memberikan kemudahan bagi anggota maupun kekuatan penuh bagi administrator.

### 🏛️ **Untuk Anggota Perpustakaan:** _Pengalaman Membaca Generasi Berikutnya_

| Fitur                 | Deskripsi                                                                                                                                                               |
| --------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| 🚪 **Gerbang Cerdas**     | Sistem **Registrasi & Login** yang mulus dan aman, dilengkapi dengan navigasi dinamis yang secara cerdas menyesuaikan tampilan setelah Anda masuk.                     |
| 🌟 **Beranda Dinamis**    | Halaman utama yang hidup, menampilkan koleksi **Buku Populer** yang dikurasi langsung oleh admin, lengkap dengan animasi *on-scroll* yang memanjakan mata.               |
| 🔍 **Katalog Interaktif**  | Jelajahi ratusan buku dengan mudah. Halaman katalog dilengkapi **pencarian**, **paginasi**, dan desain kartu yang elegan untuk setiap buku.                                |
| 📖 **Halaman Detail Imersif** | Dapatkan semua informasi penting—mulai dari sinopsis, penulis, hingga **stok ketersediaan real-time**—dalam satu halaman detail yang indah.                               |
| 🛒 **Keranjang Peminjaman** | Pengalaman layaknya *e-commerce*. Kumpulkan semua buku yang Anda inginkan dalam satu keranjang, pilih durasi pinjam, dan ajukan peminjaman dalam satu kali klik. |
| ✅ **Konfirmasi Instan**  | Setelah mengajukan peminjaman, dapatkan halaman konfirmasi yang jelas dengan instruksi untuk pengambilan buku.                                                         |

### ⚙️ **Untuk Administrator:** _Pusat Kendali Perpustakaan yang Powerfull_

| Fitur                           | Deskripsi                                                                                                                                                                      |
| ------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| 📊 **Dashboard Analitik**       | Pusat komando Anda. Dapatkan **data real-time** mengenai total buku, jumlah anggota, dan—yang terpenting—**permintaan peminjaman baru** yang perlu segera ditindaklanjuti.        |
| 📚 **Manajemen Konten Total (CRUD)** | Kontrol penuh atas katalog buku. **Tambah**, **Edit**, dan **Hapus** data buku melalui antarmuka **modal yang interaktif** tanpa perlu me-refresh halaman.                       |
| ⭐ **Fitur "Buku Populer"**     | Jadilah kurator konten! Cukup dengan satu klik *toggle switch* di form edit, Anda dapat **mempromosikan buku** apa pun untuk tampil langsung di halaman beranda pengguna.       |
| 🖼️ **Upload Sampul Cerdas**      | Visual adalah kunci. Unggah gambar sampul buku dengan mudah, yang akan otomatis dioptimalkan dan ditampilkan di seluruh bagian aplikasi.                                          |
| 🛡️ **Validasi & Proteksi Canggih** | Sistem secara cerdas akan **mencegah penghapusan buku** jika masih memiliki riwayat peminjaman, menjaga integritas data perpustakaan Anda.                                  |
| 🛂 **Alur Verifikasi Peminjaman**   | Proses verifikasi yang efisien. Lihat semua permintaan tertunda, tinjau detail peminjam dan buku dalam satu modal, dan **setujui peminjaman**, yang secara otomatis akan **mengurangi stok buku**. |

---

## 🛠️ Dibangun dengan Teknologi Modern & Teruji

Proyek ini tidak hanya fungsional, tetapi juga dibangun di atas fondasi teknologi yang kuat, modern, dan skalabel, memastikan kinerja dan keamanan terbaik.

| Kategori      | Teknologi & Framework                                                                                                                              | Peran & Keunggulan                                                                                                                                                           |
| ------------- | -------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **🚀 Backend**  | **PHP 8.2** & **Laravel 11**                                                                                                                       | Menggunakan versi terbaru dari bahasa dan framework paling populer di dunia untuk kecepatan, keamanan, dan ekosistem yang kaya (Eloquent ORM, Blade, Artisan CLI).        |
| **🎨 Frontend**  | **Bootstrap 5.3**, **Blade Engine**, **AOS.js**                                                                                                    | Desain yang **sepenuhnya responsif** dan modern. Interaksi pengguna dipercantik dengan **animasi on-scroll** yang halus dan manajemen tampilan yang efisien menggunakan Blade. |
| **🗃️ Database** | **MySQL**                                                                                                                                          | Sistem manajemen database relasional yang andal dan cepat, dengan struktur yang dirancang cermat menggunakan **Laravel Migrations** untuk menjaga integritas data.           |
| **📦 Manajemen** | **Composer** & **NPM/Vite** (potensial)                                                                                                              | Manajemen dependensi backend dan frontend yang modern, memastikan semua *library* selalu up-to-date dan mudah dikelola.                                                   |
