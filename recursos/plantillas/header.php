<?php include '../sesion/estadoSesion.php'; ?>
<!DOCTYPE html>
<html lang='es-mx'>
	<head>
		<meta charset="utf-8">
		<meta class="navegacion--enlace" charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="/miniplus/recursos/estilos/style.css">
		<link rel="stylesheet" type="text/css" href="/miniplus/recursos/estilos/normalize.css">
		<?php echo ( isset( $estilo ) ? $estilo : "" ) ?>
		<title><?php echo ( isset( $titulo ) ? $titulo : "Tienda" ) ?></title>
	</head>
	<body>
		<header>
			<a href="" class="logo">
				<img class="header_logo" src="/miniplus/recursos/imagenes/logo.png" alt="logotipo">
				<h2>Hola</h2>
			</a>
			<nav>
				<a class="enlace-navbar activo" href="../inicio/">Tienda</a>
				<a class="enlace-navbar" href="../nosotros/">Nosotros</a>
				<?php if( esAdministrador() ): ?>
					<a class="enlace-navbar" href="../admin/">Administrador</a>
				<?php endif; ?>
			</nav>
		</header>
		<?php if( sesionIniciada() ): ?>
			<div class="sesion">
				<div class="perfil">
					<div class="informacion-perfil">
						<a href=""><?php echo $_SESSION[ "nombre" ]; ?></a>
						<a href=""><?php echo $_SESSION[ "apellidos" ]; ?></a>
						<a href="../cerrarSesion">Cerrar sesión</a>
					</div>
					<?php if( !empty( $_SESSION[ 'fotografia' ] ) ): ?>
						<img class="foto-perfil" src="<?php echo $_SESSION[ 'fotografia' ] ?>">
					<?php else: ?>
						<img class="foto-perfil" src="<?php echo '../recursos/imagenes/perfiles/default.png' ?>">
					<?php endif ?>
				</div>
			</div>
		<?php else: ?>
			<div class="sesion">
				<a class="sesion-enlace" href="../registro/">Registrarse</a>
				<a class="sesion-enlace" href='../iniciarSesion/'>Iniciar Sesión</a>
			</div>
		<?php endif ?>