<?php

$root = (!isset($root)) ? "../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");

class Asuntos {

  var $tabla = "solicitudes_asuntos";

  function crear($categoria, $servicio, $causal, $descripcion, $claves) {
    $db = new MySQL();
    $sql = "INSERT INTO `" . $this->tabla . "` SET ";
    $sql.="`asunto`='" . time() . "',";
    $sql.="`categoria`='" . $categoria . "',";
    $sql.="`servicio`='" . $servicio . "',";
    $sql.="`causal`='" . $causal . "',";
    $sql.="`descripcion`='" . $descripcion . "',";
    $sql.="`claves`='" . $claves . "',";
    $sql.="`creador`='" . @$_SESSION['usuario'] . "',";
    $sql.="`fecha`='" . date('Y-m-d', time()) . "',";
    $sql.="`hora`='" . date('H:i:s', time()) . "';";
    $consulta = $db->sql_query($sql);
    echo($sql);
    $db->sql_close();
  }

  function actualizar($asunto, $claves) {
    $db = new MySQL();
    $sql = "UPDATE ` `" . $this->tabla . "`` SET ";
    $sql.="`claves`='" . $claves . "'";
    $sql.=" WHERE `asunto`='" . $asunto . "'";
    $consulta = $db->sql_query($sql);
    $db->sql_close();
  }

  /**
   * Retorna un vector que contiene toda la información de un asunto determinado, la cual es la respuesta a una consulta
   * sobre la tabla solicitudes_asuntos en la base de datos.
   * @param type $asunto
   * @return Vector
   */
  function consultar($asunto) {
    $db = new MySQL();
    $sql = "SELECT * FROM `" . $this->tabla . "` WHERE `asunto`='" . $asunto . "' ;";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    $db->sql_close();
    return($fila);
  }

  //function inicializar(){$sql="create table causales(causal int(3) not null,categoria char(32) not null,titulo char(128) not null,definicion blob not null,servicio char(32) not null,fecha date,hora time,creador char(11) not null,primary key (causal, servicio));";$db=new MySQL();if(!$db->sql_tablaexiste("causales")){$consulta=$db->sql_query($sql);}$db->sql_close();}




  function combo($name, $selected, $servicio, $categoria, $causal, $clase = "", $change = "") {
    $db = new MySQL();
    $sql = "SELECT * FROM `" . $this->tabla . "` WHERE(`categoria`='" . $categoria . "' AND `servicio`='" . $servicio . "' AND `causal`='" . $causal . "' ) ORDER BY `categoria`,`servicio`";
    $consulta = $db->sql_query($sql);
    $html = ('<select name="' . $name . '"id="' . $name . '" class="' . $clase . '" onChange="' . $change . '">');
    $conteo = 0;
    while ($fila = $db->sql_fetchrow($consulta)) {
      $html.=('<option value="' . $fila['asunto'] . '"' . (($selected == $fila['asunto']) ? "selected" : "") . '>' . $fila['asunto'] . ' | ' . $fila['descripcion'] . '</option>');
      $conteo++;
    }$db->sql_close();
    $html.=("</select>");
    return($html);
  }

  /**
   * Este combo visualiza los asuntos correspondientes a las posibles actividades relacionadas con un servicio indicado.
   * Genera un componente grafico tipo <<select>> y lo retorna como una cadena con formato <<HTML>> es derivado
   * de la clase <<Componentes>> y simplifica la definición de la condición equivalente al tipo de servicio para el cual
   * los asuntos serán visualizados.
   * Ejemplo: echo($asuntos->combo_externo("asunto", "", "02", ""));
   * @param type $nombre define el nombre que utilizara el atributo id y el taribito name del objeto select.
   * @param type $selected define el valro seleccionado por defecto.
   * @param type $servicio define el servicio que para el cual se filtraran los asuntos listados 01 acueduto, 02 alcantarillado.
   * @param type $class valor o valores textuales del atricbuto class del elemento select.
   * @return String retorna una cadena con la estructura html del objeto selec.
   */
  function combo_externo($nombre, $selected, $servicio, $class = '') {
    $componentes = new Componentes();
    return($componentes->combo_consulta($nombre, "descripcion", "asunto", "solicitudes_asuntos", $selected, "`servicio`='" . $servicio . "'", $class));
  }

  function estado($asunto, $estado) {
    $db = new MySQL();
    $sql = "UPDATE ` `" . $this->tabla . "`` SET ";
    $sql.="`estado`='" . trim($estado) . "' WHERE `asunto`='" . $asunto . "'";
    $sql.=";";
    $consulta = $db->sql_query($sql);
    $db->sql_close();
  }

  function conteo($opcion = NULL) {
    $db = new MySQL();
    if ($opcion == 'total') {
      $sql = "SELECT Count(`asunto`) AS `conteo` FROM `solicitudes_asuntos` ;";
    }
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['conteo']);
  }

}

$asuntos = new Asuntos();
?>