<?php
/**
*@package pXP
*@file ACTNotificacionSolicitudAprobacion.php
*@author  (breydi.vasquez)
*@date 15-07-2020 15:03:30
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/

class ACTNotificacionSolicitudAprobacion extends ACTbase{

	function listarNotificacionSolicitudAprobacion(){
		$this->objParam->defecto('ordenacion','id_notificacion_solicitud');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODNotificacionSolicitudAprobacion','listarNotificacionSolicitudAprobacion');
		} else{
			$this->objFunc=$this->create('MODNotificacionSolicitudAprobacion');

			$this->res=$this->objFunc->listarNotificacionSolicitudAprobacion($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

	function insertarNotificacionSolicitudAprobacion(){
		$this->objFunc=$this->create('MODNotificacionSolicitudAprobacion');
		if($this->objParam->insertar('id_notificacion_solicitud')){
			$this->res=$this->objFunc->insertarNotificacionSolicitudAprobacion($this->objParam);
		} else{
			$this->res=$this->objFunc->modificarNotificacionSolicitudAprobacion($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

	function eliminarNotificacionSolicitudAprobacion(){
			$this->objFunc=$this->create('MODNotificacionSolicitudAprobacion');
		$this->res=$this->objFunc->eliminarNotificacionSolicitudAprobacion($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
	function notificacionAprobacionAgetic() {
		$datoJSONAgetic = file_get_contents("php://input");
		$arrayAgetic = json_decode($datoJSONAgetic, true);
		$this->objParam->addParametro('aceptado', $arrayAgetic['aceptado']);
		$this->objParam->addParametro('introducido', $arrayAgetic['introducido']);
		$this->objParam->addParametro('request_uuid', $arrayAgetic['requestUuid']);
		$this->objParam->addParametro('codigo_operacion', $arrayAgetic['codigoOperacion']);
		$this->objParam->addParametro('mensaje', $arrayAgetic['mensaje']);
		$this->objParam->addParametro('transaction_id', $arrayAgetic['transaction_id']);
		$this->objParam->addParametro('fecha_hora_solicitud', $arrayAgetic['fechaHoraSolicitud']);
		$this->objParam->addParametro('hash_datos', $arrayAgetic['hashDatos']);
		$this->objParam->addParametro('ci', $arrayAgetic['ci']);
		$this->objFunc=$this->create('MODNotificacionSolicitudAprobacion');
		$this->res=$this->objFunc->notificacionAprobacionAgetic($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
	/***************************Servicio para la AGETIC, Servicio de notificacion de aprobacion de documentos ************************/
	function notificacionAprobacionAgetic_sss() {
		$datoJSONAgetic = file_get_contents("php://input");
		// $arrayAgetic = json_decode($datoJSONAgetic, true);
		// $this->objParam->addParametro('aceptado', $arrayAgetic['aceptado']);
		// $this->objParam->addParametro('introducido', $arrayAgetic['introducido']);
		// $this->objParam->addParametro('request_uuid', $arrayAgetic['requestUuid']);
		// $this->objParam->addParametro('codigo_operacion', $arrayAgetic['codigoOperacion']);
		// $this->objParam->addParametro('mensaje', $arrayAgetic['mensaje']);
		// $this->objParam->addParametro('transaction_id', $arrayAgetic['transaction_id']);
		// $this->objParam->addParametro('fecha_hora_solicitud', $arrayAgetic['fechaHoraSolicitud']);
		// $this->objParam->addParametro('hash_datos', $arrayAgetic['hashDatos']);
		// $this->objParam->addParametro('ci', $arrayAgetic['ci']);

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://erp.obairlines.bo/lib/rest/ciudadania_digital/NotificacionSolicitudAprobacion/notificacionAprobacionAgetic",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => $datoJSONAgetic,
		  CURLOPT_HTTPHEADER => array(
		    "Php-Auth-User: U6H4vXSf2pNP2GI+Fahh9kxAOCbibL07XZI/r3c2FE0=",
		    "Pxp-user: breydi.vasquez",
		    "Content-Type: application/json"
		  ),
		));

		$response = curl_exec($curl);
		$error = curl_error($curl);

		curl_close($curl);

		 if ($error) {
			 $error_service = array('finalizado' => false, 'mensaje' => $err);
			 echo json_encode($error_service);
		 } else {
			 $data_erp = json_decode($response);
			 $data_error = $data_erp->ROOT->error;

			 if (!$data_error){
				 $sucess = array('finalizado' => true, 'mensaje' =>$data_erp->ROOT->datos->mensaje);
				 	echo json_encode($sucess);
			 }else{
				 $error_service = array('finalizado' => false, 'mensaje' => 'Registro de notificacion: '.$data_erp->ROOT->detalle->mensaje);
				 echo json_encode($error_service);
			 }
		 }
	}
}

?>
