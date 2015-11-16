<?php
function conectar() {
    $db_host = "localhost"; //host donde se encuentra la base de datos
    $db_user = "root"; //Usuario de la base de datos no deberia ser root
    $db_password = "JUli123"; //Contraseña de la base de datos
    $db_database = "mt12"; //Nombre de base de datos

    $link=mysql_connect($db_host, $db_user, $db_password);
    if(!$link)
    {
      die('No se pudo conectar : ' . mysql_error());
    }
    $result=mysql_select_db($db_database,$link) OR DIE ("Error: No es posible establecer la conexión");
    return $link;
}
?>
