<?php

	function archivoImagenBase64( $informacion, $destino ){
		if( isset( $informacion ) ){
			if ( preg_match('/^data:image\/(\w+);base64,/', $informacion, $type)) {
		    	$informacion = substr($informacion, strpos($informacion, ',') + 1);
		    	$type = strtolower($type[1]); // jpg, png, gif

		   		if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
		        	throw new \Exception('invalid image type');
		    	}
		    
		    	$informacion = str_replace( ' ', '+', $informacion );
		    	$informacion = base64_decode($informacion);

		    	if ($informacion === false) {
		        	throw new \Exception('Falló la decodificación de la imagen.');
		    	}
			} 
			else {
		    	throw new \Exception('La información enviada no corresponde a una imagen válida.');
			}
			echo $destino;
			file_put_contents("{$destino}.{$type}", $informacion);
		}
		else{
			throw new \Exception('No se subió información.');
		}
	}

?>