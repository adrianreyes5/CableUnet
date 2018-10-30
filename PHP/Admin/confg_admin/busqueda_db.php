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
 	<link rel="stylesheet" type="text/css" href="../../../css/busqueda_s.css">
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 	
 </head>
 <body>

 	<?php if (!$band && isset($_SESSION['usuario'])):?>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		  <a class="navbar-brand" href="../../user/index.php">CableUnet </a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">     
		      <li class="nav-item">
		        <a class="nav-link" href="../../user/planes/plan_serv.php">Paquetes de servicios</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="../../user/planes/plan_canal.php">Paquetes de canales</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="../../user/config_user/factura.php">Pagos mensuales</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="cierre.php">Cerrar sesión</a>
		      </li>
		  
		    </ul>
 
		  </div>
		</nav>
	<?php endif ?>

	<?php if (!$band && isset($_SESSION['admin'])):?>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <a class="navbar-brand" href="../index_admin.php">CableUnet Admin</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">     
	      <li class="nav-item">
	        <a class="nav-link" href="../servicios/programas.php">Registro de programas</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="../carga_programacion/programacion.php">Carga de programacion</a>
	      </li>
	     
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Creacion de servicios
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	          <a class="dropdown-item" href="../servicios/internet.php">Internet</a>
	          <a class="dropdown-item" href="../servicios/telefonia.php">Telefonia</a>          
	          <a class="dropdown-item" href="../servicios/cable.php">Cable</a>
	          <a class="dropdown-item" href="../servicios/canal.php">Canales</a>
	        </div>
	      </li>
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Paquetes        
			</a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="../paquetes/pack_servicios.php">Servicios</a>
				<a class="dropdown-item" href="../paquetes/pack_canales.php">Canales</a>
	        </div>
	      </li>
	 

		  <li class="nav-item">
		  	<a class="nav-link" href="cierre.php">Cerrar sesión</a>
		  </li>
	    </ul>
 
	  </div>
    </nav>
	<?php endif ?>

	<?php if ($band && isset($_SESSION['usuario'])):?>

		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		  <a class="navbar-brand" href="../../user/index.php">CableUnet </a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">     
		      <li class="nav-item">
		        <a class="nav-link" href="../../user/planes/plan_serv.php">Paquetes de servicios</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="../../user/planes/plan_canal.php">Paquetes de canales</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="../../user/config_user/factura.php">Pagos mensuales</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="cierre.php">Cerrar sesión</a>
		      </li>
		  
		    </ul>
 
		  </div>
		</nav>
	<?php endif ?>

	<?php if ($band && isset($_SESSION['admin'])):?>

		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <a class="navbar-brand" href="../index_admin.php">CableUnet Admin</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">     
	      <li class="nav-item">
	        <a class="nav-link" href="../servicios/programas.php">Registro de programas</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="../carga_programacion/programacion.php">Carga de programacion</a>
	      </li>
	     
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Creacion de servicios
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	          <a class="dropdown-item" href="../servicios/internet.php">Internet</a>
	          <a class="dropdown-item" href="../servicios/telefonia.php">Telefonia</a>          
	          <a class="dropdown-item" href="../servicios/cable.php">Cable</a>
	          <a class="dropdown-item" href="../servicios/canal.php">Canales</a>
	        </div>
	      </li>
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Paquetes        
			</a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="../paquetes/pack_servicios.php">Servicios</a>
				<a class="dropdown-item" href="../paquetes/pack_canales.php">Canales</a>
	        </div>
	      </li>
	 

		  <li class="nav-item">
		  	<a class="nav-link" href="cierre.php">Cerrar sesión</a>
		  </li>
	    </ul>
 
	  </div>
    </nav>
	<?php endif ?>


 	<div class="container col-12 col-sm-7">

		<?php 

 			if ($band  == true): ?>

 				<?php  
 										
					$sql="SELECT * FROM programacion_canal";
					$result=$base->prepare($sql);
					$result->execute();

					while($buscar_c = $result->fetch(PDO::FETCH_ASSOC)):
						
						if ($buscar == $buscar_c['nombre_canal']):

							echo "<div class='canal '>" . $buscar_c['nombre_canal'] . "</div>";

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

 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 </html>