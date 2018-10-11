<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../../../css/registro.css">
</head>
<body>
	
	<h2 class="titulo">Registro</h2>
	
	<div class="container">
		<form id="loginform" method="post" action="../config_user/registro_db.php">
			<input type="text" name="user" class="input" placeholder="Usuario"  required="" /> 
			<input type="password" name="clave" class="input" placeholder="Contraseña" required="" />
			<input type="email" name="correo" class="input" placeholder="Correo" required="" />
			<input type="text" name="telf" class="input" placeholder="Telefóno" required="" />
			<input type="text" name="dir" class="input" placeholder="Dirección" required="" />
			<input type="submit" name="enviar" class="loginbutton" value="Enviar" />
		</form>
	</div>	
		

	<div class="boton">
	<input type="button" class="btn btn-primary btn-lg" onclick="window.location.href='login.php'" value="Atrás">
	</div>		

</body>
</html>