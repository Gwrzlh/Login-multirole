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
     <link rel="stylesheet" href="styleBerhasil.css">
    <title>Welcome</title>
</head>
<body>
<div class="sidebar" id="sidebar">
        <a href="#" onclick="close()" class="ttp">Keluar</a>
        <div class="log">
            <form action="logout.php" method="post" class="logout">
                <button type="submit" class="but" id="but">Logout</button>
            </form>
        </div>
       
    </div>
    <header>
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
        <h1>Lets Shoping</h1>
    </header>
    <script>
        function sidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }function close() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.remove('active')
        }
    </script>
</body>
</html>