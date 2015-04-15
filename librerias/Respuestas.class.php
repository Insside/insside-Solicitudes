<?php

$root = (!isset($root)) ? "../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
require_once($root . "modulos/empleados/librerias/Empleados.class.php");

class Respuestas {

  var $sesion;
  var $fechas;
  var $tabla;
  var $formularios;
  var $permisos;
  var $usuarios;
  var $empleados;
  var $formatos;

  function Respuestas() {
    $this->sesion = new Sesion();
    $this->fechas = new Fechas();
    $this->permisos = new Permisos();
    $this->usuarios = new Usuarios();
    $this->empleados = new Empleados();
    $this->formatos = new Formatos();
    $this->tabla = "distribucion_instalaciones";
    $this->formularios = new Formularios("");
  }

  function insertar($datos) {
    if (is_array($datos)) {
      $datos['respuesta'] = empty($datos['respuesta']) ? time() : $datos['respuesta'];
      $sql['datos'] = $this->evaluar($datos, "respuesta");
      $sql['datos'].= $this->evaluar($datos, "solicitud");
      $sql['datos'].= $this->evaluar($datos, "tipo");
      $sql['datos'].= $this->evaluar($datos, "formato");
      $sql['datos'].= $this->evaluar($datos, "radicado");
      $sql['datos'].= $this->evaluar($datos, "orden");
      $sql['datos'].= $this->evaluar($datos, "cobro");
      $sql['datos'].= $this->evaluar($datos, "detalle");
      $sql['datos'].= $this->evaluar($datos, "fecha");
      $sql['datos'].= $this->evaluar($datos, "hora");
      $sql['datos'].= $this->evaluar($datos, "categoria");
      $sql['datos'].= $this->evaluar($datos, "estado");
      $db = new MySQL();
      $sql = ("INSERT DELAYED  INTO `solicitudes_respuestas` SET " . $sql['datos'] . "`creador`='" . $datos['creador'] . "';");
      $consulta = $db->sql_query($sql);
      $db->sql_close();
      return($consulta);
    } else {
      return("Error: Clase: Solictudes Metodo: Crear");
    }
  }

  /**
   * Si el dato evaluado existe su referencia y contenido son reexpresdos para interarse a una estructura sql
   * @param type $vector
   * @param type $dato
   * @return type
   */
  function evaluar($vector, $dato) {
    if (isset($vector[$dato]) && !empty($vector[$dato])) {
      return("`" . $dato . "`='" . $vector[$dato] . "',");
    } else {
      return("");
    }
  }

  function crear($respuesta, $solicitud, $tipo, $formato, $categoria, $radicado, $detalle, $fecha) {
    $fechas = new Fechas();
    $db = new MySQL();
    $sql = "INSERT INTO `solicitudes_respuestas` SET ";
    $sql.="`respuesta`='" . $respuesta . "',";
    $sql.="`solicitud`='" . $solicitud . "',";
    $sql.="`tipo`='" . $tipo . "',";
    $sql.="`formato`='" . $formato . "',";
    $sql.="`categoria`='" . $categoria . "',";
    $sql.="`radicado`='" . $radicado . "',";
    $sql.="`detalle`='" . urlencode(stripslashes($detalle)) . "',";
    $sql.="`creador`='" . $this->sesion->consultar("usuario") . "',";
    $sql.="`fecha`='" . $fecha . "',";
    $sql.="`hora`='" . $fechas->ahora() . "';";
    $consulta = $db->sql_query($sql);
    echo($sql);
    $db->sql_close();
  }

  function actualizar($respuesta, $campo, $valor) {
    $db = new MySQL();
    $sql = "UPDATE `solicitudes_respuestas` SET ";
    $sql.="`" . $campo . "`='" . $valor . "'";
    $sql.=" WHERE `respuesta`='" . $respuesta . "';";
    //echo($sql);
    $consulta = $db->sql_query($sql);
    $db->sql_close();
  }

  function eliminar($respuesta) {
    $db = new MySQL();
    $sql = "DELETE FROM `solicitudes_respuestas` WHERE `respuesta`='" . $respuesta . "';";
    $consulta = $db->sql_query($sql);
    $db->sql_close();
  }

  function consultar($respuesta) {
    $db = new MySQL();
    $consulta = $db->sql_query("SELECT * FROM `solicitudes_respuestas` WHERE `respuesta`='" . $respuesta . "' ;");
    $fila = $db->sql_fetchrow($consulta);
    $db->sql_close();
    return($fila);
  }

