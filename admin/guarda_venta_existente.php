<?php
	include "../conexion.php";
	session_start(); 
	$datos = $_POST["datos"];
	$link=conectarse();
	$contador = 0;
	mysqli_query($link,"update Vende set Fecha_venta='".$_POST['ano']."-".$_POST['mes']."-".$_POST['dia']." ".$_POST['hora'].":".$_POST['minuto'].":00',Total=".$_POST['total'].",Id_usuario='".$_POST["vendedor"]."' where Folio_vende=".$_POST["id_venta"]);
	$error1= mysqli_error($link);
	$last_id = $_POST["id_venta"];
	$result = mysqli_query($link,"select * from Detalle_venta where Folio_vende=".$_POST["id_venta"]);
	while($row=mysqli_fetch_array($result)){
		$cantidades[$contador] = $row["Cantidad"];
		$contador++;
	}
	mysqli_query($link,"delete from Detalle_venta where Folio_vende=".$_POST["id_venta"]);
	for($i=0;$i<sizeof($datos);$i++){
		$cantidad_nueva = $cantidades[$i]-$datos[$i]["cantidad_nueva"];
		mysqli_query($link,"insert into Detalle_venta(Folio_vende,Id_articulo,Cantidad,Subtotal) values (".$last_id.",".$datos[$i]["id_articulo"].",".$datos[$i]["cantidad_nueva"].",".$datos[$i]["subtotal"].")");
		mysqli_query($link,"update Articulo set Stock=Stock+".$cantidad_nueva." where Id_articulo=".$datos[$i]["id_articulo"]);
	}
	$error2= mysqli_error($link);
	echo "error1: ".$error1." error2:".$error2;
?>  