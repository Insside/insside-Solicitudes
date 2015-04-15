<?php 
$root = (!isset($root)) ? "../../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");

//\\//\\//\\//\\ Variables Generadas //\\//\\//\\//\\
$sesion =new Sesion();
$suscriptores =new Suscriptores();
$componentes =new Componentes();
$sectores =new Sectores();
$servicios =new Servicios();
$categorias =new Categorias();
$fechas =new Fechas();
$asuntos =new Asuntos();
$causales =new Causales();

$transaccion = @$_REQUEST['transaccion'];
$solicitud = $solicitudes->consultar($_REQUEST['solicitud']);
$categoria = $categorias->consultar($solicitud['categoria']);
$solicitud['categoria'] = $solicitud['categoria'] . ":" . $categoria['nombre'];
$asunto = $asuntos->consultar($solicitud['asunto']);
$solicitud['asunto'] = $asunto['asunto'] . ": " . $asunto['descripcion'];
$causal = $causales->consultar($solicitud['servicio'], $solicitud['causal']);
$solicitud['causal'] = $solicitud['causal'] . ":" . $causal['titulo'];
$servicio = $servicios->consultar($solicitud['servicio']);
$solicitud['servicio'] = $solicitud['servicio'] . ":" . $servicio['nombre'];


$formulario['id'] = "f" . $transaccion;
$formulario['ventana'] = "v" . $transaccion;
$formulario['contenedor'] = "c" . $transaccion;
$formulario['interno'] = "i" . $transaccion;

$campo['nombres'] = '<div id="nombres">' . @$solicitud['nombres'] . '</div>';
$campo['apellidos'] = '<div id="apellidos">' . @$solicitud['apellidos'] . '</div>';
$campo['identificacion'] = '<div id="identificacion">' . @$solicitud['documentos'] . " " . @$solicitud['identificacion'] . '</div>';
$campo['nacimiento'] = '<div id="nacimiento">' . @$solicitud['nacimiento'] . '</div>';
$campo['sexo'] = '<div id="nacimiento">' . @$solicitud['sexo'] . '</div>';
$campo['telefono'] = '<div id="telefono">' . @$solicitud['telefono'] . '</div>';
$campo['movil'] = '<div id="movil">' . @$solicitud['movil'] . '</div>';
$campo['correo'] = '<div id="correo">' . @$solicitud['correo'] . '</div>';
$campo['pais'] = '<div id="pais">' . @$solicitud['pais'] . '</div>';
$campo['region'] = '<div id="region">' . @$solicitud['region'] . '</div>';
$campo['ciudad'] = '<div id="ciudad">' . @$solicitud['ciudad'] . '</div>';
$campo['sector'] = '<div id="sector">' . @$solicitud['sector'] . '</div>';
$campo['direccion'] = '<div id="direccion">' . @$solicitud['direccion'] . '</div>';
$campo['referencia'] = '<div id="referencia">' . @$solicitud['referencia'] . '</div>';
$campo['servicio'] = '<div id="servicio">' . @$solicitud['servicio'] . '</div>';
$campo['categoria'] = '<div id="categoria">' . @$solicitud['categoria'] . '</div>';
$campo['causal'] = '<div id="causal">' . @$solicitud['causal'] . '</div>';
$campo['asunto'] = '<div id="asunto">' . @$solicitud['asunto'] . '</div>';
$campo['detalle'] = '<div id="detalle">' . @$solicitud['detalle'] . '</div>';


if (empty($accion)) {
 echo('<div id="' . $formulario['contenedor'] . '" class="formulario">');
 echo('<form name="' . $formulario['id'] . '" id="' . $formulario['id'] . '" action="modulos/solicitudes/externo/formularios/radicacion.xhr.php?&transaccion=' . $transaccion . '" method="post">');
 echo('<div id="' . $formulario['interno'] . '">');
}
?>
<style>
 #divSolicitud{ position: relative; border: 1px; border-color: #CCCCCC; width: 100%; }
 #divSolicitud  h2{   border: 1px solid #CCCCCC;display: block;font-size: 16px;font-weight: bold;height: 26px;line-height: 30px;margin-top: 10px;margin-bottom: 0px;padding-left: 20px;text-align: left;}
 #divSolicitud .titular{ font-size: 12px; font-style: bold; width: 100%; height: 18px; background-color: #EEEEEE}
 #divSolicitud .row {display:table; width:100%; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; border-right: 1px solid #cccccc; }
 #divSolicitud .cell {display:table-cell;vertical-align:top; border-right:1px solid #cccccc; padding:2px;font-size: 18;border-collapse: separate; }
