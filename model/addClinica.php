<?php

include 'conn.php';

$nomeClinica = $_POST['nomeClinica'];
$cnpj = $_POST['cnpj'];
$login = $_POST['login'];
$senha = $_POST['senha'];

$query = "INSERT INTO usuario (login, senha, tipo) VALUES ('$login', '$senha', 'admin')";
$result = mysql_query($query);
$idresult = mysql_insert_id();

$queryc = "INSERT INTO clinica (nomeClinica, cnpj, idUsuario) VALUES ('$nomeClinica', '$cnpj', $idresult)";
mysql_query($queryc);

header("Location: ../master.php");



 ?>
