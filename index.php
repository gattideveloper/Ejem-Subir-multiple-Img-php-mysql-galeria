<?php 
 include_once 'conexion/conexion.php'; 
 include_once 'run_model.php'; 
 $Run_Model = new Run_Model();
 $Run_Model2 = new Run_Model();
 $Run_Destiny = $Run_Model->destiny();

 $Run_Paciente = $Run_Model2->paciente();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Home</title>

    <link rel="stylesheet" href="css/main_style.css" >
</head>
<body>
    <main id="conteiner">
        <div id="box">
            <a href="add.php">Agregar</a>
            <hr>
            <a href="paso-5.php">Agregar Más Imagenes</a>
            <hr>
            <a href="paso-1.php">1 - Carpeta</a>
            <hr>
            <a href="paso-6.php">6 - Editar el Texto</a>
            <hr>
            <a href="paso-7.php">7 - Eliminar Archivo</a>
            <hr>
        </div>
    </main>
</body>
</html>