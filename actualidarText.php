<?php 
    include_once 'conexion/conexion.php'; 
    include_once 'conexion/conx.php'; 
    include_once 'put_model.php'; 
    include_once 'get_model.php';
    include_once 'update_model.php';
         
//----------------------------------------------------------->     
//----------------------------->  
    
    if(isset($_POST['submit'])){ 
        // Variable para la Nueva Carpeta
        $id = $_POST['userH'];
        $titulo = $_POST['titulo'];
        $mensaje = $_POST['mesaje'];
        $fecha_file = $_POST['dateH'];
        $idDestino = $_POST['destinoH'];      

        $Update_Model = new Update_Model();
        $update = $Update_Model->Update_text($id, $titulo, $mensaje, $fecha_file, $idDestino);
    
        ///////////////////////////////////////////////////////////////////////-- 3. Hago una copia de lo que ingreso --> 
        $dni_patient = '';
        $name_destiny = '';
       
         
        //-->Obtengo el Nombre del Paciente
        $Get_ModelP = new Get_Model();
        $get_paciente = $Get_ModelP->Get_patient($id);
        
        while($data_paciente = mysqli_fetch_assoc($get_paciente)){ 
            $name_patient = $data_paciente['name'];
            $dni_patient = $data_paciente['dni'];
        }

         //-->Obtengo el Nombre del Destino
         $Get_ModelD = new Get_Model();
         $get_destino = $Get_ModelD->Get_destiny($idDestino);
         
         while($data_destino = mysqli_fetch_assoc($get_destino)){ 
             $name_destiny = $data_destino['destiny'];
         }

         // Configuración de carga de archivos
        $targetDir = 'galeria/' . $dni_patient . '~' . $name_patient . '/'. $name_destiny . '/'. $fecha_file . '/'; 
            
        // El nombre del Archivo TXT
        $fileTxt = $dni_patient . '-' . $name_destiny . '-' . $fecha_file;
        // URL para verificar si existe 
        $url = $targetDir . $fileTxt . '.txt';
        
        if (!file_exists($url)) {
            // Creo el archivo
            $fp = fopen($targetDir . $fileTxt . '.txt',"w");
            
            $txt_tiltle = 'Se realizo: ' . $titulo;
            $txt_fecha = 'Fecha: ' . $fecha_file;

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
    
        require_once('Ok_Mensaje.php');   
    
    }       
?>