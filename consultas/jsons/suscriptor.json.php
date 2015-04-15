<?php 
$root = (!isset($root)) ? "../../../../" : $root;
require_once($root . "modulos/suscriptores/librerias/Configuracion.cnf.php");
//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
//\\ La consulta se realiza recibiendo el parametro suscriptor
//\\ en formato JSON, el parametro es extraido de los datos
//\\ del JSON para ser utilizado.
//\\ $suscriptor=@$_REQUEST['suscriptor'];// Para probar si funciona
//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
$jdatos = json_decode($_REQUEST['datos']);
foreach ($jdatos as $nombre => $valor) {
 $datos[$nombre] = $valor;
}
$suscriptor = $datos['suscriptor'];
$db =new MySQL();
$acentos = $db->sql_query("SET NAMES 'utf8'");
$sql = "SELECT * FROM `suscriptores` WHERE(`suscriptor`='" . $suscriptor . "') ORDER BY `suscriptor`";
$consulta = $db->sql_query($sql);
$fila = $db->sql_fetchrow($consulta);
$fila['nombre'] = $cadenas->capitalizar(@$fila['nombres'] . ' ' . @$fila['apellidos']);
$fila['direccion'] = $cadenas->capitalizar(@$fila['direccion']);
$db->sql_close();
echo json_encode($fila);
?>