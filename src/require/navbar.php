<?php
  /*
    Esse include decide qual barra de navegação será exibida a partir do acesso do usuário conectado, armazenado em $_SESSION['acesso']
  */
  $acesso = $_SESSION['acesso'];
  switch ($acesso) {
    case "1":
        include "src/require/navbar/navbar1.php";
        break;
    case "11":
        include "src/require/navbar/navbar11.php";
        break;
    case "12":
        include "src/require/navbar/navbar12.php";
        break;
    case "41":
        include "src/require/navbar/navbar41.php";
        break;
    case "42":
        include "src/require/navbar/navbar42.php";
        break;        
  }
?>