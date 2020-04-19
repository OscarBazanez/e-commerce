<?php 
if (isset($_POST['enviar_carrito'])!="") {
  $cantidad = $_POST['cantidad'];
  $herra_ID = $_POST['herra_ID'];
  $sede = $_POST['sede'];
  $area_trabajo = $_POST['area_trabajo'];
  
  for ($i=0; $i <count($cantidad) ; $i++) { 
   echo $cantidad[$i]."<br>";
  }
}
//index.php

//include('database_connection.php');
require_once('includes/conexion.php');
error_reporting(0);
session_start();
$sesion= $_SESSION['sesioniniciada'];
$usuario_ID=$_SESSION['usuarios_ID'];
?>

<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <meta name="description" content="">
 <meta name="author" content="">
 <title>Simelic - Solicitar pedido</title>
 <style>
    .wrapper {
     margin-top: 5px; /* place it under navbar */
     height: 30vh;
     overflow: scroll;
     padding-bottom: 5px; /* compensate margin top */
    }
    #loading{
        text-align:center; 
        background: url('loader.gif') no-repeat center; 
        height: 150px;
    }
    #fondo{
        background-color: #1FB4E7;
    }
 </style> 
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
 <script type="text/javascript"> 
  function global(){
    //var select = document.getElementById("prueba").value;  
    //alert(select);
    var select = document.getElementById("selectEspecie").value;
    var relacion = 1;
    if(select !== "nada"){
     $.post('ajax/relaciones.php', {select: select, relacion:relacion}, function(data){
      // document.getElementById("name-data").value=data;
      $("#selectRaza").html(data);
     });
    }else{
      $("#selectRaza").html(); 
    }
  }
  function isInputNumber(evt){
    var ch = String.fromCharCode(evt.which);
    if(!(/[0-9]/.test(ch))){
      evt.preventDefault();
    }
  }
 </script>    
</head>
<?php  //include("../dist/header.php"); ?>
<body id="fondo">
  <div class="container-fluid"><br>
    <div id="resumen_carrito"></div>
    <div class="row">
      <div class="col-md-3 px-1">
        <div class="card row-border hover order-column shadow p-3 mb-5 bg-white rounded">
          <div class="card-body">
            <div class="sticky-top">
             <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#modal_carrito">
               <a id="cart-popover" class="btn" data-placement="bottom" title="Shopping Cart">
                 <span class="glyphicon glyphicon-shopping-cart"></span>
                 <span class="badge"></span>
                 <span class="total_price">$ 0.00</span>
               </a>
             </button>
             <b>Categria</b>
             <select name="especie" onChange="global()" class="form-control form-control-sm" id="selectEspecie">
                   <option value="nada">Selecciona una</option>
                     <?php $query_especie = mysqli_query($conn,"SELECT * FROM categoria_herramienta WHERE active = 1");
                     while($data= mysqli_fetch_assoc($query_especie) ) {
                       $ID = $data['ID'];
                       $especie = $data['categoria'];
                       /* agrega otro animal si no aparece en la lista */
                       ?>
                       <option class="common_selector especies" value="<?php echo $ID;?>"><?php echo $especie;?></option><?php 
                     } ?>
             </select>
             <b>Sub Categria</b>
             <select name="selectRaza" class="form-control form-control-sm" onchange="ocuMueForms(),common_selector()" id="selectRaza">
               <option value="">Seleccione una Categoria</option>
             </select>
             <div  class="accordion" id="categorias_sub"><br>
               <div id="RESULTADO"></div>
             </div>
           </div>
          </div>
        </div>
      </div>
      <div class="col-md-9 filter_data">
        
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal_carrito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel" align="center">Agregados a la lista</h 5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
        </div>
          <div class="modal-body">
           <form action="proceso_compra.php" method="POST">
           <span id="cart_details"></span>
          </div>
          <div class="modal-footer">
           <input type="submit" class="btn btn-primary" name="enviar_carrito" value="Comprar">
           </form>  
           <a href="#" type="button" class="btn btn-default" id="clear_cart">
            <span class="glyphicon glyphicon-trash"></span> Limpiar
           </a>
          </div>
      </div>
    </div>
  </div>

   <div class="modal fade" id="but_data" tabindex="-1" role="dialog" aria-labelledby="label_data" aria-hidden="true">
     <div class="modal-dialog modal-xl" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="label_data">Detalles</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body" id="herra_data">

         </div>
       </div>
     </div>
   </div>


