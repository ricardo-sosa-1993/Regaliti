<?php session_start();?>
<html>
	<head>
		<title>Registrar venta</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="../styles.css">
		<script   src="https://code.jquery.com/jquery-1.12.3.js"   integrity="sha256-1XMpEtA4eKXNNpXcJ1pmMPs8JV+nwLdEqwiJeCQEkyc="   crossorigin="anonymous"></script>
		<script   src="https://code.jquery.com/ui/1.12.0-rc.2/jquery-ui.js"   integrity="sha256-6HSLgn6Ao3PKc5ci8rwZfb//5QUu3ge2/Sw9KfLuvr8="   crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
<script>
	var total=0; 
	var stock;
	$(document).ready(function() {
    	var tabla = $('#tabla').DataTable( {
    		"columns": [
			    { "data": "id_articulo" },
			    { "data": "nombre" },
			    { "data": "cantidad" },
			    { "data": "precio" },
			    { "data": "subtotal" },
			    { "data": "boton" }
			  	]
				} );
    	$('#boton').click(function() {
    		var producto = $('#producto').val();
    		var cantidad = parseFloat($('#cantidad').val());
    		var i;
    		var existe=0;
    		var num;
    		var cantidad_nueva
    		var subtotal_nuevo

    		for(i=0;i<tabla.rows().count();i++){
	    			var datos = tabla.cell(i,0).data()
	    			if(producto==datos){
	    				existe=1;
	    				cantidad_nueva = parseFloat(tabla.cell(i,2).data()) + cantidad;
	    				subtotal_nuevo = parseFloat(tabla.cell(i,3).data()) * cantidad_nueva;
	    				num = i;
	    				break;
	    			}
	    		}
	    				
	    				
	    			
	    			
    		
    		if(existe==0){
    			 $.ajax({    //create an ajax request to load_page.php
			        type: "post",
			        url: "producto_compra.php",  
			        data: {Id_articulo: producto, cantidad: cantidad},        
			        dataType: "json",               
			        success: function(data){
							if(cantidad > data.stock){
			        			alert("No hay existencias suficientes");
			        		}else{
			        			tabla.row.add(data).draw();	 
			    				total+=parseFloat(data.subtotal);  
			    				$(tabla.column(4).footer()).html('$'+ total);
			        		}		              
			        }

	    		});
    		}else{
    			$.ajax({    //create an ajax request to load_page.php
					        type: "post",
					        url: "producto_compra.php",  
					        data: {Id_articulo: producto, cantidad: cantidad},        
					        dataType: "json",               
					        success: function(data){
								if(cantidad_nueva > data.stock){
									alert("No hay existencias suficientes");
								}else{
									tabla.cell(num,2).data(cantidad_nueva).draw();
	    							tabla.cell(num,4).data(subtotal_nuevo).draw();
	    							total+=cantidad * parseFloat(tabla.cell(num,3).data());
	    							$(tabla.column(4).footer()).html('$'+ total);
								} 
					        }
						});
    		}
    		
		});


		$(document).on("click", ".eliminar", function() {
		   // your function code here
		   var index = tabla.row($(this).parents('tr')).index();
		   total-= parseFloat(tabla.cell(index,4).data());
		   $(tabla.column(4).footer()).html('$'+ total);
		   tabla.row( $(this).parents('tr') ).remove().draw();
		});

		$('#boton_finalizar').click(function() {
			var datos_tabla = [];
			var total_final = total;
			var fecha = new Date();
			var dia = fecha.getDate();
			var mes = fecha.getMonth()+1;
			var ano = fecha.getFullYear();
			var hora = fecha.getHours();
			var minuto = fecha.getMinutes();
			if(dia<10){
				dia = "0"+ dia.toString(); 
			}
			if(mes<10){
				mes = "0"+ mes.toString(); 
			}
			if(hora<10){
				hora = "0"+ hora.toString(); 
			}
			if(minuto<10){
				minuto = "0"+minuto.toString(); 
			}
			var i;
			for(i=0;i<tabla.rows().count();i++){
	    			datos_tabla.push(tabla.row(i).data());
    		}

    		if(datos_tabla.length==0){
    			alert("No hay prductos en la venta");
    		}else{
    			$.ajax({    //create an ajax request to load_page.php
			        type: "post",
			        url: "guarda_venta.php",  
			        	data: {datos: datos_tabla, total: total_final, dia: dia, mes: mes, ano: ano, hora: hora, minuto: minuto},  

			        success: function(data){		
		    				location.href= 'registrar_venta.php';                             
			        }

	    		});
    		}
			
		});

	} );

</script>
	</head>
	<body>
	<nav class="navbar navbar-default barra_breadcrumb">
			  <div class="container-fluid">
			    <div class="navbar-header">
			      <a class="pull-left" href="#"><img src="../logo_regaliti.png" width="190px" height="100px"></a>
			    </div>
			    <ul class="nav navbar-nav">
			      <li class="active"><a href ="registrar_venta.php">Registrar venta</a></li>
			      <li><a href ="ventas.php">Ventas</a></li> 
			      <li><a  href ="productos.php">Productos</a></li>
			      <li><a href ="agregar_producto.php">Agregar producto</a></li>
			      <li><a href="categorias.php">Categorias</a></li>
			      <li><a href="agregar_categoria.php">Agregar categoria</a></li>
			      <li><a href="agregar_administrador.php">Usuarios</a></li>
			      <li><a href='reportes.php'>Reportes</a></li>
			    </ul>
			    <?php  
					if(!$_SESSION){
						echo "<script>location.href='index.php';</script>";
					}else{
						echo "<ul class='nav navbar-nav navbar-right'>
									<li><a>Administrador: ",$_SESSION["Nombre_usuario"],"</a></li>
									<li><a href='salir.php'>Cerrar sesión</a><li>
							</<ul>";
					}
				?>
			  </div>
	</nav>
	<ul class="breadcrumb">
	    <li class="active">Registrar venta</li>
	</ul>
		<div class="container">
		
		<div class="formulario">
			<table>
				<tr>
					<td>Producto:<td>
				</tr> 
				<tr>
					<td>
						<select id="producto">
						<?php
							include "../conexion.php";
							$link = conectarse();
							$result1=mysqli_query($link,"select * from Categoria where Activo=1");
							while($row1=mysqli_fetch_array($result1)){
								echo "<optgroup label='",$row1["Nombre_categoria"],"'>";
								$result2=mysqli_query($link,"select * from Articulo where Activo=1  and Categoria='".$row1["Nombre_categoria"]."'");
								while($row2=mysqli_fetch_array($result2)){
									echo "<option value='",$row2["Id_articulo"],"'>",$row2["Nombre_articulo"],"</option>";
								}
							}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Cantidad:</td>
				</tr>
				<tr>
					<td><input type="number" min="1" value="1" id="cantidad"></td>
				</tr>
				<tr>
					<td><input type="button" id="boton" value="Añadir"></td>
				</tr>
			</table>
		</div>
		<table id="tabla" class="tabla display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id del producto</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th>Total</th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
    <center>
    <input type="button" id="boton_finalizar" value="Finalizar venta" >
		</center>
		</div>
		</body>
</html>