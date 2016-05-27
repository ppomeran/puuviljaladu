<?php

$host = "localhost";
$user = "test";
$pass = "t3st3r123";
$db = "test";

$l = mysqli_connect($host, $user, $pass, $db);

mysqli_query($l, 'SET CHARACTER SET UTF8');

function model_lisa_toode($nimetus, $kogus){
  global $l;
  $query = 'INSERT INTO ppomeran__tooted(Nimetus, Kogus) VALUES (?, ?)';
  $stmt = mysqli_prepare($l, $query);
  mysqli_stmt_bind_param($stmt, 'si', $nimetus, $kogus);
  mysqli_stmt_execute($stmt);
  $id = mysqli_stmt_insert_id($stmt);
  mysqli_stmt_close($stmt);
  return $id;
}

function model_lae_tooted() {
  global $l;

  $query = 'SELECT Id, Nimetus, Kogus FROM ppomeran__tooted ORDER BY Nimetus ASC';
  $stmt = mysqli_prepare($l, $query);

  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $id, $nimetus, $kogus);

  $rows = array();
  while(mysqli_stmt_fetch($stmt)){
    $rows[] = array(
      'Id' => $id,
      'Nimetus' => $nimetus,
      'Kogus' => $kogus
    );
  }

  mysqli_stmt_close($stmt);
  return $rows;
}

function model_kustuta_toode($id) {
  global $l;
  $query = 'DELETE FROM ppomeran__tooted WHERE Id=? LIMIT 1';
  $stmt = mysqli_prepare($l, $query);
  mysqli_stmt_bind_param($stmt, 'i', $id);
  mysqli_stmt_execute($stmt);
  $delete = mysqli_stmt_affected_rows($stmt);
  mysqli_stmt_close($stmt);
  return $delete;
}

function model_muuda_toode($id, $kogus) {
  global $l;
  $query = 'UPDATE ppomeran__tooted SET Kogus=? WHERE Id=? LIMIT 1';
  $stmt = mysqli_prepare($l, $query);
  mysqli_stmt_bind_param($stmt, 'ii', $kogus, $id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  return true;
}

function model_lisa_kasutaja($kasutajanimi, $parool) {
  global $l;
  $hash = password_hash($parool, PASSWORD_DEFAULT);
  $query = 'INSERT INTO ppomeran__kasutajad (Kasutajanimi, Parool)' . 'VALUES (?, ?)';
  $stmt = mysqli_prepare($l, $query);

  if(mysqli_error($l)) {
    echo mysqli_error($l);
    exit;
  }

  mysqli_stmt_bind_param($stmt, 'ss', $kasutajanimi, $hash);
  mysqli_stmt_execute($stmt);
  $id = mysqli_stmt_insert_id($stmt);
  mysqli_stmt_close($stmt);
  return $id;
}

function model_vota_kasutaja($kasutajanimi, $parool) {
  global $l;
  $query = 'SELECT Id, Parool FROM ppomeran__kasutajad WHERE Kasutajanimi=? LIMIT 1';
  $stmt = mysqli_prepare($l, $query);
  //kontrollib kas väärtused klapivad sql lauses
  if (mysqli_error($l)) {
    echo mysqli_error($l);
    exit;
  }
  mysqli_stmt_bind_param($stmt, 's', $kasutajanimi);
  mysqli_stmt_execute($stmt);
  //seome esimese välja listis muutujaga Id , teise seome muutujaga parool; seome parooli välja muutujaga hash
  mysqli_stmt_bind_result($stmt, $id, $hash);
  //ootame ühte rida - kutsume stmt_fetch ühe korra välja; muidu peaks while tsükli tegema
  mysqli_stmt_fetch($stmt);
  mysqli_stmt_close($stmt);

  //parooli kontrollimine, kas parool klapib hashiga; vabateksti parool ja password mis hashiga saime
  if (password_verify($parool, $hash)) {
    return $id;
  } else {
    return false;
  }
}
