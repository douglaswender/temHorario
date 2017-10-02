<?php

include '../conn.php';

session_start();

$id = $_GET['idMedico'];

//echo "$id\n\n";

$query = "SELECT * FROM medico WHERE idMedico = $id";

$result = mysql_query($query) or die("ERRO: ".mysql_error());

$nome = mysql_result($result, 0, 'nomeMedico');
$crm = mysql_result($result, 0, 'crm');
$especialidade = mysql_result($result, 0, 'especialidade');

//echo "$nome, $crm, $especialidade";


 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Editar Médico</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script type="text/javascript">
    function sair() {
      window.location.href='../logout.php';
    }

    </script>
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
      <div class="col-md-4">

      </div>
      <div class="col-md-4">
          <h3>Altere as informações:</h3>
          <form class="" action="../model/editarMedico.php" method="post">
            <div class="form-group">
            <label for="">Nome:</label>
            <input type="text" class="form-control" name="nomeMedico" value="<?php echo "$nome"; ?>">
            </div>
            <div class="form-group">
              <label for="">CRM:</label>
              <input type="text" name="crm" value="<?php echo "$crm"; ?>" class="form-control">
            </div>
            <div class="form-group">
              <label for="">Especialidade:</label>
              <input type="text" name="especialidade" value="<?php echo "$especialidade"; ?>" class="form-control">
            </div>
            <input type="hidden" name="idMedico" value="<?php echo $id; ?>">
            <input type="submit" name="" value="Atualizar" class="btn btn-primary">
          </form>
      </div>
      <div class="col-md-4">

      </div>
    </div>
    </div>

  </body>
</html>
