<?php 
$root = (!isset($root)) ? "../../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
//\\//\\//\\//\\ Variables Generadas //\\//\\//\\//\\
$sesion =new Sesion();
$suscriptores =new Suscriptores();
$componentes =new Componentes();
$sectores =new Sectores();
$servicios =new Servicios();
$fechas =new Fechas();
$pqrs =new PQRS();
$asuntos =new Asuntos();

$transaccion = @$_REQUEST['transaccion'];
$accion = @$_REQUEST['accion'];
$suscriptor = $suscriptores->consultar(@$_REQUEST['suscriptor']);
$solicitud = empty($_REQUEST['solicitud']) ? time() : $_REQUEST['solicitud'];

$formulario['id'] = "f" . $transaccion;
$formulario['ventana'] = "v" . $transaccion;
$formulario['contenedor'] = "c" . $transaccion;
$formulario['interno'] = "i" . $transaccion;

$campo['nombres'] = $componentes->text('nombres', @$_REQUEST['nombres'], '32', 'required alpha', false, false, "[ Requerido ]");
$campo['apellidos'] = $componentes->text('apellidos', @$_REQUEST['apellidos'], '32', 'required alpha', false, false, "[ Requerido ]");
$campo['documentos'] = $componentes->combo_documentos("documentos", @$_REQUEST['documentos']);
$campo['identificacion'] = $componentes->text('identificacion', @$_REQUEST['identificacion'], '32', 'required validate-digits', false, false, "[ Requerido ]");
$campo['nacimiento'] = $componentes->combo_fecha(@$_REQUEST['_dias'], @$_REQUEST['_meses'], @$_REQUEST['_annos']);
$campo['sexo'] = $componentes->combo_sexo("sexo","sexo", @$_REQUEST['_sexo']);
$campo['telefono'] = $componentes->text('telefono', @$_REQUEST['telefonos'], '32', 'required validate-digits', false, false, "[ Requerido ]");
$campo['correo'] = $componentes->text('correo', @$_REQUEST['correo'], '32', 'validate-email', false, false, "[ Opcional ]");
$campo['pais'] = $componentes->text('pais', 'Colombia', '32', 'required', true);
$campo['region'] = $componentes->text('region', 'Valle Del Cauca', '32', 'required', true);
$campo['ciudad'] = $componentes->text('ciudad', 'Guadalajara De Buga', '32', 'required', true);
$campo['sector'] = $sectores->combo('sector', @$_REQUEST['sectores']);
$campo['direccion'] = $componentes->text('direccion', '', '128', 'required', false, false, "[ Requerido ]");
$campo['referencia'] = $componentes->text('referencia', '', '128', '', false, false, "[ Opcional ]");
$servicio = isset($_REQUEST['servicio']) ? $_REQUEST['servicio'] : '01';
$campo['servicio'] = $servicios->combo('servicio', $servicio);
$campo['asunto'] = $asuntos->combo_externo('asunto', @$_REQUEST['asunto'], $servicio);

//$componentes->text('asunto', '', '128', '', false, false, "Requerido");

$archivos = "modulos/solicitudes/archivos/index.php?suscriptor=" . $suscriptor['suscriptor'] . "&solicitud=" . $solicitud;
$campo['cargador'] = "<iframe src=\"" . ($archivos) . "\" width=\"100%\" height=\"200\" frameborder=\"0\" scrolling=\"auto\" align=\"top\" allowtransparency=\"1\" style=\"overflow-x:hidden; overflow-y:scroll;\"></iframe>";


