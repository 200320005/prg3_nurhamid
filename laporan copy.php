<?php
include('koneksi.php');

$query_view = mysqli_query($conn, "SELECT p.nama_pelanggan, p.status, k.nama as kategori, b.nama, t.qty, t.harga, t.diskon 
FROM tb_transaksi t JOIN tb_barang b ON t.id_barang=b.id_barang 
JOIN tb_pelanggan p ON t.id_pelanggan=p.id_pelanggan
JOIN tb_kategori k ON b.kategori_id=k.id_kategori");
?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = 'Laporan';
require('header.php');
?>

<body class="sb-nav-fixed">
    <?php require('navbar.php') ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php require('sidebar.php') ?>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Laporan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Laporan</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Table Laporan
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Status</th>
                                            <th>Kategori</th>
                                            <th>Barang</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Diskon</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Status</th>
                                            <th>Kategori</th>
                                            <th>Barang</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Diskon</th>
                                            <th>Total</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        while ($tampil = mysqli_fetch_array($query_view)) { ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $tampil['nama_pelanggan']; ?></td>
                                                <td><?php echo $tampil['status']; ?></td>
                                                <td><?php echo $tampil['kategori']; ?></td>
                                                <td><?php echo $tampil['nama']; ?></td>
                                                <td><?php echo $tampil['qty']; ?></td>
                                                <td><?php echo $tampil['harga']; ?></td>
                                                <td><?php echo $tampil['diskon']; ?>%</td>
                                                <?php $total = ($tampil['diskon'] / 100) * ($tampil['harga'] * $tampil['qty']) ?>
                                                <td><?php echo $tampil['harga'] * $tampil['qty'] - $total ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2020</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>

</html>