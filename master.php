<!DOCTYPE html>
<?php
session_start();
  if(isset($_SESSION['tipo'])){
    if($_SESSION['tipo']!="master"){
      session_destroy();
      header("Location: index.php");
    }
  }

 ?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Master</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script type="text/javascript">
    function sair() {
      location.href='logout.php';
    }
    </script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Tem Horário</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <?php if (isset($_SESSION['nomeClinica'])) {?>
            <a class="nav-link" href="admin.php">Painel<span class="sr-only"></span></a>
            <?php
          }else {?>
            <a class="nav-link" href="painel.php">Painel<span class="sr-only"></span></a>
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
          <li class="navbar-brand">Olá Master</li>
          <li class="nav-item"><button type="button" onclick="sair()" name="button" class="btn btn-danger">Sair</button></li>
        </ul>
      </form>
    </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <div class="col-4">

        </div>
        <div class="col-4">
          <form class="" action="../temHorario/model/addClinica.php" method="post">
            <div class="form-group">
              <label for="">Nome Clínica:</label>
              <input class="form-control" type="text" name="nomeClinica" value="" placeholder="Insira o nome da Clínica">
            </div>
            <div class="form-group">
              <label for="">CNPJ:</label>
              <input class="form-control" type="text" name="cnpj" value="" placeholder="Insira o CNPJ">
            </div>
            <div class="form-group">
              <label for="">Login:</label>
              <input class="form-control" type="text" name="login" value="">
            </div>
            <div class="form-group">
              <label for="">Senha:</label>
              <input class="form-control" type="password" name="senha" value="">
            </div>
            <button class="btn btn-primary" type="submit" name="button">Cadastrar!</button>
          </form>
        </div>
        <div class="col-4">

        </div>
      </div>

    </div>
      </body>
</html>
