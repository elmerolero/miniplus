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
    header( 'Location: ../iniciarSesion?redirect=../admin/actualizar.php' );
    return;
}

//validar la url por id valido
$idProducto = $_GET['id']; 
$idProducto = filter_var($idProducto, FILTER_VALIDATE_INT); 

if(!$idProducto){
  header('Location:index.php');
}

//Base de Datos
require '../includes/database.php';
$db = conectarDB(); 

//Consulta para obtener los productos
$consulta = "SELECT * FROM producto WHERE idProducto = ${idProducto}"; 
$resultadoConsulta = mysqli_query($db, $consulta) or die(mysqli_error($db));
$producto = mysqli_fetch_assoc($resultadoConsulta);



//Para ver el contenido del producto 
$nombre = $producto['nombre'];
$talla = $producto['talla'];
$precio = $producto['precio'];
$imagen = $producto['imagen'];

//Ejecutar el código después de que el usuario envia el formulario
 if($_SERVER['REQUEST_METHOD']=== 'POST'){

    //Asignar files hacia una variable
    $imagen = $_FILES['imagen'];
    $nombre = $_POST['nombre'];
    $talla = $_POST['talla'];
    $precio = $_POST['precio'];

      //Subida de Archivos 
      //Crear carpeta 
      $carpetaImagenes = '../imagenes/';
              
      if(!is_dir($carpetaImagenes)){
          mkdir($carpetaImagenes);
      }

      $nombreImagen = '';

      if($imagen['name']){
        //Eliminar imagen previa
        unlink($carpetaImagenes . $producto['imagen']);

        //Generar un nombre único
        $nombreImagen = md5( uniqid( rand(),true) ) . ".jpg";

        //Subir la imagen
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen );
      }else {
        $nombreImagen = $producto['imagen'];
      }

      
        

       //Insertar en la base de datos
       $query = "UPDATE producto SET nombre = '${nombre}', talla = '${talla}', precio = '${precio}', imagen = '${nombreImagen}' 
       WHERE idProducto = ${idProducto}";
 
      //echo $query;
      
        $resultado = mysqli_query($db, $query);

        if($resultado){
            //Redireccionar al usuario
            header('Location:index.php?resultado=2'); //error, checar eso
        }
      }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta class="navegacion--enlace" charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FrontEnd Store</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../app.js"></script>
</head>
<body>
  <header class="header">
      <a href="index.html">
          <img class="header__logo" src="../img/logo.png" alt="logotipo">
      </a>
  </header> 

  <div class="derecha">
     <img class="dark-mode-boton" src="../img/dark-mode.png" alt="dark mode">
     </div>
    <nav class="navegacion">
        <a class="navegacion--enlace--activo" href="../index.php">Tienda</a>
        <a class="navegacion--enlace" href="../nosotros.php">Nosotros</a>
    </nav> 
<body>
<main>
    <h1>Actualizar</h1>
        <form class="formulario__admin" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend class="legend__admin"> Actualizar Producto</legend>

                <label class="label__admin" for="titulo">Nombre:</label>
                <input class="formulario__campo" type="text" id="nombre" name="nombre"  placeholder="Nombre del Producto" value="<?php echo $nombre; ?>">

                <label class="label__admin"for="precio">Talla:</label>
                <input class="formulario__campo" type="text" id="talla" name="talla" placeholder="Talla del Producto" value="<?php echo $talla; ?>">

                <label class="label__admin" for="imagen">Precio:</label>
                <input type="number" id="precio" name="precio" class="formulario__campo" placeholder="Precio del Producto" min="1" value="<?php echo $precio; ?>">

                <label class="label__admin" for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <img src="../imagenes/<?php echo $imagen;?>">
            </fieldset> 

            <input class="formulario__submit" type="submit" value="Actualizar Producto">
            <a class="formulario__submit" href="index.php">Volver</a>
        </form>
</main>

</body>

<?php
    include '../includes/templates/footer.php';
?>