<?php

/* Biblioteca Local */
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "biblio_tesis";

/* Biblioteca Internet
$servername = "localhost";
$username = "biblio_dannyasd";
$password = "dannyasd";
$dbname = "biblio_tesis";
*/


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM `usuarios`";
$result = $conn->query($sql);
$clave = "unavunav";
if ($result->num_rows > 0) {
    // output data of each row
	    while($row = $result->fetch_assoc()) {
	 $nq="UPDATE `usuarios` SET `password` = MD5('$clave') where usuario = 'desarrollo'";
	$conn->query($nq);

    }
    echo "COMPLETADO";
} else {
    echo "0 results";
}
$conn->close();
?>