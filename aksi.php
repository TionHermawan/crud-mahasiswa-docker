<?php
include 'koneksi.php';

$act = $_GET['act'] ?? '';

if ($act == 'tambah') {
    try {
        $stmt = $koneksi->prepare("INSERT INTO mahasiswa (nim, nama, jurusan, angkatan) VALUES (:nim, :nama, :jurusan, :angkatan)");
        $stmt->execute([
            ':nim' => $_POST['nim'],
            ':nama' => $_POST['nama'],
            ':jurusan' => $_POST['jurusan'],
            ':angkatan' => $_POST['angkatan']
        ]);
        header("Location: index.php");
    } catch (PDOException $e) {
        echo "Gagal Tambah Data: " . $e->getMessage();
    }

} elseif ($act == 'edit') {
    try {
        $stmt = $koneksi->prepare("UPDATE mahasiswa SET nim = :nim, nama = :nama, jurusan = :jurusan, angkatan = :angkatan WHERE id = :id");
        $stmt->execute([
            ':id' => $_POST['id'],
            ':nim' => $_POST['nim'],
            ':nama' => $_POST['nama'],
            ':jurusan' => $_POST['jurusan'],
            ':angkatan' => $_POST['angkatan']
        ]);
        header("Location: index.php");
    } catch (PDOException $e) {
        echo "Gagal Edit Data: " . $e->getMessage();
    }

} elseif ($act == 'hapus') {
    try {
        $stmt = $koneksi->prepare("DELETE FROM mahasiswa WHERE id = :id");
        $stmt->execute([':id' => $_GET['id']]);
        header("Location: index.php");
    } catch (PDOException $e) {
        echo "Gagal Hapus Data: " . $e->getMessage();
    }
}
?>