<script>
 function Suma_t(p_envio){
  let monto = document.getElementsByClassName("monto")
  let precio = document.getElementsByClassName("precio")
  let env_precio = document.getElementById("env_precio").value;
    var suma = p_envio; 
    
    
  for (var i = 0; i < monto.length; i++) {    
      var suma = suma+ monto[i].value*precio[i].value
  }
    var number = numeral(suma);
    number.format();
    numeral.defaultFormat('$0,0.00');
    number.format();
  $("#spTotal").html(number.format());      
 }
  $(document).ready(function(){
    $('#enviar_carrito').click(function(){            
      $.ajax({  
        url:"ajax/proceso_pedido.php?user=<?php echo $usuario_ID; ?>&accion=solicitar",  
        method:"POST",  
        data: $('#form_carrito').serialize(),  
        success:function(data){
        $('#modal_carrito').modal('hide'); 
          //alert(data);
          //vaciar_tabla();
          $("#resumen_carrito").html(data);
        }  
      });  
    });
  }); 
  function vaciar_tabla() {
    var action = 'empty';
    $.ajax({
      url:"ajax/accion_carrito.php",
      method:"POST",
      data:{action:action},
      success:function()
      {
        load_cart_data();
        $('#cart-popover').popover('hide');
      }
    });
  }
  function accion_data(herra_ID){
    var herra_ID;
    var acc_data = 1;
    $.post('ajax/recuperar_dato_filtro.php', {herra_ID: herra_ID,acc_data: acc_data}, function(data){
      $("#herra_data").html(data);
    });
  }
  filter_data();
  function filter_data(){
    $('.filter_data').html('<div class="text-center"><div class="spinner-border text-primary" role="status" style="width: 7rem; height: 7rem;"><span class="sr-only">Cargando...</span></div></div>');
    var action = 'fetch_data';
    //var minimum_price = $('#hidden_minimum_price').val();
    // var maximum_price = $('#hidden_maximum_price').val();
    var especie = get_filter('especies');
    var raza = get_filter('raza');
    var color = get_filter('color');
    var tipo = get_filter('tipo');
    var watts = get_filter('watts');
    var dimension = get_filter('dimension');
    var material = get_filter('material');
    var rpm = get_filter('rpm');
    var calibre = get_filter('calibre');
    var temperatura = get_filter('temperatura');
    var marca = get_filter('marca');
    var estado = get_filter('estado');
    $.ajax({
     url:"ajax/recuperar_dato_filtro.php",
     method:"POST",
     data:{action:action, especie:especie, raza:raza, color:color, tipo:tipo, watts:watts, dimension:dimension, mate :material, rpm:rpm, calibre:calibre, temperatura:temperatura, marca:marca, estado:estado},
      success:function(data){
        $('.filter_data').html(data);
      }
    });
  }
  function get_filter(class_name){
    var filter = [];
    $('.'+class_name+':checked').each(function(){
     filter.push($(this).val());
    });
    return filter;
  }  
 function common_selector() {
   filter_data();
 }
  function ocuMueForms() { //agregar_usuario
    var categoria = document.getElementById("selectEspecie").value;
    var sub_cate = document.getElementById('selectRaza').value;
    if(categoria !== ""){
     $.post('ajax/relaciones.php', {categoria: categoria,sub_cate: sub_cate}, function(data){
      //document.getElementById("select2").value=select2;
      $("#RESULTADO").html(data/*+'<option value="otro">Otra</option>'*/);
     });   
    } 
  }
 //carrito
 $(document).ready(function(){
  load_cart_data();
  function load_cart_data()
  {
    $.ajax({
      url:"ajax/recuperar_carrito.php",
      method:"POST",
      dataType:"json",
      success:function(data)
      {
        $('#cart_details').html(data.cart_details);
        $('.total_price').text(data.total_price);
        $('.badge').text(data.total_item);
      }
    });
  }
  $('#cart-popover').popover({
    html : true,
    container: 'body',
    content:function(){
      return $('#popover_content_wrapper').html();
    }
  });
  $(document).on('click', '.add_to_cart', function(){
    var product_id = $(this).attr("id");
    var product_name = $('#name'+product_id+'').val();
    var product_price = $('#price'+product_id+'').val();
    var product_quantity = $('#quantity'+product_id).val();
    var action = "add";
    if(product_quantity > 0)
    {
      $.ajax({
        url:"ajax/accion_carrito.php",
        method:"POST",
        data:{product_id:product_id, product_name:product_name, product_price:product_price, product_quantity:product_quantity, action:action},
        success:function(data){
          load_cart_data();
           //$('#aa'+product_id).hide();
        }
      });
     }else{
      alert("Ingresa una cantidad valida");
    }
  });
  $(document).on('click', '.delete', function(){
    var product_id = $(this).attr("id");
    var action = 'remove';
    if(confirm("¿Estás seguro de remover el producto?"))
    {
      $.ajax({
        url:"ajax/accion_carrito.php",
        method:"POST",
        data:{product_id:product_id, action:action},
        success:function()
        {
          load_cart_data();
          $('#cart-popover').popover('hide');
        }
      })
     }else{
      return false;
    }
  });
  $(document).on('click', '#clear_cart', function(){
    var action = 'empty';
    if(confirm("¿Estás seguro de remover el producto?"))
    {
      $.ajax({
        url:"ajax/accion_carrito.php",
        method:"POST",
        data:{action:action},
        success:function()
        {
          load_cart_data();
          $('#cart-popover').popover('hide');
        }
      });
    }
  });
 });

  function suma_producto(producto_ID,precio){//agregar_usuario
    var producto_ID;
    var precio;
    var cantidad = document.getElementById('cant'+producto_ID).value;
    var accion_suma_producto = 1;
    $.post('ajax/relaciones.php', {cantidad: cantidad, producto_ID: producto_ID,accion_suma_producto: accion_suma_producto,precio:precio}, function(data){
      $("#suma_prod"+producto_ID).html(data);
      sumar();
    });
  }
 function sumar() {

  var total = 0;

  $(".monto").each(function() {

    if (isNaN(parseFloat($(this).val()))) {

      total += 0;

    } else {

      total += parseFloat($(this).val());

    }

  });

  //alert(total);
  //document.getElementById('spTotal').innerHTML = total;

}
</script>

</body>

</html>