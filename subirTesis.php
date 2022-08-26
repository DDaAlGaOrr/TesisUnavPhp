<?php
include('session.php');
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Tesis Digitales</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" href="estilos/estilos.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light " style="background-color:  #0f6961;">
		<div class="container-fluid">
			<a class="navbar-brand" href="#"><img src="images/BLANCO UNAV NEW-NEW-08.png" width="160.2" height="40.1" alt=""></a>
			<!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
				<li class="nav-item">
					<h2 style="color: whitesmoke;">Tesis digitales</h2>
				</li>
			</ul> -->
		</div>
	</nav>
	<!--Aqui inicia el formulario que va a enviar los datos ingresados por el usuario utilizando el metodo POST-->
	<div class="container">
		<form action="subir.php" method="POST" enctype="multipart/form-data" class='demoTable'>
			<h1 class="mt-3">
				<center style="color: #0f6961;">Subir tesis</center>
			</h1>
			<label for="escuela">Selecciona una escuela:</label>
			<select name="tipo_escuela" class="form-select mb-4">
				<option selected>Eliga una escuela</option>
				<option value="Ingenieria">Ingeniería en Sistemas</option>
				<option value="DGrafico">Diseño Gráfico</option>
				<option value="Enfermeria">Enfermería</option>
				<option value="Nutricion">Nutrición</option>
				<option value="Gastronomia">Gastronomía</option>
				<option value="Contabilidad">Contabilidad</option>
				<option value="Teologia">Teología</option>
				<option value="Ciencias">Ciencias</option>
				<option value="Maestria">Maestría</option>
			</select>
			<input type="file"class="form-control mb-3" name="imagen" id="customFile"/>
			<div class="mb-3">
				<label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
				<textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
			</div>
			<input class="btn" style="color: white; background-color: #ce9d40;" type="submit" name="subir" value="Subir" />
			<a class="btn" style="color: white;background-color: #ce9d40;" href="Repositorio-Tesis.php?pag=1&buscar=">Ver tesis</a>
			<a class="btn" style="color: white;background-color: #ce9d40;" href="logout.php">Salir</a>
		</form>
	</div>
</body>

</html>