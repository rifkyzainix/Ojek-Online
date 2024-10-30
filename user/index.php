<?php
session_start();
include 'fungsi.php';

if (isset($_POST['submit'])) {
    $user = $_POST['idu'];
    $driver = $_POST['idd'];
    $lokasi = $_POST['locat'];
    $tujuan = $_POST['tujuan'];
    $harga = 15000;

    // Tentukan kolom dan nilai yang akan dimasukkan
    $columns = "id_transaksi, id_user, id_driver, lokasi, tujuan, harga, status";
    $nilai = "'', '$user', '$driver', '$lokasi', '$tujuan', '$harga', 'order'";

    // Panggil fungsi tambah dengan semua argumen yang diperlukan
    if (tambah('transaksi', $columns, $nilai) == 1) {
        echo "<script>
            alert('Order Berhasil');
            document.location.href = 'order.php?id=$user';
            </script>";
    } else {
        echo "<script>
            alert('Order Gagal');
            document.location.href = 'index.php';
            </script>";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gojol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);">
    <nav class="navbar bg-light ">
        <div class="container-fluid col-md-11">
            <a class="navbar-brand"><b>GOJOL</b></a>
            <div class="d-flex justify-content-end" role="search">
                <a href="riwayat.php" class="btn btn-light">
                    Riwayat
                </a>
                <a href="#" class="btn btn-light">
                    <?= $_SESSION['username']; ?>
                </a>
                <a href="logout.php" class="btn btn-light">
                    Logout
                </a>
            </div>
        </div>
    </nav>
    <div class="d-flex justify-content-center">
        <div class="card col-md-8" style="padding: 50px; margin-top: 100px;">
            <form method="post">
                <h1 style="text-align: center;">Form Order</h1><br>
                <input type="hidden" value="<?= $_SESSION['id_user'] ?>" name="idu">
                <input type="text" class="form-control" placeholder="Masukan Lokasi Anda" name="locat" required><br>
                <input type="text" class="form-control" placeholder="Masukan Tujuan Anda" name="tujuan" required><br>
                <select id="driver" class="form-control" name="idd" required>
                    <option value="" selected disabled>Select Driver</option>
                    <?php
                    $data = tampil('driver');
                    while ($d = mysqli_fetch_array($data)) {
                        ?>
                    <option value="<?= $d['id_driver'] ?>"><?= $d['nm_driver'] ?></option>
                    <?php } ?>
                </select><br>
                <button type="submit" class="btn btn-success" name="submit" value="submit">Order</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>