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
?>



<!DOCTYPE html>
<html>
<head>
	<title>Paquetes</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../../../css/planes.css">
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

	<div class="container" style="background-color: #F2F2F2">
		<div class="row">
			<div class="col mt-5">

				<h2 class="Guia">Paquetes de servicios</h2>
			</div>
		</div>
	</div>

	<div class="container">

		<?php 

			$cont=0;

			while ($current = $result->fetch(PDO::FETCH_ASSOC)):?>

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
						}elseif ($cont == 6) {
							echo "<div class='titulo_6'>" . $current['nombre'] . "<div class='precio'>" . "BsS. " .  $current['precio'] . "</div>" . "</div>";
							$cont++;
						}elseif ($cont == 7) {
							echo "<div class='titulo_7'>" . $current['nombre'] . "<div class='precio'>" . "BsS. " .  $current['precio'] . "</div>" . "</div>";
							$cont++;
						}elseif ($cont == 8) {
							echo "<div class='titulo_8'>" . $current['nombre'] . "<div class='precio'>" . "BsS. " .  $current['precio'] . "</div>" . "</div>";
							$cont++;
						}
							

					 	$sql="SELECT * FROM servicios";
			   			$servicios=$base->prepare($sql);
			    		$servicios->execute();
					?>

					<form action="../../Admin/confg_admin/facturacion.php" method="post" class="form">
						
						<p><button name="compra_serv" type="submit" value="<?= $current['precio'] ?>">Suscribete</button></p>
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
						
	    <?php endwhile ?>   

	</div>

	<?php 

		$sql="SELECT * FROM facturacion";
		$fact=$base->prepare($sql);
		$fact->execute();

		while ($current = $fact->fetch(PDO::FETCH_ASSOC)):
			
			if ($_SESSION['usuario'] == $current['usuario'] && isset($current['fact_servicios'])):?>

				<div class="container cambio_plan">

					<h5>¿Ya sabes cual plan se adapta mejor a ti?</h5>

			    	<form action="cambio_plan.php" method="post">
			    		<input type="submit" name="enviar_serv" value="Cambiate de plan">
			    	</form>
				</div>

			<?php endif ?>
			
		<?php endwhile ?>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>			

</body>
</html>