<?php

//fetch_data.php

//include('database_connection.php');

require_once('../includes/conexion.php');

 error_reporting(0);
 if (isset($_POST["acc_data"]) == 1) {
 	$herra_ID = $_POST["herra_ID"];
 	$output ='
	';
	$datoCita = mysqli_query($conn ,"SELECT * FROM `inv_herramienta` WHERE ID='$herra_ID' AND active = 1");
	$row_dato= mysqli_fetch_array($datoCita);
	$nom_producto= $row_dato['nom_producto'];
	$udm= $row_dato['udm'];
	$can_disponible= $row_dato['can_disponible'];
	$marca= $row_dato['marca'];
	$modelo= $row_dato['modelo'];
	$no_serie= $row_dato['no_serie'];
	$descripcion= $row_dato['descripcion'];

	$tipo= $row_dato['tipo'];
	$color= $row_dato['color'];
	$watts= $row_dato['watts'];
	$dimension= $row_dato['dimension'];
	$material= $row_dato['material'];
	$rpm= $row_dato['rpm'];
	$calibre= $row_dato['calibre'];
	$temperatura= $row_dato['temperatura'];

	$observaciones= $row_dato['observaciones'];
	$imagen= $row_dato['imagen'];
	$estado= $row_dato['estado'];
	$fecha_creacion= $row_dato['fecha_creacion'];
	
     $output .='
	    <div class="container-fluid">
	      <div class="row">
	        <div class="col-md-12 text-break">
	        <h2 align="center">Nombre: '.$nom_producto.'</h2>
	        </div>
	      </div>
	      <div class="row">
	        <div class="col-md-6 text-break">
	          <div class="text-center">
				<img src="images/herramienta/'.$imagen.'" width="300px" class="rounded" alt="...">
			  </div>
	          <h5><b>Marca:</b></h5>
	          <p style="font-size:19px">'.$marca.'</p>
	          <h5><b>Modelo</b></h5>
	          <p style="font-size:19px">'.$modelo.'</p>
	          <h5><b>No serie:</b></h5>
	          <p style="font-size:19px">'.$no_serie.'</p>
	          <h5><b>Cantidad</b></h5>
	          <p style="font-size:19px">'.$can_disponible.' '.$udm.'</p>
	        </div>
	        <div class="col-md-6 text-break">
	          <h5><b>Estado</b></h5>
	          <p style="font-size:19px">'.$estado.'</p>
	          <h5><b>Observaciones</b></h5>
	          <p style="font-size:19px">'.$observaciones.'</p>
	          <h5><b>Descripcion</b></h5>
	          <p style="font-size:19px">'.$descripcion.'</p>
	';
			if ($tipo != "") {
			 $output .='
	           <h5><b>tipo</b></h5>
	           <p style="font-size:19px">'.$tipo.'</p>
			 ';
			}
			if ($color != "") {
			 $output .='
	           <h5><b>color</b></h5>
	           <p style="font-size:19px">'.$color.'</p>
			 ';
			}
			if ($watts != "") {
			 $output .='
	           <h5><b>watts</b></h5>
	           <p style="font-size:19px">'.$watts.'</p>
			 ';
			}
			if ($dimension != "") {
			 $output .='
	           <h5><b>dimension</b></h5>
	           <p style="font-size:19px">'.$dimension.'</p>
			 ';
			}
			if ($material != "") {
			 $output .='
	           <h5><b>material</b></h5>
	           <p style="font-size:19px">'.$material.'</p>
			 ';
			}
			if ($rpm != "") {
			 $output .='
	           <h5><b>rpm</b></h5>
	           <p style="font-size:19px">'.$rpm.'</p>
			 ';
			}
			if ($calibre != "") {
			 $output .='
	           <h5><b>calibre</b></h5>
	           <p style="font-size:19px">'.$calibre.'</p>
			 ';
			}
			if ($temperatura != "") {
			 $output .='
	           <h5><b>temperatura</b></h5>
	           <p style="font-size:19px">'.$temperatura.'</p>
			 ';
			}

	$output .='
	        </div>
	      </div>
	      <div class="row">
	        <div class="col-md-12 text-break">
	        </div>
	      </div>
    	</div>
    ';

	echo $output;
 }
