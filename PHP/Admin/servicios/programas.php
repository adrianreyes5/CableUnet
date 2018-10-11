<?php 

	session_start();

 	if(!isset($_SESSION['admin'])){
    	header('location:../user/config_user/login.php');
    }
	
	if (isset($_POST['submit'])) {
			$programa=$_POST['programa'];
			$fecha=$_POST['fecha'];
			$hora_comienzo=$_POST['hora_comienzo'];
			$hora_termina=$_POST['hora_termina'];

		try {
			
			$base=new PDO("mysql:host=localhost; dbname=cableunet", 'root', '');

			$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 

			$sql="INSERT INTO programas (programa,fecha,hora_comienzo,hora_termina) VALUES (?,?,?,?)";

		} catch (Exception $e) {
			die ("Error:.." . $e->getMessage());
		}

	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Registo programas</title>
	<link rel="stylesheet" type="text/css" href="../../../css/programas_s.css">
</head>
<body>

	<div id="header">

		<h2 class="cabezera">Cable Unet Administrador</h2>

		<ul class="nav">

			<li><a href="../index_admin.php">Programación</a></li>

			<li><a href="../carga_programacion/programacion.php">Carga de programacion</a></li>

			<li><a>Creacion de servicios</a>
				
				<ul>
					<li><a href="internet.php">Internet</a></li>
					<li><a href="telefonia.php">Telefonia</a></li>
					<li><a href=cable.php">Cable</a></li>
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
	  <form id="contact" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	    <h3>Registro de programas</h3>
	    <fieldset>
	      <input placeholder="Programa" type="text" name="programa" tabindex="1" required autofocus>
	    </fieldset>
	    <fieldset>
	      <input placeholder="Fecha" type="text" name="fecha" tabindex="2" required>
	    </fieldset>
	    <fieldset>
	      <input placeholder="Hora de comienzo" type="text" name="hora_comienzo" tabindex="3" required>
	    </fieldset>
	    <fieldset>
	      <input placeholder="Hora que finaliza" type="text" name="hora_termina" tabindex="4" required>
	    </fieldset>
	      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Registrar</button>
	    </fieldset>
		<fieldset>
			<?php 

					if (isset($_POST['submit'])){

						$date=date($fecha);
						$comienzo=date($hora_comienzo);
						$final=date($hora_termina);

					 	$sql1 = "SELECT * FROM programas";
					 	$search_p=$base->prepare($sql1);
					 	$search_p->execute();

					 	$band = false;

					 	while($current = $search_p->fetch(PDO::FETCH_ASSOC)){

					 		$rest_c = substr($current['hora_comienzo'],-8,5);
					 		$rest_t = substr($current['hora_termina'],-8,5);

					 		if ($rest_c == $comienzo && $rest_t == $final && $date == $current['fecha'] && strcmp($programa,$current['programa'])===0) {
					 			$band = true;
					 		}
					 	}

					 	if ($band == true) {
					 		echo '<script language="javascript">alert("Error: Programa con fecha y horas similares ya existe");</script>'; 
					 	}
						else{
							$result=$base->prepare($sql);

							$result->execute([$programa,$date,$comienzo,$final]);

							$registered=$result->rowCount();

							if($registered == 1){
								echo '<script language="javascript">alert("Programa registrado");</script>'; 
							}
						}

							
					}				
				?>
		</fieldset>	
		</form>		
	</div>	
</body>
</html>