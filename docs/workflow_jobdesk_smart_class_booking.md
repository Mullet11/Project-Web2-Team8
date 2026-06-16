# Workflow dan Pembagian Jobdesk  
# Project Web App: Smart Class Booking

## 1. Ringkasan Project

**Smart Class Booking** adalah web app untuk reservasi ruang kelas akademik. Tujuan utamanya adalah membuat proses pengecekan ruang kosong, pemesanan ruangan, pembatalan reservasi, dan pengelolaan jadwal menjadi lebih cepat, rapi, dan tidak bentrok.

Karena waktu pengerjaan tersisa **7 hari** dan progress masih **0**, maka fokus utama tim adalah menyelesaikan **MVP (Minimum Viable Product)**, bukan semua fitur besar di PRD.

---

## 2. Target MVP 7 Hari

Fitur yang wajib selesai untuk demo:

1. Login menggunakan akun resmi kampus berupa **NIM/NIDN dan password**.
2. Dashboard daftar ruangan.
3. Status ruangan:
   - **Tersedia**
   - **Terisi**
   - **Non-Aktif** jika diperlukan.
4. Detail jadwal ruangan.
5. Reservasi ruangan.
6. Conflict Engine untuk mencegah jadwal bentrok.
7. Riwayat peminjaman pengguna.
8. Pembatalan reservasi.
9. Admin sederhana untuk:
   - Melihat data ruangan.
   - Menambah/mengubah/menghapus ruangan.
   - Melihat semua reservasi.
   - Membatalkan reservasi jika diperlukan.

---

## 3. Fitur yang Ditunda

Fitur berikut tidak dikerjakan dulu karena bukan prioritas 7 hari:

1. Email notification.
2. QR Code check-in.
3. IoT integration.
4. Mobile app Android/iOS.
5. Fitur ruang terdekat berbasis GPS.
6. Sistem real-time kompleks menggunakan WebSocket.
7. Kalender akademik semester penuh yang terlalu detail.
8. Notifikasi otomatis lanjutan.

Fokus utama adalah membuat alur inti berjalan dengan baik:

```text
Login → Dashboard Ruangan → Detail Jadwal → Reservasi → Conflict Engine → Riwayat → Pembatalan → Admin Monitoring
```

---

## 4. Pembagian Role Tim

### 4.1 Muhammad Rakha` Athallah  
**Role Utama: Backend Lead + Database + API + Conflict Engine**

Rakha bertanggung jawab pada bagian backend, database, API, dan validasi utama agar sistem tidak terjadi double booking.

#### Jobdesk Rakha

1. Setup project backend.
2. Setup koneksi database.
3. Membuat desain database.
4. Membuat tabel:
   - users
   - rooms
   - reservations
   - schedules jika diperlukan.
5. Membuat seed data:
   - akun user dummy
   - akun admin dummy
   - data ruangan dummy
   - data jadwal dummy.
6. Membuat API login.
7. Membuat API logout.
8. Membuat API profile.
9. Membuat API daftar ruangan.
10. Membuat API detail ruangan.
11. Membuat API jadwal ruangan.
12. Membuat API reservasi ruangan.
13. Membuat Conflict Engine.
14. Membuat API riwayat peminjaman saya.
15. Membuat API pembatalan reservasi.
16. Membuat API admin sederhana.
17. Testing API menggunakan Postman/Insomnia.
18. Membuat dokumentasi endpoint API.
19. Membantu integrasi frontend ke backend.
20. Fix bug backend saat integrasi.

#### Prioritas Rakha

```text
1. Database jalan
2. Login jalan
3. API daftar ruangan bisa diakses frontend
4. API reservasi berhasil menyimpan data
5. Conflict Engine bisa menolak jadwal bentrok
6. API pembatalan reservasi berjalan
7. Admin bisa mengelola data minimal
```

#### Output Wajib Rakha

