<?php
session_start();
include '../config/koneksi.php';

if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda belum login!'); 
    location.href='../index.php';
    </script>";
    exit();
}

if (isset($_POST['komentarid'])) {
    $komentarid = $_POST['komentarid'];
    
    $deleteComment = mysqli_query($koneksi, "DELETE FROM komentarfoto WHERE komentarid='$komentarid'");
    
    if ($deleteComment) {
        echo "<script>
        alert('Komentar berhasil dihapus.');
        location.href='../user/home.php'; // Redirect back to the appropriate page
        </script>";
    } else {
        echo "<script>
        alert('Gagal menghapus komentar. Silakan coba lagi.');
        location.href='../user/home.php'; // Redirect back to the appropriate page
        </script>";
    }
} else {
    echo "<script>
    alert('Tidak ada komentar yang dipilih untuk dihapus.');
    location.href='../user/home.php'; // Redirect back to the appropriate page
    </script>";
}
?>
