<?php 
	
	session_start();

	if(!isset($_SESSION['usuario'])){
		header('location:../log/login.php');
	}

	try {
            
        $base= new PDO("mysql:host=localhost; dbname=cableunet", 'root', '');

        $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    } catch (Exception $e) {
        die("Error ....  " . $e->getMessage());   
    }

    $sql="SELECT * FROM paquetes";
    $result=$base->prepare($sql);
    $result->execute();

    $band_precio=0;
    $band=0;
    $cont=0;
    $conta_c=0;

 ?>

 <?php if(isset($_POST['enviar_serv'])): ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Cambio plan de paquetes</title>
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../../../css/cambio_plan.css">
 </head>
 <body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="../index.php">CableUnet </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">     
      <li class="nav-item">
        <a class="nav-link" href="plan_serv.php">Paquetes de servicios</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="plan_canal.php">Paquetes de canales</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../config_user/factura.php">Pagos mensuales</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../../Admin/confg_admin/cierre.php">Cerrar sesión</a>
      </li>
  
    </ul>
 
  </div>
</nav>

	<div class="container">

		<?php 

			$sql1="SELECT * FROM solicitudes";
    		$solicitud=$base->prepare($sql1);
    		$solicitud->execute();

    		$existe=false;

    		while ($current_s = $solicitud->fetch(PDO::FETCH_ASSOC)) {
    			
    			if ($_SESSION['usuario'] == $current_s['usuario'] && isset($current_s['paquete_viejo'])) {
    				
    				$existe=true;
    			}
    		}

    		if ($existe) {
    			echo '<script language="javascript">alert("Ya hiciste una solicitud de cambio de plan. Por favor espera a que se analice y procese");</script>';
					echo "<script>window.location='plan_serv.php';</script>";
    		}

    		if (!$existe):

				$sql2="SELECT * FROM facturacion";
	    		$fact_serv=$base->prepare($sql2);
	    		$fact_serv->execute();

				while ($planes = $fact_serv->fetch(PDO::FETCH_ASSOC)){

					if ($_SESSION['usuario'] == $planes['usuario']) {
						
						$band_precio = $planes['fact_servicios'];

						if ($band_precio != null) {
							
							$band = $band_precio;
						}

					}
					
				} ?>	

					<?php  while ($current = $result->fetch(PDO::FETCH_ASSOC)):

						if ($current['precio'] != $band):?>

						<div class="box">

							<?php 

								if ($cont == 0) {
									echo "<div class='titulo'>" . $current['nombre'] . "<div class='precio'>" . "BsS. " .  $current['precio'] . "</div>" . "</div>";
									$cont++;
								}elseif ($cont == 1) {
									echo "<div class='titulo_1'>" . $current['nombre'] . "<div class='precio'>" . "BsS. " .  $current['precio'] . "</div>" . "</div>";
									$cont++;
								}elseif ($cont == 2) {
									echo "<div class='titulo_2'>" . $current['nombre'] . "<div class='precio'>" . "BsS. " .  $current['precio'] . "</div>" . "</div>";
									$cont++;
								}elseif ($cont == 3) {
									echo "<div class='titulo_3'>" . $current['nombre'] . "<div class='precio'>" . "BsS. " .  $current['precio'] . "</div>" . "</div>";
									$cont++;
								}elseif ($cont == 4) {
									echo "<div class='titulo_4'>" . $current['nombre'] . "<div class='precio'>" . "BsS. " .  $current['precio'] . "</div>" . "</div>";
									$cont++;
								}elseif ($cont == 5) {
									echo "<div class='titulo_5'>" . $current['nombre'] . "<div class='precio'>" . "BsS. " .  $current['precio'] . "</div>" . "</div>";
									$cont++;
								}
										

							 	$sql="SELECT * FROM servicios";
					   			$servicios=$base->prepare($sql);
					    		$servicios->execute();
							?>

								<form action="autorizacion.php" method="post" class="form">
									
									<p><button name="cambio_serv" type="submit" value="<?= $current['id'] ?>">Enviar solicitud</button></p>
								</form>

								<label><b>Incluye</b></label>

							<?php while($serv = $servicios->fetch(PDO::FETCH_ASSOC)): ?>
							

							<?php if($serv['id'] == $current['internet'] || $serv['id'] == $current['telefonia'] || $serv['id'] == $current['cable'] ): ?>

								<div class="planes">
								
								<?php 

									echo "<div class='servicios'>" . $serv['nombre'] .": " . $serv['plan'] . " " . $serv['velocidad'] . "</div>";
								?>
								</div>	

						<?php endif ?>
						<?php endwhile ?>	
							
					</div>	

					<?php endif ?>			
			    	<?php endwhile ?> 

			    <?php endif ?>	 				
	</div>
	
	
 </body>
 </html>

 <?php endif ?>






 <?php if(isset($_POST['enviar_canal'])):

	$plan_nuevo = "";

	if(!isset($_SESSION['usuario'])){
		header('location:../log/login.php');
	}

  	$sql="SELECT * FROM paquetes_canales";
    $result=$base->prepare($sql);
    $result->execute();

    $cont=0;

   ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Paquetes de canales</title>
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 	<link rel="stylesheet" type="text/css" href="../../../css/cambio_plan.css">
 </head>
 <body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="../index.php">CableUnet </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">     
      <li class="nav-item">
        <a class="nav-link" href="plan_serv.php">Paquetes de servicios</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="plan_canal.php">Paquetes de canales</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../config_user/factura.php">Pagos mensuales</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../../Admin/confg_admin/cierre.php">Cerrar sesión</a>
      </li>
  
    </ul>
 
  </div>
