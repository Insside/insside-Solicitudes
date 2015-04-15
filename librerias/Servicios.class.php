<?php

$root = (!isset($root)) ? "../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");

class Servicios {

  //function crear($permiso,$descripcion,$creador){$db=new MySQL();$existencia=$db->sql_query("SELECT * FROM `aplicacion_permisos` WHERE `permiso`='".$permiso."' ;");if($db->sql_numrows($existencia)==0){$sql="INSERT INTO `aplicacion_permisos` SET ";$sql.="`permiso`='".$permiso."',";$sql.="`descripcion`='".$descripcion."',";$sql.="`creador`='".$creador."',";$sql.="`fecha`='".date('Y-m-d',time())."',";$sql.="`hora`='".date('H:i:s',time())."';";$consulta=$db->sql_query($sql);}$db->sql_close();}
  //function actualizar($permiso,$descripcion){$db=new MySQL();$sql="UPDATE `aplicacion_permisos` SET ";$sql.="`descripcion`='".$descripcion."',";$sql.="`fecha`='".date('Y-m-d',time())."',";$sql.="`hora`='".date('H:i:s',time())."'";$sql.=" WHERE `permiso`='".$permiso."'";$sql.=";";$consulta=$db->sql_query($sql);$db->sql_close();}
  //function eliminar($permiso){$db=new MySQL();$sql="DELETE FROM `aplicacion_permisos` WHERE `permiso`='".$permiso."';";$consulta=$db->sql_query($sql);$db->sql_close();}
  function consultar($servicio) {
    $db = new MySQL();
    $consulta = $db->sql_query("SELECT * FROM `solicitudes_servicios` WHERE `servicio`='" . $servicio . "' ;");
    $fila = $db->sql_fetchrow($consulta);
    $db->sql_close();
    return($fila);
  }

  function inicializar() {

  }

  function combo($name, $selected, $disabled = false, $change = "") {
    $disabled = ($disabled) ? "disabled=\"disabled\"" : "";
    $db = new MySQL();
    $sql = "SELECT * FROM `solicitudes_servicios` ORDER BY `servicio`";
    $consulta = $db->sql_query($sql);
    $html = ('<select name="' . $name . '"id="' . $name . '" ' . $disabled . ' onChange="' . $change . '">');
    $conteo = 0;
    while ($fila = $db->sql_fetchrow($consulta)) {
      $html.=('<option value="' . $fila['servicio'] . '"' . (($selected == $fila['servicio']) ? "selected" : "") . '>' . $fila['servicio'] . ' | ' . $fila['nombre'] . '</option>');
      $conteo++;
    }$db->sql_close();
    $html.=("</select>");
    return($html);
  }
  
    function combo_estadistico($name, $selected, $disabled = false, $change = "") {
    $disabled = ($disabled) ? "disabled=\"disabled\"" : "";
    $db = new MySQL();
    $sql = "SELECT * FROM `solicitudes_servicios` ORDER BY `servicio`";
    $consulta = $db->sql_query($sql);
    $html = ('<select name="' . $name . '"id="' . $name . '" ' . $disabled . ' onChange="' . $change . '">');
    $conteo = 0;
    $html.=('<option value="00">00 | Todos</option>');
    while ($fila = $db->sql_fetchrow($consulta)) {
      $html.=('<option value="' . $fila['servicio'] . '"' . (($selected == $fila['servicio']) ? "selected" : "") . '>' . $fila['servicio'] . ' | ' . $fila['nombre'] . '</option>');
      $conteo++;
    }$db->sql_close();
    $html.=("</select>");
    return($html);
  }
  
  
  

  function opcional($selected) {
    $componentes = new Componentes();
    $etiquetas = array("Todos");
    $valores = array("00");
    $db = new MySQL();
    $sql = "SELECT * FROM `solicitudes_servicios` ORDER BY `servicio`";
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
      $sql = "SELECT Count(`servicio`) AS `conteo` FROM `solicitudes_servicios` ;";
    }
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['conteo']);
  }

}

$servicios = new Servicios();
?>