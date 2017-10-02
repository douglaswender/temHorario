<?php

include 'conn.php';

$id = $_POST['idMedico'];
$nome=$_POST['nomeMedico'];
$crm=$_POST['crm'];
$especialidade=$_POST['especialidade'];

$query = "UPDATE medico SET nomeMedico='$nome', crm='$crm', especialidade='$especialidade' WHERE idMedico=$id";




 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Editando médico...</title>
     <script type="text/javascript">
     function sucesso() {
       alert("Editado com sucesso!");
       window.location="../admin.php";
     }

     </script>
   </head>
   <body>
     <?php
     mysql_query($query) or die("Erro no banco --->".mysql_error());
     echo "<script>sucesso()</script>";
      ?>
   </body>
 </html>
