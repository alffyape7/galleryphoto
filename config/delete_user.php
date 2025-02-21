<?php
session_start(); // Memulai session untuk memeriksa login

// Pastikan pengguna sudah login
if (!isset($_SESSION['username'])) {
    echo "<script> 
        alert('Anda belum login!');
        location.href='login.php'; // Redirect ke login jika belum login
    </script>";
    exit();
}

include '../config/koneksi.php'; // Menyambung ke database

// Periksa apakah ada request untuk menghapus data
if (isset($_POST['delete'])) {
    $userid = $_POST['userid']; // Ambil ID pengguna yang akan dihapus
    
    // Query untuk menghapus data pengguna berdasarkan ID
    $query = "DELETE FROM user WHERE userid=?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $userid); // Bind parameter dengan tipe integer
    
    // Eksekusi query untuk menghapus data
    if ($stmt->execute()) {
        // Jika berhasil, beri pesan dan redirect ke halaman daftar pengguna
        echo "<script>
            alert('Data pengguna berhasil dihapus!');
            location.href='../admin/user.php';
        </script>";
    } else {
        // Jika gagal, beri pesan error
        echo "<script>
            alert('Gagal menghapus data pengguna. Silakan coba lagi.');
            location.href='../admin/user.php';
        </script>";
    }
}
?>
