<?php

function convert($segundos){
  $horas = floor($segundos / 3600);
  $minutos = floor($segundos%3600/60);
  $segundos = $segundos%60;

  return sprintf("%d:%d:%d", $horas,$minutos,$segundos);
}

include '../model/conn.php';

session_start();

$idMedico = $_POST['idMedico'];

mysql_query("DELETE FROM horario WHERE idMedico=$idMedico") or die("Erro sql".mysql_error());


$hInicial = $_POST['hInicial'];
$nConsulta = $_POST['nConsulta'];
$tConsulta = $_POST['tConsulta'];

$total = 0;
$totals = 0;
$hFinal;

//total de segundos da hora final
list($horas, $minutos) = explode(":", $nConsulta);
$hFinal= $horas*3600 + $minutos*60;

//Total de segundos que tem o tempo da consulta:
list($horas, $minutos, $segundos) = explode(":", $tConsulta);
$totals = $horas*3600 + $minutos*60 + $segundos;

//Total de segundos da hora inicial
list($horas, $minutos) = explode(":", $hInicial);
$hIni= $horas*3600 + $minutos*60;

for ($hIni; $hIni < $hFinal; $hIni+=$totals) {
  $hIniciali=convert($hIni);
  mysql_query("INSERT INTO horario (horaInicio, disponivel, idMedico) VALUES ('$hIniciali', '1', $idMedico)") or die("Erro ".mysql_error());
  //echo "$hInicial, $nConsulta, $tConsulta, $idMedico\n";
}

//echo "$hInicial, $nConsulta, $tConsulta, $idMedico\n";

header("Location: visualizarMedico.php?idMedico=$idMedico");
 ?>
