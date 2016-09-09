<?php
	include "../conexion.php";
	$link=conectarse();
	$articulos = $_POST["articulos"];
	for($i=0;$i<sizeof($articulos);$i++){
		mysqli_query($link,"update Articulo set Activo=0 where Id_articulo=".$articulos[$i]);
	}
	echo mysqli_error($link);
?>