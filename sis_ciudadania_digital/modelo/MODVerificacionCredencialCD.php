<?php
/**
*@package pXP
*@file MODVerificacionCredencialCD.php
*@author  (breydi.vasquez)
*@date 30-06-2020 16:16:10
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/

class MODVerificacionCredencialCD extends MODbase{

	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}

	function getCredencialCD(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='agetic.ft_verificacion_credencial_ime';
		$this->transaccion='AGETIC_VFTKHA_INS';
		$this->tipo_procedimiento='IME';
		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
}
?>
