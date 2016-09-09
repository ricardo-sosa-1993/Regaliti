<?php session_start();?>
<html>
	<head>
		<title>Editar venta</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="../styles.css">
		<script   src="https://code.jquery.com/jquery-1.12.3.js"   integrity="sha256-1XMpEtA4eKXNNpXcJ1pmMPs8JV+nwLdEqwiJeCQEkyc="   crossorigin="anonymous"></script>
		<script   src="https://code.jquery.com/ui/1.12.0-rc.2/jquery-ui.js"   integrity="sha256-6HSLgn6Ao3PKc5ci8rwZfb//5QUu3ge2/Sw9KfLuvr8="   crossorigin="anonymous"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
  		<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="jquery-clockpicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="jquery-clockpicker.min.css">
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
		$( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$('#clockpicker').clockpicker();
		var id_venta = <?php echo $_GET['id_venta']; ?>;
		$.ajax({    //create an ajax request to load_page.php
			        type: "post",
			        url: "datos_venta.php",  
			        	data: {id_venta: id_venta},  
			        	dataType: "json",
			        success: function(data){		
			        		var t = JSON.stringify(data.Fecha_venta).split(/[- : "]/)
			        		var fecha =  new Date(t[1],t[2]-1,t[3],t[4],t[5]);
		    				var hora = fecha.getHours();
		    				var minutos = fecha.getMinutes();
		    				if(hora<10){
		    					hora = "0"+hora;
		    				}
		    				if(minutos<10){
		    					minutos="0"+minutos;
		    				}
		    				var time = hora + ":" + minutos;
		    				$( "#datepicker" ).datepicker( "setDate", fecha);
		    				$('#clockpicker').val(time);
		    				$('#vendedor').val(data.Id_usuario);
			        }

	    		});
		$.ajax({    //create an ajax request to load_page.php
			        type: "post",
			        url: "productos_venta.php",  
			        	data: {id_venta: id_venta},  
			        	dataType: "json",
			        success: function(data){		
		    				for(var i=0; i<data.length;i++){
		    					tabla.row.add(data[i]).draw();	 
			    				total+=parseFloat(data[i].subtotal);  
			    				$(tabla.column(4).footer()).html('$'+ total);
		    				}
			        }

	    		});

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
	    				cantidad_nueva = parseFloat($("#"+tabla.cell(i,0).data()).val()) + cantidad;
	    				subtotal_nuevo = parseFloat(tabla.cell(i,3).data()) * cantidad_nueva;
	    				num = i;
	    				break;
	    			}
	    		}
	
    		if(existe==0){
    			 $.ajax({    //create an ajax request to load_page.php
			        type: "post",
			        url: "producto_compra_editar.php",  
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
					        url: "producto_compra_editar.php",  
					        data: {Id_articulo: producto, cantidad: cantidad},        
					        dataType: "json",               
					        success: function(data){
								if(cantidad_nueva > data.stock){
									alert("No hay existencias suficientes");
									$("#"+tabla.cell(num,0).data()).val(data.stock);
								}else{
									$("#"+tabla.cell(i,0).data()).val(cantidad_nueva);
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

		$(document).on("change", ".cantidad", function() {
		    var index = tabla.row($(this).parents('tr')).index();
		    var cantidad = parseFloat($("#"+tabla.cell(index,0).data()).val());
		    var subtotal = parseFloat(tabla.cell(index,3).data()) * cantidad;
		    var producto = tabla.cell(index,0).data();
		    total-= parseFloat(tabla.cell(index,4).data());
		    total+= subtotal;
		    $.ajax({    //create an ajax request to load_page.php
			        type: "post",
			        url: "producto_compra.php",  
			        data: {Id_articulo: producto, cantidad: cantidad},        
			        dataType: "json",               
			        success: function(data){
							if(cantidad > data.stock){
			        			alert("No hay existencias suficientes");
			        			 $("#"+tabla.cell(index,0).data()).val(data.stock);
			        		}else{
			        			tabla.cell(index,4).data(subtotal).draw();
		    					$(tabla.column(4).footer()).html('$'+ total);
			        		}		              
			        }

	    		});
		})

		$('#boton_finalizar').click(function() {
			var datos_tabla = [];
			var total_final = total;
			var time = $('#clockpicker').val();
			var res = time.split(':');
			var hora = res[0];
			var minuto = res[1];
			var dia = $("#datepicker").datepicker('getDate').getDate();                 
            var mes = $("#datepicker").datepicker('getDate').getMonth() + 1;             
            var ano = $("#datepicker").datepicker('getDate').getFullYear();
            var vendedor = $('#vendedor').val();
            if(dia<10){
				dia = "0"+ dia.toString(); 
			}
			if(mes<10){
				mes = "0"+ mes.toString(); 
			}
			var i;
			for(i=0;i<tabla.rows().count();i++){
					var datos_fila = tabla.row(i).data();
					datos_fila.cantidad_nueva = $("#"+tabla.cell(i,0).data()).val();
	    			datos_tabla.push(datos_fila);
    		}

			 $.ajax({    //create an ajax request to load_page.php
			        type: "post",
			        url: "guarda_venta_existente.php",  
			        	data: {datos: datos_tabla, total: total_final, dia: dia, mes: mes, ano: ano, hora: hora, minuto: minuto, vendedor: vendedor, id_venta: id_venta},  

			        success: function(data){		
		    				location.href="plantilla_venta.php?id_venta="+id_venta;

			        }

	    		});
		});

		$("#boton_cancelar").click(function() {
			location.href="plantilla_venta.php?id_venta="+id_venta;
		});

	} );

function mysqlTimeStampToDate(timestamp) {
    //function parses mysql datetime string and returns javascript Date object
    //input has to be in this format: 2007-06-05 15:26:02
    var regex=/^([0-9]{2,4})-([0-1][0-9])-([0-3][0-9]) (?:([0-2][0-9]):([0-5][0-9]):([0-5][0-9]))?$/;
    var parts=timestamp.replace(regex,"$1 $2 $3 $4 $5 $6").split(' ');
    return new Date(parts[0],parts[1]-1,parts[2],parts[3],parts[4],parts[5]);
  }

</script>
	</head>
	<body>
	<nav class="navbar navbar-default barra_breadcrumb">
			  <div class="container-fluid">
			    <div class="navbar-header">
			      <a class="pull-left" href="#"><img src="../logo_regaliti.png" width="190px" height="100px"></a>
			    </div>
			    <ul class="nav navbar-nav">
			      <li><a href ="registrar_venta.php">Registrar venta</a></li>
			      <li class="active"><a href ="ventas.php">Ventas</a></li> 
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
		<li><a href="ventas.php">Ventas</a></li>
		<li><a href="plantilla_venta.php?id_venta=<?php echo $_GET['id_venta']; ?>">Detalle de venta</a></li>
	    <li class="active">Editar venta</li>
	</ul>
		<div class="container">
			<center>
			<table>
			<tr>
				<td>Fecha:</td>
				<td><input type="text" id="datepicker"></td>
			</tr>
			<tr>
				<td>Hora:</td>
				<td><input id="clockpicker" data-autoclose="true"></td>
			</tr>
			<tr>
				<td>Venta realizada por:</td>
				<td>
					<select id="vendedor">
					<?php 
						include "../conexion.php";
						$link = conectarse();
						$result = mysqli_query($link,"select * from Usuario where Activo=1");
						while($row=mysqli_fetch_array($result)){
							echo "<option value='",$row["Id_usuario"],"'>",$row["Nombre_usuario"],"</option>";
						}
					?>
					</select>
				</td>
			</tr>
			</table>
			</center>
		<div class="formulario">
			<table>
				<tr>
					<td>Producto:<td>
				</tr> 
				<tr>
					<td>
						<select id="producto">
						<?php
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
    <input type="button" id="boton_finalizar" value="Guardar cambios" >
    <input type="button" id="boton_cancelar" value="Cancelar">
		</center>
		</div>
		</