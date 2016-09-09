<head>
	<link rel="stylesheet" href="../styles.css">
</head>
<body>
	<table class='tabla'>
		<tr>
			<th>Folio</th>
			<th>Fecha</th>
			<th>Hora</th>
			<th>Total</th>
		</tr>
	<?php
		include "../conexion.php";
		$link = conectarse();
		$total = 0;
		$result = mysqli_query($link,"select Folio_vende, Total, DATE_FORMAT(Fecha_venta, '%d-%m-%Y') as Fecha, DATE_FORMAT(Fecha_venta,'%H:%i:%s') as Hora from Vende where Id_usuario=".$_GET["Id_usuario"]);
		if(mysqli_num_rows($result)==0){
			echo "<tr><td colspan='4'>No hay ventas de los empleados seleccionados</td></tr>";
		}else{
			while($row=mysqli_fetch_array($result)){
				echo "<tr>
						<td>",$row["Folio_vende"],"</td>
						<td>",$row["Fecha"],"</td>
						<td>",$row["Hora"],"</td>
						<td>",$row["Total"],"</td>
					  </tr>";
				$total += $row["Total"];
			}
			echo "<tr>
					<th></th>
					<th></th>
					<th>Total</th>
					<th>$",$total,"</th>
				  </tr>";
		}
	?>
	</table>