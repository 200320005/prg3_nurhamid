<?php
include('koneksi.php');

$query_view = mysqli_query($conn, "SELECT * FROM tb_pelanggan");

if (isset($_POST['save'])) {
    $nama = $_POST['nama'];
    $status = $_POST['status'];
    $no_telp = $_POST['no_tlp'];

    $query_insert = "INSERT INTO tb_pelanggan VALUES(null, '$nama', '$no_telp', '$status')";
    $sql = mysqli_query($conn, $query_insert);
    if ($sql) {
        header('location:input_pelanggan.php');
    } else {
        echo "<script>alert('data gagal disimpan!')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = 'Input pelanggan';
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
                    <?php require('view_pelanggan.php'); ?>
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
                            <h5 class="modal-title" id="exampleModalLabel">Tambah pelanggan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Nama pelanggan</label>
                                    <input name="nama" type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input" required>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">No Telp</label>
                                    <input name="no_tlp" type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input" required>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="">Choose...</option>
                                        <option value="member">Member</option>
                                        <option value="non">None</option>
                                    </select>
                                </div>
                                <input name="save" type="submit" value="Simpan" class="btn btn-primary">
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