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

    $sql="SELECT * FROM paquetes_canales";
    $result=$base->prepare($sql);
    $result->execute();

    $cont=0;
    $conta=0;
?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>Paquetes de canales</title>
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 	<link rel="stylesheet" type="text/css" href="../../../css/planes.css">
 </head>
 <body>

 	<div id="header">

 		<h2 class="cabezera">Cable Unet <br><?php echo $_SESSION['usuario'] ?></br></h2>

		<ul class="nav">

			<li><a href="../index.php">Programación</a></li>

			<li><a href="plan_serv.php">Paquetes de servicios</a></li>

			<li><a href="plan_canal.php">Planes de canales</a></li>

			<li><a href="">Facturas mensuales</a></li>

			<li><a href="../../Admin/confg_admin/cierre.php">Cerrar sesión</a></li>
		</ul>		
	</div>

 	<div class="container">
 		
		<?php while ($current = $result->fetch(PDO::FETCH_ASSOC)): ?>			
			
			<div class="box_canal">
					
				<?php 

					if ($conta == 0) {
						echo "<div class='titulo_canal'>" . $current['plan'] . "<div>" ."BsS. ". $current['precio'] . "</div>" . "</div>";
						$conta++;

					}elseif ($conta == 1) {
						echo "<div class='titulo_canal_1'>" . $current['plan'] . "<div>" ."BsS. ". $current['precio'] . "</div>" . "</div>";
						$conta++;
					}elseif ($conta == 2) {
						echo "<div class='titulo_canal_2'>" . $current['plan'] . "<div>" ."BsS. ". $current['precio'] . "</div>" . "</div>";
						$conta++;
					}elseif ($conta == 3) {
						echo "<div class='titulo_canal_3'>" . $current['plan'] . "<div>" ."BsS. ". $current['precio'] . "</div>" . "</div>";
						$conta++;
					}elseif ($conta == 4) {
						echo "<div class='titulo_canal_4'>" . $current['plan'] . "<div>" ."BsS. ". $current['precio'] . "</div>" . "</div>";
						$conta++;
					}elseif ($conta == 5) {
						echo "<div class='titulo_canal_5'>" . $current['plan'] . "<div>" ."BsS. ". $current['precio'] . "</div>" . "</div>";
						$conta++;
					}

					$canales=explode(",",$current['canales']);

					foreach ($canales as $key) {
						$cont++;
					}
				?>		
					
				<form action="../../Admin/confg_admin/facturacion.php" method="post" class="form">

					<p><button name="compra_canal" type="submit" value="<?= $current['precio'] ?>" class='b_canal'>Suscribete</button></p>
				</form>

				<label><b>Incluye</b></label>

				<div class="num_canal">
					
					<?php 

						echo $cont . "canales";

						$sql1="SELECT id,nombre FROM canales";
						$result_c=$base->prepare($sql1);
						$result_c->execute();

						while ($canal = $result_c->fetch(PDO::FETCH_ASSOC)) {
							
							foreach ($canales as $key) {
								
								if ($canal['id'] == $key) {
									
									//echo "<div>" . $canal['nombre'] . "</div>";
								}

							}
						}
					?>

				</div>
			</div>
		<?php endwhile ?>

 	</div>

 	<?php 

		$sql="SELECT * FROM facturacion";
		$fact=$base->prepare($sql);
		$fact->execute();

		while ($current = $fact->fetch(PDO::FETCH_ASSOC)):
			
			if ($_SESSION['usuario'] == $current['usuario'] && isset($current['fact_canal'])):?>

				<div class="container cambio_plan_canal">

					<h5>¿Ya sabes cual plan se adapta mejor a ti?</h5>

			    	<form action="cambio_plan.php" method="post">
			    		<input type="submit" name="enviar_canal" value="Cambiate de plan">
			    	</form>
				</div>

			<?php endif ?>
			
		<?php endwhile ?>
 
 </body>
 </html>