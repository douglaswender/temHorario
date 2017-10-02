<?php
include 'conn.php';

$idHorario=$_GET['idHorario'];

$query = mysql_query("SELECT * FROM horario WHERE idHorario=$idHorario");

$result = mysql_result($query, 0, 'disponivel');

$idMedico = mysql_result($query, 0, 'idMedico');

if($result==0){
  mysql_query("UPDATE horario SET disponivel=1 WHERE idHorario=$idHorario");
}
else {
  mysql_query("UPDATE horario SET disponivel=0 WHERE idHorario=$idHorario");
}

header("location: ../controller/visualizarMedico.php?idMedico=$idMedico");
 ?>
