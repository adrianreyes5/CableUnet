<!DOCTYPE html>
<html>
<head>
	<title>Cierre seccion</title>
</head>
<body>

	<?php 

		session_start();

		session_destroy();

		header("location:../../user/log/login.php");


	 ?>
</body>
</html>