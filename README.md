# Food Order System
### Nama: Samuel Steve Mulyono
### NRP: 5025231197

Sebuah aplikasi berbentuk Api untuk sebuah restoran yang menggunakan qrcode di meja makan untuk order menunya.
## Tech Stack:
### 1. Framework dan Bahasa Pemrograman: Laravel dan PHP
Alasan saya memilih Laravel karena cocok untuk sebuah bisnis dengan skala yang kecil. Selain itu Laravel memiliki banyak fitur yang dapat mempermudah pekerjaan backend dev seperti dengan fitur-fitur databasenya seperti migration,seeding, dan juga ORM untuk modelling tabel menjadi sebuah kelas, Laravel juga dapat berguna untuk frontend dev nantinya dengan fitur blade view.
### 2. Database: MySQL
Alasan saya memilih MySQL karena pada kasus order makanan ini dibutuhkan ACIDity yang cukup tinggi, sehingga diperlukan Relational Database. Secara spesifik menggunakan MySQL karena query-query yang dilakukan masih cukup sederhana, dan tidak membutuhkan fitur-fitur yang berlebihan, sehingga menggunakan MySQL yang tergolong simple sudah cukup dan tidak perlu overkill menggunakan PostgreSQL yang memiliki overhead yang tinggi.

## Fitur-fitur:
-Membuat order (customer) \
-Melihat menu berdasarkan kategori,kepopuleran,dan rating (customer) \
-CRUD menu (owner) \
-CRUD order (cashier) \
-CR transaction (cashier) (belum) \
-CRUD transaction (owner,supervisor) (belum) \
-Membuat review makanan yang dipesan (customer) (belum)