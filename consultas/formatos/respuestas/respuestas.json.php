<?php
$root = (!isset($root)) ? "../../../../../" : $root;
require_once($root . "modulos/comercial/librerias/Configuracion.cnf.php");
/* 
 * Copyright (c) 2014, Alexis
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * * Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 * * Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */


$sesion = new Sesion();
$automatizaciones = new Automatizaciones();
$usuarios = new Usuarios();
$suscriptores = new Suscriptores();
$cadenas = new Cadenas();
$fechas = new Fechas();
$solicitudes = new Solicitudes();
$respuestas = new Respuestas();
$notificaciones = new Notificaciones();

$usuario = $usuarios->consultar($sesion->consultar("usuario"));

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

//if (!empty($buscar)) {
//  $buscar = "WHERE(" . $automatizaciones->like($tabla, $buscar) . " AND( `creador`='" . $usuario['usuario'] . "' OR `responsable`='" . $usuario['usuario'] . "' OR `equipo`='" . $usuario['equipo'] . "'))";
//} else {
//  $buscar = "WHERE( `creador`='" . $usuario['usuario'] . "' OR `responsable`='" . $usuario['usuario'] . "')";
//}


$db = new MySQL();
$sql['sql'] = "SELECT `formato`,`nombre`,`descripcion`,`fecha`,`hora`,`creador` FROM `solicitudes_respuestas_formatos` " . $buscar . " ;";
//echo($sql['sql']);
$consulta = $db->sql_query($sql['sql']);
$fila = $db->sql_fetchrow($consulta);
$total = $db->sql_numrows();

$limit = "";

if ($pagination) {
  $limit = "LIMIT $n, $perpage";
}

$consulta = $db->sql_query("SELECT `formato`,`nombre`,`descripcion`,`fecha`,`hora`,`creador` FROM `solicitudes_respuestas_formatos` " . $buscar . " ORDER BY `formato` DESC " . $limit);

$ret = array();
while ($fila = $db->sql_fetchrow($consulta)) {

  array_push($ret, $fila);
}
$db->sql_close();
echo json_encode(array("page" => $page, "total" => $total, "data" => $ret));
?>

  
