# Implementasi Arsitektur, Pembagian Jobdesk, dan Alasan Pemilihan Struktur  
## Smart Class Booking — Platform Reservasi Ruang Akademik Terpadu

## 1. Ringkasan Keputusan Arsitektur

Project **Smart Class Booking** akan menggunakan:

```text
Laravel + Blade + MySQL
```

Dengan pendekatan arsitektur:

```text
Laravel Modular Monolith
+ MVC Laravel
+ Clean Architecture Ringan
+ Use Case / Service Layer
+ Domain Service untuk Conflict Engine
+ Repository khusus untuk query kompleks
+ ViewModel sederhana untuk kebutuhan Blade
```

Arsitektur ini dipilih karena aplikasi Smart Class Booking tidak hanya berupa CRUD biasa, tetapi memiliki aturan bisnis penting seperti:

```text
- Login menggunakan NIM/NIDN.
- Dashboard status ruangan tersedia/terisi.
- Reservasi ruangan.
- Validasi bentrok jadwal atau Conflict Engine.
- Pembatalan reservasi.
- Admin untuk mengelola ruangan dan jadwal.
```

Aplikasi tetap berada dalam **satu project Laravel**, tetapi kode dipisahkan berdasarkan tanggung jawab agar lebih rapi, mudah dikembangkan, dan mudah dibagi pengerjaannya untuk tim berjumlah 3 orang.

---

## 2. Konsep Utama: Modular Monolith

### 2.1 Apa itu Modular Monolith?

**Modular Monolith** adalah arsitektur di mana aplikasi tetap berada dalam satu project dan satu deployment, tetapi struktur kodenya dipisahkan berdasarkan modul atau fitur utama.

Contoh modul pada project ini:

```text
- Auth Module
- Dashboard Module
- Room Module
- Reservation Module
- Admin Module
```

Project tidak dibuat terpisah menjadi banyak service seperti microservices. Semua tetap berada dalam satu aplikasi Laravel.

```text
smart-class-booking/
├── app/
├── database/
├── resources/
├── routes/
└── docs/
```

Namun, di dalam folder `app/`, logic dipisahkan agar tidak menumpuk di controller.

---

## 3. Kenapa Tidak Menggunakan MVC Polos?

Laravel secara bawaan menggunakan pola **MVC**:

```text
Model      = Mengelola data/database
View       = Menampilkan UI dengan Blade
Controller = Menghubungkan request dengan model dan view
```

MVC bagus untuk project sederhana. Namun, untuk aplikasi reservasi ruangan, jika semua logic ditaruh di controller, maka controller akan cepat menjadi terlalu besar.

Contoh logic yang tidak cocok ditaruh langsung di controller:

```text
- Mengecek jadwal bentrok.
- Mengecek status ruangan.
- Membuat kode booking.
- Membatalkan reservasi.
- Menentukan apakah slot waktu tersedia.
- Menentukan data dashboard.
```

Karena itu, MVC Laravel tetap digunakan sebagai dasar, tetapi ditambah layer lain agar lebih rapi.

---

## 4. Struktur Arsitektur yang Digunakan

Flow utama aplikasi:

```text
Blade View
↓
Controller
↓
Form Request
↓
Use Case / Service
↓
Domain Service
↓
Repository / Eloquent Model
↓
Database
```

### 4.1 Presentation Layer

Layer ini berhubungan dengan tampilan dan request dari pengguna.

Isi:

```text
- Blade View
- Controller
- Form Request
- ViewModel
```

Tanggung jawab:

```text
- Menampilkan halaman.
- Menerima input form.
- Melakukan validasi awal.
- Mengirim data ke view.
- Menampilkan pesan sukses/error.
```

Contoh folder:

```text
resources/views/
app/Http/Controllers/
app/Http/Requests/
app/ViewModels/
```

---

### 4.2 Application Layer

Layer ini berisi alur fitur atau use case.

Isi:

```text
- LoginUser
- GetDashboardData
- CreateReservation
- CancelReservation
- GetMyReservations
- CreateRoom
- UpdateRoom
```

Tanggung jawab:

