<?php
include_once(dirname(__FILE__)."/config.php");

class DigitalCitizenship {
  var  $client_id = ERP_CLIENT_ID;
  var  $client_secret = ERP_CLIENT_SECRET;
  var  $client_uri = ERP_CLIENT_CALLBACK_URI;
  var  $url_authorization_code = SERVICIO_GET_TOKEN_DIGITAL;
  var  $url_get_persona_digital = SERVICIO_GET_USUARIO_DIGITAL;
  var  $access_token;
  var  $authorization_code;
  var  $resource;
  var  $response_data;


  public function __construct($authorization_code) {
    $this->authorization_code = $authorization_code;
  }

  public function accessDigital() {
    $this->access_token = $this->getAccessToken($this->authorization_code);
    if ($this->access_token == 'error'){
        $this->response_data = array('error' => "Error: EL Codigo de autorizacion ya caduco");
    }else {
      $this->resource = $this->getResource($this->access_token);
      $this->response_data = array('access_token' => $this->access_token,
                                   'data' => $this->resource);
    }
    return $this->response_data;
  }

  /*funcion para obtener el access_token*/
  private function getAccessToken($code) {
      $authorization = base64_encode("{$this->client_id}:{$this->client_secret}");
      $header = array("Authorization: Basic {$authorization}",
                      "Content-Type: application/x-www-form-urlencoded");

  	  $content = "code=".$this->authorization_code."&redirect_uri=".$this->client_uri."&grant_type=authorization_code";

  	   $curl = curl_init();
  	    curl_setopt_array($curl, array(
      		CURLOPT_URL => $this->url_authorization_code,
      		CURLOPT_HTTPHEADER => $header,
      		CURLOPT_SSL_VERIFYPEER => false,
      		CURLOPT_RETURNTRANSFER => true,
      		CURLOPT_POST => true,
      		CURLOPT_POSTFIELDS => $content
  	));

  	$response = curl_exec($curl);
    curl_close($curl);

  	if ($response === false) {
      		return curl_error($curl);
  	} elseif (json_decode($response)->error) {
          return json_decode($response)->error;
  	}else{
          return json_decode($response)->access_token;
      }
    }

    /*Obtiene los datos de la perosona con ciudadania digital*/
    private function getResource($token) {

    	$header = array("Authorization: Bearer {$token}");

    	$curl = curl_init();
    	curl_setopt_array($curl, array(
    		CURLOPT_URL => $this->url_get_persona_digital,
    		CURLOPT_HTTPHEADER => $header,
    		CURLOPT_SSL_VERIFYPEER => false,
    		CURLOPT_RETURNTRANSFER => true
        ));

    	$response = curl_exec($curl);
    	curl_close($curl);
    	return json_decode($response, true);

    }
}
 ?>
