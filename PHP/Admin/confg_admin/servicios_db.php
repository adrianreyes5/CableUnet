<?php

	//Registro de internet 

	if (isset($_POST['enviar_internet'])) {

		$plan=$_POST['plan'];
		$velocidad=$_POST['velocidad'];
		$precio=$_POST['precio'];

		try {
				
			$base=new PDO("mysql:host=localhost; dbname=cableunet", 'root', '');

			$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

			$sql="INSERT INTO servicios (nombre,plan,velocidad,precio) VALUES (?,?,?,?)";

			$resultado=$base->prepare($sql);

			$resultado->execute(['internet',$plan,$velocidad,$precio]);

			$valida=$resultado->rowCount();

			if($valida == 1) {

				header('location:../cableunet_admin.php');	
			}else {
				header('location:../registro_internet.php');	
			}

			$resultado=null;
			$base=null;

		} catch (Exception $e) {
			die("Error: " . $e->getMessage());
		}
	}

	//Registro de telefonia

	if (isset($_POST['enviar_tlf'])) {

		$plan=$_POST['plan'];
		$minutos=$_POST['minutos'];
		$precio=$_POST['precio'];

		try {
				
			$base=new PDO("mysql:host=localhost; dbname=cableunet", 'root', '');

			$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

			$sql="INSERT INTO servicios (nombre,plan,minutos,precio) VALUES (?,?,?,?)";

			$resultado=$base->prepare($sql);

			$resultado->execute(['telefonia',$plan,$minutos,$precio]);

			$valida=$resultado->rowCount();

			if($valida == 1) {

				header('location:../cableunet_admin.php');	
			}else {
				header('location:../registro_telefonia.php');	
			}

			$resultado=null;
			$base=null;

		} catch (Exception $e) {
			die("Error: " . $e->getMessage());
		}
	}

	//Registro de cable

	if (isset($_POST['enviar_cable'])) {
		
		$plan=$_POST['plan'];
		$precio=$_POST['precio'];

		try {
				
			$base=new PDO("mysql:host=localhost; dbname=cableunet", 'root', '');

			$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

			$sql="INSERT INTO servicios (nombre,plan,precio) VALUES (?,?,?)";

			$resultado=$base->prepare($sql);

			$resultado->execute(['cable',$plan,$precio]);

			$valida=$resultado->rowCount();

			if($valida == 1) {

				header('location:../cableunet_admin.php');	
			}else {
				header('location:../registro_telefonia.php');	
			}

			$resultado=null;
			$base=null;

		} catch (Exception $e) {
			die("Error: " . $e->getMessage());
		}
	}


	//Registro paquetes de canales

	if (isset($_POST['enviar_canal'])) {
		$nombre=$_POST['plan'];
		$canal=$_POST['canal_id'];

		foreach ($canal as $key) {
			$canales[] = $key;
		}

		$paquete = implode(",",$canales);

		try {

			$base=new PDO("mysql:host=localhost; dbname=cableunet", 'root', '');

			$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 

			$sql="INSERT INTO paquetes_canales (plan,canales) VALUES (?,?)";

			$result=$base->prepare($sql);

			$result->execute([$nombre,$paquete]);

			$registered=$result->rowCount();

			if($registered == 1 ){
				header('location:../index_admin.php');
			}else {
				echo "no ok";
			}

		} catch (Exception $e) {
		
			die ("Error:.." . $e->getMessage());
		}
	}

 ?>