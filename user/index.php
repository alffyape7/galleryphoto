<?php
session_start();
$userid = $_SESSION['userid'];
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
    .modal-body {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .overflow-auto {
      max-height: 500px;
      overflow-y: auto;
    }
  </style>
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

  <div class="container mt-3">
    <div class="row">
      <?php
      $query = mysqli_query($koneksi, "SELECT * FROM foto INNER JOIN user ON foto.userid=user.userid INNER JOIN album ON foto.albumid=album.albumid");
      while ($data = mysqli_fetch_array($query)) {
        ?>
        <div class="col-md-3 mt-3">
          <a data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>">
            <div class="card mb-3">
              <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>">
              <div class="card-footer text-center">
                <?php
                $fotoid = $data['fotoid'];
                $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
                if (mysqli_num_rows($ceksuka) == 1) { ?>
                  <a href="../config/proses_like_user.php?fotoid=<?php echo $data['fotoid'] ?>"><i class="fa fa-heart"></i></a>
                <?php } else { ?>
                  <a href="../config/proses_like_user.php?fotoid=<?php echo $data['fotoid'] ?>"><i class="fa-regular fa-heart"></i></a>
                <?php }

                $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                echo mysqli_num_rows($like) . ' suka';
                ?>
                <a href="#" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>"><i class="fa-regular fa-comment"></i></a> 
                <?php 
                $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
                echo mysqli_num_rows($jmlkomen).' komentar';
                ?>
              </div>
            </div>
          </a>

          <div class="modal fade" id="komentar<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-8">
                      <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="img-fluid" title="<?php echo $data['judulfoto'] ?>">
                    </div>
                    <div class="col-md-4">
                      <div class="overflow-auto p-3">
                        <h5><?php echo $data['judulfoto'] ?></h5>
                        <p><span class="badge bg-light"><?php echo $data['namalengkap'] ?></span> <span class="badge bg-light"><?php echo $data['tanggalunggah'] ?></span> <span class="badge bg-primary"><?php echo $data['namaalbum'] ?></span></p>
                        <p><?php echo $data['deskripsifoto'] ?></p>
                        <hr>
                        <?php
                        $komentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='$fotoid'");
                        while($row = mysqli_fetch_array($komentar)) {
                        ?>
                        <p><strong><?php echo $row['namalengkap'] ?>:</strong> <?php echo $row['isikomentar'] ?></p>
                        <?php } ?>
                        <form action="../config/proses_komentar_user.php" method="POST" class="mt-3">
                          <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                          <div class="input-group">
                            <input type="text" name="isikomentar" class="form-control" placeholder="Tambahkan komentar">
                            <button type="submit" name="kirimkomentar" class="btn btn-outline-light">Kirim</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>

  <footer class="d-flex justify-content-center align-items-center border-top mt-3 fixed-bottom text-center w-100" 
        style="height: 30px; font-size: 12px; background-color:rgb(158, 131, 104); color: white;">
    <p class="mb-0">&copy; 2025 | Alffya</p>
</footer>

<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
