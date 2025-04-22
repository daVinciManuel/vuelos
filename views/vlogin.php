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
echo '  <form name="login" method="POST">';
echo '    <label for="username">Usuario:</label>';
echo '     <br>';
echo '    <input name="username">';
echo '     <br>';
echo '    <label for="password">Contrase&ntilde;a:</label>';
echo '     <br>';
echo '    <input name="password">';
echo '     <br>';
echo '    <input type="submit" name="loginPlease" value="Iniciar Sesi&oacute;n">';
// continuar aqui
echo '  </form>';
echo '  </body>';
echo '</html>';
