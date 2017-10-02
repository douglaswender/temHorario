<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Tem Horário</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="../view/contato.html">Contato</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="..view/informacoes.html">Informações</a>
      </li>
    </ul>
    <form method="POST" name="loginform" action="controller/userautentication.php" class="form-inline my-2 my-lg-0">
      <div class="form-group">
        <label for="">Login:  </label><input type="text" name="login" class="form-control">
      </div>
      <div class="form-group">
        <label for="">Senha:  </label><input type="password" name="senha" class="form-control">
      </div>
      <div class="form-group">
        <small>Não possui cadastro? <a href="cadastro.php">Cadastre-se!</a></small>
      </div>
        <button type="submit" name="button" class="btn btn-primary">Login</button>
      </div>
    </form>
  </div>
</nav>
