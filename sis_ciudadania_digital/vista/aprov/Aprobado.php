<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-Type: application/x-www-form-urlencoded');

/**
 *
 */
class Aprobado
{

  $datosRecibidos = file_get_contents("php://input");
  // $decodejson = json_decode($datosRecibidos,true);
  var_dump($datosRecibidos);
}



?>
