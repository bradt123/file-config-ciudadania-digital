<?php
include_once(dirname(__FILE__)."/DigitalCitizenship.php");
include_once(dirname(__FILE__)."/ACTAuth20ERP.php");

if (!is_null($_GET["code"])) {

  $oauth2 = new DigitalCitizenship($_GET["code"]);
  $data = $oauth2->accessDigital();
  if($data['error']){
    echo('<div id="flash-messages_erp" class="flash-messages_erp error">
        <p>
          '.$data['error'].'
        </p>
    </div>
    <script>
        var flashMessageContainer = document.getElementById("flash-messages_erp");
        setTimeout(function() {
            flashMessageContainer.classList.add("slideUp");
        }, 5000);
    </script>
    ');
    // echo($data['error']);
  }else{
    authenticationERP($data, ERP_NONCE);
  }
}else {
  // $response = verificarCredenciales();
  //
  // if (!empty($response)){
  //   $_SESSION['_DIGITAL'] = 'success';
  //   $_SESSION["_CARGO"] = $response['id_cargo'];
  //   $_SESSION["_CONT_ALERTAS"] = $response['cont_alertas'];
  //   $_SESSION["_CONT_INTERINO"] = $response['cont_interino'];
  //   $_SESSION["_NOM_USUARIO"] = $response['nombre_usuario'];
  //   $_SESSION["_BASE_DATOS"] = $response['nombre_basedatos'];
  //   $_SESSION["_MINI_LOGO"] = $response['mini_logo'];
  //   $_SESSION["_LOGO"] = $response['icono_notificaciones'];
  //   $_SESSION["_ID_USUARIO_OFUS"] = $response['id_usuario'];
  //   $_SESSION["_ID_FUNCIOANRIO_OFUS"] = $response['id_funcionario'];
  //   $_SESSION["_AUTENTIFICACION"] = $response['autentificacion'];
  //   $_SESSION["_ESTILO_VISTA"] = $response['estilo_vista'];
  //   $_SESSION["mensaje_tec"] = $response['mensaje_tec'];
  //   $_SESSION["_SIS_INTEGRACION"] = $response['sis_integracion'];
  //   $_SESSION["_PUERTO_WEBSOCKET"] = $response['puerto_websocket'];
  //   $_SESSION["_TIMEOUT"] = $response['timeout'];
  // }

}
 ?>
