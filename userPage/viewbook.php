<?php
include "../config.php";

$id = $_GET['id'];

$sqlBuku = "SELECT * FROM buku WHERE id = '$id'";
$bukuQuery = mysqli_query($conn,$sqlBuku);
$bukuresult = mysqli_fetch_assoc($bukuQuery);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/viewbook.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   
</head>
<body>
    <div>
     <a href="berhasil.php" class="btn btn-danger m-3 ">Beck</a>
    </div>
    <div class="container">
        <div class="row book-container">
            <div class="col-md-4">
                <img src="<?php echo '../properti/'.$bukuresult['cover']; ?>" 
                     alt="Book Cover" 
                     class="img-fluid book-cover">
            </div>
            <div class="col-md-8 book-details">
                <h1><?php echo $bukuresult['Judul']; ?></h1>
                <ul>
                    <li><strong>Pengarang</strong><?php echo $bukuresult['pengarang']; ?></li>
                    <li><strong>Penerbit</strong><?php echo $bukuresult['penerbit']; ?></li>
                    <li><strong>Tahun Rilis</strong><?php echo $bukuresult['tahun']; ?></li>
                </ul>
            </div>
            <div class="col-12 book-synopsis">
                <h2>Sinopsis</h2>
                <p><?php echo $bukuresult['sinopsis']; ?></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional, but recommended) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>