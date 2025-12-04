<?php
include '../config.php';
$keyword=$_POST['keyword'];
$category=$_POST['category'];
if(empty($keyword)) {
    $query = "SELECT * FROM konfirmasipengambilan";
} else {
    $query = "SELECT * FROM konfirmasipengambilan WHERE $category LIKE '%$keyword%'";
}
?>

<main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <!--begin::Col-->
              <div class="col-sm-6"><h3 class="mb-0">Data konfirmasipengambilan</h3></div>
              <!--end::Col-->
              <!--begin::Col-->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Data konfirmasipengambilan</li>
                </ol>
              </div>
              <!--end::Col-->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <!--begin::Col-->
              <div class="col-12">
                <!--begin::Card-->
                <div class="card">
                  <!--begin::Card Header-->
                <a href="a" class="btn btn-primary" style="width: 150px;">Tambah konfirmasi</a><br>
                <table class="table table-striped table-hover table-bordered">
                <
                  <!--end::Card Header-->
                  <!--begin::Card Body-->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                            <th>Id konfirmasi</th>
                            <th>Id pengajuan</th>
                            <th>Status</th>
                            <th>Keterangan penolakan</th>
                            <th>Batas waktu</th>
                            <th>Tanggal konfirmasi</th>
                            <th>Id admin</th>
                            <th>Aksi</th>
                        </tr>
                      </thead>
                        <tbody>

                          <?php
                            $n = 0;
                            while ($d = $data->fetch_assoc()) {
                              $n++;

                              switch ($d['status']) {
                                case 1: $status = 'Diterima'; break;
                                case 2: $status = 'Ditolak'; break;
                                case 3: $status = 'Proses'; break;
                                default: $status = '-'; break;

                            }
                            echo "
                            <table class='table table-bordered table-hover table-striped'>
                            <tr><td>Id_pengajuan</td><td>: <input type='number' value='$d[idpengajuan]' name='idpengajuan></td></tr>
                            <tr><td>Ket_penolakan</td><td>: <input type='text' value='$d[keterangan]' name='keterangan></td></tr>
                            <tr><td>Status</td><td>: 
                            <input type='radio' name='101' value='1' ".($d['status'] == 1 ? 'checked' : '')."> Diterima
                            <input type='radio' name='102' value='2' ".($d['status'] == 2 ? 'checked' : '')."> Ditolak
                            <input type='radio' name='103' value='3' ".($d['status'] == 3 ? 'checked' : '')."> Proses
                            </td></tr>
                            
                            <td>$status</td>
                            <td>{$d['id_admin']}</td>
                            <td>{$d['bataswaktu']}</td>
                          <td>
                            <a href='detail_konfirmasi.php?id={$d['id']}' class='btn btn-sm btn-info'>Detail</a>
                            <a href='edit_konfirmasi.php?id={$d['id']}' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='hapus_konfirmasi.php?id={$d['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Yakin hapus data ini?\")'>Hapus</a>
                          </td>
                        </tr>";
                    }

                      if ($n == 0) {
                        echo "<tr><td colspan='8' class='text-center text-muted'>Belum ada data konfirmasi.</td></tr>";
                    }
                    ?>
                  </tbody>
                  </table>
                  </div>
                </body>
              </html>

                    </div>
                    <!--end::Card Body-->
                </div>
                <!--end::Card-->
                </div>
                <!--end::Col-->
              </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
                    