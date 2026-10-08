<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - IT Semester 5</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://jsdelivr.net" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Header Card -->
            <div class="card shadow-sm border-0 mb-4 bg-dark text-white">
                <div class="card-body p-4 text-center">
                    <h1 class="h3 mb-1">🚀 Sistem Data Mahasiswa</h1>
                    <p class="mb-0 text-muted-white">Environment Modern PHP & MySQL via Docker Compose</p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Form Input -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-3 fw-bold text-secondary">Tambah Mahasiswa</h5>
                            <form action="aksi.php?act=tambah" method="POST">
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">NIM</label>
                                    <input type="text" name="nim" class="form-control form-control-sm" placeholder="Contoh: 240004" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control form-control-sm" placeholder="Nama Lengkap" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Jurusan</label>
                                    <input type="text" name="jurusan" class="form-control form-control-sm" placeholder="Contoh: Teknik Informatika" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Angkatan</label>
                                    <input type="number" name="angkatan" class="form-control form-control-sm" placeholder="Contoh: 2024" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm w-100 shadow-sm fw-bold">Simpan Data</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Tabel Data -->
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-3 fw-bold text-secondary">Daftar Mahasiswa Aktif</h5>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped align-middle">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Jurusan</th>
                                            <th class="text-center">Angkatan</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        try {
                                            $query = $koneksi->query("SELECT * FROM mahasiswa ORDER BY id DESC");
                                            $mahasiswa = $query->fetchAll(PDO::FETCH_ASSOC);

                                            if (count($mahasiswa) > 0) {
                                                foreach ($mahasiswa as $mhs) {
                                                    echo "<tr>";
                                                    echo "<td class='fw-bold text-primary'>" . htmlspecialchars($mhs['nim']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($mhs['nama']) . "</td>";
                                                    echo "<td><span class='badge bg-light text-dark border'>" . htmlspecialchars($mhs['jurusan']) . "</span></td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($mhs['angkatan']) . "</td>";
                                                    echo "<td class='text-center'>
                                                            <a href='edit.php?id=" . $mhs['id'] . "' class='btn btn-warning btn-xs px-2 py-1 small fw-bold me-1 text-white style-btn'>Edit</a> 
                                                            <a href='aksi.php?act=hapus&id=" . $mhs['id'] . "' class='btn btn-danger btn-xs px-2 py-1 small fw-bold style-btn' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>
                                                          </td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='5' class='text-center text-muted py-3'>Belum ada data mahasiswa. Silakan tambah data di form sebelah kiri.</td></tr>";
                                            }
                                        } catch (PDOException $e) {
                                            echo "<tr><td colspan='5' class='text-center text-danger'>Gagal mengambil data: " . $e->getMessage() . "</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3 text-end">
                                <a href='migrate.php' class="btn btn-outline-secondary btn-sm" onclick='return confirm("Perhatian: Jalankan ulang migration akan mereset data sampel!")'>🔄 Run Migration</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .btn-xs { font-size: 0.75rem; padding: 0.25rem 0.5rem; }
    .style-btn { text-decoration: none; display: inline-block; border-radius: 4px; }
</style>

<script src="https://jsdelivr.net"></script>
</body>
</html>
