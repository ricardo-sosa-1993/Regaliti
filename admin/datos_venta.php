<?php
	include "../conexion.php";
	$link = conectarse();
	$result1 = mysqli_query($link,"select * from Vende where Folio_vende=".$_POST["id_venta"]);
	$row1 = mysqli_fetch_array($result1);
	echo json_encode($row1);
?>