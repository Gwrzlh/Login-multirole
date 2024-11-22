<?php
include "config.php";


if(isset($_POST['submit'])){
  $judul = $_POST['judul'];
  $penerbit = $_POST['penerbit'];
  $pengarang = $_POST['pengarang'];
  $tahun = $_POST['tahun'];

  $quer = "INSERT INTO buku(judul,penerbit,pengarang,tahun) VALUES('$judul','$penerbit','$pengarang','$tahun')";
  $sql = mysqli_query($conn,$quer);

   header("Location: admin.php");

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<a href="admin.php" class="btn btn-primary">Beck</a>
<div class="container mt-3">
    <form method="post" class="mb-5">
        <div class="mb-3">  
           <input type="text" name="judul" class="form-control" placeholder="Masukkan Judul" required>
        </div>
        <div class="mb-3">
           <input type="text" name="penerbit" class="form-control" placeholder="Penerbit" required>
        </div class="mb-3">
        <div class="mb-3">
        <input type="text" name="pengarang" class="form-control" placeholder="pengarang" required>
        </div>
        <div class="mb-3">
           <input type="number" name="tahun" class="form-control" placeholder="Tahun" required>
        </div>
        <!-- <div class="mb-3">
           <input type="file" name="cover" class="form-control" placeholder="Masukkan cover" required>
        </div> -->
        <input type="submit" class="btn btn-primary"  name="submit">
    </form>
    </div>
</body>
</html>
