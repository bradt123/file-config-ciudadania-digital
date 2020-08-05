<?php
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Headers: Origin, Content-Type');
$input_get = filter_input_array(INPUT_GET);

if (is_null($input_get))
{
  header("location:https://erp.obairlines.bo/sis_seguridad/vista/_adm/index.php");
} else {

  $data_json = json_encode($input_get);

  include_once(dirname(__FILE__).'/../../../lib/lib_control/CTincludes.php');
  include_once(dirname(__FILE__).'/../../../sis_ciudadania_digital/modelo/MODRespuestaSolicitudAprobacion.php');

  $objPostData=new CTPostData();

  $aPostData=$objPostData->getData();

  $_SESSION["_PETICION"]=serialize($aPostData);
  $objParam = new CTParametro($aPostData['p'],null,$aPostFiles);



  $objParam->addParametro('finalizado', $input_get['finalizado']);
  $objParam->addParametro('estado', $input_get['estado']);
  $objParam->addParametro('mensaje', $input_get['mensaje']);
  $objParam->addParametro('link_verificacion', $input_get['linkVerificacion']);
  $objParam->addParametro('link_verificacion_unico', $input_get['linkVerificacionUnico']);
  $objParam->addParametro('transaction_code', $input_get['transactionCode']);
  $objParam->addParametro('uuid_blockchain', $input_get['uuidBlockchain']);
  $objParam->addParametro('request_uuid', $input_get['requestUuid']);
  $objParam->addParametro('redirect_uri','hola');

  $objFunc=new MODRespuestaSolicitudAprobacion($objParam);
  $res=$objFunc->insertarRespuestaSolicitudAprobacion();

  if($res->getTipo() == 'EXITO'){
      if($res->datos['status']=='exito') {
        include(dirname(__FILE__).'/../../public/html/document.php');
        ob_get_contents();
      }
  }
  else{
        $mensaje = $res->getMensaje();
        include(dirname(__FILE__).'/../../public/html/document_error.php');
        ob_get_contents();
  }

}

 ?>
