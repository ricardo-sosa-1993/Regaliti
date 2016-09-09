<?php
	include "../conexion.php";
	$link=conectarse();
	$categorias = $_POST["categorias"];
	for($i=0;$i<sizeof($categorias);$i++){
		$result=mysqli_query($link,"select * from Articulo where Categoria='".$categorias[$i]."'");
		while($row=mysqli_fetch_array($result)){
			mysqli_query($link,"update Articulo set Activo=0 where Id_articulo=".$row["Id_articulo"]);
		}
		mysqli_query($link,"update Categoria set Activo=0 where Nombre_categoria='".$categorias[$i]."'");
	}
	echo mysqli_error($link);
?>