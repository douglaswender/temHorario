<?php

include '../model/conn.php';

session_start();

$id = $_GET['idConsulta'];

$query = "DELETE FROM consulta WHERE idConsulta=$id";

mysql_query($query) or die("Erro: ".mysql_error());

header("Location:../controller/visualizarMedico.php?idMedico=$id");
 ?>
