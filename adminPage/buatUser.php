<?php
    include '../config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password']; 
        $cpassword = $_POST['cpassword']; 

        if ($password == $cpassword) {

            // $hashpass = hash('sha256', $_POST['password']);

            $select_sql = "SELECT * FROM pengguna WHERE email='$email'";
            $result_select = mysqli_query($conn, $select_sql);

            if ($result_select && !$result_select->num_rows > 0) {
                $sql = "INSERT INTO pengguna (username, email, password,role) VALUES ('$username', '$email', '$cpassword','user')";
                $result = mysqli_query($conn, $sql);
                // $noHash = "INSERT INTO passNoHash(password) VALUES($password)";
                // $resul = mysqli_query($conn,$noHash);
                if ($result) {
                    echo "<script>alert('Selamat, pendaftaran berhasil!')</script>";
                    header('Location: admin.php');
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
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    color: var(--text-color);
    line-height: 1.6;
}

.container {
    background-color: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    padding: 2rem;
    width: 100%;
    max-width: 400px;
    transition: all var(--transition-speed) ease;
    animation: fadeIn 0.5s ease-out;
}

.container:hover {
    box-shadow: 0 15px 40px rgba(0,0,0,0.12);
    transform: translateY(-10px);
}

form {
    display: flex;
    flex-direction: column;
}

.input-group {
    margin-bottom: 1rem;
}

.input-group input {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: 8px;
    font-size: 1rem;
    transition: all var(--transition-speed) ease;
}

.input-group input:focus {
    outline: none;
    border-color: var(--light-color);
    box-shadow: 0 0 0 2px rgba(233, 69, 96, 0.2);
}

.input-group .btn {
    width: 100%;
    padding: 12px;
    background-color: var(--light-color);
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all var(--transition-speed) ease;
}

.input-group .btn:hover {
    background-color: var(--accent-color);
    transform: translateY(-3px);
}

/* Animations */
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

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        width: 90%;
        margin: 0 10px;
    }
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