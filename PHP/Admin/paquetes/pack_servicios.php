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

    <div id="header">

        <h2 class="cabezera_progra">Cable Unet Administrador</h2>

        <ul class="nav">

            <li><a href="../index_admin.php">Programación</a></li>

            <li><a href="../servicios/programas.php">Registro de programas</a></li>

            <li><a href="../carga_programacion/programacion.php">Carga de Programación</a></li>

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
                    <li><a href="pack_canales.php">Canales</a></li>
                </ul>

            </li>

            <li><a href="../confg_admin/cierre.php">Cerrar sesión</a></li>
        </ul>       
    </div>


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

</body>
</html>