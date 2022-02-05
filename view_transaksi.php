<h1 class="mt-4">Input Transaksi</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Input Transaksi</li>
</ol>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Table Transaksi
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
            + Tambah Transaksi
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Transaksi</th>
                        <th>Tanggal</th>
                        <th>Barang</th>
                        <th>Diskon</th>
                        <th>Pelanggan</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Transaksi</th>
                        <th>Tanggal</th>
                        <th>Barang</th>
                        <th>Diskon</th>
                        <th>Pelanggan</th>
                    </tr>
                </tfoot>
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