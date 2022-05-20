<?php
session_start();
if (!isset($_SESSION['session_username'])) {
    header("location:../index.php");
    exit();
}
$ja = $_SESSION['session_account'];

$username = $_SESSION['session_username'];
$host_db    = "localhost";
$user_db    = "root";
$pass_db    = "";
$nama_db    = "presensi";
$koneksi = mysqli_connect($host_db, $user_db, $pass_db, $nama_db);
if (mysqli_connect_errno()) {
    $alert = "Koneksi database gagal : " . mysqli_connect_error();
}

if (isset($_POST['insertBtn'])) {
    $directory = "../berkas/";
    $tgl_presensi = date("Y-m-d");
    $status = $_POST['status'];
    $valid = "NY";
    $file_name = basename($_FILES['bukti']['name']);
    move_uploaded_file($_FILES['bukti']['tmp_name'], $directory . $file_name);
    if ($ja == "Siswa") {
        mysqli_query($koneksi, "insert into presensi_siswa values('','$username','$tgl_presensi','$status','$valid','$file_name')");
        $alert = "Presensi berhasil dilakukan";
    } elseif ($ja == "Guru") {
        mysqli_query($koneksi, "insert into presensi_guru values('','$username','$tgl_presensi','$status','$valid','$file_name')");
        $alert = "Presensi berhasil dilakukan";
    } else {
        $alert = "Presensi tidak berhasil dilakukan";
    }
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
                <img class="ic_dd" src="../assets/dropdown.png">
                <div class="hoveran"></div>
                <ul class="dropdownList">
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
                <div class="icon">
                    <img src="../assets/ic_calendar_today_black_24dp.png">
                    <h5>Hari & Tanggal</h5>
                </div>
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
                    <h3>Bukti Presensi</h3>
                    <input type="file" name="bukti" accept="image/*">
                </div>
                <div class="submit">
                    <input type="submit" name="insertBtn" value="Submit" class="insertBtn" />
                </div>
            </form>
            <div>
                <h3>
                    <?php
                    if (isset($alert)) {
                        echo $alert;
                    }
                    ?>
                </h3>
            </div>
        </div>
    </div>
</body>

</html>