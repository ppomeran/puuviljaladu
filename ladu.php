<?php

session_start();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(20));

require 'model.php';
require 'controller.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $result = false;

  if (!empty($_POST['csrf_token']) && $_POST['csrf_token'] == $_SESSION['csrf_token']) {
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
      case 'registeeri':
        $kasutajanimi = $_POST['kasutajanimi'];
        $parool = $_POST['parool'];
        $result = controller_registeeri($kasutajanimi, $parool);
        break;

    }
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
        case 'login':
            require 'login.php';
            break;
        case 'register':
            require 'register.php';
            break;
        default:
            header('Content-type: text/plain; charset=utf-8');
            echo 'Tundmatu valik!';
            exit;
    }
} else {
    if (!controller_kasutajad()) {
        header('Location: '.$_SERVER['PHP_SELF'].'?view=login');
        exit;
    }
    require 'view.php';
}

mysqli_close($l);
