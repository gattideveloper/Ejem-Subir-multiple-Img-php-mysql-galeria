<?php 
    include_once 'conexion/conexion.php'; 
    include_once 'conexion/conx.php'; 
    include_once 'put_model.php'; 
    include_once 'get_model.php';
        
//----------------------------------------------------------->     
//----------------------------->  
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Para Agreagr más Imagenes al paciente</title>

        <link rel="stylesheet" href="css/main_style.css" >
    </head>
    <body>
        <main id="conteiner">
            <div id="box">
        
                <?php if(isset($_POST['submit'])){ 
            
                    // Variable para la Nueva Carpeta
                    $paciente_file = $_POST['idPaciente'];
                    $destino_file = $_POST['idDestino'];
                    $fecha = $_POST['fecha'];

                    $text = '';
            
                    //-->Obtengo el Nombre del Paciente
                    $Get_ModelP = new Get_Model();
                    $get_paciente = $Get_ModelP->Get_patient($paciente_file);
            
                    while($data_paciente = mysqli_fetch_assoc($get_paciente)){ 
                        $name_patient = $data_paciente['name'];

                        //-->Obtengo el Nombre del Paciente
                        $Get_ModelP = new Get_Model();
                        $get_EditStudie = $Get_ModelP->Get_EditStudie($paciente_file, $destino_file, $fecha);
                    
                        while($data_studie = mysqli_fetch_assoc($get_EditStudie)){ 
                            //Elimino los espacios de cada lado
                            $title = trim($data_studie['title']);
                            $medicalRepot = trim($data_studie['medical_report']); 
                            $fecha = $data_studie['date']; 
                            ?>
                    
                            <form action="actualidarText.php" method="post" enctype="multipart/form-data">
                        
                                <label for='user'>Nombre</label>
                                <input type="text" hidden = "" class="user" id="userH" name="userH" value=<?php echo $paciente_file;?>>              
                                <input type="text" class="user" disabled id="userD" name="userD" value=<?php echo $name_patient;?>></br>

                                <label for='titulo'>Titulo</label>
                                <input class='titulo' type='text' name='titulo' value=<?php echo $title;?>><br/>

                                <input type="text" hidden = "" class="date" id="dateH" name="dateH" value=<?php echo $fecha;?>>
                                <input type="int" hidden = "" class="user" id="destinoH" name="destinoH" value=<?php echo $destino_file;?>>
                                </br>
                                <!-- Mensaje -->
                                <div class='textarea-msj'>                    
                                    <textarea class='mesaje' name='mesaje' required='required'><?php echo $medicalRepot; ?></textarea>
                                </div>

                                <input type="submit" name="submit" value="Aceptar">
                            </form>     
                        <?php }
                    }
                } ?>
            </div>
        </main>
    </body>
</html>