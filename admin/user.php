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

// Ambil data dari tabel user
$query = "SELECT * FROM user";
$result = $koneksi->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container">
    <a class="navbar-brand" href="index.php" style="color: #D2B48C !important;">GALLERY PHOTO</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
        <div class="navbar-nav me-auto">
          <a href="index.php" class="nav-link">Home</a>
          <a href="album.php" class="nav-link">Album</a>
          <a href="foto.php" class="nav-link">Foto</a>
        </div>
        <a href="../config/aksi_logout.php" class="btn btn-outline-light m-1">Keluar</a>
      </div>
    </div>
  </nav>

    <div class="container mt-5">
        <h2 class="text-center">Daftar Pengguna</h2>
        <div class="card mt-4">
            <div class="card-header">Data Pengguna</div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Nama Lengkap</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['userid']); ?></td>
                                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td><?php echo htmlspecialchars($row['namalengkap']); ?></td>
                                    <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                                    <td>
                                    <!-- Button trigger modal for Edit -->
<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?php echo $row['userid']; ?>">Edit</button>

<!-- Modal Edit -->
<div class="modal fade" id="edit<?php echo $row['userid']; ?>" tabindex="-1" aria-labelledby="editLabel<?php echo $row['userid']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLabel<?php echo $row['userid']; ?>">Edit Data Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../config/edit_user.php" method="POST">
                    <!-- Hidden Input for User ID -->
                    <input type="hidden" name="userid" value="<?php echo $row['userid']; ?>">

                    <!-- Username Field -->
                    <div class="mb-3">
                        <label for="username<?php echo $row['userid']; ?>" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username<?php echo $row['userid']; ?>" value="<?php echo htmlspecialchars($row['username']); ?>" required>
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="email<?php echo $row['userid']; ?>" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email<?php echo $row['userid']; ?>" value="<?php echo htmlspecialchars($row['email']); ?>" required>
                    </div>

                    <!-- Nama Lengkap Field -->
                    <div class="mb-3">
                        <label for="namalengkap<?php echo $row['userid']; ?>" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="namalengkap" id="namalengkap<?php echo $row['userid']; ?>" value="<?php echo htmlspecialchars($row['namalengkap']); ?>" required>
                    </div>

                    <!-- Alamat Field -->
                    <div class="mb-3">
                        <label for="alamat<?php echo $row['userid']; ?>" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat<?php echo $row['userid']; ?>" value="<?php echo htmlspecialchars($row['alamat']); ?>" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success" name="edit">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

                                       <!-- Button trigger modal for Delete -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?php echo $row['userid']; ?>">Delete</button>

<!-- Modal Delete -->
<div class="modal fade" id="delete<?php echo $row['userid']; ?>" tabindex="-1" aria-labelledby="deleteLabel<?php echo $row['userid']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteLabel<?php echo $row['userid']; ?>">Konfirmasi Hapus Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../config/delete_user.php" method="POST">
                    <input type="hidden" name="userid" value="<?php echo $row['userid']; ?>">
                    <p>Apakah Anda yakin ingin menghapus pengguna ini?</p>
                    <button type="submit" class="btn btn-danger" name="delete">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data pengguna.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$koneksi->close();
?>
