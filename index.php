

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>ejercicio web</title>
  </head>
  <body>
    <h1>form</h1>

    <form action="" method="post">

      <label for="name">nombre y apellidos:</label><br>
      <input type="input" name="name" id="nombreid"><br><br>
      
      <label for="edad">edad:</label><br>
      <input type="number" name="edad" id="edadid"><br><br>

      <h1>estado civil:</h1>
      
      <div>
        <input type="radio" id="soltero" name="civil" value="soltero"
               checked>
        <label for="soltero">soltero(a)</label>
      </div>
      
      <div>
        <input type="radio" id="casado" name="civil" value="casado">
        <label for="casado">casado(a)</label>
      </div>
  
      <div>
        <input type="radio" id="viudo" name="civil" value="viudo">
        <label for="viudo">viudo(a)</label>
      </div><br>

      <h1>Sexo:</h1>
  
      <div>
        <input type="radio" id="female" name="sex" value="female"
               checked>
        <label for="female">femenino</label>
      </div>
  
      <div>
        <input type="radio" id="masculino" name="sex" value="masculino">
        <label for="masculino">masculino</label>
      </div><br>

      <h1>sueldo:</h1>
  
      <div>
        <input type="radio" id="sueldo1" name="sueldo" value="0"
               checked>
        <label for="sueldo1">menos de 1000 Bs</label>
      </div>
  
      <div>
        <input type="radio" id="sueldo2" name="sueldo" value="1">
        <label for="sueldo2">entre 1000 y 2500 Bs</label>
      </div>
  
      <div>
        <input type="radio" id="sueldo3" name="sueldo" value="2">
        <label for="sueldo3">mas de 2500 Bs</label>
      </div><br>

      <button type="submit">enviar</button>

    </form>
  </body>
</html>

<?php 

if (isset($_POST['name']) && $_POST['name'] != "" && isset($_POST['edad']) && $_POST['edad'] != "" ) 
{
  session_start();
  
  $name = $_POST['name'];
  $edad = (int) $_POST['edad'];
  $civil = $_POST['civil'];
  $sex = $_POST['sex'];
  $sueldo = (int) $_POST['sueldo'];

  if (!isset($_SESSION['fem'])) 
  {
    $_SESSION['fem'] = 0;
  } 
  if (!isset($_SESSION['hcas'])) 
  {
    $_SESSION['hcas'] = 0;
  } 
  if (!isset($_SESSION['femv'])) 
  {
    $_SESSION['femv'] = 0;
  } 
  if (!isset($_SESSION['promale'])) 
  {
    $_SESSION['promale'] = 0;
  }

  if ($sex == "female") 
  {
    $_SESSION['fem']++;
    if ($sueldo == 1 && $civil == "viudo") 
    {
      $_SESSION['femv']++;
    }
  } 
  else if ($sex == "masculino") 
  {
    if ($sueldo == 2 && $civil == "casado") 
    {
      $_SESSION['hcas']++;
    }
    if ($_SESSION['promale'] == 0) 
    {
      $_SESSION['promale'] += (int) $edad;
    } 
    else if ($_SESSION['promale'] != 0) 
    {
      $_SESSION['promale'] = ($_SESSION['promale'] + (int) $edad) / 2;
    }
  }
echo  "<br>" . "la cantidad de empleadas es: " . $_SESSION['fem'] .
"<br>" . "hombres con sueldo de o mayor a 2500 Bs.: " . $_SESSION['hcas'] .
"<br>" . "mujeres viudas con sueldo de o mas 1000 Bs.: " . $_SESSION['femv'] . 
"<br>" . "Edad promedio de los hombres: " . $_SESSION['promale'];
}
?>