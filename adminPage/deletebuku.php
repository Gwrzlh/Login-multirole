<?php
include '../config.php';

// Mengaktifkan Exception mode pada mysqli
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $id = $_GET['id'];

    // Delete Product
    $sql = "DELETE FROM buku WHERE id = $id";
    mysqli_query($conn, $sql);

    // Jika berhasil, redirect ke listuser.php
    header('Location: admin.php');
} catch (mysqli_sql_exception $e) {
    // Jika gagal karena foreign key constraint
    if (strpos($e->getMessage(), 'foreign key constraint') !== false) {
        echo "<script>
            alert('User sudah digunakan di tabel lain dan tidak bisa dihapus!');
            window.location.href = 'listkategori.php';
        </script>";
    } else {
        // Jika error lain, tampilkan pesan error default
        echo "<script>
            alert('Error deleting record: " . $e->getMessage() . "');
            window.location.href = 'listuser.php';
        </script>";
    }
}
?>