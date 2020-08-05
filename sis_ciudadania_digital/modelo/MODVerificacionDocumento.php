<?php
/**
*@package pXP
*@file MODVerificacionDocumento.php
*@author  (breydi.vasquez)
*@date 15-07-2020 15:03:27
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/

class MODVerificacionDocumento extends MODbase{

	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}

	function listarVerificacionDocumento(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='agetic.ft_verificacion_documento_sel';
		$this->transaccion='AGETIC_VERFDOC_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion

		//Definicion de la lista del resultado del query
		$this->captura('id_verificacion_documento','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('documento','text');
		$this->captura('id_tramite','varchar');
		$this->captura('tipo_documento','varchar');
		$this->captura('transaction_id','varchar');		
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

	function insertarVerificacionDocumento(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_verificacion_documento_ime';
		$this->transaccion='AGETIC_VERFDOC_INS';
		$this->tipo_procedimiento='IME';

		//Define los parametros para la funcion
		$this->setParametro('documento','documento','text');
		$this->setParametro('tipo_documento','tipo_documento','varchar');
		$this->setParametro('id_tramite','id_tramite','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function modificarVerificacionDocumento(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_verificacion_documento_ime';
		$this->transaccion='AGETIC_VERFDOC_MOD';
		$this->tipo_procedimiento='IME';

		//Define los parametros para la funcion
		$this->setParametro('id_verificacion_documento','id_verificacion_documento','int4');
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

	function eliminarVerificacionDocumento(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_verificacion_documento_ime';
		$this->transaccion='AGETIC_VERFDOC_ELI';
		$this->tipo_procedimiento='IME';

		//Define los parametros para la funcion
		$this->setParametro('id_verificacion_documento','id_verificacion_documento','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function registroDatosVerificacion () {
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_verificacion_documento_ime';
		$this->transaccion='AGETIC_REGDVEF_IME';
		$this->tipo_procedimiento='IME';

		//Define los parametros para la funcion
		$this->setParametro('id','id','int4');
		$this->setParametro('registros_data','registros_data','json');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function listarregistroDatosVerificacion () {
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='agetic.ft_verificacion_documento_sel';
		$this->transaccion='AGETIC_REGDVEF_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
		$this->setCount(false);

		$this->setParametro('registros', 'registros', 'text');
		//Definicion de la lista del resultado del query
		$this->captura('fecha_solicitud','varchar');
		$this->captura('nombres','varchar');
		$this->captura('primer_apellido','varchar');
		$this->captura('segundo_apellido','varchar');
		$this->captura('descripcion','varchar');
		$this->captura('fecha_reg','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
}
?>
