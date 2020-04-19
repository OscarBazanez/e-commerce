
<?php
require_once('../includes/conexion.php');

if (isset($_POST["relacion"]) == 1){

    $select=$_POST['select'];
    $query4=mysqli_query($conn,"SELECT * FROM sub_categoria_herramienta WHERE cate_herra_ID ='$select'");
  	$output='<option value="">Selecciona una</option>';
    while($row=mysqli_fetch_assoc($query4)){
            $output.= '<option class="common_selector raza" value="'.$row["ID"].'">'.$row["tipo"].'</option>';
            
      }echo $output;
}



if (isset($_POST["seleccion"])){

    $seleccion=$_POST['seleccion'];

    echo $seleccion;
}


if (isset($_POST["select"])){

    $select=$_POST['select'];
    $query0=mysqli_query($conn,"SELECT * FROM `sub_categoria_herramienta` WHERE cate_herra_ID ='$select'");
  //  $output='<option value="">Selecciona una Sub Categoria</option>';
    while($row=mysqli_fetch_assoc($query0)){
    $output.= '<option value="'.$row['ID'].'">'.$row['tipo'].'</option>';
    
  }echo '<option value="nada" class="common_selector selectSubCate">Selecciona una</option>'.$output;
}



if (isset($_POST["select2"])){
//hacer una consulta que cuente 
  //poner if en el $output en donde si existe devolver el id con|actualizar y si no existe enviar solo el id
    $select2=$_POST['select2'];
    $query01=mysqli_query($conn,"SELECT * FROM `categoria_tercera` WHERE sub_cate_ID ='$select2'");
  //  $output='<option value="">Elige Raza</option>';
    while($row=mysqli_fetch_assoc($query01)){
    $output3.= '<option value="'.$row['ID'].'">'.$row['tipo'].'</option>';
    
  }echo $output3;
  echo "hola";
}
  


