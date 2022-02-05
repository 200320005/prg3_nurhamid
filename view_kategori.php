<h1 class="mt-4">Input Kategori</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Input Kategori</li>
</ol>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Table Kategori
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
            + Tambah Kategori
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $no = 1;
                    while ($tampil = mysqli_fetch_array($kategori)) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $tampil['nama']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>