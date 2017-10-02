<?php
//aaaaaaaaaaaaaaaaaaa
include '../model/conn.php';

session_start();

$idClinica = $_POST['nomeClinica'];
$idMedico = $_POST['nomeMedico'];
$dataConsulta = $_POST['dataConsulta'];
$horaConsulta = $_POST['horario'];
$idPaciente = $_SESSION['idPaciente'];

//verificando se não existe consulta para esse horário:

$sql1 = "SELECT * FROM consulta a WHERE a.dataConsulta='$dataConsulta' and a.idHorario = $horaConsulta";

$result = mysql_query($sql1) or die ("ERROW");

$numrow = mysql_num_rows($result);

$sql = "INSERT INTO consulta (idClinica, idMedico, dataConsulta, idHorario, idPaciente) VALUES ($idClinica, $idMedico, '$dataConsulta', $horaConsulta, $idPaciente)";

?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <script type="text/javascript">
     function sussesfully() {
        window.location='../painel.php';
       alert("Agenda cadastrada com sucesso!");
       //window.location='painel.php';

     }
     function erro() {
       window.location='painel.php';
       alert("Já existe consulta agendada para este horário neste dia!");

     }

     </script>
     <title>Salvando dados...</title>
   </head>
   <body>
     <?php
     if($numrow>0){
       //echo "";
       echo "<script>erro()</script>";
     }else {
       mysql_query($sql) or die (mysql_error($sql));
      //  echo "$idClinica\n";
      //  echo "$idMedico\n";
      //  echo "$dataConsulta\n";
      //  echo "$horaConsulta\n";
      //  echo "$idPaciente\n";
       echo "<script>sussesfully()</script>";
     }

      //header ('location: painel.php');
     ?>
   </body>
 </html>
