<?php 

  session_start();

  if(!isset($_SESSION['admin'])){
    header('location:../user/config_user/login.php');
  }

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Registro de servicio a cable</title>
	<link rel="stylesheet" type="text/css" href="../../../css/_servicios.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body class="cable">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="../index_admin.php">CableUnet Admin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">     
      <li class="nav-item">
        <a class="nav-link" href="programas.php">Registro de programas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../carga_programacion/programacion.php">Carga de programacion</a>
      </li>
     
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Creacion de servicios
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="internet.php">Internet</a>
          <a class="dropdown-item" href="telefonia.php">Telefonia</a>          
          <a class="dropdown-item" href="cable.php">Cable</a>
          <a class="dropdown-item" href="canal.php">Canales</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Paquetes        
    </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="../paquetes/pack_servicios.php">Servicios</a>
          <a class="dropdown-item" href="../paquetes/pack_canales.php">Canales</a>
        </div>
      </li>
 

    <li class="nav-item">
      <a class="nav-link" href="../confg_admin/cierre.php">Cerrar sesión</a>
    </li>
    </ul>
 
  </div>
</nav>

	<div class="container col-12 col-sm-5">  
  <form id="contact" action="../confg_admin/servicios_db.php"  method="post">
    <h3>Registro plan de cable</h3>
    <fieldset>
      <input placeholder="Plan de cable" type="text" name="plan" tabindex="1" required autofocus>
    </fieldset>
    <fieldset>
      <input placeholder="Precio" type="text" name="precio" tabindex="3" required>
    </fieldset>
    <fieldset>
      <button name="enviar_cable" type="submit" id="contact-submit" data-submit="...Sending">Registrar</button>
    </fieldset>
  </form>

</div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>