1. Backend bisa dijalankan.
2. Database tersedia.
3. API login berhasil dites.
4. API ruangan berhasil dites.
5. API reservasi berhasil dites.
6. Conflict Engine berhasil dites.
7. Dokumentasi API tersedia di `docs/API_DOCUMENTATION.md`.

---

### 4.2 Naufal Khalish  
**Role Utama: Frontend/UI Lead**

Naufal bertanggung jawab pada tampilan utama aplikasi dan pengalaman pengguna.

#### Jobdesk Naufal

1. Setup project frontend.
2. Membuat layout login.
3. Membuat layout dashboard.
4. Membuat komponen card/list ruangan.
5. Membuat indikator status ruangan:
   - hijau untuk tersedia
   - merah untuk terisi
   - abu-abu untuk non-aktif.
6. Membuat halaman detail jadwal ruangan.
7. Membuat form reservasi.
8. Membuat halaman "Peminjaman Saya".
9. Membuat tombol batalkan reservasi.
10. Membuat halaman admin sederhana jika waktu cukup.
11. Membuat tampilan responsive agar nyaman dibuka lewat laptop dan HP.
12. Menampilkan pesan error dari backend.
13. Menampilkan pesan sukses setelah reservasi.
14. Menampilkan loading state saat request API.

#### Prioritas Naufal

```text
1. UI login selesai
2. UI dashboard ruangan selesai
3. UI detail ruangan selesai
4. UI form reservasi selesai
5. UI riwayat peminjaman selesai
6. UI admin sederhana selesai jika sempat
```

#### Output Wajib Naufal

1. Halaman login bisa dibuka.
2. Dashboard ruangan tampil rapi.
3. Form reservasi tersedia.
4. Riwayat peminjaman tersedia.
5. Tampilan minimal responsive.
6. UI siap dihubungkan ke API backend.

---

### 4.3 Rizki Adhitiya Maulana  
**Role Utama: Fullstack Support + Integrasi + Testing + Dokumentasi**

Rizki menjadi penghubung antara backend dan frontend. Tugasnya bukan hanya dokumentasi, tetapi juga membantu integrasi dan testing agar project cepat selesai.

#### Jobdesk Rizki

1. Membantu consume API dari frontend.
2. Menghubungkan halaman login frontend ke API login backend.
3. Menghubungkan dashboard frontend ke API daftar ruangan.
4. Menghubungkan form reservasi ke API reservasi.
5. Menghubungkan halaman riwayat ke API peminjaman saya.
6. Menghubungkan tombol batalkan ke API cancel reservation.
7. Testing fitur dari sisi user.
8. Testing fitur dari sisi admin.
9. Mencatat bug dan membagikannya ke tim.
10. Membantu membuat data dummy ruangan dan jadwal.
11. Membantu dokumentasi penggunaan aplikasi.
12. Membantu README project.
13. Membantu dokumentasi testing.
14. Membantu deploy jika diperlukan.
15. Membantu finalisasi screenshot dan demo.

#### Prioritas Rizki

```text
1. Integrasi login frontend-backend
2. Integrasi dashboard ruangan
3. Integrasi form reservasi
4. Testing Conflict Engine
5. Testing pembatalan reservasi
6. Dokumentasi dan demo final
```

#### Output Wajib Rizki

1. Frontend berhasil consume API.
2. Alur user berhasil dites.
3. Bug list tersedia.
4. Dokumentasi testing tersedia.
5. README dan screenshot demo siap.

---

## 5. Struktur Project

Struktur repository yang disarankan:

```text
smart-class-booking/
├── backend/
├── frontend/
├── docs/
│   ├── API_DOCUMENTATION.md
│   ├── DATABASE_DESIGN.md
│   ├── TESTING_CHECKLIST.md
│   └── DAILY_PROGRESS.md
├── README.md
└── .gitignore
```

Pembagian folder:

```text
backend/  → dikerjakan utama oleh Rakha
frontend/ → dikerjakan utama oleh Naufal
docs/     → dikerjakan bersama, dipimpin oleh Rizki
```

---

## 6. Workflow Git

Gunakan branch utama:

```text
main
develop
```

