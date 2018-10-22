	<?php 
	
	session_start();

	if(!isset($_SESSION['admin'])){
		header('location:../user/config_user/login.php');
	}

	try {
        
    	$base=new PDO("mysql:host=localhost; dbname=cableunet", 'root', '');

    	$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	} catch (Exception $e) {
    	die("Error ....  " . $e->getMessage());   
	}
?>

<?php 

$sql4="SELECT * FROM solicitudes";
$result_s=$base->prepare($sql4);
$result_s->execute();

$cont=0;

while ($current_s = $result_s->fetch(PDO::FETCH_ASSOC)) {
	$cont++;
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Administrador</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>


	

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Cable Unet Administrador</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">     
      <li class="nav-item">
        <a class="nav-link" href="servicios/programas.php">Registro</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="carga_programacion/programacion.php">Carga de programacion</a>
      </li>
     
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Creacion de servicios
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="servicios/internet.php">Internet</a>
          <a class="dropdown-item" href="servicios/telefonia.php">Telefonia</a>          
          <a class="dropdown-item" href="servicios/cable.php">Cable</a>
          <a class="dropdown-item" href="servicios/canal.php">Canales</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Paquetes        
		</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			<a class="dropdown-item" href="paquetes/pack_servicios.php">Servicios</a>
			<a class="dropdown-item" href="paquetes/pack_canales.php">Canales</a>
        </div>
      </li>
      <li class="nav-item">
	  	<a class="nav-link" href="confg_admin/solicitudes.php">Solicitudes <?php echo "(". $cont . ")"; ?></a>
	  </li>

	  <li class="nav-item">
	  	<a class="nav-link" href="confg_admin/cierre.php">Cerrar sesión</a>
	  </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" method="post" action="confg_admin/busqueda_db.php">
      <input class="form-control mr-sm-2" type="search" placeholder="Busqueda" aria-label="Search" name="busqueda" required>
      <button class="btn btn-outline-light my-2 my-sm-0" type="submit" name="buscar_admin">Buscar</button>
    </form>
  </div>
</nav>

	<div class="container">
		<div class="row">
			<div class="col">

				<h2 class="Guia">Guia de Programación</h2>
			</div>
		</div>
	</div>

	


	<div class="container">

		<section>
			<?php 

		    	$sql="SELECT * FROM programacion_canal";
		    	$result=$base->prepare($sql);
		    	$result->execute();

		    	while ($current = $result->fetch(PDO::FETCH_ASSOC)):?>

			    	<?php 

			    		echo "<div class='canales'>" . $current['nombre_canal'] . "</div>";

			    		$programas=explode(",",$current['id_progra']);

			    		$sql="SELECT * FROM programas";
			    		$result_p=$base->prepare($sql);
			    		$result_p->execute();

			    		while($prog = $result_p->fetch(PDO::FETCH_ASSOC)){

			    			foreach ($programas as $key) {

			    				if ($prog['id'] == $key) {
			    					echo "<div class='programas'>" . " <div class='hora'>". $prog['hora_comienzo'] . " - " . $prog['hora_termina'] . "</div>" . $prog['programa'] . "  </div> ";
			    				}
			    			}
			    		}

			    	 ?>

			    	<hr>

		    	<?php endwhile ?>		
			
		</section>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>