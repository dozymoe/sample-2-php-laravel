------------
Demo Sample3
------------

Cara pakai
----------

1. buat file .env dengan menyalin dari file .env.example
2. jalankan :code:`make`, butuh instalasi GNU/make di sistem OS
3. pertama kali menjalankan :code:`make` akan gagal, karena perlu database seed,
   jalankan :code:`make artisan args='db:seed'`
4. jalankan :code:`make` kedua kalinya
5. website bisa diakses di http://127.0.0.1:8080


Daftar user yang bisa dipakai untuk login
-----------------------------------------

* admin@demo.com
* seller@demo.com
* user@demo.com

Password-nya semua adalah 'pass'.


User Interface
--------------

* ada page "Purchase History" jika login sebagai user@demo.com
* ada page "Sales" jika login sebagai seller@demo.com
