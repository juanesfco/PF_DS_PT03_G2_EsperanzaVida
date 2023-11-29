<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan Your Age</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="#home" class="w3-bar-item w3-button"><b>HENRY</b> Esperanza de Vida</a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
      <a href="#projects" class="w3-bar-item w3-button">Inicio</a>
      <a href="#about" class="w3-bar-item w3-button">Dashboard</a>
      <a href="#contact" class="w3-bar-item w3-button">Calculadora</a>
    </div>
  </div>
</div>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1500px;" id="home">
  <img class="w3-image" src="Logos/bannerPagina.jpg" alt="Banner" width="1500" height="800">
  <div class="w3-display-middle w3-margin-top w3-center">
    <h1 class="w3-xxlarge w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b>HENRY</b></span> <span class="w3-hide-small w3-text-dark-grey">Esperanza de Vida</span></h1>
  </div>
</header>

<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px">

  <!-- Project Section -->
  <div class="w3-container w3-padding-32" id="projects">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Inicio</h3>
    <p>Consultamos bases de datos del Banco Mundial y decidimos utilizar como referencia temas clave que proporcionan indicadores que influyen en la esperanza de vida de los habitantes de un país. Estos temas seleccionados son la educación, la salud, la economía, el desarrollo de la ciencia y la tecnología y el ámbito social.
      Planeamos recopilar indicadores de cada tema, crear las bases de datos con las que queremos trabajar y luego vincular estas variables para establecer relaciones. Visualizamos este proyecto como un producto que se puede ofrecer a una empresa que busque invertir en ciencia y desarrollo.
      Una vez completado todo el trabajo de análisis de datos, crearemos modelos de aprendizaje automático especificando ciertos parámetros, como el porcentaje del PIB invertido en educación o ciencia. Estos modelos luego nos proporcionarán una esperanza de vida estimada para un país en particular.
      </p>
      <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Equipo de Trabajo</h3>
  </div>

  <div class="w3-row-padding">
    <div class="w3-col w3-display-container" style="width:20%">
      <div class="w3-display-topleft w3-black w3-padding">Gonzalo</div>
      <img src="Logos/gonza.jpeg" alt="gonza" style="width:100%">
    </div>
    <div class="w3-col w3-display-container" style="width:20%">
      <div class="w3-display-topleft w3-black w3-padding">JP</div>
      <img src="Logos/jp.jpg" alt="jp" style="width:100%">
    </div>
    <div class="w3-col w3-display-container" style="width:20%">
      <div class="w3-display-topleft w3-black w3-padding">Carlos</div>
        <img src="Logos/carlos.jpeg" alt="carlos" style="width:100%">
    </div>
    <div class="w3-col w3-display-container" style="width:20%">
      <div class="w3-display-topleft w3-black w3-padding">Valentino</div>
      <img src="Logos/valentino.jpeg" alt="valen" style="width:100%">
    </div>
    <div class="w3-col w3-display-container" style="width:20%">
      <div class="w3-display-topleft w3-black w3-padding">Juanes</div>
      <img src="Logos/juanes.jpeg" alt="juanes" style="width:100%">
    </div>
  </div>

  <!-- About Section -->
  <div class="w3-container w3-padding-32" id="about">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Dashboard</h3>
    <iframe title="Report Section" width="100%" height="700" src="https://app.powerbi.com/view?r=eyJrIjoiMjczYjhiNWUtZGRjOC00ZGE5LWJmMDUtMDdhY2ZiNTlhNzVmIiwidCI6ImRmODY3OWNkLWE4MGUtNDVkOC05OWFjLWM4M2VkN2ZmOTVhMCJ9" frameborder="0" allowFullScreen="true"></iframe>
  </div>

  <!-- Contact Section -->
  <div class="w3-container w3-padding-32" id="contact">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Calculadora</h3>
    <p>Entra las variables.</p>
    <form action="index.php" method="post">
      <input class="w3-input w3-border" type="text" placeholder="X1" required name="X1">
      <input class="w3-input w3-section w3-border" type="text" placeholder="X2" required name="X2">
      <input class="w3-input w3-section w3-border" type="text" placeholder="X3" required name="X3">
      <input class="w3-input w3-section w3-border" type="text" placeholder="X4" required name="X4">
      <button class="w3-button w3-black w3-section" type="submit">
        <i class="fa fa-paper-plane"></i> Calcular
      </button>
    </form>
  </div>

<!-- End page content -->
</div>

<?php
if (isset($_POST['X1'],
          $_POST['X2'],
          $_POST['X3'],
          $_POST['X4']
          )) {

        $X1 = $_POST['X1'];
        $X2 = $_POST['X2'];
        $X3 = $_POST['X3'];
        $X4 = $_POST['X4'];

        $preCommand = 'python3 model.py'.' '.$X1.' '.$X2.' '.$X3.' '.$X4;
        $command = escapeshellcmd($preCommand);
        $output = shell_exec($command);
        
        echo '<p>La esperanza de vida de un niño nacido ahora es '.$output.'. </p>';
        } 
?>

</body>
</html>