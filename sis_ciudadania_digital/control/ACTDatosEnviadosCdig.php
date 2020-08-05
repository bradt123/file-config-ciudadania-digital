<?php
/**
*@package pXP
*@file ACTAtosEnviadosCdig.php
*@author  (breydi.vasquez)
*@date 30-06-2020 16:16:10
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/

class ACTDAtosEnviadosCdig extends ACTbase{

	function listarDatosEnviadosCdig () {
		$this->objParam->defecto('ordenacion','id_dato_enviado');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODDatosEnviadosCdig','listarDatosEnviadosCdig');
		} else{
			$this->objFunc=$this->create('MODDatosEnviadosCdig');

			$this->res=$this->objFunc->listarDatosEnviadosCdig($this->objParam);
		}
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

	function solicitudAprobacionDJSON(){

		$token_user = $this->getTokenUser()->getDatos();
		$token_interop = $token_user['token_interop'];
		$JSON = $this->objParam->getParametro('item');
		$id_estado_wf = $this->objParam->getParametro('id_estado_wf');
		$jsonBase64 = base64_encode($JSON);
		$hashJSON = hash('sha256', $jsonBase64);
		$uuidV4 = UUID::v4();
		$description = 'Tramite de prueba JSON';
		$typeDoc = "JSON";

		$filesize = $this->getBase64Size($jsonBase64);
		// var_dump($filesize);exit;

		if ($filesize > 20000) {
			throw new Exception("El archivo a subir excede la capacidad permitida que es de 20 MB..");
		}
		$data = array("tipoDocumento" => $typeDoc,
									"documento" => $jsonBase64,
									"hashDocumento" => $hashJSON,
									"idTramite" => $uuidV4,
									"descripcion" => $description,
									"token" => $token_user['access_token']
								 ) ;

// /*****************************insercion de registro reslpado de lo que se envio*************************/
		$this->objParam->addParametro('tipo_documento', $typeDoc);
		$this->objParam->addParametro('documento', $JSON);
		$this->objParam->addParametro('hash_documento', $hashJSON);
		$this->objParam->addParametro('descripcion', $description);
		$this->objParam->addParametro('id_tramite', $uuidV4);
		$this->objParam->addParametro('id_estado_wf', $id_estado_wf);
		$this->objParam->addParametro('access_token_usado', $token_user['access_token']);
		$this->objFunc=$this->create('MODDatosEnviadosCdig');
		$this->res=$this->objFunc->insertarDatosEnviadosCdig($this->objParam);
