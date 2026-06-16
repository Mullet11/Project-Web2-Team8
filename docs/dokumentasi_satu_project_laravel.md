# Dokumentasi Konsep Satu Project Laravel

## Smart Class Booking - Platform Reservasi Ruang Akademik Terpadu

Dokumen ini menjelaskan maksud dari penggunaan **satu project Laravel** untuk pengembangan aplikasi **Smart Class Booking**. Konsep ini dipilih agar tim dapat bekerja lebih cepat, lebih sederhana, dan lebih mudah melakukan integrasi karena waktu pengerjaan terbatas.

---

## 1. Apa Maksud dari Satu Project?

**Satu project** berarti frontend dan backend berada dalam **satu aplikasi Laravel yang sama**.

Artinya, tim tidak membuat dua aplikasi terpisah seperti ini:

```text
smart-class-booking/
├── frontend/   ← aplikasi frontend React/Vue terpisah
└── backend/    ← aplikasi backend Laravel API terpisah
```

Tetapi cukup membuat satu aplikasi Laravel seperti ini:

```text
smart-class-booking/
├── app/                  ← backend logic Laravel
├── database/             ← migration, seeder, database structure
├── routes/               ← routing aplikasi
├── resources/views/      ← tampilan frontend Blade
├── resources/css/        ← styling CSS/Tailwind
├── resources/js/         ← JavaScript pendukung
├── public/               ← asset publik
├── composer.json
├── package.json
└── .env
```

Dalam konsep ini, Laravel menangani dua bagian sekaligus:

```text
Backend:
- Controller
- Model
- Database
- Authentication
- Authorization
- Conflict Engine
- Logic reservasi

Frontend:
- Halaman login
- Dashboard ruangan
- Form reservasi
- Halaman peminjaman saya
- Halaman admin
- Tampilan status ruangan
```

Jadi, aplikasi tetap memiliki frontend dan backend, tetapi semuanya berada dalam satu folder project Laravel.

---

## 2. Kenapa Menggunakan Satu Project Laravel?

Karena tim hanya terdiri dari 3 orang dan waktu pengerjaan terbatas, konsep satu project lebih efisien dibandingkan memisahkan frontend dan backend.

Keuntungannya:

```text
- Tidak perlu membuat frontend dan backend sebagai aplikasi terpisah.
- Tidak perlu konfigurasi CORS yang rumit.
- Tidak perlu terlalu banyak setup API untuk halaman internal.
- Login dan session lebih mudah karena memakai sistem Laravel langsung.
- Data dari database bisa langsung dikirim ke halaman Blade.
- Integrasi frontend dan backend lebih cepat.
- Cocok untuk project kampus dan kebutuhan demo.
```

Dengan pendekatan ini, tim bisa lebih fokus mengejar fitur MVP:

```text
Login → Dashboard Ruangan → Reservasi → Conflict Engine → Riwayat → Pembatalan → Admin Monitoring
```

---

## 3. Cara Kerja Satu Project Laravel

Contoh alur saat pengguna membuka dashboard:

```text
User membuka /dashboard
↓
Route Laravel menerima request
↓
Controller mengambil data ruangan dari database
↓
Controller mengirim data ke Blade view
↓
Blade menampilkan dashboard ruangan kepada user
```

Contoh controller:

```php
public function dashboard()
{
    $rooms = Room::all();

    return view('dashboard', compact('rooms'));
}
```

Contoh Blade view:

```blade
@foreach ($rooms as $room)
    <div class="room-card">
        <h3>{{ $room->name }}</h3>
        <p>Kapasitas: {{ $room->capacity }}</p>
        <p>Status: {{ $room->status }}</p>
    </div>
@endforeach
```

Dengan cara ini, frontend tidak harus selalu melakukan request API menggunakan `fetch` atau `axios`. Data bisa langsung dikirim dari controller ke halaman Blade.

---

## 4. Perbedaan Satu Project dan Project Terpisah

### A. Satu Project Laravel

```text
Laravel + Blade + MySQL
```

Cocok digunakan jika:

```text
- Waktu pengerjaan singkat.
- Tim kecil.
- Fokus utama adalah aplikasi cepat selesai dan bisa demo.
- Tidak ingin terlalu ribet dengan integrasi frontend-backend.
- Fitur masih berbasis halaman web biasa.
```

### B. Project Terpisah

```text
Frontend: React/Vue
Backend: Laravel API
Database: MySQL
```

Cocok digunakan jika:

```text
- Waktu pengerjaan lebih panjang.
- Tim sudah terbiasa membuat REST API.
- Frontend dan backend ingin benar-benar dipisahkan.
- Aplikasi lebih besar dan kompleks.
- Butuh arsitektur modern full SPA.
```

Untuk kondisi tim saat ini, pendekatan yang paling disarankan adalah:

```text
Laravel satu project + Blade + MySQL
```

---

## 5. Pembagian Folder Kerja

Walaupun hanya satu project, setiap anggota tetap bisa fokus pada bagian masing-masing.

### Rakha - Backend Lead

Fokus folder:

```text
app/Models/
app/Http/Controllers/
app/Http/Middleware/
database/migrations/
database/seeders/
routes/web.php
```

Tugas utama:

```text
- Membuat database structure.
- Membuat model Laravel.
- Membuat controller.
- Membuat logic login.
- Membuat logic reservasi.
- Membuat conflict engine.
- Membuat logic pembatalan reservasi.
- Membuat middleware role user/admin.
```

---

### Naufal - Frontend/UI Lead

Fokus folder:

```text
resources/views/
resources/css/
resources/js/
public/
```

Tugas utama:

