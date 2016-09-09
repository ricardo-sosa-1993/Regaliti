<?php
		include "../conexion.php";
		$link  = conectarse();
		$nombre = $_POST["nombre"];
		$descripcion = $_POST["descripcion"];
		$precio = $_POST["precio"];
		$categoria = $_POST["categoria"];

		$result=mysqli_query($link,"select * from Articulo where Nombre_articulo='".$nombre."' and Id_articulo != ".$_POST["Id_articulo"]);
		if(mysqli_num_rows($result) != 0){
			$row=mysqli_fetch_array($result);
			echo "<script>alert('Ya existe un articulo con ese nombre');</script>";
			echo "<script>location.href='editar_producto.php?Id_articulo=",$_POST["Id_articulo"],"';</script>";
		}else{
			if(file_exists($_FILES['archivo']['tmp_name']) || is_uploaded_file($_FILES['archivo']['tmp_name'])) {
	    			$imagen ="imagenes/".basename($_FILES["archivo"]["name"]);
					move_uploaded_file($_FILES["archivo"]["tmp_name"],"../".$imagen);
						mysqli_query($link,"update Articulo set 
										Nombre_articulo='".$nombre."',
										Descripcion='".$descripcion."',
										Precio=".$precio.",
										Imagen='".$imagen."',
										Stock=".$_POST["stock"].",
										Categoria='".$categoria."' 
										where Id_articulo=".$_POST["Id_articulo"]);
						echo mysqli_error($link);
						echo "<script>alert('Se modificó exitosamente el artículo');</script>";
						echo "<script>location.href='productos.php';</script>";
				}else{
					mysqli_query($link,"update Articulo set 
										Nombre_articulo='".$nombre."',
										Descripcion='".$descripcion."',
										Precio=".$precio.",
										Categoria='".$categoria."',
										Stock=".$_POST["stock"]." 
										where Id_articulo=".$_POST["Id_articulo"]);
						echo mysqli_error($link);
						echo "<script>alert('Se modificó exitosamente el artículo');</script>";
						echo "<script>location.href='productos.php';</script>";
				}
			}
			mysqli_close($link);
		
?>