<?php

$root = (!isset($root)) ? "../../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
//\\ La consulta se realiza recibiendo el parametro suscriptor
//\\ en formato JSON, el parametro es extraido de los datos
//\\ del JSON para ser utilizado.
//\\ $suscriptor=@$_REQUEST['suscriptor'];// Para probar si funciona
//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
//echo('<pre>');
//print_r($_REQUEST);
//echo('</pre>');
$causales = new Causales();
$jdatos = json_decode($_REQUEST['datos']);
foreach ($jdatos as $nombre => $valor) {
  $datos[$nombre] = $valor;
}
$fid = $datos['fid'];
$name = "causal" . $fid;
$causal = @$datos['causal'];
$servicio = $datos['servicio'];
$categoria = $datos['categoria'];
$clase = @ $datos['clase'];
$change = @$datos['change'];

$dato['objeto'] = "select";
$dato['servicio'] = $servicio;
$dato['categoria'] = $categoria;
$dato['html'] = $causales->combo($name, $causal, $servicio, $categoria, $clase, $change);
echo json_encode($dato);
?>