if (empty($accion)) {
 echo('<div id="' . $formulario['contenedor'] . '" class="formulario">');
 echo('<form name="' . $formulario['id'] . '" id="' . $formulario['id'] . '" action="modulos/solicitudes/externo/formularios/radicacion.xhr.php?&transaccion=' . $transaccion . '" method="post">');
 echo('<div id="' . $formulario['interno'] . '">');
}
?>
<style>
 #divSolicitud{}
 #divSolicitud .tabla{width: 98%; }
 #divSolicitud input{ font-size: 20px; height: 36px !important;}
 #divSolicitud select{height: 42px; }
 #divSolicitud  label{ font-size: 16px; font-style: bold; padding-top: 10px; padding-bottom: 2px;}
 #divSolicitud  .overTxtLabel{ font-size: 24px; font-style: bold; padding-top: 4px; padding-left: 4px; color: #cccccc;}
 #divSolicitud .capitalizar{ text-transform: capitalize;}
 #divSolicitud  h2{ padding-left: 20px; margin-top: 20px;width: 100%; font-size: 18px; line-height: 30px;font-weight: bold; border: 1px dashed #cccccc;   text-align: left; height: 26px; display: block; }
 #divSolicitud #nombres{width: 100%;  text-transform: capitalize;}
 #divSolicitud #apellidos{width: 100%;  text-transform: capitalize;}
 #divSolicitud #documentos{width: 70px; }
 #divSolicitud #identificacion{width: 100%; }
 #divSolicitud #dias{width: 100px; }
 #divSolicitud #meses{width: 100px; }
 #divSolicitud #annos{width: 100px;  }
 #divSolicitud #sexo{width: 100%; }
 #divSolicitud #telefono{width: 100%; }
 #divSolicitud #correo{width: 100%; }
 #divSolicitud #pais{width: 100px;}
 #divSolicitud #region{width: 100%; }
 #divSolicitud #ciudad{width: 220px; }
 #divSolicitud #sector{width: 100%; }
 #divSolicitud #direccion{width: 100%; text-transform: capitalize; }
 #divSolicitud #referencia{width: 100%; text-transform: capitalize;}
 #divSolicitud #servicio{width: 100%; }
 #divSolicitud #asunto{width: 100%; }
 #divSolicitud #detalle{ }
 #divSolicitud #enviar{width: 150px; }
 #divSolicitud #capcha{width: 150px; }
 #divSolicitud .imgcapcha{border: 1px dashed #cccccc; padding: 20px; }
