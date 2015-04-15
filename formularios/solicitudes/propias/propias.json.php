<?php

$root = (!isset($root)) ? "../../../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
header('Content-Type: application/json');

$sesion = new Sesion();
$automatizaciones = new Automatizaciones();
$usuarios = new Usuarios();
$validaciones = new Validaciones();
$suscriptores = new Suscriptores();
$cadenas = new Cadenas();
$fechas = new Fechas();
$solicitudes = new Solicitudes();
$respuestas = new Respuestas();
$notificaciones = new Notificaciones();
/*
 * Copyright (c) 2013, Alexis
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
$usuario = $sesion->usuario();
/** Variables Recibidas * */
$v['criterio'] = $validaciones->recibir("criterio");
$v['valor'] = $validaciones->recibir("valor");
$v['fechainicial'] = $validaciones->recibir("fechainicial");
$v['fechafinal'] = $validaciones->recibir("fechafinal");
$v['transaccion'] = $validaciones->recibir("transaccion");
$v['page'] = $validaciones->recibir("page");
$v['perpage'] = $validaciones->recibir("perpage");
/** Verificaciones * */
/**
 * Se evalua el comportamiento en caso de no recibir el periodo inicial y final de la consulta para lo 
 * cual se presuponen la fecha de la primera solicitud y la ultima que se hallan registrado por
 * el usuario activo en el sistema de atencion de solicitudes.
 */
$v['fechainicial'] = empty($v['fechainicial']) ? "0000-00-00" : $v['fechainicial'];
$v['fechafinal'] = empty($v['fechafinal']) ? "2018-01-01" : $v['fechafinal'];

/* * Variables Definidas * */
if (!empty($v['page'])) {
  $pagination = true;
  $page = intval($v['page']);
  $perpage = intval($v['perpage']);
  $n = ( $page - 1 ) * $perpage;
  $limite = "LIMIT $n, $perpage";
} else {
  $pagination = false;
  $page = 1;
  $perpage = 20;
  $n = 0;
  $limite = "LIMIT $n, $perpage";
}

$db = new MySQL();
/**
 * En este segmento se evalua si se esta recibiendo o no un criterio y un valor a buscar segun el 
 * criterio adicionalmente se contempla la propiedad y responsabilidad del usuario activo sobre los 
 * registros visualizados. En terminos de criterios existe un criterio especial que se utiliza para
 * identificar una peticion en la que solo se desean ver aquellas solicitudes que se encuentran 
 * pendientes de respuesta, ese criterio es "estado", donde no existe ningun campo denominado 
 * estado pero se usa para definir si los registros se muestran como se hace habitualmente o 
 * solamente aquellos que correspondan a peticiones a la espera de respuesta.
 * Nota: $where debe existir ya que en un segmento posterior a este se una como criterio para
 * establecer el numero total de registros que se obtendran establecida la estructura de la
 * consulta.
 * */
if (!empty($v['criterio']) && !empty($v['valor'])) {
  if ($v['criterio'] == "estado" && $v['valor'] == 'pendientes') {
    $where = "WHERE("
            . "(`solicitudes_solicitudes`.`solicitud`=`solicitudes_respuestas`.`solicitud`)AND"
            . "(`solicitudes_solicitudes`.`creador`='" . $usuario['usuario'] . "' OR `solicitudes_solicitudes`.`responsable`='" . $usuario['usuario'] . "')"
            . ")";
  } else {
    $where = "WHERE("
            . "(`solicitudes_solicitudes`.`radicacion` BETWEEN '" . $v['fechainicial'] . "' AND '" . $v['fechafinal'] . "')AND"
            . "(`" . $v['criterio'] . "` LIKE '%" . $v['valor'] . "%')"
            . "AND( `solicitudes_solicitudes`.`creador`='" . $usuario['usuario'] . "' OR `solicitudes_solicitudes`.`responsable`='" . $usuario['usuario'] . "'))";
  }
} else {
  $where = "WHERE"
          . "("
          . "(`solicitudes_solicitudes`.`radicacion` BETWEEN '" . $v['fechainicial'] . "' AND '" . $v['fechafinal'] . "')AND"
          . "(`solicitudes_solicitudes`.`creador`='" . $usuario['usuario'] . "' OR `solicitudes_solicitudes`.`responsable`='" . $usuario['usuario'] . "')"
          . ")";
}


