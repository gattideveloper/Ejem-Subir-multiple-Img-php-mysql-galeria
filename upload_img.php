<?php 
    include_once 'conexion/conexion.php'; 
    include_once 'conexion/conx.php'; 
    include_once 'put_model.php'; 
    include_once 'get_model.php';
    
    // Funciones
    function Create_Folder($folder) {
        // Creo la carpeta
        mkdir($folder, 0777, true);
    }
     
//----------------------------------------------------------->     
//----------------------------->  
    
    if(isset($_POST['submit'])){ 
        // Variable para la Nueva Carpeta
        $paciente_file = $_POST['idPaciente'];
        $destino_file = $_POST['idDestino'];
        $titulo = $_POST['titulo'];
        $fecha = $_POST['fecha'];
        $mensaje = $_POST['mesaje'];

        $name_patient = '';
        $dni_patient = '';
        $name_destiny = '';
        $id = '';
        $insertValuesSQL = '';
        $titleCorrecto = '';
        $textCorrecto = '';
        $titleError = '';
        $textError = '';

        $Put_Model = new Put_Model();
        $Put_gallery = $Put_Model->studios($paciente_file, $titulo, $mensaje, $fecha, $destino_file);
        
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
                           
            // Completo la URL para poder agregar la Carpeta del Pasiente
            $url_FolderPaciente = 'galeria/' . $dni_patient . '~' . $name_patient;
            // Completo la URL para poder agregar la Carpeta de la Ecografía
            $url_FolderDestino = $url_FolderPaciente . '/'. $name_destiny;
            // Completo la URL donde se van a encotrar las Imagenes
            $url_date = $url_FolderDestino . '/' . $fecha;
                        
///////////////////////////////////////////////////////////////////////--> 1. Creo las carpetas                  
            // Compuebo que no exista la carpeta del Paciente
            if (!file_exists($url_FolderPaciente)) {
                Create_Folder($url_FolderPaciente);
                Create_Folder($url_FolderDestino); 
                Create_Folder($url_date); 
            }else{           
                // Compuebo que no exista la carpeta del Destino
                if (!file_exists($url_FolderDestino)) {    
                    Create_Folder($url_FolderDestino);
                    Create_Folder($url_date); 
                }else{ 
                    // Compuebo que no exista la carpeta de la Fecha
                    if (!file_exists($url_date)){
                        Create_Folder($url_date);
                    } 
                }
            }
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
        ///////////////////////////////////////////////////////////////////////-- 3. Hago una copia de lo que ingreso --> 
    
        // El nombre del Archivo TXT
        $fileTxt = $dni_patient . '-' . $name_destiny . '-' . $fecha;
        // URL para verificar si existe 
        $url = $targetDir . $fileTxt . '.txt';
        
        if (!file_exists($url)) {
            // Creo el archivo
            $fp = fopen($targetDir . $fileTxt . '.txt',"w");
            
            $txt_tiltle = 'Se realizo: ' . $titulo;
            $txt_fecha = 'Fecha: ' . $fecha;

            // Le agrego los datos 
            fwrite($fp, $txt_tiltle);
            fwrite($fp, "\r\n");
            fwrite($fp, "\r\n");
            fwrite($fp, $txt_fecha);
            fwrite($fp, "\r\n");
            fwrite($fp, $mensaje);
            // Cierro el archivo 
            fclose($fp);
        }
    
    
    }   
?>