<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sisselogimise vorm</title>
  </head>
  <body>
    <h1>Logi sisse</h1>
    <div id="div-logi">
      <form  method="post" action="<?= $_SERVER['PHP_SELF']; ?>">

        <input type="hidden" name="action" value="login">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

        <table id="table-logi">
            <tr>
              <td>Kasutajanimi</td>
              <td><input type="text" name="kasutajanimi_log"></td>
            </tr>
            <tr>
              <td>Parool</td>
              <td><input type="password" name="parool_log"></td>
            </tr>
        </table>

        <p>
          <button type="submit">Logi sisse</button>
          <a href="register.php">Registreeri kasutajaks</a>
        </p>
      </form>
    </div>
  </body>
</html>
