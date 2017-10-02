<?php
include 'conn.php';
session_start();

$id = $_GET['idMedico'];

$query = "SELECT a.disponivel, a.horaInicio, b.nomeMedico, b.especialidade FROM horario as a inner join medico as b on a.idMedico=b.idMedico inner join diassemana as c  ON a.idDia = c.idDia where b.idMedico=$id ORDER BY c.idDia, a.horaInicio";

$sql = mysql_query($query);

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Horarios Disponíveis</title>
    <script type="text/javascript">
      function inserirHorario(){
        window.location="inserirHorario.php";
      }
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </head>
  <body>
    <?php
      include 'headerLogged.php';
     ?>
     <div class="container-fluid">
       <div class="row">
         <div class="col-12">
           <div class="">
             <h3>Confira os horários que você irá trabalhar:</h3>
           </div>
           <div class="table">
             <table>
               <thead>
                 <tr>
                   <td>Disponível</td>
                   <td>Hora Consulta</td>
                   <td class="float-right">Ação</td>
                 </tr>
               </thead>
               <tbody>
                 <?php
                 while ($linha = mysql_fetch_assoc($sql)) {
                   echo "<tr>";
                   if($linha['disponivel']==1){
                     echo "<td><input type='checkbox' checked></td>";
                   }else{
                     echo "<td><input type='checkbox' ></td>";
                   }
                   echo "<td>".$linha['horaInicio']."</td>";
                   echo "<td><button class="."'btn btn-primary'".">Editar</button>  <a href='horariodisponivel.php?idMedico=".$linhas['idMedico']."'><button class="."'btn btn-success'".">Visualizar</button></a>  <button class="."'btn btn-danger'".">Apagar</button></td>";
                   echo "</tr>";
                 }
                  ?>
               </tbody>
                <!-- <tr>
                  <td><input type="" name="" value=""></td>
                  <td><button type="button" name="button" onclick="inserirHorario();">Inserir novo horário</button></td>
                </tr> -->
             </table>
           </div>
         </div>
       </div>

     </div>

  </body>
</html>
