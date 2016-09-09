<?php
	include "../conexion.php";
	session_start(); 
	$datos = $_POST["datos"];
	$link=conectarse();
	mysqli_query($link,"insert into Vende (Fecha_venta,Total,Id_usuario) values ('".$_POST['ano']."-".$_POST['mes']."-".$_POST['dia']." ".$_POST['hora'].":".$_POST['minuto'].":00',".$_POST['total'].",'".$_SESSION["Id_usuario"]."')");
	$error1= mysqli_error($link);
	$last_id = mysqli_insert_id($link);
	for($i=0;$i<sizeof($datos);$i++){
		mysqli_query($link,"insert into Detalle_venta(Folio_vende,Id_articulo,Cantidad,Subtotal) values (".$last_id.",".$datos[$i]["id_articulo"].",".$datos[$i]["cantidad"].",".$datos[$i]["subtotal"].")");
		mysqli_query($link,"update Articulo set Stock=Stock-".$datos[$i]["cantidad"]." where Id_articulo=".$datos[$i]["id_articulo"]);
	}
	$error2= mysqli_error($link);
	echo "error1: ".$error1." error2:".$error2;
?>  