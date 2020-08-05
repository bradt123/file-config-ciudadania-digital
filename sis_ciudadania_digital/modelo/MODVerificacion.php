<?php
/**
*@package pXP
*@file MODVerificacion.php
*@author  (breydi.vasquez)
*@date 30-06-2020 16:16:36
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/

class MODVerificacion extends MODbase{

	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}

	function listarVerificacion(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='agetic.ft_verificacion_sel';
		$this->transaccion='AGETIC_VERFD_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion

		//Definicion de la lista del resultado del query
		$this->captura('id_verificacion','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('id_documento','int4');
		$this->captura('verificacion_correcta','bool');
		$this->captura('tipo_verificacion','varchar');
		$this->captura('registro','_text');
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

	function insertarVerificacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_verificacion_ime';
		$this->transaccion='AGETIC_VERFD_INS';
		$this->tipo_procedimiento='IME';

		//Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_documento','id_documento','int4');
		$this->setParametro('verificacion_correcta','verificacion_correcta','bool');
		$this->setParametro('tipo_verificacion','tipo_verificacion','varchar');
		$this->setParametro('registro','registro','_text');
		$this->setParametro('id_gestion','id_gestion','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function modificarVerificacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_verificacion_ime';
		$this->transaccion='AGETIC_VERFD_MOD';
		$this->tipo_procedimiento='IME';

		//Define los parametros para la funcion
		$this->setParametro('id_verificacion','id_verificacion','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_documento','id_documento','int4');
		$this->setParametro('verificacion_correcta','verificacion_correcta','bool');
		$this->setParametro('tipo_verificacion','tipo_verificacion','varchar');
		$this->setParametro('registro','registro','_text');
		$this->setParametro('id_gestion','id_gestion','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function eliminarVerificacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_verificacion_ime';
		$this->transaccion='AGETIC_VERFD_ELI';
		$this->tipo_procedimiento='IME';

		//Define los parametros para la funcion
		$this->setParametro('id_verificacion','id_verificacion','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

}
?>
