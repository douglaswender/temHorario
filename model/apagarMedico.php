<?php

include '../model/conn.php';

session_start();

$id = $_GET['idMedico'];

$query = "DELETE FROM medico WHERE idMedico=$id";



 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Apagando médico...</title>
  </head>
  <body>
    <?php
    mysql_query($query) or die ("Erro ao deletar médico! ".mysql_error());
    header("Location: ../admin.php");
     ?>
  </body>
</html>
