<?php
// Include configuration file
require_once 'config.php';

// Sanitize and validate input
$keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
$category = isset($_POST['category']) ? $_POST['category'] : '';

// Prepare SQL query with proper escaping
if(empty($keyword)) {
    $query = "SELECT * FROM konfirmasipengambilan ORDER BY tanggal_konfirmasi DESC";
} else {
    // Validate category to prevent SQL injection
    $allowed_categories = ['id_pengajuan', 'status', 'keterangan_penolakan', 'id_admin'];
    if(in_array($category, $allowed_categories)) {
        $keyword = mysqli_real_escape_string($conn, $keyword);
        $query = "SELECT * FROM konfirmasipengambilan WHERE $category LIKE '%$keyword%' ORDER BY tanggal_konfirmasi DESC";
    } else {
        $query = "SELECT * FROM konfirmasipengambilan ORDER BY tanggal_konfirmasi DESC";
    }
}

// Execute query
$result = mysqli_query($conn, $query);

// Check if query was successful
if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SILADES | Konfirmasi Pengajuan</title>
    
    <!-- Local Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Local Bootstrap Icons -->
    <link rel="stylesheet" href="assets/css/bootstrap-icons.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #6366f1;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
            --dark-color: #1f2937;
            --light-color: #f9fafb;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            color: #374151;
        }
        
        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .content-header {
            margin-bottom: 2rem;
        }
        
        .content-header h3 {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
        
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
        }
        
        .content-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border: 1px solid #e5e7eb;
        }
        
        .card-header-custom {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f3f4f6;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .btn-custom {
            padding: 0.625rem 1.25rem;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(79, 70, 229, 0.3);
            color: white;
        }
        
        .search-form {
            display: flex;
            gap: 0.75rem;
            align-items: end;
            flex-wrap: wrap;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
        }
        
        .form-group label {
            font-weight: 500;
            margin-bottom: 0.25rem;
            color: var(--dark-color);
            font-size: 0.875rem;
        }
        
        .form-control {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 0.5rem 0.75rem;
            transition: border-color 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
        
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table-custom {
            margin-bottom: 0;
        }
        
        .table-custom thead th {
            background: var(--light-color);
            font-weight: 600;
            color: var(--dark-color);
            border: none;
            padding: 1rem;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .table-custom tbody td {
            padding: 1rem;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
        }
        
        .table-custom tbody tr:hover {
            background: var(--light-color);
        }
        
        .badge-custom {
            padding: 0.375rem 0.75rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.75rem;
        }
        
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        
        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.75rem;
            border-radius: 6px;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #6b7280;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <div class="content-header">
            <h3><i class="bi bi-file-earmark-check me-2"></i>Konfirmasi Pengajuan</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Konfirmasi Pengajuan</li>
                </ol>
            </nav>
        </div>

        <div class="content-card">
            <div class="card-header-custom">
                <div class="d-flex align-items-center gap-2">
                    <h5 class="mb-0"><i class="bi bi-table me-2"></i>Data Konfirmasi Pengajuan</h5>
                </div>
                
                <div class="d-flex gap-2 flex-wrap">
                    <!-- Search Form -->
                    <form method="POST" class="search-form">
                        <div class="form-group">
                            <label for="category">Kategori</label>
                            <select name="category" id="category" class="form-control" style="min-width: 150px;">
                                <option value="id_pengajuan" <?= (isset($_POST['category']) && $_POST['category'] == 'id_pengajuan') ? 'selected' : '' ?>>ID Pengajuan</option>
                                <option value="status" <?= (isset($_POST['category']) && $_POST['category'] == 'status') ? 'selected' : '' ?>>Status</option>
                                <option value="keterangan_penolakan" <?= (isset($_POST['category']) && $_POST['category'] == 'keterangan_penolakan') ? 'selected' : '' ?>>Keterangan</option>
                                <option value="id_admin" <?= (isset($_POST['category']) && $_POST['category'] == 'id_admin') ? 'selected' : '' ?>>ID Admin</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="keyword">Cari</label>
                            <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Masukkan kata kunci..." value="<?= htmlspecialchars($keyword) ?>" style="min-width: 200px;">
                        </div>
                        
                        <button type="submit" class="btn btn-primary-custom">
                            <i class="bi bi-search"></i>
                            Cari
                        </button>
                        
                        <?php if(!empty($keyword)): ?>
                        <a href="konfirmasi.php" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i>
                            Reset
                        </a>
                        <?php endif; ?>
                    </form>
                    
                    <a href="tambah_konfirmasi.php" class="btn btn-primary-custom">
                        <i class="bi bi-plus-circle"></i>
                        Tambah Konfirmasi
                    </a>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-custom"><?
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Pengajuan</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Batas Waktu</th>
                            <th>Tanggal Konfirmasi</th>
                            <th>Admin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $n = 0;
                        if(mysqli_num_rows($result) > 0) {
                            while ($d = mysqli_fetch_assoc($result)) {
                                $n++;
                                
                                // Status mapping
                                switch ($d['status']) {
                                    case 1: 
                                        $status = '<span class="badge bg-success badge-custom">Diterima</span>'; 
                                        break;
                                    case 2: 
                                        $status = '<span class="badge bg-danger badge-custom">Ditolak</span>'; 
                                        break;
                                    case 3: 
                                        $status = '<span class="badge bg-warning badge-custom text-dark">Proses</span>'; 
                                        break;
                                    default: 
                                        $status = '<span class="badge bg-secondary badge-custom">-</span>'; 
                                        break;
                                }
                                
                                // Format dates
                                $tanggal_konfirmasi = !empty($d['tanggal_konfirmasi']) ? 
                                    date('d M Y', strtotime($d['tanggal_konfirmasi'])) : '-';
                                $batas_waktu = !empty($d['batas_waktu']) ? 
                                    date('d M Y', strtotime($d['batas_waktu'])) : '-';
                                
                                // Truncate long text
                                $keterangan = !empty($d['keterangan_penolakan']) ? 
                                    (strlen($d['keterangan_penolakan']) > 50 ? 
                                        substr($d['keterangan_penolakan'], 0, 50) . '...' : 
                                        $d['keterangan_penolakan']) : '-';
                                
                                echo "
                                <tr>
                                    <td class='fw-semibold'>$n</td>
                                    <td>
                                        <div class='d-flex align-items-center'>
                                            <div class='stat-icon primary me-2' style='width: 30px; height: 30px; font-size: 0.75rem; background: var(--primary-color);'>
                                                <i class='bi bi-file-earmark-text'></i>
                                            </div>
                                            <div>
                                                <div class='fw-semibold'>" . htmlspecialchars($d['id_pengajuan']) . "</div>
                                                <small class='text-muted'>ID: " . htmlspecialchars($d['id']) . "</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$status</td>
                                    <td>
                                        <span data-bs-toggle='tooltip' title='" . htmlspecialchars($d['keterangan_penolakan'] ?? '') . "'>
                                            " . htmlspecialchars($keterangan) . "
                                        </span>
                                    </td>
                                    <td>
                                        <div class='d-flex align-items-center'>
                                            <i class='bi bi-calendar-event me-2 text-muted'></i>
                                            <span>$batas_waktu</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='d-flex align-items-center'>
                                            <i class='bi bi-clock me-2 text-muted'></i>
                                            <span>$tanggal_konfirmasi</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='d-flex align-items-center'>
                                            <div class='user-avatar me-2' style='width: 25px; height: 25px; font-size: 0.7rem; background: var(--info-color);'>
                                                A
                                            </div>
                                            <span>" . htmlspecialchars($d['id_admin']) . "</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='action-buttons'>
                                            <a href='detail_konfirmasi.php?id=" . $d['id'] . "' class='btn btn-sm btn-outline-primary' data-bs-toggle='tooltip' title='Lihat Detail'>
                                                <i class='bi bi-eye'></i>
                                            </a>
                                            <a href='edit_konfirmasi.php?id=" . $d['id'] . "' class='btn btn-sm btn-outline-warning' data-bs-toggle='tooltip' title='Edit'>
                                                <i class='bi bi-pencil'></i>
                                            </a>
                                            <a href='hapus_konfirmasi.php?id=" . $d['id'] . "' class='btn btn-sm btn-outline-danger' 
                                               onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")' 
                                               data-bs-toggle='tooltip' title='Hapus'>
                                                <i class='bi bi-trash'></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "
                            <tr>
                                <td colspan='8' class='text-center'>
                                    <div class='empty-state'>
                                        <i class='bi bi-inbox'></i>
                                        <h6>Belum Ada Data</h6>
                                        <p class='mb-0'>Belum ada data konfirmasi pengajuan.</p>
                                    </div>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <?php if(mysqli_num_rows($result) > 0): ?>
            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                <small class="text-muted">
                    Menampilkan <?= mysqli_num_rows($result) ?> data konfirmasi pengajuan
                    <?php if(!empty($keyword)): ?>
                        dengan kata kunci "<strong><?= htmlspecialchars($keyword) ?></strong>"
                    <?php endif; ?>
                </small>
                
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-download me-1"></i>
                        Export
                    </button>
                    <button class="btn btn-sm btn-outline-success">
                        <i class="bi bi-printer me-1"></i>
                        Print
                    </button>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Auto-submit search form on category change
        document.getElementById('category').addEventListener('change', function() {
            if(document.getElementById('keyword').value) {
                this.form.submit();
            }
        });
        
        // Highlight search results
        const keyword = '<?= addslashes($keyword) ?>';
        if(keyword) {
            const cells = document.querySelectorAll('table tbody td');
            cells.forEach(cell => {
                if(cell.textContent.toLowerCase().includes(keyword.toLowerCase())) {
                    cell.innerHTML = cell.innerHTML.replace(
                        new RegExp(`(${keyword})`, 'gi'),
                        '<mark style="background: #fff3cd; padding: 1px 2px;">$1</mark>'
                    );
                }
            });
        }
    </script>
</body>
</html>


                    