if (isset($_POST["categoria"])){
    $categoria=$_POST['categoria'];
    $sub_cate=$_POST['sub_cate'];
    $query_rela_cate=mysqli_query($conn,"SELECT * FROM `categoria_subcactegoria` WHERE cate_herra_ID ='$categoria' AND subcate_herra_ID ='$sub_cate'");
      while($row=mysqli_fetch_assoc($query_rela_cate)){
        $rela_ID = $row['ID'];
        $rela_tipo = $row['tipo'];
        $rela_color = $row['color'];
        $rela_watts = $row['watts'];
        $rela_dimension = $row['dimension'];
        $rela_material = $row['material'];
        $rela_rpm = $row['rpm'];
        $rela_calibre = $row['calibre'];
        $rela_temperatura = $row['temperatura'];
      } //echo $rela_ID;


      function tipo_mostrar($conn,$rela_ID){
        $tipo_select = '
        <div class="card">
              <b id="heading_tipo" data-toggle="collapse" data-target="#collapse_tipo" aria-expanded="true" aria-controls="collapse_tipo" align="center">
                Tipo
                <img src="../images/icon/abajo.svg" width="20px">
              </b>
          <div id="collapse_tipo" class="collapse" aria-labelledby="heading_tipo" data-parent="#categorias_sub">
            <div class="card-body overflow-auto" style="max-height: 125px;">
              ';
              $query_inv_herra_tipo=mysqli_query($conn,"SELECT DISTINCT tipo FROM `inv_herramienta` WHERE cate_sub_ID ='$rela_ID'");
                while($row=mysqli_fetch_assoc($query_inv_herra_tipo)){
                  $tipo = $row['tipo'];
                  $tipo_select.='
                  <div class="custom-control custom-checkbox">
                    <span class="float-right badge badge-light round">()</span>
                      <input type="checkbox" class="custom-control-input tipo" value="'.$tipo.'" onclick="common_selector()" id="Check3'.$tipo.'">
                      <label class="custom-control-label" for="Check3'.$tipo.'">'.$tipo.'</label>
                  </div>
                  ';
                }
              $tipo_select .='
            </div>
          </div>
        </div>
        ';
        echo $tipo_select;
      }

      function color_mostrar($conn,$rela_ID){
        $color_select = '
        <div class="card">
              <b id="heading_color" data-toggle="collapse" data-target="#collapse_color" aria-expanded="true" aria-controls="collapse_color" align="center">
                Color
                <img src="../images/icon/abajo.svg" width="20px">
              </b>
          <div id="collapse_color" class="collapse" aria-labelledby="heading_color" data-parent="#categorias_sub">
            <div class="card-body overflow-auto" style="max-height: 125px;">
              ';
              $query_inv_herra_color=mysqli_query($conn,"SELECT DISTINCT color FROM `inv_herramienta` WHERE cate_sub_ID ='$rela_ID'");
              $rowcount=mysqli_num_fields($query_inv_herra_color);
                while($row=mysqli_fetch_assoc($query_inv_herra_color)){
                  //$dddd.= 'aaaaaaaaaaaaaa'.$row['ID'].'ssss';
                  $color = $row['color'];
                  $color_select.='
                  <div class="custom-control custom-checkbox">
                    <span class="float-right badge badge-light round">()</span>
                      <input type="checkbox" class="custom-control-input color" value="'.$color.'" onclick="common_selector()" id="Check3'.$color.'">
                      <label class="custom-control-label" for="Check3'.$color.'">'.$color.'</label>
                  </div>
                  ';
                }
              $color_select .='
            </div>
          </div>
        </div>
        ';
        echo $color_select;
      }

      function watts_mostrar($conn,$rela_ID){
        $watts_select = '
        <div class="card">
              <b id="heading_watts" data-toggle="collapse" data-target="#collapse_watts" aria-expanded="true" aria-controls="collapse_watts" align="center">
                Watts
                <img src="../images/icon/abajo.svg" width="20px">
              </b>
          <div id="collapse_watts" class="collapse" aria-labelledby="heading_watts" data-parent="#categorias_sub">
            <div class="card-body overflow-auto" style="max-height: 125px;">
              ';
              $query_inv_herra_watts=mysqli_query($conn,"SELECT DISTINCT watts FROM `inv_herramienta` WHERE cate_sub_ID ='$rela_ID'");
                while($row=mysqli_fetch_assoc($query_inv_herra_watts)){
                  //$dddd.= 'aaaaaaaaaaaaaa'.$row['ID'].'ssss';
                  $watts = $row['watts'];
                  $watts_select.='
                  <div class="custom-control custom-checkbox">
                    <span class="float-right badge badge-light round">()</span>
                      <input type="checkbox" class="custom-control-input watts" value="'.$watts.'" onclick="common_selector()" id="Check3'.$watts.'">
                      <label class="custom-control-label" for="Check3'.$watts.'">'.$watts.'</label>
                  </div>
                ';
                }
              $watts_select .='
            </div>
          </div>
        </div>
        ';
        echo $watts_select;
      }

      function dimension_mostrar($conn,$rela_ID){
        $dimension_select = '
        <div class="card">
              <b id="heading_dimension" data-toggle="collapse" data-target="#collapse_dimension" aria-expanded="true" aria-controls="collapse_dimension" align="center">
                Dimension
                <img src="../images/icon/abajo.svg" width="20px">
              </b>
          <div id="collapse_dimension" class="collapse" aria-labelledby="heading_dimension" data-parent="#categorias_sub">
            <div class="card-body overflow-auto" style="max-height: 125px;">
              ';
              $query_inv_herra_dimension=mysqli_query($conn,"SELECT DISTINCT dimension FROM `inv_herramienta` WHERE cate_sub_ID ='$rela_ID'");
                while($row=mysqli_fetch_assoc($query_inv_herra_dimension)){
                  //$dddd.= 'aaaaaaaaaaaaaa'.$row['ID'].'ssss';
                  $dimension = $row['dimension'];
                  $dimension_select.='
                  <div class="custom-control custom-checkbox">
                    <span class="float-right badge badge-light round">()</span>
                      <input type="checkbox" class="custom-control-input dimension" value="'.$dimension.'" onclick="common_selector()" id="Check3'.$dimension.'">
                      <label class="custom-control-label" for="Check3'.$dimension.'">'.$dimension.'</label>
                  </div>
                ';
                }
              $dimension_select .='
            </div>
          </div>
        </div>
        ';
        echo $dimension_select;
      }

      function material_mostrar($conn,$rela_ID){
        $material_select = '
        <div class="card">
              <b id="heading_materal" data-toggle="collapse" data-target="#collapse_materal" aria-expanded="true" aria-controls="collapse_materal" align="center">
                Material
                <img src="../images/icon/abajo.svg" width="20px">
              </b>
          <div id="collapse_materal" class="collapse" aria-labelledby="heading_materal" data-parent="#categorias_sub">
            <div class="card-body overflow-auto" style="max-height: 125px;">
              ';
              $query_inv_herra_material=mysqli_query($conn,"SELECT DISTINCT material FROM `inv_herramienta` WHERE cate_sub_ID ='$rela_ID'");
                while($row=mysqli_fetch_assoc($query_inv_herra_material)){
                  //$dddd.= 'aaaaaaaaaaaaaa'.$row['ID'].'ssss';
                  $material = $row['material'];
                  $material_select.='
                  <div class="custom-control custom-checkbox">
                    <span class="float-right badge badge-light round">()</span>
                      <input type="checkbox" class="custom-control-input material" value="'.$material.'" onclick="common_selector()" id="Check3'.$material.'">
                      <label class="custom-control-label" for="Check3'.$material.'">'.$material.'</label>
                  </div>
                ';
                }
              $material_select .='
            </div>
          </div>
        </div>
        ';
        echo $material_select;
      }

      function rpm_mostrar($conn,$rela_ID){
        $rpm_select = '
        <div class="card">
              <b id="heading_rpm" data-toggle="collapse" data-target="#collapse_rpm" aria-expanded="true" aria-controls="collapse_rpm" align="center">
                RPM
                <img src="../images/icon/abajo.svg" width="20px">
              </b>
          <div id="collapse_rpm" class="collapse" aria-labelledby="heading_rpm" data-parent="#categorias_sub">
            <div class="card-body overflow-auto" style="max-height: 125px;">
              ';
              $query_inv_herra_rpm=mysqli_query($conn,"SELECT DISTINCT rpm FROM `inv_herramienta` WHERE cate_sub_ID ='$rela_ID'");
                while($row=mysqli_fetch_assoc($query_inv_herra_rpm)){
                  //$dddd.= 'aaaaaaaaaaaaaa'.$row['ID'].'ssss';
                  $rpm = $row['rpm'];
                  $rpm_select.='
                  <div class="custom-control custom-checkbox">
                    <span class="float-right badge badge-light round">()</span>
                      <input type="checkbox" class="custom-control-input rpm" value="'.$rpm.'" onclick="common_selector()" id="Check3'.$rpm.'">
                      <label class="custom-control-label" for="Check3'.$rpm.'">'.$rpm.'</label>
                  </div>
                ';
                }
              $rpm_select .='
            </div>
          </div>
        </div>
        ';
        echo $rpm_select;
      }

      function calibre_mostrar($conn,$rela_ID){
        $calibre_select = '
        <div class="card">
              <b id="heading_rcalibre" data-toggle="collapse" data-target="#collapse_calibre" aria-expanded="true" aria-controls="collapse_calibre" align="center">
                Calibre
                <img src="../images/icon/abajo.svg" width="20px">
              </b>
          <div id="collapse_calibre" class="collapse" aria-labelledby="heading_rcalibre" data-parent="#categorias_sub">
            <div class="card-body overflow-auto" style="max-height: 125px;">
              ';
              $query_inv_herra_calibre=mysqli_query($conn,"SELECT DISTINCT calibre FROM `inv_herramienta` WHERE cate_sub_ID ='$rela_ID'");
                while($row=mysqli_fetch_assoc($query_inv_herra_calibre)){
                  //$dddd.= 'aaaaaaaaaaaaaa'.$row['ID'].'ssss';
                  $calibre = $row['calibre'];
                  $calibre_select.='
                  <div class="custom-control custom-checkbox">
                    <span class="float-right badge badge-light round">()</span>
                      <input type="checkbox" class="custom-control-input calibre" value="'.$calibre.'" onclick="common_selector()" id="Check3'.$calibre.'">
                      <label class="custom-control-label" for="Check3'.$calibre.'">'.$calibre.'</label>
                  </div>
                ';
                }
              $calibre_select .='
            </div>
          </div>
        </div>
        ';
        echo $calibre_select;
      }

      function temperatura_mostrar($conn,$rela_ID){
        $temperatura_select = '
        <div class="card">
              <b id="heading_temperatura" data-toggle="collapse" data-target="#collapse_temperatura" aria-expanded="true" aria-controls="collapse_temperatura" align="center">
                Temperatura
                <img src="../images/icon/abajo.svg" width="20px">
              </b>
          <div id="collapse_temperatura" class="collapse" aria-labelledby="heading_temperatura" data-parent="#categorias_sub">
            <div class="card-body overflow-auto" style="max-height: 125px;">
              ';
              $query_inv_herra_temperatura=mysqli_query($conn,"SELECT DISTINCT temperatura FROM `inv_herramienta` WHERE cate_sub_ID ='$rela_ID'");
                while($row=mysqli_fetch_assoc($query_inv_herra_temperatura)){
                  //$dddd.= 'aaaaaaaaaaaaaa'.$row['ID'].'ssss';
                  $temperatura = $row['temperatura'];
                  $temperatura_select.='
                  <div class="custom-control custom-checkbox">
                    <span class="float-right badge badge-light round">()</span>
                      <input type="checkbox" class="custom-control-input temperatura" value="'.$temperatura.'" onclick="common_selector()" id="Check3'.$temperatura.'">
                      <label class="custom-control-label" for="Check3'.$temperatura.'">'.$temperatura.'</label>
                  </div>
                ';
                }
              $temperatura_select .='
            </div>
          </div>
        </div>
        ';
        echo $temperatura_select;
      }
      function marca_mostrar($conn,$rela_ID){
        $marca_select = '
        <div class="card">
              <b id="heading_marca" data-toggle="collapse" data-target="#collapse_marca" aria-expanded="true" aria-controls="collapse_marca" align="center">
                Marca
                <img src="../images/icon/abajo.svg" width="20px">
              </b>
          <div id="collapse_marca" class="collapse" aria-labelledby="heading_marca" data-parent="#categorias_sub">
            <div class="card-body overflow-auto" style="max-height: 125px;">
              ';
              $query_inv_herra_temperatura=mysqli_query($conn,"SELECT DISTINCT marca FROM `inv_herramienta` WHERE cate_sub_ID ='$rela_ID'");
                while($row=mysqli_fetch_assoc($query_inv_herra_temperatura)){
                  //$dddd.= 'aaaaaaaaaaaaaa'.$row['ID'].'ssss';
                  $marca = $row['marca'];
                  $marca_select.='
                  <div class="custom-control custom-checkbox">
                    <span class="float-right badge badge-light round">()</span>
                      <input type="checkbox" class="custom-control-input marca" value="'.$marca.'" onclick="common_selector()" id="Check3'.$marca.'">
                      <label class="custom-control-label" for="Check3'.$marca.'">'.$marca.'</label>
                  </div>
                ';
                }
              $marca_select .='
            </div>
          </div>
        </div>
        ';
        echo $marca_select;
      }
      function estado_mostrar($conn,$rela_ID){
        $marca_select = '
        <div class="card">
              <b id="heading_estado" data-toggle="collapse" data-target="#collapse_estado" aria-expanded="true" aria-controls="collapse_estado" align="center">
                Estado
                <img src="../images/icon/abajo.svg" width="20px">
              </b>
          <div id="collapse_estado" class="collapse" aria-labelledby="heading_estado" data-parent="#categorias_sub">
            <div class="card-body overflow-auto" style="max-height: 125px;">
              ';
              $query_inv_herra_temperatura=mysqli_query($conn,"SELECT DISTINCT estado FROM `inv_herramienta` WHERE cate_sub_ID ='$rela_ID'");
                while($row=mysqli_fetch_assoc($query_inv_herra_temperatura)){
                  //$dddd.= 'aaaaaaaaaaaaaa'.$row['ID'].'ssss';
                  $estado = $row['estado'];
                  $marca_select.='
                  <div class="custom-control custom-checkbox">
                    <span class="float-right badge badge-light round">()</span>
                      <input type="checkbox" class="custom-control-input estado" value="'.$estado.'" onclick="common_selector()" id="Check3'.$estado.'">
                      <label class="custom-control-label" for="Check3'.$estado.'">'.$estado.'</label>
                  </div>
                ';
                }
              $marca_select .='
            </div>
          </div>
        </div>
        ';
        echo $marca_select;
      }
      echo estado_mostrar($conn,$rela_ID);
      echo marca_mostrar($conn,$rela_ID);
      if ($rela_tipo == "si") {
        echo tipo_mostrar($conn,$rela_ID);
      }
      if ($rela_color == "si") {
        echo color_mostrar($conn,$rela_ID);
      }
      if ($rela_watts == "si") {
        echo watts_mostrar($conn,$rela_ID);
      }
      if ($rela_dimension == "si") {
        echo dimension_mostrar($conn,$rela_ID);
      }
      if ($rela_material == "si") {
        echo material_mostrar($conn,$rela_ID);
      }
      if ($rela_rpm == "si") {
        echo rpm_mostrar($conn,$rela_ID);
      }
      if ($rela_calibre == "si") {
        echo calibre_mostrar($conn,$rela_ID);
      }
      if ($rela_temperatura == "si") {
        echo temperatura_mostrar($conn,$rela_ID);
      }
}




