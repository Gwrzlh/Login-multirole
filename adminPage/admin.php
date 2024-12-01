<?php
include "../config.php";   
session_start();

$batas = 5;

$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;	


$previous = $halaman - 1;
$next = $halaman + 1;

$nomor = $halaman_awal + 1;

$data = mysqli_query($conn, "SELECT * FROM buku");
$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);

$halamanPengguna = isset($_GET['tablePengguna']) ? (int)$_GET['tablePengguna'] : 1;
$halaman_awalPengguna = ($halamanPengguna > 1) ? ($halamanPengguna * $batas) - $batas : 0;	

$dataPengguna = mysqli_query($conn,"SELECT *FROM pengguna ");
$jumlah_dataPengguna = mysqli_num_rows($dataPengguna);
$total_halamanPengguna = ceil($jumlah_dataPengguna / $batas);


$sqlPengguna = "SELECT * FROM pengguna where role = 'user' LIMIT $halaman_awalPengguna,$batas  ";
$queryPengguna = mysqli_query($conn,$sqlPengguna) ;

// $sqlpassNoHash = "SELECT * FROM passNoHash LIMIT $halaman_awal,$batas";
// $queryNohash = mysqli_query($conn,$sqlpassNoHash);


$sql = "SELECT * FROM buku";
$query = mysqli_query($conn,"select * from buku limit $halaman_awal, $batas");


 
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: ../userPage/berhasil.php");
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
     <link rel="stylesheet" href="../css/admincss.css">
    <title>Login berhasil!</title>
</head>
<body>
<nav class="navbar bg-secondary text-light navbar-expand-lg">
    <div class="container-fluid ">
        <a href="#" class="navbar-brand" onclick="openSidebar()"> <?php echo $_SESSION['username'] ?></a>
      
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
<div class="sidebar" id="sidebar">
  <button class="close-btn" onclick="closeSidebar()"> < </button>
  <form action="../logout.php" method="post" >
            <button type="submit" class="btn btn-minimal">Logout</button>
        </form>
      </form>
</div>
<div class="container mt-4 mb-4">
    <h2 class="m-4">Data Buku</h2>
<table class="table table-striped table-bordered">
       <thead class="thead-dark">
        <tr class="text-center">
          <th>ID</th>
          <th>Judul</th>
          <th>Penerbit</th>
          <th>Pengarang</th>
          <th>tahun terbit</th>
          <th>tanggal di upload</th>
           <th>sinopsis</th>
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
        <td><?php echo $select['date']?></td>
        <td><?php echo $select['sinopsis']?></td>

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
 <nav>
	<ul class="pagination justify-content-center">
			<li class="page-item">
					<a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$Previous'"; } ?>>Previous</a>
				</li>
				<?php 
				for($x=1;$x<=$total_halaman;$x++){
					?> 
					<li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
					<?php
				}
				?>				
				<li class="page-item">
					<a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
				</li>
			</ul>
	    </nav>
</div>

<div class="container mt-4">
    <h1 class="m-3">Data Pengguna</h1>
  <table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr class="text-center">
           <th>Username</th>
           <th>Email</th>
           <th>Role</th>
           <th>password</th>
           <th>action</th>
        </tr>
        <?php 
          while($pengguna = mysqli_fetch_assoc($queryPengguna)){
                // $NoHasa = mysqli_fetch_assoc($queryNohash); 
        ?>
        <tr>
        <td><?php echo $pengguna['username']?></td>
        <td><?php echo $pengguna['email']?></td>
        <td><?php echo $pengguna['role']?></td>
       <td><?php echo $pengguna['password'] ?></td>
       <td>
       <a href="deleteUser.php?id=<?php echo $pengguna['id']; ?>" class="btn btn-outline-secondary btn-sm me-2">Hapus</a>
       <a href="editUser.php?id=<?php echo $pengguna['id']; ?>" class="btn btn-outline-secondary btn-sm me-2">Edit</a>
       </td>
       </tr>
       <?php 
          }
       ?>
    </thead>
  </table>
  <nav>
	<ul class="pagination justify-content-center">
			<li class="page-item">
					<a class="page-link" <?php if($halaman > 1){ echo "href='?tablePengguna=$Previous'"; } ?>>Previous</a>
				</li>
				<?php 
				for($x=1;$x<=$total_halamanPengguna;$x++){
					?> 
					<li class="page-item"><a class="page-link" href="?tablePengguna=<?php echo $x ?>"><?php echo $x; ?></a></li>
					<?php
				}
				?>				
				<li class="page-item">
					<a  class="page-link" <?php if($halaman < $total_halamanPengguna) { echo "href='?tablePengguna=$next'"; } ?>>Next</a>
				</li>
			</ul>
	    </nav>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">

    
</script>

<script>
        function openSidebar() {
            // Ensure the sidebar element exists before trying to modify it
            const sidebar = document.getElementById("sidebar");
            if (sidebar) {
                sidebar.classList.add("active");
            }
        }

        function closeSidebar() {
            // Ensure the sidebar element exists before trying to modify it
            const sidebar = document.getElementById("sidebar");
            if (sidebar) {
                sidebar.classList.remove("active");
            }
        }

        // Optional: Close sidebar when clicking outside
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById("sidebar");
            const navbarBrand = document.querySelector('.navbar-brand');
            
            if (sidebar && sidebar.classList.contains('active') && 
                !sidebar.contains(event.target) && 
                !navbarBrand.contains(event.target)) {
                closeSidebar();
            }
        });
    </script>

</body>
</html>