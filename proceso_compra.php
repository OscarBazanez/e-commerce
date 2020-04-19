  <?php

    require_once('includes/conexion.php');


    session_start();
    $sesion= $_SESSION['sesioniniciada'];
    $usuario_ID=$_SESSION['usuarios_ID'];
    $sesion= true;
    if ($sesion != true) {
       header("Location: index.php");
    }
    ?>
<html lang="es_MX">
      <script>  var loc = window.location.href+'';
        //if (loc.indexOf('http://')==0){
        //  window.location.href = loc.replace('http://','https://');
        //} 
      </script>
      <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
          
          <meta name="apple-mobile-web-app-capable" content="yes" />
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="description" content="Mototli">
          <title>Perso Tienda Industrial</title>
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
          <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
          integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
          <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
          <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
          <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
          <script src="https://www.paypal.com/sdk/js?client-id=AYr0LHY0Hge4PitheNoTadWZ4QVXyU8myUo0yARbwLsXdKzMH7mGgAtE6evnqANHDF_EZxz-FG61Uzuo&currency=MXN"></script>
      </head>
      <style>
        .fondo {
        background-color: #1FB4E7;
        }
      </style>
    <?php  include("header.php"); ?>
      <body class="fondo"><br>
        <div class="container-fluid">

          <?php
          if ($sesion == true) {
            $producto_ID = $_POST['producto_ID'];
            $cantidad = $_POST['cantidad'];
            $animal_ID = $_POST['animal_ID'];
            $precio_producto = $_POST['precio_producto'];
            $precio_envio = $_POST['precio_envio'];
            //$DECLARAR_PRECIO_ENFORM = "1333";
            if ($_POST['producto_ID'] !="") {
              ?>
              <form name="form_pago" id="form_pago" class="needs-validation" novalidate>
                <div id="paso_1"> 
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-2">
                              <h1>Paso 1:</h1>
                            </div>
                            <div class="col-md-10">
                              <h1 align="left">Personaliza el grabado de la herramienta</h1>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                    <div class="card-deck" aling="center">
                      <?php
                      $incrementador = 0;
                      for ($i=0; $i <count($producto_ID) ; $i++) {
                        
                        $total = $total + ($cantidad[$i] * $precio_producto[$i]);
                        $queryproducto = mysqli_query($conn ,"SELECT nombre FROM `producto` WHERE ID='$producto_ID[$i]'");
                          $row_producto= mysqli_fetch_array($queryproducto);
                          $nombre_producto= $row_producto['nombre'];
                          for ($a=0; $a <$cantidad[$i] ; $a++) {
                            $incrementador = $incrementador+1;
                            ?>
                            <li style="list-style-type: none;" id="aa">
                                <div class="card shadow-lg p-1 mb-1 bg-white rounded" style="width: 18rem;">
                                  <h3 align="center"><?php echo $nombre_producto; ?></h3>
                                  <HR></HR>
                                  <p style="font-size:20px;">&#191;Deseas grabar un nombre y un apellido? </p>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="nombre_perso_radio_1<?php echo $incrementador; ?>" name="nombre<?php echo $incrementador; ?>" onclick="SH_nombre_perso(this.value,<?php echo $incrementador; ?>)" value="no" class="custom-control-input" required>
                                    <label class="custom-control-label" for="nombre_perso_radio_1<?php echo $incrementador; ?>">No</label>
                                  </div>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="nombre_perso_radio_2<?php echo $incrementador; ?>" name="nombre<?php echo $incrementador; ?>" onclick="SH_nombre_perso(this.value,<?php echo $incrementador; ?>)" value="si" class="custom-control-input" required>
                                    <label class="custom-control-label" for="nombre_perso_radio_2<?php echo $incrementador; ?>">Si</label>
                                  </div>
                                  <div class="invalid-feedback">
                                    Por favor seleccione una opcion.
                                  </div>
                                  <p style="font-size:20px;display: none;" id="p_nombre_perso<?php echo $incrementador; ?>">Nombre y un apellido</p>
                                  <input type="text" class="form-control" style="display: none" name="nombre_perso[]" id="nombre_perso<?php echo $incrementador; ?>" placeholder="Ejemplo: Juan Gomez" required>



                                  <p style="font-size:20px;">&#191;Deseas grabar una fecha?</p>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="correo_perso_radio_1<?php echo $incrementador; ?>" name="mail<?php echo $incrementador; ?>" onclick="SH_correo_perso(this.value,<?php echo $incrementador; ?>)" value="no" class="custom-control-input" required>
                                    <label class="custom-control-label" for="correo_perso_radio_1<?php echo $incrementador; ?>">No</label>
                                  </div>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="correo_perso_radio_2<?php echo $incrementador; ?>" name="mail<?php echo $incrementador; ?>" onclick="SH_correo_perso(this.value,<?php echo $incrementador; ?>)" value="si" class="custom-control-input" required>
                                    <label class="custom-control-label" for="correo_perso_radio_2<?php echo $incrementador; ?>">Si</label>
                                  </div>
                                  <div class="invalid-feedback">
                                    Por favor seleccione una opcion.
                                  </div>
                                  <p style="font-size:20px;display: none;" id="p_correo_perso<?php echo $incrementador; ?>">Correo de contacto</p>
                                  <input type="date" class="form-control" name="correo_perso[]" id="correo_perso<?php echo $incrementador; ?>" style="display: none">
                                  <div class="invalid-feedback">
                                    Por favor ingrese una fecha.
                                  </div>



                                  <p style="font-size:20px;">&#191;Deseas grabar un código de identificación?</p>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="tel_perso_radio_1<?php echo $incrementador; ?>" name="tels<?php echo $incrementador; ?>" onclick="SH_tel_perso(this.value,<?php echo $incrementador; ?>)" value="no" class="custom-control-input" required>
                                    <label class="custom-control-label" for="tel_perso_radio_1<?php echo $incrementador; ?>">No</label>
                                  </div>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="tel_perso_radio_2<?php echo $incrementador; ?>" name="tels<?php echo $incrementador; ?>" onclick="SH_tel_perso(this.value,<?php echo $incrementador; ?>)" value="si" class="custom-control-input" required>
                                    <label class="custom-control-label" for="tel_perso_radio_2<?php echo $incrementador; ?>">Si</label>
                                  </div>
                                  <div class="invalid-feedback">
                                    Por favor seleccione una opcion.
                                  </div>
                                  <p style="font-size:20px;display: none;" id="p_tel_perso<?php echo $incrementador; ?>">Identificador</p>
                                  <input type="text" class="form-control" name="tel_perso[]" id="tel_perso<?php echo $incrementador; ?>" style="display: none" placeholder="Ejemplo:A9-12" required>
                                  <div class="invalid-feedback">
                                    Por favor ingrese un identificador.
                                  </div><br>
                                  <div class="card-footer">
                                    <b style="font-size:14px;">La informaci&oacuten que ingreses se mostrara en la herramienta.</b>
                                  </div>
                                </div>
                            </li>
                            <?php
                          }
                      } 
                      $precio_total = $total+$precio_envio;
                      ?>
                    </div>
                  <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                      <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="card-body">
                          <button type="button" onclick="validar_form()" class="btn btn-success btn-lg btn-block">Siguiente paso</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                    </div>
                  </div>
                </div>
                <div id="paso_2" style="display: none">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-2">
                              <h1>Paso 2:</h1>
                            </div>
                            <div class="col-md-10">
                              <h1 align="left">Informacion para el envio de la compra</h1>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                      <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="card-body">
                          <h5>Telefono de contacto:</h5>
                          <input type="tel" class="form-control" id="tel_envio" placeholder="Ejemplo:5500110011">
                          <div class="invalid-feedback">
                            Por favor ingrese un numero telef&oacutenico.
                          </div>
                          <b>Durante el proceso de pago se le va a solicitar la direcci&oacuten del envi&oacute.</b><br>
                          <button type="button" class="btn btn-success btn-lg btn-block"  onclick="validar_form(3)">Ultimo paso</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                    </div>
                  </div>
                </div>
                <div id="paso_3" style="display: none">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-2">
                              <h1>Paso 3:</h1>
                            </div>
                            <div class="col-md-10">
                              <h1 align="left">M&eacutetodo de pago</h1>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                      <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="card-body">
                          <h5 align="center">Precio Total: $<?php echo number_format($precio_total, 2); ?> MXN</h5>
                          <HR>
                          <div id="paypal-button-container"></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                    </div>
                  </div>
                </div>
              </form>
              <?php
            }elseif ($_POST['producto_ID'] =="") {
              header("Location:filtro.php");
            }
            ?>
            <?php 
          }else{ header("Location:/Login/login.php?accion=comprar"); }
          ?>

        </div>
        <div id="msg_pago"></div>

        <?php  include("footer.php"); ?>
      </body>
      <script>
        function SH_tel_envio(boton){
          if (boton == 1) {
            $('#tel_envio').attr({"disabled": false});
            $("#tel_envio").attr('required', '');
          }else{
            $('#tel_envio').attr({"disabled": true});
          }
        }
        function SH_tel_perso(value_input,cantidad_ID){
          if (value_input == "si") {
            $('#tel_perso'+cantidad_ID).show();
            $('#p_tel_perso'+cantidad_ID).show();
            $('#tel_perso'+cantidad_ID).val('');
            $('#tel_perso').attr({"disabled": false});
          }else{
            $('#tel_perso'+cantidad_ID).hide();
            $('#p_tel_perso'+cantidad_ID).hide();
            $('#tel_perso'+cantidad_ID).val('00');
          }
        }
        function SH_correo_perso(value_input,cantidad_ID){
          if (value_input == "si") {
            $('#correo_perso'+cantidad_ID).show();
            $('#p_correo_perso'+cantidad_ID).show();
            $('#correo_perso'+cantidad_ID).val('');
            $('#correo_perso').attr({"disabled": false});
          }else{
            $('#correo_perso'+cantidad_ID).hide();
            $('#p_correo_perso'+cantidad_ID).hide();
            $('#correo_perso'+cantidad_ID).val('Ninguno@Ninguno.com');
          }
        }
        function SH_nombre_perso(value_input,cantidad_ID){
          if (value_input == "si") {
            $('#nombre_perso'+cantidad_ID).show();
            $('#p_nombre_perso'+cantidad_ID).show();
            $('#nombre_perso'+cantidad_ID).val('');
            $('#nombre_perso').attr({"disabled": false});
          }else{
            $('#nombre_perso'+cantidad_ID).hide();
            $('#p_nombre_perso'+cantidad_ID).hide();
            $('#nombre_perso'+cantidad_ID).val('Ninguno');
          }
        }
        function validar_form(paso_2){
          var forms = document.getElementsByClassName('needs-validation');
          var validation = Array.prototype.filter.call(forms, function(form) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            alert("Existe un campo vac&iacuteo. Por favor revisa todos los campos :D");
            $('#paso_3').hide();
          }else{
            $('#paso_2').show();
            SH_tel_envio(1);
            if (paso_2=="3") {
              $('#paso_3').show();
            }
          }
          form.classList.add('was-validated');
          });
        }
        function pasos_2(){
          //Verificar que los campos esten llenos
          //$('#paso_3').show();
          /* EL boton debe estar desabilitado por default
                            <input type="submit" class="btn btn-success btn-lg btn-block" name="datos" id="datos" value="Enviar Datos" disabled> 

          var select = document.getElementById("selectTipo").value;
          if(select == ""){
           $('#datos').attr("disabled", true);
          } else {
           $('#datos').attr("disabled", false);
          }
          */
        }
        /*
        paypal.Buttons({
          createOrder: function(data, actions) {
            return actions.order.create({
              purchase_units: [{
                amount: {
                 value: '<?php echo $precio_total; ?>'
                },description:"Compra de productos a Mototli:ID ANIMAL",custom_id: 'ID DEL ANIMAL',reference_id: 'ID DE REFERENCIA'
              }]
            });
          },
          onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
              alert('Transaction completed by ' + data.orderID);
              var orderID = data.orderID;
              var tel_envio = document.getElementById("tel_envio").value;
              var user = <?php echo $usuario_ID; ?>;
              var paypal = "paypal";
              $.ajax({ 
                url:"ajax/verificador.php?orden_ID="+orderID+"&tel_envio="+tel_envio+"&user="+user+"&paypal="+paypal,  
                method:"POST",  
                data: $('#form_pago').serialize(),  
                success:function(data){  
                  $("#msg_pago").html(data);
                  $('#paso_1').hide();
                  $('#paso_2').hide();
                  $('#paso_3').hide();
                }  
              });

            });
          }
        }).render('#paypal-button-container');
        */
      </script>
</html>
