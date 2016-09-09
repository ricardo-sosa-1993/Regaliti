<?php
	function insertar(){
		$link  = conectarse();
		$nombre = $_POST["nombre"];
		$descripcion = $_POST["descripcion"];
		$precio = $_POST["precio"];
		$categoria = $_POST["categoria"];

		$imagen ="imagenes/".basename($_FILES["archivo"]["name"]);
		move_uploaded_file($_FILES["archivo"]["tmp_name"],"../".$imagen);
		if($link){
			$result= mysqli_query($link,"select * from Articulo where Nombre_articulo='".$nombre."'");
			if(mysqli_num_rows($result)==0){
				if(mysqli_query($link,"insert into Articulo (Nombre_articulo,Descripcion,Precio,Categoria,Imagen,Stock) values ('".$nombre."','".$descripcion."',".$precio.",'".$categoria."','".$imagen."',".$_POST["stock"].")")){
				echo "<script>alert('Se agregó exitosamente el artículo');</script>";
				}else{
					echo mysqli_error($link);
				}
			}else{
				echo "<script>alert('Ya existe un articulo con ese nombre');</script>";
			}
			mysqli_close($link);
		}
		echo "<script>location.href= 'agregar_producto.php';</script>";
	}
?>