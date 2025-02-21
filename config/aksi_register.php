<?php 

include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);
$email = $_POST['email'];
$namalengkap = $_POST['namalengkap'];
$alamat = $_POST['alamat'];

$role = 'user'; 

$sql = mysqli_query($koneksi, "INSERT INTO user (username, password, email, namalengkap, alamat, role) VALUES ('$username', '$password', '$email', '$namalengkap', '$alamat', '$role')");

if ($sql) {
    echo "<script>
    alert('Pendaftaran akun berhasil');
    location.href='../login.php';
    </script>";
} else {
    echo "<script>
    alert('Pendaftaran akun gagal');
    location.href='../register.php';
    </script>";
}
?>
