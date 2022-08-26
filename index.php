<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("config.php");
session_start();
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // username and password sent from form 

  $myusername = $_POST['usuario'];
  $mypassword = md5($_POST['password']);

  $sql = "SELECT id_login FROM login WHERE nombre = '$myusername' and contrasena = '$mypassword'";
  $result = mysqli_query($db, $sql);
  //$row = mysqli_fetch_assoc($result);
  //$active = $row['active'];

  $count = mysqli_num_rows($result);

  // If result matched $myusername and $mypassword, table row must be 1 row

  if ($count == 1) {
    //session_register("myusername");
    $_SESSION['login_user'] = $myusername;

    header("location: subirTesis.php");
  } else {
    $error = "Your Login Name or Password is invalid";
  }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <title>Iniciar Sesión</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style type="text/css">
    body {
      margin: 0;
      padding: 0;
      height: 100%;

    }

    .input {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 300px;
      padding: 30px;
      background: rgba(145, 147, 162, 0.8);

    }

    .input .inputbox {
      position: relative;
    }

    .input .inputbox input {
      width: 100%;
      padding: 10px 0;
      font-size: 14px;
      color: #fff;
      margin-bottom: 30px;
      border: none;
      border-bottom: 1px solid #fff;
      outline: transparent;
      background: transparent;
    }

    .input .inputbox label {
      position: absolute;
      top: 0;
      left: 0;
      padding: 10px 0;
      font-size: 14px;
      color: #fff;
      pointer-events: none;
      transition: .3s;
    }

    .input .inputbox input:focus~label,
    .input .inputbox input:valid~label {
      top: -18px;
      left: 0;
      color: #fff;
      font-size: 12px;
    }

    .input input[type="submit"] {
      background: none;
      border: none;
      outline: none;
      color: #fff;
      padding: 6px 70px;

      cursor: pointer;
    }

    .center {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 50%;
    }

    img.fondo {
      min-height: 100%;
      max-width: 100%;
      min-width: auto;
      width: 100%;
      height: auto;
      position: fixed;
      top: 0;
      left: 0;
      filter: blur(3px);
    }
  </style>
</head>

<img src="fondo.jpg" alt="bckgound" class="fondo" />

<body>

  <div class="fondo"></div>
  <div class="input">
    <form action="" method="post">
      <img src="logo.png" height="85px" width="190px" align="middle" alt="Universidad de Navojoa" class="center">
      <div class="inputbox">
        <input type="text" name="usuario" required="">
        <label>Usuario</label>
      </div>
      <div class="inputbox">
        <input type="password" name="password" required="">
        <label>Contraseña</label>
      </div>
      <input type="submit" name="" value="Iniciar Sesión">
    </form>
  </div>

</body>

</html>