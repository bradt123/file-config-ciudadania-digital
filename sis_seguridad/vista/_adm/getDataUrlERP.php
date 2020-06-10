<?php

// session_start() ;
// session_unset();
// session_destroy(); // destruyo la sesi�n
// header("Location: ../../../index.php");
//
include('../../../lib/lib_control/config.php');
// // include_once(dirname(__FILE__)."/../../../lib/lib_control/CTSesion.php");
// // session_start();
// // $_SESSION["_SESION"]= new CTSesion();
// include(dirname(__FILE__).'/../../../lib/DatosGenerales.php');
// include_once(dirname(__FILE__).'/../../../lib/lib_general/Errores.php');
// // ob_start();
// // estable aprametros ce la cookie de sesion
// // $_SESSION["_CANTIDAD_ERRORES"]=0;//inicia control
// //
// // register_shutdown_function('fatalErrorShutdownHandler');
// // set_exception_handler('exception_handler');
// // set_error_handler('error_handler');
// include_once(dirname(__FILE__).'/../../../lib/lib_control/CTincludes.php');
// include_once(dirname(__FILE__).'/../../../sis_seguridad/modelo/MODPersona.php');
//
//
function getAuthorizationCode() {
  $authorization_redirect_url = SERVICIO_AUTENTICATION_DIGITAL . "?client_id=" . ERP_CLIENT_ID . "&scope=openid". ERP_ESCOPE . "&" . ERP_RESPONSE_TYPE . "&redirect_uri=" . ERP_CLIENT_CALLBACK_URI . "&state=". ERP_STATE. "&nonce=". ERP_NONCE;
   header("Location: " . $authorization_redirect_url);
  // echo $authorization_redirect_url;
}

  getAuthorizationCode();
//
//   function checkLogin()
//   {
//
//
//       $d = [
//             'tipo_documento' => 'CI',
//             'documento_identidad' => '80145533440',
//             'first_name' => 'prueba3',
//             'last_name' => 'rep_3',
//             'surname'  => 'oba_3',
//             'birth_date' => '11/05/2004',
//             'email' => 'prueba2@gmail.com',
//             'uuid' => '123213hhfsadflh2h34l2',
//             'access_token' => '12121212'
//           ];
//
//
//
//       $user = checkUserExists($d);
//       // if (!empty($user[0]['id_usuario'])) {
//       //      updateToKenUserERP($user);
//       // }else{
//       //   saveNewPersonErp($d);
//       // }
//     }
//
//   checkLogin();
// function checkUserExists($data){
//           $objPostData=new CTPostData();
//           $arr_unlink=array();
//           $aPostData=$objPostData->getData();
//
//           $_SESSION["_PETICION"]=serialize($aPostData);
//           $objParam = new CTParametro($aPostData['p'],null,$aPostFiles);
//
//           $objParam->addParametro('nombre', $data['first_name']);
//           $objParam->addParametro('ap_materno', $data['surname']);
//           $objParam->addParametro('ap_paterno', $data['last_name']);
//           $objParam->addParametro('ci', $data['documento_identidad']);
//           $objParam->addParametro('correo', $data['email']);
//           $objParam->addParametro('tipo_documento', $data['tipo_documento']);
//           $objParam->addParametro('expedicion', 'CB');
//           $objParam->addParametro('fecha_nacimiento', $data['birth_date']);
//           $objParam->addParametro('access_token', $data['access_token']);
//           $objFunc=new MODPersona($objParam);
//           $res=$objFunc->personaDigital();
//
//           if($res->getTipo()=='ERROR'){
//             echo 'Se ha producido un error-> Mensaje Técnico:'.$res->getMensajeTec();
//           exit;
//           }
//
//            var_dump($res);
//           exit;
// }