  function tipos($name, $selected) {
    $modulos = new Modulos();
    $db = new MySQL();
    $sql = "SELECT * FROM `solicitudes_respuestas_tipos` ORDER BY `tipo` ASC";
    $consulta = $db->sql_query($sql);
    $html = ('<select name="' . $name . '"id="' . $name . '">');
    $conteo = 0;
    while ($fila = $db->sql_fetchrow($consulta)) {
      $html.=('<option value="' . $fila['tipo'] . '"' . (($selected == $fila['tipo']) ? "selected" : "") . '>' . $fila['tipo'] . ": " . $fila['nombre'] . '</option>');
      $conteo++;
    } $db->sql_close();
    $html.=("</select>");
    return($html);
  }

  /**
   * Retorna la respuesta asociada a una solicitud
   * @param type $solicitud
   * @return type
   */
  function solicitud($solicitud) {
    $db = new MySQL();
    $consulta = $db->sql_query("SELECT * FROM `solicitudes_respuestas` WHERE `solicitud`='" . $solicitud . "' ;");
    $fila = $db->sql_fetchrow($consulta);
    $db->sql_close();
    return($fila);
  }

  
    function respuesta_publica($solicitud) {
    $db = new MySQL();
    $consulta = $db->sql_query("SELECT * FROM `solicitudes_respuestas` WHERE `solicitud`='" . $solicitud . "' AND `categoria`='PUBLICA';");
    $fila = $db->sql_fetchrow($consulta);
    $db->sql_close();
    return($fila);
  }
  
  
  
  function radicado($radicado) {
    $db = new MySQL();
    $consulta = $db->sql_query("SELECT * FROM `solicitudes_respuestas` WHERE `radicado`='" . $radicado . "' ;");
    $fila = $db->sql_fetchrow($consulta);
    $db->sql_close();
    return($fila);
  }



  function tabla($solicitud) {
    $html = "<table >";
    $html.= "<tr>"
            . "<td style=\"width:60px;text-align:center;\">Respuesta</td>"
            . "<td style=\"width:60px;text-align:center;\">Radicado</td>"
            . "<td style=\"width:30px;text-align:center;\">Tipo</td>"
            . "<td>Detalles de la Respuesta</td>"
            . "<td style=\"width:60px;text-align:center;\">Fecha</td>"
            . "<td style=\"width:60px;text-align:center;\">Hora</td>"
            . "</tr>";
    $db = new MySQL();
    $sql = "SELECT * FROM `solicitudes_respuestas` WHERE(`solicitud`='" . $solicitud . "') ORDER BY `respuesta` DESC";
    $consulta = $db->sql_query($sql);
    while ($fila = $db->sql_fetchrow($consulta)) {
      $usuario = $this->usuarios->consultar($fila['creador']);
      $perfil = $this->empleados->perfil($usuario['empleado']);
      $formato = $this->formatos->consultar($fila['formato']);
      $fila['categoria'] = ($fila['categoria'] == "INTERNA") ? "Interna" : "Publica";
      $html.= "<tr>"
              . "<td>" . $fila['respuesta'] . "</td>"
              . "<td>" . $fila['radicado'] . "</td>"
              . "<td>" . $fila['tipo'] . "</td>"
              . "<td><a href=\"#\" onClick=\"MUI.Solicitudes_Respuesta_Consultar('" . $fila['respuesta'] . "');\"><b>" . $formato['nombre'] . "</b></a> - <i>" . $fila['categoria'] . " - " . $perfil['nombres'] . " " . $perfil['apellidos'] . "</i></td>"
              . "<td style=\"width:60px;text-align:center;\">" . $fila['fecha'] . "</td>"
              . "<td style=\"width:60px;text-align:center;\">" . $fila['hora'] . "</td>"
              . "</tr>";
    }
    $db->sql_close();
    $html.= "</table>";

    return($html);
  }

  function categorias($seleccionado,$class="w100") {
    $etiquetas = array("Interna");
    $valores = array("INTERNA");
    if ($this->usuarios->permiso("SOLICITUDES-RESPONDER-PUBLICAMENTE")) {
      array_push($etiquetas, "Publica");
      array_push($valores, "PUBLICA");
    }
    return($this->formularios->combo("categoria", $etiquetas, $valores, $seleccionado,$class));
  }

  /**
   * Retorna la ultima respuesta publica asociada a una solicitud, como un vector de datos.
   * @param type $solicitud
   */
  function publica($solicitud) {
    $db = new MySQL();
    $sql = ("SELECT * FROM `solicitudes_respuestas` WHERE(`solicitud`='" . $solicitud . "' AND `categoria`='PUBLICA');");
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    $db->sql_close();
    //echo($sql);
    return($fila);
  }
  
  function estado_respuesta($solicitud) {
    $respuesta = $this->publica($solicitud);
    if (empty($respuesta['respuesta'])) {
      return("rojo");
    } else {
      return("verde");
    }
  }
}

?>