if ((isset($_POST["agregar2"])) && ($_POST["agregar2"] == "1")){
  //hacer una consulta que cuente y si existe mostrar solo agregar las cantidades del producto, pero si no existe insertar los datos
  $nombre_producto = mb_strtoupper($_POST['nom_producto']);
  $udm=$_POST['udm']; 
  $estado=$_POST['estado1']; 
  $cd = $_POST['cd'];
  $marca_ID=$_POST['marca']; 
  $modelo=$_POST['modelo']; 
  $no_serie = $_POST['no_serie'];
  $descripcion=$_POST['descripcion']; 
  $sede_ID=$_POST['sede']; 
  $area_trabajo_ID = $_POST['area_trabajo'];
  $observaciones = $_POST['obervaciones'];
  $usuario = mb_strtolower($_POST['usuario']);
  $cate_ID = $_POST['selectCategoria'];
  $sub_cate_ID = $_POST['selectSubCate'];
  $mas_cate = $_POST['mas_cate'];

  $usuario_ID = "123";

  $tipo_computo = $_POST['tipo_computo'];
  $ipv4=$_POST['ipv4']; 
  $mascara_ipv4=$_POST['mascara_ipv4']; 
  $dns_ipv4 = $_POST['dns_ipv4'];
  $ipv6=$_POST['ipv6']; 
  $mascara_ipv6=$_POST['mascara_ipv6']; 
  $dns_ipv6 = $_POST['dns_ipv6'];
  $sis_opera = $_POST['sis_opera'];
  $tipo_so = $_POST['tipo_so'];
  $taman_monitor = $_POST['taman_monitor'];
  $marca_proce = $_POST['marca_proce'];
  $modelo_proce = $_POST['modelo_proce'];
  $tama_ram = $_POST['tama_ram'];
  $tipo_ram = $_POST['tipo_ram'];
  $vel_ram = $_POST['vel_ram'];
  $marca_gpu = $_POST['marca_gpu'];
  $modelo_gpu = $_POST['modelo_gpu'];
  $uni_cd = $_POST['uni_cd'];
  $lect_tarj = $_POST['lect_tarj'];
  $tarjeta_madre = $_POST['tarjeta_madre'];
  $fuente_poder = $_POST['fuente_poder'];
  $capaci_alma = $_POST['capaci_alma'];
  $wifi = $_POST['wifi'];

    
    
  $insertSQL12 = sprintf("INSERT INTO categoria_subcactegoria  (cate_herra_ID, 
    subcate_herra_ID, cate_tercera_ID) 
    VALUES ('$cate_ID', '$sub_cate_ID', '$mas_cate' )");
    $Result12 = mysqli_query($conn, $insertSQL12) or die(mysqli_error());

  $ultimo_ID12=mysqli_insert_id($conn);

  $insertSQL3 = sprintf("INSERT INTO inventario_computo  (creado_usuario_ID, sede_ID, area_trabajo_ID, ipv4, ipv6, mascara_ipv4,mascara_ipv6, dns_ipv4, dns_ipv6, tipo_computo, sistema_operativo,tipo_sistema_operativo, marca_ID, modelo, no_serie, medida_monitor,marca_procesador, procesador, ram, tipo_ram, velocidad_ram, marca_gpu, modelo_gpu, unidad_cd, lector_tarjetas, tarjeta_madre, modelo_fuente_poder, capac_almacenamiento, adap_red_inalambrico, observaciones, cate_sub_ID, cantidad_dispo, estado) VALUES ('$usuario_ID','$sede_ID', '$area_trabajo_ID', '$ipv4', '$ipv6', '$mascara_ipv4','$mascara_ipv6', '$dns_ipv4', '$dns_ipv6', '$tipo_computo', '$sis_opera','$tipo_so', '$marca_ID', '$modelo', '$no_serie', '$taman_monitor','$marca_proce', '$modelo_proce', '$tama_ram', '$tipo_ram', '$vel_ram','$marca_gpu', '$modelo_gpu', '$uni_cd', '$lect_tarj', '$tarjeta_madre','$fuente_poder', '$capaci_alma', '$wifi', '$observaciones', '$ultimo_ID12','$cd','$estado')");
  $Result3 = mysqli_query($conn, $insertSQL3) or die(mysqli_error());


}

