<?php
    include '../config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password']; 
        $cpassword = $_POST['cpassword']; 

        if ($password == $cpassword) {

            $hashpass = hash('sha256', $_POST['password']);

            $select_sql = "SELECT * FROM pengguna WHERE email='$email'";
            $result_select = mysqli_query($conn, $select_sql);

            if ($result_select && !$result_select->num_rows > 0) {
                $sql = "INSERT INTO pengguna (username, email, password,role) VALUES ('$username', '$email', '$hashpass','user')";
                $result = mysqli_query($conn, $sql);
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
        <title>Daftar Akun admin</title>
        <style>
            /* Reset styling */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background: linear-gradient(to bottom right, #6a11cb, #2575fc);
    color: #fff;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Container styling */
.container {
    background: rgba(255, 255, 255, 0.1); /* Transparent white background */
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
    max-width: 400px;
    width: 100%;
}

/* Form styling */
form {
    display: flex;
    flex-direction: column;
}

.input-group {
    margin-bottom: 20px;
    position: relative;
}

.input-group input {
    width: 100%;
    padding: 12px 15px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    background: rgba(255, 255, 255, 0.2); /* Light transparent background */
    color: #fff;
    outline: none;
    transition: all 0.3s ease;
}

.input-group input::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

.input-group input:focus {
    background: rgba(255, 255, 255, 0.3);
    box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.3);
}

.btn {
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    background: #ff5f6d; /* Gradient button color */
    background: linear-gradient(to right, #ff5f6d, #ffc371);
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn:hover {
    box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.2);
    transform: translateY(-2px);
}


        </style>
    </head>
    <body>
        <div class="container">
            <form method="post" action="">
                
                <div class="input-group">
                    <input type="text" placeholder="Username" name="username" required>
                </div>
                <div class="input-group">
                    <input type="email" placeholder="Email" name="email" required>
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
            </form>
        </div>
    </body>
    </html>