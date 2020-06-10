<?php
include_once(dirname(__FILE__).'/../../../lib/lib_general/Errores.php');
include_once(dirname(__FILE__).'/../../../lib/lib_control/CTincludes.php');
include_once(dirname(__FILE__).'/../../../lib/DatosGenerales.php');
include_once(dirname(__FILE__).'/../../../sis_seguridad/modelo/MODPersona.php');
include_once(dirname(__FILE__).'/../../../sis_seguridad/modelo/MODUsuario.php');


function authenticationERP(array $data, $n) {
  if (empty($data)) {
    return false;
  }

  $data_user = [
          'tipo_documento' => $data['data']['documento_identidad']['tipo_documento'],
          'documento_identidad' => $data['data']['documento_identidad']['numero_documento'],
          'first_name' => $data['data']['nombre']['nombres'],
          'last_name' => $data['data']['nombre']['primer_apellido'],
          'surname'  => $data['data']['nombre']['segundo_apellido'],
          'birth_date' => $data['data']['fecha_nacimiento'],
          'email' => $data['data']['email'],
          'uuid' => $n,
          'access_token' => $data['access_token']
      ];

  $user = vetfyUserExistsERP($data_user);

  $response = verificarCredenciales($user);
  if (!empty($response)){
    $_SESSION['_DIGITAL'] = 'success';
    $_SESSION["_CARGO"] = $response['id_cargo'];
    $_SESSION["_CONT_ALERTAS"] = $response['cont_alertas'];
    $_SESSION["_CONT_INTERINO"] = $response['cont_interino'];
    $_SESSION["_NOM_USUARIO"] = $response['nombre_usuario'];
    $_SESSION["_BASE_DATOS"] = $response['nombre_basedatos'];
    $_SESSION["_MINI_LOGO"] = $response['mini_logo'];
    $_SESSION["_LOGO"] = $response['icono_notificaciones'];
    $_SESSION["_ID_USUARIO_OFUS"] = $response['id_usuario'];
    $_SESSION["_ID_FUNCIOANRIO_OFUS"] = $response['id_funcionario'];
    $_SESSION["_AUTENTIFICACION"] = $response['autentificacion'];
    $_SESSION["_ESTILO_VISTA"] = $response['estilo_vista'];
    $_SESSION["mensaje_tec"] = $response['mensaje_tec'];
    $_SESSION["_SIS_INTEGRACION"] = $response['sis_integracion'];
    $_SESSION["_PUERTO_WEBSOCKET"] = $response['puerto_websocket'];
    $_SESSION["_TIMEOUT"] = $response['timeout'];
  }
   // echo(json_encode($user->datos));exit;
   // var_dump($user);exit;
}

function vetfyUserExistsERP($data){
          $objPostData=new CTPostData();
          $arr_unlink=array();
          $aPostData=$objPostData->getData();

          $_SESSION["_PETICION"]=serialize($aPostData);
          $objParam = new CTParametro($aPostData['p'],null,$aPostFiles);

          $objParam->addParametro('nombre', $data['first_name']);
          $objParam->addParametro('ap_materno', $data['surname']);
          $objParam->addParametro('ap_paterno', $data['last_name']);
          $objParam->addParametro('ci', $data['documento_identidad']);
          $objParam->addParametro('correo', $data['email']);
          $objParam->addParametro('tipo_documento', $data['tipo_documento']);
          $objParam->addParametro('expedicion', 'CB');
          $objParam->addParametro('fecha_nacimiento', $data['birth_date']);
          $objParam->addParametro('access_token', $data['access_token']);
          $objFunc=new MODPersona($objParam);
          $response=$objFunc->personaDigital();

          if($response->getTipo()=='ERROR'){
            $response = array('erro' => true , 'message' => 'Se ha producido un error-> Mensaje Técnico:'.$res->getMensajeTec());
          }

          return $response->getDatos();
}

