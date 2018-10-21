<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="../../../css/login.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body class="body">
	
	<div class="container">
		<div class="row">
			<div class="col">			
				<h1 class="text-center">Cable Unet</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-md-6 offset-0 offset-md-3 border border-white p-4">				
				<form method="post" action="../config_user/login_db.php">
					<div class="form-group">
						<label for="user">Usuario</label>
						<input type="text" class="form-control" name="user" id="user" placeholder="Usuario">
						<small class="form-text text-muted">Imgresa el usuario con el que deseas registrarte</small>
					</div>
					<div class="form-group">
						<label for="password">Contraseña</label>
						<input type="password" class="form-control" id="password" placeholder="Password" name="clave">
					</div>
					
					<button type="submit" class="btn btn-primary">Ingresar</button>
					<a class="btn btn-secondary" href="registro.php">Registrate</a>
				</form>
			</div>
		</div>
	</div>

	
		

</body>
</html>