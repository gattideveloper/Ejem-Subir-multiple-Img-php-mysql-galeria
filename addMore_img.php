<?php 
    include_once 'conexion/conexion.php'; 
    include_once 'conexion/conx.php'; 
    include_once 'put_model.php'; 
    include_once 'get_model.php';

//----------------------------------------------------------->     
//----------------------------->  
    
    if(isset($_POST['submit'])){ 
        // Variable para la Nueva Carpeta
        $paciente_file = $_POST['idPaciente'];
        $destino_file = $_POST['idDestino'];
        $fecha = $_POST['fecha'];

        $name_patient = '';
        $dni_patient = '';
        $name_destiny = '';
        $id = '';
        $insertValuesSQL = '';
        $titleCorrecto = '';
        $textCorrecto = '';
        $titleError = '';
        $textError = '';
       
        //-->Obtengo el Nombre del Paciente
        $Get_ModelP = new Get_Model();
        $get_paciente = $Get_ModelP->Get_patient($paciente_file);
        
        while($data_paciente = mysqli_fetch_assoc($get_paciente)){ 
            $name_patient = $data_paciente['name'];
            $dni_patient = $data_paciente['dni'];
        }

        //-->Obtengo el Nombre del Destino
        $Get_ModelD = new Get_Model();
        $get_destino = $Get_ModelD->Get_destiny($destino_file);
        
        while($data_destino = mysqli_fetch_assoc($get_destino)){ 
            $name_destiny = $data_destino['destiny'];
        }

        //--> Obtengo el Id
        $Get_ModelS = new Get_Model();
        $get_studios = $Get_ModelS->Get_studios($paciente_file, $fecha, $destino_file);
        
        while($data_studios = mysqli_fetch_assoc($get_studios)){ 
        
            $id = $data_studios['id'];
                    
        }
///////////////////////////////////////////////////////////////////////--> 2. Agrego la Imagen 
       
        // Configuración de carga de archivos
        $targetDir = 'galeria/' . $dni_patient . '~' . $name_patient . '/'. $name_destiny . '/'. $fecha . '/'; 
               
        $allowTypes = array('jpg','png','jpeg','gif'); 
        $fileNames = array_filter($_FILES['files']['name']); 
       
        if(!empty($fileNames)){ 
            foreach($_FILES['files']['name'] as $key=>$val){ 
            
                // Ruta de carga de archivos 
                $fileName = basename($_FILES['files']['name'][$key]); 
                $targetFilePath = $targetDir . $fileName; 
             
                // Compruebe si el tipo de archivo es válido
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                
                if(in_array($fileType, $allowTypes)){ 
                    // Subir archivo al servidor 
                    if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                        // Imagen db insertar sql
                        $insertValuesSQL .= "('".$id."','".$fileName."'),"; 
                    } 
                }else{ 
                    require_once('Error_Img.php');
                } 
            } 
         
            if(!empty($insertValuesSQL)){ 
                $insertValuesSQL = trim($insertValuesSQL, ','); 
                // Insertar el nombre del archivo de imagen en la base de datos 
                $insert = $db->query("INSERT INTO gallery (id_studies, name_image) VALUES $insertValuesSQL"); 
                
                if(!empty($insert)){ 
                    require_once('Ok_Mensaje.php');   
                }else{ 
                    require_once('Error_Gallery.php');       
                } 
            } 
        }
    }   


///////////////////////////////////////////////////////////////////////-- 3. Muestro los Mensajes --> 
    if($titleCorrecto != ''){
        echo "<h1 class= 'h1'>".$titleCorrecto."</h1>";
        echo "<p class= 'p'>".$textCorrecto."</p>";
        echo "<a class= 'a' href='index.php'>Volver al Inico.</a>";
    }else{
        echo "<h1 class= 'Error'>".$titleError."</h1>";
        echo "<p class= 'p'>".$textError."</p>";
        echo "<a class= 'a' href='index.php'>Volver al Inico.</a>";
    }
?>