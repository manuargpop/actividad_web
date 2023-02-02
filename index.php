

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 - Programación Web</title>
</head>
<body>
    <h2>Formulario de Datos:</h2>

    <form action="" method="post">
    <label for="nombre">Nombre y Apellido:</label><br>
    <input type="input" name="nombre" id="nombreid"><br><br>
    
    <label for="edad">Edad:</label><br>
    <input type="number" name="edad" id="edadid"><br><br>

        <legend>Estado Civil:</legend>
    
        <div>
          <input type="radio" id="soltero" name="civil" value="soltero"
                 checked>
          <label for="soltero">Soltero(a)</label>
        </div>
    
        <div>
          <input type="radio" id="casado" name="civil" value="casado">
          <label for="casado">Casado(a)</label>
        </div>
    
        <div>
          <input type="radio" id="viudo" name="civil" value="viudo">
          <label for="viudo">Viudo(a)</label>
        </div>
        <br>

        <legend>Sexo:</legend>
    
        <div>
          <input type="radio" id="femenino" name="genero" value="femenino"
                 checked>
          <label for="femenino">Femenino</label>
        </div>
    
        <div>
          <input type="radio" id="masculino" name="genero" value="masculino">
          <label for="masculino">Masculino</label>
        </div>
        <br>

        <legend>Sueldo:</legend>
    
        <div>
          <input type="radio" id="sueldo1" name="sueldo" value="0"
                 checked>
          <label for="sueldo1">Menos de 1000Bs.</label>
        </div>
    
        <div>
          <input type="radio" id="sueldo2" name="sueldo" value="1">
          <label for="sueldo2">Entre 1000 y 2500 Bs.</label>
        </div>
    
        <div>
          <input type="radio" id="sueldo3" name="sueldo" value="2">
          <label for="sueldo3">Más de 2500 Bs.(a)</label>
        </div>
        <br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>

<?php 

  if (isset($_POST['nombre']) && $_POST['nombre'] != "" && isset($_POST['edad']) && $_POST['edad'] != "" ) {
    session_start();
    
    $nombre = $_POST['nombre'];
    $edad = (int) $_POST['edad'];
    $civil = $_POST['civil'];
    $genero = $_POST['genero'];
    $sueldo = (int) $_POST['sueldo'];

    if (!isset($_SESSION['fem'])) {
      $_SESSION['fem'] = 0;
    } if (!isset($_SESSION['hcas'])) {
      $_SESSION['hcas'] = 0;
    } if (!isset($_SESSION['femv'])) {
      $_SESSION['femv'] = 0;
    } if (!isset($_SESSION['promedioHombre'])) {
      $_SESSION['promedioHombre'] = 0;
    }

    if ($genero == "femenino") {
      $_SESSION['fem']++;
      if ($sueldo == 1 && $civil == "viudo") {
        $_SESSION['femv']++;
      }
    } else if ($genero == "masculino") {
      if ($sueldo == 2 && $civil == "casado") {
        $_SESSION['hcas']++;
      }
      if ($_SESSION['promedioHombre'] == 0) {
        $_SESSION['promedioHombre'] += (int) $edad;
      } else if ($_SESSION['promedioHombre'] != 0) {
        $_SESSION['promedioHombre'] = ($_SESSION['promedioHombre'] + (int) $edad) / 2;
      }
  }
  echo  "<br>" . "Total de empleados del sexo femenino: " . $_SESSION['fem'] .
  "<br>" . "Total de hombres casados que ganan más de 2500 Bs.: " . $_SESSION['hcas'] .
  "<br>" . "Total de mujeres viudas que ganan más de 1000 Bs.: " . $_SESSION['femv'] . 
  "<br>" . "Edad promedio de los hombres: " . $_SESSION['promedioHombre'];
}
?>