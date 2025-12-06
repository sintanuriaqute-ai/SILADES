<?php
// DENGAN jalur relatif yang benar ke folder induk
require_once '../config.php';

// Query untuk mengambil data dari tabel 'warga'
$sql = "SELECT id, NIK, nama, tempat_lahir, tanggal_lahir, gender, agama, status_perkawinan FROM warga";

// PASTIKAN menggunakan $koneksi (huruf kecil)
$conn = new mysqli($host, $user, $pass, $db);

// Check if query was successful
if (!$conn) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Warga (Bootstrap)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* CSS tambahan opsional */
        .container {
            margin-top: 30px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="text-center mb-4 text-primary">Data warga Desa SILADES</h2>

        <div class="card shadow">
            <div class="card-body">
                <a href="#" class="btn btn-success mb-3">
                    <i class="fas fa-plus"></i> Tambah Data Warga 
                </a>

                <?php
                // Cek apakah ada baris data yang ditemukan
                if ($conn->connect_error) {
                    echo "<div class='table-responsive'>";
                    echo "<table class='table table-striped table-hover table-bordered'>";
                    echo "<thead class='table-dark'><tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama Lengkap</th>
                            <th>Tempat Lahir</th>
                            <th>Tgl Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Status Kawin</th>
                            <th>Aksi</th>
                          </tr></thead>";
                    echo "<tbody>";

                    $no = 1; 
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . htmlspecialchars($row['NIK']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tempat_lahir']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tanggal_lahir']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['agama']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status_perkawinan']) . "</td>";
                        // Kolom Aksi dengan tombol Bootstrap
                        echo "<td>
                        <input type='radio' name='Ahmad fauzi' value='L' $vAhmad_fauzi_L> Laki-laki
                        <input type='radio' name='Nur fadilah' value='P' $vNur_fadilah_P> Perempuan
                                <a href='edit_warga.php?id=" . $row['id'] . "' class='btn btn-sm btn-warning me-2'>Edit</a>
                                <a href='hapus_warga.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>
                              </td>";
                        echo "</tr>";
                    }

                    echo "</tbody>";
                    echo "</table>";
                    echo "</div>";
                } else {
                    // Tampilkan pesan jika tidak ada data
                    echo "<div class='alert alert-info' role='alert'>
                            <p class='mb-0'>Tidak ada data warga yang ditemukan.</p>
                          </div>";
                }

                // Tutup koneksi
                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
</body>
</html>