<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Puuviljaladu</title>
    <link rel="stylesheet" href="ladu.css" type="text/css" charset="utf-8">
  </head>
  <body>
    <div id="div-kogu-sisu">
        <div style="float: right;">
            <form method="post"  action="<?= $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="action" value="logout">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                <button type="submit">Logi välja</button>
            </form>
        </div>

        <h1>Puuviljaladu</h1>
        <div id="div-vorm">
          <form  method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="action" value="lisa_toode">
            <table id="table-vorm">
                <tr>
                  <td>Toote nimetus</td>
                  <td><input type="text" name="toote_nimi"></td>
                </tr>
                <tr>
                  <td>Toote kogus (kg)</td>
                  <td><input type="number" step="0.1" min="0" name="toote_kogus"></td>
                </tr>
                <tr>
                  <td>
                    <button type="submit" onclick="laoseis" id="salvesta-nupp">Salvesta</button>
                  </td>
                </tr>
            </table>
          </form>
        </div>
        <div id="div-tootetabel">
          <table id="table-tootetabel">
            <thead>
              <tr>
                <th>Nimetus</th>
                <th>Kogus (kg)</th>
                <th colspan="2">Tegevused</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach (model_lae_tooted() as $rida): ?>
                <tr>
                  <td>
                    <?= $rida['Nimetus']; ?>
                  </td>
                  <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="hidden" name="action" value="muuda">
                    <input type="hidden" name="id" value="<?= $rida['Id']; ?>">
                    <td>
                      <input class="tootekogus" type="number" step="0.1" min="0" name="kogus" value="<?= $rida['Kogus']; ?>">
                    </td>
                    <td>
                      <button type="submit">Muuda</button>
                    </td>
                  </form>
                  <td>
                    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                      <input type="hidden" name="action" value="kustuta">
                      <input type="hidden" name="id" value="<?= $rida['Id']; ?>">
                      <button type="submit">Kustuta</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
              <div id="div-laoseis">

              </div>
              <script src="ladu.js"></script>
            </tbody>
          </table>
        </div>
      </div>
  </body>
</html>
