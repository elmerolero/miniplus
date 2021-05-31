<?php
	// Necesario para la base de datos
	include 'utilidades/database.php';

	/* Hace una conexión a la base de datos */
	$conexion = new mysqli( $databaseUrl, $databaseUser, $databasePassword, $databaseDB, $databasePort );
	if( $conexion -> connect_error ){
		die( "Error de conexión ( " . $conexion -> connect_errno . " ) " . $conexion -> connect_error );
	}

	/* Establece el charset */
	if( !$mysqli -> set_charset("utf8") ){
		printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
    	exit();
	}

	/* Arreglo donde guardará la info */
	$datos = array();

	/* Inicia la sesión */
	SESSION_START();

	if( empty($_POST['codigo']) ){
		/* Comando para consultar a la base de datos */
		$comandoConsulta = "SELECT Nombre, Apellidos, Foto, Administrador FROM empleados WHERE ID_Empleado = '" . $_SESSION['ID_Empleado'] . "'";
	}
	else
	{
		/* Comando para consultar a la base de datos */
		$comandoConsulta = "SELECT * FROM empleados WHERE ID_Empleado = '" . $_POST['codigo'] . "'";
	}

	/* Realiza la consulta */
	$resultado = $mysqli -> query($comandoConsulta);
	if (!$resultado) 
	{
    	trigger_error('Invalid query: ' . $mysqli->error);
	}

	// Comprueba que arroje resultados
	if($resultado ->num_rows > 0)
	{
		if($info = $resultado -> fetch_assoc())
		{
			$datos['exitoso'] = true;
			$datos['ID_Empleado'] = $_SESSION['ID_Empleado'];
			$datos['Nombre'] = $info['Nombre'];
			$datos['Apellidos'] = $info['Apellidos'];
			$datos['Foto']	= $info['Foto'];
			if($info['Administrador'] == '1')
				$datos['Administrador'] = true;
			else
				$datos['Administrador'] = false;

			if(!empty($_POST['codigo']))
			{	
				$datos['Codigo'] = $info['ID_Empleado'];
				$datos['Proceso'] = $info['ID_Proceso'];
			}
		}
	}
	
	echo json_encode($datos);
	

	$mysqli -> close();
?>