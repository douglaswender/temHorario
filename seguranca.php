<?php
include 'conn.php';
session_start();
$idUsuario = $_SESSION['idUsuario'];
$user = "user";
$admin = "admin";
$url = $_SERVER['REQUEST_URI'];

if (!isset($_SESSION['login'])&&(!isset($_SESSION['tipo']))) {
  //  if (($url == "temHorario/painel.php")&&($_SESSION['tipo']=="admin")) {
  //    header("Location: admin.php");
  //  }elseif (($url == "temHorario/admin.php")&&($_SESSION['tipo']=="user")) {
  //   header("Location: painel.php");
  //    //echo '<meta HTTP-EQUIV="Refresh" CONTENT="1000; URL=admin.php">';
  //    //echo "DEVO IR PARA O ADMIN pq o usuario é = ".$_SESSION['tipo']." e não é = ".$admin." URL= ".$url;
  //  }
  session_destroy();
  header("Location: index.php");
  exit;
 }


 ?>
