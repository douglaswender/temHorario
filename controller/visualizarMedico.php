<?php

include '../model/conn.php';

session_start();

$id = $_GET['idMedico'];

$dataAtual = date('Y-m-d');

$sql = mysql_query("SELECT * FROM medico WHERE idMedico=$id");

$horario = mysql_query("SELECT * FROM horario WHERE idMedico=$id") or die("Erro ao relizar pesquisa no horário!");

$nr = mysql_numrows($horario);

$query = "SELECT * from consulta a inner join paciente b on a.idPaciente=b.idPaciente inner join medico c on a.idMedico = c.idMedico inner join horario d on d.idHorario = a.idHorario WHERE a.idMedico=$id and a.dataConsulta >= '$dataAtual' ORDER BY a.dataConsulta, d.horaInicio";

$result = mysql_query($query);

$nomeMedico = mysql_result($sql, 0, 'nomeMedico');

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Médico</title>
  <script type="text/javascript">
  function apagar(id) {

    var op = confirm("Você deseja excluir esta consulta?");
    if(op){
      location.href='../model/apagarConsulta.php?idConsulta='+id;
    }else{
      alert("Ufaaa! Quase deletou sem querer...");
    }

  }
  function sair() {
    location.href='../logout.php';
  }
  function goto() {
    document.formulario.submit();
  }
  function change(id) {
    location.href='../model/alteraHorario.php?idHorario='+id;
    }
  </script>
  <link rel="stylesheet" href="../css/bootstrap.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="../index.php">Tem Horário</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <?php if (isset($_SESSION['nomeClinica'])) {?>
            <a class="nav-link" href="../admin.php">Painel<span class="sr-only"></span></a>
            <?php
          }else {?>
            <a class="nav-link" href="../painel.php">Painel<span class="sr-only"></span></a>
            <?php
          } ?>

        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contato</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Informações</a>
        </li>
      </ul>
      <ul class="navbar-nav navbar-right">
        <li class="navbar-brand">Olá <?php if (isset($_SESSION['nomeClinica'])) {
          echo $_SESSION['nomeClinica'];
        }else {
          echo $_SESSION['nomePaciente'];
        } ?></li>
        <li class="nav-item"><button type="button" onclick="sair()" name="button" class="btn btn-danger">Sair</button></li>
      </ul>
    </form>
  </div>
</nav>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      <div class="row">
        <div class="col">
          <?php
          if ($nr!=0) {
            echo "<table class='table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Horário</th>";
            echo "<th>Disponível</th>";
            echo "<tr>";
            echo "</thead>";
            echo "<tbody>";
            while($linhas = mysql_fetch_array($horario)){
              echo "<tr>";
              echo "<td>".$linhas['horaInicio']."</td>";
              if ($linhas['disponivel']==1) {
                echo "<td><input id='xxx' name='checkbox' type='checkbox' checked onclick='change(".$linhas['idHorario'].");'>";
              }
              else{
                echo "<td><input id='xxx' name='checkbox' type='checkbox' onclick='change(".$linhas['idHorario'].");'>";
              }
              echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            ?>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              Gerar uma nova agenda!
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Gerar Agenda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <form class="" name="formulario" action="gerarAgenda.php" method="post">
                        <label for="">Qual Horario Final?</label>
                        <input type="time" name="nConsulta" value="" class="form-control">
                        <label for="">Qual Horário Inicial?</label>
                        <input type="time" name="hInicial" value="" class="form-control">
                        <label for="">Qual tempo médio de consulta?</label>
                        <input type="time" name="tConsulta" value="" class="form-control">
                        <input type="hidden" name="idMedico" value="<?php echo "$id"; ?>">
                      </form>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary" onclick="goto()">Salvar</button>
                  </div>
                </div>
              </div>
            </div>
            <?php
          }else{
            ?>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              Gerar uma nova agenda!
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Gerar Agenda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <form class="" name="formulario" action="gerarAgenda.php" method="post">
                        <label for="">Qual horário Final?</label>
                        <input type="time" name="nConsulta" value="" class="form-control">
                        <label for="">Qual Horário Inicial?</label>
                        <input type="time" name="hInicial" value="" class="form-control">
                        <label for="">Qual tempo médio de consulta?</label>
                        <input type="time" name="tConsulta" value="" class="form-control">
                        <input type="hidden" name="idMedico" value="<?php echo "$id"; ?>">
                      </form>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary" onclick="goto()">Salvar</button>
                  </div>
                </div>
              </div>
            </div>
            <?php

          }
          ?>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <h3>Agenda do médico <?php echo "$nomeMedico"; ?></h3>
      <table class="table">
        <thead>
          <tr>
            <td>Paciente</td>
            <td>Data da Consulta</td>
            <td>Horário</td>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($linhas = mysql_fetch_array($result)) {
            # code...
            echo "<tr>";
            echo "<td>".$linhas['nomePaciente']."</td>";
            echo "<td>".$linhas['dataConsulta']."</td>";
            echo "<td>".$linhas['horaInicio']."</td>";
            echo "<td><button onClick="."apagar(".$linhas['idConsulta'].")"." class="."'btn btn-danger'".">Cancelar Consulta</button>";
            echo "</tr>";
          }
          ?>



        </tbody>

      </table>

    </div>
    <div class="col-md-3">

    </div>
  </div>

</div>

</body>
</html>
