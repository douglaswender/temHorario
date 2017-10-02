<?php
$hostname = "localhost";
$username = "root";
$password = "123456";
$banco = "temhorario";

$conexao = mysql_connect($hostname, $username, $password)  or die(mysql_error());
mysql_select_db($banco) or die(mysql_error());
?>