```text
- Mengatur proses utama fitur.
- Memanggil service/domain logic.
- Memanggil repository/model.
- Menentukan hasil proses sebelum dikembalikan ke controller.
```

Contoh:

```text
app/Application/Auth/LoginUser.php
app/Application/Dashboard/GetDashboardData.php
app/Application/Reservation/CreateReservation.php
app/Application/Reservation/CancelReservation.php
app/Application/Room/GetRoomSchedule.php
```

---

### 4.3 Domain Layer

Layer ini berisi aturan bisnis utama aplikasi.

Isi:

```text
- ConflictEngine
- ReservationStatus
- RoomStatus
- aturan reservasi
```

Tanggung jawab:

```text
- Menentukan apakah jadwal bentrok.
- Menentukan status reservasi.
- Menentukan aturan ruangan bisa/tidak bisa dipinjam.
- Menjaga logic utama tidak bercampur dengan controller.
```

Contoh aturan domain:

```text
- Ruangan yang inactive tidak boleh dipesan.
- Jam mulai harus lebih awal daripada jam selesai.
- Reservasi cancelled tidak dihitung sebagai bentrok.
- Reservasi di ruangan yang sama tidak boleh memiliki waktu overlap.
- Jadwal kuliah tetap memiliki prioritas lebih tinggi daripada reservasi umum.
```

Contoh folder:

```text
app/Domain/Reservation/Services/ConflictEngine.php
app/Domain/Reservation/Enums/ReservationStatus.php
app/Domain/Room/Enums/RoomStatus.php
```

---

### 4.4 Infrastructure Layer

Layer ini berhubungan dengan database dan query.

Isi:

```text
- Repository
- Eloquent Model
- Migration
- Seeder
```

Tanggung jawab:

```text
- Mengambil data dari database.
- Menyimpan data ke database.
- Menangani query yang kompleks.
- Menyiapkan data awal melalui seeder.
```

Contoh folder:

```text
app/Infrastructure/Repositories/
app/Models/
database/migrations/
database/seeders/
```

Repository tidak wajib dibuat untuk semua fitur. Repository digunakan terutama untuk fitur yang query-nya cukup kompleks, seperti reservasi dan jadwal ruangan.

---

## 5. Struktur Folder yang Disarankan

```text
smart-class-booking/
├── app/
│   ├── Application/
│   │   ├── Auth/
│   │   │   └── LoginUser.php
│   │   ├── Dashboard/
│   │   │   └── GetDashboardData.php
│   │   ├── Room/
│   │   │   ├── CreateRoom.php
│   │   │   ├── UpdateRoom.php
│   │   │   ├── DeleteRoom.php
│   │   │   └── GetRoomSchedule.php
│   │   └── Reservation/
│   │       ├── CreateReservation.php
│   │       ├── CancelReservation.php
│   │       └── GetMyReservations.php
│   │
│   ├── Domain/
│   │   ├── Room/
│   │   │   └── Enums/
│   │   │       └── RoomStatus.php
│   │   └── Reservation/
│   │       ├── Services/
│   │       │   └── ConflictEngine.php
│   │       └── Enums/
│   │           └── ReservationStatus.php
│   │
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── RoomController.php
│   │   │   ├── ReservationController.php
│   │   │   └── Admin/
│   │   │       ├── AdminRoomController.php
│   │   │       └── AdminReservationController.php
│   │   └── Requests/
│   │       ├── LoginRequest.php
│   │       ├── StoreReservationRequest.php
│   │       ├── StoreRoomRequest.php
│   │       └── UpdateRoomRequest.php
│   │
│   ├── Infrastructure/
│   │   └── Repositories/
│   │       ├── RoomRepository.php
│   │       └── ReservationRepository.php
│   │
│   ├── Models/
│   │   ├── User.php
│   │   ├── Room.php
│   │   ├── Reservation.php
│   │   └── Schedule.php
│   │
│   └── ViewModels/
│       ├── DashboardViewModel.php
│       ├── RoomDetailViewModel.php
│       └── MyReservationViewModel.php
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── resources/
│   ├── views/
│   │   ├── auth/
│   │   │   └── login.blade.php
│   │   ├── dashboard/
│   │   │   └── index.blade.php
│   │   ├── rooms/
│   │   │   ├── index.blade.php
│   │   │   └── show.blade.php
│   │   ├── reservations/
│   │   │   └── my-reservations.blade.php
│   │   └── admin/
│   │       ├── rooms/
│   │       └── reservations/
│   │
│   ├── css/
│   └── js/
│
├── routes/
│   └── web.php
│
└── docs/
    ├── ARCHITECTURE.md
    ├── API_DOCUMENTATION.md
    ├── DATABASE_DESIGN.md
    └── TESTING_CHECKLIST.md
```