if ((isset($_POST["agregar"])) && ($_POST["agregar"] == "1")) {

  $insertSQL1 = sprintf("INSERT INTO categoria_subcactegoria  (cate_herra_ID, subcate_herra_ID, cate_tercera_ID) VALUES ('$cate_ID', '$sub_cate_ID', '$mas_cate' )");
  $Result1 = mysqli_query($conn, $insertSQL1) or die(mysqli_error());

  $ultimo_ID=mysqli_insert_id($conn);

  $insertSQL2 = sprintf("INSERT INTO inventario_herramienta  (creado_usuario_ID, nom_producto, cate_sub_ID, udm, can_disponible, marca_ID, modelo, no_serie, descripcion, observaciones, sede_ID, area_trabajo_ID, estado) VALUES ('$usuario_ID', '$nombre_producto', '$ultimo_ID', '$udm', '$cd', '$marca_ID', '$modelo', '$no_serie', '$descripcion', '$observaciones', '$sede_ID', '$area_trabajo_ID', '$estado')");
  $Result2 = mysqli_query($conn, $insertSQL2) or die(mysqli_error());

  if($Result1==true){ 
    echo 1;
  } else { 
    echo 0;
    }
}



if (isset($_POST["accion_cantidad"])!=""){

    $herra_ID=$_POST['herra_ID'];
    $cantidad=$_POST['cantidad'];

    $query0=mysqli_query($conn,"SELECT * FROM `inv_herramienta` WHERE ID ='$herra_ID'");
    while($row=mysqli_fetch_assoc($query0)){
      $cantidad_total = $row['can_disponible'];  
    }
    if ($cantidad > -1) {
      if ($cantidad == 0) {
        //echo "Es igual a 0";
        echo '<small style="color:red;">Debe ser mayor a cero</small>';
      }elseif ($cantidad <= $cantidad_total) {
        //echo "Es menor que el total";
        echo '<small style="color:green;">Es la cantidad correcta</small>';
      }elseif ($cantidad > $cantidad_total) {
        //echo "Es mayor que el existente";
        echo '<small style="color:red;">Es mayor que el existente</small>';
      }
    }else{echo '<small style="color:red;">Tiene que ser números positivos</small>';}
}


if (isset($_POST["accion_suma_producto"])==1){

    $producto_ID=$_POST['producto_ID'];
    $cantidad=$_POST['cantidad'];
    $precio=$_POST['precio'];
    $cantidad_todos=$_POST['cantidad_todos'];
    $suma = $precio*$cantidad;
    $suma_producto = $cantidad_todos."$".number_format($suma, 2);
    echo $suma_producto;
    //$data = array(
    //  'suma_prod'    =>  $suma_producto,
    //  'suma_total'   =>  '$' . number_format($total_price, 2)
    //);  
}


?>

