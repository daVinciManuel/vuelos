<?php
?>
<!DOCTYPE html>
<html lang='es'>
  <head>
    <title>Vuelos</title>
    <style>
    body{background:#ccc;}</style>
  </head>
  <body>
    <header>
      <h1>Registro de usuarios</h1>
      <a href='../index.php'>Volver a Inicio de sesion</a>
      <hr>
    </header>
    <main>
      <form action='<?php echo htmlentities($_SERVER["PHP_SELF"]);?>' method='POST'>
        <label>Nombre</label><br>
        <input type='text' name='name' required><br>
        <label>Fecha de nacimiento</label>
        <input type='date' name='birthdate' required> <br>
        Sexo:<br>
        <input type='radio' name='sexo' value='m'>
        <label>Hombre</label><br>
        <input type='radio' name='sexo' value='w'>
        <label>Mujer</label><br>
        <label>Calle</label><br>
        <input type='text' name='street' required><br>
        <label>Ciudad</label><br>
        <input type='text' name='city' required><br>
        <label>Pa&iacute;s</label><br>
        <input type='text' name='country' required><br>
        <label>Correo electr&oacute;nico</label><br>
        <input type='text' name='email' required><br>
        <label>Telefono</label><br>
        <input type='text' name='phonenumber' required><br>

        <input type='submit' name='signUp' value='REGISTRARSE'>
      </form>
    </main>
  </body>
</html>
