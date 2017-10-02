<script type="text/javascript">
function sair() {
  window.location.href='logout.php';
}

</script>
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
      <li class="navbar-brand">Olá <?php if (isset($_SESSION['nomeClinica'])) {
        $nome=explode(" ", $_SESSION['nomeClinica']);
        echo "$nome[0]";
      }else {
        $nome=explode(" ", $_SESSION['nomePaciente']);
        echo "$nome[0]";
      } ?></li>
      <li class="nav-item"><button type="button" onclick="sair()" name="button" class="btn btn-danger">Sair</button></li>
    </ul>
  </form>
</div>
</nav>
