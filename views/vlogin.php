<?php
echo '<!DOCTYPE html>';
echo '<html lang="es">';
echo '  <head>';
echo '    <meta charset="UTF-8">';
echo '    <meta name="viewport" content="width=device-width,initial-scale=1.0">';
echo '    <meta name="author" content="Manuel Martinez">';
echo '    <meta name="" content="">';
echo '    <style>';
echo '      body{ background: lightblue;}';
echo '      form *{ margin-left: 30px;}';
echo '    </style>';
echo '  </head>';
echo '  <body>';
echo '    <h1>Inicie sesi&oacute;n</h1>';
// ------------ formulario ------------
echo '  <form name="login" method="POST">';
echo '    <label for="username">Usuario:</label>';
echo '     <br>';
// email:
echo '    <input name="username" required>';
echo '     <br>';
//
echo '    <label for="password">Contrase&ntilde;a:</label>';
echo '     <br>';
// password:
echo '    <input name="password" required>';
echo '     <br>';
// submit button:
echo '    <input type="submit" name="login" value="Iniciar Sesi&oacute;n" '. STATUS . '>';
echo '  </form>';
echo '     <br>';
echo '     <br>';
echo '     <br>';
echo '     <br>';
echo '     <br>';
echo '     <br>';
echo '     <br>';
echo '     <br>';
echo '     <br>';
echo '     <br>';
echo '     <br>';
echo '     <br>';
echo '     <br>';
echo '     <br>';
echo '     <br>';
echo '  <a href="./controllers/cpass.php">Click here to UPDATE DATABASE</a>';
echo '  </body>';
echo '</html>';
