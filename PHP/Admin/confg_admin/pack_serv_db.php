<?php 
	
	$nombre=$_POST['nombre'];
	$inter=$_POST['internet_id'];
	$telf=$_POST['telefonia_id'];
	$cable=$_POST['cable_id'];
	$precio=$_POST['precio'];

	/*try {
		
        $base=new PDO("mysql:host=localhost; dbname=cableunet", 'root', '');

		$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);  

		$sql="INSERT INTO paquetes (nombre,internet,telefonia,cable,precio) VALUES (?,?,?,?,?)";

		$result=$base->prepare($sql);

		$result->execute([$nombre,$inter,$telf,$cable,$precio]);

	} catch (Exception $e) {
		die("Error... " . $e->getMesagge());
	}*/

 ?>



<!DOCTYPE html>
<html>
<head>
	<title>Registro completado</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../../css/programacion_c.css">
</head>
<body class="p_registrada">

	<div class="container registrado">
		<h1 class="p_titulo">Registro de paquete completado.</h1>

		<div class="a">
			<a class="serv_a" href="../paquetes/pack_servicios.php">Volver a registro</a>
			<a class="serv_a" href="../cableunet_admin.php">Aceptar</a>
		</div>
	</div>
	
		

</body>
</html>