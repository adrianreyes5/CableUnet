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

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Guía</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">CableUnet </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">     
      <li class="nav-item">
        <a class="nav-link" href="planes/plan_serv.php">Paquetes de servicios</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="planes/plan_canal.php">Paquetes de canales</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="config_user/factura.php">Pagos mensuales</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Admin/confg_admin/cierre.php">Cerrar sesión</a>
      </li>
  
    </ul>
    <form class="form-inline my-2 my-lg-0" method="post" action="../Admin/confg_admin/busqueda_db.php">
      <input class="form-control mr-sm-2" type="search" placeholder="Busqueda" aria-label="Search" name="busqueda" required>
      <button class="btn btn-outline-light my-2 my-sm-0" type="submit" name="buscar_user">Buscar</button>
    </form>
  </div>
</nav>
 

	<div class="container">
		<div class="row">
			<div class="col mt-5">

				<h2 class="Guia mb-4 mt-5">Guia de Programación</h2>
			</div>
		</div>
	</div>

	<div class="container">
		
			 
				<?php 

					$sql="SELECT * FROM programacion_canal";
					$result=$base->prepare($sql);
					$result->execute();

					while ($current = $result->fetch(PDO::FETCH_ASSOC)):?>


						<?php 

							echo "<div class='row'><div class='col'><h3 class='text-center'>" . $current['nombre_canal'] . "</h3 class='text-center'></div></div>";


							echo "<div class='row'>";
							$programas=explode(",",$current['id_progra']);
							
							$sql="SELECT * FROM programas";
							$result_p=$base->prepare($sql);
							$result_p->execute();
							
							while($prog = $result_p->fetch(PDO::FETCH_ASSOC)){
								
								foreach ($programas as $key) {
									
									if ($prog['id'] == $key) {
										/*echo "<div class='programas'>" . " <div class='hora'>". $prog['hora_comienzo'] . " - " . $prog['hora_termina'] . "</div>" . $prog['programa'] . "  </div> ";*/
										echo "<div class='col-12 col-sm-6 col-md-4 col-lg-3'>
														<div class='card text-white bg-primary mb-3'>
															<h5 class='card-header'>" . $prog['hora_comienzo'] . " - " . $prog['hora_termina'] ."</h5>
															<div class='card-body'>
																<h5 class='card-title'>" . $prog['programa'] ."</h5>
															</div>
														</div>
													</div>														
													";
									}
								}
							}
							echo "</div>";
						?>

						<hr>

					<?php endwhile ?>		
			
		
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>