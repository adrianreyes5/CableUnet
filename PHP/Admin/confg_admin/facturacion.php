<?php 

	session_start();

	try {
            
        $base= new PDO("mysql:host=localhost; dbname=cableunet", 'root', '');

        $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    } catch (Exception $e) {
        die("Error ....  " . $e->getMessage());   
    }

	if (isset($_POST['compra_serv'])) {
		
		$precio=$_POST['compra_serv'];
		$band = true;

		$sql="SELECT * FROM USUARIOS";
		$result=$base->prepare($sql);
		$result->execute();

		$sql2="SELECT * FROM facturacion";
		$existe=$base->prepare($sql2);
		$existe->execute();

		while ($current = $result->fetch(PDO::FETCH_ASSOC)) {

			while ($valida = $existe->fetch(PDO::FETCH_ASSOC)) {
				
				if ($precio == $valida['fact_servicios'] && $_SESSION['usuario'] == $valida['usuario']) {

					echo '<script language="javascript">alert("Ya tienes suscrito este paquete.");</script>';
					echo "<script>window.location='../../user/planes/plan_serv.php';</script>"; 

					$band=false;
				}

				if ($valida['activo'] == 1 && $_SESSION['usuario'] == $valida['usuario']) {
					
					echo '<script language="javascript">alert("Ya tienes suscrito un paquete de servicios.");</script>';
					echo "<script>window.location='../../user/planes/plan_serv.php';</script>";

					$band=false;
				}
			}
			
			if ($_SESSION['usuario'] == $current['usuario'] && $band) {
				
				$sql1="INSERT INTO facturacion (usuario,fact_servicios,activo) VALUES (?,?,?)";
				$facturado=$base->prepare($sql1);
				$facturado->execute([$current['usuario'],$precio,1]);
			}
		}
	}

	if (isset($_POST['compra_canal'])) {
		
		$precio=$_POST['compra_canal'];
		$band = true;

		$sql="SELECT * FROM USUARIOS";
		$result=$base->prepare($sql);
		$result->execute();

		$sql2="SELECT * FROM facturacion";
		$existe_c=$base->prepare($sql2);
		$existe_c->execute();

		while ($current = $result->fetch(PDO::FETCH_ASSOC)) {	

			while ($valida = $existe_c->fetch(PDO::FETCH_ASSOC)) {
				
				if ($precio == $valida['fact_canal'] && $_SESSION['usuario'] == $valida['usuario']) {

					echo '<script language="javascript">alert("Ya tienes suscrito este paquete.");</script>';
					echo "<script>window.location='../../user/planes/plan_canal.php';</script>"; 

					$band=false;
				}

				if ($valida['activo'] == 2 && $_SESSION['usuario'] == $valida['usuario']) {
					
					echo '<script language="javascript">alert("Ya tienes suscrito un paquete de canales.");</script>';
					echo "<script>window.location='../../user/planes/plan_canal.php';</script>";

					$band=false;
				}
			}
			
			if ($_SESSION['usuario'] == $current['usuario'] && $band) {
				
				$sql1="INSERT INTO facturacion (usuario,fact_canal,activo) VALUES (?,?,?)";
				$facturado=$base->prepare($sql1);
				$facturado->execute([$current['usuario'],$precio,2]);
			}
		}
	}	
 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>Facturación</title>
 </head>
 <body>

 	<h1>Paquete registrado con exito</h1>

 	<p><a href="../../user/index.php">Ir a pagina principal</a></p>
 
 </body>
 </html>