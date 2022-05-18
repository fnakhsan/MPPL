<?php
session_start();
if (!isset($_SESSION['session_username'])) {
    header("location:login.php");
    exit();
}
$username = $_SESSION['session_username'];
// print_r($_SESSION);
// print_r($_COOKIE); 
$host_db    = "localhost";
$user_db    = "root";
$pass_db    = "";
$nama_db    = "presensi";
$koneksi = mysqli_connect($host_db, $user_db, $pass_db, $nama_db);

if(isset($_POST['submitBtn'])){
    $directory = "../berkas/";
    $tgl_presensi = date("d-M-Y");
    $status = $_POST['status'];
    $valid = "NY";
    $file_name = basename($_FILES['bukti']['name']);
    move_uploaded_file($_FILES['bukti']['tmp_name'], $directory.$file_name);
    mysqli_query($koneksi, "insert into presensi_siswa values('','$username','$tgl_presensi','$status','$valid','$file_name') where id_siswa = '$username'");
    echo "file berhasil di upload";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="../assets/logo-all.png">
            </div>
            <div class="title">
                <h1>Sistem Informasi Presensi</h1>
            </div>
            <div class="avatar">
                <img src="../assets/ic_profile.png">
            </div>
            <div class="dropdown">
                <a href="#" id="rect"><img src="../assets/dropdown.png"></a>
                <input type="checkbox" id="btn-1">
                <ul>
                    <li><a href="../profile/profile.php">Profil</a></li>
                    <li><a href="../history/history.php">Riwayat</a></li>
                    <li><a href="../logout/logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="main">
            <div class="title">
                <h2>Presensi</h2>
            </div>
            <div class="today">
                <h3><?php
                    $date = date("l, d M Y");
                    echo "$date";
                    ?></h3>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="presensi">
                    <label>
                        <input type="radio" name="status" value="hadir" placeholder=" ">Hadir
                    </label>
                    <label>
                        <input type="radio" name="status" value="sakit" placeholder=" ">Sakit
                    </label>
                    <label>
                        <input type="radio" name="status" value="izin" placeholder=" ">Izin
                    </label>
                    <label>
                        <input type="radio" name="status" value="alpha" placeholder=" ">Alpha
                    </label>
                </div>
                <div class="file">
                    <input type="file" name="bukti" accept="image/*">
                </div>
                <input type="submit" name="submitBtn" value="Submit" class="submitBtn" />
            </form>
        </div>
    </div>
</body>

</html>