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
    
    <title>Agregar</title>

    <link rel="stylesheet" href="css/main_style.css" >
</head>
<body>
    <main id="conteiner">
        <div id="box">
            <form action="upload_img.php" method="post" enctype="multipart/form-data">
                
                <!-- Paciente -->
                <label for="paciente">Paciente</label>
                <select class= "selector" name="idPaciente">
                    <option value="0">Seleccione:</option>
                    <?php  
                        while($get_paciente = mysqli_fetch_assoc($Run_Paciente)){ ?>
                            <option  value="<?php echo $get_paciente['id']; ?>"> <?php echo $get_paciente['dni'] . ' - ' . $get_paciente['name'];?></option>
                    <?php } ?>
                </select>     
                <hr>
                <!-- Destino -->
                <label for="destino">Destino</label>
                <select class= "selector" name="idDestino">
                    <option value="0">Seleccione:</option>
                    <?php  
                    while($get_destiny = mysqli_fetch_assoc($Run_Destiny)){ ?>
                        <option  value="<?php echo $get_destiny['id']; ?>"> <?php echo $get_destiny['destiny'];?></option>
                    <?php } ?>         
                </select>  
                
                <hr> 
                
                <label for='titulo'>Titulo *</label>
                <input class='titulo' type='text' name='titulo' required='required'><br/>

                <hr> 

                <label for='fecha'>Fecha *</label>
                <input class='fecha' type='date' name='fecha' required='required'><br/>

                <hr> 

                <!-- Mensaje -->
                <div class='textarea-msj'>                    
                    <textarea class='mesaje' name='mesaje' required='required' placeholder='¡ATENCION! Si tiene cuenta corriente, mencione el CUIT y el numero de cliente'></textarea><br/>
                </div>

                <hr> 

                Seleccione 20 archivos de imagen para subir:
                <input type="file" name="files[]" multiple >
                </br>
                </br>
                <input type="submit" name="submit" value="UPLOAD">
            </form>

            <hr>
        </div>
    </main>
</body>
</html>