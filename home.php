<?php
session_start();
include 'config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gallery Photo</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/style.css" class="rel">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
</head>

<body style="background-color:rgb(158, 134, 98);"> <!-- Background body jadi beige -->
  <nav class="navbar navbar-expand-lg" style="background-color:rgb(168, 143, 110);"> <!-- Navbar jadi beige -->
    <div class="container">
      <a class="navbar-brand" href="index.php" style="color:rgb(135, 97, 69) !important; font-weight: bold;">GALLERY PHOTO</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
        <div class="navbar-nav me-auto">
        </div>
        <a href="register.php" class="btn m-1" style="border: 2px solid #D2B48C; color:#8B4513; background-color: #F5DEB3;">Daftar</a>
        <a href="login.php" class="btn m-1" style="border: 2px solid #D2B48C; color:#8B4513; background-color: #F5DEB3;">Masuk</a>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <div class="row">
      <?php
      
      $query = "
        SELECT 
          foto.*, 
          COUNT(DISTINCT likefoto.userid) AS jumlah_like, 
          (SELECT COUNT(*) FROM komentarfoto WHERE komentarfoto.fotoid = foto.fotoid) AS jumlah_komentar 
        FROM 
          foto 
        LEFT JOIN 
          likefoto ON foto.fotoid = likefoto.fotoid 
        GROUP BY 
          foto.fotoid
      ";

      $result = mysqli_query($koneksi, $query);

      while ($data = mysqli_fetch_array($result)) {
        ?>
        <div class="col-md-3 mb-4">
          <div class="card">
            <img src="assets/img/<?php echo $data['lokasifile']; ?>" class="card-img-top" alt="<?php echo $data['judulfoto']; ?>" style="height: 200px; object-fit: cover;" data-bs-toggle="modal" data-bs-target="#imageModal<?php echo $data['fotoid']; ?>">
            <div class="card-body">
              <h5 class="card-title"><?php echo $data['judulfoto']; ?></h5>
              <p class="card-text"><?php echo $data['deskripsifoto']; ?></p>
              <p class="card-text">
                <?php if (!isset($_SESSION['userid'])):?>
                  <small class="text-muted">
                    <i class="fas fa-exclamation-circle"></i> Untuk melihat jumlah like dan komentar, silahkan <a href="login.php">login</a> atau <a href="register.php">daftar</a> terlebih dahulu.
                  </small>
                <?php else: ?>
                  <small class="text-muted">
                    <i class="fas fa-thumbs-up"></i> <?php echo $data['jumlah_like']; ?> suka
                  </small><br>
                  <small class="text-muted">
                    <i class="fas fa-comment"></i> <?php echo $data['jumlah_komentar']; ?> komentar
                  </small>
                <?php endif; ?>
              </p>
            </div>
          </div>
        </div>

        <div class="modal fade" id="imageModal<?php echo $data['fotoid']; ?>" tabindex="-1" aria-labelledby="imageModalLabel<?php echo $data['fotoid']; ?>" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel<?php echo $data['fotoid']; ?>"><?php echo $data['judulfoto']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body text-center">
                <img src="assets/img/<?php echo $data['lokasifile']; ?>" class="img-fluid" alt="<?php echo $data['judulfoto']; ?>">
                <p class="mt-3"><?php echo $data['deskripsifoto']; ?></p>
                <p class="mt-3">
                  <?php if (!isset($_SESSION['userid'])): ?>
                    <small class="text-muted">
                      <i class="fas fa-exclamation-circle"></i> Untuk melihat jumlah like dan komentar, silahkan <a href="login.php">login</a> atau <a href="register.php">daftar</a> terlebih dahulu.
                    </small>
                  <?php else: ?>
                    <small class="text-muted">
                      <i class="fas fa-thumbs-up"></i> <?php echo $data['jumlah_like']; ?> suka
                    </small><br>
                    <small class="text-muted">
                      <i class="fas fa-comment"></i> <?php echo $data['jumlah_komentar']; ?> komentar
                    </small>
                  <?php endif; ?>
                </p>
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

