<?php
include "../config.php";
session_start();

$sql = "SELECT * FROM buku";
$query = mysqli_query($conn,$sql);

 
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: ../adminPage/admin.php"); // Redirect ke halaman login jika role bukan 'user'
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
    <link rel="stylesheet" href="../css/styleBerhasil.css">
    <title>Welcome</title>
   <style>
     
   </style>
</head>
<body>
    <nav>
        <a href="#" class="navbar-brand" onclick="openSidebar()"> <?php echo $_SESSION['username'] ?></a>
                <ul>
                    <li class="underline-hover m-3"><a href="#">Home</a></li>
                    <li class="underline-hover m-3"><a href="#x">Popular</a></li>
                    <li class="underline-hover m-3"><a href="#">Terbaru</a></li>
                </ul>
            </div>
        </nav>
    <div class="sidebar" id="sidebar">
        <button class="close-btn" onclick="closeSidebar()"> < </button>
    <form action="../logout.php" method="post" class="text-center m-5">
        <button class="btn btn-primary">Logout</button>
      </form>
    </div>
    <div class="container text-center">
        <h1 class="mt-5 mb-5">WELCOME TO LIBRARY</h1>
    </div>
    <div class="d-flex">
         <?php 
            while($result = mysqli_fetch_assoc($query)){
            ?>
            <div class="card m-5" style="width: 18rem;">
            <img src="<?php echo "../properti/".$result['cover']; ?>" class="card-img-top" alt="cover">
            <div class="card-body">
                    <h5 class="card-title"><?php echo $result['Judul']; ?></h5>
                    <ul class="description">
                        </ul>
                    <a href="viewbook.php?id=<?php echo $result ['id'];?>" class="btn btn-primary">BACA BUKU</a>
                </div>
                </div>
                <?php
                }
                ?>
            </div>
            <script>
        
        function openSidebar() {
            document.getElementById("sidebar").classList.add("active");
        }

        function closeSidebar() {
            document.getElementById("sidebar").classList.remove("active");
        }
    </script>
</body>
</html>