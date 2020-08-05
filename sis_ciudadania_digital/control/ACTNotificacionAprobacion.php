<?php
/**
*@package pXP
*@file gen-ACTNotificacionAprobacion.php
*@author  (breydi.vasquez)
*@date 30-06-2020 16:16:14
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/

class ACTNotificacionAprobacion extends ACTbase{

	function listarNotificacionAprobacion(){
		$this->objParam->defecto('ordenacion','id_notificacion');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODNotificacionAprobacion','listarNotificacionAprobacion');
		} else{
			$this->objFunc=$this->create('MODNotificacionAprobacion');

			$this->res=$this->objFunc->listarNotificacionAprobacion($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

	function insertarNotificacionAprobacion(){
		$this->objFunc=$this->create('MODNotificacionAprobacion');
		if($this->objParam->insertar('id_notificacion')){
			$this->res=$this->objFunc->insertarNotificacionAprobacion($this->objParam);
		} else{
			$this->res=$this->objFunc->modificarNotificacionAprobacion($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

	function eliminarNotificacionAprobacion(){
			$this->objFunc=$this->create('MODNotificacionAprobacion');
		$this->res=$this->objFunc->eliminarNotificacionAprobacion($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

	/***************************Servicio para la AGETIC, Servicio de notificacion de aprobacion de documentos ************************/
	function notificacionAprobacionAgetic() {
		$this->objFunc=$this->create('MODNotificacionAprobacion');
		$this->res=$this->objFunc->notificacionAprobacionAgetic($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

}

?>
