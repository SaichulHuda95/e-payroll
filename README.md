Assalamualaikum wr.wb
Saya telah selesai membuat aplikasi payroll untuk memudahkan perhitungan gaji karyawan. Saya menggunakan framework codeigniter 4 untuk membuat aplikasi tersebut.
Saya juga menggunakan database mysql untuk penyimpanan datanya. Berikut cara untuk mengimplementasikan aplikasi payroll ke laptop/pc anda:
- Buat database dengan nama e-payroll
- Import database yang ada ada di source project yang namanya e-payroll.sql
- Copy folder project ke htdoc
- Masuk ke folder app/Config/App.php
  Ubah port di $base_url sesuai port web service anda(karena saya menggunakan 8888 maka $base_url saya : http://localhost:8888/e-payroll, apabila anda menggunakan xampp dan port default maka ubah dengan: http://localhost:/e-payroll)
- Masuk ke folder app/Config/Database.php
  Cari public $default dan sesuaikan username, password, port dengan database anda
- Apabila sudah selesai semua tinggal jalankan aplikasi di browser anda

Untuk flowchart aplikasi bisa dilihat di dokumentasi Flowchart E-payroll.docx pada project
User admin:
username: admin
password: admin
User staff:
username: user
password: admin
User supervisor:
username: joni
password: admin
