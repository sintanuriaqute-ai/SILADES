<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SILADES | Dashboard</title>
    <meta name="description" content="Sistem Informasi Layanan Administrasi Desa - Dashboard Admin">
    <meta name="author" content="SILADES Team">
    
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
            --sidebar-width: 260px;
            --header-height: 70px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            color: #374151;
            overflow-x: hidden;
        }
        
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
        }
        
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }
        
        .sidebar-brand {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-brand h4 {
            color: white;
            font-weight: 700;
            font-size: 1.5rem;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .sidebar-brand p {
            color: rgba(255,255,255,0.8);
            font-size: 0.75rem;
            margin: 0.25rem 0 0 0;
        }
        
        .sidebar-menu {
            padding: 1rem 0;
        }
        
        .menu-header {
            padding: 0.75rem 1.5rem;
            color: rgba(255,255,255,0.6);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 1rem;
        }
        
        .menu-item {
            list-style: none;
        }
        
        .menu-link {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.5rem;
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .menu-link:hover, .menu-link.active {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left-color: white;
        }
        
        .menu-link i {
            font-size: 1.2rem;
            margin-right: 0.875rem;
            width: 24px;
            text-align: center;
        }
        
        /* Header Styles */
        .header {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--header-height);
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            transition: all 0.3s ease;
        }
        
        .header-title h5 {
            font-weight: 600;
            color: var(--dark-color);
            margin: 0;
        }
        
        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .header-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--light-color);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .header-btn:hover {
            background: var(--primary-color);
            color: white;
        }
        
        .header-btn .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--danger-color);
            color: white;
            font-size: 0.65rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            background: var(--light-color);
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .user-profile:hover {
            background: var(--primary-color);
            color: white;
        }
        
        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
        
        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            padding: 2rem;
            min-height: calc(100vh - var(--header-height));
            transition: all 0.3s ease;
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
        
        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .stat-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }
        
        .stat-icon.primary { background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); }
        .stat-icon.success { background: linear-gradient(135deg, #10b981, #059669); }
        .stat-icon.warning { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .stat-icon.danger { background: linear-gradient(135deg, #ef4444, #dc2626); }
        
        .stat-info h6 {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        .stat-info h2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin: 0;
        }
        
        .stat-trend {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.75rem;
            font-size: 0.875rem;
        }
        
        .trend-up { color: var(--success-color); }
        .trend-down { color: var(--danger-color); }
        
        /* Content Cards */
        .content-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
            border: 1px solid #e5e7eb;
        }
        
        .card-header-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f3f4f6;
        }
        
        .card-header-custom h5 {
            font-weight: 600;
            color: var(--dark-color);
            margin: 0;
        }
        
        .btn-custom {
            padding: 0.5rem 1.25rem;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(79, 70, 229, 0.3);
        }
        
        /* Table Styles */
        .table-custom {
            width: 100%;
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
        
        /* Footer */
        .footer {
            margin-left: var(--sidebar-width);
            background: white;
            padding: 1.5rem 2rem;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .header, .main-content, .footer {
                margin-left: 0;
                left: 0;
            }
            
            .mobile-toggle {
                display: block !important;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
        
        .mobile-toggle {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h4><i class="bi bi-building"></i> SILADES</h4>
            <p>Sistem Layanan Desa</p>
        </div>
        
        <ul class="sidebar-menu">
            <li class="menu-header">MENU UTAMA</li>
            
            <li class="menu-item">
                <a href="index.php" class="menu-link active">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="menu-item">
                <a href="?page=konfirmasipengajuan" class="menu-link">
                    <i class="bi bi-file-earmark-check"></i>
                    <span>Konfirmasi Pengajuan</span>
                </a>
            </li>
            
            <li class="menu-item">
                <a href="?page=verifikasi" class="menu-link">
                    <i class="bi bi-check-circle"></i>
                    <span>Verifikasi</span>
                </a>
            </li>
            
            <li class="menu-header">DATA PENGGUNA</li>
            
            <li class="menu-item">
                <a href="?page=dosen" class="menu-link">
                    <i class="bi bi-person-badge"></i>
                    <span>Data Dosen</span>
                </a>
            </li>
            
            <li class="menu-item">
                <a href="?page=mahasiswa" class="menu-link">
                    <i class="bi bi-people"></i>
                    <span>Data Mahasiswa</span>
                </a>
            </li>
            
            <li class="menu-item">
                <a href="?page=alumni" class="menu-link">
                    <i class="bi bi-mortarboard"></i>
                    <span>Data Alumni</span>
                </a>
            </li>
            
            <li class="menu-header">PENGATURAN</li>
            
            <li class="menu-item">
                <a href="?page=profile" class="menu-link">
                    <i class="bi bi-person-circle"></i>
                    <span>Profil</span>
                </a>
            </li>
            
            <li class="menu-item">
                <a href="?page=settings" class="menu-link">
                    <i class="bi bi-gear"></i>
                    <span>Pengaturan</span>
                </a>
            </li>
            
            <li class="menu-item">
                <a href="?page=logout" class="menu-link">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Keluar</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Header -->
    <header class="header">
        <button class="header-btn mobile-toggle" onclick="toggleSidebar()">
            <i class="bi bi-list"></i>
        </button>
        
        <div class="header-title">
            <h5>Dashboard Administrator</h5>
        </div>
        
        <div class="header-actions">
            <button class="header-btn">
                <i class="bi bi-search"></i>
            </button>
            
            <button class="header-btn">
                <i class="bi bi-bell"></i>
                <span class="badge">5</span>
            </button>
            
            <button class="header-btn">
                <i class="bi bi-envelope"></i>
                <span class="badge">3</span>
            </button>
            
            <div class="user-profile dropdown" data-bs-toggle="dropdown">
                <div class="user-avatar">A</div>
                <span class="d-none d-md-inline">Admin</span>
                <i class="bi bi-chevron-down ms-1"></i>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <?php 
        if (file_exists('route.php')) {
            require_once 'route.php';
        }
        ?>
        
        <div class="content-header">
            <h3>Selamat Datang di SILADES</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-info">
                        <h6>Total Pengajuan</h6>
                        <h2>245</h2>
                        <div class="stat-trend trend-up">
                            <i class="bi bi-arrow-up"></i>
                            <span>12% dari bulan lalu</span>
                        </div>
                    </div>
                    <div class="stat-icon primary">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-info">
                        <h6>Menunggu Verifikasi</h6>
                        <h2>48</h2>
                        <div class="stat-trend trend-up">
                            <i class="bi bi-arrow-up"></i>
                            <span>8% dari bulan lalu</span>
                        </div>
                    </div>
                    <div class="stat-icon warning">
                        <i class="bi bi-clock-history"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-info">
                        <h6>Terverifikasi</h6>
                        <h2>197</h2>
                        <div class="stat-trend trend-up">
                            <i class="bi bi-arrow-up"></i>
                            <span>15% dari bulan lalu</span>
                        </div>
                    </div>
                    <div class="stat-icon success">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-info">
                        <h6>Total Pengguna</h6>
                        <h2>1,234</h2>
                        <div class="stat-trend trend-up">
                            <i class="bi bi-arrow-up"></i>
                            <span>5% dari bulan lalu</span>
                        </div>
                    </div>
                    <div class="stat-icon danger">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="content-card">
            <div class="card-header-custom">
                <h5><i class="bi bi-clock-history me-2"></i>Aktivitas Terbaru</h5>
                <button class="btn-custom btn-primary-custom">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Baru
                </button>
            </div>
            
            <div class="table-responsive">
                <table class="table table-custom">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jenis Pengajuan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-2" style="width: 35px; height: 35px; font-size: 0.875rem;">JD</div>
                                    <div>
                                        <div class="fw-semibold">John Doe</div>
                                        <small class="text-muted">john.doe@email.com</small>
                                    </div>
                                </div>
                            </td>
                            <td>Surat Keterangan</td>
                            <td>04 Des 2025</td>
                            <td><span class="badge badge-custom bg-warning text-dark">Pending</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary rounded-pill">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success rounded-pill">
                                    <i class="bi bi-check"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-2" style="width: 35px; height: 35px; font-size: 0.875rem; background: var(--success-color);">JS</div>
                                    <div>
                                        <div class="fw-semibold">Jane Smith</div>
                                        <small class="text-muted">jane.smith@email.com</small>
                                    </div>
                                </div>
                            </td>
                            <td>Surat Domisili</td>
                            <td>03 Des 2025</td>
                            <td><span class="badge badge-custom bg-success">Disetujui</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary rounded-pill">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-info rounded-pill">
                                    <i class="bi bi-download"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-2" style="width: 35px; height: 35px; font-size: 0.875rem; background: var(--danger-color);">RJ</div>
                                    <div>
                                        <div class="fw-semibold">Robert Johnson</div>
                                        <small class="text-muted">robert.j@email.com</small>
                                    </div>
                                </div>
                            </td>
                            <td>Surat Pengantar</td>
                            <td>02 Des 2025</td>
                            <td><span class="badge badge-custom bg-success">Disetujui</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary rounded-pill">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-info rounded-pill">
                                    <i class="bi bi-download"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Additional Info Cards -->
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="content-card">
                    <div class="card-header-custom">
                        <h5><i class="bi bi-pie-chart me-2"></i>Statistik Pengajuan</h5>
                    </div>
                    <div class="p-3">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Surat Keterangan</span>
                                <span class="fw-semibold">65%</span>
                            </div>
                            <div class="progress" style="height: 10px; border-radius: 10px;">
                                <div class="progress-bar" style="width: 65%; background: var(--primary-color);"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Surat Domisili</span>
                                <span class="fw-semibold">25%</span>
                            </div>
                            <div class="progress" style="height: 10px; border-radius: 10px;">
                                <div class="progress-bar" style="width: 25%; background: var(--success-color);"></div>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Surat Pengantar</span>
                                <span class="fw-semibold">10%</span>
                            </div>
                            <div class="progress" style="height: 10px; border-radius: 10px;">
                                <div class="progress-bar" style="width: 10%; background: var(--warning-color);"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="content-card">
                    <div class="card-header-custom">
                        <h5><i class="bi bi-calendar-event me-2"></i>Pengumuman</h5>
                    </div>
                    <div class="p-3">
                        <div class="mb-3 pb-3 border-bottom">
                            <div class="d-flex align-items-start">
                                <div class="stat-icon primary me-3" style="width: 40px; height: 40px; font-size: 1rem;">
                                    <i class="bi bi-megaphone"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Update Sistem</h6>
                                    <p class="text-muted mb-1" style="font-size: 0.875rem;">Sistem akan diperbarui pada tanggal 10 Desember 2025</p>
                                    <small class="text-muted">2 hari yang lalu</small>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 pb-3 border-bottom">
                            <div class="d-flex align-items-start">
                                <div class="stat-icon success me-3" style="width: 40px; height: 40px; font-size: 1rem;">
                                    <i class="bi bi-info-circle"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Layanan Baru</h6>
                                    <p class="text-muted mb-1" style="font-size: 0.875rem;">Layanan pengajuan online telah aktif</p>
                                    <small class="text-muted">5 hari yang lalu</small>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex align-items-start">
                                <div class="stat-icon warning me-3" style="width: 40px; height: 40px; font-size: 1rem;">
                                    <i class="bi bi-exclamation-triangle"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Maintenance</h6>
                                    <p class="text-muted mb-1" style="font-size: 0.875rem;">Maintenance server dijadwalkan minggu depan</p>
                                    <small class="text-muted">1 minggu yang lalu</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p class="mb-0">
            &copy; 2025 <strong>SILADES</strong>. Sistem Informasi Layanan Administrasi Desa. All rights reserved.
        </p>
    </footer>

    <!-- Bootstrap Bundle JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle Sidebar for Mobile
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }
        
        // Active Menu Link
        document.querySelectorAll('.menu-link').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelectorAll('.menu-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const mobileToggle = document.querySelector('.mobile-toggle');
            
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !mobileToggle.contains(event.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });
    </script>
</body>
</html>
