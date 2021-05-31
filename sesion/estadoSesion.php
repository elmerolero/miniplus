<?php
	SESSION_START();

	function sesionIniciada(){
		return !empty( $_SESSION[ 'idUsuario' ] );
	}

	function esAdministrador(){
		return isset( $_SESSION[ 'administrador' ] ) && boolval( $_SESSION[ 'administrador' ] );
	}
?>
