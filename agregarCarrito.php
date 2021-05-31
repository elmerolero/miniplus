<?php
	// Necesita conectar a la base de datos
	include 'utilidades/database.php';
	
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

	// Obtiene los valores necesarios para crear los registros
	$usuario = intval( $_GET[ 'idUsuario' ] ); // Este dato debe guardarse en la sesión del servidor como $_SESSION[ 'idUsuario' ]
	$producto = intval( $_GET[ 'idProducto' ] );
	$cantidad = intval( $_GET[ 'cantidad' ] );

	// Si no existe una cuenta creada, entonces...
	if( empty( $_SESSION[ 'CodigoVenta' ] ) ){
		// Crea una nueva venta
		$consultaVenta = "insert into ventas ( idUsuario, fecha, realizada )values( " . strval( $usuario ) . ", curdate(), 0 );";
		if( $conexion -> query( $consultaVenta ) === TRUE ){
			$_SESSION[ 'CodigoVenta' ] = inval( $conexion -> insert_id );
		}

		// Establece el carrito
		$_SESSION[ 'Items' ] = 0;
	}

	// Registra el producto añadido al carrito
	$consultaMovimiento = "insert into movimientos ( idVenta, idProducto, cantidad, realizado ) values ( " . 
							strval( $_SESSION[ 'CodigoVenta' ] ) . ", " . strval( $producto ) . ", "  . 
							strval( $cantidad ) . ", 0 );";
	if( $conexion -> query( $consultaMovimiento ) == TRUE ){
		echo "Producto agregado al carrito correctamente.<br>";
		echo "Numero de elementos en el carrito: " . ++$_SESSION[ 'Items' ];
	}
	else{
		"Hubo un error con el carrito :(";
	}


	// Cierra la conexión
	$conexion -> close();
?>