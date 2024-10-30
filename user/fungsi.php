<?php
// Pengaturan koneksi database
$servername = "localhost";
$database = "gojol";
$username = "root";
$password = "";

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $database);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

/**
 * Fungsi untuk menampilkan semua baris dari tabel
 */
function tampil($table)
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM $table");

    if (!$result) {
        die("Query gagal: " . mysqli_error($conn));
    }

    return $result;
}

/**
 * Fungsi untuk menambahkan baris baru ke tabel
 */
function tambah($table, $columns, $values)
{
    global $conn;

    // Menyiapkan pernyataan SQL
    $query = "INSERT INTO $table ($columns) VALUES ($values)";

    // Debugging: Menampilkan query yang akan dieksekusi
    echo "Query: " . $query . "<br>"; // Menampilkan query untuk debugging

    if (!$result) {
        // Jika terjadi kesalahan, tampilkan detail kesalahan
        die("Kesalahan saat menambahkan data: " . mysqli_error($conn) . " (Query: $query)");
    }

    return mysqli_affected_rows($conn);
}

/**
 * Fungsi untuk menghapus baris dari tabel
 */
function hapus($table, $id)
{
    global $conn;
    $query = "DELETE FROM $table WHERE id_tran = $id"; // Ganti id dengan id_tran

    if (!mysqli_query($conn, $query)) {
        die("Kesalahan saat menghapus data: " . mysqli_error($conn));
    }

    return mysqli_affected_rows($conn);
}

/**
 * Fungsi untuk memperbarui baris di tabel
 */
function update($table, $columnsValues, $condition)
{
    global $conn;
    $query = "UPDATE $table SET $columnsValues WHERE $condition";

    if (!mysqli_query($conn, $query)) {
        die("Kesalahan saat memperbarui data: " . mysqli_error($conn));
    }

    return mysqli_affected_rows($conn);
}

// Menutup koneksi database
function closeConnection()
{
    global $conn;
    mysqli_close($conn);
}
?>