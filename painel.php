<?php
include 'conn.php';
require 'seguranca.php';

session_start();

if ($_SESSION['tipo'] != "user") {
  header("Location: admin.php");
  echo "<script></script>";
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Usuário</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  <script type="text/javascript">
  function restart() {
    window.location = 'painel.php';
  }
  function change(i) {
    return window.location = 'painel.php?idClinica='+i;
  }
  function changeMedico(j){
    var url = window.location.href;

    url += '&idMedico='+j;
    window.location = url;
  }
  function changeData() {

    var url = window.location.href;
    var data = document.getElementById('dataConsulta').value;

    url += '&dataConsulta='+data;
    window.location = url;
  }
  function setData(k) {
    document.getElementById('dataConsulta').value = '2017-09-09';
  }
  function selecionarOsCampos() {
    alert("Por favor, preencha os campos acima!");
    document.getElementById('dataConsulta').value= 'aaaa-mm-dd';
  }
  function dataInvalida() {
    alert("Esta data deve ser maior que o dia atual!");
  }
  function apagar(id) {

    var op = confirm("Você deseja excluir este médico?");
    if(op){
      location.href='model/cancelarHorario.php?idConsulta='+id;
    }else{
      alert("Ufaaa! Quase deletou sem querer...");
    }

  }

  </script>
  <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
  <?php
  include '/view/headerLogged.php';
  ?>
  <div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="">
        <h3><?php echo "Veja suas próximas consultas: "; ?></h3>
      </div>
      <div class="col">
        <table class="table">
          <thead>
            <tr>
              <th>Dia</th>
              <th>Hora</th>
              <th>Médico</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $idPaciente = $_SESSION['idPaciente'];
            $dataAtual = date('Y-m-d');
            $result = mysql_query("SELECT a.idConsulta, a.dataConsulta, d.horaInicio, c.nomeMedico FROM consulta a INNER JOIN paciente b on a.idPaciente = b.idPaciente INNER JOIN medico c on a.idMedico = c.idMedico inner join horario d on a.idHorario = d.idHorario WHERE b.idPaciente = $idPaciente and a.dataConsulta >= '$dataAtual' ORDER by a.dataConsulta asc, d.horaInicio asc");
            $numrows = mysql_num_rows($result);

            if ($numrows==0) {

              echo "<tr>";
              //echo "<h1>Parece que você não possui nenhuma consulta agendada, está precisando? Agende!</h1>";
              //echo "<td></td>";
              echo "<td colspan='3'>Parece que você não possui nenhuma consulta agendada, está precisando? Agende!</td>";
              echo "</tr>";
            }else {
                while ($linha = mysql_fetch_array($result)) {
                echo "<tr>";
                echo "<td>".date('d/m/Y', strtotime($linha['dataConsulta']))."</td>";
                echo "<td>".$linha['horaInicio']."</td>";
                echo "<td>".$linha['nomeMedico']."</td>";
                echo '<td>'.'<button type="button" class="btn btn-danger" onclick="apagar('.$linha['idConsulta'].')">Cancelar Consulta</button></td>';
                echo "</tr>";
                  # code...
              }
            }



             ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col">
      <h2>Criar nova consulta:</h2>
      <form name="selecao" method="post" action="../temHorario/model/salvarAgenda.php">
        <div class="form-group">
          <label for="Clinica">Selecione a clinica:</label>

          <select class="form-control form-control-sm" id="nomeClinica" name="nomeClinica" onchange="change(this.value)">

            <option value="">Escolha a Clínica</option>
            <?php
            if (isset($_GET['idClinica'])) {
              $sql = "SELECT * FROM clinica";
              $result = mysql_query($sql);
              $query = "SELECT * FROM clinica WHERE idClinica = ".$_GET['idClinica'];
              $result1 = mysql_query($query);
              $teste = mysql_fetch_array($result1);

              while ($linha = mysql_fetch_array($result)) {
                if ($linha['idClinica']==$teste['idClinica']) {
                  echo '<option value="'.$linha['idClinica'].'" selected>'.$linha['nomeClinica'].'</option>';
                }else{
                  echo '<option value="'.$linha['idClinica'].'">'.$linha['nomeClinica'].'</option>';
                }


              }
              //echo '<option value="'.$_GET['idClinica'].'"></option>';
            }else{
              $sql = "SELECT * FROM clinica";
              $result = mysql_query($sql);

              while ($linha = mysql_fetch_array($result)) {
                echo '<option value="'.$linha['idClinica'].'">'.$linha['nomeClinica'].'</option>';

              }
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="">Selecione o médico:</label>
          <select class="form-control form-control-sm" name="nomeMedico" onchange="changeMedico(this.value)">
            <option value="">Escolha o médico</option>
            <?php
            if (isset($_GET['idClinica'])) {
              $query = "SELECT * FROM medico a inner join medico_clinica b on a.idMedico = b.idMedico inner join clinica c on b.idClinica = c.idClinica WHERE c.idClinica = ".$_GET['idClinica'];
              $result = mysql_query($query);
              $teste = mysql_fetch_array(mysql_query("SELECT * FROM medico a inner join medico_clinica b on a.idMedico = b.idMedico inner join clinica c on b.idClinica = c.idClinica WHERE c.idClinica = ".$_GET['idClinica']." and a.idMedico = ".$_GET['idMedico']));

              while ($linha = mysql_fetch_array($result)) {
                if ($linha['idMedico']==$teste['idMedico']) {
                  echo '<option value="'.$linha['idMedico'].'" selected>'.$linha['nomeMedico'].'</option>';
                }else{
                  echo '<option value="'.$linha['idMedico'].'">'.$linha['nomeMedico'].'</option>';
                }
              }

            }

            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="">Selecione a data:</label>
          <div class="form-control">
            <?php
            if (isset($_GET['dataConsulta'])) {
              if ($_GET['dataConsulta']<$dataAtual) {
                echo "<script>dataInvalida()</script>";
                echo '<input type="date" class="date" name="dataConsulta" id="dataConsulta" value="aaaa-mm-dd" onchange="changeData()">';
              }else{
                echo '<input type="date" class="date" name="dataConsulta" id="dataConsulta" value="'.$_GET['dataConsulta'].'" onchange="changeData()">';
              }
            }
            else if (!isset($_GET['idClinica'])) {
              echo '<input type="date" class="date" name="dataConsulta" id="dataConsulta" value="" onchange="selecionarOsCampos()">';
            }
            else{
              echo '<input type="date" class="date" name="dataConsulta" id="dataConsulta" value="" onchange="changeData()">';
            }

            ?>
          </div>

        </div>
        <div class="form-group">
          <label for="">Selecione o horário:</label>
          <select class="form-control form-control-sm" name="horario">
            <option value="">Escolha o horário</option>
            <?php
            if (isset($_GET['idMedico'])&&isset($_GET['dataConsulta'])) {
              $idMedico = $_GET['idMedico'];
              $data = $_GET['dataConsulta'];
              $query = "SELECT * FROM horario ORDER BY horaInicio ";
              $result = mysql_query($query);

              while ($linha = mysql_fetch_array($result)) {
                echo '<option value="'.$linha['idHorario'].'">'.$linha['horaInicio'].'</option>';
              }

            }

            ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Adicionar!</button>
      </form>
    </div>
  </div>
</div>
</body>
</html>
