        <?php
        include 'config.php';
        session_start();
        
        $username = "";
        $email = "";

        if(isset($_SESSION['username'])) {
            header("Location: index.php");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password']; // Hash the input password using SHA-256
            $cpassword = $_POST['cpassword']; // Hash the input confirm password using SHA-256

            // Cek jika password dan konfirmasi password cocok
            if ($password == $password) {

                $hashpass = hash('sha256', $_POST['password']);

                $select_sql = "SELECT * FROM pengguna WHERE email='$email'";
                $result_select = mysqli_query($conn, $select_sql);

                if ($result_select && !$result_select->num_rows > 0) {
                    $sql = "INSERT INTO pengguna (username, email, password,role) VALUES ('$username', '$email', '$hashpass','admin')";
                    $result = mysqli_query($conn, $sql);

                    // Pendaftaran berhasil
                    if ($result) {
                        echo "<script>alert('Selamat, pendaftaran berhasil!')</script>";
                        header('Location: index.php');
                        $username = "";
                        $email = "";
                        $_POST['password'] = "";
                        $_POST['cpassword'] = "";
                    } else {
                        echo "<script>alert('Maaf, terjadi kesalahan.')</script>";
                    }
                } else {
                    echo "<script>alert('Ups, email sudah terdaftar.')</script>";
                }
            } else {
                echo "<script>alert('Password tidak sesuai.')</script>";
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
            <title>Daftar Akun user</title>
        </head>
        <body>
            <div class="container">
                <form method="post" action="">
                    <p class="login-text" style="font-size: 2rem; font-weight: 800;">Gabung Hostinger</p>
                    <div class="input-group">
                        <input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
                    </div>
                    <div class="input-group">
                        <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
                    </div>
                    <div class="input-group">
                        <input type="password" placeholder="Password" name="password"  required>
                    </div>
                    <div class="input-group">
                        <input type="password" placeholder="Confirm Password" name="cpassword"  required>
                    </div>
                    <div class="input-group">
                        <button name="submit" class="btn">Daftar</button>
                    </div>
                    <p class="login-register-text">Sudah punya akun? <a href="index.php">Login</a>. buat akun admin? <a href="registerAdmin.php"> buat</a></p>
                </form>
            </div>
        </body>
        </html>