</nav>

 	<div class="container">

 		<?php 

 			$sql1="SELECT * FROM solicitudes";
    		$solicitud=$base->prepare($sql1);
    		$solicitud->execute();

    		$existe=false;

    		while ($current_s = $solicitud->fetch(PDO::FETCH_ASSOC)) {
    			
    			if ($_SESSION['usuario'] == $current_s['usuario'] && isset($current_s['plan_canal_v'])) {
    				
    				$existe=true;
    			}
    		}

    		if ($existe) {
    			echo '<script language="javascript">alert("Ya hiciste una solicitud de cambio de plan. Por favor espera a que se analice y procese");</script>';
				echo "<script>window.location='plan_canal.php';</script>";
    		}

    		if (!$existe):

	 			$sql2="SELECT * FROM facturacion";
	    		$fact_serv=$base->prepare($sql2);
	    		$fact_serv->execute();

				while ($planes = $fact_serv->fetch(PDO::FETCH_ASSOC)){

					if ($_SESSION['usuario'] == $planes['usuario']) {
						
						$band_precio = $planes['fact_canal'];

						if ($band_precio != null) {
							
							$band = $band_precio;
						}

					}
					
				}

	 		 ?>
	 		
			<?php while ($current = $result->fetch(PDO::FETCH_ASSOC)):

				if ($current['precio'] != $band): ?>		
				
				<div class="box_canal">
						
					<?php 

						if ($conta_c == 0) {
							echo "<div class='titulo_canal'>" . $current['plan'] . "<div>" ."BsS. ". $current['precio'] . "</div>" . "</div>";
							$conta_c++;
						}elseif ($conta_c == 1) {
							echo "<div class='titulo_canal_1'>" . $current['plan'] . "<div>" ."BsS. ". $current['precio'] . "</div>" . "</div>";
							$conta_c++;
						}elseif ($conta_c == 2) {
							echo "<div class='titulo_canal_2'>" . $current['plan'] . "<div>" ."BsS. ". $current['precio'] . "</div>" . "</div>";
							$conta_c++;
						}elseif ($conta_c == 3) {
							echo "<div class='titulo_canal_3'>" . $current['plan'] . "<div>" ."BsS. ". $current['precio'] . "</div>" . "</div>";
							$conta_c++;
						}elseif ($conta_c == 4) {
							echo "<div class='titulo_canal_4'>" . $current['plan'] . "<div>" ."BsS. ". $current['precio'] . "</div>" . "</div>";
							$conta_c++;
						}elseif ($conta_c == 5) {
							echo "<div class='titulo_canal_5'>" . $current['plan'] . "<div>" ."BsS. ". $current['precio'] . "</div>" . "</div>";
							$conta_c++;
						}

						$canales=explode(",",$current['canales']);

						foreach ($canales as $key) {
							$cont++;
						}
					?>		
						
					<form action="autorizacion.php" method="post" class="form">

						<p><button name="cambio_canal" type="submit" value="<?= $current['id'] ?>" class='b_cambio_canal'>Enviar solicitud</button></p>
					</form>

					<label><b>Incluye</b></label>

					<div class="num_canal">
						
						<?php 

							echo $cont . "canales";
						?>

					</div>
				</div>

				<?php endif ?>	
			<?php endwhile ?>

		<?php endif ?>

 	</div>
 
 </body>
 </html>

 <?php endif ?>