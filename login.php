<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Photo</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css" class="rel">
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
       
      </div>
      <a href="register.php" class="btn m-1" style="border: 2px solid #D2B48C; color:#8B4513; background-color: #F5DEB3;">Daftar</a>
        <a href="login.php" class="btn m-1" style="border: 2px solid #D2B48C; color:#8B4513; background-color: #F5DEB3;">Masuk</a>
    </div>
  </div>
</nav> 

<div class="container py-5">
    <deiv class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                    <div class="card-body" style="background-color:rgb(232, 209, 176);"> <!-- Background card-body beige -->
                        <dev class="text-center">
                        <h5>Login</h5>
                    </dev>
                    <form action="config/aksi_login.php" method="POST">
                        <label class="from-label">username</label>
                        <input type="text" name="username" class="form-control" required>
                        <label class="from-label">password</label>
                        <input type="password" name="password" class="form-control" required>
                        <div class="d-grid mt-2">
                            <button style="background-color: #D2B48C; color: #654321; border: none; padding: 8px 16px; border-radius: 5px;">Masuk
                            </button>
                        </div>
                    </form>
                    <hr>
                    <p>Belum Punya Akun? <a href="register.php">Daftar</a></p>
                </div>
            </div>
        </div>
    </deiv>
</div>

<footer class="d-flex justify-content-center align-items-center border-top mt-3 fixed-bottom text-center w-100" 
        style="height: 30px; font-size: 12px; background-color:rgb(158, 131, 104); color: white;">
    <p class="mb-0">&copy; 2025 | Alffya</p>
</footer>

<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>

