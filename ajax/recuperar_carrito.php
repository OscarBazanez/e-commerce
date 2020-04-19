<?php require_once('../includes/conexion.php')?>
<?php

//fetch_cart.php

session_start();

$total_price = 0;
$total_item = 0;

$output = '
<div class="table-responsive" id="order_table">
	<table class="table table-bordered table-striped">
		<tr>  
            <th>Herramienta</th>  
            <th>Cantidad</th>  
            <th>Total</th>  
            <th>Action</th>  
        </tr>
';
if(!empty($_SESSION["shopping_cart"]))
{

	foreach($_SESSION["shopping_cart"] as $keys => $values)
	{
		$precio_envio = 150;
		$producto_ID =$values["product_name"];
		$query_producto = mysqli_query($conn ,"SELECT nombre FROM `producto` WHERE ID = '$producto_ID' AND active = 1");
		$row_producto= mysqli_fetch_array($query_producto);
		$nom_producto= $row_producto['nombre'];
		$output .= '
		<tr>
			<td><select name="producto_ID[]" class="form-control form-control-sm"><option value="'.$values["product_name"].'">'.$nom_producto.'</option></select></td>
			<td><input type="number" min="1" class="form-control form-control-sm monto" name="cantidad[]" onkeypress="isInputNumber(event)" id="cant'.$values["product_name"].'" value="'.$values["product_quantity"].'" onchange="suma_producto('.$values["product_name"].','.$values["product_price"].',Suma_t('.$precio_envio.'))"><small>Max:'.$can_disponible.'</small></p><div id="resu_cantidad'.$values["product_name"].'"></div></td>
			<input type="hidden" name="precio_producto[]" class="precio" value="'.$values["product_price"].'">
		 ';

		$output .= '
			<td align="right" id="suma_prod'.$values["product_name"].'">$'.number_format($values["product_quantity"] * $values["product_price"], 2).' </td>
			<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'. $values["product_id"].'">Remove</button></td>
		</tr>
		';
		$total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
		$total_item = $total_item + 1;
	}
	$total_price = $total_price+150;
	$output .= '
	<tr>  
        <td colspan="2" align="right">Envio</td>  
        <td align="right">$ '.number_format("150", 2).'</td>
        <td></td>
    </tr>
    <tr>  
        <td colspan="2" align="right">Total</td>  
        <td align="right" id="spTotal">$ '.number_format($total_price, 2).'</td>  
        <td></td>
        <input type="hidden" name="precio_envio" class="env_precio" id="env_precio" value="'.$precio_envio.'">
    </tr>
    
	';
}
else
{
	$output .= '
    <tr>
    	<td colspan="5" align="center">
    		No existe ninguna herramienta!
    	</td>
    </tr>
    ';
}
$output .= '</table></div>';
$data = array(
	'cart_details'		=>	$output,
	'total_price'		=>	'$' . number_format($total_price, 2),
	'total_item'		=>	$total_item
);	

echo json_encode($data);

/*
<div class="card-deck">
	<div class="card">
		<img src="..." class="card-img-top" alt="...">
		<div class="card-body">
		  <h5 class="card-title">gfgfdgf</h5>
		  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        </div>
        <div class="card-footer">
          <small class="text-muted">Last updated 3 mins ago</small>
        </div>
    </div>
</div>
mandar
ID
NOMBRE
personalidad
boton ver mas detalles del animal
 
*/

?>