```text
- Membuat layout halaman login.
- Membuat dashboard ruangan.
- Membuat card/list ruangan.
- Membuat indikator status merah/hijau.
- Membuat form reservasi.
- Membuat halaman peminjaman saya.
- Membuat tampilan responsive.
```

---

### Rizki - Integrasi, Testing, dan Dokumentasi

Fokus folder:

```text
resources/views/
routes/web.php
docs/
README.md
```

Tugas utama:

```text
- Membantu menghubungkan view dengan data dari controller.
- Testing alur login.
- Testing alur reservasi.
- Testing conflict engine.
- Membantu membuat halaman admin sederhana.
- Membuat dokumentasi penggunaan aplikasi.
- Membantu deploy dan finalisasi demo.
```

---

## 6. Struktur Folder yang Disarankan

```text
smart-class-booking/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── RoomController.php
│   │   │   ├── ReservationController.php
│   │   │   └── AdminController.php
│   │   └── Middleware/
│   │       └── RoleMiddleware.php
│   └── Models/
│       ├── User.php
│       ├── Room.php
│       └── Reservation.php
│
├── database/
│   ├── migrations/
│   │   ├── create_users_table.php
│   │   ├── create_rooms_table.php
│   │   └── create_reservations_table.php
│   └── seeders/
│       ├── UserSeeder.php
│       └── RoomSeeder.php
│
├── resources/
│   ├── views/
│   │   ├── auth/
│   │   │   └── login.blade.php
│   │   ├── dashboard.blade.php
│   │   ├── rooms/
│   │   │   ├── index.blade.php
│   │   │   └── show.blade.php
│   │   ├── reservations/
│   │   │   ├── create.blade.php
│   │   │   └── my-reservations.blade.php
│   │   ├── admin/
│   │   │   ├── rooms.blade.php
│   │   │   └── reservations.blade.php
│   │   └── layouts/
│   │       └── app.blade.php
│   ├── css/
│   └── js/
│
├── routes/
│   └── web.php
│
├── docs/
│   ├── WORKFLOW_JOBDESK.md
│   ├── API_DOCUMENTATION.md
│   ├── DATABASE_DESIGN.md
│   └── TESTING_CHECKLIST.md
│
├── public/
├── .env
├── .env.example
├── composer.json
├── package.json
└── README.md
```

---

## 7. Contoh Alur Fitur Login

```text
User membuka halaman login
↓
User memasukkan NIM/NIDN dan password
↓
Form dikirim ke route POST /login
↓
AuthController mengecek data user di database
↓
Jika valid, user masuk ke dashboard
↓
Jika salah, user tetap di login dan muncul pesan error
```

Route:

```php
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
```

---

## 8. Contoh Alur Fitur Reservasi

```text
User membuka dashboard
↓
User memilih ruangan yang tersedia
↓
User mengisi tanggal, jam mulai, jam selesai, dan tujuan peminjaman
↓
Sistem menjalankan conflict engine
↓
Jika tidak ada bentrok, reservasi disimpan
↓
Jika ada bentrok, reservasi ditolak dan muncul pesan error
```

Logic conflict engine secara sederhana:

```text
Reservasi bentrok jika:
- room_id sama
- tanggal sama
- status reservasi masih aktif
- jam mulai baru lebih kecil dari jam selesai lama
- jam selesai baru lebih besar dari jam mulai lama
```

Contoh kondisi overlap:

```php
$conflict = Reservation::where('room_id', $request->room_id)
    ->where('reservation_date', $request->reservation_date)
    ->where('status', 'active')
    ->where('start_time', '<', $request->end_time)
    ->where('end_time', '>', $request->start_time)
    ->exists();
```

Jika `$conflict` bernilai `true`, maka sistem harus menolak reservasi.

---

## 9. Workflow Git untuk Satu Project

Karena semua berada dalam satu project Laravel, setiap anggota harus disiplin memakai branch.

Branch utama:

```text
main
└── develop
```

Branch fitur:

```text
backend/auth
backend/reservation
backend/admin
frontend/login-dashboard
frontend/reservation-page
integration/final-testing
docs/final-documentation
```

Contoh mulai kerja:

```bash
git checkout develop
git pull origin develop
git checkout -b backend/auth
```

Contoh menyimpan progress:

```bash
git add .
git commit -m "feat: add login authentication"
git push origin backend/auth
```

Setelah itu buat Pull Request ke branch `develop`.

---

## 10. Aturan Kerja Tim

```text
1. Jangan langsung push ke main.
2. Semua fitur masuk dulu ke develop.
3. Satu branch hanya untuk satu fitur.
4. Pull dulu sebelum mulai kerja.
5. Commit harus kecil dan jelas.
6. Jangan mengedit file yang sedang dikerjakan anggota lain tanpa koordinasi.
7. Setiap fitur wajib dites sebelum Pull Request.
8. Setiap malam wajib push progress.
9. Jika conflict Git muncul, selesaikan bersama.
10. Fokus selesaikan MVP sebelum menambah fitur baru.
```

---

## 11. Kesimpulan

Konsep **satu project Laravel** berarti frontend dan backend tidak dipisah menjadi dua aplikasi, melainkan digabung dalam satu aplikasi Laravel.

Pendekatan ini cocok untuk project Smart Class Booking karena:

```text
- Tim hanya 3 orang.
- Waktu pengerjaan terbatas.
- Fitur utama harus cepat selesai.
- Integrasi frontend dan backend lebih mudah.
- Cocok untuk demo project kampus.
```

Target utama yang harus diselesaikan:

```text
Login → Dashboard Ruangan → Reservasi → Conflict Engine → Riwayat → Pembatalan → Admin Monitoring
```

Dengan workflow ini, tim tetap bisa membagi tugas dengan jelas, tetapi integrasi project tetap sederhana dan cepat.
