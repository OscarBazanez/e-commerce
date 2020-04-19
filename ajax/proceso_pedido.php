<?php 

//index.php

//include('database_connection.php');
require_once('../includes/conexion.php');
error_reporting(0);

if (isset($_GET["accion"]) == "solicitar"){
  $user = $_GET['user'];
  $number = count($_POST["cantidad"]);  
 if($number > 0){  
      $queryOrden = mysqli_query($conn ,"SELECT orden FROM `pedido`ORDER BY orden DESC");
      $row_orden= mysqli_fetch_array($queryOrden);
      $orden= $row_orden['orden']+1;
      for($i=0; $i<$number; $i++)  
      {
        $herra_ID = $_POST["herra_ID"][$i];
        if(trim($_POST["cantidad"][$i] != '')){
          $cantidad = mysqli_real_escape_string($conn,$_POST["cantidad"][$i]);
          $dest_sede_ID = mysqli_real_escape_string($conn,$_POST["sede"][$i]);
          $dest_area_ID = mysqli_real_escape_string($conn,$_POST["area_trabajo"][$i]);
          $queryHerra = mysqli_query($conn ,"SELECT sede_ID,area_trabajo_ID FROM `inv_herramienta` WHERE ID='$herra_ID'");
          $row_herra= mysqli_fetch_array($queryHerra);
          $ori_sede_ID= $row_herra['sede_ID'];
          $ori_area_ID= $row_herra['area_trabajo_ID'];

          $slq1="INSERT INTO `pedido` (`orden`,`soli_user_ID`,`herra_ID`,`cantidad`,`estatus`,`ori_sede_ID`,`ori_area_ID`,`dest_sede_ID`,`dest_area_ID`,`soli_fecha`) VALUES ('$orden','$user','$herra_ID','$cantidad','Pendiente','$ori_sede_ID','$ori_area_ID','$dest_sede_ID','$dest_area_ID',now())";
          $result08=mysqli_query($conn,$slq1);
        }
        echo "herra ".$_POST["herra_ID"][$i]."cantidad ".$_POST["cantidad"][$i]."sede ".$_POST["sede"][$i]."area ".$_POST["area_trabajo"][$i];
      }
 }  
 else  
 {  
      echo "Please Enter Name";  
 }  
}

