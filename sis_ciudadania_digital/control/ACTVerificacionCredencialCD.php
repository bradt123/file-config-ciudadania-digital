<?php
/**
*@package pXP
*@file ACTVerificacionCredencialCD.php
*@author  (breydi.vasquez)
*@date 30-06-2020 16:16:10
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/

class ACTVerificacionCredencialCD extends ACTbase {

	function getCredencialCD(){
			$this->objFunc=$this->create('MODVerificacionCredencialCD');
		  $this->res=$this->objFunc->getCredencialCD($this->objParam);
		  $this->res->imprimirRespuesta($this->res->generarJson());
	}

}

?>
