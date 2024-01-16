<style type="text/css">
    body{ 
        text-align: center;
        background-color: #323232;
    }

    .Error{
        letter-spacing: 2px;
        color: red;
    }

    .p{
        font-size: 18px;
        font-weight: bold;
        letter-spacing: 3px;
        color: #fff;
    }

    .a{
        font-size: 20px;
        font-weight: bold;
        text-decoration: none;
        letter-spacing: 3px;
        color: #fff;
    }

    .a:hover{
        font-size: 20px;
        letter-spacing: 4px;
        color: #fff;
    }
</style>
<?php
    ///////////////////////////////////////////////////////////////////////-- 3. Muestro los Mensajes -->
    
    echo "<h1 class= 'Error'>¡ Extensión de archivo Incorrecto !</h1>";
    echo "<p class= 'p'>Extensión permitido son: .jpg  .png  .jpeg  .gif.</p>";
    echo "<a class= 'a' href='index.php'>Volver al Inico.</a>";
?>