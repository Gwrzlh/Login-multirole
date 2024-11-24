<?php
include 'config.php';
session_start();

if (isset($_SESSION['username'])) {
    header("Location: admin.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']); 
     
    if (isset($_POST['submit'])) {
     
        
        $sql = "SELECT * FROM pengguna WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);
     
        if ($result && $result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
        
        if ($_SESSION['role'] === 'admin') {
                header("Location: adminPage/admin.php");
            } else if ($_SESSION['role'] === 'user') {
                header("Location: userPage/berhasil.php");
            } else {
                echo "<script>alert('Role tidak valid');</script>";
            }
            exit();
        }
        
            exit();
        }else{
            echo "<script>alert('email atau password yang anda masukkan salah')</script>";
        }
    }
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" required>
            </div>
            <div class="input-group">
            <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="input-group">
                <div class="input-group">
                <button name="submit" class="btn">Login</button>
            </div>
            <p class="login-register-text">Belum punya akun? <a href="registrasi.php">Daftar</a>.</p>
            </div>
            </div>
            
        </form>
    </div>
</body>
</html>