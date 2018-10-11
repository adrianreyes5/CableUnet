<?php 

	session_start();

 	if(!isset($_SESSION['admin'])){
    	header('location:../user/config_user/login.php');
    }

	try {

		$base=new PDO("mysql:host=localhost; dbname=cableunet", 'root', '');

		$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 

	} catch (Exception $e) {
		
		die ("Error:.." . $e->getMessage());
	}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Carga de programación</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../../css/programacion_c.css">
</head>
<body class="back_progra">

	<div id="header_progra">

		<h2 class="cabezera_progra">Cable Unet Administrador</h2>

		<ul class="nav_progra">		

			<li><a href="../index_admin.php">Programación</a></li>

			<li><a href="../servicios/programas.php">Registro de programas</a></li>

			<li><a>Creacion de servicios</a>
				
				<ul>
					<li><a href="../servicios/internet.php">Internet</a></li>
					<li><a href="../servicios/telefonia.php">Telefonia</a></li>
					<li><a href="../servicios/cable.php">Cable</a></li>
					<li><a href="../servicios/canal.php">Canales</a></li>
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

	<div class="container_progra">

		<form  class="form_canal" method="post" action="../confg_admin/programacion_db.php">

			<h3 class="titulo_canal">Carga de programación</h3>
			
			<select name="canal_nombre" class="select_canal" required="">
				
				<?php 

					$sql="SELECT * FROM canales";
					$result=$base->prepare($sql);
					$result->execute();

					while ($current = $result->fetch(PDO::FETCH_ASSOC)):
				?>

						<option value="<?= $current['nombre'] ?>"><?= $current['nombre'] ?></option>

				<?php endwhile ?>		

			</select>


			<select name="progra_id[]" multiple="multiple" class="select_programa" required="">
				
				<?php 

					$sql="SELECT * FROM programas";
					$result=$base->prepare($sql);
					$result->execute();

					while ($current = $result->fetch(PDO::FETCH_ASSOC)):
				?>

						<option value="<?= $current['id'] ?>"><?= $current['programa'] ?></option>

				<?php endwhile ?>		

			</select>

			<input class="enviar_programa" type="submit" name="enviar" value="Enviar">

		</form>		
	</div>

</body>
</html>