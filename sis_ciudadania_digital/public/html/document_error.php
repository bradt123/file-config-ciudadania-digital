<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="charset=UTF-8;text/html; " />
    <meta name="language" content="es"/>
    <meta name="author" content="BOA" />
    <meta name="subject" content="boa-institucional@boa.bo" />
    <meta name="application-name" content="ERP - BOA"/>
    <link rel="icon" type="image/x-icon" href="<?php echo $_SESSION['_DIR_FAV_ICON'] ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <!-- <link rel="stylesheet" href="../../public/styles/style.css"> -->
</head>
<body>

  <div class="container">
    <div class="imgHeader">
      <img src="../../../lib/imagenes/Logo-BoA.png">
    </div>
      <div class="card">
          <div class="content">
            <main>
               <h3>Mensaje: </h3>
               <div id="main">
                 <?php echo $mensaje; ?>
               </div>
             </main>
          </div>
      </div>
  </div>

  <script type="text/javascript" charset="utf-8" >
  </script>
  <!-- <script type="text/javascript" src="../../public/js/app.js"></script> -->
</body>
</html>
