<?php
include '../model/conn.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tem Horario</title>
    <script type="text/javascript">
      function loginSuccessfully(){
        setTimeout("window.location='../painel.php'",000);
      }
      function loginFailed() {
        alert("Login ou Senha inválidos!")
        setTimeout("window.location='../index.php'", 000);
      }
      function loginAdminSucessfull() {
        setTimeout("window.location='../admin.php'", 000);
      }
      function loginMasterSucessfull() {
        setTimeout("window.location='../master.php'", 000);
      }
    </script>
  </head>
  <body>
    <?php
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $query = "SELECT * FROM usuario WHERE login = '$login' and senha = '$senha'";

    $sql = mysql_query($query) or die(mysql_error());

    $row = mysql_num_rows($sql);



    if ($row>0){

      session_start();
      $_SESSION['idUsuario'] = mysql_result($sql, 0, "idUsuario");
      $idUsuario = $_SESSION['idUsuario'];

      $_SESSION['login'] = mysql_result($sql, 0, "login");
      $_SESSION['senha'] = mysql_result($sql, 0, "senha");
      $_SESSION['tipo'] = mysql_result($sql, 0, "tipo");

      //echo "Você autenticado com sucesso! Aguarde um instante...";
      $tipo = mysql_result($sql, 0, "tipo");
      //echo "$tipo";
      if ($tipo == "user") {
        //echo "entrou aqui 2";
        //echo "vc é admin";
        $result = mysql_query("SELECT * FROM paciente WHERE idUsuario = $idUsuario");
        $_SESSION['nomePaciente'] = mysql_result($result, 0, "nomePaciente");
        $_SESSION['idPaciente'] = mysql_result($result, 0, "idPaciente");
        echo "<script>loginSuccessfully()</script>";
      }else if($tipo == "admin"){
        //echo $_SESSION['login'];
        //echo $_SESSION['senha'];
        //echo "vc não é admin";
        $result = mysql_query("SELECT * FROM clinica WHERE idUsuario = $idUsuario");
        $_SESSION['nomeClinica'] = mysql_result($result, 0, "nomeClinica");
        $_SESSION['idClinica'] = mysql_result($result, 0, "idClinica");
        //echo $_SESSION['nomeClinica'];
        echo "<script>loginAdminSucessfull()</script>";
      }else if($tipo=="master"){
        echo "<script>loginMasterSucessfull()</script>";
      }
    }
    else {
        //echo "Login ou senha inválidos, aguarte um instante...";
        echo "<script>loginFailed()</script>";
    }

     ?>
  </body>
</html>