---

## 6. Alur Implementasi Fitur

### 6.1 Alur Login

```text
login.blade.php
↓
AuthController@login
↓
LoginRequest
↓
LoginUser
↓
User Model
↓
Database
```

Penjelasan:

```text
- Pengguna memasukkan NIM/NIDN dan password.
- LoginRequest memvalidasi input.
- LoginUser menjalankan proses autentikasi.
- Jika valid, user diarahkan ke dashboard.
- Jika gagal, user tetap di halaman login dengan pesan error.
```

---

### 6.2 Alur Dashboard Ruangan

```text
dashboard/index.blade.php
↓
DashboardController@index
↓
GetDashboardData
↓
DashboardViewModel
↓
RoomRepository / Room Model
↓
Database
```

Penjelasan:

```text
- Pengguna membuka dashboard.
- Sistem mengambil daftar ruangan.
- Sistem menghitung status ruangan tersedia/terisi.
- ViewModel menyiapkan data agar siap ditampilkan di Blade.
- Blade hanya menampilkan card/list ruangan.
```

---

### 6.3 Alur Reservasi Ruangan

```text
rooms/show.blade.php
↓
ReservationController@store
↓
StoreReservationRequest
↓
CreateReservation
↓
ConflictEngine
↓
ReservationRepository
↓
Reservation Model
↓
Database
```

Penjelasan:

```text
- Pengguna memilih ruangan dan slot waktu.
- StoreReservationRequest memvalidasi input.
- CreateReservation menjalankan proses reservasi.
- ConflictEngine mengecek apakah ada jadwal bentrok.
- Jika bentrok, sistem menolak reservasi.
- Jika aman, sistem menyimpan reservasi ke database.
```

---

### 6.4 Alur Pembatalan Reservasi

```text
my-reservations.blade.php
↓
ReservationController@cancel
↓
CancelReservation
↓
ReservationRepository
↓
Reservation Model
↓
Database
```

Penjelasan:

```text
- Pengguna membuka halaman Peminjaman Saya.
- Pengguna menekan tombol Batalkan.
- Sistem mengubah status reservasi menjadi cancelled.
- Slot ruangan kembali dianggap tersedia.
```

---

### 6.5 Alur Admin Mengelola Ruangan

```text
admin/rooms/index.blade.php
↓
AdminRoomController
↓
CreateRoom / UpdateRoom / DeleteRoom
↓
RoomRepository
↓
Room Model
↓
Database
```

Penjelasan:

```text
- Admin dapat menambah, mengubah, dan menghapus data ruangan.
- Admin dapat mengubah status ruangan menjadi active atau inactive.
- Ruangan inactive tidak bisa dipesan oleh user.
```

---

## 7. Desain Database Minimal

### 7.1 Tabel users

```text
users
- id
- name
- identity_number
- password
- role
- created_at
- updated_at
```

Keterangan:

```text
identity_number = NIM/NIDN
role            = admin/user
```

---

### 7.2 Tabel rooms

```text
rooms
- id
- name
- building
- capacity
- facilities
- status
- created_at
- updated_at
```

Keterangan:

```text
status = active/inactive
```

---

### 7.3 Tabel reservations

```text
reservations
- id
- booking_code
- user_id
- room_id
- title
- purpose
- reservation_date
- start_time
- end_time
- status
- created_at
- updated_at
```

Keterangan:

```text
status = active/cancelled/finished
```

---

### 7.4 Tabel schedules

```text
schedules
- id
- room_id
- title
- lecturer_name
- day
- start_time
- end_time
- type
- created_at
- updated_at
```

Keterangan:

