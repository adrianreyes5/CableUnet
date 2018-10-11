<?php 
		
		$id_canal=$_POST['canal_nombre'];
		$array_p=$_POST['progra_id'];
		$GLOBALS['existe_progamacion'] = false;

		foreach ($array_p as $key) {
			$progra[] = $key;
		}

		$programa = implode(",",$progra);

		try {

			$base=new PDO("mysql:host=localhost; dbname=cableunet", 'root', '');

			$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 

	   } catch (Exception $e) {
			die ("Error:.." . $e->getMessage());
		}

		$sql1="SELECT * FROM programacion_canal";
		$search_canal=$base->prepare($sql1);
		$search_canal->execute();

		while($current = $search_canal->fetch(PDO::FETCH_ASSOC)){

			if ($id_canal == $current['nombre_canal']) {
				$GLOBALS['existe_progamacion'] = true;
			}
		}

		if ($GLOBALS['existe_progamacion'] == true) {
			echo '<script language="javascript">alert("Error: Ya esxiste una programación con este canal.");</script>';
			echo "<script>window.location='../carga_programacion/programacion.php';</script>";
		}
		else{
			$sql="INSERT INTO programacion_canal (nombre_canal,id_progra) VALUES (?,?)";
			$result=$base->prepare($sql);
			$result->execute([$id_canal,$programa]);
		}	
 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>Programación de canales</title>
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../../css/programacion_c.css">
 </head>
 <body class="p_registrada">

 	<?php if ($GLOBALS['existe_progamacion'] == false): ?>

 		<div class="container registrado">
 			<h1 class="p_titulo">Programación Cargada.</h1>

 			<div class="a">
 				<a class="p_a" href="../carga_programacion/programacion.php">Volver a registro</a>
				<a class="p_a" href="../cableunet_admin.php">Pagina principal</a>
 			</div>			
 		</div>
	<?php endif ?>


 </body>
 </html>