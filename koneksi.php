<?php
$host = "db"; 
$user = "root";
$pass = "rahasia";
$db   = "db_kuliah";

try {
    $koneksi = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Koneksi ke Database MySQL Sukses!<br>"; <-- BARIS INI WAJIB DIHAPUS ATAU DIKOMENTAR
} catch(PDOException $e) {
    echo "Koneksi Gagal: " . $e->getMessage();
}
?>
