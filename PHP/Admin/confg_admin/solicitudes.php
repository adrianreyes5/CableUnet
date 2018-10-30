<?php 

	session_start();

	if(!isset($_SESSION['admin'])){
		header('location:../log/login.php');
	}

	try {
            
        $base= new PDO("mysql:host=localhost; dbname=cableunet", 'root', '');

        $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    } catch (Exception $e) {
        die("Error ....  " . $e->getMessage());   
    }

   $sql="SELECT * FROM solicitudes";
   $result=$base->prepare($sql);
   $result->execute();
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Solicitudes</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../../../css/solicitudes.css">
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

  <div class="container">

     	<?php 

     		while ($current = $result->fetch(PDO::FETCH_ASSOC)):

          if(isset($current['paquete_viejo'])):

     			echo "<div class='usuario'>" . $current['usuario'] . " solicita cambio de plan " . $current['paquete_viejo'] . " a plan " . $current['paquete_nuevo'] . "</div>" ;
     	 ?>
    		
    		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class='form'>
    			<button type="submit" class="btn btn-primary" name="aceptar_solicitud" value="<?= $current['usuario'] ?>">aceptar</button>	
    	 	 	<button type="submit" class="btn btn-primary" name="rechazar_solicitud" value="<?= $current['usuario'] ?>">rechazar</button>
    		</form>

      <?php endif ?>
     	<?php endwhile ?>

      <?php 

        $sql="SELECT * FROM solicitudes";
        $result_c=$base->prepare($sql);
        $result_c->execute();

        while ($current = $result_c->fetch(PDO::FETCH_ASSOC)):

          if(isset($current['plan_canal_v'])):

            echo "<div class='usuario'> Usuario: " . $current['usuario'] . " solicita cambio de plan " . $current['plan_canal_v'] . " a plan " . $current['plan_canal_n'] . "</div>" ;

       ?>

          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <button type="submit" name="aceptar_solicitud_canal" value="<?= $current['usuario'] ?>">aceptar</button>  
            <button type="submit" name="rechazar_solicitud_canal" value="<?= $current['usuario'] ?>">rechazar</button>
          </form>

        <?php endif ?>
      <?php endwhile ?>  

  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
 </body>
 </html>

 <?php 

 	if (isset($_POST['aceptar_solicitud'])) {

 		$usuario=$_POST['aceptar_solicitud'];
 		$fact_id=0;
 		
 		$sql1="SELECT * FROM solicitudes";
   	$aceptar=$base->prepare($sql1);
   	$aceptar->execute();

   	 	while ($current = $aceptar->fetch(PDO::FETCH_ASSOC)){

   	 		if ($current['usuario'] == $usuario) {
   	 			
   	 			$sql2="SELECT * FROM facturacion";
   	 			$fact=$base->prepare($sql2);
   	 			$fact->execute();

   	 			while ($current_f = $fact->fetch(PDO::FETCH_ASSOC)) {
   	 				
   	 				if ($current['fact_id'] == $current_f['id']) {
   	 					
   	 					$sql3="DELETE FROM facturacion WHERE id = '". $current_f['id'] . "'";
   	 					$borrar=$base->prepare($sql3);	
   	 					$borrar->execute();

   	 					$sql3="SELECT * FROM paquetes";
   	 				 	$paquetes=$base->prepare($sql3);
   	 				 	$paquetes->execute();

   	 				 	while ($current_p = $paquetes->fetch(PDO::FETCH_ASSOC)) {
   	 				 		
   	 				 		if ($current_p['nombre'] == $current['paquete_nuevo']) {
   	 				 			
   	 				 			$sql4="INSERT INTO facturacion (usuario,fact_servicios,activo) VALUES (?,?,?)";
   	 							$agg=$base->prepare($sql4);
   	 							$agg->execute([$current['usuario'],$current_p['precio'],1]);

   								$sql5="DELETE FROM solicitudes WHERE id = '". $current['id'] . "'";
   						 		$borrar=$base->prepare($sql5);	
   						 		$borrar->execute();

   						 		$registered=$borrar->rowCount();

   						 		if ($registered == 1) {
   						 			header("location:solicitudes.php");
   						 		}
   	 				 		}
   	 				 	}
   	 				}
   	 			}
   	 		}
   	 	}
 	}

 	if (isset($_POST['rechazar_solicitud'])) {

 		$usuario=$_POST['rechazar_solicitud'];
 		
 		  $sql="SELECT * FROM solicitudes";
   	 	$rechazar=$base->prepare($sql);
   	 	$rechazar->execute();

   	 	while ($current = $rechazar->fetch(PDO::FETCH_ASSOC)){

   	 		if ($current['usuario'] == $usuario && isset($current['paquete_viejo'])) {

   	 			$sql2="DELETE FROM solicitudes WHERE id = '". $current['id'] . "'";
 				$borrar=$base->prepare($sql2);	
 				$borrar->execute();

 				$registered=$borrar->rowCount();

		 		if ($registered == 1) {
		 			header("location:solicitudes.php");
		 		}
   	 	}
   	}
 	}


  if (isset($_POST['aceptar_solicitud_canal'])) {
    
    $usuario=$_POST['aceptar_solicitud_canal'];
    $fact_id=0;

    $sql1="SELECT * FROM solicitudes";
    $aceptar=$base->prepare($sql1);
    $aceptar->execute();

    while ($current = $aceptar->fetch(PDO::FETCH_ASSOC)){

      if ($current['usuario'] == $usuario) {

        $sql2="SELECT * FROM facturacion";
        $fact=$base->prepare($sql2);
        $fact->execute();

        while ($current_f = $fact->fetch(PDO::FETCH_ASSOC)) {

          if ($current['fact_id'] == $current_f['id']) {

            $sql3="DELETE FROM facturacion WHERE id = '". $current_f['id'] . "'";
            $borrar=$base->prepare($sql3);  
            $borrar->execute();

            $sql3="SELECT * FROM paquetes_canales";
            $paquetes=$base->prepare($sql3);
            $paquetes->execute();

            while ($current_p = $paquetes->fetch(PDO::FETCH_ASSOC)) {

              if ($current_p['plan'] == $current['plan_canal_n']) {

                $sql4="INSERT INTO facturacion (usuario,fact_canal,activo) VALUES (?,?,?)";
                $agg=$base->prepare($sql4);
                $agg->execute([$current['usuario'],$current_p['precio'],2]);

                $sql5="DELETE FROM solicitudes WHERE id = '". $current['id'] . "'";
                $borrar=$base->prepare($sql5);  
                $borrar->execute();

                $registered=$borrar->rowCount();

                if ($registered == 1) {
                  header("location:solicitudes.php");
                }  
              }  
            }  
          }  
        }  
      }  
    }
  }

  if (isset($_POST['rechazar_solicitud_canal'])) {
    
    $usuario=$_POST['rechazar_solicitud_canal'];

    $fact_id=0;

    $sql="SELECT * FROM solicitudes";
    $rechazar=$base->prepare($sql);
    $rechazar->execute();

    while ($current = $rechazar->fetch(PDO::FETCH_ASSOC)){

        if ($current['usuario'] == $usuario && isset($current['plan_canal_v'])) {

        $sql2="DELETE FROM solicitudes WHERE id = '". $current['id'] . "'";
        $borrar=$base->prepare($sql2);  
        $borrar->execute();

        $registered=$borrar->rowCount();

        if ($registered == 1) {
          header("location:solicitudes.php");
        }
      }
    }

  }

  ?>