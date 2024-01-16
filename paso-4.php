<?php 
    include_once 'conexion/conexion.php'; 
    include_once 'get_model.php'; 

    $id_paciente = $_GET["p"];
    $id_destino = $_GET["d"];
    $id_studio = $_GET["s"];
    $Get_Model = new Get_Model();
    $get_studie = $Get_Model->Get_DataStudie($id_paciente,  $id_destino, $id_studio);
?>
<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <title>Parte 4 - Donde el paciente puede ver su Estudio</title>
        <link rel="stylesheet" href="css/galery_style.css">
    </head>
    
    <body>

        <div class="BoxInforme">
            <?php 
                while($studie = mysqli_fetch_assoc($get_studie)){  
                
                    $id = $studie['id'];
                    $title = $studie['title'];
                    $estudio = $studie['medical_report'];
                    $id_destiny = $studie['id_destiny'];
                    $date = $studie['date'];
                    $fecha = date("d/m/Y", strtotime($date));
            
                    $Get_ModelD = new Get_Model();
                    $get_destiny = $Get_ModelD->Get_destiny($id_destiny);
                
                    while($destiny = mysqli_fetch_assoc($get_destiny)){ 
                        $name_destiny = $destiny['destiny'];


                        $Get_ModelG = new Get_Model();
                        $get_gallery = $Get_ModelG->gallery($id);

                        echo "<h3>".$title."</h3>";
                        
                        echo "<span>".$fecha."</span>";
                        echo "<p>".$estudio."</p>";
                        

                        echo "<div class='gallery cf'>";
        
                        $Get_ModelP = new Get_Model();
                        $get_paciente = $Get_ModelP->Get_patient($id_paciente);

                        $url = "";

                        while($gallery = mysqli_fetch_assoc($get_paciente)){ 

                            $name = $gallery['name'];
                            $dni = $gallery['dni'];

                            $url = 'galeria/' . $dni . '~' . $name . '/' . $name_destiny . '/' . $date . '/';
                            while($gallery = mysqli_fetch_assoc($get_gallery)){  
                                $imageURL = $url . $gallery["name_image"]; ?>
                                <div>
                                    <img src="<?php echo $imageURL; ?>" />
                                </div>
                
                            <?php 
                            }
                        }
        
                        echo "</div>";
                    }
                }
            ?>
        </div>
    </body>
</html>