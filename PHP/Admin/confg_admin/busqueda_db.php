<?php
	
	session_start();

	$buscar = $_POST['busqueda'];
	$band = false;

	try {
        
    	$base=new PDO("mysql:host=localhost; dbname=cableunet", 'root', '');

    	$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
    	die("Error ....  " . $e->getMessage());   
	}

	$sql="SELECT * FROM programacion_canal";
	$result=$base->prepare($sql);
	$result->execute();

	while ($valida = $result->fetch(PDO::FETCH_ASSOC)) {
		
		if ($buscar == $valida['nombre_canal']) {
			$band = true;
		}
	}
 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>Info <?php echo $buscar; ?></title>
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 	<link rel="stylesheet" type="text/css" href="../../../css/busqueda_s.css">
 </head>
 <body>

 	<?php if (!$band && isset($_SESSION['usuario'])):?>
		<div id="header_user">

			<h2 class="cabezera_user">Cable Unet</h2>

			<ul class="nav_user">

				<li><a href="../../user/index.php">Programación</a></li>

				<li><a href="../../user/planes/plan_serv.php">Paquetes de servicios</a></li>

				<li><a href="../../planes/plan_canal.php">Planes de canales</a></li>

				<li><a href="">Facturas mensuales</a></li>

				<li><a href="../confg_admin/cierre.php">Cerrar sesión</a></li>
			</ul>		
		</div>
	<?php endif ?>

	<?php if (!$band && isset($_SESSION['admin'])):?>

		<div id="header">
		
			<h2 class="cabezera">Cable Unet <br>Administrador</br></h2>

			<ul class="nav">

				<li><a href="../index_admin.php">Programación</a></li>

				<li><a href="../servicios/programas.php">Registro de programas</a></li>

				<li><a href="../carga_programacion/programacion.php">Carga de programacion</a></li>

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

				<li><a href="cierre.php">Cerrar sesión</a></li>
			</ul>		
		</div>
	<?php endif ?>

	<?php if ($band && isset($_SESSION['usuario'])):?>

		<div id="header_user">

			<h2 class="cabezera_user">Cable Unet</h2>

			<ul class="nav_user">

				<li><a href="../../user/index.php">Programación</a></li>

				<li><a href="../../user/planes/plan_serv.php">Paquetes de servicios</a></li>

				<li><a href="../../planes/plan_canal.php">Planes de canales</a></li>

				<li><a href="">Facturas mensuales</a></li>

				<li><a href="../confg_admin/cierre.php">Cerrar sesión</a></li>
			</ul>		
		</div>
	<?php endif ?>

	<?php if ($band && isset($_SESSION['admin'])):?>

		<div id="header">
		
			<h2 class="cabezera">Cable Unet <br>Administrador</br></h2>

			<ul class="nav">

				<li><a href="../index_admin.php">Programación</a></li>

				<li><a href="../servicios/programas.php">Registro de programas</a></li>

				<li><a href="../carga_programacion/programacion.php">Carga de programacion</a></li>

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

				<li><a href="cierre.php">Cerrar sesión</a></li>
			</ul>		
		</div>
	<?php endif ?>


 	<div class="container">

		<?php 

 			if ($band  == true): ?>

 				<?php  
 										
					$sql="SELECT * FROM programacion_canal";
					$result=$base->prepare($sql);
					$result->execute();

					while($buscar_c = $result->fetch(PDO::FETCH_ASSOC)):
						
						if ($buscar == $buscar_c['nombre_canal']):

							echo "<div class='canal'>" . $buscar_c['nombre_canal'] . "</div>";

							$programas = explode(",",$buscar_c['id_progra']);
							
							$sql="SELECT * FROM programas";
							$result=$base->prepare($sql);
							$result->execute();
				?>

				<h2>Programación del canal</h2>

				<div class="hora_titulo">
					<label>Inicia</label>
					<label>Termina</label>
					<label>Título</label>
				</div>

				<?php 
						while ($prog = $result->fetch(PDO::FETCH_ASSOC)) {
							
							foreach ($programas as $key) {
								
								if ($prog['id'] == $key) {
									echo "<div class='programas'>" . "<label>" . $prog['hora_comienzo'] . "</label>" . " " . "<label>" . $prog['hora_termina'] . "</label>" . "<label>" . $prog['programa'] . "</label>" . "  </div> ";	
								}
							}

						}	
				?>

				<?php endif ?>
				<?php endwhile ?>

			<?php endif ?>

			<?php 

				if ($band  == false):

					$sql="SELECT * FROM programacion_canal";
					$result=$base->prepare($sql);
					$result->execute();
				?>

					<h1>Programación</h1>

					<div class="titulo_dia_hora">
						<label class="titulo">Canal</label>
						<label class="dia_hora">Fecha / Hora</label>
						<label class="inicia">Título</label>
					</div>

				<?php 

					while ($prog = $result->fetch(PDO::FETCH_ASSOC)) {

						$programa_id = explode(",",$prog['id_progra']);

						$sql1="SELECT * FROM programas";
						$result_p=$base->prepare($sql1);
						$result_p->execute();

						while ($current_p = $result_p->fetch(PDO::FETCH_ASSOC)) {
							 
							foreach ($programa_id as $key) {
								
								if ($key == $current_p['id']) {
									
									if (strcmp($buscar,$current_p['programa']) === 0) {
										echo "<div class='busqueda_p'>" . "<label>" .  $prog['nombre_canal'] . "</label>" . "<label>" .  $current_p['fecha'] . "</label>" . "/ " .  $current_p['hora_comienzo']  . "<label>" . $current_p['programa'] . "</label>" . "</div>" ;
									}
								}
							}
						}
					}
				 ?>	
					
			<?php endif ?>		
		
 	</div>
 			
 </body>
 </html>