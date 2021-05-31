<?php 
    //echo "<pre>";
    //var_dump($_POST);
    //echo "</pre>";
    $estilo = "<link rel='stylesheet' type='text/css' href='index.css'>";
    include '../recursos/plantillas/header.php';

    // Revisa que la sesión esté iniciada y si no, que lo redirija hacia la parte de iniciar sesion
    if( !sesionIniciada() && !esAdministrador() ){
        header( 'Location: ../iniciarSesion?redirect=../admin/consultar.php' );
        return;
    }

    // Revisa que la sesión esté iniciada y si no, que lo redirija hacia la parte de iniciar sesion
    if( !sesionIniciada() && !esAdministrador() ){
        header( 'Location: ../iniciarSesion' );
        return;
    }

    //Importar la conexión
    require '../Utilidades/Database.php';
    $conexion = new mysqli( $databaseUrl, $databaseUser, $databasePassword, $databaseDB, $databasePort );

    // Obtiene los resultados de la base de datos
    $consultaProductos = "SELECT * FROM productos";
    $resultado = $conexion -> query( $consultaProductos );

    //Muestra mensaje condicional
    $entrada = $_GET['resultado'] ?? null; //busca el valor, si no existe le asigna un null

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $idProducto = $_POST['idProducto'];
        $idProducto = filter_var($idProducto, FILTER_VALIDATE_INT);

        if($idProducto){

            //Elimina el archivo
            $query = "SELECT imagen FROM producto WHERE idProducto = ${idProducto}";
            $resultados = $conexion -> query( $query );
            $producto = $resultados -> fetch_assoc();

            unlink('../imagenes/'. $producto['imagen']);
            //echo $query;
            //exit;

            //Elimina el producto
            $query = "DELETE FROM producto WHERE idProducto = ${idProducto}";
            $resultados =  $conexion -> query( $query );
            if($resultados){
                header('Location:index.php?resultado=3');
              }
        }
     
    }
?>
    <br>
    <div class="contenido">
        <div class="izquierda" >
            <h2 align="center">¿Qué desea hacer?</h2><br>
            <ul>
                <li><a href="index.php">Ir al inicio</a></li>
                <li><a href="crear.php">Crear Nuevo Producto</a></li>
                <li><a href="index.php">Listado Productos Existentes</a></li>
            </ul>
        </div>
        <div class="derecha">
            <h1 align="center">Listado de Productos</h1>

            <?php
            if($entrada == 1): ?>
                <p class="alerta exito">Producto creado correctamente</p>
            <?php elseif($entrada == 2): ?>
                <p class="alerta exito">Producto actualizado correctamente</p>
            <?php elseif($entrada == 3): ?>
                <p class="alerta exito">Producto eliminado correctamente</p>
            <?php endif; ?>
            
            <div class="cuadro-opciones">
                <a class="boton agregar" href="crear.php" >Agregar</a>
                <a class="boton editar" href="editar.php" >Editar</a>
                <a class="boton eliminar" href="eliminar.php" >Eliminar</a>
            </div><br>
            <table cellspacing='0' class="productos">
                <tr class="encabezado-producto">
                    <th class="encabezado-producto"></th>
                    <th class="encabezado-producto">Código</th>
                    <th class="encabezado-producto">Nombre</th>
                    <th class="encabezado-producto">Precio</th>
                    <th class="encabezado-producto">Imagen</th>
                </tr>
                <?php  while( $producto = $resultado -> fetch_assoc() ): ?>
                    <tr class="renglon-producto">
                        <td><input type="checkbox" name='' /></td>
                        <td class="id-producto"><?php echo $producto['idProducto']; ?></td> 
                        <td class="nombre-producto"><?php echo $producto['nombre']; ?></td>
                        <td class="precio-producto">$ <?php echo $producto['precio']; ?></td>
                        <td><?php echo ( isset( $producto[ 'imagen' ] ) ? "<img class='imagen-producto' src='" . $producto[ 'imagen' ] . "'>" : "<div class='imagen-alterna'>Imagen no disponible.</div>" ); ?> </td>
                    </tr>
                <?php  endwhile; ?>
            </table>
        </div>
    </div>
    
    <?php  

    //Cerrar la conexión
    $conexion -> close();

    include '../recursos/plantillas/footer.php';?>