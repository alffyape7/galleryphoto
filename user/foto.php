<?php
session_start();
$userid = $_SESSION['userid'];
include '../config/koneksi.php';
if ($_SESSION['status'] != 'login') {
    echo "<script> 
  alert('Anda belum login!');
  location.href='../index.php';
  </script>";
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
<body style="background-color:rgb(158, 134, 98);"> <!-- Background body jadi beige -->
  <nav class="navbar navbar-expand-lg" style="background-color:rgb(168, 143, 110);"> <!-- Navbar jadi beige -->
    <div class="container">
      <a class="navbar-brand" href="index.php" style="color:rgb(135, 97, 69) !important; font-weight: bold;">GALLERY PHOTO</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
                <div class="navbar-nav me-auto">
                    <a href="home.php" class="nav-link">Home</a>
                    <a href="album.php" class="nav-link">Album</a>
                    <a href="foto.php" class="nav-link">Foto</a>
                
                </div>

                <a href="../config/aksi_logout.php" class="btn m-1" style="border: 2px solid #D2B48C; color:#8B4513; background-color: #F5F5DC;">Keluar</a>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card mt-2">
                    <div class="card-header">Tambah Foto</div>
                    <div class="card-body">
                        <form action="../config/aksi_foto_user.php" method="POST" enctype="multipart/form-data">
                            <label class="form-label">Judul Foto</label>
                            <input type="text" name="judulfoto" class="form-control" required>
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsifoto" required></textarea>
                            <label class="form-label">Album</label>
                            <select class="form-control" name="albumid" required>
                                <?php
                                $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
                                while($data_album = mysqli_fetch_array($sql_album)){ ?>
                                <option value=" <?php echo $data_album['albumid'] ?>">
                                <?php echo $data_album['namaalbum'] ?>
                                </option>
                                <?php } ?>
                            </select>
                            <label class="form-label">File</label>
                            <input type="file" class="form-cntrol" name="lokasifile" required>
                            <button type="submit" style="background-color:rgb(197, 187, 164); color:rgb(255, 255, 255);" class="btn mt-2" name="tambah">TAMBAH DATA</button>

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
                                    <th>foto</th>
                                    <th>judul foto</th>
                                    <th>deskripsi</th>
                                    <th>tanggal</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                            <tbod>
                                <?Php

                                $no = 1;
                                $userid = $_SESSION['userid'];
                                $sql = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid'");
                                while ($data = mysqli_fetch_array($sql)) {

                                    ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><img src="../assets/img/<?php echo $data['lokasifile']?>" width="100"></td>
                                        <td><?php echo $data['judulfoto'] ?></td>
                                        <td><?php echo $data['deskripsifoto'] ?></td>
                                        <td><?php echo $data['tanggalunggah'] ?></td>
                                        <td>


                                        <button type="button" style="background-color: #F5F5DC; color: #5A5A42;" class="btn" data-bs-toggle="modal" 
                                                data-bs-target="#edit<?php echo $data['fotoid'] ?>">
                                            EDIT
                                        </button>


                                            <div class="modal fade" id="edit<?php echo $data['fotoid'] ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">edit data
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="../config/aksi_foto_user.php" method="POST" enctype="multipart/form-data">
                                                                <input type="hidden" name="fotoid"
                                                                    value="<?php echo $data['fotoid'] ?>">
                                                                <label class="form-label">Judul Foto</label>
                                                                <input type="text" name="judulfoto" value="<?php echo $data['judulfoto']?>" class="form-control"
                                                                    required>
                                                                <label class="form-label">Deskripsi</label>
                                                                <textarea class="form-control" name="deskripsifoto" 
                                                                    required>
                                                                    <?php echo $data['deskripsifoto']; ?></textarea>
                                                                    <label class="form-label">Album</label>
                            <select class="form-control" name="albumid">
                                <?php
                                $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid
                                '");
                                while($data_album = mysqli_fetch_array($sql_album)){ ?>
                                <option <?php if($data_album['albumid'] == $data ['albumid'] ) { ?> selected="selected" <?php } ?>value=" <?php echo $data_album['albumid'] ?>">
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
                                <input type="file" class="form-cntrol" name="lokasifile">

                                </div>
                            </div>
                            
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="sumbit" name="edit" class="btn btn-dark">EDIT DATA
                                                                </button>
                                                                </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ------ -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapus<?php echo $data['fotoid'] ?>">
                                                HAPUS
                                            </button>


                                            <div class="modal fade" id="hapus<?php echo $data['fotoid'] ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">hapus data
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="../config/aksi_foto_user.php" method="POST">
                                                                <input type="hidden" name="fotoid"
                                                                    value="<?php echo $data['fotoid'] ?>">
                                                                Anda Yakin Ingin Menghapus Data Ini? <strong><?php echo $data['judulfoto'] ?></strong>?
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="sumbit" name="hapus" class="btn btn-dark">HAPUS DATA
                                                                </button>
                                                                </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer class="d-flex justify-content-center align-items-center border-top mt-3 fixed-bottom text-center w-100" 
        style="height: 30px; font-size: 12px; background-color:rgb(158, 131, 104); color: white;">
    <p class="mb-0">&copy; 2025 | Alffya</p>
</footer>

<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
