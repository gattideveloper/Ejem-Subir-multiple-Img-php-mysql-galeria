<?php 
    include_once 'conexion/conexion.php'; 
    include_once 'get_model.php'; 
    
    // Tengo que hacer esta consulta
   //--> CREATE PROCEDURE SP_GET_studies(data1 int)
   //--> SELECT DISTINCT `id_destiny` FROM `studies` WHERE `id_patient` = data1 <--//
    
    $id_paciente = $_GET["p"];
    $Get_Model = new Get_Model(); 
    $getStudies = $Get_Model->GET_studies($id_paciente);
?>
<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <title>Parte 2 - Muestro los nombre de los estudios que se realizo el Paciente</title>
        <link rel="stylesheet" href="css/menuData_style.css">
    </head>
    
    <body>

        <div class="BoxMenu">
            <?php 
                while($studie = mysqli_fetch_assoc($getStudies)){  
                    
                    $id_destiny = $studie['id_destiny'];
             
                   
                   
                    $Get_ModelD = new Get_Model();
                    $get_destiny = $Get_ModelD->Get_destiny($id_destiny);
                    
                    while($destiny = mysqli_fetch_assoc($get_destiny)){ 
                        $name_destiny = $destiny['destiny']; ?>
                        
                        <div class="menu">
                            <h6><?php echo $name_destiny;?></h6>
                            <a href="paso-3.php?p=<?php echo $id_paciente;?>&d=<?php echo $id_destiny;?>">Ver</a>
                        </div>
                    
                    <?php }
                }
            ?>
        </div>

    </body>
</html>      