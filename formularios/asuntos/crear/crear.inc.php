<?php 
$root = (!isset($root)) ? "../../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");

$sesion =new Sesion();
$transaccion = @$_REQUEST['transaccion'];
$accion = @$_REQUEST['accion'];
$formulario =new Formularios($transaccion);
echo($formulario->apertura());
//Campos
$campo['asunto'] = $componentes->text('asunto', time(), '32', 'required', true, false, "[ Requerido ]");
$campo['servicio'] = $servicios->combo("servicio" . $transaccion, @$_REQUEST['servicios']);
$campo['categoria'] = $categorias->combo("categoria" . $transaccion, @$_REQUEST['categorias']);
$campo['causal'] = $causales->combo("causal" . $transaccion, @$_REQUEST['causales'], "01", "04");
$campo['descripcion'] = $componentes->text('descripcion', '', '32', 'required', false, false, "[ Requerido ]");
$campo['claves'] = $componentes->text('claves', '', '32', 'required', false, false, "[ Requerido ]");
$campo['registrar'] = "<input name=\"registrar" . $transaccion . "\"  id=\"registrar" . $transaccion . "\" type=\"submit\" value=\"Registrar\"/>";
?>
<style>
 #divFormulario{ font-size: 20px; position: relative; border: 1px; border-color: #CCCCCC; width: 620px; }
 #divFormulario p{ font-size: 16px; line-height: 15px;}
 #divFormulario .grupo {display:table; width:619px; border:1px solid #cccccc; }
 #divFormulario .grupo h2{ font-size: 16px; padding-left: 16px;}
 #divFormulario .titular{ font-size: 14px; font-style: bold; width: 100%; height: 18px; background-color: #EEEEEE; text-align: center;}
 #divFormulario .row {display:table; width:100%;}
 #divFormulario .cell {background-color: #EEEEEE; border: 1px solid #F6F7F8;border-collapse: collapse;border-spacing: 0;display: table-cell;padding: 4px;vertical-align: top; }
 #divFormulario input[type='text']{border: 1px solid #CCCCCC;font-size: 16px;height: 20px !important;padding: 0; width: 100%; }
 #divFormulario input[type='button'],input[type='submit']{-moz-border-bottom-colors: none;-moz-border-left-colors: none;-moz-border-right-colors: none;-moz-border-top-colors: none;background: -moz-linear-gradient(center top , #FFFFFF, #E4E4E4) repeat scroll 0 0 #E4E4E4;border-color: #A6A6A6 #A6A6A6 #979797;border-image: none;border-radius: 3px 3px 3px 3px;border-style: solid;border-width: 1px;box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5), 0 0 2px rgba(255, 255, 255, 0.15) inset, 0 1px 0 rgba(255, 255, 255, 0.15) inset;float: left;margin: 0 6px 5px 0;outline: 0 none;padding: 4px 6px;}
 #divFormulario select {border: 1px solid #CCCCCC;font-size: 16px;height: 22px;padding: 0;width: 100%;}
 #divFormulario .herramientas {float: left;}
 #divFormulario .enunciado {display: none;}
 #divFormulario .inicio{}
 #divFormulario .controles {-moz-border-bottom-colors: none;-moz-border-left-colors: none;-moz-border-right-colors: none;-moz-border-top-colors: none;background: -moz-linear-gradient(center top , #FFFFFF, #E4E4E4) repeat scroll 0 0 #E4E4E4;border-color: #A6A6A6 #A6A6A6 #979797;border-image: none;border-radius: 3px 3px 3px 3px;border-style: solid;border-width: 1px;box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5), 0 0 2px rgba(255, 255, 255, 0.15) inset, 0 1px 0 rgba(255, 255, 255, 0.15) inset;float: left;margin: 0 6px 5px 0;}
 #divFormulario a.boton {border: 0 none;cursor: default;display: inline-block;float: left;height: 18px;outline: 0 none;padding: 4px 6px;}
 #divFormulario a.boton:hover,a.boton:focus,a.boton:active{opacity:.2;-moz-box-shadow:0 1px 6px rgba(0,0,0,.7) inset,0 1px 0 rgba(0,0,0,.2);-webkit-box-shadow:0 1px 6px rgba(0,0,0,.7) inset,0 1px 0 rgba(0,0,0,.2);box-shadow:0 1px 6px rgba(0,0,0,.7) inset,0 1px 0 rgba(0,0,0,.2)}
 #divFormulario .icono {background-repeat: no-repeat;cursor: inherit;display: inline-block;float: left;height: 16px;margin-top: 1px;width: 16px;}
 #divFormulario .etiqueta {color: #474747;cursor: default;display: none;float: left;line-height: 17px;margin-top: 1px;padding-left: 3px;text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);vertical-align: middle;}
 #divFormulario .final{}
 #divFormulario #botonAyuda .icono{background-image:url(http://127.0.0.1/agb/scripts/ckeditor/plugins/icons.png?t=D08E); background-position:0 0px;}
 #divFormulario #asunto {background-color: lightgreen;border-color: #008000;color: #008000;text-align: center;text-transform: capitalize;width: 100px;}
 .validation-passed {background-color: lightgreen !important;}
 .validation-failed {border-color: red;}
 .validation-advice {color: #FFFFFF;font-size: 11px;line-height: 11px;}
 .overTxtLabel {color: #CCCCCC;}
</style>
<input type="hidden" name="accion" value="registrar" />
<div id="divFormulario">
 <div class="row">
  <div class="cell" style=""><div class="titular">Código: </div><?php  echo($campo['asunto']); ?></div>
  <div class="cell" style=""><div class="titular">Servicio: </div><?php  echo($campo['servicio']); ?></div>
  <div class="cell" style=""><div class="titular">Categorías: </div><?php  echo($campo['categoria']); ?></div>
  <div class="cell" style="" id="cellCausal<?php  echo($transaccion); ?>" ><div class="titular">Causal: </div><div id="divCausal<?php  echo($transaccion); ?>"><?php  echo($campo['causal']); ?></div></div>
 </div>
 <div class="row">
  <div class="cell" style=""><div class="titular">Descripción: </div><?php  echo($campo['descripcion']); ?></div>
 </div>
 <div class="row">
  <div class="cell" style=""><div class="titular">Palabras Claves: </div><?php  echo($campo['claves']); ?></div>
 </div>
 <table align="center">
  <tr><td align="center"> <?php  echo($campo['registrar']); ?></td></tr>
 </table>
</div>
<?php  echo($formulario->cierre()); ?>
<script type="text/javascript">
 MUI.resizeWindow($('<?php  echo($formulario->ventana); ?>'), {width: 640, height: 200, top: 0, left: 0});
 MUI.centerWindow($('<?php  echo($formulario->ventana); ?>'));

 if ($('servicio<?php  echo($transaccion); ?>')) {
  $('servicio<?php  echo($transaccion); ?>').addEvent('change', function(e) {
   actualizacion_causal<?php  echo($transaccion); ?>();
  });
 }

 if ($('categoria<?php  echo($transaccion); ?>')) {
  $('categoria<?php  echo($transaccion); ?>').addEvent('change', function(e) {
   actualizacion_causal<?php  echo($transaccion); ?>();
  });
 }
 function actualizacion_causal<?php  echo($transaccion); ?>() {
  var servicio = $('servicio<?php  echo($transaccion); ?>').getElement(':selected').value;
  var categoria = $('categoria<?php  echo($transaccion); ?>').getElement(':selected').value;
  $("divCausal<?php  echo($transaccion); ?>").empty();
  if (categoria != "01" && categoria != "04") {
   $("cellCausal<?php  echo($transaccion); ?>").hide();
  } else {
   $("cellCausal<?php  echo($transaccion); ?>").show();
  }

  var parametros = {'servicio': servicio, 'categoria': categoria};
  var datos = JSON.encode(parametros);
  new Request.JSON({
   url: 'modulos/solicitudes/consultas/jsons/causales.json.php',
   data: "datos=" + datos,
   requestOptions: {
    spinnerOptions: {
     message: 'Actualizando Causales...'
    }
   },
   onRequest: function() {
    $('spinner').show();
    if ($('<?php  echo($formulario->interno ); ?>') && MUI.options.standardEffects == true) {
     $('<?php  echo($formulario->interno ); ?>').setStyle('opacity', 1).get('morph').start({'opacity': 0});
    }
    MUI.Notificacion("Actualizando...");
   },
   onComplete: function(djson) {
    $('spinner').hide();
    if ($('<?php  echo($formulario->interno ); ?>') && MUI.options.standardEffects == true) {
     $('<?php  echo($formulario->interno ); ?>').setStyle('opacity', 0).get('morph').start({'opacity': 1});
    }
    var objeto = djson.objeto;
    var dhtml = djson.html;
    new Element('div', {html: dhtml}).inject('divCausal<?php  echo($transaccion); ?>', 'top');
   }
  }).send();
 }

</script>