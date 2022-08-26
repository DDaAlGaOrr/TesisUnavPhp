<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select nombre from login where nombre = '$user_check' ");
   
   //$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $row = $row = mysqli_fetch_assoc($ses_sql);
   
   $login_session = $row['nombre'];
   
   if(!isset($_SESSION['login_user'])){
      header("location: index.php");
      die();
   }
?>