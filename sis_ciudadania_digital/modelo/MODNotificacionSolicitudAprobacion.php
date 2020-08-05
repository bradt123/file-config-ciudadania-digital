<?php
/**
*@package pXP
*@file MODNotificacionSolicitudAprobacion.php
*@author  (breydi.vasquez)
*@date 15-07-2020 15:03:30
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/

class MODNotificacionSolicitudAprobacion extends MODbase{

	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}

	function listarNotificacionSolicitudAprobacion(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='agetic.ft_notificacion_solicitud_aprobacion_sel';
		$this->transaccion='AGETIC_NTSOLAPB_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion

		//Definicion de la lista del resultado del query
		$this->captura('id_notificacion_solicitud','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('aceptado','bool');
		$this->captura('introducido','bool');
		$this->captura('request_uuid','varchar');
		$this->captura('codigo_operacion','varchar');
		$this->captura('mensaje','text');
		$this->captura('transaction_id','varchar');
		$this->captura('fecha_hora_solicitud','varchar');
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

	function insertarNotificacionSolicitudAprobacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_notificacion_solicitud_aprobacion_ime';
		$this->transaccion='AGETIC_NTSOLAPB_INS';
		$this->tipo_procedimiento='IME';

		//Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('aceptado','aceptado','bool');
		$this->setParametro('introducido','introducido','bool');
		$this->setParametro('request_uuid','request_uuid','varchar');
		$this->setParametro('codigo_operacion','codigo_operacion','varchar');
		$this->setParametro('mensaje','mensaje','text');
		$this->setParametro('transaction_id','transaction_id','varchar');
		$this->setParametro('fecha_hora_solicitud','fecha_hora_solicitud','varchar');
		$this->setParametro('hash_datos','hash_datos','varchar');
		$this->setParametro('ci','ci','varchar');
		$this->setParametro('id_gestion','id_gestion','int4');
		$this->setParametro('id_periodo','id_periodo','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function modificarNotificacionSolicitudAprobacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_notificacion_solicitud_aprobacion_ime';
		$this->transaccion='AGETIC_NTSOLAPB_MOD';
		$this->tipo_procedimiento='IME';

		//Define los parametros para la funcion
		$this->setParametro('id_notificacion_solicitud','id_notificacion_solicitud','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('aceptado','aceptado','bool');
		$this->setParametro('introducido','introducido','bool');
		$this->setParametro('request_uuid','request_uuid','varchar');
		$this->setParametro('codigo_operacion','codigo_operacion','varchar');
		$this->setParametro('mensaje','mensaje','text');
		$this->setParametro('transaction_id','transaction_id','varchar');
		$this->setParametro('fecha_hora_solicitud','fecha_hora_solicitud','varchar');
		$this->setParametro('hash_datos','hash_datos','varchar');
		$this->setParametro('ci','ci','varchar');
		$this->setParametro('id_gestion','id_gestion','int4');
		$this->setParametro('id_periodo','id_periodo','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function eliminarNotificacionSolicitudAprobacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_notificacion_solicitud_aprobacion_ime';
		$this->transaccion='AGETIC_NTSOLAPB_ELI';
		$this->tipo_procedimiento='IME';

		//Define los parametros para la funcion
		$this->setParametro('id_notificacion_solicitud','id_notificacion_solicitud','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
	function notificacionAprobacionAgetic() {
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_notificacion_solicitud_aprobacion_ime';
		$this->transaccion='AGETIC_NTSOLAPB_INS';
		$this->tipo_procedimiento='IME';
		// $datoJSONAgetic = file_get_contents("php://input");
		// $arrayAgetic = json_decode($datoJSONAgetic, true);
		// $this->arreglo=array("aceptado" => $arrayAgetic['aceptado'],
		// 										 "introducido" => $arrayAgetic['introducido'],
		// 										 "request_uuid" => $arrayAgetic['requestUuid'],
		// 										 "codigo_operacion" => $arrayAgetic['codigoOperacion'],
		// 										 "mensaje" => $arrayAgetic['mensaje'],
		// 										 "transaction_id" => $arrayAgetic['transaction_id'],
		// 										 "fecha_hora_solicitud" => $arrayAgetic['fechaHoraSolicitud'],
		// 										 "hash_datos" => $arrayAgetic['hashDatos'],
		// 										 "ci" => $arrayAgetic['ci'],
		// 										);

	// var_dump($this->arreglo);exit;

		$this->setParametro('aceptado', 'aceptado','bool');
		$this->setParametro('introducido', 'introducido','bool');
		$this->setParametro('request_uuid', 'request_uuid','varchar');
		$this->setParametro('codigo_operacion', 'codigo_operacion','varchar');
		$this->setParametro('mensaje', 'mensaje','text');
		$this->setParametro('transaction_id', 'transaction_id','varchar');
		$this->setParametro('fecha_hora_solicitud', 'fecha_hora_solicitud','varchar');
		$this->setParametro('hash_datos', 'hash_datos','varchar');
		$this->setParametro('ci', 'ci','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
}
?>
