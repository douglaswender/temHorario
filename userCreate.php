<?php
include 'conn.php';
// include '../controller/validaCPF.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cadastro</title>
    <script type="text/javascript">
      function Failure(){
        setTimeout("window.location='cadastro.php'", 1000);
      }
      function Sucessfull() {
        alert("Usuário criado com sucesso, realize o login!")
        setTimeout("window.location='index.php'", 1100);
      }
      function branco() {
        alert("Usuário ou senha em branco!");
        Failure();
      }
      function existe() {
        alert("Usuário já existe!");
        Failure();
      }
      function cpfError() {
        alert("CPF INVÁLIDO!");
        Failure();
      }
    </script>
  </head>
  <body>
<?php
$login = $_POST['login'];
$senha = $_POST['senha'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];

function validaCPF($cpf = null) {

    // Verifica se um número foi informado
    if(empty($cpf)) {
        return false;
    }

    // Elimina possivel mascara
    $cpf = ereg_replace('[^0-9]', '', $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

    // Verifica se o numero de digitos informados é igual a 11
    if (strlen($cpf) != 11) {
        return false;
    }
    // Verifica se nenhuma das sequências invalidas abaixo
    // foi digitada. Caso afirmativo, retorna falso
    else if ($cpf == '00000000000' ||
        $cpf == '11111111111' ||
        $cpf == '22222222222' ||
        $cpf == '33333333333' ||
        $cpf == '44444444444' ||
        $cpf == '55555555555' ||
        $cpf == '66666666666' ||
        $cpf == '77777777777' ||
        $cpf == '88888888888' ||
        $cpf == '99999999999') {
        return false;
     // Calcula os digitos verificadores para verificar se o
     // CPF é válido
     } else {

        for ($t = 9; $t < 11; $t++) {

            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }

        return true;
    }
}

$result = mysql_query("SELECT login FROM usuario WHERE login='$login'");
$row = mysql_num_rows($result);
$bol = validaCPF($cpf);

// echo "$bol";

if ($login==null || $senha==null) {
  echo "<script>branco()</script>";
}elseif ($row!=0) {
  echo "<script>existe()</script>";
}else {
  if ($bol) {
    mysql_query("INSERT INTO usuario (login, senha, tipo) VALUES ('$login','$senha','user')");
    $sql = mysql_query("SELECT * FROM usuario WHERE login = '$login'");
    $id = mysql_result($sql, 0 , 'idUsuario');
    //echo "teste: $linha";
    mysql_query("INSERT INTO paciente (nomePaciente, cpfPaciente, idUsuario) VALUES ('$nome', '$cpf', $id)");
    echo "<script>Sucessfull()</script>";
  }else {
    echo "<script>cpfError()</script>";
  }

}

 ?>
  </body>
</html>
