<?php

function controller_lisa_toode($nimetus, $kogus) {
  if ($nimetus == '' || $kogus < 0) {
    return false;
  }
  return model_lisa_toode($nimetus, $kogus);
}

function controller_kustuta_toode($id) {
  if ($id == '') {
    return false;
  }
  return model_kustuta_toode($id);
}

function controller_muuda_toode($id, $kogus) {
  if ($id == '' || $kogus < 0) {
    return false;
  }
  return model_muuda_toode($id, $kogus);
}

function controller_registreeri($kasutajanimi, $parool) {
  if ($kasutajanimi == '' || $parool == '') {
    return false;
  }
  return model_lisa_kasutaja($kasutajanimi, $parool);
}

function controller_kasutaja() {
  if (empty ($_SESSION['login'])) {
    return false;
  }
  return $_SESSION['login'];
}

function controller_login($kasutajanimi, $parool) {
  if($kasutajanimi == '' || $parool == '') {
    return false;
  }
  $id = model_vota_kasutaja($kasutajanimi, $parool);
  if(!$id){
    return false;
  }
  $_SESSION['login'] = $id;
  return $id;
}

function controller_logout()
{
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
    }
    $_SESSION = array();
    session_destroy();
    return true;
}
