<?php 
    
    session_start();

    if(!isset($_SESSION['admin'])){
         header('location:../../user/config_user/login.php');
    }

    try {
            
        $base= new PDO("mysql:host=localhost; dbname=cableunet", 'root', '');

        $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    } catch (Exception $e) {
        die("Error ....  " . $e->getMessage());   
    }

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Paquete</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../../css/programacion_c.css">
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
          <a class="dropdown-item" href="pack_servicios.php">Servicios</a>
          <a class="dropdown-item" href="pack_canales.php">Canales</a>
        </div>
      </li>
 

    <li class="nav-item">
      <a class="nav-link" href="../confg_admin/cierre.php">Cerrar sesión</a>
    </li>
    </ul>
 
  </div>
</nav>


    <h1 class="titulo">Paquetes de servicios</h1>

    <div class="container">
        <form method="post" action="../confg_admin/pack_serv_db.php" class="formulario">

            <input type="text" name="nombre" placeholder="Nombre del plan" required="">

            <label>Internet:</label>

            <select name='internet_id' class="select_serv" required="">
                <option value="null">Ninguno</option>
                    <?php
                        $sql = "SELECT * FROM servicios WHERE nombre = 'internet'";
                        $query = $base->prepare ($sql);
                        $result = $query->execute ();
                        while ($current = $query->fetch (PDO::FETCH_ASSOC)):

                    ?>  
                <option value="<?= $current['id']?>"><?= $current['plan'] ?></option>
                <?php endwhile ?>
            </select>


        <label>Cable:</label>

            <select name='cable_id' class="select_serv" required="">
                <option value="null">Ninguno</option>
                    <?php
                        $sql = "SELECT * FROM servicios WHERE nombre = 'cable'";
                        $query = $base->prepare ($sql);
                        $result = $query->execute ();
                        while ($current = $query->fetch (PDO::FETCH_ASSOC)):
                    ?>
                <option value="<?= $current['id']?>"><?= $current['plan']?></option>
            <?php endwhile ?>
        </select>


        <label>Telefonia:</label>

            <select name='telefonia_id' class="select_serv" required="">
                <option value="null">Ninguno</option>
                    <?php
                        $sql = "SELECT * FROM servicios WHERE nombre = 'telefonia'";
                        $query = $base->prepare ($sql);
                        $result = $query->execute ();
                        while ($current = $query->fetch (PDO::FETCH_ASSOC)):
                    ?>
                <option value="<?= $current['id']?>"><?= $current['plan']?></option>
            <?php endwhile ?>
        </select>
            
            <input type="text" name="precio" placeholder="Precio" required="">
            <input type="submit" name="enviar" class="enviar" value="Enviar">
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>