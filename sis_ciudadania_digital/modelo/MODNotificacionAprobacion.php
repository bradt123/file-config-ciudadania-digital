<?php
/**
*@package pXP
*@file MODNotificacionAprobacion.php
*@author  (breydi.vasquez)
*@date 30-06-2020 16:16:14
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/

class MODNotificacionAprobacion extends MODbase{

	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}

	function listarNotificacionAprobacion(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='agetic.ft_notificacion_aprobacion_sel';
		$this->transaccion='AGETIC_NOTAPD_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion

		//Definicion de la lista del resultado del query
		$this->captura('id_notificacion','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('aceptado','bool');
		$this->captura('introducido','bool');
		$this->captura('solicitud_uuid','varchar');
		$this->captura('codigo_operacion','varchar');
		$this->captura('mensaje','text');
		$this->captura('id_transaccion','varchar');
		$this->captura('fecha_solicitud','varchar');
		$this->captura('hash_datos','varchar');
		$this->captura('ci','varchar');
		$this->captura('id_gestion','int4');
		$this->captura('id_periodo','int4');
		$this->captura('id_usuario_reg','int4');
		$this->captura('fecha_reg','timestamp');
		$this->captura('id_usuario_ai','int4');
		$this->captura('usuario_ai','varchar');
		$this->captura('id_usuario_mod','int4');
		$this->captura('fecha_mod','timestamp');
		$this->captura('usr_reg','varchar');
		$this->captura('usr_mod','varchar');
		$this->captura('gestion','int4');
		$this->captura('mes','varchar');
		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function insertarNotificacionAprobacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_notificacion_aprobacion_ime';
		$this->transaccion='AGETIC_NOTAPD_INS';
		$this->tipo_procedimiento='IME';

		//Define los parametros para la funcion
		$this->setParametro('aceptado','aceptado','bool');
		$this->setParametro('introducido','introducido','bool');
		$this->setParametro('solicitud_uuid','solicitud_uuid','varchar');
		$this->setParametro('codigo_operacion','codigo_operacion','varchar');
		$this->setParametro('mensaje','mensaje','text');
		$this->setParametro('id_transaccion','id_transaccion','varchar');
		$this->setParametro('fecha_solicitud','fecha_solicitud','varchar');
		$this->setParametro('hash_datos','hash_datos','varchar');
		$this->setParametro('ci','ci','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function modificarNotificacionAprobacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_notificacion_aprobacion_ime';
		$this->transaccion='AGETIC_NOTAPD_MOD';
		$this->tipo_procedimiento='IME';

		//Define los parametros para la funcion
		$this->setParametro('id_notificacion','id_notificacion','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('aceptado','aceptado','bool');
		$this->setParametro('introducido','introducido','bool');
		$this->setParametro('solicitud_uuid','solicitud_uuid','varchar');
		$this->setParametro('codigo_operacion','codigo_operacion','varchar');
		$this->setParametro('mensaje','mensaje','text');
		$this->setParametro('id_transaccion','id_transaccion','varchar');
		$this->setParametro('fecha_solicitud','fecha_solicitud','varchar');
		$this->setParametro('hash_datos','hash_datos','varchar');
		$this->setParametro('ci','ci','varchar');
		$this->setParametro('id_gestion','id_gestion','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function eliminarNotificacionAprobacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_notificacion_aprobacion_ime';
		$this->transaccion='AGETIC_NOTAPD_ELI';
		$this->tipo_procedimiento='IME';

		//Define los parametros para la funcion
		$this->setParametro('id_notificacion','id_notificacion','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function notificacionAprobacionAgetic() {
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_notificacion_aprobacion_ime';
		$this->transaccion='AGETIC_NOTAPD_INS';
		$this->tipo_procedimiento='IME';
		$datoJSONAgetic = file_get_contents("php://input");
		$arrayAgetic = json_decode($datoJSONAgetic, true);
		$this->arreglo=array("aceptado" => $arrayAgetic['aceptado'],
							 					 "introducido" => $arrayAgetic['introducido'],
							 				 	 "solicitud_uuid" => $arrayAgetic['requestUuid'],
												 "codigo_operacion" => $arrayAgetic['codigoOperacion'],
												 "mensaje" => $arrayAgetic['mensaje'],
												 "id_transaccion" => $arrayAgetic['transaction_id'],
												 "fecha_solicitud" => $arrayAgetic['fechaHoraSolicitud'],
												 "hash_datos" => $arrayAgetic['hashDatos'],
												 "ci" => $arrayAgetic['ci'],
												);

// var_dump($this->arreglo);exit;

		$this->setParametro('aceptado', 'aceptado','bool');
		$this->setParametro('introducido', 'introducido','bool');
		$this->setParametro('solicitud_uuid', 'solicitud_uuid','varchar');
		$this->setParametro('codigo_operacion', 'codigo_operacion','varchar');
		$this->setParametro('mensaje', 'mensaje','text');
		$this->setParametro('id_transaccion', 'id_transaccion','varchar');
		$this->setParametro('fecha_solicitud', 'fecha_solicitud','varchar');
		$this->setParametro('hash_datos', 'hash_datos','varchar');
		$this->setParametro('ci', 'ci','varchar');
		// $this->setParametro('aceptado', $arrayAgetic['aceptado'],'bool');
		// $this->setParametro('introducido', $arrayAgetic['introducido'],'bool');
		// $this->setParametro('solicitud_uuid', $arrayAgetic['requestUuid'],'varchar');
		// $this->setParametro('codigo_operacion', $arrayAgetic['codigoOperacion'],'varchar');
		// $this->setParametro('mensaje', $arrayAgetic['mensaje'],'text');
		// $this->setParametro('id_transaccion', $arrayAgetic['transaction_id'],'varchar');
		// $this->setParametro('fecha_solicitud', $arrayAgetic['fechaHoraSolicitud'],'varchar');
		// $this->setParametro('hash_datos', $arrayAgetic['hashDatos'],'varchar');
		// $this->setParametro('ci', $arrayAgetic['ci'],'varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

}
?>
