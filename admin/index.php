<?php
	$estilo = "<link rel='stylesheet' type='text/css' href='index.css'>";
    include '../recursos/plantillas/header.php';

    // Revisa que la sesión esté iniciada y si no, que lo redirija hacia la parte de iniciar sesion
    if( !sesionIniciada() && !esAdministrador() ){
        header( 'Location: ../iniciarSesion?redirect=../admin/' );
        return;
    }
?>

<h1 align="center">Inicio</h1>

<h3 align="center">Bienvenido<br>¿Qué desea hacer?</h3><br>

<ul>
	<li><h3><a href="crear.php">Agregar un nuevo producto</a></h3></li>
	<li><h3><a href="consultar.php">Revisar productos existentes</a></h3></li>
</ul>


<?php include '../recursos/plantillas/footer.php'; ?>