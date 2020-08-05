<?php
/**
*@package pXP
*@file gen-ACTVerificacion.php
*@author  (breydi.vasquez)
*@date 30-06-2020 16:16:36
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/

class ACTVerificacion extends ACTbase{    
			
	function listarVerificacion(){
		$this->objParam->defecto('ordenacion','id_verificacion');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODVerificacion','listarVerificacion');
		} else{
			$this->objFunc=$this->create('MODVerificacion');
			
			$this->res=$this->objFunc->listarVerificacion($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarVerificacion(){
		$this->objFunc=$this->create('MODVerificacion');	
		if($this->objParam->insertar('id_verificacion')){
			$this->res=$this->objFunc->insertarVerificacion($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarVerificacion($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarVerificacion(){
			$this->objFunc=$this->create('MODVerificacion');	
		$this->res=$this->objFunc->eliminarVerificacion($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
			
}

?>