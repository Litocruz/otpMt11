<?php
require_once 'lib/GoogleAuthenticator.php';
$codigoEnviado = $_GET['codigo'];
$secret = $_GET['secreto'];
$resultados = array();
if($codigoEnviado){ 
  //esta funcion utiliza el secreto y el codigo ingresado para validar 
  $ga = new PHPGangsta_GoogleAuthenticator();
  $checkResult = $ga->verifyCode($secret, $codigoEnviado, 2);    // 2 = 2*30sec clock tolerance
  if ($checkResult) { 
    $resultados['codigoValidacion'] = 11;
    $resultados['secreto'] = $secret;
    $resultados['codigo'] = $codigoEnviado;
  } else {
    $resultados['codigoValidacion'] = 10;
    $resultados['secreto'] = $secret;
    $resultados['codigo'] = $codigoEnviado;
  } 
}
else
{
  $resultados['codigoValidacion']=0000;
}
$resultadosJson = json_encode($resultados);
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';
?>