```text
type = fixed_class/general
```

Tabel `schedules` digunakan untuk jadwal kuliah tetap atau jadwal terkunci oleh admin.

---

## 8. Conflict Engine

Conflict Engine adalah bagian paling penting dalam sistem reservasi ini.

### 8.1 Tugas Conflict Engine

```text
- Mengecek apakah slot waktu sudah digunakan.
- Mengecek apakah ruangan sedang inactive.
- Mengecek apakah jadwal bentrok dengan reservasi aktif.
- Mengecek apakah jadwal bentrok dengan jadwal kuliah tetap.
- Mengembalikan hasil validasi ke use case CreateReservation.
```

### 8.2 Aturan Overlap Waktu

Dua jadwal dianggap bentrok jika:

```text
start_time_baru < end_time_lama
DAN
end_time_baru > start_time_lama
```

Contoh:

```text
Reservasi lama:
10:00 - 12:00

Reservasi baru:
11:00 - 13:00

Hasil:
Bentrok
```

Contoh tidak bentrok:

```text
Reservasi lama:
10:00 - 12:00

Reservasi baru:
12:00 - 13:00

Hasil:
Tidak bentrok
```

---

## 9. Pembagian Jobdesk Tim

Tim terdiri dari:

```text
- Muhammad Rakha` Athallah
- Naufal Khalish
- Rizki Adhitiya Maulana
```

---

### 9.1 Rakha — Backend, Domain, Database, dan Conflict Engine

Fokus utama:

```text
Backend logic dan aturan bisnis sistem.
```

Tanggung jawab:

```text
- Setup Laravel project bagian backend.
- Membuat migration database.
- Membuat model dan relasi.
- Membuat seeder akun dummy dan data ruangan.
- Membuat LoginUser use case.
- Membuat CreateReservation use case.
- Membuat CancelReservation use case.
- Membuat ConflictEngine.
- Membuat repository untuk reservation dan room.
- Membuat controller utama jika dibutuhkan.
- Membuat dokumentasi arsitektur dan database.
```

Folder utama yang dikerjakan:

```text
app/Application/
app/Domain/
app/Infrastructure/
app/Models/
database/migrations/
database/seeders/
```

Output yang harus dihasilkan:

```text
- Login NIM/NIDN berjalan.
- Database users, rooms, reservations, schedules tersedia.
- Reservasi dapat dibuat.
- Jadwal bentrok otomatis ditolak.
- Reservasi dapat dibatalkan.
```

---

### 9.2 Naufal — Frontend Blade, Layout, dan Responsive Design

Fokus utama:

```text
Tampilan aplikasi dan pengalaman pengguna.
```

Tanggung jawab:

```text
- Membuat layout utama aplikasi.
- Membuat halaman login.
- Membuat halaman dashboard.
- Membuat card/list ruangan.
- Membuat indikator status ruangan.
- Membuat halaman detail ruangan.
- Membuat form reservasi.
- Membuat halaman Peminjaman Saya.
- Membuat tampilan admin sederhana.
- Membuat tampilan mobile-friendly.
```

Folder utama yang dikerjakan:

```text
resources/views/
resources/css/
resources/js/
public/
```

Output yang harus dihasilkan:

```text
- Halaman login siap digunakan.
- Dashboard ruangan tampil rapi.
- Status ruangan mudah dipahami.
- Form reservasi bisa digunakan.
- Halaman riwayat peminjaman tersedia.
```

---

### 9.3 Rizki — Integrasi, ViewModel, Testing, Admin, dan Dokumentasi

Fokus utama:

```text
Menyambungkan backend dan frontend serta memastikan fitur berjalan.
```

Tanggung jawab:

```text
- Membantu integrasi controller ke Blade.
- Membuat ViewModel untuk dashboard dan reservasi.
- Membantu halaman admin.
- Melakukan testing manual.
- Membuat checklist testing.
- Menulis dokumentasi penggunaan aplikasi.
- Membantu bug fixing.
- Membantu deploy jika diperlukan.
```

Folder utama yang dikerjakan:

```text
app/ViewModels/
app/Http/Controllers/
resources/views/admin/
docs/
```

Output yang harus dihasilkan:

```text
- Data dari backend tampil di Blade.
- Dashboard menggunakan data asli dari database.
- Halaman Peminjaman Saya menampilkan reservasi user.
- Admin dapat melihat data ruangan dan reservasi.
- Testing checklist selesai.
```

---

## 10. Pembagian Modul Berdasarkan Fitur

| Modul | Owner Utama | Support | Prioritas |
|---|---|---|---|
| Auth/Login | Rakha | Rizki | P0 |
| Dashboard Ruangan | Naufal | Rizki | P0 |
| Database & Seeder | Rakha | Rizki | P0 |
| Reservasi Ruangan | Rakha | Naufal | P0 |
| Conflict Engine | Rakha | Rizki | P0 |
| Pembatalan Reservasi | Rakha | Naufal | P0 |
| Peminjaman Saya | Naufal | Rizki | P0 |
| Admin Ruangan | Rizki | Rakha | P1 |
| Admin Reservasi | Rizki | Naufal | P1 |
| Dokumentasi | Rizki | Semua | P0/P1 |
| Testing | Rizki | Semua | P0/P1 |

---

## 11. Workflow Git

### 11.1 Branch Utama

```text
main
develop
```

Keterangan:

```text
main    = versi final stabil
develop = branch gabungan untuk pengembangan
```

### 11.2 Branch Fitur

Contoh branch:

```text
backend/setup-database
backend/auth
backend/reservation
backend/conflict-engine
frontend/layout
frontend/dashboard
frontend/reservation-form
integration/dashboard-data
integration/reservation-flow
docs/architecture
```

### 11.3 Alur Kerja Harian

Setiap mulai kerja:

```bash
git checkout develop
git pull origin develop
git checkout -b nama-branch
```

Setelah selesai mengerjakan fitur:

```bash
git add .
git commit -m "feat: add nama fitur"
git push origin nama-branch
```

Lalu buat Pull Request ke:

```text
develop
```

Setelah fitur di `develop` stabil, baru merge ke `main`.

---

## 12. Urutan Implementasi yang Disarankan

### Tahap 1 — Fondasi Project

Target:

```text
- Install Laravel.
- Setup database.
- Setup struktur folder arsitektur.
- Setup migration.
- Setup seeder.
- Setup layout Blade dasar.
```

Output:

```text
Project bisa dijalankan di semua laptop anggota.
```

---

### Tahap 2 — Auth dan Role

Target:

```text
- Login menggunakan NIM/NIDN.
- Role user dan admin.
- Middleware auth.
- Middleware admin.
```

Output:

```text
User dapat login.
Admin dapat masuk ke halaman admin.
```

---

### Tahap 3 — Dashboard Ruangan

Target:

```text
- Menampilkan daftar ruangan.
- Menampilkan status active/inactive.
- Menampilkan status tersedia/terisi berdasarkan jadwal.
```

Output:

```text
Dashboard menampilkan data ruangan dari database.
```

---

### Tahap 4 — Reservasi dan Conflict Engine

Target:

```text
- User bisa memilih ruangan.
- User bisa mengisi form reservasi.
- Sistem mengecek jadwal bentrok.
- Sistem menolak double booking.
```

Output:

```text
Reservasi valid berhasil.
Reservasi bentrok ditolak.
```

---

### Tahap 5 — Riwayat dan Pembatalan

Target:

```text
- User bisa melihat reservasi miliknya.
- User bisa membatalkan reservasi.
- Slot waktu kembali tersedia setelah dibatalkan.
```

Output:

```text
Halaman Peminjaman Saya berjalan.
```

---

### Tahap 6 — Admin

Target:

```text
- Admin bisa melihat ruangan.
- Admin bisa tambah/edit/hapus ruangan.
- Admin bisa melihat semua reservasi.
- Admin bisa membatalkan reservasi jika diperlukan.
```

Output:

```text
Admin memiliki kontrol dasar terhadap sistem.
```

---

### Tahap 7 — Testing dan Dokumentasi

Target:

```text
- Test login berhasil/gagal.
- Test dashboard.
- Test reservasi valid.
- Test reservasi bentrok.
- Test pembatalan.
- Test admin.
- Rapikan README dan dokumentasi.
```

Output:

```text
Project siap demo dan dipresentasikan.
```

---

## 13. Kenapa Struktur Ini Lebih Bagus?

### 13.1 Controller Tidak Terlalu Gemuk

Jika menggunakan MVC polos, semua logic sering menumpuk di controller.

Dengan struktur ini:

```text
Controller hanya menerima request dan mengarahkan proses.
Logic utama dipindahkan ke Use Case dan Service.
```

Hasilnya:

```text
- Controller lebih pendek.
- Kode lebih mudah dibaca.
- Bug lebih mudah dicari.
```

---

### 13.2 Logic Reservasi Lebih Aman

Fitur reservasi memiliki aturan penting, terutama conflict engine.

Dengan Domain Service:

```text
ConflictEngine dipisah ke file khusus.
```

Keuntungannya:

```text
- Logic bentrok jadwal tidak tercecer.
- Mudah dites.
- Mudah diperbaiki jika aturan berubah.
- Bisa digunakan ulang oleh user maupun admin.
```

---

### 13.3 Mudah Dibagi untuk 3 Orang

Struktur ini membuat pembagian kerja lebih jelas.

```text
Rakha  = backend/domain/database
Naufal = frontend/blade/ui
Rizki  = integrasi/testing/admin/dokumentasi
```

Dengan begitu, setiap orang tahu folder dan tanggung jawabnya.

---

### 13.4 Mudah Dikembangkan ke Fitur Lanjutan

Jika nanti ingin menambah fitur P1/P2 seperti:

```text
- Email notification
- QR Code check-in
- IoT integration
- Mobile app
```

Struktur ini masih bisa dikembangkan karena logic utama sudah dipisah.

Contoh:

```text
Fitur QR Code bisa ditambah di modul Reservation.
Fitur email bisa ditambah di Application/Notification.
Fitur mobile app bisa memakai API dari logic yang sama.
```

---

### 13.5 Lebih Mudah Dijelaskan Saat Presentasi

Arsitektur ini mudah dijelaskan:

```text
Kami menggunakan Laravel Modular Monolith. Aplikasi tetap berada dalam satu project agar mudah dikembangkan oleh tim kecil, tetapi kode dipisahkan berdasarkan layer. Controller menangani request, Use Case menjalankan alur fitur, Domain Service menyimpan aturan bisnis seperti Conflict Engine, Repository/Model menangani database, dan Blade digunakan untuk tampilan.
```

---

## 14. Batasan agar Tidak Over-Engineering

Walaupun menggunakan Clean Architecture ringan, tim tidak perlu membuat struktur yang terlalu rumit.

Hindari:

```text
- Membuat interface untuk semua repository.
- Membuat DTO untuk semua data kecil.
- Membuat terlalu banyak folder untuk fitur sederhana.
- Membuat microservices.
- Membuat API terpisah jika masih memakai Blade.
- Membuat dependency injection yang terlalu kompleks.
```

Fokus pada:

```text
- Controller tipis.
- Service/use case jelas.
- Conflict engine terpisah.
- ViewModel untuk halaman kompleks.
- Migration dan seeder rapi.
- Testing alur utama.
```

---

## 15. Kesimpulan

Arsitektur yang digunakan adalah:

```text
Laravel Modular Monolith
+ MVC Laravel
+ Clean Architecture Ringan
+ Use Case / Service Layer
+ Domain Service
+ Repository untuk query penting
+ ViewModel sederhana untuk Blade
```

Struktur ini lebih baik karena:

```text
- Cocok untuk satu project Laravel.
- Tidak serumit microservices.
- Lebih rapi daripada MVC polos.
- Cocok untuk tim 3 orang.
- Logic reservasi lebih aman.
- Conflict Engine mudah diuji.
- Mudah dikembangkan ke fitur lanjutan.
- Mudah dijelaskan saat presentasi.
```

Target akhir aplikasi:

```text
Login
→ Dashboard Ruangan
→ Detail Jadwal
→ Reservasi
→ Conflict Engine
→ Riwayat Peminjaman
→ Pembatalan
→ Admin Monitoring
```
