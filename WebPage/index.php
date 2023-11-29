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
    <a href="#home" class="w3-bar-item w3-button"><img class="w3-image" src="Logos/logoHeader_22.png" alt="header" height="10"> Esperanza de Vida</a>
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
    <h1 class="w3-jumbo w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><img class="w3-image" src="Logos/logoHeader_neg.png" alt="header" height="30"></span> </h1>
    <h2><span class="w3-hide-medium w3-text-dark-grey">Esperanza de Vida</span>  </h2>
  </div>
</header>

<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px">

  <!-- Project Section -->
  <div class="w3-container w3-padding-32" id="projects">
    <h3 class="w3-large w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b>Inicio</b></span></h3>
    <h4>Explora el Futuro del Bienestar Social con Analytics Lab, la consultora de datos que resuelve desafíos claves para los gobiernos.
¡Desata el poder de los datos y toma decisiones estratégicas efectivas!
      </h4>
  </div>

  <div class="w3-row-padding">
    <h4 class="w3-border-bottom w3-border-light-grey w3-padding-16">Equipo de Trabajo</h4>
    <div class="w3-col w3-display-container" style="width:20%">
      <div class="w3-display-bottomleft w3-black w3-padding">Gonzalo - ML</div>
      <a href="https://www.linkedin.com/in/gonzalo-ducca-b079011b2/" target="_blank"><img src="Logos/gonza.jpg" alt="gonza" style="width:100%"></a>
    </div>
    <div class="w3-col w3-display-container" style="width:20%">
      <div class="w3-display-bottomleft w3-black w3-padding">Juan P. - DA</div>
      <a href="https://www.linkedin.com/in/jpbertone/" target="_blank"><img src="Logos/jp.jpg" alt="jp" style="width:100%"></a>
    </div>
    <div class="w3-col w3-display-container" style="width:20%">
      <div class="w3-display-bottomleft w3-black w3-padding">Carlos - ML</div>
        <a href="https://www.linkedin.com/in/carlosmadoery/" target="_blank"><img src="Logos/carlos.jpeg" alt="carlos" style="width:100%"></a>
    </div>
    <div class="w3-col w3-display-container" style="width:20%">
      <div class="w3-display-bottomleft w3-black w3-padding">Valentino - DA</div>
      <a href="https://www.linkedin.com/in/valentino-caputa-700121272/" target="_blank"><img src="Logos/valentino.jpeg" alt="valen" style="width:100%"></a>
    </div>
    <div class="w3-col w3-display-container" style="width:20%">
      <div class="w3-display-bottomleft w3-black w3-padding">Juanes - DE</div>
      <a href="https://www.linkedin.com/in/jefc/" target="_blank"><img src="Logos/juanes.jpeg" alt="juanes" style="width:100%"></a>
    </div>
  </div>

  <!-- About Section -->
  <div class="w3-container w3-padding-32" id="about">
    <h3 class="w3-large w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b>Dashboard</b></span></h3>
    <iframe title="Report Section" width="100%" height="700" src="https://app.powerbi.com/view?r=eyJrIjoiYzFmNDVlYjYtN2Y4MC00ODNkLWI1MGEtNTU4M2UzYzFhM2Q3IiwidCI6ImRmODY3OWNkLWE4MGUtNDVkOC05OWFjLWM4M2VkN2ZmOTVhMCJ9&pageName=ReportSectionf025c391416ae984dce4" frameborder="0" allowFullScreen="true"></iframe>
  </div>

  <!-- Contact Section -->
  <div class="w3-container w3-padding-32" id="contact">
    <h3 class="w3-large w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b>Calculadora de Esperanza de Vida</b></span></h3>
    <p>Entra las variables. Entrar al <a href="https://docs.google.com/spreadsheets/d/1qexFZ3q7yl083nQM8aPYXRC3mY2ifxnW2Xc4bKL46X8/edit?usp=sharing" title="DiccDatos" target="_blank" class="w3-hover-text-green">Diccionario de Datos</a> para más detalles.</p>
    <form action="index.php" method="post">
      <input class="w3-input w3-border" type="text" placeholder="Año - Ej. 2023" required name="X1">
      <input class="w3-input w3-border" type="text" placeholder="Cantidad de Aplicaciones de Patentes - Ej. 40669" required name="X2">
      <input class="w3-input w3-border" type="text" placeholder="Balance Comercial (US$) - Ej. -1861540000" required name="X3">
      <input class="w3-input w3-border" type="text" placeholder="Porcentaje de Crecimiento Anual del PIB  - Ej. 3.18" required name="X4">
      <input class="w3-input w3-border" type="text" placeholder="PIB per Capita (US$) - Ej. 23437" required name="X5">
      <input class="w3-input w3-border" type="text" placeholder="INB per Capita (US$) - Ej. 23518" required name="X6">
      <input class="w3-input w3-border" type="text" placeholder="Porcentaje del PIB para Educación - Ej. 4.71" required name="X7">
      <input class="w3-input w3-border" type="text" placeholder="Mortalidad en infantes de menores 5 años por cada 1000 - Ej. 16" required name="X8">
      <input class="w3-input w3-border" type="text" placeholder="Porcentaje del PIB para Salud - Ej. 4.92" required name="X9">
      <input class="w3-input w3-border" type="text" placeholder="Porcentaje de Desempleo entre Población Apta para Trabajar - Ej. 6.73" required name="X10">
      <input class="w3-input w3-border" type="text" placeholder="Homicidios Intencionales por cada 100000 Personas - Ej. 9.12" required name="X11">
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
          $_POST['X4'],
          $_POST['X5'],
          $_POST['X6'],
          $_POST['X7'],
          $_POST['X8'],
          $_POST['X9'],
          $_POST['X10'],
          $_POST['X11']
          )) {

        $X1 = $_POST['X1'];
        $X2 = $_POST['X2'];
        $X3 = $_POST['X3'];
        $X4 = $_POST['X4'];
        $X5 = $_POST['X5'];
        $X6 = $_POST['X6'];
        $X7 = $_POST['X7'];
        $X8 = $_POST['X8'];
        $X9 = $_POST['X9'];
        $X10 = $_POST['X10'];
        $X11 = $_POST['X11'];

        $preCommand = 'python3 model.py'.' '.$X1.' '.$X2.' '.$X3.' '.$X4.' '.$X5.' '.$X6.' '.$X7.' '.$X8.' '.$X9.' '.$X10.' '.$X11;
        $command = escapeshellcmd($preCommand);
        $output = shell_exec($command);
        
        echo '<div class="w3-content w3-padding"> <h4> Dada una población en el año '.$X1.', en el cuál hubo una cantidad de aplicaciones de patentes de '.$X2.', 
	un balance comercial de $'.$X3.', un crecimiento anual del PIB de '.$X4.'%, un PIB per Capita de $'.$X5.', un INB per Capita de $'.$X6.', 
	el PIB invertido en educación de '.$X7.'% y en salud de '.$X9.'%, una mortalidad en infantes menores de 5 años por cada 1000 de '.$X8.', un desempleo entre la población apta para trabajar de '.$X10.'%, 
	y una taza de homocidios intencionales por cada mil personas de '.$X11.', la esperanza de vida de un recién nacido es de <b>'.$output.' años</b>. </h4> </div>';
        } 
?>

<!-- Footer -->
<footer class="w3-center w3-black w3-padding-16">
  <p>2023 - Propiedad de Analytics Lab: Consultoría de Datos</p>
</footer>

</body>
</html>
