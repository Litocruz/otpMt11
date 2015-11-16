<?php
require_once 'lib/GoogleAuthenticator.php';
require_once 'includes/config.php';

$usuario = $_GET['usuario'];
$contrasena = $_GET['contrasena'];

$link=conectar();
$ga = new PHPGangsta_GoogleAuthenticator();
$secreto = $ga->createSecret();
$resultados = array();

$sql = mysql_query("INSERT INTO usuario (usuario, contrasena, secreto) VALUES ('$usuario', '$contrasena', '$secreto')");
if($sql)
{
	$resultados['creacion'] = 1;
	$resultados['log'] = "sql: ".$sql."\nusuario: ".$usuario;
}
else
{
	$resultados['creacion'] = 0;
	$resultados['log'] = "sql: ".$sql."\nusuario: ".$usuario;
}
//limpio las consultas y cierro la coneccion a la db
mysql_free_result($sql); mysql_close($link);

$resultadosJson = json_encode($resultados);
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';

?>
