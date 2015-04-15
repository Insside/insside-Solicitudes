<?php 

$root = (!isset($root)) ? "../../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");

$jdatos = json_decode($_REQUEST['datos']);
foreach ($jdatos as $nombre => $valor) {
 $datos[$nombre] = $valor;
}
$servicio = $datos['servicio'];

$db =new MySQL();
$sql['sql'] = "SELECT * FROM `solicitudes_asuntos` WHERE `servicio` ='" . $servicio . "' ORDER BY `asunto`;";
//echo($sql['sql']);
$result = $db->sql_query($sql['sql']);
$fila = $db->sql_fetchrow($result);
$total = $db->sql_numrows();
$ret = array();
while ($fila = $db->sql_fetchrow($result)) {
 array_push($ret, $fila);
}
$db->sql_close();
$ret = array("total" => $total, "opciones" => $ret);
echo json_encode($ret);
?>