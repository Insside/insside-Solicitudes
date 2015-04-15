<?php

$root = (!isset($root)) ? "../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");

class Causales {

  function crear($causal, $categoria, $titulo, $definicion, $servicio, $creador) {
    $db = new MySQL();
    $existencia = $db->sql_query("SELECT * FROM `solicitudes_causales` WHERE `causal`='" . $causal . "' AND `servicio`='" . $servicio . "' ;");
    if ($db->sql_numrows($existencia) == 0) {
      $sql = "INSERT INTO `causales` SET ";
      $sql.="`causal`='" . $causal . "',";
      $sql.="`categoria`='" . $categoria . "',";
      $sql.="`titulo`='" . $titulo . "',";
      $sql.="`definicion`='" . $definicion . "',";
      $sql.="`servicio`='" . $servicio . "',";
      $sql.="`creador`='" . $creador . "',";
      $sql.="`fecha`='" . date('Y-m-d', time()) . "',";
      $sql.="`hora`='" . date('H:i:s', time()) . "';";
      $consulta = $db->sql_query($sql);
    }$db->sql_close();
  }

  function actualizar($causal, $categoria, $titulo, $definicion, $servicio, $creador) {
    $db = new MySQL();
    $sql = "UPDATE `causales` SET ";
    $sql.="`categoria`='" . trim($categoria) . "',";
    $sql.="`titulo`='" . trim($titulo) . "',";
    $sql.="`definicion`='" . trim($definicion) . "',";
    $sql.="`servicio`='" . $servicio . "',";
    $sql.="`creador`='" . $creador . "',";
    $sql.="`fecha`='" . date('Y-m-d', time()) . "',";
    $sql.="`hora`='" . date('H:i:s', time()) . "'";
    $sql.=" WHERE `causal`='" . $causal . "'";
    $sql.=";";
    $consulta = $db->sql_query($sql);
    $db->sql_close();
  }

  function eliminar($causal, $servicio) {
    $db = new MySQL();
    $sql = "DELETE FROM `solicitudes_causales` WHERE `causal`='" . $causal . "' AND `servicio`='" . $servicio . "';";
    $consulta = $db->sql_query($sql);
    $db->sql_close();
  }

  function consultar($servicio, $causal) {
    $db = new MySQL();
    $acentos = $db->sql_query("SET NAMES 'utf8'");
    $consulta = $db->sql_query("SELECT * FROM `solicitudes_causales` WHERE `causal`='" . $causal . "' AND `servicio`='" . $servicio . "' ;");
    $fila = $db->sql_fetchrow($consulta);
    $db->sql_close();
    return($fila);
  }

  function inicializar() {
    $sql = "create table causales(causal int(3) not null,categoria char(32) not null,titulo char(128) not null,definicion blob not null,servicio char(32) not null,fecha date,hora time,creador char(11) not null,primary key (causal, servicio));";
    $db = new MySQL();
    if (!$db->sql_tablaexiste("causales")) {
      $consulta = $db->sql_query($sql);
    }$db->sql_close();
  }

  function combo($name, $selected, $servicio, $categoria, $clase = "required", $change = "") {
    $db = new MySQL();
    if($categoria=="02"||$categoria=="03"){
       $sql = "SELECT * FROM `solicitudes_causales` WHERE(`servicio`='" . $servicio . "') ORDER BY `causal`,`servicio`";
    }else{    
    $sql = "SELECT * FROM `solicitudes_causales` WHERE(`categoria`='" . $categoria . "' AND `servicio`='" . $servicio . "') ORDER BY `categoria`,`servicio`";
    }
    
    $consulta = $db->sql_query($sql);
    $html = ('<div id="div'.$name.'"><select name="' . $name . '"id="' . $name . '" class="' . $clase . '" onChange="' . $change . '">');
    $conteo = 0;
    while ($fila = $db->sql_fetchrow($consulta)) {
      $html.=('<option value="' . $fila['causal'] . '"' . (($selected == $fila['causal']) ? "selected" : "") . '>' . $fila['causal'] . " | " . $fila['titulo'] . '</option>');
      $conteo++;
    }
    $db->sql_close();
    $html.=("</select></div>");
    return($html);
  }

  function estadisticas($inicial, $final) {
    $db = new MySQL();
    $consulta = $db->sql_query("
			SELECT `solicitudes_solicitudes`.`causal`, `solicitudes_solicitudes`.`servicio`, Count(`solicitudes_solicitudes`.`solicitud`) AS `conteo`
			FROM `solicitudes_solicitudes`
			WHERE `solicitudes_solicitudes`.`radicacion` BETWEEN '" . $inicial . "' AND '" . $final . "'
			GROUP BY `solicitudes_solicitudes`.`causal`, `solicitudes_solicitudes`.`servicio`;
		");
    $conteo = 0;
    $filas = NULL;
    while ($fila = $db->sql_fetchrow($consulta)) {
      $filas[$conteo] = $fila;
      $conteo++;
    }
    $db->sql_close();
    return($filas);
  }

  function opcional($selected) {
    $componentes = new Componentes();
    $etiquetas = array("Todos");
    $valores = array("00");
    $db = new MySQL();
    $sql = "SELECT * FROM `cusales` ORDER BY `servicio`";
    $consulta = $db->sql_query($sql);
    while ($fila = $db->sql_fetchrow($consulta)) {
      $etiquetas[] = $fila['nombre'];
      $valores[] = $fila['servicio'];
    }
    $db->sql_close();
    return($componentes->combo("servicios", $etiquetas, $valores, $selected));
  }

  function conteo($opcion = NULL) {
    $db = new MySQL();
    if ($opcion == 'total') {
      $sql = "SELECT Count(`causal`) AS `conteo` FROM `solicitudes_causales` ;";
    }
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['conteo']);
  }

}

$causales = new Causales();
?>
