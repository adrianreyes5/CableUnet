<?php 
		
	$user=htmlentities(addslashes($_POST['user']));
	$password=htmlentities(addslashes($_POST['clave']));
		
	try {
			
			$base=new PDO('mysql:host=localhost; dbname=cableunet', 'root', '');

			$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

			$sql="SELECT * FROM usuarios WHERE usuario = '$user'";
			$resultado=$base->prepare($sql);
			$resultado->execute();

			while ($verifica_admin = $resultado->fetch(PDO::FETCH_ASSOC)) {
				
				if ($user == $verifica_admin['usuario'] && $password == $verifica_admin['pass_admin']) {
					
					session_start();
					$_SESSION['admin'] = $user;

					header("location:../../Admin/index_admin.php");
				} 
				else {
					echo '<script language="javascript">alert("Usuario no existe o contraseña incorrecta");</script>';
					echo "<script>window.location='../log/login.php';</script>"; 
				}
			}

			$sql1="SELECT * FROM usuarios WHERE usuario = '$user'";
			$result=$base->prepare($sql1);
			$result->execute();

			while ($verifica_user = $result->fetch(PDO::FETCH_ASSOC)) {
				
				if ($user == $verifica_user['usuario'] && $password == $verifica_user['password']) {
					
					session_start();
					$_SESSION['usuario'] = $user;

					header("location:../index.php");
				}
				else {
					echo '<script language="javascript">alert("Usuario no existe o contraseña incorrecta");</script>';
					echo "<script>window.location='../log/login.php';</script>"; 
				}

			}

			$registered = $resultado->rowCount();
			
			if ($registered == 0) {
				echo '<script language="javascript">alert("Usuario no existe");</script>';
				echo "<script>window.location='login.php';</script>";
			}

		} catch (Exception $e) {
			die("Error: " . $e->getMessage());
		}


 ?>