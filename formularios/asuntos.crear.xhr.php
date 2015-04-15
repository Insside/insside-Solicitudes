<?php 
/**
 * Este formulario permite crear una solicitud.
 * Para poder utilizarlo se requiere que el usuario en sus roles asignados disponga del permiso
 * SUSCRIPTORES-SOLICITUDES-U
 */
$root = (!isset($root)) ? "../../../" : $root;
require_once($root . "modulos/distribucion/librerias/Configuracion.cnf.php");
$suscriptores =new Suscriptores();
//\\//\\//\\//\\ Variables Generadas //\\//\\//\\//\\
$sesion =new Sesion();
$transaccion = @$_REQUEST['transaccion'];
$accion = @$_REQUEST['accion'];
$formulario =new Formularios($transaccion);
echo($formulario->apertura());

$numero = count($_REQUEST);
$tags = array_keys($_REQUEST);
$valores = array_values($_REQUEST);
for ($i = 0; $i < $numero; $i++) {
 echo('<input name="_' . str_replace("_", "", $tags[$i]) . '" id="_' . str_replace("_", "", $tags[$i]) . '" type="hidden" value="' . $valores[$i] . '" />');
}
if (empty($accion)) {
 require_once($root . "modulos/solicitudes/formularios/asuntos/crear/crear.inc.php");
} else {
 require_once($root . "modulos/solicitudes/formularios/asuntos/crear/fin.inc.php");
}
echo($formulario->cierre());
?>
<?php  if (empty($accion)) { ?>
 <script type="text/javascript">
  var fv =new Form.Validator.Inline($('<?php  echo($formulario->id); ?>'));
  new Form.Request($('<?php  echo($formulario->id); ?>'), $('<?php  echo($formulario->interno); ?>'), {
   requestOptions: {
    spinnerOptions: {
     message: 'Trasmitiendo datos...'
    }
   },
   onSend: function() {
    $('spinner').show();
   },
   onSuccess: function() {
    $('spinner').hide();

    if ($('<?php  echo($formulario->interno ); ?>') && MUI.options.standardEffects == true) {
     $('<?php  echo($formulario->interno ); ?>').setStyle('opacity', 0).get('morph').start({'opacity': 1});
    }
    // MUI.closeWindow($('<?php  echo($formulario->ventana); ?>'));
   }
  });
 </script>
<?php  } ?>
