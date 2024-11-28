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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container d-flex">
        <div class="container-img">
             <img src="<?php echo "../properti/".$bukuresult['cover']; ?>" alt="cover" height="500px">
        </div>
        <div>
            <h1><?php echo $bukuresult['Judul'] ?></h1>
            <ul>
                <li><strong>Pengarang :</strong><?php echo $bukuresult['pengarang'] ?></li>
                <li><strong>Penerbit :</strong><?php echo $bukuresult['penerbit'] ?></li>
                <li><strong>Tahun RIlis :</strong><?php echo $bukuresult['tahun'] ?></li>
            </ul>
        </div>
        <div class="container"> 
            <p></p>
        </div>
    </div>
</body>
</html>