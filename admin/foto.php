<?php
session_start();
include '../config/koneksi.php';

if ($_SESSION['status'] != 'login') {
    echo "<script> 
        alert('Anda belum login!');
        location.href='../index.php';
    </script>";
}

$userid = $_SESSION['userid'];

if (isset($_POST['edit'])) {
    $fotoid = $_POST['fotoid'];
    $judulfoto = $_POST['judulfoto'];
    $deskripsifoto = $_POST['deskripsifoto'];
    $albumid = $_POST['albumid'];

    if ($_FILES['lokasifile']['name'] != "") {
        $lokasifile = $_FILES['lokasifile']['name'];
        move_uploaded_file($_FILES['lokasifile']['tmp_name'], "../assets/img/" . $lokasifile);

        $query = "UPDATE foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsifoto', albumid='$albumid', lokasifile='$lokasifile' WHERE fotoid='$fotoid'";
    } else {
        $query = "UPDATE foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsifoto', albumid='$albumid' WHERE fotoid='$fotoid'";
    }

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil diperbarui'); location.href='../admin/foto.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data'); location.href='../admin/foto.php';</script>";
    }
}

if (isset($_POST['hapus'])) {
    $fotoid = $_POST['fotoid'];

    $query = "DELETE FROM foto WHERE fotoid='$fotoid'";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil dihapus'); location.href='../admin/foto.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data'); location.href='../admin/foto.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Photo</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css" class="rel">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-secondary">
        <div class="container">
            <a class="navbar-brand" href="index.php" style="color: #D2B48C !important;">GALLERY PHOTO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
                <div class="navbar-nav me-auto">
                    <a href="index.php" class="nav-link">Home</a>
                    <a href="album.php" class="nav-link">Album</a>
                    <a href="foto.php" class="nav-link">Foto</a>
                    <a href="user.php" class="nav-link">User</a>
                </div>
                <a href="../config/aksi_logout.php" class="btn btn-outline-light m-1">KELUAR</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card mt-2">
                    <div class="card-header">Tambah Foto</div>
                    <div class="card-body">
                        <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                            <label class="form-label">Judul Foto</label>
                            <input type="text" name="judulfoto" class="form-control" required>
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsifoto" required></textarea>
                            <label class="form-label">Album</label>
                            <select class="form-control" name="albumid" required>
                                <?php
                                $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
                                while ($data_album = mysqli_fetch_array($sql_album)) { ?>
                                    <option value="<?php echo $data_album['albumid'] ?>">
                                        <?php echo $data_album['namaalbum'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <label class="form-label">File</label>
                            <input type="file" class="form-control" name="lokasifile" required>
                            <button type="submit" class="btn btn-secondary mt-2" name="tambah">TAMBAH DATA</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card mt-2">
                    <div class="card-header">Data Galeri Foto</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Foto</th>
                                    <th>Judul Foto</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $sql = mysqli_query($koneksi, "SELECT * FROM foto");
                                while ($data = mysqli_fetch_array($sql)) {
                                ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><img src="../assets/img/<?php echo $data['lokasifile']?>" width="100"></td>
                                    <td><?php echo $data['judulfoto'] ?></td>
                                    <td><?php echo $data['deskripsifoto'] ?></td>
                                    <td><?php echo $data['tanggalunggah'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['fotoid'] ?>">EDIT</button>
                                        <div class="modal fade" id="edit<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                                            <label class="form-label">Judul Foto</label>
                                                            <input type="text" name="judulfoto" value="<?php echo $data['judulfoto']?>" class="form-control" required>
                                                            <label class="form-label">Deskripsi</label>
                                                            <textarea class="form-control" name="deskripsifoto" required><?php echo $data['deskripsifoto']; ?></textarea>
                                                            <label class="form-label">Album</label>
                                                            <select class="form-control" name="albumid">
                                                                <?php
                                                                $sql_album = mysqli_query($koneksi, "SELECT * FROM album");
                                                                while ($data_album = mysqli_fetch_array($sql_album)) { ?>
                                                                    <option <?php if ($data_album['albumid'] == $data['albumid']) { ?> selected="selected" <?php } ?> value="<?php echo $data_album['albumid'] ?>">
                                                                        <?php echo $data_album['namaalbum'] ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                            <label class="form-label">Foto</label>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <img src="../assets/img/<?php echo $data['lokasifile']?>" width="100">
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <label class="form-label">Ganti File</label>
                                                                    <input type="file" class="form-control" name="lokasifile">
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="edit" class="btn btn-dark">EDIT DATA</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['fotoid'] ?>">HAPUS</button>
                                        <div class="modal fade" id="hapus<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST">
                                                            <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                                            <p>Apakah Anda yakin ingin menghapus data ini?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="hapus" class="btn btn-danger">HAPUS DATA</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
