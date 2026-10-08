<?php
include 'koneksi.php';

try {
    echo "<h2>--- Memulai Proses Migration ---</h2>";

    // 1. QUERY BIKIN TABEL (MIGRATION)
    $sql_migration = "CREATE TABLE IF NOT EXISTS mahasiswa (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nim VARCHAR(15) NOT NULL UNIQUE,
        nama VARCHAR(100) NOT NULL,
        jurusan VARCHAR(50) NOT NULL,
        angkatan INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB;";

    $koneksi->exec($sql_migration);
    echo "✅ Tabel 'mahasiswa' berhasil dibuat atau sudah ada.<br>";

    // 2. QUERY ISI DATA SAMPEL (SEEDER)
    // Kita cek dulu biar datanya gak double setiap kali script ini dijalankan
    $cek_data = $koneksi->query("SELECT COUNT(*) FROM mahasiswa")->fetchColumn();

    if ($cek_data == 0) {
        $sql_seeder = "INSERT INTO mahasiswa (nim, nama, jurusan, angkatan) VALUES 
            ('240001', 'Erlangga Putra', 'Teknik Informatika', 2024),
            ('240002', 'Siti Rahma', 'Sistem Informasi', 2024),
            ('240003', 'Budi Santoso', 'Teknik Informatika', 2024);";
        
        $koneksi->exec($sql_seeder);
        echo "✅ Data sampel mahasiswa (Seeder) berhasil dimasukkan.<br>";
    } else {
        echo "ℹ️ Data seeder dilewati karena tabel sudah berisi data.<br>";
    }

    echo "<h3>🚀 Migration & Seeding Selesai!</h3>";
    echo "<a href='index.php'>Kembali ke Beranda</a>";

} catch (PDOException $e) {
    echo "❌ Terjadi Eror Saat Migration: " . $e->getMessage();
}
?>
