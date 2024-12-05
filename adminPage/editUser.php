<?php
include '../config.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; 
    $cpassword = $_POST['cpassword']; 

    if ($password == $cpassword) {

        // $hashpass = hash('sha256', $_POST['password']);

        $select_sql = "SELECT * FROM pengguna WHERE email='$email' where id = $id";
        $result_select = mysqli_query($conn, $select_sql);

        if ($result_select && !$result_select->num_rows > 0) {
            $sql = "UPDATE pengguna SET username = '$username', email = '$email', password = '$password' where id = $id";
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

$sqlPengguna = "SELECT * FROM pengguna where id = $id";
$penggunaresult = mysqli_query($conn,$sqlPengguna);
$resultP = mysqli_fetch_assoc($penggunaresult);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
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
<div class="container">
            <form method="post" action="">    
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $resultP['username'] ?>" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $resultP['email'] ?>" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo $resultP['password'] ?>"  required>
                </div>
                <button name="submit"  class="btn-primary">Update</button>
                <div class="mt-3">
                <a href="admin.php" class="btn btn-primary" >Cencel</a>
                </div>
            </form>
        </div>
</body>
</html>