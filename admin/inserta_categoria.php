<?php
	include "../conexion.php";
	function insertar(){
		$link  = conectarse();
		$imagen ="imagenes/".basename($_FILES["archivo"]["name"]);
		move_uploaded_file($_FILES["archivo"]["tmp_name"],"../".$imagen);
		if($link){
			$result=mysqli_query($link,"select * from Categoria where Nombre_categoria='".$_POST["nombre_categoria"]."'");
			if(mysqli_num_rows($result)==0){
				if(mysqli_query($link,"insert into Categoria (Nombre_categoria,Imagen,Descripcion) values ('".$_POST["nombre_categoria"]."','".$imagen."','".$_POST["descripcion"]."')")){
					echo "<script>alert('Se agregó exitosamente la categoria');</script>";
				}else{
					echo mysqli_error($link);
				}
			}else{
				echo "<script>alert('Ya existe una categoria con ese nombre');</script>";
			}
			mysqli_close($link);
		}
	}
?>