function verificarCredenciales($user){

  $data = [
          'usuario' => $user['cuenta'],
          'contrasena' => $user['contrasena']
      ];


  $objPostData=new CTPostData();
  $arr_unlink=array();
  $aPostData=$objPostData->getData();

  $_SESSION["_PETICION"]=serialize($aPostData);
  $objParam = new CTParametro($aPostData['p'],null,$aPostFiles);


  $objParam->addParametro('usuario', $data['usuario']);
  $objParam->addParametro('contrasena', $data['contrasena']);
  $objFunc=new MODUsuario($objParam);
  $response=$objFunc->ValidaUsuarioToken();


  if($response->getTipo()=='ERROR'){
    $response = array('erro' => true , 'message' => 'Se ha producido un error-> Mensaje Técnico:'.$res->getMensajeTec());
  }

  $datos=$response->getDatos();



    $_SESSION["autentificado"] = "SI";
    $_SESSION["ss_id_usuario"] = $datos['id_usuario'];

    $_SESSION["ss_id_funcionario"] = $datos['id_funcionario'];
    $_SESSION["ss_id_cargo"] = $datos['id_cargo'];
    $_SESSION["ss_id_persona"] = $datos['id_persona'];

    $_SESSION["_SESION"]->setIdUsuario($datos['id_usuario']);
    //cambia el estado del Objeto de sesion activa
    $_SESSION["_SESION"]->setEstado("activa");

    if($_SESSION["_ESTADO_SISTEMA"]=='desarrollo'){
        $_SESSION["mensaje_tec"]=true;
    }
    else{
        $_SESSION["mensaje_tec"]=false;
    }

    $mres = new Mensaje();

    if($_SESSION["_OFUSCAR_ID"]=='si'){
      $id_usuario_ofus = $mres->ofuscar(($datos['id_usuario']));
      $id_funcionario_ofus = $mres->ofuscar(($datos['id_funcionario']));
    }
    else{
      $id_usuario_ofus = $datos['id_usuario'];
      $id_funcionario_ofus = $datos['id_funcionario'];
    }



		$_SESSION["_CONT_ALERTAS"] = $datos['cont_alertas'];
		$_SESSION["_CONT_INTERINO"] = $datos['cont_interino'];
		$_SESSION["_NOM_USUARIO"] = $datos['nombre']." ".$datos['apellido_paterno']." ".$datos['apellido_materno'];
		$_SESSION["_ID_USUARIO_OFUS"] = $id_usuario_ofus;
		$_SESSION["_ID_FUNCIOANRIO_OFUS"] = $id_funcionario_ofus;
		$_SESSION["_AUTENTIFICACION"] = $datos['autentificacion'];
		$_SESSION["_ESTILO_VISTA"] = $datos['estilo'];

		if(!isset($_SESSION["_SIS_INTEGRACION"])){
		    $sis_integracion = 'NO';
		}
    else{
        $sis_integracion = $_SESSION["_SIS_INTEGRACION"];
    }


		if(isset($_SESSION["ss_id_cargo"]) && $_SESSION["ss_id_cargo"] !=''){

			$id_cargo = $_SESSION["ss_id_cargo"];
		}
		else{
			$id_cargo = 0;
		}



    $_SESSION["_SESION"]->actualizarLlaves($_SESSION['key_k'], $_SESSION['key_p'], $_SESSION['key_p_inv'], $_SESSION['key_m'], $_SESSION['key_d'], $_SESSION['key_e']);


    $logo = str_replace('../../../', '', $_SESSION['_MINI_LOGO']);
    $logo = ($_SESSION["_FORSSL"]=="SI") ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'] . $_SESSION["_FOLDER"] . $logo;

     $success = array('id_cargo' => $id_cargo,
                      'cont_alertas' => $_SESSION["_CONT_ALERTAS"],
                      'cont_interino' => $_SESSION["_CONT_INTERINO"],
                      'nombre_usuario' => $_SESSION["_NOM_USUARIO"],
                      'nombre_basedatos' =>$_SESSION["_BASE_DATOS"],
                      'mini_logo' => $_SESSION["_MINI_LOGO"],
                      'icono_notificaciones' => $logo,
                      'id_usuario' => $_SESSION["_ID_USUARIO_OFUS"],
                      'id_funcionario' => $_SESSION["_ID_FUNCIOANRIO_OFUS"],
                      'autentificacion' => $_SESSION["_AUTENTIFICACION"],
                      'estilo_vista' => $_SESSION["_ESTILO_VISTA"],
                      'mensaje_tec' => $_SESSION["mensaje_tec"],
                      'sis_integracion' => $sis_integracion,
                      'puerto_websocket' => $_SESSION["_PUERTO_WEBSOCKET"],
                      'timeout' => $_SESSION["_TIMEOUT"]
                      );

      return $success;

}

 ?>