Fungsi branch:

```text
main    = versi final stabil
develop = tempat gabungan semua fitur sebelum masuk main
```

Setiap fitur dibuat di branch masing-masing.

### Contoh Branch Backend

```text
backend/setup
backend/auth
backend/rooms
backend/reservations
backend/conflict-engine
backend/admin
```

### Contoh Branch Frontend

```text
frontend/setup
frontend/login-page
frontend/dashboard
frontend/room-detail
frontend/reservation-form
frontend/my-reservations
frontend/admin-page
```

### Contoh Branch Integrasi dan Dokumentasi

```text
integration/api-connect
integration/final-testing
docs/readme
docs/final-report
```

---

## 7. Aturan Git Harian

Sebelum mulai kerja:

```bash
git checkout develop
git pull origin develop
git checkout -b nama-branch
```

Setelah selesai mengerjakan fitur:

```bash
git status
git add .
git commit -m "feat: deskripsi fitur"
git push origin nama-branch
```

Lalu buat Pull Request ke:

```text
develop
```

Jika sudah stabil di akhir project, merge:

```text
develop → main
```

---

## 8. Format Commit

Gunakan format commit yang rapi:

```text
feat: menambah fitur baru
fix: memperbaiki bug
docs: menambah/mengubah dokumentasi
style: memperbaiki tampilan tanpa mengubah logic
refactor: merapikan kode tanpa mengubah fitur
chore: setup project, konfigurasi, dependency
test: menambah atau memperbaiki testing
```

Contoh:

```bash
git commit -m "feat: add login API"
git commit -m "feat: add room dashboard page"
git commit -m "fix: prevent double booking reservation"
git commit -m "docs: add API documentation"
```

---

## 9. Roadmap 7 Hari

### Day 1 — Setup Project dan Fondasi

#### Rakha

1. Setup backend.
2. Setup database.
3. Membuat struktur folder backend.
4. Membuat tabel awal:
   - users
   - rooms
   - reservations.
5. Membuat seed akun user, admin, dan ruangan.

#### Naufal

1. Setup frontend.
2. Membuat layout login.
3. Membuat layout dashboard.
4. Membuat komponen card/list ruangan dengan dummy data.

#### Rizki

1. Clone repo dan setup local environment.
2. Membantu data dummy.
3. Membuat file dokumentasi awal:
   - `docs/API_DOCUMENTATION.md`
   - `docs/TESTING_CHECKLIST.md`
   - `docs/DAILY_PROGRESS.md`.
4. Membantu memastikan backend dan frontend bisa dijalankan.

#### Output Day 1

```text
- Backend bisa jalan
- Frontend bisa jalan
- Database sudah tersedia
- Data dummy ruangan tersedia
- Struktur repo sudah rapi
```

---

### Day 2 — Login dan Dashboard

#### Rakha

1. Membuat API login menggunakan NIM/NIDN dan password.
2. Membuat API logout.
3. Membuat API profile.
4. Membuat API daftar ruangan.
5. Testing API auth dan rooms dengan Postman.

#### Naufal

1. Menyelesaikan halaman login.
2. Menyelesaikan dashboard daftar ruangan.
3. Menambahkan indikator status ruangan.
4. Menyiapkan tampilan profile singkat user.

#### Rizki

1. Menghubungkan frontend login ke API backend.
2. Menghubungkan dashboard ke API daftar ruangan.
3. Testing login berhasil.
4. Testing login gagal.
5. Update dokumentasi API auth.

#### Output Day 2

```text
- Login dari UI bisa masuk dashboard
- Login gagal menampilkan error
- Dashboard menampilkan data ruangan dari database
```

---

### Day 3 — Detail Ruangan dan Reservasi

#### Rakha

1. Membuat API detail ruangan.
2. Membuat API jadwal ruangan.
3. Membuat API create reservation.
4. Membuat logic awal status ruangan.

#### Naufal

1. Membuat halaman detail ruangan.
2. Membuat tampilan jadwal/timeline sederhana.
3. Membuat form reservasi.
4. Membuat tombol pesan ruangan.

