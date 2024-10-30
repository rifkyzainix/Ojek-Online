<?php
require 'header.php';
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php require 'nav.php'; ?>

        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Table Transaksi</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DataTables Transaksi</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No User</th>
                                    <th>No Driver</th>
                                    <th>Titik Awal</th>
                                    <th>Tujuan</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        // Memanggil data dari tabel transaksi
                        $data = view("transaksi", null, null);
                        if (mysqli_num_rows($data) > 0) {
                           $i = 1;
                           while ($row = mysqli_fetch_assoc($data)): ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= htmlspecialchars($row['id_user']) ?></td>
                                    <td><?= htmlspecialchars($row['id_driver']) ?></td>
                                    <td><?= htmlspecialchars($row['titik']) ?></td>
                                    <td><?= htmlspecialchars($row['tujuan']) ?></td>
                                    <td><?= htmlspecialchars($row['harga']) ?></td>
                                    <td>
                                        <a href="transaksi_hapus.php?id=<?= htmlspecialchars($row['id_tran']) ?>"
                                            class="btn btn-danger btn-circle btn-md"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile;
                        } else {
                           echo "<tr><td colspan='7' class='text-center'>Data transaksi tidak ditemukan.</td></tr>";
                        }
                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <?php require 'footer.php'; ?>