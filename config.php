<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
//  define('DB_USERNAME', 'unav1_ustesis');
//  define('DB_PASSWORD', 'oE6TmIR4d5');
define('DB_DATABASE', 'biblio_impresiones');
// define('DB_DATABASE', 'unav1_tesis');
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

// Check connection
if (mysqli_connect_errno()) {
  echo "Fallo al connectar  MySQL: " . mysqli_connect_error();
}
