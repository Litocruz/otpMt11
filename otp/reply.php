<?php 
require_once 'lib/GoogleAuthenticator.php';
require_once 'includes/config.php';
/*
login correcto :1
login fallido: 0
login + codigo correcto: 11
login + codigo incorrecto: 10
*/
$link=conectar();

$usuarioEnviado = $_GET['usuario'];
$contrasenaEnviada = $_GET['contrasena'];

$resultados = array();
$resultados['hora'] = date("F j, Y, g:i a");
$resultados['generador'] = "litocruz s.a";

$sql=mysql_query("SELECT * FROM usuario WHERE usuario='$usuarioEnviado' AND contrasena='$contrasenaEnviada'");
if($sql){
  while ($fila = mysql_fetch_assoc($sql)){ 
    $resultados['respuesta'] = "Validacion Correcta";
    $resultados['validacion'] = 1;

    $ga = new PHPGangsta_GoogleAuthenticator();
    $secret = $fila['secreto'];
    $qrCodeUrl = $ga->getQRCodeGoogleUrl($fila["usuario"], $secret);
    $oneCode = $ga->getCode($secret);
    $resultados['secreto'] = $secret;
    $resultados['qrCodeUrl'] = $qrCodeUrl;
    $resultados['codigo'] = $oneCode;
  }
}else{
	$resultados['respuesta'] = "Usuario y contrasena incorrectos";
	$resultados['validacion'] = 0;
}
//limpio las consultas y cierro la coneccion a la db
mysql_free_result($sql); mysql_close($link);

$resultadosJson = json_encode($resultados);
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';
//echo $resultadosJson;
?>
