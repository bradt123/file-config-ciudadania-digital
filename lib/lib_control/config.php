<?php
/**
 * Parametros globales para conexion
 */
// session_start();
// include('../../../lib/lib_control/CTSesion.php');
// include(dirname(__FILE__).'/../../../lib/DatosGenerales.php');

/*
// * Generador GUID
*/
  function generateGuid() {

      $randomString = openssl_random_pseudo_bytes(16);
      $time_low = bin2hex(substr($randomString, 0, 4));
      $time_mid = bin2hex(substr($randomString, 4, 2));
      $time_hi_and_version = bin2hex(substr($randomString, 6, 2));
      $clock_seq_hi_and_reserved = bin2hex(substr($randomString, 8, 2));
      $node = bin2hex(substr($randomString, 10, 6));

      $time_hi_and_version = hexdec($time_hi_and_version);
      $time_hi_and_version = $time_hi_and_version >> 4;
      $time_hi_and_version = $time_hi_and_version | 0x4000;

      $clock_seq_hi_and_reserved = hexdec($clock_seq_hi_and_reserved);
      $clock_seq_hi_and_reserved = $clock_seq_hi_and_reserved >> 2;
      $clock_seq_hi_and_reserved = $clock_seq_hi_and_reserved | 0x8000;

      return sprintf('%08s%04s%04x%04x%012s', $time_low, $time_mid, $time_hi_and_version, $clock_seq_hi_and_reserved, $node);
  }

  /**
   * url autenticación ciudadania digital
   */
  define('SERVICIO_AUTENTICATION_DIGITAL', 'https://account-idetest.agetic.gob.bo/auth');
  define('SERVICIO_GET_TOKEN_DIGITAL', 'https://account-idetest.agetic.gob.bo/token');
  define('SERVICIO_GET_USUARIO_DIGITAL', 'https://account-idetest.agetic.gob.bo/me');

  /**
   * Cliente ERP
   */
   define('ERP_CLIENT_ID', '21228293-d7f9-41f3-864e-f93b3419fdfe');
   define('ERP_CLIENT_SECRET', 'SUaa2npCL19hcqFp0YJOPwk/epEGbo3m/Q2gSYbVXECC7bJxVqKChubuD0gHNDEJ');
   define('ERP_CLIENT_CALLBACK_URI', 'https://erp.obairlines.bo/sis_seguridad/vista/_adm/index.php');
   define('ERP_ESCOPE', '%20documento_identidad%20fecha_nacimiento%20nombre%20email');
   define('ERP_NONCE', generateGuid());
   define('ERP_STATE', generateGuid());
   define('ERP_RESPONSE_TYPE', 'response_type=code');
