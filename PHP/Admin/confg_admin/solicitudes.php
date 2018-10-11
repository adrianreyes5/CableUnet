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

  <div id="header">

    <h2 class="cabezera">Cable Unet Administrador</h2>

    <ul class="nav">

      <li><a href="../index_admin.php">Programación</a></li>

      <li><a href="../servicios/programas.php">Registro de programas</a></li>

      <li><a href="../carga_programacion/programacion.php">Carga de programacion</a></li>

      <li><a href="">Creacion de servicios</a>
        
        <ul>
          <li><a href="../servicios/internet.php">Internet</a></li>
          <li><a href="../servicios/telefonia.php">Telefonia</a></li>
          <li><a href="../servicios/cable.php">Cable</a></li>
          <li><a href="../servicios/canal.php">Canales</a></li>
        </ul>

      </li>

      <li><a href="">Paquetes</a>
        
        <ul>
          <li><a href="../paquetes/pack_servicios.php">Servicios</a></li>
          <li><a href="../paquetes/pack_canales.php">Canales</a></li>
        </ul>

      </li>

      <li><a href="../confg_admin/cierre.php">Cerrar sesión</a></li>
    </ul>   
  </div>

  <div class="container">

     	<?php 

     		while ($current = $result->fetch(PDO::FETCH_ASSOC)):

          if(isset($current['paquete_viejo'])):

     			echo "<div class='usuario'>" . $current['usuario'] . " solicita cambio de plan " . $current['paquete_viejo'] . " a plan " . $current['paquete_nuevo'] . "</div>" ;
     	 ?>
    		
    		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class='form'>
    			<button type="submit" name="aceptar_solicitud" value="<?= $current['usuario'] ?>">aceptar</button>	
    	 	 	<button type="submit" name="rechazar_solicitud" value="<?= $current['usuario'] ?>">rechazar</button>
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