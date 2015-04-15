<?php

$root = (!isset($root)) ? "../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");

class Categorias {

  function crear($categoria, $nombre, $descripcion, $creador) {
    $db = new MySQL();
    $existencia = $db->sql_query("SELECT * FROM `solicitudes_categorias` WHERE `categoria`='" . $categoria . "' ;");
    if ($db->sql_numrows($existencia) == 0) {
      $sql = "INSERT INTO `categorias` SET ";
      $sql.="`categoria`='" . $categoria . "',";
      $sql.="`nombre`='" . $nombre . "',";
      $sql.="`descripcion`='" . $nombre . "',";
      $sql.="`creador`='" . $creador . "',";
      $sql.="`fecha`='" . date('Y-m-d', time()) . "',";
      $sql.="`hora`='" . date('H:i:s', time()) . "';";
      $consulta = $db->sql_query($sql);
    }$db->sql_close();
  }

  //function actualizar($permiso,$descripcion){$db=new MySQL();$sql="UPDATE `aplicacion_permisos` SET ";$sql.="`descripcion`='".$descripcion."',";$sql.="`fecha`='".date('Y-m-d',time())."',";$sql.="`hora`='".date('H:i:s',time())."'";$sql.=" WHERE `permiso`='".$permiso."'";$sql.=";";$consulta=$db->sql_query($sql);$db->sql_close();}
  function eliminar($categoria) {
    $db = new MySQL();
    $sql = "DELETE FROM `solicitudes_categorias` WHERE `categoria`='" . $categoria . "';";
    $consulta = $db->sql_query($sql);
    $db->sql_close();
  }

  function consultar($categoria) {
    $db = new MySQL();
    $acentos = $db->sql_query("SET NAMES 'utf8'");
    $consulta = $db->sql_query("SELECT * FROM `solicitudes_categorias` WHERE `categoria`='" . $categoria . "' ;");
    $fila = $db->sql_fetchrow($consulta);
    $db->sql_close();
    return($fila);
  }

  function inicializar() {

  }

  function combo($name, $selected, $disabled = false, $change = "") {
    $selected = empty($selected) ? "04" : $selected;
    $disabled = ($disabled) ? "disabled=\"disabled\"" : "";
    $db = new MySQL();
    $sql = "SELECT * FROM `solicitudes_categorias` ORDER BY `categoria`";
    $consulta = $db->sql_query($sql);
    $html = ('<select name="' . $name . '"id="' . $name . '" ' . $disabled . ' onChange="' . $change . '">');
    $conteo = 0;
    while ($fila = $db->sql_fetchrow($consulta)) {
      $html.=('<option value="' . $fila['categoria'] . '"' . (($selected == $fila['categoria']) ? "selected" : "") . '>' . $fila['categoria'] . ' | ' . $fila['nombre'] . '</option>');
      $conteo++;
    }$db->sql_close();
    $html.=("</select>");
    return($html);
  }

  function estadisticas($servicio, $inicial, $final) {
    $db = new MySQL();
    $acentos = $db->sql_query("SET NAMES 'utf8'");
    $sql = ("SELECT `solicitudes_categorias`.`categoria`, `solicitudes_categorias`.`nombre`,Count(`solicitudes_solicitudes`.`solicitud`) AS `conteo`, `solicitudes_solicitudes`.`radicacion`,`solicitudes_solicitudes`.`servicio` FROM `solicitudes_categorias` INNER JOIN `solicitudes_solicitudes` ON `solicitudes_categorias`.`categoria` = `solicitudes_solicitudes`.`categoria` WHERE `solicitudes_solicitudes`.`radicacion` BETWEEN '" . $inicial . "' AND '" . $final . "' GROUP BY `solicitudes_categorias`.`categoria`, `solicitudes_solicitudes`.`servicio` HAVING `solicitudes_solicitudes`.`servicio` = " . $servicio . ";");
    $consulta = $db->sql_query($sql);
    $conteo = 0;
    $filas = NULL;
    while ($fila = $db->sql_fetchrow($consulta)) {
      $filas[$conteo] = $fila;
      $conteo++;
    }$db->sql_close();
    return($filas);
  }

  function conteo($opcion = NULL) {
    $db = new MySQL();
    if ($opcion == 'total') {
      $sql = "SELECT Count(`categoria`) AS `conteo` FROM `solicitudes_categorias` ;";
    }
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['conteo']);
  }

}

$categorias = new Categorias();
?>