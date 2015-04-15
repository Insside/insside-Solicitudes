<?php

$root = (!isset($root)) ? "../../../../" : $root;
require_once($root . "modulos/comercial/librerias/Configuracion.cnf.php");
$sesion = new Sesion();
$automatizaciones = new Automatizaciones();
$suscriptores = new Suscriptores();
$cadenas = new Cadenas();
$fechas = new Fechas();

/** Variables Recibidas * */
$transaccion = @$_REQUEST['transaccion'];
$estado = @$_REQUEST['estado'];
$buscar = @$_REQUEST['buscar'];
$opcion = @$_REQUEST["opcion"];

/* * Variables Definidas * */

$tabla = "solicitudes_solicitudes";

$page = 1;
$perpage = 50;
$n = 0;
$pagination = false;

if (isset($_REQUEST["page"])) {
  $pagination = true;
  $page = intval($_REQUEST["page"]);
  $perpage = intval($_REQUEST["perpage"]);
  $n = ( $page - 1 ) * $perpage;
}

if (!empty($buscar)) {
  if (!empty($opcion)) {
    if ($opcion == "recibidas") {
      $buscar = "WHERE(" . $automatizaciones->like($tabla, $buscar) . " AND `creador`='" . $sesion->consultar('usuario') . "')";
    } else {
      $buscar = "WHERE(" . $automatizaciones->like($tabla, $buscar) . ")";
    }
  } else {
    $buscar = "WHERE(" . $automatizaciones->like($tabla, $buscar) . ")";
  }
} else {
  if (!empty($opcion)) {
    if ($opcion == "recibidas") {
      $buscar = "WHERE(`creador`='" . $sesion->consultar('usuario') . "')";
    } else {
      $buscar = "";
    }
  } else {
    $buscar = "";
  }
}



$db = new MySQL();
$sql['sql'] = "SELECT * FROM `solicitudes_solicitudes` " . $buscar . " ;";
//echo($sql['sql']);
$consulta = $db->sql_query($sql['sql']);
$fila = $db->sql_fetchrow($consulta);
$total = $db->sql_numrows();

$limit = "";

if ($pagination) {
  $limit = "LIMIT $n, $perpage";
}

$consulta = $db->sql_query("SELECT * FROM `solicitudes_solicitudes` " . $buscar . " ORDER BY `solicitud` DESC " . $limit);

$ret = array();
while ($fila = $db->sql_fetchrow($consulta)) {

  $nombre = $cadenas->capitalizar($fila['nombres'] . " " . $fila['apellidos']);
  $direccion = (!empty($fila['instalacion'])) ? $fila['instalacion'] : $fila['direccion'];
  $detalles = $cadenas->capitalizar($direccion) . " <i>Tels: " . $fila['telefono'] . " " . $fila['movil'] . "</i>";
  $servicio = $servicios->consultar($fila['servicio']);
  $servicio = "<a href=\"#\" title=\"Estado\" onclick=\"parent.MUI.Notificacion('" . $servicio['nombre'] . "');\"><img src=\"imagenes/16x16/" . ($servicio['icono']) . "\" width=\"16\" height=\"16\"/>";
  $asunto = $asuntos->consultar($fila['asunto']);
  $estado = (!empty($fila['respuesta'])) ? "verde" : "rojo";
  $fila['estado'] = "<a href=\"#\" title=\"Estado\" onclick=\"MUI.Notificacion('" . @$fila['radicada'] . "');\"><img src=\"imagenes/16x16/" . ($estado) . ".png\" width=\"16\" height=\"16\"/>";
  $fila['detalles'] = "<span><b>" . $nombre . "</b> <i>" . $detalles . "</i><span>";
  $fila['servicio'] = $servicio;
  $dias_habiles = $fechas->habiles($fila['radicacion'], $fechas->hoy());
  $fila['tiempo'] = $dias_habiles["conteo"];
  $fila['codigo'] = "<div class=\"codigo\"><a href=\"#\" onClick=\"MUI.Solicitudes_Solicitud_Consultar('" . $fila['solicitud'] . "');\">" . $fila['solicitud'] . "</a></div>";
  //$fila['razon'] = $cadenas->capitalizar($fila['razon']);
  //$fila['direccion'] = $cadenas->capitalizar($fila['direccion']);
  //$fila['rut'] = "<div class=\"numero\">" . $fila['rut'] . ((!empty($fila['digito'])) ? "-" . $fila['digito'] : "") . "</div>";
  //$fila['tipo'] = $cadenas->capitalizar($fila['tipo']);
  $fila['creador'] = "&nbsp;<a href=\"#\" onClick=\"MUI.Raiz_Creador('" . $fila['creador'] . "');\"><img src=\"imagenes/16x16/usuario-16x16.png\"></a>";
  array_push($ret, $fila);
}
$db->sql_close();
echo json_encode(array("page" => $page, "total" => $total, "data" => $ret));
?>