<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// header(Content-Type: 'text/html; charset=utf-8');
//include("config.php");
//conexion a la base de datos
include 'vendor/autoload.php';
//Archivo donde se encuantran las credenciales de la api de google
putenv('GOOGLE_APPLICATION_CREDENTIALS=repositoriotesis-98fa84456f6f.json');
// include 'connection.php';
/* --------------------------------------------------------------------------------------------------------------------- */
//conexion a la base de datos de tesis llamada biblio_tesis
// $connectionDB = $mysqli = new mysqli("localhost", "root", "root", "biblio_tesis");
$connectionDB = new mysqli("localhost", "unav1_ustesis", "oE6TmIR4d5", "unav1_tesis");
/* --------------------------------------------------------------------------------------------------------------------- */
// Inicializacion de el cliente de google
$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->SetScopes(['https://www.googleapis.com/auth/drive.file']); 
/* --------------------------------------------------------------------------------------------------------------------- */
// declaracion de variables
$escuela=$_POST["tipo_escuela"];// este dato viene del formulario de index2.php del select con name = tipo_escuela
$descripcion=$_POST["comment"];// este dato viene del formulario de index2.php del input con name = comment
$fileName = $_FILES['imagen']['name']; //este es el nombre del archivo que acabas de subir
$fileType = $_FILES['imagen']['type']; //este es el tipo de archivo que acabas de subir 
$fileTmpName = $_FILES['imagen']['tmp_name']; //este es donde esta almacenado el archivo que acabas de subir.
$fileSize = $_FILES['imagen']['size']; //este es el tamaño en bytes que tiene el archivo que acabas de subir.
$fileError = $_FILES['imagen']['error']; //este almacena el codigo de error que resultaría en la subida.
$permitidos = array("image/jpg", "image/jpeg", "audio/x-ms-wma","image/gif","video/mp4","video/avi", "audio/mp3","image/png","application/pdf","application/msword","application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/vnd.ms-excel","application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");// este es el array de los archivos permitidos para subir 
$limite_kb = 29903778555; //este es el limite de tamaño para subir en kilobytes
 // //imagen es el nombre del input tipo file del formulario. 
//comprobamos si ha ocurrido un error.
/* --------------------------------------------------------------------------------------------------------------------- */
if ($fileError > 0){
?>	
	<script>
    alert("Necesitas seleccionar un Archivo");
</script>
<?php
} else {
	//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
	//y que el tamano del archivo no exceda los 100kb
	if (in_array($fileType, $permitidos) && $fileSize <= $limite_kb * 1024){
		try {
			$service = new Google_Service_Drive($client);
			$filePath = $fileTmpName;
			$file = new Google_Service_Drive_DriveFile();
			$file->setName($fileName);
			$fInfo = finfo_open(FILEINFO_MIME_TYPE);
			// $mimeType Guarda tipo de archivo 
			$mimeType = finfo_file($fInfo, $filePath);
			$file->setParents(array("1b1r26LNnhYfN1VhAJVijj40H3Wt7Ngeb"));
			$file->setDescription("upload with php :D");
			$file->setMimeType($mimeType);
			$decode = utf8_decode($descripcion);
			$result = $service->files->create(
				$file,
				array(
					'data'=>file_get_contents($filePath),
					'mimeType'=> $mimeType,
					'uploadType' =>'media'
				)
			);
			$GoogleDriveFilePath = 'https://drive.google.com/open?id='.$result->id;
			// echo $GoogleDriveFilePath;
			$sql = mysqli_query($connectionDB, "INSERT INTO `imagenes`(`nombre`,`descripcion`,`tipo_escuela`,`tipo_dato`,`path`) VALUES ('$fileName','$decode','$escuela','$fileType','$GoogleDriveFilePath')");
				if ($sql){
				header("location:Repositorio-Tesis.php?pag=1&buscar=");
			} else {
				echo "ocurrio un error al mover el archivo.";
			}
		} catch (\Throwable $th) {
			echo "Error al subir archivo a drive";
		}
	} else {
		echo "archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
	}

}
?>
