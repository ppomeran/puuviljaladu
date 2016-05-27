<?php
session_start();

require 'model.php';
require 'controller.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $result = false;

  switch ($_POST['action']) {
    case 'lisa_toode':
      $nimetus = $_POST['toote_nimi'];
      $kogus = intval($_POST['toote_kogus']);
      $result = controller_lisa_toode($nimetus, $kogus);
      break;
    case 'kustuta':
      $id = intval($_POST['id']);
      $result = controller_kustuta_toode($id);
      break;
    case 'muuda':
      $id = intval($_POST['id']);
      $kogus = intval($_POST['kogus']);
      $result = controller_muuda_toode($id, $kogus);
      break;
    case 'registreeri':
      $kasutajanimi = $_POST['kasutajanimi_reg'];
      $parool = $_POST['parool_reg'];
      $result = controller_registreeri($kasutajanimi, $parool);
      break;
    case 'login':
      $kasutajanimi = $_POST['kasutajanimi_log'];
      $parool = $_POST['parool_log'];
      $result = controller_login($kasutajanimi, $parool);
      break;
    case 'logout':
      $result = controller_logout();
      break;
  }


  if ($result) {
    header('Location: '.$_SERVER['PHP_SELF']);
  }else {
    header('Content-type: text/plain; charset=utf-8');
    echo 'Päring ebaõnnestunud!';
  }
  exit;
}

if (!empty($_GET['view'])) {
  switch ($_GET['view']) {

    case 'registreeri':
      require 'register.php';
      break;

    case 'login':
      require 'login.php';
      break;

    default:
      header:('Content-Type: text/plain; Charset=utf-8');
      echo 'Tundmatu valik!';
      exit;
  }
} else {
    if (!controller_kasutaja()) {
      header ('Location: ' . $_SERVER['PHP_SELF'] . '?view=login');
      exit;
    }

    require 'view.php';
}

mysqli_close($l);