</style>
<?php  if (empty($accion) || $accion == "cancelar") { ?>

 <div id="divSolicitud">
  <input type="hidden" name="accion" id="accion" value="verificar">
  <input type="hidden" id="solicitud" name="solicitud" value="<?php  echo($solicitud); ?>">

  <table align="center" class="tabla"><tbody>
    <tr><td colspan="4">
      <div style="border-top:solid 1px;border-bottom:solid 1px;text-align:center;background-color:#F1F6F9"><div><br>
        <b>ESTADO DE LA SOLICITUD <?php  echo($solicitud['solicitud']); ?></b></div>
       <table><tr><td width="100"><div id="i100x100_seguro" style="float: left;"></div></td><td>
          <p align="justify" style=" border:1px; line-height:16px; font-size:16px; padding-right:10px">
           La información visualizada corresponde a la solicitud tal cual fue radicada en el sistema. En la parte inferior
           se visualizara la respuesta que se dio en atención a su petición con la información correspondiente. <u>Las
         peticiones previas al 1 de Julio del 2013, carecen de información complementaria pues sus datos solo fueron
         cargados con fines estadísticos. A partir de la misma fecha toda petición aparecerá diligenciada con todos
         sus campos a completitud</u>.
        </p></td></tr></table>
       <br></div></td></tr>
   </tbody>
  </table>


  <h2>Datos Personales Del Solicitante</h2>

  <div class="row">
   <div class="cell" style=""><div class="titular">Nombres: </div><?php  echo($campo['nombres']); ?></div>
   <div class="cell" style=""><div class="titular">Apellidos: </div><?php  echo($campo['apellidos']); ?></div>
   <div class="cell" style=""><div class="titular">Identificación: </div><?php  echo($campo['identificacion']); ?></div>
   <div class="cell" style=""><div class="titular">Fecha Nacimiento: </div><?php  echo($campo['nacimiento']); ?></div>
   <div class="cell" style=""><div class="titular">Sexo: </div><?php  echo($campo['sexo']); ?></div>
  </div>
  <div class="row">
   <div class="cell" style=""><div class="titular">Telefono Fijo: </div><?php  echo($campo['telefono']); ?></div>
   <div class="cell" style=""><div class="titular">movil: </div><?php  echo($campo['movil']); ?></div>
   <div class="cell" style=""><div class="titular">Correo electrónico: </div><?php  echo($campo['correo']); ?></div>
  </div>
  <div class="row">
   <div class="cell" style=""><div class="titular">Pais: </div><?php  echo($campo['pais']); ?></div>
   <div class="cell" style=""><div class="titular">Región: </div><?php  echo($campo['region']); ?></div>
   <div class="cell" style=""><div class="titular">Ciudad: </div><?php  echo($campo['ciudad']); ?></div>
   <div class="cell" style=""><div class="titular">Sector / Barrio: </div><?php  echo($campo['sector']); ?></div>
   <div class="cell" style=""><div class="titular">Dirección: </div><?php  echo($campo['direccion']); ?></div>
   <div class="cell" style=""><div class="titular">Referencia: </div><?php  echo($campo['referencia']); ?></div>
  </div>

  <h2>Información De La Solicitud</h2>
  <div class="row">
   <div class="cell" style="width:100px"><div class="titular">Servicio: </div><?php  echo($campo['servicio']); ?></div>
   <div class="cell" style=""><div class="titular">Tipo De Solicitud: </div><?php  echo($campo['categoria']); ?></div>
   <div class="cell" style=""><div class="titular">Causal: </div><?php  echo($campo['causal']); ?></div>
   <div class="cell" style=""><div class="titular">Asunto De Referencia: </div><?php  echo($campo['asunto']); ?></div>
  </div>
  <div class="row">
   <div class="cell" style="width:640px"><div class="titular">Solicitud: </div><?php  echo($campo['detalle']); ?></div>
  </div>
 </div>
<?php  } else { ?>
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

    if ($('<?php  echo($formulario['interno'] ); ?>') && MUI.options.standardEffects == true) {
     $('<?php  echo($formulario['interno'] ); ?>').setStyle('opacity', 0).get('morph').start({'opacity': 1});
    }

   }
  });
 </script>
<?php  } ?>