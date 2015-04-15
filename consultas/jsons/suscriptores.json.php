<?php

/**
 * Este archivo retorna el resultado de una consulta sobre el listadod e suscriptores en formto JSON
 * responde a una variable llamada busqueda que define el patron del dato a buscar y una variable llamada
 * criterio que de ser recibida delimita la busqueda del patron la los registros consultando un campo
 * especifico de los mismos
 * */
$root = (!isset($root)) ? "../../../../" : $root;
require_once($root . "modulos/suscriptores/librerias/Configuracion.cnf.php");
$cadenas = new Cadenas();
//------ Variables Reibidas
/* @var $criterio type String Representa en campo a buscar */
/* @var $buscar type String Representa el dato a buscar */
$criterio = @$_REQUEST['criterio'];
$buscar = @$_REQUEST['buscar'];
$pagina = @$_REQUEST['page'];
$cantidad = $_REQUEST["perpage"];
//---- Definiendo la expresión SQL de busqueda
if (!empty($criterio) && !empty($buscar)) {
  $buscar = "WHERE `" . $criterio . "` LIKE '%" . $buscar . "%'";
} else if (!empty($buscar)) {
  $buscar = "WHERE `suscriptor` LIKE '%" . $buscar . "%' OR `identificacion` LIKE '%" . $buscar . "%' OR `nombres` LIKE '%" . $buscar . "%' OR `apellidos` LIKE '%" . $buscar . "%' OR `direccion` LIKE '%" . $buscar . "%' OR `referencia` LIKE '%" . $buscar . "%' OR `estrato` LIKE '%" . $buscar . "%' OR `predial` LIKE '%" . $buscar . "%' OR `latitud` LIKE '%" . $buscar . "%' OR `longitud` LIKE '%" . $buscar . "%' OR `correo` LIKE '%" . $buscar . "%' OR `telefonos` LIKE '%" . $buscar . "%' OR `creado` LIKE '%" . $buscar . "%' OR `actualizado` LIKE '%" . $buscar . "%' OR `creador` LIKE '%" . $buscar . "%' OR `actualizador` LIKE '%" . $buscar . "%' OR `diametro` LIKE '%" . $buscar . "%' ";
} else {
  $buscar = "";
}
//----------------------------------------------------
$page = 1;
$perpage = 50;
$n = 0;
$pagination = false;

if (!empty($pagina)) {
  $pagination = true;
  $page = intval($pagina);
  $perpage = intval($cantidad);
  $n = ( $page - 1 ) * $perpage;
}
//$sorton = @$_REQUEST["sorton"];
//$sortby = @$_REQUEST["sortby"];
$db = new MySQL();
$acentos = $db->sql_query("SET NAMES 'utf8'");
$sql['sql'] = "SELECT * FROM `suscriptores` " . $buscar . " ;";
//echo($sql['sql']);
$result = $db->sql_query($sql['sql']);
$fila = $db->sql_fetchrow($result);
$total = $db->sql_numrows();

$limit = "";

if ($pagination) {
  $limit = "LIMIT $n, $perpage";
}
$result = $db->sql_query("
 SELECT
 `suscriptores`.`suscriptor`,
 `suscriptores`.`nombres`,
 `suscriptores`.`apellidos`,
 `suscriptores`.`referencia`,
 `suscriptores`.`direccion`,
 `suscriptores`.`telefonos`,
 `suscriptores`.`latitud`,
 `suscriptores`.`longitud`
FROM `suscriptores` " . $buscar . "
ORDER BY `suscriptor` DESC " . $limit . "");

$ret = array();
while ($fila = $db->sql_fetchrow($result)) {
  $suscriptor = "<a href=\"#\" onClick=\"MUI.Suscriptores_Suscriptor_Visualizar('" . $fila['suscriptor'] . "');\">" . $fila['suscriptor'] . "</a>";
  $nombre = $cadenas->capitalizar($fila['nombres'] . " " . $fila['apellidos']);
  $direccion = $cadenas->capitalizar($fila['direccion'] . " " . $fila['referencia']);
  $detalles = "<b>" . $nombre . "</b>" . " <i>Dirección: " . $direccion . "</i>";
  $fila['detalles'] = $detalles;
  $fia['suscriptor'] = $suscriptor;
  $fila['gis'] = (isset($fila['latitud']) && isset($fila['longitud'])) ? "<img src=\"imagenes/16x16/geo-16x16.png\" width=\"16\" height=\"16\" >" : "";
  $fila['suscriptor'] = $suscriptor;
  array_push($ret, $fila);
}
$db->sql_close();
$ret = array("page" => $page, "total" => $total, "data" => $ret);
echo json_encode($ret);
?>