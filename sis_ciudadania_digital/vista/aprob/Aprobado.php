<?php
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Headers: Origin, Content-Type');

$input_get = filter_input_array(INPUT_GET);

if (is_null($input_get))
{

  echo "string";
  header("location:http://10.150.0.91/kerp_breydi/sis_seguridad/vista/_adm/index.php");
} else {
  $data_json = json_encode($input_get);
}

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Documento Aprobado</title>
     <link rel="stylesheet" href="../../public/styles/style.css">
 </head>
 <body>

   <div class="container">
     <div class="imgHeader">
       <img src="../../../lib/imagenes/Logo-BoA.png">
     </div>
       <div class="card">
           <div class="imgBx">
               <h3>Documento Aprobado</h3>
           </div>
           <div class="content">
             <main>
                <h3>UUID de la Solicitud: </h3>
                <div id="main">

                </div>
              </main>
           </div>
       </div>
   </div>

   <script type="text/javascript" charset="utf-8" >
     let data = JSON.parse('<?php echo $data_json; ?>');
   </script>
   <script type="text/javascript" src="../../public/js/app.js"></script>
 </body>
 </html>
