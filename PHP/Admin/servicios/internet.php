<?php 

  session_start();

  if(!isset($_SESSION['admin'])){
    header('location:../user/config_user/login.php');
  }

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Registro de servicio a internet</title>
  <link rel="stylesheet" type="text/css" href="../../../css/_servicios.css">
</head>
<body class="internet">

  <div id="header">

    <h2 class="cabezera">Cable Unet Administrador</h2>

    <ul class="nav">

      <li><a href="../index_admin.php">Programación</a></li>

      <li><a href="programas.php">Registro de programas</a></li>

      <li><a href="../carga_programacion/programacion.php">Carga de programacion</a></li>

      <li><a>Creacion de servicios</a>
        
        <ul>
          <li><a href="telefonia.php">Telefonia</a></li>
          <li><a href="cable.php">Cable</a></li>
          <li><a href="canal.php">Canales</a></li>
        </ul>

      </li>

      <li><a>Paquetes</a>
        
        <ul>
          <li><a href="../paquetes/pack_servicios.php">Servicios</a></li>
          <li><a href="../paquetes/pack_canales.php">Canales</a></li>
        </ul>

      </li>

      <li><a href="../confg_admin/cierre.php">Cerrar sesión</a></li>
    </ul>   
  </div>

	<div class="container">  
  <form id="contact" action="../confg_admin/servicios_db.php" method="post">
    <h3>Registro de plan internet</h3>
    <fieldset>
      <input placeholder="Plan" type="text" name="plan" tabindex="1" required autofocus>
    </fieldset>
    <fieldset>
      <input placeholder="Velocidad" type="text" name="velocidad" tabindex="2" required>
    </fieldset>
    <fieldset>
      <input placeholder="Precio" type="text" name="precio" tabindex="3" required>
    </fieldset>
    <fieldset>
      <button name="enviar_internet" type="submit" id="contact-submit" data-submit="...Sending">Registrar</button>
    </fieldset>
  </form>

</body>
</html>