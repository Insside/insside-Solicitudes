<?php

$root = (!isset($root)) ? "../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");

class Solicitud {

  var $solicitud;
  var $causal;
  var $servicio;
  var $asunto;
  var $radicado, $radicacion, $radicante;
  var $detalle;
  var $suscriptor, $suscriptor_nombre, $suscriptor_direccion;
  var $categoria, $categoria_nombre;
  var $causal_detallada, $servicio_detallado;
  var $respuesta;
  var $contestacion;
  var $radicada;
  var $notificado;
  var $notificacion;
  var $sesion;

  function Solicitud($solicitud) {
    $this->solicitud = $solicitud;
    $this->causal = $this->obtener("causal");
    $this->servicio = $this->obtener("servicio");
    $this->radicado = $this->obtener("radicado");
    $this->radicacion = $this->obtener("radicacion");
    $this->radicante = $this->obtener("nombres") . " " . $this->obtener("apellidos");
    $this->detalle = $this->obtener("detalle");
    $this->respuesta = $this->obtener("respuesta");
    $this->contestacion = $this->obtener("contestacion");
    $this->radicada = $this->obtener("radicada");
    $this->notificado = $this->obtener("notificado");
    $this->notificacion = $this->obtener("notificacion");
    $this->sesion = new Sesion();
    $this->suscriptor = $this->obtener("suscriptor");
    $tmp_suscriptores = new Suscriptores();
    $tmp_suscriptor = $tmp_suscriptores->consultar($this->suscriptor);
    $this->suscriptor_nombre = $tmp_suscriptor['nombres'] . " " . $tmp_suscriptor['apellidos'];
    $this->suscriptor_direccion = $tmp_suscriptor['direccion'];


    $this->categoria = $this->obtener("categoria");
    $tmp_categorias = new Categorias();
    $tmp_categoria = $tmp_categorias->consultar($this->categoria);
    $this->categoria_nombre = $tmp_categoria['nombre'];

    $this->obtener_causal_detallada();
    $this->obtener_servicio_detallado();
  }

  function obtener($dato) {
    $referencias = new Referencias();
    $resultado = $referencias->consultar($this->solicitud, $dato);
    if (empty($resultado)) {
      $solicitudes = new Solicitudes();
      $solicitud = $solicitudes->consultar($this->solicitud);
      $resultado = @$solicitud[$dato];
    } return($resultado);
  }

  function obtener_causal_detallada() {
    $causales = new Causales();
    $this->causal_detallada = $causales->consultar($this->servicio, $this->causal);
  }

  function obtener_servicio_detallado() {
    $servicios = new Servicios();
    $this->servicio_detallado = $servicios->consultar($this->servicio);
  }

  function estadistica_sevicios() {
    $db = new MySQL();
    $sql = ("FROM `solicitudes_solicitudes` GROUP BY `solicitudes_solicitudes`.`servicio`; SELECT Count(`solicitudes_solicitudes`.`solicitud`), `solicitudes_solicitudes`.`servicio` FROM `solicitudes_solicitudes` GROUP BY `solicitudes_solicitudes`.`servicio`;");
    //echo($sql);
    $consulta = $db->sql_query($sql);
    $conteo = 0;
    while ($row = $db->sql_fetchrow($consulta)) {
      $filas[$conteo] = $db->sql_fetchrow($consulta);
      $conteo++;
    }
    $db->sql_close();
    return($filas);
  }

  function estadistica_categorias($servicio) {
    $db = new MySQL();
    $consulta = $db->sql_query("SELECT Count(`solicitudes_solicitudes`.`solicitud`) AS `conteo`, `solicitudes_solicitudes`.`servicio` AS `servicio`, `solicitudes_solicitudes`.`causal`, `solicitudes_causales`.`definicion` FROM `solicitudes_solicitudes` INNER JOIN `solicitudes_causales` ON `solicitudes_causales`.`causal` = `solicitudes_solicitudes`.`causal` GROUP BY `solicitudes_solicitudes`.`servicio`, `solicitudes_solicitudes`.`causal`, `solicitudes_causales`.`definicion` HAVING `solicitudes_solicitudes`.`servicio` = " . $servicio . ";");
    $conteo = 0;
    while ($row = $db->sql_fetchrow($consulta)) {
      $filas[$conteo] = $db->sql_fetchrow($consulta);
      $conteo++;
    }
    $db->sql_close();
    return($filas);
  }

