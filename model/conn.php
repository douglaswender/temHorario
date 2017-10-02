<?php
$hostname = "localhost";
$username = "root";
$password = "123456";
$banco = "temhorario";

//mysql_connect( [$hostname, $username, $password, $new, $flags])

mysql_connect($hostname, $username, $password)  or die("Erro =".mysql_error());
mysql_select_db($banco) or die("Erro-> ".mysql_error());
?>
