<h1 class="mt-4">Input Pelanggan</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Input Pelanggan</li>
</ol>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        DataTable Example
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
            + Tambah Pelanggan
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>No Telp</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>No Telp</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $no = 1;
                    while ($tampil = mysqli_fetch_array($query_view)) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $tampil['nama_pelanggan']; ?></td>
                            <td><?php echo $tampil['no_tlp']; ?></td>
                            <td><?php echo $tampil['status']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>