<?php
	// Necesario para la base de datos
	include '../utilidades/database.php';

	/* Hace una conexión a la base de datos */
	$conexion = new mysqli( $databaseUrl, $databaseUser, $databasePassword, $databaseDB, $databasePort );
	if( $conexion -> connect_error ){
		die( "Error de conexión ( " . $conexion -> connect_errno . " ) " . $conexion -> connect_error );
	}

	/* Establece el charset */
	if( !$conexion -> set_charset("utf8") ){
		printf("Error cargando el conjunto de caracteres utf8: %s\n", $conexion -> error);
    	exit();
	}

	/* Estado de la autenticación */
	$estado = array();
	$estado[ 'exitoso' ] = true;

	/* Verifica que se introdujo un nombre */
	if( empty( $_POST['nombre'] ) ){
		$estado[ 'exitoso' ] = false;
		$estado[ 'mensaje' ] = 'No se ha introducido un nombre de usurio.';
	}

	/* Verifica que se introdujeran apellidos */
	if( empty( $_POST['apellidos'] ) ){
		$estado[ 'exitoso' ] = false;
		$estado[ 'mensaje' ] = 'No se ha introducido un nombre de usurio.';
	}

	/* Verifica que se introdujo un correo electrónico */
	if( empty( $_POST['correo'] ) ){
		$estado[ 'exitoso' ] = false;
		$estado[ 'mensaje' ] = 'No se ha introducido un nombre de usurio.';
	}

	/* Verifica que se introdujo una fecha de nacimiento */
	if( empty( $_POST[ 'dia' ] ) || empty( $_POST[ 'mes' ] ) || empty( $_POST[ 'anio' ] ) ){
		$estado[ 'exitoso' ] = false;
		$estado[ 'mensaje' ] = 'No se ha seleccionado una fecha de nacimiento.';
	}

	/* Verifica que se introdujo un usuario */
	if( empty( $_POST['usuario'] ) ){
		$estado[ 'exitoso' ] = false;
		$estado[ 'mensaje' ] = 'No se ha introducido un nombre de usurio.';
	}

	/* Verifica que se introdujo una contraseña */
	if( $estado[ 'exitoso' ] && empty( $_POST[ 'contrasena' ] ) ){
		$estado[ 'exitoso' ] = false;
		$estado[ 'mensaje' ] = 'Introduce una contraseña.';
	}

	if( $estado[ 'exitoso' ] ){
		/* Datos de código y contraseña */
		$entradaUsuario = filter_var( $_POST['usuario'], FILTER_SANITIZE_STRING );
		$entradaContrasena = filter_var( $_POST[ 'contrasena' ], FILTER_SANITIZE_STRING );

		/* Comando para consultar a la base de datos */
		$consulta = "select idUsuario as usuario, nombreUsuario, contrasena, nombre, apellidos, fotografia, administrador from usuarios where nombreusuario = '$entradaUsuario'";

		/* Realiza la consulta */
		$resultado = $conexion -> query( $consulta );
		if ( !$resultado ) {
    		trigger_error('Invalid query: ' . $conexion -> error);
		}

		// Comprueba que arroje resultados
		if( $resultado -> num_rows > 0 ){
			// Obtiene el primer resultado (solo debe haber un usuario con el mismo nombre)
			if( $datos = $resultado -> fetch_assoc() ){
				// Obtiene la contraseña de la consulta
				$contrasena = $datos[ 'contrasena' ];

				/* Compara la contraseña de la base de datos con la introducida por el usuario */
				if( password_verify( $entradaContrasena, $contrasena ) ){
					// Inicia sesión
					SESSION_START();

					// Almacena los datos del usuario que inicio sesión
					$_SESSION[ 'idUsuario' ] = intval( $datos[ "usuario" ] );
					$_SESSION[ 'nombreUsuario' ] = filter_var( $datos[ 'nombreUsuario' ], FILTER_SANITIZE_STRING );
					$_SESSION[ 'nombre' ] = filter_var( $datos[ 'nombre' ], FILTER_SANITIZE_STRING );
					$_SESSION[ 'apellidos' ] = filter_var( $datos[ 'apellidos' ], FILTER_SANITIZE_STRING );
					$_SESSION[ 'fotografia' ] = filter_var( $_datos[ 'fotografia' ], FILTER_SANITIZE_URL );
					$_SESSION[ 'administrador' ] = boolval( $datos[ 'administrador' ] );

					// Header location
					$estado[ 'exitoso' ] = true;

					// Cierra la conexion
					$conexion -> close();

					// Redirecciona hacia la página que corresponda
					if( isset( $_GET[ 'redirect' ] ) ){
						$locacion = filter_var( $_GET[ 'redirect' ], FILTER_SANITIZE_URL );
						header( 'Location:' . $locacion );
						return;
					}
					else{
						header('Location: ../');
						return;
					}
				}
				else{
					$estado['exitoso'] = false; // El inicio de sesión no fue exitoso
					$estado['mensaje'] = 'La contraseña introducida no es correcta.';
				}
			}
		}
		//
		else{
			$estado['exitoso'] = false;				// No hubo incio de sesión exitoso
			$estado['mensaje'] = 'El usuario introducido no fue encontrado.';		// Código de error 3 (Usuario no encontrado)
		}
	}

	$conexion -> close();

	$estilo = "<link rel='stylesheet' type='text/css' href='style.css'>";
	include '../recursos/plantillas/header.php'
?>

<?php 
	if( sesionIniciada() ){
		if( !empty( $_GET[ 'redirect' ] ) ){
			$direccion = filter_var( $_GET[ 'redirect' ], FILTER_SANITIZE_URL );
			header( 'Location:' . $direccion );
		}

		header( 'Location:' );
	}
?>

<?php if( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $estado ) && $estado[ 'exitoso' ] == false ): ?>
	<div class="mensaje-error">
		<p><?php echo $estado[ 'mensaje' ]; ?> </p>
	</div>
<?php endif ?>

<?php
	// ¿Redirige hacia algún sitio en específico?
	if( isset( $_GET[ 'redirect' ] ) ){
		$direccion = filter_var( $_GET[ 'redirect' ], FILTER_SANITIZE_URL );
		$direccion = $_SERVER[ 'PHP_SELF' ] . "?redirect=" . $direccion;
	}
	else{
		// Obtiene la direccion actual
		$direccion = $_SERVER[ 'PHP_SELF' ];
	}
?>

<form action='<?php echo $direccion ?>' method="POST">
	<h1 align="center">Iniciar sesión</h1>
	<div class="entrada">
		<label for="usuario">Usuario:</label>
		<input type="text" id="usuario" name="usuario"><br>
		<label for="contrasena">Contraseña:</label>
		<input type="password" id="contrasena" name="contrasena">
		<a class="link" href="#">He olvidado mi contraseña</a>
	</div>
	<input type="submit">
	<a class="link" href="#">Registrarse</a>
</form>

<?php include '../utilidades/database.php'; ?>