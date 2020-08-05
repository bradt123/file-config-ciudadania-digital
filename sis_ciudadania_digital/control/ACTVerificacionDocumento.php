<?php
/**
*@package pXP
*@file VerificacionDocumento.php
*@author  (breydi.vasquez)
*@date 15-07-2020 15:03:27
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/

class ACTVerificacionDocumento extends ACTbase{

	function listarVerificacionDocumento(){
		$this->objParam->defecto('ordenacion','id_verificacion_documento');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODVerificacionDocumento','listarVerificacionDocumento');
		} else{
			$this->objFunc=$this->create('MODVerificacionDocumento');

			$this->res=$this->objFunc->listarVerificacionDocumento($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

	function insertarVerificacionDocumento(){
		$this->objFunc=$this->create('MODVerificacionDocumento');
		if($this->objParam->insertar('id_verificacion_documento')){
			$this->res=$this->objFunc->insertarVerificacionDocumento($this->objParam);
		} else{
			$this->res=$this->objFunc->modificarVerificacionDocumento($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

	function eliminarVerificacionDocumento(){
			$this->objFunc=$this->create('MODVerificacionDocumento');
		$this->res=$this->objFunc->eliminarVerificacionDocumento($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

	function getTokenUser () {
      $this->objFunc = $this->create('MODDatosEnviadosCdig');
      $cbteHeader = $this->objFunc->getTokenUser($this->objParam);
      if($cbteHeader->getTipo() == 'EXITO'){
          return $cbteHeader;
      }
      else{
          $cbteHeader->imprimirRespuesta($cbteHeader->generarJson());
          exit;
      }

  }

	function verificacionDocumentoHash () {

				$document = $this->objParam->getParametro('tramite');
				$type_doc = $this->objParam->getParametro('tipo');
				$type_verf = $this->objParam->getParametro('t_v');
				$transaction_id  = $this->objParam->getParametro('transaction_id');

				if ($type_doc=='PDF') {
							$data = file_get_contents($document);
							$docBase64 = base64_encode($data);
				} else {
							$docBase64 = base64_encode($document);
				}

				$data = array("archivo" => $docBase64) ;
				$res = $this->verificacionDocumentoAgetic($data, $type_verf, $transaction_id);
				echo json_encode($res);

	}

	private function verificacionDocumentoAgetic ($data, $type_verf, $transaction_id) {

				$token_user = $this->getTokenUser()->getDatos();
				$token_interop = $token_user['token_interop'];
				$header = array("Authorization: Bearer {$token_interop}",
												"Content-Type: application/json");

				if ($type_verf == 'transaction_id') {
						$uri_service = "https://interoperabilidad.agetic.gob.bo/fake/aprobacion-documentos/v1/verificaciones/transacciones/{$transaction_id}";
				}	else {
						$uri_service = "https://interoperabilidad.agetic.gob.bo/fake/aprobacion-documentos/v1/verificaciones";
				}

				$dataSend= json_encode($data);
				
				$resp = array();
				$curl = curl_init();

				curl_setopt_array($curl, array(
					CURLOPT_URL => $uri_service,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_POSTFIELDS => $dataSend,
					CURLOPT_HTTPHEADER => $header
				));

				$response = curl_exec($curl);
				$error = curl_error($curl);

				curl_close($curl);

				if ($error) {
					$resp = array('conneccion' => false, 'response' => $error );
				} else {
					$resp = array('conneccion' => true, 'response' => $response );
				}

			return $resp;
	}

	function listarregistroDatosVerificacion () {
		$this->objParam->defecto('ordenacion','fecha_solicitud');
		$this->objParam->defecto('dir_ordenacion','asc');

		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODVerificacionDocumento','listarregistroDatosVerificacion');
		} else{
			$this->objFunc=$this->create('MODVerificacionDocumento');

			$this->res=$this->objFunc->listarregistroDatosVerificacion($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

}

?>
