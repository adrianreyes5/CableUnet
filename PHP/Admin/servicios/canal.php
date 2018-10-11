<?php 

	session_start();

 	if(!isset($_SESSION['admin'])){
    	header('location:../user/config_user/login.php');
    }


	if (isset($_POST['submit'])) {
			$canal=$_POST['nombre'];
			$info=$_POST['info'];

		try {
			
			$base=new PDO("mysql:host=localhost; dbname=cableunet", 'root', '');

			$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 

			$sql="INSERT INTO canales (nombre,info) VALUES (?,?)";

		} catch (Exception $e) {
			die ("Error:.." . $e->getMessage());
		}

	}

 ?>





<!DOCTYPE html>
<html>
<head>
	<title>Registo canal</title>
	<link rel="stylesheet" type="text/css" href="../../../css/_servicios.css">

</head>
<body class="canal">

	<h2 class="cabezera">Cable Unet Administrador</h2>

	 <div id="header">

     <ul class="nav">

      <li><a href="../index_admin.php">Programación</a></li>

      <li><a href="programas.php">Registro de programas</a></li>

      <li><a href="../carga_programacion/programacion.php">Carga de programacion</a></li>

      <li><a>Creacion de servicios</a>
        
        <ul>
          <li><a href="internet.php">Internet</a></li>
          <li><a href="telefonia.php">Telefonia</a></li>
          <li><a href="cable.php">Cable</a></li>
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
	  <form id="contact" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	    <h3>Registro de canal</h3>
	    <fieldset>
	      <input placeholder="Nombre" type="text" name="nombre" tabindex="1" required autofocus>
	    </fieldset>
	    <fieldset>
	      <input placeholder="Información" type="text" name="info" tabindex="2" required>
	    </fieldset>
	      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Registrar</button>
	    </fieldset>
		<fieldset>
			<?php 

					if (isset($_POST['submit'])){
						$result=$base->prepare($sql);

						$result->execute([$canal,$info]);

						$registered=$result->rowCount();

						if($registered == 1){
							echo '<script language="javascript">alert("Canal registrado");</script>';
						}
					}				
				?>
		</fieldset>	
		</form>		
	</div>	
</body>
</html>