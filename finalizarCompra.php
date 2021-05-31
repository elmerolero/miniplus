<?php
	// Necesita conectar a la base de datos
	include 'database.php';
	
	// Si no hay una sesión iniciada
	if( session_status() == PHP_SESSION_NONE ){
		// Inicia la sesion
		session_start();
	}

	// Conecta con la base de datos
	$conexion = new mysqli( $databaseUrl, $databaseUser, $databasePassword, $databaseDB, $databasePort );
	if( $conexion -> connect_error ){
		die( "Error de conexión ( " . $conexion -> connect_errno . " ) " . $conexion -> connect_error );
	}

	// Establece los parámetros para el manejo de unicode
	$conexion -> set_charset( "utf8" );

	// Si existe un venta creada...
	if( !empty( $_SESSION[ 'CodigoVenta' ] ) ){
		// Cierra la cantidad
	}

	// Cierra la conexión
	$conexion -> close();
?>