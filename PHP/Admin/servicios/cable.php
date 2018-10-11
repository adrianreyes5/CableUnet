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
</head>
<body class="cable">

   <div id="header">

    <h2 class="cabezera">Cable Unet Administrador</h2>

    <ul class="nav">

      <li><a href="../index_admin.php">Programación</a></li>

      <li><a href="programas.php">Registro de programas</a></li>

      <li><a href="../carga_programacion/programacion.php">Carga de programacion</a></li>

      <li><a>Creacion de servicios</a>
        
        <ul>
          <li><a href="internet.php">internet</a></li>
          <li><a href="telefonia.php">telefonia</a></li>
          <li><a href="canal.php">Canales</a></li>
        </ul>

      </li>

      <li><a>Paquetes</a>
        
        <ul>
          <li><a href="../paquetes/pack_servicios.php">Servicios</a></li>
          <li><a href="../paquetes/pack_canales.php">Canales</a></li>
        </ul>

      </li>

      <?php 

        if (isset($_POST['submit'])):
          $sql4="SELECT * FROM solicitudes";
            $result_s=$base->prepare($sql4);
            $result_s->execute();

            $cont=0;

            while ($current_s = $result_s->fetch(PDO::FETCH_ASSOC)) {
              $cont++;
            }         
       ?>
      <li><a href="../confg_admin/solicitudes.php">Solicitudes <?php echo "(". $cont . ")"; ?></a></li>

      <?php endif ?>

      <li><a href="../confg_admin/cierre.php">Cerrar sesión</a></li>
    </ul>   
  </div>

	<div class="container">  
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

</body>
</html>