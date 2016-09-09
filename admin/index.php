<html>
	<?php
					session_start(); 
					if($_SESSION){
						echo "<script>location.href='registrar_venta.php';</script>";
					}
				?>
	<head>
		<meta charset="UTF-8">
		<title>Regaliti</title>
		<link rel="stylesheet" href="../styles.css">
	</head>
	<body>
			<form class="formulario" method="post" action="control.php">
				<h1>Iniciar sesión</h1>
				<table>
					<tr>
						<td>Usuario</td>
					</tr>
					<tr>
						<td><input type="text" name="usuario"required></td>
					</tr>
					<tr>
						<td>Contraseña</td>
					</tr>
					<tr>
						<td><input type="password" name="contrasena"required></td>
					</tr>
					<tr>
						<td><input type="submit" value="Ingresar"/></td>
					</tr>
				</table>
			</form>
	</body>
</html>