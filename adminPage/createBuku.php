<?php
include "../config.php";


if(isset($_POST['submit'])){

   $judul = $_POST['judul'];
   $penerbit = $_POST['penerbit'];
   $pengarang = $_POST['pengarang'];
   $tahun = $_POST['tahun'];

   $boleh = array("jpg", "png", "jpeg");
   $picname = $_FILES['cover']['name'];
   $x = explode('.', $picname);
   $ekstansi = strtolower(end($x));
   $size = $_FILES['cover']['size'];
   $file_temp= $_FILES['cover']['tmp_name'];

if(in_array($ekstansi,$boleh) === true){
   if($size < 1044070){
      move_uploaded_file($file_temp, '../properti/'.$picname);
      $sql = "INSERT INTO buku(judul,penerbit,pengarang,tahun,cover) VALUES('$judul','$penerbit','$pengarang','$tahun','$picname')";
      $query = mysqli_query($conn,$sql);
      if($query){
         echo "file berhasil diupload";
      }else{
         echo "gagal diupload";
      }
   }else{
      echo "ukkuran file terlalu besar";
   }
}else{
   echo "ekstensi tidak sesuai";
}
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
<div class="container mt-3">
    <form method="post" enctype="multipart/form-data"  class="mb-5">
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
        <div class="mb-3">
           <input type="file" name="cover" id="cover" class="form-control" placeholder="Masukkan cover" required>
        </div>
           <input type="submit" class="btn btn-primary"  name="submit">
    </form>
    </div>
</body>
</html>