if(isset($_POST["action"]))
{
	$query = "
		SELECT * FROM producto WHERE active = '1'
	";
	/*	
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND product_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}*/

	if(isset($_POST["raza"]))
	{	
		$raza_filters = implode("','", $_POST["raza"]);
		$query1 = mysqli_query($conn,"SELECT * FROM `categoria_subcactegoria` WHERE subcate_herra_ID='$raza_filters' AND active = 1 ");
		while($datass= mysqli_fetch_assoc($query1) ) {
		        $rela_cate_ID = $datass['ID'];
		}

		$raza_filter = implode("','", $rela_cate_ID);
		$query .= "
		 AND cate_sub_ID IN('".$rela_cate_ID."')
		";
	}
	if(isset($_POST["color"]))
	{
		$color_filter = implode("','", $_POST["color"]);
		$query .= "
		 AND color IN('".$color_filter."')
		";
	}
	if(isset($_POST["tipo"]))
	{
		$tipo_filter = implode("','", $_POST["tipo"]);
		$query .= "
		 AND tipo IN('".$tipo_filter."')
		";
	}
	if(isset($_POST["watts"]))
	{
		$watts_filter = implode("','", $_POST["watts"]);
		$query .= "
		 AND watts IN('".$watts_filter."')
		";
	}
	if(isset($_POST["dimension"]))
	{
		$dimension_filter = implode("','", $_POST["dimension"]);
		$query .= "
		 AND dimension IN('".$dimension_filter."')
		";
	}
	if(isset($_POST["material"]))
	{
		$material_filter = implode("','", $_POST["material"]);
		$query .= "
		 AND material IN('".$material_filter."')
		";
	}
	if(isset($_POST["rpm"]))
	{
		$rpm_filter = implode("','", $_POST["rpm"]);
		$query .= "
		 AND rpm IN('".$rpm_filter."')
		";
	}
	if(isset($_POST["calibre"]))
	{
		$calibre_filter = implode("','", $_POST["calibre"]);
		$query .= "
		 AND calibre IN('".$calibre_filter."')
		";
	}
	if(isset($_POST["temperatura"]))
	{
		$temperatura_filter = implode("','", $_POST["temperatura"]);
		$query .= "
		 AND temperatura IN('".$temperatura_filter."')
		";
	}
	if(isset($_POST["marca"]))
	{
		$marca_filter = implode("','", $_POST["marca"]);
		$query .= "
		 AND marca IN('".$marca_filter."')
		";
	}
	if(isset($_POST["estado"]))
	{
		$estado_filter = implode("','", $_POST["estado"]);
		$query .= "
		 AND estado IN('".$estado_filter."')
		";
	}

	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	$i = 0;
	if($total_row > 0)
	{
		$output .= '
		   <div class="card-deck">
		';
		foreach($result as $i => $row)
		{
		$output .= '
        <li style="list-style-type: none;" id="aa'.$row["ID"].'">
         <div class="card shadow-lg p-1 mb-1 bg-white rounded" style="width: 18rem;">
           <img src="images/mascotas/'.$row["imagen"].'" class="card-img-top" width="170px" height="170px" alt="...">
           <HR>
           <div class="carwd-body">
             <h5 class="card-title" align="center">'.$row['nombre'].'</h5>
             <p class="card-text text-truncate " style="max-width: 950px;">'. $row['descripcion'] .'</p>
           </div>
           <div class="cards-footers">
             <small class="text-muted">Precio: '.$row['precio'].'</small>
         	<input type="hidden" name="quantity" id="quantity' . $row["ID"] .'" class="form-control" value="1" />
         	<input type="hidden" name="hidden_name" id="name'.$row["ID"].'" value="'.$row["ID"].'" />
         	<input type="hidden" name="hidden_price" id="price'.$row["ID"].'" value="'.$row["precio"].'" />
			<div class="row">
			 <div class="col-md-6">
			  <button class="btn btn-success form-control" style="margin-top:5px;" data-toggle="modal" data-target="#but_data" onclick="accion_data('.$row["ID"].')">Detalles</button>
			 </div>
			 <div class="col-md-6">
			  <input type="button" name="add_to_cart" id="'.$row["ID"].'" style="margin-top:5px;" class="btn btn-success form-control add_to_cart" value="Agregar" />
			 </div>
			</div>
           </div>
         </div>
        </li>
        ';
		}
		$output .= '
		   </div>
		';
	}
	else
	{
		$output = '<h3>No se encontraron productos</h3>';
	}
	echo $output;
}

?>

