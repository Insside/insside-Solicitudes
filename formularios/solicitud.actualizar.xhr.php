<?php

$root = (!isset($root)) ? "../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
$transaccion = isset($_REQUEST['transaccion']) ? $_REQUEST['transaccion'] : time();
$archivos = new _Archivos();

$solicitudes = new Solicitudes();
$solicitud = $solicitudes->consultar(@$_REQUEST['solicitud']);

$f = new Formularios($transaccion);
$v['categoria'] = @$_REQUEST['categoria'];
echo($f->apertura());
$html['tabs'] = "<div class=\"toolbarTabs" . $transaccion . "\">";
$html['tabs'].="<ul id=\"featuresTabs" . $transaccion . "\" class=\"tab-menu\">";
$html['tabs'].="<li class=\"selected\"><a href=\"#\" title=\"Perfiles\" id=\"tabPerfiles" . $transaccion . "\">Perfiles</a></li>";
$html['tabs'].="<li><a href=\"#\" title=\"Solicitud\" id=\"tabSolicitud" . $transaccion . "\">Solicitud</a></li>";
if (!empty($solicitud['respuesta'])) {
  $html['tabs'].="<li><a href=\"#\" title=\"Respuesta\" id=\"tabRespuesta" . $transaccion . "\">Respuesta</a></li>";
}
$html['tabs'].="</ul>";
$html['tabs'].="<div class=\"clear\"></div>";
$html['tabs'].="</div>";
$f->filas($html['tabs']);

if (!isset($_REQUEST['trasmision'])) {
  require_once($root . "modulos/solicitudes/formularios/solicitud/actualizar/solicitud.inc.php");
} else {
  require_once($root . "modulos/solicitudes/formularios/solicitud/actualizar/solicitud.procesador.inc.php");
  require_once($root . "modulos/solicitudes/formularios/solicitud/actualizar/solicitud.inc.php");
}

$html['js'] = "<script type=\"text/javascript\">";
$html['js'] .="MUI.initializeTabs('featuresTabs" . $transaccion . "');";
$html['js'] .="$('perfiles" . $transaccion . "').show();";
$html['js'] .="$('solicitud" . $transaccion . "').hide();";


$html['js'] .="if (\$('tabPerfiles" . $transaccion . "')) {";
$html['js'] .="$('tabPerfiles" . $transaccion . "').addEvent('click', function(e) {";
$html['js'] .="$('perfiles" . $transaccion . "').show();";
$html['js'] .="$('solicitud" . $transaccion . "').hide();";
$html['js'] .="$('respuesta" . $transaccion . "').hide();";
$html['js'] .="if ($('" . $f->interno . "') && MUI.options.standardEffects == true) {";
$html['js'] .="$('" . $f->interno . "').setStyle('opacity', 0).get('morph').start({'opacity': 1});";
$html['js'] .="}";
$html['js'] .="  });";
$html['js'] .="}";

$html['js'] .="if (\$('tabSolicitud" . $transaccion . "')) {";
$html['js'] .="$('tabSolicitud" . $transaccion . "').addEvent('click', function(e) {";
$html['js'] .="$('perfiles" . $transaccion . "').hide();";
$html['js'] .="$('solicitud" . $transaccion . "').show();";
$html['js'] .="$('respuesta" . $transaccion . "').hide();";
$html['js'] .="if ($('" . $f->interno . "') && MUI.options.standardEffects == true) {";
$html['js'] .="$('" . $f->interno . "').setStyle('opacity', 0).get('morph').start({'opacity': 1});";
$html['js'] .="}";
$html['js'] .="  });";
$html['js'] .="}";


$html['js'] .="</script>";
$f->filas($html['js']);
echo($f->generar());
echo($f->controles());
echo($f->cierre());
?>