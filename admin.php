<?php
session_start();
require 'seguranca.php';
include 'conn.php';

$nomeClinica = $_SESSION['nomeClinica'];
$ide = $_SESSION['idClinica'];
 ?>

<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $nomeClinica; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script type="text/javascript">

    function apagar(id) {

      var op = confirm("Você deseja excluir este médico?");
      if(op){
        location.href='model/apagarMedico.php?idMedico='+id;
      }else{
        alert("Ufaaa! Quase deletou sem querer...");
      }

    }

    </script>
  </head>
  <body>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js"></script>
    <?php include '/view/headerLogged.php'; ?>
    <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <div class="">
          <h2>Os seus médicos:</h2>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Especialidade</th>
              <th class="float-center">Ação</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $idClinica = $_SESSION['idClinica'];
            $resultado = mysql_query("SELECT b.idMedico, b.nomeMedico, b.especialidade from medico as b inner join medico_clinica a on a.idMedico = b.idMEdico inner join clinica as c on c.idClinica = a.idClinica WHERE c.idClinica=$idClinica");
            if(mysql_numrows($resultado)!=0){
              while ($linhas = mysql_fetch_array($resultado)) {
                # code...
                echo "<tr>";
                echo "<td>".$linhas['nomeMedico']."</td>";
                echo "<td>".$linhas['especialidade']."</td>";
                echo "<td class=".''."><a href='controller/editarMedico.php?idMedico=".$linhas['idMedico']."'><button class="."'btn btn-primary'".">Editar</button></a>  <a href='controller/visualizarMedico.php?idMedico=".$linhas['idMedico']."'><button class="."'btn btn-success'".">Visualizar</button></a>  <button onClick="."apagar(".$linhas['idMedico'].")"." class="."'btn btn-danger'".">Apagar</button></td>";
                echo "</tr>";
              }
            }else{
              echo "<tr>";
              //echo "<h1>Parece que você não possui nenhuma consulta agendada, está precisando? Agende!</h1>";
              //echo "<td></td>";
              echo "<td colspan='3'>Parece que você não possui nenhum médico, adicione já!</td>";
              echo "</tr>";
            }

             ?>
          </tbody>
        </table>
      </div>
        <div class="col-6">
          <div class="form-group">
            <h3>Adicionar novo médico a sua clínica:</h3>

              <form class="" action="cadastroMedico.php?idClinica=<?php echo "$idClinica"; ?>" method="post">
                <div class="form-group">
                  <div class="">
                    <label for="nomeMedico">Nome:</label>
                    <input type="text" class="form-control" name="nomeMedico" value="" required>
                  </div>

                <label for="">CRM:</label>
                <input type="text" class="form-control" name="crm" value="" required>
                <label for="">Especialidade:</label>
                <input type="text" class="form-control" name="especialidade" value="">
                </div>
                <input type="submit" name="cadastrar" value="Cadastrar!" class="btn btn-primary">
              </form>
          </div>

        </div>
    </div>
</div>
  </body>
</html>
