<?php 

// memulai session
session_start();

// memanggil koneksi
include "include/koneksi.php";


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <link rel="shortcut icon" href="assets/images/logo laundry skema.png" type="image/png"/>
    <title>Login Berbaju Laundry</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
</head>
<style>
    /* Tampilan background Login */
    .accountbg {
        background-image: url('assets/images/bglogin.jpg'); 
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>

<body class="fixed-left">
    <div class="container">
        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group float-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#">Laundry</a></li>
                                    <li class="breadcrumb-item active">Data Transaksi Laundry</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Data Transaksi Laundry</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <a href="login.php" class="btn btn-danger float-right mb-4">Back</a >
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ID</th>
                                                <th>Pelanggan</th>
                                                <th>Jenis Layanan</th>
                                                <th>Tgl. Terima</th>
                                                <th>Tgl. Selesai</th>
                                                <th>Status</th>
                                                <th>Status Baju</th>
                                                <th>Total Bayar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            // menampilkan data transaksi laundry
                                            $query = "SELECT * FROM tb_laundry INNER JOIN tb_pelanggan ON tb_laundry.pelangganid = tb_pelanggan.pelangganid INNER JOIN tb_users ON tb_users.userid = tb_laundry.userid INNER JOIN tb_jenis ON tb_jenis.kd_jenis = tb_laundry.kd_jenis ORDER BY tb_laundry.id_laundry DESC";
                                            $result = mysqli_query($conn, $query); ?>
                                            <?php $i = 1; ?>
                                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $row['id_laundry']; ?></td>
                                                    <td><?= $row['pelanggannama']; ?></td>
                                                    <td><?= $row['jenis_laundry']; ?></td>
                                                    <td><?= $row['tgl_terima']; ?></td>
                                                    <td><?= $row['tgl_selesai']; ?></td>
                                                    <!-- jika status 1 berarti lunas, jika 0 belum lunas -->
                                                    <td><?= ($row['status_pembayaran'] == 1) ? '<span class="badge badge-success">Lunas</span>' : '<span class="badge badge-danger">Belum lunas</span>'; ?></td>
                                                    <td>
                                                        <!-- jika status_pengembalian 0 berarti belum diambil -->
                                                        <?php if($row['status_pengambilan'] == 0) { ?>
                                                            <a href="?page=laundry&aksi=diambil&id=<?= $row['id_laundry']; ?>" class="btn btn-warning <?= ($row['status_pembayaran'] == 0) ? 'disabled' : ''; ?>" onclick="return confirm('Apakah anda yakin Baju sudah diambil?');">Belum Diambil</a>
                                                        
                                                        <!-- jika 1 sudah diambil -->
                                                        <?php }elseif($row['status_pengambilan'] == 1){ ?>
                                                            <a href="#" class="btn btn-warning disabled">Sudah diambil</a>
                                                        <?php } ?>

                                                    </td>
                                                    <td>Rp. <?= number_format($row['totalbayar']); ?></td>
                                                    <td>
                                                        <!-- jika status pembayaran = 1 -->
                                                        <?php if($row['status_pembayaran'] == 1) { ?>
                                                            

                                                            <a href="page/cetak_transaksi.php?id=<?= $row['id_laundry']; ?>" class="btn btn-success"><i class="fa fa-download"> Cetak</i></a>

                                                        <!-- jika status pembayaran = 0 -->
                                                        <?php }elseif($row['status_pembayaran'] == 0){ ?>

                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
                <!-- end page title end breadcrumb -->
            </div>
            <!-- container -->
        </div>
    </div>


    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.nicescroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>

    <!-- Datatables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>

</body>
</html>