#### Rizki

1. Integrasi halaman detail ruangan ke API.
2. Integrasi form reservasi ke API.
3. Testing reservasi berhasil.
4. Update dokumentasi API reservasi.

#### Output Day 3

```text
- User bisa melihat detail ruangan
- User bisa mengisi form reservasi
- Reservasi berhasil masuk database
```

---

### Day 4 — Conflict Engine

#### Rakha

1. Membuat validasi overlap jadwal.
2. Menolak reservasi jika waktu bentrok.
3. Mengizinkan reservasi jika waktu kosong.
4. Mengirim response error yang jelas.
5. Testing conflict engine di Postman.

#### Naufal

1. Menampilkan pesan sukses saat reservasi berhasil.
2. Menampilkan pesan error saat jadwal bentrok.
3. Menampilkan status terbaru ruangan setelah reservasi.

#### Rizki

1. Testing booking ruang kosong.
2. Testing booking ruang yang sama di jam yang bentrok.
3. Testing booking ruang yang sama di jam berbeda.
4. Testing booking ruangan berbeda di jam sama.
5. Mencatat bug hasil testing.

#### Output Day 4

```text
- Conflict Engine berjalan
- Jadwal bentrok ditolak
- Jadwal kosong berhasil dipesan
- Sistem bisa mencegah double booking
```

---

### Day 5 — Riwayat dan Pembatalan Reservasi

#### Rakha

1. Membuat API `my reservations`.
2. Membuat API cancel reservation.
3. Membuat update status setelah reservasi dibatalkan.
4. Menjaga agar user hanya bisa membatalkan reservasinya sendiri.

#### Naufal

1. Membuat halaman "Peminjaman Saya".
2. Menampilkan kode booking.
3. Menampilkan nama ruangan.
4. Menampilkan tanggal dan jam.
5. Membuat tombol batalkan reservasi.

#### Rizki

1. Integrasi halaman riwayat ke API.
2. Integrasi tombol batalkan ke API.
3. Testing pembatalan reservasi.
4. Testing slot kembali tersedia setelah reservasi dibatalkan.

#### Output Day 5

```text
- User bisa melihat reservasinya sendiri
- User bisa membatalkan reservasi
- Slot ruangan kembali tersedia setelah dibatalkan
```

---

### Day 6 — Admin Sederhana dan Bug Fixing

#### Rakha

1. Membuat API admin get all rooms.
2. Membuat API admin create room.
3. Membuat API admin update room.
4. Membuat API admin delete room.
5. Membuat API admin get all reservations.
6. Membuat API admin cancel reservation.

#### Naufal

1. Membuat halaman admin sederhana.
2. Membuat tabel data ruangan.
3. Membuat form tambah/edit ruangan.
4. Membuat tabel semua reservasi.
5. Membuat tombol batal reservasi untuk admin.

#### Rizki

1. Testing fitur admin.
2. Testing role user dan admin.
3. Mencatat bug.
4. Membantu dokumentasi.
5. Membantu deploy jika diperlukan.

#### Output Day 6

```text
- Admin bisa melihat data ruangan
- Admin bisa menambah/mengubah/menghapus ruangan
- Admin bisa melihat semua reservasi
- Admin bisa membatalkan reservasi
```

---

### Day 7 — Finalisasi dan Demo

#### Semua Anggota

1. Testing alur penuh.
2. Fix bug kecil.
3. Rapikan UI.
4. Rapikan README.
5. Rapikan dokumentasi API.
6. Rapikan dokumentasi database.
7. Siapkan screenshot aplikasi.
8. Siapkan video demo jika diperlukan.
9. Merge final ke `main`.

#### Output Day 7

```text
- Aplikasi siap demo
- Alur utama berjalan
- Dokumentasi selesai
- Repository rapi
- Versi final ada di branch main
```

---

## 10. Database Minimal

### Tabel `users`

```text
id
name
identity_number
password
role
created_at
updated_at
```

Keterangan:

```text
identity_number = NIM/NIDN
role = user/admin
```

---

### Tabel `rooms`

```text
id
name
building
capacity
facilities
status
created_at
updated_at
```

Keterangan status:

```text
available
occupied
inactive
```

---

### Tabel `reservations`

```text
id
booking_code
user_id
room_id
title
purpose
reservation_date
start_time
end_time
status
created_at
updated_at
```

Keterangan status:

```text
active
cancelled
finished
```

---

## 11. API Minimal

### Auth

```http
POST /api/login
POST /api/logout
GET /api/profile
```

### Rooms

```http
GET /api/rooms
GET /api/rooms/:id
GET /api/rooms/:id/schedules
```

### Reservations

```http
GET /api/my-reservations
POST /api/reservations
PUT /api/reservations/:id/cancel
```

### Admin

```http
GET /api/admin/rooms
POST /api/admin/rooms
PUT /api/admin/rooms/:id
DELETE /api/admin/rooms/:id

GET /api/admin/reservations
PUT /api/admin/reservations/:id/cancel
```

---

## 12. Logic Conflict Engine

Conflict Engine digunakan untuk mencegah jadwal bentrok.

Reservasi dianggap bentrok jika:

```text
room_id sama
reservation_date sama
status active
start_time baru < end_time reservasi lama
end_time baru > start_time reservasi lama
```

Contoh logic:

```text
Jika user ingin booking Ruang A pada 10:00 - 12:00,
maka sistem harus menolak jika sudah ada reservasi aktif:
09:00 - 11:00
10:00 - 12:00
11:00 - 13:00

Sistem boleh menerima jika jadwal:
08:00 - 09:30
12:00 - 14:00
```

Response jika berhasil:

```json
{
  "success": true,
  "message": "Reservasi berhasil dibuat"
}
```

Response jika bentrok:

```json
{
  "success": false,
  "message": "Ruangan sudah terisi pada waktu tersebut"
}
```

---

## 13. Definition of Done

### Backend dianggap selesai jika:

1. API berhasil dites di Postman.
2. Data masuk database.
3. Response sukses dan error jelas.
4. Conflict Engine berjalan.
5. Dokumentasi API diperbarui.
6. Tidak ada error fatal saat integrasi.

### Frontend dianggap selesai jika:

1. Halaman bisa dibuka.
2. Data dari API tampil.
3. Form bisa mengirim data ke backend.
4. Error dari backend tampil ke user.
5. Tampilan cukup rapi dan responsive.

### Integrasi dianggap selesai jika:

1. Login dari UI berhasil.
2. Dashboard mengambil data dari database.
3. Reservasi dari UI masuk database.
4. Booking bentrok ditolak.
5. Riwayat peminjaman tampil.
6. Pembatalan reservasi berjalan.
7. Admin bisa melihat data.

---

## 14. Checklist Testing

### Auth

- [ ] Login dengan akun valid berhasil.
- [ ] Login dengan akun salah gagal.
- [ ] Logout berhasil.
- [ ] User tidak bisa masuk dashboard tanpa login.

### Dashboard

- [ ] Daftar ruangan tampil.
- [ ] Status ruangan tampil.
- [ ] Warna hijau untuk tersedia.
- [ ] Warna merah untuk terisi.
- [ ] Detail ruangan bisa dibuka.

### Reservasi

- [ ] User bisa membuat reservasi.
- [ ] Reservasi masuk database.
- [ ] Booking jadwal kosong berhasil.
- [ ] Booking jadwal bentrok ditolak.
- [ ] Response error tampil di frontend.

### Riwayat

- [ ] User bisa melihat reservasinya sendiri.
- [ ] User tidak melihat reservasi milik orang lain.
- [ ] Kode booking tampil.
- [ ] Detail tanggal dan jam tampil.

### Pembatalan

- [ ] User bisa membatalkan reservasinya sendiri.
- [ ] Status reservasi berubah menjadi cancelled.
- [ ] Slot ruangan kembali tersedia.
- [ ] User tidak bisa membatalkan reservasi orang lain.