</style>
<?php  if (empty($accion) || $accion == "cancelar") { ?>

 <div id="divSolicitud">
  <input type="hidden" name="accion" id="accion" value="verificar">
  <input type="hidden" id="suscriptor" name="suscriptor" value="<?php  echo($suscriptor['suscriptor']); ?>">
  <input type="hidden" id="solicitud" name="solicitud" value="<?php  echo($solicitud); ?>">

  <table align="center" class="tabla"><tbody>
    <tr><td colspan="4">
      <div style="border-top:solid 1px;border-bottom:solid 1px;text-align:center;background-color:#F1F6F9"><div><br>
        <b>FORMULARIO ÚNICO PARA RADICACIÓN PQR</b></div>
       <table><tr><td width="100"><div id="i100x100_seguro" style="float: left;"></div></td><td>
          <p align="justify" style=" border:1px; line-height:16px; font-size:16px; padding-right:10px">
           De la completitud y exactitud de la información proporcionada en el presente formulario dependerá la correcta
           atención a su solicitud, recuerde diligenciar en lo posible y en detalle todos los campos solicitados y en especial
           manifieste de la forma más explicita y concreta posible en la solicitud que desea realizar. No olvide adjuntar los
           documentos que considere necesario para legitimar, dar tramite o veracidad a la solicitud por usted manifiesta.
           De completarse el presente procedimiento la solicitud será radicada para el suscriptor <b><?php  echo($suscriptor['nombres'] . " " . $suscriptor['apellidos']); ?></b> con domicilio en <b><?php  echo($suscriptor['direccion']); ?></b>. </p></td></tr></table>
       <br></div></td></tr>
   </tbody>
  </table>
  <table align="center" class="tabla"><tr><td><h2>Datos Personales</h2></td></tr></table>
  <table align="center" class="tabla">
   <tr>
    <td><label>Nombres:</label></td>
    <td><label>Apellidos:</label></td>
    <td colspan="2"><label>Documento De Identificación: </label></td>
   </tr>
   <tr>
    <td><?php  echo($campo['nombres']); ?></td>
    <td><?php  echo($campo['apellidos']); ?></td>
    <td><?php  echo($campo['documentos']); ?></td>
    <td><?php  echo($campo['identificacion']); ?> </td>
   </tr>
  </table>
  <table align="center" class="tabla">
   <tr>
    <td width="300"><label>Fecha De Nacimiento:</label></td>
    <td><label>Sexo:</label></td>
    <td><label>Teléfonos:</label> </td>
    <td><label>Correo electrónico: </label></td>
   </tr>
   <tr>
    <td><?php  echo($campo['nacimiento']); ?></td>
    <td><?php  echo($campo['sexo']); ?></td>
    <td><?php  echo($campo['telefono']); ?></td>
    <td><?php  echo($campo['correo']); ?></td>
   </tr>
  </table>
  <table align="center" class="tabla">
   <tr>
    <td><label>Pais:</label></td>
    <td><label>Region: </label></td>
    <td><label>Ciudad: </label></td>
    <td><label>Sector:</label> </td>
   </tr>
   <tr>
    <td><?php  echo($campo['pais']); ?></td>
    <td><?php  echo($campo['region']); ?></td>
    <td><?php  echo($campo['ciudad']); ?></td>
    <td><?php  echo($campo['sector']); ?></td>
   </tr>
  </table>
  <table align="center" class="tabla">
   <tr>
    <td><label>Dirección:</label></td>
    <td><label>Referencia: </label></td>
   </tr>
   <tr>
    <td><?php  echo($campo['direccion']); ?></td>
    <td><?php  echo($campo['referencia']); ?></td>
   </tr>
  </table>
  <table align="center" class="tabla"><tr><td><h2>Información De La Solicitud</h2></td></tr></table>
  <table align="center" class="tabla">
   <tr>
    <td><label>Servicio: </label></td>
    <td><label>Asunto De Referencia::</label></td>
   </tr>
   <tr>
    <td><?php  echo($campo['servicio']); ?></td>
    <td><?php  echo($campo['asunto']); ?></td>
   </tr>
   <tr colspan="3">
    <td><label>Solicitud:</label></td>
   </tr>
   <tr>
    <td colspan="3">

    </td>
   </tr>
  </table>

  <textarea cols="40" name="detalle" id="detalle" rows="5" cols="180">HOLA</textarea>
  <label>Su solicitud puede contener máximo 65536 caracteres</label>





  <table align="center" class="tabla"><tr><td><h2>Adjuntar Archivos</h2></td></tr></table>

  <table align="center" class="tabla">
   <tr>
    <td><div id="i100x100_adjuntar" style="float: left;"></div>
     <p align="justify" style="line-height:14px; font-size:16px; padding:10px">
      Presione el botón "<b>Archivos</b>"
      para seleccionar los archivos que considere complementarios para su solicitud, no olvide hacer clic en el botón
      "<b>Cargar</b>" para anexarlos a su solicitud, el sistema de carga le indicara cuando sus archivos este
      correctamente cargados, el tiempo de carga de los archivos varia en relación a su tamaño deberá estar
      atento al indicador que le visualiza el estado de la carga de los archivos para luego proceder a la radicación
      de su solicitud. <u>Este complemento es opcional si no desea adjuntar ninguna clase de archivo prosiga con
    su solicitud omitiendo este paso</u>. </p>

   </td>
   </tr>
   <tr>
    <td>
     <?php  echo($campo['cargador']); ?>
    </td>
   </tr>
  </table>


  <table align="center" class="tabla"><tr><td><h2>Confirme Su Solicitud</h2></td></tr></table>
  <table align="center" class="tabla">
   <tr>
    <td colspan="2">
     <p align="justify" style="line-height:14px; font-size:16px; padding:10px">Con el fin de recibir, encauzar, tramitar y efectuar seguimiento a los trámites y respuestas de las solicitudes recibidas por nuestros usuarios y/o suscriptores, AGUAS DE BUGA S.A. E.S.P a partir del momento en que usted digite el “Código de Confirmación De Su Solicitud” procederá a dar cumplimiento al procedimiento para el trámite de peticiones, quejas y los recursos, señalando la existencia de un plazo preventorio de quince (15) días hábiles siguientes a la radicación de la presente información para que se produzca una respuesta o en su defecto una solicitud de ampliación de este termino para la práctica de pruebas, de ser necesarias previa notificación. Expresamente se contempla que el silencio administrativo positivo opera de pleno derecho una vez vencido el término de los quince (15) días hábiles para resolver las solicitudes y recursos, siendo de aclarar que el reconocimiento del silencio administrativo referido no requiere solicitud de parte, ni requisitos adicionales.</p>
     <!-- <input name="_capcha" id="_capcha" type="hidden" value="<?php  echo($_SESSION['capcha-solicitud']); ?>">-->
    </td></tr>
   <tr><td colspan="2" align="center"><img src='modulos/solicitudes/imagenes/capcha.php' id='capcha' border='0' class='imgcapcha' /></td></tr>
   <tr>
    <td align="right">Escriba el código aquí:<input type="text" id="capcha" name="capcha" class="required validate-numeric"></td>
    <td align="left"><input type="submit" value="Enviar solicitud" name="enviar" id="enviar"></td>
   </tr>
  </table>
 </div>
 <script type="text/javascript">
  new OverText('nombres', {positionOptions: {offset: {x: 2, y: 2}}});
  new OverText('apellidos', {positionOptions: {offset: {x: 2, y: 2}}});
  new OverText('identificacion', {positionOptions: {offset: {x: 2, y: 2}}});
  new OverText('telefono', {positionOptions: {offset: {x: 2, y: 2}}});
  new OverText('correo', {positionOptions: {offset: {x: 2, y: 2}}});
  new OverText('direccion', {positionOptions: {offset: {x: 2, y: 2}}});
  new OverText('referencia', {positionOptions: {offset: {x: 2, y: 2}}});
 </script>
<?php  } else { ?>
 <?php 
//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\ Se reciben los datos del formulario.
 ?>
 <?php 
 // Almacenar en la base de datos
 $valor['solicitud'] = @$_REQUEST['solicitud'];
 $valor['dane'] = "0076111000";
 $valor['servicio'] = @$_REQUEST['servicio'];
 $valor['radicado'] = @$_REQUEST['solicitud']; // El radicado es igual al codigo de la solicitud
 $valor['radicacion'] = $fechas->hoy();
 $valor['asunto'] = @$_REQUEST['asunto'];
 $asunto = $asuntos->consultar($valor['asunto']);
 $valor['categoria'] = $asunto['categoria'];
 $valor['causal'] = $asunto['causal'];
 $valor['detalle'] = @$_REQUEST['detalle'];
 $valor['suscriptor'] = @$_REQUEST['suscriptor'];
 $valor['factura'] = @$_REQUEST['factura'];
 $valor['respuesta'] = @$_REQUEST['respuesta'];
 $valor['contestacion'] = @$_REQUEST['contestacion'];
 $valor['radicada'] = @$_REQUEST['radicada'];
 $valor['notificado'] = @$_REQUEST['notificado'];
 $valor['notificacion'] = @$_REQUEST['notificacion'];
 $valor['sspd'] = @$_REQUEST['sspd'];
 $valor['creador'] = '0000000000';
 $valor['fecha'] = $fechas->hoy();
 $valor['nombres'] = $cadenas->capitalizar(@$_REQUEST['nombres']);
 $valor['apellidos'] = $cadenas->capitalizar(@$_REQUEST['apellidos']);
 $valor['documentos'] = @$_REQUEST['documentos'];
 $valor['identificacion'] = @$_REQUEST['identificacion'];
 $valor['nacimiento'] = @$_REQUEST['annos'] . "-" . @$_REQUEST['meses'] . "-" . @$_REQUEST['dias'];
 $valor['sexo'] = @$_REQUEST['sexo'];
 $valor['telefono'] = @$_REQUEST['telefono'];
 $valor['movil'] = @$_REQUEST['movil'];
 $valor['correo'] = @$_REQUEST['correo'];
 $valor['pais'] = @$_REQUEST['pais'];
 $valor['region'] = @$_REQUEST['region'];
 $valor['ciudad'] = @$_REQUEST['ciudad'];
 $valor['sector'] = @$_REQUEST['sector'];
 $valor['direccion'] = $cadenas->capitalizar(@$_REQUEST['direccion']);
 $valor['referencia'] = $cadenas->capitalizar(@$_REQUEST['referencia']);
 $valor['expiracion'] = $fechas->sumar_diashabiles($valor['radicacion'], 15);

 $pqrs->solicitudes_crear($valor['solicitud']);
 $numero = count($valor);
 $tags = array_keys($valor);
 $valores = array_values($valor);
 for ($i = 0; $i < $numero; $i++) {
  $pqrs->actualizar($valor['solicitud'], $tags[$i], $valores[$i]);
 }
 ?>
 <table align="center" class="tabla"><tr><td><h2>Radicación Realizada</h2></td></tr></table>
 <table align="center" class="tabla">
  <tr><td>
    <div id="i100x100_seguro" style="float: left;"></div>
    <p align="justify" style=" border:1px; line-height:16px; font-size:16px; padding-right:10px">
     Señor Usuario/Suscriptor Tenga en Cuenta los Términos para Responder las PQR. Aguas De Buga S.A. E.S.P deberá
     resolver la PQR presentada, dentro de los quince (15) días hábiles siguientes a su recibo, este término podrá ampliarse
     si hay lugar a la práctica de pruebas, situación que Aguas De Buga S.A. E.S.P le dará a conocer. En caso que usted no
     reciba respuesta de nuestra parte se aplicará lo relacionado con el silencio administrativo positivo. Recuerde
     conservar el código asignado a su solicitud, de haber proporcionado una dirección de correo electrónico una copia
     del código de su solicitud le ha sido enviada automáticamente.</p><br><br><br>
    <p align="center" style="font-size:50px; padding:25px"><?php  echo($_REQUEST['solicitud']); ?></p>
   </td></tr>
 </tbody></table>
<?php  } ?>
<?php 
if (empty($accion)) {
 echo('</div>');
 echo('</form>');
 echo('</div>');
}
?>

