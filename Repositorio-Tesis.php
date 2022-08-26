<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta charset="utf-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
<!-- <script language='JavaScript' type='text/JavaScript'> 
 
 // http://html-generator.weebly.com/html-right-click-disable-code.html 
 let tenth = ''; 
 function ninth() { 
   if (document.all) { 
     (tenth); 
     alert("Right Click Disable"); 
     return false; 
   } 
 } 
 
 function twelfth(e) { 
   if (document.layers || (document.getElementById && !document.all)) { 
     if (e.which == 2 || e.which == 3) { 
       (tenth); 
       return false; 
     } 
   } 
 } 
 if (document.layers) { 
   document.captureEvents(Event.MOUSEDOWN); 
   document.onmousedown = twelfth; 
 } else { 
   document.onmouseup = twelfth; 
   document.oncontextmenu = ninth; 
 } 
 document.oncontextmenu = new Function('alert("Bloqueado por copyright atte:BBJ"); return false') 
</script> -->
<title>Repositorio tesis UNAV</title>
<!-- CSS -->
<link rel="stylesheet" href="estilos/estilos.css" type="text/css" />
<?php
// $mysqli = new mysqli("localhost", "unav1_ustesis", "oE6TmIR4d5", "unav1_tesis");
$mysqli = new mysqli("localhost", "root", "root", "biblio_tesis");
/* verificar la conexión */
if (mysqli_connect_errno()) {
  echo "Conexión fallida: %s\n", mysqli_connect_error();
  exit();
}
?>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color:  #0f6961; height: 200px;">
  <div class="container">
    <img style="margin: 0 auto;" src="images/BLANCO UNAV NEW-NEW-07 (1).png " width="560" height="70" alt="">
    <!-- <h2 style="color: white;">Repositorio de tesis</h2> -->
  </div>
</nav>

<div class="container mx-auto" style="width: 200px;">
  <form action="">
    <input type="text" name="searchByInput">
    <button class="btn" type="submit"></button>
  </form>
  <form class="d-flex" style="margin-top: 10px;">
    <select class="form-select" name="buscar" id="text3" style="width: 500px; margin-right: 10px;">
      <option value="" selected>Mostrar todas</option>
      <option value="Ingenieria">Ingenieria en Sistemas</option>
      <option value="DGrafico">Diseño Grafico</option>
      <option value="Enfermeria">Enfermeria</option>
      <option value="Nutricion">Nutrición</option>
      <option value="Gastronomia">Gastronomia</option>
      <option value="Contabilidad">Contabilidad</option>
      <option value="Teologia">Teología</option>
      <option value="Ciencias">Ciencias</option>
    </select>
    <input name='submit' type='submit' value='Buscar' class="btn" style="background-color: #ce9d40; color: white; height: 40px;">
  </form>
</div>
<?php
$limit = 5;
if (isset($_GET["buscar"])) {
  $searchBySchool = $_GET["buscar"];
} elseif (isset($_POST["buscar"])) {
  $searchBySchool = $_POST["buscar"];
} else {
  $searchBySchool = "";
}

if (isset($searchBySchool)) {
  if (isset($_GET["pag"])) {
    $pageRequire = $_GET["pag"];
  }
  if (empty($pageRequire)) {
    $pageRequire = 1;
  }
  $offset = ($pageRequire - 1) * $limit;
  $query = "select distinct SQL_CALC_FOUND_ROWS * from imagenes where imagenes.tipo_escuela like '%$searchBySchool%' LIMIT $offset, $limit";
  $queryTotal = "SELECT FOUND_ROWS() as total";
  if ($result = $mysqli->query($query)) {
    $result1 = $mysqli->query($queryTotal);
    $rowTotal = $result1->fetch_assoc();
    $total = $rowTotal["total"];
    echo "<div class='container mt-2'>";
    echo "<table class='table table-borderless'>";
    echo "<caption style=\"text-align: center;\" >LISTA DE TESIS</caption>";
    echo " <thead>";
    echo "<tr>";
    echo "<th class = \"table-success\" scope=\"col\" width=\"20\">Enlace</th>";
    echo "<th class = \"table-success\" scope=\"col\">Descripción</th>";
    echo "<th class = \"table-success\" scope=\"col\" width=\"70\" align=\"center\">Escuela</th>";
    echo "</tr>";
    echo " </thead>";
    while ($row = $result->fetch_assoc()) {
      //ruta va a obtener un valor parecido a "imagenes/nombre_imagen.jpg" por ejemplo
      $ruta = $row['path'];
      //ahora solamente debemos mostrar la imagen
      //echo "<a href='$ruta'><img width='250px' src='$ruta' /></a>";
      echo "<tbody>";
      echo "<tr>";
      echo "<td class =\"table-light\"><a target='_Blank' href='$ruta'><img src='images/tesis-icono.png' width='100' height='100'></a></td>";
      echo "<td class =\"table-light\" width='300px' >" . ($row['descripcion']) . "</td>";
      echo "<td class =\"table-light\">" . $row['tipo_escuela'] . "</td>";
      echo "</tr>";
      echo "</tbody>";
    }
    echo "<tfoot>";
    echo  "<tr>";
    echo "<td style=\"text-align: center;\" colspan='3'>";
    $totalPag = ceil($total / $limit);
    $links = array();
    for ($i = 1; $i <= $totalPag; $i++) {
      $links[] = "<a href=\"?pag=$i&buscar=$searchBySchool\" style = \"text-decoration: none; font-size: 20px; font-weight: 700; color:#0f6961;\">$i</a>";
    }
    echo "Pagina $pageRequire de $totalPag <br>";
    echo implode(" - ", $links);
    echo "<br><a class=\"navbar-brand\" style=\"color: #ce9d40; font-weight: 600;\" href=\"https://dev.unav.edu.mx/tesis/subirTesis.php\">Iniciar sesión</a>";

    echo "</td>";
    echo "</tr>";
    echo "</tfoot>";
    echo "</table>";
    echo "<div class='container'>";

    $result->free();
  }
}
?>
<!-- <a class="navbar-brand" style="color: #ce9d40; font-weight: 600;" href="http://localhost/tesis/subirTesis.php">Iniciar sesión</a> -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>