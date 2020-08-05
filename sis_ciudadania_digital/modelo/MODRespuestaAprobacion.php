<?php
/**
*@package pXP
*@file MODRespuestaAprobacion.php
*@author  (breydi.vasquez)
*@date 30-06-2020 16:16:18
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/

class MODRespuestaAprobacion extends MODbase{

	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}

	function listarRespuestaAprobacion(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='agetic.ft_respuesta_aprobacion_sel';
		$this->transaccion='AGETIC_RESAPD_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion

		//Definicion de la lista del resultado del query
		$this->captura('id_respuesta','int4');
		$this->captura('finalizado','bool');
		$this->captura('link','varchar');
		$this->captura('estado_proceso','varchar');
		$this->captura('id_dato_enviado','int4');
		$this->captura('fecha_reg','timestamp');
		$this->captura('usr_reg','varchar');
		$this->captura('usr_mod','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function insertarRespuestaAprobacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_respuesta_aprobacion_ime';
		$this->transaccion='AGETIC_RESAPD_INS';
		$this->tipo_procedimiento='IME';

		//Define los parametros para la funcion
		$this->setParametro('finalizado','finalizado','bool');
		$this->setParametro('link','link','varchar');
		$this->setParametro('estado_proceso','estado_proceso','varchar');
		$this->setParametro('id_dato_enviado','id_dato_enviado','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function modificarRespuestaAprobacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_respuesta_aprobacion_ime';
		$this->transaccion='AGETIC_RESAPD_MOD';
		$this->tipo_procedimiento='IME';

		//Define los parametros para la funcion
		$this->setParametro('id_respuesta','id_respuesta','int4');
		$this->setParametro('finalizado','finalizado','bool');
		$this->setParametro('link','link','varchar');
		$this->setParametro('estado_proceso','estado_proceso','varchar');
		$this->setParametro('id_dato_enviado','id_dato_enviado','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function eliminarRespuestaAprobacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_respuesta_aprobacion_ime';
		$this->transaccion='AGETIC_RESAPD_ELI';
		$this->tipo_procedimiento='IME';

		//Define los parametros para la funcion
		$this->setParametro('id_respuesta','id_respuesta','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

}
?>
