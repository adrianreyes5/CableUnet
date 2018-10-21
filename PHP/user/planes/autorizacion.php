<?php 

	session_start();

	$plan_nuevo = "";

	if(!isset($_SESSION['usuario'])){
		header('location:../log/login.php');
	}

	try {
            
        $base= new PDO("mysql:host=localhost; dbname=cableunet", 'root', '');

        $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    } catch (Exception $e) {
        die("Error ....  " . $e->getMessage());   
    }

 ?>

 <?php if(isset($_POST['cambio_serv'])):


 	$sql="SELECT * FROM facturacion";
	$result=$base->prepare($sql);
	$result->execute();

	$sql1="SELECT * FROM paquetes";
	$result_pack=$base->prepare($sql1);
	$result_pack->execute();

	while ($current_pack = $result_pack->fetch(PDO::FETCH_ASSOC)) {

		if ($_POST['cambio_serv'] == $current_pack['id']) {

			$plan_nuevo = $current_pack['nombre'];		

		}
    }

	while ($current = $result->fetch(PDO::FETCH_ASSOC)) {
		
		if ($_SESSION['usuario'] == $current['usuario'] && $current['activo'] == 1) {


			$sql1="SELECT * FROM paquetes";
			$result_pack=$base->prepare($sql1);
			$result_pack->execute();
					
			while ($current_pack = $result_pack->fetch(PDO::FETCH_ASSOC)) {
		
				if ($current_pack['precio'] == $current['fact_servicios']) {

					$sql2="INSERT INTO solicitudes (usuario,paquete_viejo,paquete_nuevo,fact_id) VALUES (?,?,?,?)";
					$insert=$base->prepare($sql2);
					$insert->execute([$current['usuario'],$current_pack['nombre'],$plan_nuevo,$current['id']]);
				}
			}
		}
	}

  ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Plan registrado</title>
 	<link rel="stylesheet" type="text/css" href="../../../css/registro.css">
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 </head>
 <body style="background-color: #E5E5E5">

 	<div class="container registrado" style="background-color: #C2C2C2">

		<h2>Tu solicitud ha sido enviada</h2>
 		<p>Esto toma un poco de tiempo. Se te enviara una notificacíon cuando tu plan haya sido cambiado u ocurra algun inconveniente.</p>
 		<div style="background-color: #7D88A1">
 			<a href="../../user/index.php">Aceptar</a>
 		</div>
 		
 	</div>
 
 </body>
 </html>

 <?php endif ?>









 <?php if(isset($_POST['cambio_canal'])):

 	$sql="SELECT * FROM facturacion";
	$result=$base->prepare($sql);
	$result->execute();

 	$sql2="SELECT * FROM paquetes_canales";
	$result_canal=$base->prepare($sql2);
	$result_canal->execute();

	while ($current_canal= $result_canal->fetch(PDO::FETCH_ASSOC)) {

		if ($_POST['cambio_canal'] == $current_canal['id']) {

			$plan_nuevo = $current_canal['plan'];			
		}
    }

    while ($current = $result->fetch(PDO::FETCH_ASSOC)) {
		
		if ($_SESSION['usuario'] == $current['usuario'] && $current['activo'] == 2) {

			$sql1="SELECT * FROM paquetes_canales";
			$result_canal=$base->prepare($sql1);
			$result_canal->execute();
					
			while ($current_canal = $result_canal->fetch(PDO::FETCH_ASSOC)) {

				if ($current_canal['precio'] == $current['fact_canal']) {
					
					$sql2="INSERT INTO solicitudes (usuario,plan_canal_v,plan_canal_n,fact_id) VALUES (?,?,?,?)";
					$insert=$base->prepare($sql2);
					$insert->execute([$current['usuario'],$current_canal['plan'],$plan_nuevo,$current['id']]);
				}
			}
		}
	}

  ?>

  <!DOCTYPE html>
 <html>
 <head>
 	<title>solicitud cambio plan</title>
 	<link rel="stylesheet" type="text/css" href="../../../css/registro.css">
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 </head>
 <body style="background-color: #E5E5E5">

 	<div class="container registrado" style="background-color: #C2C2C2">

		<h2>Tu solicitud ha sido enviada</h2>
 		<p>Esto toma un poco de tiempo. Se te enviara una notificacíon cuando tu plan haya sido cambiado u ocurra algun inconveniente.</p>
 		<div style="background-color: #7D88A1">
 			<a href="../../user/index.php">Aceptar</a>
 		</div>
 		
 	</div>
 
 </body>
 </html>

 <?php endif ?>