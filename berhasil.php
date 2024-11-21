<?php
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit(); // Terminate script execution after the redirect
}


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
     <link rel="stylesheet" href="styleBerhasil.css">
    <title>Login berhasil!</title>
</head>
<body>
    <div class="sidebar" id="sidebar">
 <a href="#" class="close" id="close" onclick="close()">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>

</a>
    <form action="logout.php" method="POST" class="login-email">
       <button type="submit" class="btn">Logout</button>
    </form>
    </div>
    <header>
        <nav>
            <div class="wrap" class="menu-btn" >
                <h onclick="sidebar()" ><a href="#"><?php echo $_SESSION['username']; ?></a></h>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#x">Riwayat</a></li>
                    <li><a href="#">Keranjang</a></li>
                </ul>
            </div>
        </nav>
        <h1>Lets Shoping</h1>
    </header>
    <script>
        // Fungsi untuk menampilkan atau menyembunyikan sidebar
        function sidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
        function close(){
            var leftbar = document.getElementById('close');
            sidebar.classList.toggle('active');

        }
    </script>
</body>
</html>