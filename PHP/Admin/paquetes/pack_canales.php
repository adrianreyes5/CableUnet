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
	<title>Registro paquetes de canales</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../../css/programacion_c.css">
</head>
<body>

	<div id="header">

		<h2 class="cabezera_progra">Cable Unet Administrador</h2>

        <ul class="nav">
        	
        	<li><a href="../index_admin.php">Programación</a></li>

            <li><a href="../servicios/programas.php">Registro de programas</a></li>

            <li><a href="../carga_programacion/programacion.php">Carga de programacion</a></li>

            <li><a href="">Creacion de servicios</a>
                
                <ul>
                    <li><a href="../servicios/internet.php">Internet</a></li>
                    <li><a href="../servicios/telefonia.php">Telefonia</a></li>
                    <li><a href="../servicios/cable.php">Cable</a></li>
                    <li><a href="../servicios/canal.php">Canales</a></li>
                </ul>

            </li>

            <li><a href="">Paquetes</a>
                
                <ul>
                    <li><a href="pack_servicios.php">Servicios</a></li>
                </ul>

            </li>

            <li><a href="../confg_admin/cierre.php">Cerrar sesión</a></li>
        </ul>       
    </div>

	<div class="container_canal">

		<form class="form_canal" method="post" action="../confg_admin/servicios_db.php">

			<h3 class="titulo_canal">Paquetes de canales</h3>

			<input type="text" name="plan" placeholder="Nombre del plan" required="">

			<select multiple="multiple" name="canal_id[]" class="select">
				<?php 

					$sql="SELECT * FROM canales";
					$result=$base->prepare($sql);
					$result->execute();

					while ($current = $result->fetch(PDO::FETCH_ASSOC)):
				?>

				<option value="<?= $current['id']?>" required><?= $current['nombre'] ?></option>
			<?php endwhile ?>	
			</select>

			<input type="submit" name="enviar_canal" value="enviar">

		</form>
	</div>	

</body>
</html>