### Admin

- [ ] Admin bisa melihat semua ruangan.
- [ ] Admin bisa menambah ruangan.
- [ ] Admin bisa mengubah ruangan.
- [ ] Admin bisa menghapus ruangan.
- [ ] Admin bisa melihat semua reservasi.
- [ ] Admin bisa membatalkan reservasi user.

---

## 15. Alur Demo Final

Alur demo yang harus aman:

```text
1. Login sebagai user.
2. Masuk ke dashboard.
3. Lihat daftar ruangan.
4. Pilih ruangan tersedia.
5. Buka detail jadwal ruangan.
6. Isi form reservasi.
7. Reservasi berhasil.
8. Buka halaman Peminjaman Saya.
9. Coba booking ruangan yang sama di jam bentrok.
10. Sistem menolak reservasi.
11. Batalkan reservasi.
12. Slot ruangan kembali tersedia.
13. Login sebagai admin.
14. Admin melihat semua ruangan dan reservasi.
15. Admin menambah/mengubah data ruangan.
16. Admin membatalkan reservasi jika diperlukan.
```

---

## 16. Aturan Kerja Tim

1. Jangan menunggu semua fitur selesai baru integrasi.
2. Frontend boleh pakai dummy data dulu.
3. Backend wajib test API pakai Postman sebelum diberikan ke frontend.
4. Integrasi harus mulai maksimal Day 3 atau Day 4.
5. Setiap anggota wajib push progress setiap hari.
6. Setiap fitur harus punya owner.
7. Setiap bug harus dicatat.
8. Jangan tambah fitur baru sebelum MVP selesai.
9. Jika ada fitur terlalu sulit, sederhanakan.
10. Target utama adalah aplikasi bisa demo, bukan fitur terlalu banyak.

---

## 17. Daily Standup

Setiap hari, tim wajib membahas:

```text
1. Kemarin mengerjakan apa?
2. Hari ini akan mengerjakan apa?
3. Apa kendalanya?
4. Fitur apa yang sudah bisa dites?
5. Apakah sudah push ke GitHub?
6. Apakah ada conflict Git?
7. Apakah ada API yang berubah?
```

---

## 18. Risiko dan Solusi

### Risiko 1: Backend dan frontend tidak nyambung

Solusi:

```text
- Buat dokumentasi API sejak Day 1
- Gunakan Postman untuk test API
- Frontend boleh pakai dummy data dulu
- Integrasi dimulai maksimal Day 3/4
```

### Risiko 2: Conflict Engine sulit

Solusi:

```text
- Gunakan validasi overlap sederhana
- Fokus hanya pada room_id, tanggal, start_time, end_time, status active
- Jangan dulu membuat kalender kompleks
```

### Risiko 3: Admin terlalu banyak fitur

Solusi:

```text
- Admin cukup CRUD ruangan dan lihat reservasi
- Input jadwal semesteran dibuat sederhana atau ditunda
```

### Risiko 4: Waktu habis untuk UI

Solusi:

```text
- Pakai template sederhana
- Fokus fungsi dulu
- Responsive secukupnya
```

### Risiko 5: Git conflict

Solusi:

```text
- Pisahkan folder backend dan frontend
- Pull develop sebelum mulai kerja
- Jangan edit file yang bukan bagian tugas
- Merge lewat Pull Request
```

---

## 19. Kesimpulan Pembagian Cepat

```text
Rakha:
Backend, database, API, conflict engine, dokumentasi API.

Naufal:
Frontend UI, dashboard, form reservasi, halaman riwayat, responsive design.

Rizki:
Integrasi API, testing, admin sederhana, dokumentasi, deploy, bug fixing.
```

Target utama:

```text
Login → Dashboard Ruangan → Detail Jadwal → Reservasi → Conflict Engine → Riwayat → Pembatalan → Admin Monitoring
```

Jika alur tersebut sudah berjalan, maka MVP Smart Class Booking sudah layak untuk demo.
