<?php
		include "../conexion.php";
		$link  = conectarse();
		$nombre = $_POST["nombre_categoria"];
		$descripcion = $_POST["descripcion"];

		if(!mysqli_query($link,"update Categoria set Nombre_categoria='".$nombre."' where Nombre_categoria='".$_POST["Nombre_categoria_viejo"]."'")){
			echo "<script>alert('Ya existe una categoria con ese nombre');</script>";
			echo "<script>location.href='editar_categoria.php?Nombre_categoria=",$_POST["Nombre_categoria_viejo"],"';</script>";
		}else{
			if(file_exists($_FILES['archivo']['tmp_name']) || is_uploaded_file($_FILES['archivo']['tmp_name'])) {
	    			$imagen ="imagenes/".basename($_FILES["archivo"]["name"]);
					move_uploaded_file($_FILES["archivo"]["tmp_name"],"../".$imagen);
						mysqli_query($link,"update Categoria set 
										Descripcion='".$descripcion."',
										Imagen='".$imagen."'
										where Nombre_categoria='".$_POST["Nombre_categoria_viejo"]."'");
						echo mysqli_error($link);
						echo "<script>alert('Se modificó exitosamente la categoria');</script>";
						echo "<script>location.href='categorias.php';</script>";
				}else{
					mysqli_query($link,"update Categoria set 
										Descripcion='".$descripcion."'
										where Nombre_categoria='".$_POST["Nombre_categoria_viejo"]."'");
						echo mysqli_error($link);
						echo "<script>alert('Se modificó exitosamente la categoria');</script>";
						echo "<script>location.href='categorias.php';</script>";
				}
			}
			mysqli_close($link);
		
?>