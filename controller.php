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
