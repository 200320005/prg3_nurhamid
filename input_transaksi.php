<?php
include('koneksi.php');

$query_view = mysqli_query($conn, "SELECT t.*, b.nama as barang, p.nama_pelanggan as pelanggan FROM tb_transaksi t JOIN tb_barang b ON t.id_barang=b.id_barang JOIN tb_pelanggan p ON t.id_pelanggan=p.id_pelanggan");

$data_barang = mysqli_query($conn, "SELECT * FROM tb_barang");
$data_pelanggan = mysqli_query($conn, "SELECT * FROM tb_pelanggan");

if (isset($_POST['save'])) {
    $nama_transaksi = $_POST['nama_transaksi'];
    $date = $_POST['date'];
    $harga = $_POST['harga'];
    $qty = $_POST['qty'];
    $barang = $_POST['barang'];
    $nama_pelanggan = $_POST['nama_pelanggan'];

    $status = mysqli_query($conn, "SELECT * FROM tb_pelanggan WHERE id_pelanggan='" . $nama_pelanggan . "'");
    $diskon = mysqli_fetch_array($status);
    $nilaiDiskon = '';
    if ($diskon['status'] == 'member') {
        $nilaiDiskon = '5%';
    }

    $sql = mysqli_query($conn, "INSERT INTO tb_transaksi VALUES(null,'" . $nama_transaksi . "', '" . $date . "','" . $harga . "','" . $qty . "','" . $barang . "','" . $nilaiDiskon . "','" . $nama_pelanggan . "')");

    if ($sql) {
        header('location:input_transaksi.php');
    } else {
        echo "<script>alert('data gagal disimpan!')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = 'Input Transaksi';
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
                    <?php require('view_transaksi.php')  ?>
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
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi Baru</h5>
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