if (isset($_POST["accion"]) == "modal_orden"){
  $orden_ID =$_POST["orden_ID"];
  $output .='
  <div class="table-responsive">
  <table class="table">
    <thead class="table-info"> 
      <tr>
        <th>Nombre</th>
        <th>Cantidad</th> 
        <th>Destino</th> 
        <th>Fecha</th>
        <th>Autorizacion</th> 
      </tr> 
    </thead>
    <tbody>
  ';

  $query_pedido = mysqli_query($conn ,"SELECT herra_ID,cantidad,soli_fecha,dest_sede_ID,estatus,ID FROM  `pedido` WHERE orden = '$orden_ID' AND active = 1");
  while($row_dist= mysqli_fetch_array($query_pedido)){
   $pedido_herra_ID= $row_dist['herra_ID'];
   $cantidad_pedido= $row_dist['cantidad'];
   $soli_fecha= $row_dist['soli_fecha'];
   $dest_sede_ID= $row_dist['dest_sede_ID'];
   $estatus= $row_dist['estatus'];
   $pedido_ID= $row_dist['ID'];
   $query_sede = mysqli_query($conn ,"SELECT nombre FROM `sede` WHERE ID = '$dest_sede_ID' AND active = 1");
   $row_sede= mysqli_fetch_array($query_sede);
   $nom_sede= $row_sede['nombre'];
    $query_herra = mysqli_query($conn ,"SELECT nom_producto,ID,can_disponible FROM `inv_herramienta` WHERE ID = '$pedido_herra_ID' AND active = 1");
    $row_herra= mysqli_fetch_array($query_herra);
    $nom_producto= $row_herra['nom_producto'];
    $herra_ID= $row_herra['ID'];
    $can_disponible= $row_herra['can_disponible'];
   if($estatus == "Pendiente") {
     $output .='
         <tr>
           <td>'.$nom_producto.'</td>
           <td><input type="number" min="1" class="form-control form-control-sm" name="cantidad[]" value="'.$cantidad_pedido.'" id="cant'.$herra_ID.'" onchange="maxCantidad('.$herra_ID.')"><small>Max:'.$can_disponible.'</small></p><div id="resu_cantidad'.$herra_ID.'"></div></td>
           <td>'.$nom_sede.'</td>
           <td>'.$soli_fecha.'</td>
           <td>
            <div id="ocu_autorizar">
            <button type="button" class="btn btn-success btn-sm" onclick="autorizar('.$pedido_ID.','.$herra_ID.')">Si</button>
            <button type="button" class="btn btn-danger btn-sm" onclick="NOautorizar('.$pedido_ID.','.$herra_ID.')">No</button>
            </div>
            <div id="autorizacion'.$herra_ID.'"></div>
           </td>
         </tr> 
     ';
    }elseif($estatus == "Autorizado") {
     $output .='
         <tr>
           <td>'.$nom_producto.'</td>
           <td>'.$cantidad_pedido.'</td>
           <td>'.$nom_sede.'</td>
           <td>'.$soli_fecha.'</td>
           <td><b style="color:green;">Autorizado</b></td>
         </tr> 
     ';
    }elseif($estatus == "No autorizar") {
     $output .='
         <tr>
           <td>'.$nom_producto.'</td>
           <td>'.$cantidad_pedido.'</td>
           <td>'.$nom_sede.'</td>
           <td>'.$soli_fecha.'</td>
           <td><b style="color:red;">No autorizado</b></td>
         </tr> 
     ';
    }
   }

  $output .='
    </tbody>
    <tfoot class="table-info">
      <tr>
        <th>Nombre</th>
        <th>Cantidad</th> 
        <th>Destino</th> 
        <th>Fecha</th>
        <th>Autorizacion</th> 
      </tr>
    </tfoot>
  </table>
  </div>
  ';
  echo $output;
  //echo $_POST["orden_ID"]."dadsadas";
}
if (isset($_POST["accion2"]) == "autorizar"){
  $cantidad = $_POST["cantidad"];
  $pedido_ID = $_POST["pedido_ID"];
  $herra_ID = $_POST["herra_ID"];

  $query_pedido2 = mysqli_query($conn ,"SELECT * FROM `pedido` WHERE ID = '$pedido_ID' AND active = 1");
  $row_pedido2= mysqli_fetch_array($query_pedido2);
  $dest_sede_ID= $row_pedido2['dest_sede_ID'];
  $dest_area_ID= $row_pedido2['dest_area_ID'];

  $query_herra2 = mysqli_query($conn ,"SELECT * FROM `inv_herramienta` WHERE ID = '$herra_ID' AND active = 1");
  $row_herra2= mysqli_fetch_array($query_herra2);
  $cantidad_total= $row_herra2['can_disponible'];
  $nom_producto= $row_herra2['nom_producto'];
  $cate_sub_ID= $row_herra2['cate_sub_ID'];
  $udm= $row_herra2['udm'];
  $marca= $row_herra2['marca'];
  $modelo= $row_herra2['modelo'];
  $no_serie= $row_herra2['no_serie'];
  $descripcion= $row_herra2['descripcion'];
  $tipo= $row_herra2['tipo'];
  $color= $row_herra2['color'];
  $watts= $row_herra2['watts'];
  $dimension= $row_herra2['dimension'];
  $material= $row_herra2['material'];
  $rpm= $row_herra2['rpm'];
  $calibre= $row_herra2['calibre'];
  $temperatura= $row_herra2['temperatura'];
  $observaciones= $row_herra2['observaciones'];
  $imagen= $row_herra2['imagen'];
  $estado= $row_herra2['estado'];
  $sede_ID= $row_herra2['sede_ID'];
  $area_trabajo_ID= $row_herra2['area_trabajo_ID'];
  $fecha_creacion= $row_herra2['fecha_creacion'];
  $user_ID = $_GET['user'];
  //$cantidad_total =131;
  if ($cantidad > -1) {
    if ($cantidad <= $cantidad_total) {
      $resta = $cantidad_total - $cantidad;
      if ($resta == 0) {
        $up_pedido = "UPDATE pedido SET estatus = 'Autorizado',au_fecha = now(), au_user_ID = '$user_ID' WHERE ID='$pedido_ID' limit 1";
        $con_pedido = mysqli_query($conn, $up_pedido) or die(mysqli_error($conn));

        $q_herra = "UPDATE inv_herramienta SET sede_ID = '$dest_sede_ID', area_trabajo_ID = '$dest_area_ID' WHERE ID='$herra_ID' limit 1";
        $con_herra = mysqli_query($conn, $q_herra) or die(mysqli_error($conn));
        echo '<b style="color:green;">Autorizado</b><script type="text/javascript">$("#ocu_autorizar").hide();</script>';
      }else{
        $up_pedido2 = "UPDATE pedido SET au_user_ID = '$user_ID', cantidad = '$cantidad', estatus = 'Autorizado', au_fecha = now() WHERE ID='$pedido_ID' limit 1";
        $con_pedido2 = mysqli_query($conn, $up_pedido2) or die(mysqli_error($conn));

        $upd_inviH = "UPDATE inv_herramienta SET can_disponible = '$resta' WHERE ID='$herra_ID' limit 1";
        $con_inviH = mysqli_query($conn, $upd_inviH) or die(mysqli_error($conn));

        $inHerra="INSERT INTO `inv_herramienta` (`nom_producto`,`cate_sub_ID`,`udm`,`marca`,`modelo`,`no_serie`,`descripcion`,`tipo`,`color`,`watts`,`dimension`,`material`,`rpm`,`calibre`,`temperatura`,`observaciones`,`imagen`,`estado`,`sede_ID`,`area_trabajo_ID`,`fecha_creacion`,`creado_usuario_ID`,`can_disponible`)VALUES('$nom_producto','$cate_sub_ID','$udm','$marca','$modelo','$no_serie','$descripcion','$tipo','$color','$watts','$dimension','$material','$rpm','$calibre','$temperatura','$observaciones','$imagen','$estado','$dest_sede_ID','$dest_area_ID',now(),'$user_ID','$cantidad')";//now()
        $coninHerra=mysqli_query($conn,$inHerra);
        echo '<b style="color:green;">Autorizado</b><script type="text/javascript">$("#ocu_autorizar").hide();</script>';
      }
    }else{echo '<small style="color:red;">Excedió la cantidad existente. Por favor de ingresar la cantidad correcta.</small>';}
  }else{echo '<small style="color:red;">Tiene que ser números positivos</small>';}
}

if (isset($_POST["accion3"]) == "No autorizar"){
  $user_ID = $_GET['user'];
  $pedido_ID = $_POST["pedido_ID"];
  $up_pedidoCance = "UPDATE pedido SET estatus = 'No autorizar',au_fecha = now(), au_user_ID = '$user_ID' WHERE ID='$pedido_ID' limit 1";
  $con_pedidoCance = mysqli_query($conn, $up_pedidoCance) or die(mysqli_error($conn));
  echo '<b style="color:red;">No autorizado</b><script type="text/javascript">$("#ocu_autorizar").hide();</script>';
}



?>