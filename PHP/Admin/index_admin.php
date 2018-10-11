	<?php 
	
	session_start();

	if(!isset($_SESSION['admin'])){
		header('location:../user/config_user/login.php');
	}

	try {
        
    	$base=new PDO("mysql:host=localhost; dbname=cableunet", 'root', '');

    	$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	} catch (Exception $e) {
    	die("Error ....  " . $e->getMessage());   
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Administrador</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../../css/canales_guia.css">
</head>
<body>

	<div id="header">
		
		<h2 class="cabezera"><p>Cable Unet Administrador</p></h2>

		<ul class="nav">

			<li><a href="servicios/programas.php">Registro de programas</a></li>

			<li><a href="carga_programacion/programacion.php">Carga de programacion</a></li>

			<li><a>Creacion de servicios</a>
				
				<ul>
					<li><a href="servicios/internet.php">Internet</a></li>
					<li><a href="servicios/telefonia.php">Telefonia</a></li>
					<li><a href="servicios/cable.php">Cable</a></li>
					<li><a href="servicios/canal.php">Canales</a></li>
				</ul>

			</li>

			<li><a>Paquetes</a>
				
				<ul>
					<li><a href="paquetes/pack_servicios.php">Servicios</a></li>
					<li><a href="paquetes/pack_canales.php">Canales</a></li>
				</ul>

			</li>

			<?php 

				$sql4="SELECT * FROM solicitudes";
	    		$result_s=$base->prepare($sql4);
	    		$result_s->execute();

	    		$cont=0;

	    		while ($current_s = $result_s->fetch(PDO::FETCH_ASSOC)) {
	    			$cont++;
	    		}

			 ?>


			<li><a href="confg_admin/solicitudes.php">Solicitudes <?php echo "(". $cont . ")"; ?></a></li>

			<li><a href="confg_admin/cierre.php">Cerrar sesión</a></li>
		</ul>		
	</div>

	<h2 class="Guia">Guia de Programación</h2>

	<form method="post" action="confg_admin/busqueda_db.php" class="form">
		<input type="text" name="busqueda" placeholder="Buscar.." required="">
		<input type="submit" name="buscar_admin" value="Enviar">
	</form>


	<div class="container">

		<section>
			<?php 

		    	$sql="SELECT * FROM programacion_canal";
		    	$result=$base->prepare($sql);
		    	$result->execute();

		    	while ($current = $result->fetch(PDO::FETCH_ASSOC)):?>

			    	<?php 

			    		echo "<div class='canales'>" . $current['nombre_canal'] . "</div>";

			    		$programas=explode(",",$current['id_progra']);

			    		$sql="SELECT * FROM programas";
			    		$result_p=$base->prepare($sql);
			    		$result_p->execute();

			    		while($prog = $result_p->fetch(PDO::FETCH_ASSOC)){

			    			foreach ($programas as $key) {

			    				if ($prog['id'] == $key) {
			    					echo "<div class='programas'>" . " <div class='hora'>". $prog['hora_comienzo'] . " - " . $prog['hora_termina'] . "</div>" . $prog['programa'] . "  </div> ";
			    				}
			    			}
			    		}

			    	 ?>

			    	<hr>

		    	<?php endwhile ?>		
			
		</section>
	</div>

</body>
</html>