  function conteo_reclamaciones_distribucion($inicio, $final) {
    $db = new MySQL();
    $sql = "SELECT Count(`solicitud`) AS `conteo` FROM `solicitudes_solicitudes` WHERE `servicio`='01' AND `categoria`='1' AND `radicacion` BETWEEN '" . $inicio . "' AND '" . $final . "' ";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['conteo']);
  }

  function conteo_reclamaciones_alcantarillado($inicio, $final) {
    $db = new MySQL();
    $sql = "SELECT Count(`solicitud`) AS `conteo` FROM `solicitudes_solicitudes` WHERE `servicio`='02' AND `categoria`='1' AND `radicacion` BETWEEN '" . $inicio . "' AND '" . $final . "' ";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['conteo']);
  }

  function conteo_peticiones_distribucion($inicio, $final) {
    $db = new MySQL();
    $sql = "SELECT Count(`solicitud`) AS `conteo` FROM `solicitudes_solicitudes` WHERE `servicio`='01' AND `categoria`='4' AND `radicacion` BETWEEN '" . $inicio . "' AND '" . $final . "' ";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['conteo']);
  }

  function conteo_peticiones_alcantarillado($inicio, $final) {
    $db = new MySQL();
    $sql = "SELECT Count(`solicitud`) AS `conteo` FROM `solicitudes_solicitudes` WHERE `servicio`='02' AND `categoria`='4' AND `radicacion` BETWEEN '" . $inicio . "' AND '" . $final . "' ";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['conteo']);
  }

  function conteo_recursos_distribucion($inicio, $final) {
    $db = new MySQL();
    $sql = "SELECT Count(`solicitud`) AS `conteo` FROM `solicitudes_solicitudes` WHERE `servicio`='01' AND `categoria`='2' AND `radicacion` BETWEEN '" . $inicio . "' AND '" . $final . "' ";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['conteo']);
  }

  function conteo_recursos_alcantarillado($inicio, $final) {
    $db = new MySQL();
    $sql = "SELECT Count(`solicitud`) AS `conteo` FROM `solicitudes_solicitudes` WHERE `servicio`='02' AND `categoria`='2' AND `radicacion` BETWEEN '" . $inicio . "' AND '" . $final . "' ";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['conteo']);
  }

  function conteo_subsidia_distribucion($inicio, $final) {
    $db = new MySQL();
    $sql = "SELECT Count(`solicitud`) AS `conteo` FROM `solicitudes_solicitudes` WHERE `servicio`='01' AND `categoria`='3' AND `radicacion` BETWEEN '" . $inicio . "' AND '" . $final . "' ";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['conteo']);
  }

  function conteo_subsidia_alcantarillado($inicio, $final) {
    $db = new MySQL();
    $sql = "SELECT Count(`solicitud`) AS `conteo` FROM `solicitudes_solicitudes` WHERE `servicio`='02' AND `categoria`='3' AND `radicacion` BETWEEN '" . $inicio . "' AND '" . $final . "' ";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['conteo']);
  }

  function conteo_suscriptor($suscriptor) {
    $db = new MySQL();
    $sql = "SELECT Count(`solicitud`) AS `conteo` FROM `solicitudes_solicitudes` WHERE `suscriptor`='" . $suscriptor . "'";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['conteo']);
  }

  function conteo($opcion = NULL) {
    $db = new MySQL();
    if ($opcion == NULL) {
      $sql = "SELECT Count(`solicitud`) AS `conteo` FROM `solicitudes_solicitudes` ;";
    } elseif ($opcion == "acueducto") {
      $sql = "SELECT Count(`solicitud`) AS `conteo` FROM `solicitudes_solicitudes` WHERE `servicio`='01' ;";
    } elseif ($opcion == "alcantarillado") {
      $sql = "SELECT Count(`solicitud`) AS `conteo` FROM `solicitudes_solicitudes` WHERE `servicio`='02' ;";
    }
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['conteo']);
  }

}

?>