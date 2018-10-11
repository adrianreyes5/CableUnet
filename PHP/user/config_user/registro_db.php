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
 </head>
 <body>
 
	<h1>Registro completado</h1>

	<div>
		<a href="../log/login.php">Aceptar</a>
	</div>

 </body>
 </html>