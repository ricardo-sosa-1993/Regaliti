<?php
	include "../conexion.php";
	$link=conectarse();
	$usuarios = $_POST["usuarios"];
	for($i=0;$i<sizeof($usuarios);$i++){
		mysqli_query($link,"update Usuario set Activo=0 where Id_usuario='".$usuarios[$i]."'");
	}
	echo mysqli_error($link);
?>