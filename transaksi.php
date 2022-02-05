<?php
include('koneksi.php');

$query_view = mysqli_query($connect, "SELECT t.*, b.nama as barang, p.nama_pelanggan as pelanggan FROM tb_transaksi t JOIN tb_barang b ON t.id_barang=b.id_barang JOIN tb_pelanggan p ON t.id_pelanggan=p.id_pelanggan");

$data_barang = mysqli_query($connect, "SELECT * FROM tb_barang");
$data_pelanggan = mysqli_query($connect, "SELECT * FROM tb_pelanggan");

if (isset($_POST['save'])) {
    $nama_transaksi = $_POST['nama_transaksi'];
    $date = $_POST['date'];
    $harga = $_POST['harga'];
    $qty = $_POST['qty'];
    $barang = $_POST['barang'];
    $nama_pelanggan = $_POST['nama_pelanggan'];


    $status = mysqli_query($connect, "SELECT * FROM tb_pelanggan WHERE id_pelanggan='" . $nama_pelanggan . "'");
    $diskon = mysqli_fetch_array($status);
    $nilaiDiskon = '';
    if ($diskon['status'] == 'member') {
        $nilaiDiskon = '5%';
    }

    $sql = mysqli_query($connect, "INSERT INTO tb_transaksi VALUES(null,'" . $nama_transaksi . "', '" . $date . "','" . $harga . "','" . $qty . "','" . $barang . "','" . $nilaiDiskon . "','" . $nama_pelanggan . "')");

    if ($sql) {
        header('location:transaksi.php');
    } else {
        echo "<script>alert('data gagal disimpan!')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php
$judul = 'Transaksi';
require('header.php') ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php require('sidebar.php') ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php require('topbar.php') ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">transaksi</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-12">
                            <div class="card shadow mb-4 p-4">
                                <button type="button" class="mb-4 btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                                    + Tambah transaksi
                                </button>

                                <div class="table-responsive">
                                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                                    <thead>
                                                        <tr role="row">
                                                            <th>No</th>
                                                            <th>Nama Transaksi</th>
                                                            <th>Tanggal</th>
                                                            <th>Barang</th>
                                                            <th>Diskon</th>
                                                            <th>Pelanggan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        while ($tampil = mysqli_fetch_array($query_view)) { ?>
                                                            <tr>
                                                                <td><?php echo $no++; ?></td>
                                                                <td><?php echo $tampil['nama_transaksi']; ?></td>
                                                                <td><?php echo $tampil['tgl_transaksi']; ?></td>
                                                                <td><?php echo $tampil['barang']; ?></td>
                                                                <td><?php echo $tampil['diskon']; ?>%</td>
                                                                <td><?php echo $tampil['pelanggan']; ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah transaksi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Nama Transaksi</label>
                                    <input name="nama_transaksi" type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input" required>
                                </div>
                                <div class="form-group">
                                    <label for="date">Tanggal Transaksi</label>
                                    <input name="date" type="date" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input name="harga" type="number" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="qty">Qty</label>
                                    <input name="qty" type="number" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="barang">Barang</label>
                                    <select name="barang" id="barang" class="form-control" required>
                                        <option value="">Choose...</option>
                                        <?php while ($tampil = mysqli_fetch_array($data_barang)) { ?>
                                            <option value="<?= $tampil['id_barang'] ?>"><?= $tampil['nama'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pelanggan">Pelanggan</label>
                                    <select name="nama_pelanggan" id="pelanggan" class="form-control" required>
                                        <option value="">Choose...</option>
                                        <?php while ($tampil = mysqli_fetch_array($data_pelanggan)) { ?>
                                            <option value="<?= $tampil['id_pelanggan'] ?>"><?= $tampil['nama_pelanggan'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <input name="save" type="submit" class="btn btn-primary">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>