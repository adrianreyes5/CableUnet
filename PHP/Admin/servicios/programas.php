<?php 

	session_start();

 	if(!isset($_SESSION['admin'])){
    	header('location:../user/config_user/login.php');
    }
	
	if (isset($_POST['submit'])) {
			$programa=$_POST['programa'];
			$fecha=$_POST['fecha'];
			$hora_comienzo=$_POST['hora_comienzo'];
			$hora_termina=$_POST['hora_termina'];

		try {
			
			$base=new PDO("mysql:host=localhost; dbname=cableunet", 'root', '');

			$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 

			$sql="INSERT INTO programas (programa,fecha,hora_comienzo,hora_termina) VALUES (?,?,?,?)";

		} catch (Exception $e) {
			die ("Error:.." . $e->getMessage());
		}

	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Registo programas</title>
	<link rel="stylesheet" type="text/css" href="../../../css/programas_s.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="../index_admin.php">CableUnet Admin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto"> 

      <li class="nav-item">
        <a class="nav-link" href="programas.php">Registro de programas</a>
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
	  	<a class="nav-link" href="../confg_admin/cierre.php">Cerrar sesión</a>
	  </li>
    </ul>
 
  </div>
</nav>
		
	<div class="container col-12 col-sm-6">  
	  <form id="contact" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	    <h3>Registro de programas</h3>
	    <fieldset>
	      <input placeholder="Programa" type="text" name="programa" tabindex="1" required autofocus>
	    </fieldset>
	    <fieldset>
	      <input placeholder="Fecha" type="text" name="fecha" tabindex="2" required>
	    </fieldset>
	    <fieldset>
	      <input placeholder="Hora de comienzo" type="text" name="hora_comienzo" tabindex="3" required>
	    </fieldset>
	    <fieldset>
	      <input placeholder="Hora que finaliza" type="text" name="hora_termina" tabindex="4" required>
	    </fieldset>
	      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Registrar</button>
	    </fieldset>
		<fieldset>
			<?php 

					if (isset($_POST['submit'])){

						$date=date($fecha);
						$comienzo=date($hora_comienzo);
						$final=date($hora_termina);

					 	$sql1 = "SELECT * FROM programas";
					 	$search_p=$base->prepare($sql1);
					 	$search_p->execute();

					 	$band = false;

					 	while($current = $search_p->fetch(PDO::FETCH_ASSOC)){

					 		$rest_c = substr($current['hora_comienzo'],-8,5);
					 		$rest_t = substr($current['hora_termina'],-8,5);

					 		if ($rest_c == $comienzo && $rest_t == $final && $date == $current['fecha'] && strcmp($programa,$current['programa'])===0) {
					 			$band = true;
					 		}
					 	}

					 	if ($band == true) {
					 		echo '<script language="javascript">alert("Error: Programa con fecha y horas similares ya existe");</script>'; 
					 	}
						else{
							$result=$base->prepare($sql);

							$result->execute([$programa,$date,$comienzo,$final]);

							$registered=$result->rowCount();

							if($registered == 1){
								echo '<script language="javascript">alert("Programa registrado");</script>'; 
							}
						}

							
					}				
				?>
		</fieldset>	
		</form>		
	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>