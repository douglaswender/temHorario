<?php
include 'conn.php';

$nomeMedico = $_POST['nomeMedico'];
$crm = $_POST['crm'];
$especialidade = $_POST['especialidade'];
$idClinica = $_GET['idClinica'];



 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    $sql = "INSERT INTO medico (nomeMedico, crm, especialidade) VALUES ('$nomeMedico', '$crm', '$especialidade')";
    $rs = mysql_query($sql) or die("Erro na inserção contate os administradores do sistema! Erro --> ".mysql_error());
    $idrs = mysql_insert_id();

    mysql_query("INSERT INTO medico_clinica VALUES ($idClinica, $idrs)") or die("Erro na inserção, contate os administradores! Erro --> ".mysql_error());

    //echo "$idrs";

    header("Location: admin.php");
     ?>
  </body>
</html>
