<?php
/**
*@package pXP
*@file MODRespuestaSolicitudAprobacion.php
*@author  (breydi.vasquez)
*@date 15-07-2020 15:03:33
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/

class MODRespuestaSolicitudAprobacion extends MODbase{

	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}

	function listarRespuestaSolicitudAprobacion(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='agetic.ft_respuesta_solicitud_aprobacion_sel';
		$this->transaccion='AGETIC_RESOLAPB_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion

		//Definicion de la lista del resultado del query
		$this->captura('id_respuesta_solicitud','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('finalizado','bool');
		$this->captura('estado','bool');
		$this->captura('mensaje','text');
		$this->captura('link_verificacion','varchar');
		$this->captura('link_verificacion_unico','varchar');
		$this->captura('transaction_code','varchar');
		$this->captura('request_uuid','varchar');
		$this->captura('redirect_uri','varchar');
		$this->captura('id_notificacion_solicitud','int4');
		$this->captura('id_usuario_reg','int4');
		$this->captura('fecha_reg','timestamp');
		$this->captura('id_usuario_ai','int4');
		$this->captura('usuario_ai','varchar');
		$this->captura('id_usuario_mod','int4');
		$this->captura('fecha_mod','timestamp');
		$this->captura('usr_reg','varchar');
		$this->captura('usr_mod','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function insertarRespuestaSolicitudAprobacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_respuesta_solicitud_aprobacion_ime';
		$this->transaccion='AGETIC_RESOLAPB_INS';
		$this->tipo_procedimiento='IME';
		//Define los parametros para la funcion
		
		$this->setParametro('finalizado','finalizado','bool');
		$this->setParametro('estado','estado','bool');
		$this->setParametro('mensaje','mensaje','text');
		$this->setParametro('link_verificacion','link_verificacion','varchar');
		$this->setParametro('link_verificacion_unico','link_verificacion_unico','varchar');
		$this->setParametro('transaction_code','transaction_code','varchar');
		$this->setParametro('request_uuid','request_uuid','varchar');
		$this->setParametro('redirect_uri','redirect_uri','varchar');
		$this->setParametro('uuid_blockchain','uuid_blockchain','varchar');


		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function modificarRespuestaSolicitudAprobacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_respuesta_solicitud_aprobacion_ime';
		$this->transaccion='AGETIC_RESOLAPB_MOD';
		$this->tipo_procedimiento='IME';

		//Define los parametros para la funcion
		$this->setParametro('id_respuesta_solicitud','id_respuesta_solicitud','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('finalizado','finalizado','bool');
		$this->setParametro('estado','estado','bool');
		$this->setParametro('mensaje','mensaje','text');
		$this->setParametro('link_verificacion','link_verificacion','varchar');
		$this->setParametro('link_verificacion_unico','link_verificacion_unico','varchar');
		$this->setParametro('transaction_code','transaction_code','varchar');
		$this->setParametro('request_uuid','request_uuid','varchar');
		$this->setParametro('redirect_uri','redirect_uri','varchar');
		$this->setParametro('id_notificacion_solicitud','id_notificacion_solicitud','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function eliminarRespuestaSolicitudAprobacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_respuesta_solicitud_aprobacion_ime';
		$this->transaccion='AGETIC_RESOLAPB_ELI';
		$this->tipo_procedimiento='IME';

		//Define los parametros para la funcion
		$this->setParametro('id_respuesta_solicitud','id_respuesta_solicitud','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

}
?>
