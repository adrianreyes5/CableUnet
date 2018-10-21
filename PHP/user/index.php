<?php 

	session_start();

	if(!isset($_SESSION['usuario'])){
		header('location:log/login.php');
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
	<title>Guía</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../../css/canales_guia.css">
</head>
<body>
		
	<div id="header_user">

		<h2 class="cabezera_user">Cable Unet <br><?php echo $_SESSION['usuario'] ?></br></h2>

		<ul class="nav_user">

			<li><a href="planes/plan_serv.php">Paquetes de servicios</a></li>

			<li><a href="planes/plan_canal.php">Planes de canales</a></li>

			<li><a href="config_user/factura.php">Facturas mensuales</a></li>

			<li><a href="../Admin/confg_admin/cierre.php">Cerrar sesión</a></li>
		</ul>		
	</div>


	

	
	<h2 class="Guia">Guia de Programación</h2>

	<form method="post" action="../Admin/confg_admin/busqueda_db.php" class="form">

		<input type="text" name="busqueda" placeholder="Buscar.." required="">

		<input type="submit" name="buscar_user" value="Enviar">
		
	</form>


	<div class="container">

		<?php 

	    	$sql="SELECT * FROM programacion_canal";
	    	$result=$base->prepare($sql);
	    	$result->execute();

	    	while ($current = $result->fetch(PDO::FETCH_ASSOC)):
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
	    		}?>

			<hr>

		<?php endwhile ?>

	</div>

</body>
</html>