<?php 

	session_start();

	if(!isset($_SESSION['usuario'])){
		header('location:log/login.php');
	}

	try {
        
    	$base=new PDO("mysql:host=localhost; dbname=cableunet", 'root', '');

    	$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	} catch (Exception $e) {
    	die("Error ....  " . $e->getMessage());   
	}

	$sql="SELECT * FROM facturacion";
	$result_f=$base->prepare($sql);
	$result_f->execute();

	$precio_serv=null;
	$precio_canal=null;

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Factura</title>
 	<link rel="stylesheet" type="text/css" href="../../../css/canales_guia.css">
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 </head>
 <body style="background: #BEBEBE" >

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="../index.php">CableUnet </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">     
      <li class="nav-item">
        <a class="nav-link" href="../planes/plan_serv.php">Paquetes de servicios</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../planes/plan_canal.php">Paquetes de canales</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="factura.php">Pagos mensuales</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../../Admin/confg_admin/cierre.php">Cerrar sesión</a>
      </li>
  
    </ul>
 
  </div>
</nav>

	 	

 	<div class="container" style="background: #BEBEBE; border: none;  bottom: 50px">

 		<div class="row">
 			<div class="col">
 				<h1 class="text-center" style="color: #5F5F5F">Factura mensual</h1>
 			</div>
 		</div>

 		<div class="row">
 			<div class="col-12 col-md-6 offset-0 offset-md-3 border border-black p-4" style="background: #999999">
 				<?php 

			 		while ($current_f = $result_f->fetch(PDO::FETCH_ASSOC)) {

						$sql1="SELECT * FROM paquetes";
						$result_s=$base->prepare($sql1);
						$result_s->execute();

						while ($current_s = $result_s->fetch(PDO::FETCH_ASSOC)) {

							if ($_SESSION['usuario'] == $current_f['usuario']) {
								
								if ($current_f['fact_servicios'] == $current_s['precio'] ) {
									
									echo "<div class='col-12 col-md-8 offset-0 offset-md-2' style=' padding: 10px; background: #E4E2E2; color:#434343; font-family: Georgia; font-size: 18px;'> Plan de servicios: " . $current_s['nombre'] . "<div> Precio:  " . $current_s['precio'] . " BsS</div> </div>";

									$precio_serv=$current_s['precio'];
								}
							}
						}	
					}

					$sql3="SELECT * FROM facturacion";
					$result=$base->prepare($sql3);
					$result->execute();

					while ($current = $result->fetch(PDO::FETCH_ASSOC)) {
						
						$sql4="SELECT * FROM paquetes_canales";
						$result_c=$base->prepare($sql4);
						$result_c->execute();

						while ($current_c = $result_c->fetch(PDO::FETCH_ASSOC)) {
							
							if ($_SESSION['usuario'] == $current['usuario']) {
								
								if ($current['fact_canal'] == $current_c['precio'] ) {
									
									echo "<div class='col-12 col-md-8 offset-0 offset-md-2' style=' padding: 10px; background: #E4E2E2; color:#434343; font-family: Georgia; font-size: 18px;'> Plan de canales: " . $current_c['plan'] . "<div> Precio:  " . $current_c['precio'] . " BsS</div></div>";

									$precio_canal=$current_c['precio'];
								}
							}
						}
					}

					echo "<div class='col-12 col-md-8 offset-0 offset-md-2' style=' padding: 10px; background: #E4E2E2; color:#434343; font-family: Georgia; font-size: 18px;'> Total a pagar: " . ($precio_canal+$precio_serv) . " BsS</div>";

			 	 ?>
 			</div>
 		</div>
 			
	 		
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

 	</div>
 
 </body>
 </html>