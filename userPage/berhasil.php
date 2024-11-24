<?php
include "config.php";
session_start();

$sql = "SELECT * FROM buku";
$query = mysqli_query($conn,$sql);

 
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: admin.php"); // Redirect ke halaman login jika role bukan 'user'
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
     <link rel="stylesheet" href="styleBerhasil.css">
    <title>Welcome</title>
</head>
<body>
<div class="sidebar" id="sidebar">
      <button onclick="close()" class="ttp"> tutup</button>
        <div class="log">
            <form action="logout.php" method="post" class="logout">
                <button type="submit" class="but" id="but">Logout</button>
            </form>
        </div>
    
    </div >
        <nav>
            <div class="wrap" class="menu-btn" >
                <h onclick="sidebar()"><a href="#"><?php echo $_SESSION['username']; ?></a></h>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#x">Riwayat</a></li>
                    <li><a href="#">Keranjang</a></li>
                </ul>
            </div>
        </nav>
        <div class="d-flex">
         <?php 
            while($result = mysqli_fetch_assoc($query)){
            ?>
            <div class="card m-5" style="width: 18rem;">
            <img src="<?php echo "properti/".$result['cover']; ?>" class="card-img-top" alt="cover">
            <div class="card-body">
                    <h5 class="card-title"><?php echo $result['Judul'] ?></h5>
                    <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                    <ul>
                        <li> <strong>penerbit  : </strong> <?php echo $result['penerbit']; ?></li>
                            <li> <strong>pengarang   :</strong> <?php echo $result['pengarang']; ?></li>
                            <li> <strong>Tahun rilis :</strong><?php echo $result['tahun']; ?></li>
                        </ul>
                        <a href="#" class="btn btn-primary">BACA BUKU</a>
                </div>
                </div>
                <?php
                }
                ?>
            </div>
    <script>
        function sidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }function close() {
             var sidebar = document.getElementById('sidebar');
             if (sidebar.classList.contains('active')) {
             sidebar.classList.remove('active');
         }
     }
    </script>
</body>
</html>