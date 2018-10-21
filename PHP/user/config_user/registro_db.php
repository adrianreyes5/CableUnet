<?php 
	

	$nombre=htmlentities(addslashes($_POST['user']));
	$contraseña=htmlentities(addslashes($_POST['clave']));
	$correo=htmlentities(addslashes($_POST['correo']));
	$telefono=htmlentities(addslashes($_POST['telf']));
	$dir=htmlentities(addslashes($_POST['dir']));

	$band = false;

	try {

		$base=new PDO("mysql:host=localhost; dbname=cableunet", 'root','');

		$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
		die("Error: " . $e->getMessage());
	}

	$sql1="SELECT * FROM usuarios WHERE usuario = '$nombre'";
	$result=$base->prepare($sql1);
	$result->execute();

	while ($existe = $result->fetch(PDO::FETCH_ASSOC)) {
		
		if ($nombre == $existe['usuario']) {
			echo '<script language="javascript">alert("Usuario ya existe");</script>';
			echo "<script>window.location='../log/registro.php';</script>"; 
			$band = true;
		}
	}

	if (!$band) {
		
		$sql="INSERT INTO usuarios (usuario,password,correo,telefono,direccion) VALUES (?,?,?,?,?)";

		$resultado=$base->prepare($sql);
		$resultado->execute([$nombre,$contraseña,$correo,$telefono,$dir]);
	}

	

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Registro Exitoso</title>
 	<link rel="stylesheet" type="text/css" href="../../../css/registro.css">
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 </head>
 <body style="background-color: #2c3335">

 	<div class="container registrado">

		<h1 >Registro completado</h1>

		<div >
			<a href="../log/login.php">Aceptar</a>
		</div>
 		
 	</div>
	 

 </body>
 </html>