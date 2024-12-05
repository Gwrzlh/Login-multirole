<?php
include "../config.php";

$id = $_GET['id'];

$sql = "SELECT * FROM buku where id = $id";
$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_assoc($query);

if(isset($_POST['update'])){
    $judul = $_POST['judul'];
    $penerbit = $_POST['penerbit'];
    $pengarang = $_POST['pengarang'];
    $tahun = $_POST['tahun'];
    $nopsis = $_POST['sinopsis'];
 
    $boleh = array("jpg", "png", "jpeg");
    $picname = $_FILES['cover']['name'];
    $x = explode('.', $picname);
    $ekstansi = strtolower(end($x));
    $size = $_FILES['cover']['size'];
    $file_temp= $_FILES['cover']['tmp_name'];

    if(in_array($ekstansi,$boleh) === true){
        if($size < 1044070){
           move_uploaded_file($file_temp, '../properti/'.$picname);
           $sql = "UPDATE buku SET Judul ='$judul', penerbit = '$penerbit', pengarang = '$pengarang', tahun = '$tahun', cover = '$picname', sinopsis = '$nopsis' WHERE id = $id";
           $query = mysqli_query($conn,$sql);
           if($query){
              echo "file berhasil diupdate";
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

    <title>Edit Buku</title>
    <style>
            :root {
    --primary-color: #1a1a2e;
    --secondary-color: #16213e;
    --accent-color: #0f3460;
    --light-color: #e94560;
    --background-color: #f5f5f5;
    --text-color: #333;
    --transition-speed: 0.3s;
}

body {
    font-family: 'Nunito', 'Poppins', sans-serif;
    background: linear-gradient(135deg, var(--background-color) 0%, #f0f0f0 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.container {
    max-width: 500px;
    width: 100%;
    padding: 2rem;
    background-color: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    transition: all var(--transition-speed) ease;
}

.container:hover {
    box-shadow: 0 15px 40px rgba(0,0,0,0.12);
    transform: translateY(-10px);
}

form {
    display: flex;
    flex-direction: column;
}

.form-control {
    background-color: #f9f9f9;
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: 8px;
    padding: 12px 15px;
    margin-bottom: 1rem;
    transition: all var(--transition-speed) ease;
    font-size: 1rem;
}

.form-control:focus {
    outline: none;
    border-color: var(--light-color);
    box-shadow: 0 0 0 3px rgba(233,69,96,0.2);
}

.form-control::placeholder {
    color: var(--secondary-color);
    opacity: 0.7;
}

.btn-primary {
    background-color: var(--light-color);
    border: none;
    border-radius: 8px;
    padding: 12px 20px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all var(--transition-speed) ease;
}

.btn-primary:hover {
    background-color: var(--accent-color);
    transform: translateY(-3px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

/* File Input Styling */
.form-control[type="file"] {
    padding: 10px 15px;
    cursor: pointer;
}

.form-control[type="file"]::file-selector-button {
    background-color: var(--secondary-color);
    color: white;
    border: none;
    padding: 8px 15px;
    margin-right: 15px;
    border-radius: 5px;
    transition: all var(--transition-speed) ease;
}

.form-control[type="file"]::file-selector-button:hover {
    background-color: var(--accent-color);
}

/* Responsive Design */
@media (max-width: 576px) {
    .container {
        width: 95%;
        padding: 1rem;
    }

    .btn-primary {
        width: 100%;
    }
}

/* Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.container {
    animation: fadeIn 0.5s ease-out;
}
    </style>
</head>
<body>
<div class="container mt-3">
    <form method="post" enctype="multipart/form-data"  class="mb-5">
        <div class="mb-3">  
           <input type="text" name="judul" class="form-control" placeholder="Masukkan Judul" value="<?php echo $result['Judul'] ?>" required>
        </div>
        <div class="mb-3">
           <input type="text" name="penerbit" class="form-control" placeholder="Penerbit" value="<?php echo $result['penerbit'] ?>" required>
        </div>
        <div class="mb-3">
        <input type="text" name="pengarang" class="form-control" placeholder="pengarang" value="<?php echo $result['pengarang'] ?>" required>
        </div>
        <div class="mb-3">
           <input type="number" name="tahun" class="form-control" placeholder="Tahun" value="<?php echo $result['tahun'] ?>" required>
        </div>
        <div class="mb-3">
           <input type="textarea" name="sinopsis" class="form-control" placeholder="sinopsis" value="<?php echo $result['sinopsis'] ?>" required>
        </div>
        <div class="mb-3">
           <input type="file" name="cover" id="cover" class="form-control" placeholder="Masukkan cover" value="<?php echo $result['cover'] ?>" required>
        </div>
           <input type="submit" class="btn btn-primary"  name="update" value="update" id="update">
         <div class="mt-3">
           <a href="javascript:history.back()" class="btn btn-primary" >Cencel</a>
         </div>
    </form>
    </div> 
</body>
</html>