<?php  if (empty($accion)) { ?>
 <script type="text/javascript">

  var ckInstance;
  function CKupdate() {
   ckInstance.updateElement();
  }
  ckInstance = CKEDITOR.replace('detalle');






  if ($('servicio')) {
   $('servicio').addEvent('change', function(e) {
    var servicio = this.getElement(':selected').value;
    $('asunto').empty();
    var parametros = {'servicio': servicio};
    var datos = JSON.encode(parametros);
    new Request.JSON({
     url: 'modulos/solicitudes/externo/jsons/asuntos.json.php',
     data: "datos=" + datos,
     onRequest: function() {
      MUI.Notificacion("Actualizando...");
     },
     onComplete: function(djson) {
      var opciones = djson.opciones;
      for (var i = 0; i < opciones.length; i++) {
       new Element('option', {text: opciones[i].descripcion, value: opciones[i].asunto}).inject($('asunto'));
      }
     }
    }).send();

   });
  }



  var fv =new Form.Validator.Inline($('<?php  echo($formulario['id'] ); ?>'));
  new Form.Request($('<?php  echo($formulario['id'] ); ?>'), $('<?php  echo($formulario['interno'] ); ?>'), {
   requestOptions: {
    spinnerOptions: {
     message: 'Trasmitiendo datos...'
    }
   },
   onSend: function() {
   },
   onSuccess: function() {
    //if ($('<?php  echo($formulario['interno'] ); ?>') && MUI.options.standardEffects == true) {
    //$('<?php  echo($formulario['interno'] ); ?>').setStyle('opacity', 0).get('morph').start({'opacity': 1});
    // }

   }
  });

 </script>
<?php  } ?>