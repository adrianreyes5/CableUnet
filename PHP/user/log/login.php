<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="../../../css/login.css">
</head>
<body>
	
	<h1 class="titulo">Cable Unet</h1>

	<div class="container">
		<form id="loginform" method="post" action="../config_user/login_db.php">
			<input type="text" name="user" class="input" placeholder="Usuario"  required="" /> 
			<input type="password" name="clave" class="input" placeholder="Contraseña" required="" />
			<input type="submit" name="enviar" class="loginbutton" value="Enviar" />
		</form>
	</div>
		
	<a href="registro.php">Registrate</a>

</body>
</html>