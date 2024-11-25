<?php
include "../config.php";   
session_start();

$sql = "SELECT * FROM buku";
$query = mysqli_query($conn,$sql);
 
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: berhasil.php");
    exit();
}


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    <title>Login berhasil!</title>
    <style>
        .btn-minimal {
            border: none; /* Tidak ada border */
            background-color: transparent; /* Background transparan */
            color: darkslategrey; 
            font-size: 16px; /* Ukuran font sederhana */
            padding: 5px 10px; /* Padding minimal */
            transition: all 0.3s ease; /* Animasi hover */
        }

        .btn-minimal:hover {
            background-color: grey; /* Warna background lembut saat di-hover */
            border-radius: 5px; 
        }

        .btn-minimal:focus {
            outline: none; 
        }
    </style>
</head>
<body>
<nav class="navbar bg-secondary text-light navbar-expand-lg">
    <div class="container-fluid ">
        <h4 class="mb-0 me-3 "><?php echo $_SESSION['username']; ?></h4>
        <form action="../logout.php" method="post" >
            <button type="submit" class="btn btn-minimal">Logout</button>
        </form>
     <div class="div" class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="createBuku.php" class="nav-link">Create Buku</a>
            </li>
          <li class="nav-item">
          <a href="buatUser.php" class="nav-link">Akun User</a>
          </li>
        </ul>
     </div>
    </div>
</nav>
<div class="container mt-4">
<table class="table table-striped table-bordered">
       <thead class="thead-dark">
        <tr class="text-center">
          <th>ID</th>
          <th>Judul</th>
          <th>Penerbit</th>
          <th>Pengarang</th>
          <th>tahun terbit</th>
          <th>cover</th>
          <th>action</th>
        </tr>
    </thead>
    <tbody>
    <?php 
         $i= 1;   
        while($select = mysqli_fetch_assoc($query)){
      ?>
      <tr>
        <td class="text-center"><?php echo $i++;   ?></td>
        <!-- <td class="text-center"><?php echo $select['id'] ?></td> -->
        <td><?php echo $select['Judul']?></td>
        <td><?php echo $select['penerbit']?></td>
        <td><?php echo $select['pengarang']?></td>
        <td><?php echo $select['tahun']?></td>
        <td>
           <img src="<?php echo "../properti/".$select['cover']; ?>" alt="cover" class="d-flex" height="100px">
        </td>
        <td class="text-center">
            <a href="deletebuku.php?id=<?php echo $select['id']; ?>" class="btn btn-outline-secondary btn-sm me-2">Hapus</a>
           <a href="editBuku.php?id=<?php echo $select['id']; ?>" class="btn btn-outline-secondary btn-sm me-2">Edit</a>
        </td>
       </tr>
       <?php 
    }  
      ?>
    </tbody>
 </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>