<?php
session_start();

//atur koneksi ke database
$host_db    = "localhost";
$user_db    = "root";
$pass_db    = "";
$nama_db    = "presensi";
$koneksi    = mysqli_connect($host_db, $user_db, $pass_db, $nama_db);

//atur variabel
$err        = "";
$username   = "";

if (isset($_COOKIE['cookie_username'])) {
    $cookie_username = $_COOKIE['cookie_username'];
    $cookie_password = $_COOKIE['cookie_password'];

    echo $cookie_username;
    echo $cookie_password;

    $sql1 = "select * from tb_siswa where id_siswa = '$cookie_username'";
    $q1   = mysqli_query($koneksi, $sql1);
    $r1   = mysqli_fetch_array($q1);

    $sql2 = "select * from tb_guru where id_guru = '$cookie_username'";
    $q2   = mysqli_query($koneksi, $sql2);
    $r2   = mysqli_fetch_array($q2);

    if ($r1['pw_siswa'] == $cookie_password && $r1['id_siswa'] == $cookie_username) {
        $_SESSION['session_username'] = $cookie_username;
        $_SESSION['session_password'] = $cookie_password;
        $_SESSION['session_account'] = "Siswa";
    } elseif ($r2['pw_guru'] == $cookie_password && $r2['id_guru'] == $cookie_username) {
        $_SESSION['session_username'] = $cookie_username;
        $_SESSION['session_password'] = $cookie_password;
        $_SESSION['session_account'] = "Guru";
    }
}

if (isset($_SESSION['session_username'])) {
    header("location:./main/main.php");
    exit();
}

if (isset($_POST['submitBtn'])) {
    $username   = $_POST['username'];
    $password   = $_POST['password'];

    if ($username == '' or $password == '') {
        $err .= "<li>Silakan masukkan username dan juga password.</li>";
    } else {
        $sql1 = "select * from tb_siswa where id_siswa = '$username'";
        $q1   = mysqli_query($koneksi, $sql1);
        $r1   = mysqli_fetch_array($q1);

        $sql2 = "select * from tb_guru where id_guru = '$username'";
        $q2   = mysqli_query($koneksi, $sql2);
        $r2   = mysqli_fetch_array($q2);

        $na = 1;
        if (empty($r1['id_siswa'])) {
            if (empty($r2['id_guru'])) {
                $err .= "Username <b>$username</b> tidak tersedia.";
            } else {
                $na = 2;
            }
        } elseif ($r1['pw_siswa'] != md5($password)) {
            if ($r2['pw_guru'] != md5($password)) {
                $err .= "Password yang dimasukkan tidak sesuai.";
            }
        }

        if (empty($err)) {
            $_SESSION['session_username'] = $username; //server
            $_SESSION['session_password'] = md5($password);
            
            if ($na == 1) {
                $_SESSION['session_account'] = "Siswa";
            } elseif($na == 2) {
                $_SESSION['session_account'] = "Guru";
            }

            $cookie_name = "cookie_username";
            $cookie_value = $username;
            $cookie_time = time() + (60 * 60 * 2);
            setcookie($cookie_name, $cookie_value, $cookie_time, "/");

            $cookie_name = "cookie_password";
            $cookie_value = md5($password);
            $cookie_time = time() + (60 * 60 * 2);
            setcookie($cookie_name, $cookie_value, $cookie_time, "/");

            // $cookie_name = "cookie_account";
            // $cookie_value = $_SESSION['session_account'];
            // $cookie_time = time() + (60 * 60 * 2);
            // setcookie($cookie_name, $cookie_value, $cookie_time, "/");

            header("location:./main/main.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="./assets/logo-all.png">
            </div>
            <div class="title">
                <h1>Sistem Informasi Presensi</h1>
            </div>
        </div>
        <div class="loginBox">
            <form action="" method="POST">
                <div class="loginTitle">
                    <h2>Login</h2>
                </div>
                <div class="userBox">
                    <input id="formUser" type="text" name="username" class="inputUser" placeholder=" ">
                    <label for="formUser" class="inputUserLabel">Username</label>
                </div>
                <div class="pwBox">
                    <input id="formPw" type="password" name="password" class="inputPw" placeholder=" ">
                    <label for="formPw" class="inputPwLabel">Password</label>
                </div>
                <input type="submit" name="submitBtn" value="Submit" class="submitBtn" />
            </form>
        </div>
    </div>
    <?php if ($err) { ?>
        <div id="login-alert" class="alert">
            <ul><?php echo $err ?></ul>
        </div>
    <?php } ?>
</body>

</html>