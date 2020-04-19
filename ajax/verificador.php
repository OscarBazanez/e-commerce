<?php
require_once('../includes/conexion.php');

 error_reporting(0);
   


if(isset($_GET['paypal']) == "paypal") {
	//print_r($_GET);

	$clienteID = "";
	$secret = "";

    $login = curl_init();
    $url = "https://api.sandbox.paypal.com/v1/oauth2/token";

   
    curl_setopt($login, CURLOPT_URL, $url);

    curl_setopt($login, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($login, CURLOPT_USERPWD, $clienteID.":".$secret);

    curl_setopt($login, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

    $request = curl_exec($login);

    $objResponse = json_decode($request);
    $accessToken = $objResponse -> access_token;
    //print_r($accessToken);
    $orden_ID = $_GET["orden_ID"];
    $tel_envio =$_GET["tel_envio"];
    $user = $_GET["user"];
    $venta= curl_init("https://api.sandbox.paypal.com/v2/checkout/orders/".$orden_ID);

    curl_setopt($venta,CURLOPT_HTTPHEADER,array("Content-Type: application/json","Authorization: Bearer ".$accessToken));

    curl_setopt($venta,CURLOPT_RETURNTRANSFER,TRUE);

    $RespuestaaaaaVenta=curl_exec($venta);
    $JSON = json_decode($RespuestaaaaaVenta);
    //$entrar = $ddd -> id; funciona
    $precio = $JSON -> purchase_units[0]->amount->value;
    $descripcion = $JSON -> purchase_units[0]->description;
    $custom_id = $JSON -> purchase_units[0]->custom_id;
    $reference_id = $JSON -> purchase_units[0]->reference_id;
    $tipo_moneda = $JSON -> purchase_units[0]->amount->currency_code;
    $status = $JSON -> purchase_units[0]->payments->captures[0]->status;
    $nombre = $JSON -> purchase_units[0]->shipping->name->full_name;
    $address_line_1 = $JSON -> purchase_units[0]->shipping->address->address_line_1;
    $address_line_2 = $JSON -> purchase_units[0]->shipping->address->address_line_2;
    $admin_area_2 = $JSON -> purchase_units[0]->shipping->address->admin_area_2;
    $admin_area_1 = $JSON -> purchase_units[0]->shipping->address->admin_area_1;
    $postal_code = $JSON -> purchase_units[0]->shipping->address->postal_code;
    $country_code = $JSON -> purchase_units[0]->shipping->address->country_code;
    $create_time = $JSON -> purchase_units[0]->payments->captures[0]->create_time;
        $dsa = $JSON -> purchase_units[0]->shipping;
        //echo $dsa;
    /*print_r($JSON);
    echo "<br><br><br>";
    print_r($dsa);
    echo "<br><br><br>";
    //print_r($tipo_moneda);
    $order_ID = "0HK490794W8386337 ";
    echo "Estatus: ".$status."<br>";
    echo "Precio: ".$precio."<br>";
    echo "Tipo_moneda: ".$tipo_moneda."<br>";
    echo "Orden ID: ".$order_ID."<br>";
    echo "Nombre: ".$nombre."<br>";
    echo "address_line_1: ".$address_line_1."<br>";
    echo "address_line_2: ".$address_line_2."<br>";
    echo "admin_area_2: ".$admin_area_2."<br>";
    echo "admin_area_1: ".$admin_area_1."<br>";
    echo "postal_code: ".$postal_code."<br>";
    echo "country_code: ".$country_code."<br>";
    echo "Descripcion: ".$descripcion."<br>";
    echo "Custom_id: ".$custom_id."<br>";
    echo "Reference_id: ".$reference_id."<br>";
    echo "Create_time: ".$create_time."<br>";*/

    //seriali array
    $animal = $_POST['animal'];
    $nombre_perso = $_POST['nombre_perso'];
    $correo_perso = $_POST['correo_perso'];
    $correo_perso = $_POST['correo_perso'];
    $tel_perso = $_POST['tel_perso'];
    $imprimir .='
    <div class="alert alert-success" role="alert" align="center">
      <h4 class="alert-heading">Se realizo con éxito tu compra</h4>
      <p>Numero de pedido: '.$orden_ID.'</p>
      <p>Compraste los siguientes productos; </p>
      <hr>
      <ol>
    ';
    for ($i=0; $i <count($animal) ; $i++) { 
        $variables = explode("!!", $animal[$i]);
        $animal_ID = $variables[0];
        $producto_ID = $variables[1];
        $cantidad = $variables[2];
        $precio_producto = $variables[3];
        $queryproducto = mysqli_query($conn ,"SELECT nombre FROM `producto` WHERE ID='$producto_ID'");
         $row_producto= mysqli_fetch_array($queryproducto);
         $nombre_producto= $row_producto['nombre'];
        $queryanimal = mysqli_query($conn ,"SELECT nombre FROM `animales` WHERE ID='$animal_ID'");
         $row_producto= mysqli_fetch_array($queryanimal);
         $nombre_animal= $row_producto['nombre'];
        $cam .='
        <b>animal_ID; '.$animal_ID.' producto_ID; '.$producto_ID.' cantidad; '.$cantidad.' precio_producto; '.$precio_producto.' nombre_perso; '.$nombre_perso[$i].'</b><br>
        <b>'.$nombre_producto.' para '.$nombre_animal.'.</b><br>
        ';
        $imprimir .='
        <li align="center">'.$nombre_producto.' para '.$nombre_animal.' a $'.$precio_producto.' '.$cantidad.'Nombre; '.$nombre_perso[$i].' correo; '.$correo_perso[$i].' contacto; '.$tel_perso[$i].'</li>
        ';
    }
    $imprimir .='
        </ol>
    </div>
    ';
    //echo "Precio: ".$precio."<br>".$tel_envio."<br>".$user."<br>".$precio."<br>".$status."<br>".$create_time;
    echo $imprimir;
}

if(isset($_POST['name']) != "") {//prueba para el carrito
 $number = count($_POST["name"]); 
 $orden_ID = $_GET["orden_ID"];
 $tel_envio =$_GET["tel_envio"];
 echo $orden_ID;
 if($number > 0)  
 {  
      for($i=0; $i<$number; $i++)  
      {  
           if(trim($_POST["name"][$i] != ''))  
           {  
             echo "ID animal; ".$_POST["id"][$i]."Nombre: ".$_POST["name"][$i]."<br>";
           }  
      }  
      //echo "Data Inserted"; 
      echo "telefono para el envio".$telefono;
 }  
 else  
 {  
      //echo "Please Enter Name";  
 }  
    
}
?>

      
