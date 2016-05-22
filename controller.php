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

//küsime modelist kas kasutaja andmed on 6iged
function controller_login($kasutajanimi, $parool) {
  if($kasutajanimi == '' || $parool == '') {
    return false;
  }
  //küsime modelist kasutaja id; proovime kasutaja andmeid laadida
  $id = model_vota_kasutaja($kasutajanimi, $parool);
  //kui id'd ei leia
  if(!$id){
    return false;
  }
  //kui id on käes, paneme session_user väärtuseks ja tagastame id
  $_SESSION['login'] = $id;
  return $id;
}
