<?php
/**
*@package pXP
*@file MODAtosEnviadosCdig.php
*@author  (breydi.vasquez)
*@date 30-06-2020 16:16:10
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/

class MODDatosEnviadosCdig extends MODbase{

	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}

	function listarDatosEnviadosCdig(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='agetic.ft_datos_enviados_cdig_sel';
		$this->transaccion='AGETIC_DENVAPD_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion

		//Definicion de la lista del resultado del query
		$this->captura('id_dato_enviado','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('id_tramite','varchar');
		$this->captura('access_token_usado','varchar');
		$this->captura('tipo_documento','varchar');
		$this->captura('documento','text');
		$this->captura('tamanio_documento','varchar');
		$this->captura('descripcion','varchar');
		$this->captura('hash_documento','varchar');
		$this->captura('id_documento','int4');
		$this->captura('id_gestion','int4');
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

	function insertarDatosEnviadosCdig(){
		// var_dump($this);exit;
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_datos_enviados_cdig_ime';
		$this->transaccion='AGETIC_DENVAPD_INS';
		$this->tipo_procedimiento='IME';

		//Define los parametros para la funcion
		// $this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_tramite','id_tramite','varchar');
		$this->setParametro('access_token_usado','access_token_usado','varchar');
		$this->setParametro('tipo_documento','tipo_documento','varchar');
		$this->setParametro('documento','documento','text');
		// $this->setParametro('tamanio_documento','tamanio_documento','varchar');
		$this->setParametro('descripcion','descripcion','varchar');
		$this->setParametro('hash_documento','hash_documento','varchar');
		$this->setParametro('id_estado_wf','id_estado_wf','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function modificarDatosEnviadosCdig(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_datos_enviados_cdig_ime';
		$this->transaccion='AGETIC_DENVAPD_MOD';
		$this->tipo_procedimiento='IME';

		//Define los parametros para la funcion
		$this->setParametro('id_dato_enviado','id_dato_enviado','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_tramite','id_tramite','varchar');
		$this->setParametro('access_token_usado','access_token_usado','varchar');
		$this->setParametro('tipo_documento','tipo_documento','varchar');
		$this->setParametro('documento','documento','text');
		$this->setParametro('tamanio_documento','tamanio_documento','varchar');
		$this->setParametro('descripcion','descripcion','varchar');
		$this->setParametro('hash_documento','hash_documento','varchar');
		$this->setParametro('id_documento','id_documento','int4');
		$this->setParametro('id_gestion','id_gestion','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function eliminarDatosEnviadosCdig(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_datos_enviados_cdig_ime';
		$this->transaccion='AGETIC_DENVAPD_ELI';
		$this->tipo_procedimiento='IME';

		//Define los parametros para la funcion
		$this->setParametro('id_dato_enviado','id_dato_enviado','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function getTokenUser(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_datos_enviados_cdig_ime';
		$this->transaccion='AGETIC_GETOKENUSER_IME';
		$this->tipo_procedimiento='IME';
		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
}
?>
