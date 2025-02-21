<?php

session_start();
include '../config/koneksi.php';
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('anda belum login!');
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
                    <div class="card-header">Tambah Album</div>
                    <div class="card-body">
                        <form action="../config/aksi_album_user.php" method="POST">
                            <label class="form-label">Nama Album</label>
                            <input type="text" name="namaalbum" class="form-control" required>
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" required></textarea>
                            <button type="submit" style="background-color:rgb(197, 187, 164); color:rgb(255, 255, 255);" class="btn mt-2" name="tambah">TAMBAH DATA</button>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card mt-2">
                    <div class="card-header">Data Album</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>nama album</th>
                                    <th>deskripsi</th>
                                    <th>tanggal</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                            <tbod>
                                <?Php

                                $no = 1;
                                $userid = $_SESSION['userid'];
                                $sql = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
                                while ($data = mysqli_fetch_array($sql)) {

                                    ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $data['namaalbum'] ?></td>
                                        <td><?php echo $data['deskripsi'] ?></td>
                                        <td><?php echo $data['tanggalbuat'] ?></td>
                                        <td>


                                        <button type="button" style="background-color: #F5F5DC; color: #5A5A42;" class="btn" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['albumid'] ?>">
                                            EDIT
                                        </button>


                                            <div class="modal fade" id="edit<?php echo $data['albumid'] ?>" tabindex="-1"
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
                                                            <form action="../config/aksi_album_user.php" method="POST">
                                                                <input type="hidden" name="albumid"
                                                                    value="<?php echo $data['albumid'] ?>">
                                                                <label class="form-label">Nama Album</label>
                                                                <input type="text" name="namaalbum" value="<?php echo $data['namaalbum']?>" class="form-control"
                                                                    required>
                                                                <label class="form-label">Deskripsi</label>
                                                                <textarea class="form-control" name="deskripsi" 
                                                                    required>
                                                                    <?php echo $data['deskripsi']; ?>
                                                                </textarea>
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="sumbit" name="edit" class="btn btn-secondary">EDIT DATA
                                                                </button>
                                                                </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ------ -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapus<?php echo $data['albumid'] ?>">
                                                HAPUS
                                            </button>


                                            <div class="modal fade" id="hapus<?php echo $data['albumid'] ?>" tabindex="-1"
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
                                                            <form action="../config/aksi_album_user.php" method="POST">
                                                                <input type="hidden" name="albumid"
                                                                    value="<?php echo $data['albumid'] ?>">
                                                                Anda Yakin Ingin Menghapus Data Ini? <strong><?php echo $data['namaalbum'] ?></strong>?
                                                            
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

