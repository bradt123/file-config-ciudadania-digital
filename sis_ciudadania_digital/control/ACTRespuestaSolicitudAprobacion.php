<?php
/**
*@package pXP
*@file ACTRespuestaSolicitudAprobacion.php
*@author  (breydi.vasquez)
*@date 15-07-2020 15:03:33
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/

class ACTRespuestaSolicitudAprobacion extends ACTbase{

	function listarRespuestaSolicitudAprobacion(){
		$this->objParam->defecto('ordenacion','id_respuesta_solicitud');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODRespuestaSolicitudAprobacion','listarRespuestaSolicitudAprobacion');
		} else{
			$this->objFunc=$this->create('MODRespuestaSolicitudAprobacion');

			$this->res=$this->objFunc->listarRespuestaSolicitudAprobacion($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

	function insertarRespuestaSolicitudAprobacion(){
		$this->objFunc=$this->create('MODRespuestaSolicitudAprobacion');
		if($this->objParam->insertar('id_respuesta_solicitud')){
			$this->res=$this->objFunc->insertarRespuestaSolicitudAprobacion($this->objParam);
		} else{
			$this->res=$this->objFunc->modificarRespuestaSolicitudAprobacion($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

	function eliminarRespuestaSolicitudAprobacion(){
			$this->objFunc=$this->create('MODRespuestaSolicitudAprobacion');
		$this->res=$this->objFunc->eliminarRespuestaSolicitudAprobacion($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

}

?>