/*****************************fin registro*************************/
		// $this->saveVerificacionDocumento($jsonBase64, $typeDoc, $uuidV4);


		$response = $this->aprobacionDocumentosV1($data, $token_interop);
		$this->res->setDatos($response);

		$this->res->imprimirRespuesta($this->res->generarJson());
}

	function solicitudAprobacionDPDF () {

				$token_user = $this->getTokenUser()->getDatos();
				$token_interop = $token_user['token_interop'];
				$idDocumentWf = $this->objParam->getParametro('item');
				$action = $this->objParam->getParametro('even');
				$nomRep = $this->objParam->getParametro('data');
				$id_estado_wf =  $this->objParam->getParametro('id_estado_wf');
				$uuidV4 = UUID::v4();
				$typeDoc = "PDF";
				$description = "Tramite de prueba PDF";
				$searchedText   = '.pdf';
				$extension = substr(strstr($nomRep, $searchedText), 1, 3);
				$file_name = (md5($uuidV4 . $_SESSION["_SEMILLA"])).'.'.$extension;

				if(!$extension){
					$extension = substr(strstr($nomRep, '.PDF'), 1, 3);
				}

				if (!$extension) {
					throw new Exception("Tipo de archivo no permitido - Solo se permiten archivo pdf");
				}

				if ($action=='action') {
						 $PDF = file_get_contents('http://10.150.0.91/kerp_breydi/lib/lib_control/Intermediario.php?r='.$nomRep);
				}else {
						 $PDF = file_get_contents($nomRep);
				}

				// $this->getSentDocument(); //verificacion del primer documento enviado para aprobacion Digital

				$pdfBase64 = base64_encode($PDF);
				$filesize = $this->getBase64Size($pdfBase64);
				// var_dump($filesize);exit;
				if ($filesize > 20000) {
					throw new Exception("El archivo a subir excede la capacidad permitida que es de 20 MB..");
				}

				$hashPDF = hash('sha256', $pdfBase64);
				$pahtDocument = "./../../../uploaded_files/sis_ciudadania_digital/DocumentoCdigital/".$file_name;
				$data = array("tipoDocumento" => $typeDoc,
											"documento" => $pdfBase64,
											"hashDocumento" => $hashPDF,
											"idTramite" => $uuidV4,
											"descripcion" => $description,
											"token" => $token_user['access_token']
										 ) ;

		 /*****************************insercion de registro reslpado de lo que se envio*************************/
		 		$this->objParam->addParametro('tipo_documento', $typeDoc);
		 		// $this->objParam->addParametro('documento', $idDocumentWf);
				$this->objParam->addParametro('documento', $pahtDocument);
		 		$this->objParam->addParametro('hash_documento', $hashPDF);
		 		$this->objParam->addParametro('descripcion', $description);
		 		$this->objParam->addParametro('id_tramite', $uuidV4);
				$this->objParam->addParametro('id_estado_wf', $id_estado_wf);
				$this->objParam->addParametro('access_token_usado', $token_user['access_token']);
		 		$this->objFunc=$this->create('MODDatosEnviadosCdig');
		 		$this->res=$this->objFunc->insertarDatosEnviadosCdig($this->objParam);
		 /*****************************fin registro*************************/

		 /*****************************insercion de registro de documento pdf en el sistema de archivos*************************/
		 if (file_put_contents($pahtDocument, $PDF)) {

				// $this->saveVerificacionDocumento($pahtDocument, $typeDoc, $uuidV4);
		 }
		 /*****************************fin registro*************************/

				$response = $this->aprobacionDocumentosV1($data, $token_interop);
				$this->res->setDatos($response);

				$this->res->imprimirRespuesta($this->res->generarJson());
	}

/*****************************Llamada al servicio de Aprobacion documetos*************************/
	private function aprobacionDocumentosV1 ($data, $token_interop) {

			$header = array("Authorization: Bearer {$token_interop}",
											"Content-Type: application/json");

			$dataSend= json_encode($data);

			$resp = array();
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://interoperabilidad.agetic.gob.bo/fake/aprobacion-documentos/v1/aprobaciones",
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
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
				$resp = array('success' => false, 'responseServerAgetic' => $err );
			} else {
				$resp = array('success' => true, 'responseServerAgetic' => $response );
			}

		return $resp;
	}

	function getBase64Size ($base64) {
	    try{
					$size_in_bytes = strlen(base64_decode($base64));
	        $size_in_kb    = $size_in_bytes / 1024;
	        $size_in_mb    = $size_in_kb / 1024;

	        return $size_in_kb;
	    }
	    catch(Exception $e){
	        return $e;
	    }
	}


	function saveVerificacionDocumento ($pahtDocument, $typeDoc, $uuidV4) {

		$this->objParam->addParametro('documento', $pahtDocument);
		$this->objParam->addParametro('tipo_documento', $typeDoc);
		$this->objParam->addParametro('id_tramite', $uuidV4);
		$this->objFunc=$this->create('MODVerificacionDocumento');
		$this->res=$this->objFunc->insertarVerificacionDocumento($this->objParam);
		// $response = $this->res->getDatos();
		// return $response;

	}

	// function getSentDocument() {
	// 	$this->objParam->addParametro('d', $pahtDocument);
	// 	$this->objFunc=$this->create('MODVerificacionDocumento');
	// 	$this->res=$this->objFunc->insertarVerificacionDocumento($this->objParam);
	// }
 /*******************************************************************************************************/
	function insertarDatosEnviadosCdig(){
		$this->objFunc=$this->create('MODDatosEnviadosCdig');
		if($this->objParam->insertar('id_dato_enviado')){
			$this->res=$this->objFunc->insertarDatosEnviadosCdig($this->objParam);
		} else{
			$this->res=$this->objFunc->modificarDatosEnviadosCdig($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

	function eliminarDatosEnviadosCdig(){
			$this->objFunc=$this->create('MODDatosEnviadosCdig');
		$this->res=$this->objFunc->eliminarAtosEnviadosCdig($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}

}

?>
