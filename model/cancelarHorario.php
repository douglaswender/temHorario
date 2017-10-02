<?php

include 'conn.php';

$idConsulta = $_GET['idConsulta'];

$sql = "DELETE FROM consulta WHERE idConsulta=".$idConsulta;


 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Deletando dados...</title>
    <script type="text/javascript">
    function sussesfully() {
      alert("Dado excluído com sucesso!");
      window.location = '../painel.php';
    }

    </script>
  </head>
  <body>
    <?php
    //echo "$sql";
    mysql_query($sql);

    echo "<script>sussesfully()</script>";
     ?>
  </body>
</html>
