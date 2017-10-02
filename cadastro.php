<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Cadastro</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  <script type="text/javascript">


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
        <li class="nav-item">
          <a class="nav-link" href="contato.html">Contato</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="informacoes.html">Informações</a>
        </li>
      </ul>
    </div>
  </nav>
  <?php session_start();
  session_destroy(); ?>
  <div class="row">
    <div class="col-4">

    </div>
    <div class="col-4">
      <form class="" method="POST" name="cadastroForm" action="userCreate.php">
        <div class="form-group">
          <label for="">Login</label>
          <input type="text" class="form-control" name="login" aria-describedby="emailHelp" placeholder="Login">
        </div>
        <div class="form-group">
          <label for="">Password</label>
          <input type="password" class="form-control" name="senha" placeholder="Senha">
        </div>
        <div class="form-group">
          <label for="">Nome</label>
          <input type="text" class="form-control" name="nome" placeholder="Nome">
        </div>
        <div class="form-group">
          <label for="">CPF</label>
          <input id="cpf" type="text" class="form-control" name="cpf" placeholder="CPF">
        </div>
        <button type="submit" class="btn btn-primary" onclick="validaCPF(cpf.value)">Cadastrar!</button>
      </form>


    </div>
    <div class="col-4">

    </div>


  </div>
</body>
</html>
