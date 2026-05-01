# 📚 Peminjaman Buku Sederhana (Laravel API)


## 🚀 Fitur
* CRUD Buku (API)
* Peminjaman Buku
* Return otomatis berdasarkan tanggal
* Role: Admin & Anggota
* Password akunnya adalah : 123


## 🛠️ Teknologi
* Laravel 12
* MySQL
* Thunder Client (Testing API)


## 🗄️ Database
Database sudah disediakan dalam project ini.
📂 Lokasi file: database/pinjam_buku.sql


### Cara import database:
1. Buka phpMyAdmin
2. Buat database baru dengan nama: pinjam_buku
3. Import file: database/pinjam_buku.sql


## 📌 Endpoint API
* GET /api/books
* GET /api/books/{code}
* POST /api/books
* PUT /api/books/{code}
* DELETE /api/books/{code}


## 🧪 Testing API
Gunakan Thunder Client / Postman:

## 🧪 Testing API

GET http://localhost:8000/api/books <br>
GET http://localhost:8000/api/books/AB12345 <br><br>

POST http://localhost:8000/api/books/ZZ99999 <br>
CONTOH : { "kode": "ZZ99999", "judul": "tes api", "tahun_terbit": 2024, "penulis": "Pak Guru", "stok_buku": 10 } <br><br>

PUT http://localhost:8000/api/books/ZZ99999 <br>
CONTOH : { "kode": "ZZ99999", "judul": "UPDATE tes", "tahun_terbit": 2000, "penulis": "Bu Guru", "stok_buku": 20 } <br><br>

DELETE http://localhost:8000/api/books/ZZ99999
