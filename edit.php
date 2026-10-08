<?php
include 'koneksi.php';

$id = $_GET['id'] ?? '';

try {
    $stmt = $koneksi->prepare("SELECT * FROM mahasiswa WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $mhs = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$mhs) {
        die("Data mahasiswa tidak ditemukan.");
    }
} catch (PDOException $e) {
    echo "Eror: " . $e->getMessage();
}
?>

<h3>Edit Data Mahasiswa</h3>
<form action="aksi.php?act=edit" method="POST">
    <input type="hidden" name="id" value="<?= $mhs['id'] ?>">
    
    <label>NIM:</label><br>
    <input type="text" name="nim" value="<?= $mhs['nim'] ?>" required><br><br>
    
    <label>Nama:</label><br>
    <input type="text" name="nama" value="<?= $mhs['nama'] ?>" required><br><br>
    
    <label>Jurusan:</label><br>
    <input type="text" name="jurusan" value="<?= $mhs['jurusan'] ?>" required><br><br>
    
    <label>Angkatan:</label><br>
    <input type="number" name="angkatan" value="<?= $mhs['angkatan'] ?>" required><br><br>
    
    <button type="submit">Simpan Perubahan</button>
    <a href="index.php">Batal</a>
</form>
