<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registreerimise vorm</title>
  </head>
  <body>
    <h1>Registreeri kasutajaks</h1>
    <div id="div-registreeri">
      <form  method="post" action="<?= $_SERVER['PHP_SELF']; ?>">

        <input type="hidden" name="action" value="registreeri">

        <table id="table-logi">
            <tr>
              <td>Kasutajanimi</td>
              <td><input type="text" name="kasutajanimi_reg"></td>
            </tr>
            <tr>
              <td>Parool</td>
              <td><input type="password" name="parool_reg"></td>
            </tr>
        </table>

        <p>
          <button type="submit">Registreeri konto</button>
          <a href="login.php">Tagasi avalehele</a>
        </p>
      </form>

    </div>

  </body>
</html>
