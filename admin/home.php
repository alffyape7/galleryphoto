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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <style>
        .card:hover {
            transform: scale(1.03);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .album-buttons a {
            margin: 0 5px 10px 0;
        }
        .card-footer i {
            margin-right: 5px;
        }
    </style>
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
                    <a href=".php" class="nav-link">Home</a>
                    <a href="album.php" class="nav-link">Album</a>
                    <a href="foto.php" class="nav-link">Foto</a>
                    <a href="user.php" class="nav-link">User</a>
                </div>
                <a href="../config/aksi_logout.php" class="btn btn-outline-light m-1">Keluar</a>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
    <h5 class="album-heading">Album:</h5>
        <div class="album-buttons">
    <?php 
    $album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
    while($row = mysqli_fetch_array($album)) { ?>
        <a href="home.php?albumid=<?php echo $row['albumid'] ?>" class="btn album-btn"><?php echo $row['namaalbum'] ?></a>
    <?php } ?>
</div>


        <div class="row">
        <?php 
        if (isset($_GET['albumid'])) {
            $albumid = $_GET['albumid'];
            $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid' AND albumid='$albumid'");
            while($data = mysqli_fetch_array($query)) { ?>
                <div class="col-md-3 mt-2">
                    <div class="card">
                        <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>">
                        <div class="card-footer text-center">
                            <?php 
                            $fotoid = $data['fotoid'];
                            $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");

                            if (mysqli_num_rows($ceksuka) == 1) { ?>
                                <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>"><i class="fa fa-heart text-danger"></i></a>
                            <?php } else { ?>
                                <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>"><i class="fa-regular fa-heart"></i></a>
                            <?php }

                            $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                            echo mysqli_num_rows($like) . ' suka';

                            $komentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
                            $jumlahKomentar = mysqli_num_rows($komentar);
                            ?>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#commentModal<?php echo $fotoid; ?>"><i class="fa-regular fa-comment"></i></a> <?php echo $jumlahKomentar; ?> Komentar
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="commentModal<?php echo $fotoid; ?>" tabindex="-1" aria-labelledby="commentModalLabel<?php echo $fotoid; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="commentModalLabel<?php echo $fotoid; ?>">Komentar untuk <?php echo $data['judulfoto']; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="overflow-auto p-3">
                                    <?php
                                    $comments = mysqli_query($koneksi, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='$fotoid'");
                                    while ($comment = mysqli_fetch_array($comments)) { ?>
                                        <div class="comment mb-2">
                                            <strong><?php echo $comment['namalengkap']; ?>:</strong>
                                            <p><?php echo $comment['isikomentar']; ?></p>
                                            <small>Posted on <?php echo $comment['tanggalkomentar']; ?></small>
                                            <form action="../config/proses_hapus_komentar.php" method="post" class="d-inline">
                                                <input type="hidden" name="komentarid" value="<?php echo $comment['komentarid']; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?');">Hapus</button>
                                            </form>
                                        </div>
                                    <?php } ?>
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } 
        } else {

        } ?>
        </div>
    </div>

    <footer class="d-flex justify-content-center align-items-center border-top mt-3 fixed-bottom text-center w-100" 
        style="height: 30px; font-size: 12px; background-color:rgb(158, 131, 104); color: white;">
    <p class="mb-0">&copy; 2025 | Alffya</p>
</footer>

<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
