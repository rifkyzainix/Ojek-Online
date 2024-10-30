<?php
$koneksi = mysqli_connect("localhost", "root", "", "gojol");

function view($table, $id, $field)
{
   global $koneksi;
   if ($id == null) {
      $sql = "SELECT * FROM $table";
   } else {
      $sql = "SELECT * FROM $table WHERE $field = $id";
   }
   return mysqli_query($koneksi, $sql);
}

function tambah($table, $data)
{
   global $koneksi;

   switch ($table) {
      case 'user':
         $nm = $data['nama'];
         $alamat = $data['alamat'];
         $pass = $data['password'];
         $sql = "INSERT INTO $table (nm_user, alamat, password) VALUES ('$nm', '$alamat', '$pass')";
         break;

      case 'driver':
         $nm_driver = $data['nm_driver'];
         $plat = $data['plat_motor'];
         $gambar = gambar();

         if (!$gambar) {
            return false;
         }

         // Pastikan id_driver memiliki relasi yang valid
         $sql = "INSERT INTO $table (nm_driver, plat_motor, photo) VALUES ('$nm_driver', '$plat', '$gambar')";
         break;

      default:
         return false;
   }

   $cek = mysqli_query($koneksi, $sql);
   return mysqli_affected_rows($koneksi);
}

function hapus($table, $id)
{
   global $koneksi;

   switch ($table) {
      case 'user':
         $sql = "DELETE FROM $table WHERE id_user = $id";
         break;
      case 'driver':
         $sql = "DELETE FROM $table WHERE id_driver = $id";
         break;
      case 'transaksi':
         $sql = "DELETE FROM $table WHERE id_tran = $id";
         break;
      default:
         return false;
   }

   mysqli_query($koneksi, $sql);
   return mysqli_affected_rows($koneksi);
}

function update($table, $data, $id)
{
   global $koneksi;

   switch ($table) {
      case 'user':
         $nm = $data['nama'];
         $alamat = $data['alamat'];
         $pass = $data['password'];
         $sql = "UPDATE $table SET nm_user = '$nm', alamat = '$alamat', password = '$pass' WHERE id_user = $id";
         break;

      case 'driver':
         $nm_driver = $data['nama'];
         $plat = $data['plat'];
         $gambarLama = $data['old_pict'];
         $cek = $_FILES['file']['error'];
         $gambar = ($cek === 4) ? $gambarLama : gambar();
         $sql = "UPDATE $table SET nm_driver = '$nm_driver', plat_motor = '$plat', photo = '$gambar' WHERE id_driver = $id";
         break;

      default:
         return false;
   }

   mysqli_query($koneksi, $sql);
   return mysqli_affected_rows($koneksi);
}

function gambar()
{
   $name = $_FILES['file']['name'];
   $tmp = $_FILES['file']['tmp_name'];
   $size = $_FILES['file']['size'];
   $error = $_FILES['file']['error'];

   if ($error === 4) {
      echo "<script>alert('Upload profile dulu');</script>";
      return false;
   }

   $extValid = ['jpeg', 'jpg', 'png'];
   $extGambar = strtolower(pathinfo($name, PATHINFO_EXTENSION));

   if (!in_array($extGambar, $extValid)) {
      echo "<script>alert('File yang anda upload bukan gambar');</script>";
      return false;
   }

   if ($size > 1000000) {
      echo "<script>alert('File yang anda upload terlalu besar');</script>";
      return false;
   }

   $nameFileBaru = uniqid() . '.' . $extGambar;
   move_uploaded_file($tmp, 'img/driver/' . $nameFileBaru);

   return $nameFileBaru;
}