<?php

// session_start();
header("content-type: text/javascript; charset=UTF-8");
?>

function getCodeUrl(code) {
var paginaURL = window.location.search.substring(1);
 var URLVariables = paginaURL.split('&');
  for (var i = 0; i < URLVariables.length; i++) {
    var sParametro = URLVariables[i].split('=');
    if (sParametro[0] == code) {
      return sParametro[1];
    }
  }
 return null;
}
