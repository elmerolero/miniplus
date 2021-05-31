<?php
    $estilo = "<link rel='stylesheet' type='text/css' href='crear.css'>" . 
              "<link rel='stylesheet' type='text/css' href='index.css'>" .
              "<link href='https://cdn.jsdelivr.net/gh/jamesssooi/Croppr.js@2.3.0/dist/croppr.min.css' rel='stylesheet'/>" .
              "<script src='https://cdn.jsdelivr.net/gh/jamesssooi/Croppr.js@2.3.0/dist/croppr.min.js'></script>" . 
              "<script src='crear.js'></script>";
    $titulo = "Nuevo producto";
    include '../recursos/plantillas/header.php';
    
    // Revisa que la sesión esté iniciada y si no, que lo redirija hacia la parte de iniciar sesion
    if( !sesionIniciada() && !esAdministrador() ){
        header( 'Location: ../iniciarSesion?redirect=../admin/crear.php' );
        return;
    }

    require '../Utilidades/Database.php';
    require '../Utilidades/Utilidades.php';
    $conexion = new mysqli( $databaseUrl, $databaseUser, $databasePassword, $databaseDB, $databasePort );

    //Ejecutar el código después de que el usuario envia el formulario
    if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
        if( isset( $_POST['imagen-64'] ) && isset( $_POST[ 'nombre' ] ) && isset( $_POST[ 'precio' ] ) ){
            //Asignar files hacia una variable
            $imagen = $_POST['imagen-64'];
            $nombre = $_POST['nombre'];        
            $precio = $_POST['precio'];

            /**Subida de Archivos */

            //Crear carpeta 
            $carpetaImagenes = '../recursos/imagenes/';
            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            //Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true) );
            $nombreImagen = $carpetaImagenes . $nombreImagen;

            try{
                //Subir la imagen
                archivoImagenBase64( $imagen, $nombreImagen );
            }
            catch( \Exception $e ){
                echo "<p align='center'>No se envió una imagen válida. Intenta de nuevo.</p>";
            }

            //Insertar en la base de datos
            $query = "INSERT INTO productos(nombre, precio, imagen) VALUES ('$nombre', '$precio', '$nombreImagen')";
            $resultado = $conexion -> query( $query );
            if($resultado){
                //Redireccionar al usuario
                header('Location:index.php?resultado=1'); 
            }
        }
    }     
?>

<br>
    <div class="contenido">
        <div class="izquierda" >
            <h2 align="center">¿Qué desea hacer?</h2><br>
            <ul>
                <li><a href="crear.php">Crear Nuevo Producto</a></li>
                <li><a href="index.php">Listado Productos Existentes</a></li>
            </ul>
        </div>
        <div class="derecha">
            <h1 align="center">Agregar Nuevo Producto</h1>
            <div class="contenedor-formulario">
                <form class="formulario" method="POST" action="crear.php"  enctype="multipart/form-data" >
                    <h3>Recuerda agregar todos los datos</h3><br>
                    <label class="label_admin" for="titulo">Nombre:</label>
                    <input class="formulario__campo" type="text" id="nombre" name="nombre"  placeholder="Nombre del Producto">
                    <br>
                    <label class="label__admin" for="imagen">Precio:</label>
                    <input type="number" id="precio" name="precio" class="formulario__campo" placeholder="Precio del Producto" min="1">
                    <br>
                    <label class="label__admin" for="imagen">Imagen:</label>
                    <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">
                    <input type="text" id="contenido-imagen" name="imagen-64"></textarea>
                    <br>
                    <input class="formulario__submit" type="submit" value="Agregar Producto" >
                </form>
                <div class="contenedor-editor">
                    <h3>Recorta la imagen</h3><br>
                    <div id="editor"></div>
                    <canvas id="preview"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <?php  

    //Cerrar la conexión
    $conexion -> close();

    include '../recursos/plantillas/footer.php';?>
