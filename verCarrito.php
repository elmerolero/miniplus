<?php
	// Necesita conectar a la base de datos
	include 'utilidades/database.php';
	
	// Si no hay una sesión iniciada
	if( session_status() == PHP_SESSION_NONE ){
		// Inicia la sesion
		session_start();
	}

	$_SESSION['CodigoVenta'] = $_GET['CodigoVenta'];

	// Conecta con la base de datos
	$conexion = new mysqli( $databaseUrl, $databaseUser, $databasePassword, $databaseDB, $databasePort );
	if( $conexion -> connect_error ){
		die( "Error de conexión ( " . $conexion -> connect_errno . " ) " . $conexion -> connect_error );
	}

	// Establece los parámetros para el manejo de unicode
	$conexion -> set_charset( "utf8" );

	// Si existe un venta creada...
	if( !empty( $_SESSION[ 'CodigoVenta' ] ) ){
		// Obtiene los elementos del carrito actual
		$consultaItems = "SELECT productos.nombre as 'Nombre', productos.precio as 'Precio', movimientos.cantidad as 'Cantidad', ( movimientos.cantidad * productos.precio ) as 'Importe' from movimientos join productos on movimientos.idProducto = productos.idProducto where movimientos.idVenta = " . strval( $_SESSION[ "CodigoVenta" ] );
		$resultados = $conexion -> query( $consultaItems );
		if( $resultados -> num_rows > 0 ){
			echo "<table>";
			echo "<tr> <th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Importe</th></tr>"; 
			while( $row = $resultados -> fetch_assoc() ){
    			echo "<tr> <td>" . $row[ "Nombre" ] . "</td><td>" . 
    					           $row[ "Precio" ] . "</td><td>" .
    					           $row[ "Cantidad" ] . "</td><td>" .
    					           $row[ "Importe" ] . "</td></tr>";  
  			}
  			echo "</table>";
		}
	}
	else{
		echo "No se han añadido elementos al carrito todavía.";
	}

	// Cierra la conexión
	$conexion -> close();
?>