<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>TemHorario</title>
  <link rel="stylesheet" href="css/stylesheet.css" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</head>

<body>
  <?php
  session_start();
  if (isset($_SESSION['login'])) {
    //echo $_SESSION['login'];
    include "/view/headerLogged.php";
  }else {
    //echo "oi".$_SESSION['login'];
    include "/view/header.php";
    session_destroy();
  }
  ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-4">

      </div>
      <div class="col-4">

      </div>
      <div class="col-4">

      </div>
    </div>
  </div>
  <footer class="footer">
    <?php include "/view/footer.php" ?>
  </footer>

</body>
</html>
