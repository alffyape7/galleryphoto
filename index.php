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
  <style>
    h1 {
      font-family: 'Times New Roman', Times, serif;
      background: linear-gradient(to right,rgb(255, 224, 173),rgb(203, 159, 101));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      text-align: center;
    }
  </style>
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
  </nav>


  <div class="container d-flex flex-column align-items-center mt-5">
    <h1>WELCOME TO GALLERY PHOTO</h1>

    <!-- Logo di tengah dengan ukuran lebih pas -->
    <div class="mt-4 mb-4">
      <img src="https://i.pinimg.com/736x/87/3d/22/873d228f4b69ad548f8493911edb9e3f.jpg" alt="Logo" class="img-fluid" style="max-width: 200px; height: auto;">
    </div>
    
    <!-- Tombol Mulai Ujicoba di bawah logo -->
    <a href="home.php" class="btn mt-3" 
   style="background-color:rgb(212, 182, 149); color: #333; font-family: 'Times New Roman', Times, serif; border: none; padding: 8px 16px; border-radius: 5px; transition: 0.3s;">
   Mulai Ujicoba
</a>

<style>
    a.btn:hover {
        background-color: #EAE0C8; /* Warna lebih gelap saat hover */
        color: black;
    }
</style>
  </div>

  <footer class="d-flex justify-content-center align-items-center border-top mt-3 fixed-bottom text-center w-100" 
        style="height: 30px; font-size: 12px; background-color:rgb(158, 131, 104); color: white;">
    <p class="mb-0">&copy; 2025 | Alffya</p>
</footer>

<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
