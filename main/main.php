<?php
session_start();
if (!isset($_SESSION['session_username'])) {
    header("location:login.php");
    exit();
}
// print_r($_SESSION);
// print_r($_COOKIE); ?>

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
                    <li><a href="#">Profil</a></li>
                    <li><a href="#">Riwayat</a></li>
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
            <form action="" method="POST">
                <div class="presensi">
                    <label>
                        <input type="radio" name="presensi" value="hadir" placeholder=" ">Hadir
                    </label>
                    <label>
                        <input type="radio" name="presensi" value="sakit" placeholder=" ">Sakit
                    </label>
                    <label>
                        <input type="radio" name="presensi" value="izin" placeholder=" ">Izin
                    </label>
                    <label>
                        <input type="radio" name="presensi" value="alpha" placeholder=" ">Alpha
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