/**
 * En este segmento se realiza una consulta para obtener un preconteo del numero de datos 
 * totales, que se retornara como resultado. Este dato se visualiza en la parte inferior de la tabla 
 * grafica generada, y debe ser retornado en el JSON bajo el indice "total".
 */
$sql['preconteo'] = ("SELECT 
  `solicitudes_solicitudes`.`solicitud`,
  `solicitudes_respuestas`.`respuesta`,
  `solicitudes_notificaciones`.`notificacion`
FROM 
  `solicitudes_solicitudes`
LEFT OUTER JOIN `solicitudes_respuestas` ON `solicitudes_solicitudes`.`solicitud` = `solicitudes_respuestas`.`solicitud`
LEFT OUTER JOIN `solicitudes_notificaciones` ON `solicitudes_respuestas`.`respuesta` = `solicitudes_notificaciones`.`respuesta`
" . $where . "
  GROUP BY `solicitudes_solicitudes`.`solicitud`
;");
$preconteo = $db->sql_query($sql['preconteo']);
$total = $db->sql_numrows($preconteo);
/**
 * Consulta real que generara resultados
 * 
 */
if (!empty($v['criterio']) && !empty($v['valor']) && $v['criterio'] == "estado" && $v['valor'] == 'pendientes') {
  $sql['consulta'] = "
   SELECT 
          `solicitudes_solicitudes`.`solicitud`,
          `solicitudes_solicitudes`.`servicio` AS `s_servicio`,
          `solicitudes_solicitudes`.`categoria` AS `s_categoria`,
          `solicitudes_solicitudes`.`causal` AS `s_causal`,
          `solicitudes_solicitudes`.`suscriptor` AS `s_suscriptor`,
          `solicitudes_solicitudes`.`nombres` AS `s_nombres`,
          `solicitudes_solicitudes`.`apellidos` AS `s_apellidos`,
          `solicitudes_solicitudes`.`direccion` AS `s_direccion`,
          `solicitudes_solicitudes`.`instalacion` AS `s_instalacion`,
          `solicitudes_solicitudes`.`telefono` AS `s_telefono`,
          `solicitudes_solicitudes`.`movil` AS `s_movil`,
          `solicitudes_solicitudes`.`radicacion` AS `s_radicacion`,
          `solicitudes_solicitudes`.`equipo` AS `equipo`,
          `solicitudes_solicitudes`.`creador` AS `s_creador`,
          `solicitudes_solicitudes`.`responsable` AS `responsable`
   FROM `solicitudes_solicitudes` 
   WHERE NOT EXISTS (
      SELECT  * 
      FROM `solicitudes_respuestas` 
      WHERE(`solicitudes_solicitudes`.`solicitud`=`solicitudes_respuestas`.`solicitud`)
    )AND((`solicitudes_solicitudes`.`creador`='" . $usuario['usuario'] . "')OR(`solicitudes_solicitudes`.`responsable`='" . $usuario['usuario'] . "'));";
} else { 
  $sql['consulta'] = ("SELECT 
  `solicitudes_solicitudes`.`solicitud`,
  `solicitudes_respuestas`.`respuesta`,
  `solicitudes_notificaciones`.`notificacion`,
  `solicitudes_solicitudes`.`servicio` AS `s_servicio`,
  `solicitudes_solicitudes`.`categoria` AS `s_categoria`,
  `solicitudes_solicitudes`.`causal` AS `s_causal`,
  `solicitudes_solicitudes`.`suscriptor` AS `s_suscriptor`,
  `solicitudes_solicitudes`.`nombres` AS `s_nombres`,
  `solicitudes_solicitudes`.`apellidos` AS `s_apellidos`,
  `solicitudes_solicitudes`.`direccion` AS `s_direccion`,
  `solicitudes_solicitudes`.`instalacion` AS `s_instalacion`,
  `solicitudes_solicitudes`.`telefono` AS `s_telefono`,
  `solicitudes_solicitudes`.`movil` AS `s_movil`,
  `solicitudes_solicitudes`.`radicacion` AS `s_radicacion`,
   `solicitudes_solicitudes`.`creador` AS `s_creador`,
  `solicitudes_solicitudes`.`responsable` AS `s_responsable`,
  `solicitudes_respuestas`.`categoria` AS `r_categoria`,
  `solicitudes_respuestas`.`radicado` AS `r_radicado`,
  `solicitudes_respuestas`.`tipo` AS `r_tipo`,
  `solicitudes_respuestas`.`fecha` AS `r_fecha`,
  `solicitudes_respuestas`.`solicitud` AS `respuesta_solicitud`,
  `solicitudes_notificaciones`.`tipo` AS `n_tipo`,
  `solicitudes_notificaciones`.`fecha` AS `n_fecha`,
  `solicitudes_notificaciones`.`respuesta` AS `n_respuesta`,
  `solicitudes_solicitudes`.`equipo` AS `equipo`
FROM 
  `solicitudes_solicitudes`
LEFT OUTER JOIN `solicitudes_respuestas` ON `solicitudes_solicitudes`.`solicitud` = `solicitudes_respuestas`.`solicitud`
LEFT OUTER JOIN `solicitudes_notificaciones` ON `solicitudes_respuestas`.`respuesta` = `solicitudes_notificaciones`.`respuesta`
" . $where . "
GROUP BY `solicitudes_solicitudes`.`solicitud`
ORDER BY `solicitudes_solicitudes`.`radicacion` DESC " . $limite . "
;");
}

$consulta = $db->sql_query($sql['consulta']);
$ret = array();
while ($fila = $db->sql_fetchrow($consulta)) {
  /**
   * Cada fila representa una solicitud y cada solicitud se le evaluan multiples datos cuyo resultado
   * repercute en los elementos graficos visualizados a manera de estados. En primera instancia se 
   * debe de evaluar el estado general de la solicitud en los indicadores S.R.N.T.A. los datos de esta 
   * evaluación se depositaran en un vector de estados "$e[]" donde su analisis determina el estado
   * general de la solicitud, del cual se asume en primera instancia que es "pendiente" de solucionar
   * es decir ($e['general']=false;) o notificar, pero segun los indicadores recibidos se puede asumir 
   * como "resuelta" ($e['general']=true;).
   */
  $e['general'] = false;
  $e['solicitud'] = @$fila['solicitud'];
  $e['respuesta'] = $respuestas->publica($e['solicitud']);
  $e['notificacion'] = $notificaciones->respuesta($e['respuesta']['respuesta']);
  if (isset($e['respuesta']['respuesta']) && isset($e['notificacion']['notificacion'])) {
    $e['general'] = true;
  }
  /**
   * El estado general de cada solicitud es irrelevante a la conformación de la estructura de datos 
   * JSON cada dato es preparado para ser integrado a la estructura que sera retornada.
   */
  $codigos = @$fila['s_servicio'] . "-" . @$fila['s_categoria'] . "-" . @$fila['s_causal'] . "-" . @$fila['s_suscriptor'];
  $nombre = "<b>" . $cadenas->capitalizar(@$fila['s_nombres'] . " " . @$fila['s_apellidos']) . "</b>";
  $direccion = $cadenas->capitalizar((!empty($fila['s_instalacion'])) ? $fila['s_instalacion'] : $fila['s_direccion']);
  $telefonos = "<i>Tels: " . @$fila['telefono'] . " " . @$fila['movil'] . "</i>";
  $detalles = "<span>" . $codigos . " " . $nombre . " " . $direccion . " " . $telefonos . "</span>";
  $servicio = $servicios->consultar(@$fila['s_servicio']);
  /** Analizando Estados * */
  $estado['notificacion'] = (isset($fila['notificacion']) && !empty($fila['notificacion'])) ? "verde" : "rojo";
  $estado['respuesta'] = (isset($fila['respuesta']) && !empty($fila['respuesta'])) ? "verde" : "rojo";
  $estado['solicitud'] = ($estado['respuesta'] == "verde" && $estado['notificacion'] == "verde") ? "verde" : "rojo";
  $estado['tiempo'] = $solicitudes->estado_tiempo(@$fila['solicitud']);
  $estado['adjuntos'] = $solicitudes->estado_adjuntos(@$fila['solicitud']);

  $indicadores = ""
          . "<a href=\"#\" onClick=\"#\"><div class=\"icono16x16" . $servicio['nombre'] . "\"></div></a>"
          . "<a href=\"#\" onClick=\"#\"><div class=\"icono16x16solicitud" . $estado['solicitud'] . "\"></div></a>"
          . "<a href=\"#\" onClick=\"#\"><div class=\"icono16x16respuesta" . $estado['respuesta'] . "\"></div></a>"
          . "<a href=\"#\" onClick=\"#\"><div class=\"icono16x16notificacion" . $estado['notificacion'] . "\"></div></a>"
          . "<a href=\"#\" onClick=\"#\"><div class=\"icono16x16tiempo" . $estado['tiempo'] . "\"></div></a>"
          . "<a href=\"#\" onClick=\"#\"><div class=\"icono16x16adjuntos" . $estado['adjuntos'] . "\"></div></a>"
          . "";
  /**
   * Dias habiles trascurridos entre la radicacion y la fecha actual, si no hay respuesta, o entre la 
   * radicacion de la solicitud y la radicación de la respuesta, en caso de existir una respuesta.
   * $dth: Dias Habiles Trascurridos.
   * */
  $dht = (intval(isset($fila['respuesta']) && !empty($fila['respuesta'])) ? $fechas->habiles($fila['s_radicacion'], $fila['r_fecha']) : $fechas->habiles($fila['s_radicacion'], $fechas->hoy())) - 1;
  if (intval($fila['s_categoria']) == 3) {
    if ($dht > 0 && $dht <= 25) {
      $dht = "<span style=\"color:blue;font-weight:bold;\">" . $dht . "</span>";
    } else {
      $dht = "<span style=\"color:red;font-weight:bold;\">" . $dht . "</span>";
    }
  } else {
    if ($dht > 0 && $dht <= 15) {
      $dht = "<span style=\"color:black;font-weight:bold;\">" . $dht . "</span>";
    } else {
      $dht = "<span style=\"color:red;font-weight:bold;\">" . $dht . "</span>";
    }
  }
  $json['solicitud'] = @$fila['solicitud'];
  $json['creador'] = @$fila['creador'];
  $json['responsable'] = @$fila['responsable'];
  $json['equipo'] = @$fila['equipo'];
  $json['codigo'] = "<a href=\"#\" onClick=\"MUI.Solicitudes_Solicitud_Consultar('" . @$fila['solicitud'] . "');\">" . @$fila['solicitud'] . "</a>";
  $json['causal'] = @$fila['causal'];
  $json['detalles'] = $detalles;
  $json['radicacion'] = @$fila['s_radicacion'];
  $json['estados'] = $indicadores;
  $json['equipo'] = @$fila['equipo'];
  $json['creador'] = @$fila['creador'];
  $json['respuesta'] = "<b>" . @$fila['r_radicado'] . "</b>";
  $json['respuesta-fecha'] = @$fila['r_fecha'];
  $json['respuesta-dht'] = $dht;
  $json['respuesta-tipo'] = @$fila['r_tipo'];
  if (isset($fila['r_radicado'])) {
    $json['notificacion'] = "<b>" . @$fila['notificacion'] . "</b>";
    $json['notificacion-fecha'] = @$fila['n_fecha'];
    $json['notificacion-tipo'] = @$fila['n_tipo'];
  } else {
    $json['notificacion'] = "";
    $json['notificacion-fecha'] = "";
    $json['notificacion-tipo'] = "";
  }
  @$fila['opciones'] = "<a href=\"#\" onClick=\"MUI.Raiz_Creador('" . @$fila['creador'] . "');\"><div class=\"icono16x16creador\"></div></a>";

  /**
   * Los resultados visualizados en esta tabla pueden obedecer a una consulta habitual de las
   * solicitudes propias de un usuario del sistema, adicionalmente a la propiedad (creacion / responsabilidad)
   * de la información visualizada la tabla permite realizar sierta clase de filtros y busquedas de 
   * informacion. Pero un determinado criterio de busqueda permite filtrar las solicitudes visualizadas
   * unica y exclusivamente si estas estan pendientes de resolución. Para ello detectado el criterio
   * se procede como si fuese una orden donde se evalua primero si la solicitud, tiene respuesta
   * publica y luego si existe una notificación asociada a esa respuesta publica.
   */
  if ($v['criterio'] == "estado" && $v['valor'] == "pendientes") {
    if ($e['general'] == false) {
      array_push($ret, $json);
    }
  } else {
    array_push($ret, $json);
  }
}

if ($v['criterio'] == "estado" && $v['valor'] == "pendientes") {
  $total = count($ret);
}


$db->sql_close();
echo json_encode(array("sql" => $cadenas->condenzar($sql['consulta']), "uid" => $usuario['usuario'], "page" => $page, "total" => $total, "data" => $ret));
?>