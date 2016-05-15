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
  if ($id == '') {
    return false;
  }
  return model_muuda_toode($id, $kogus);
}

function controller_kasutajad()
{
    if (empty($_SESSION['login'])) {
        return false;
    }
    return $_SESSION['login'];
}

function controller_registeeri($kasutajanimi, $parool)
{
    if ($kasutajanimi == '' || $parool == '') {
        return false;
    }
    return model_lisa_kasutaja($kasutajanimi, $parool);
}

function controller_login($kasutajanimi, $parool)
{
    if ($kasutajanimi == '' || $parool == '') {
        return false;
    }
    $id = model_saa_kasutajad($kasutajanimi, $parool);
    if (!$id) {
        return false;
    }
    session_regenerate_id();
    $_SESSION['login'] = $id;
    return $id;
}
