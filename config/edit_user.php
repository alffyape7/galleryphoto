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

// Proses jika form disubmit untuk mengedit data pengguna
if (isset($_POST['edit'])) {
    // Ambil data dari form
    $userid = $_POST['userid']; // ID pengguna yang akan diupdate
    $username = $_POST['username'];
    $email = $_POST['email'];
    $namalengkap = $_POST['namalengkap'];
    $alamat = $_POST['alamat'];

    // Validasi input jika diperlukan (untuk keamanan)
    if (empty($username) || empty($email) || empty($namalengkap) || empty($alamat)) {
        echo "<script>
            alert('Semua field harus diisi!');
            location.href='user.php'; // Kembali ke halaman daftar pengguna
        </script>";
        exit();
    }

    // Update data pengguna
    $query = "UPDATE user SET username=?, email=?, namalengkap=?, alamat=? WHERE userid=?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ssssi", $username, $email, $namalengkap, $alamat, $userid);

    if ($stmt->execute()) {
        // Jika berhasil update, redirect ke halaman user.php
        echo "<script>
            alert('Data pengguna berhasil diperbarui!');
            location.href='../admin/user.php';
        </script>";
    } else {
        // Jika gagal update, tampilkan error
        echo "<script>
            alert('Gagal memperbarui data pengguna. Silakan coba lagi.');
            location.href='../admin/user.php';
        </script>";
    }
}
?>
