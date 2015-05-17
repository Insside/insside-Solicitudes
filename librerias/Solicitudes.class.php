<?php

$root = (!isset($root)) ? "../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");

class Solicitudes {

  var $sesion;
  var $fechas;
  var $usuarios;
  var $permisos;
  var $formularios;

  function Solicitudes() {
    $this->permisos = new Usuarios_Permisos();
    $this->sesion = new Sesion();
    $this->fechas = new Fechas();
    $this->usuarios = new Usuarios();
    $this->formularios = new Formularios(time());
    $modulos = new Modulos();
    $modulo = $modulos->crear("912", "Solicitudes", "Módulo PQR", "");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-MODULO-A", "Acceso Modulo De Usuarios", "Permite acceder al modulo Usuarios.", "0000000000");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-RESPONSABILIZABLE", "Acceso Modulo De Usuarios", "Permite acceder al modulo Usuarios.", "0000000000");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-RESPUESTAS-ACTUALIZAR", "Permite actualizar (editar) respuestas propias", "Este permiso le permite eliminar las respuesta a solicitudes que hayan sido creadas por el propio usuario. ", "0000000000");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-RESPUESTAS-ACTUALIZAR-TODAS", "Permite actualizar (editar) cualquier respuesta", "Este permiso le permite eliminar las respuesta a solicitudes que hayan sido creadas por el propio usuario. ", "0000000000");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-RESPUESTAS-ELIMINAR", "Eliminar respuestas propias", "Este permiso le permite eliminar las respuesta a solicitudes que hayan sido creadas por el propio usuario. ", "0000000000");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-RESPUESTAS-ELIMINAR-TODAS", "Eliminar cualquier respuesta", "Este permiso le permite eliminar cualquier respuesta existente en una determinada solicitud registrada en el sistema, ya sea de la autoría del propio usuario o cualquier otro. ", "0000000000");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-RESPUESTAS-FORMATOS-ELIMINAR", "Eliminar formatos / plantillas propios", "Este permiso le permite eliminar los formatos o plantillas que hayan sido creadas por el propio usuario. ", "0000000000");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-RESPUESTAS-FORMATOS-ELIMINAR-TODOS", "Eliminar cualquier formato / plantilla seleccionado", "Este permiso le permite eliminar los formatos o plantillas que que hayan sido creadas por cualquier usuario. ", "0000000000");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-RESPONDER", "Permite generar respuestas internas", "Este permiso le permite dar respuesta a una solicitud y marcar la respuesta como interna es decir que no sera direcctamente accesible por el solicitante o suscriptor. ", "0000000000");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-RESPONDER-PUBLICAMENTE", "Permite generar respuestas externas", "Este permiso le permite dar respuestas externas es decir aque llas que son visibles publicamente para el suscriptor y/o solicitante.", "0000000000");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-TRASFERIR", "Permite trasferir sus solicitudes de un periodo a otro", "Este permiso le permite dar respuestas externas es decir aque llas que son visibles publicamente para el suscriptor y/o solicitante.", "0000000000");
    $this->permisos->permiso_crear($modulo, "SOLICITUDES-TRASFERIR-TODAS", "Permite trasferir cualquier solicitud de un periodo a otro", "Este permiso le permite dar respuestas externas es decir aque llas que son visibles publicamente para el suscriptor y/o solicitante.", "0000000000");



    $this->permisos->crear("SOLICITUDES-CONFIGURACION-ASUNTOS-VISUALIZAR", "Permite visualizar la lista de asuntos definidos en las diferentes causales", "SISTEMA");
    $this->permisos->crear("SOLICITUDES-CONFIGURACION-ASUNTOS-CREAR", "Permite crear asuntos", "SISTEMA");
    $this->permisos->crear("SOLICITUDES-CONFIGURACION-ASUNTOS-ACTUALIZAR", "Permite actualizar la informacion de un asunto, si eres el creador del mismo", "SISTEMA");
    $this->permisos->crear("SOLICITUDES-CONFIGURACION-ASUNTOS-ACTUALIZAR-TODO", "Permite actualizar la informacion de cualquier asunto existente", "SISTEMA");
    $this->permisos->crear("SOLICITUDES-CONFIGURACION-ASUNTOS-ELIMINAR", "Permite eliminar un asunto, si eres el creador del mismo", "SISTEMA");
    $this->permisos->crear("SOLICITUDES-CONFIGURACION-ASUNTOS-ELIMINAR-TODO", "Permite eliminar cualquier asunto existente", "SISTEMA");
  }

  function crear($datos) {
    if (is_array($datos)) {
      $datos['solicitud'] = empty($datos['solicitud']) ? time() : $datos['solicitud'];
      $sql['datos'] = $this->evaluar($datos, "solicitud");
      $sql['datos'] .= $this->evaluar($datos, "dane");
      $sql['datos'] .= $this->evaluar($datos, "servicio");
      $sql['datos'] .= $this->evaluar($datos, "radicado");
      $sql['datos'] .= $this->evaluar($datos, "radicacion");
      $sql['datos'] .= $this->evaluar($datos, "categoria");
      $sql['datos'] .= $this->evaluar($datos, "trasferido");
      $sql['datos'] .= $this->evaluar($datos, "causal");
      $sql['datos'] .= $this->evaluar($datos, "asunto");
      $sql['datos'] .= $this->evaluar($datos, "detalle");
      $sql['datos'] .= $this->evaluar($datos, "suscriptor");
      $sql['datos'] .= $this->evaluar($datos, "factura");
      $sql['datos'] .= $this->evaluar($datos, "sspd");
      $sql['datos'] .= $this->evaluar($datos, "ejecucion");
      $sql['datos'] .= $this->evaluar($datos, "orden");
      $sql['datos'] .= $this->evaluar($datos, "fecha");
      $sql['datos'] .= $this->evaluar($datos, "nombres");
      $sql['datos'] .= $this->evaluar($datos, "apellidos");
      $sql['datos'] .= $this->evaluar($datos, "documentos");
      $sql['datos'] .= $this->evaluar($datos, "identificacion");
      $sql['datos'] .= $this->evaluar($datos, "nacimiento");
      $sql['datos'] .= $this->evaluar($datos, "sexo");
      $sql['datos'] .= $this->evaluar($datos, "telefono");
      $sql['datos'] .= $this->evaluar($datos, "movil");
      $sql['datos'] .= $this->evaluar($datos, "correo");
      $sql['datos'] .= $this->evaluar($datos, "pais");
      $sql['datos'] .= $this->evaluar($datos, "region");
      $sql['datos'] .= $this->evaluar($datos, "ciudad");
      $sql['datos'] .= $this->evaluar($datos, "sector");
      $sql['datos'] .= $this->evaluar($datos, "direccion");
      $sql['datos'] .= $this->evaluar($datos, "referencia");
      $sql['datos'] .= $this->evaluar($datos, "expiracion");
      $sql['datos'] .= $this->evaluar($datos, "instalacion");
      $sql['datos'] .= $this->evaluar($datos, "estrato");
      $sql['datos'] .= $this->evaluar($datos, "diametro");
      $sql['datos'] .= $this->evaluar($datos, "legalizado");
      $sql['datos'] .= $this->evaluar($datos, "matricula");
      $sql['datos'] .= $this->evaluar($datos, "responsable");
      $sql['datos'] .= $this->evaluar($datos, "origen");
      $sql['datos'] .= $this->evaluar($datos, "equipo");
      //$sql['datos'] = $this->evaluar($datos, "creador");
      $db = new MySQL();
      $sql = ("	"
              . "INSERT DELAYED INTO `solicitudes_solicitudes` "
              . "SET "
              . $sql['datos']
              . "`creador`='" . $datos['creador'] . "';");
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

  function solicitudes_crear($solicitud) {
    $solicitud = empty($solicitud) ? time() : $solicitud;
    $db = new MySQL();
    $sql = ("	INSERT INTO `solicitudes_solicitudes` SET
		`solicitud`='" . $solicitud . "',
		`dane`='0076111000',
		`fecha`='" . ($this->fechas->hoy()) . "',
		`expiracion`='" . ($this->fechas->sumar_diashabiles($this->fechas->hoy(), 15)) . "';");
    $consulta = $db->sql_query($sql);
    $db->sql_close();
    return($solicitud);
  }

  function actualizar($solicitud, $campo, $valor) {
    $db = new MySQL();
    $sql = "UPDATE `solicitudes_solicitudes` SET ";
    $sql.="`" . $campo . "`='" . $valor . "'";
    $sql.=" WHERE `solicitud`='" . $solicitud . "';";
    //echo($sql);
    $consulta = $db->sql_query($sql);
    $db->sql_close();
    return($consulta);
  }

  function eliminar($solicitud) {
    $db = new MySQL();
    $sql = "DELETE FROM `solicitudes_solicitudes` WHERE `solicitud`='" . $solicitud . "';";
    $consulta = $db->sql_query($sql);
    $db->sql_close();
    return($consulta);
  }

  function consultar($solicitud) {
    $db = new MySQL();
    $sql = "SELECT * FROM `solicitudes_solicitudes` WHERE `solicitud`='" . $solicitud . "' ;";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    $db->sql_close();
    return($fila);
  }

  function legalizar($solicitud, $matricula) {
    echo("LEGALIZAR: " . $solicitud . $matricula);
    if (!empty($solicitud) && !empty($matricula)) {
      $this->actualizar($solicitud, 'legalizado', "SI");
      $this->actualizar($solicitud, 'matricula', $matricula);
    }
  }

  //\\//\\//\\//\\//\\//\\//\\//\\ Componentes Graficos //\\//\\//\\//\\//\\//\\//\\//\\
  function asuntos_combo($selected, $servicio, $categoria, $causal) {
    $name = "asuntos";
    $db = new MySQL();
    $sql = "SELECT * FROM `solicitudes_asuntos` WHERE(`servicio`='" . $servicio . "' AND `categoria`='" . $categoria . "' AND `causal`='" . $causal . "') ORDER BY `servicio`,`categoria`,`descripcion`";
    $consulta = $db->sql_query($sql);
    $html = ('<select name="' . $name . '"id="' . $name . '">');
    $conteo = 0;
    while ($fila = $db->sql_fetchrow($consulta)) {
      $html.=('<option value="' . $fila['asunto'] . '"' . (($selected == $fila['asunto']) ? "selected" : "") . '>' . $fila['asunto'] . " | " . $fila['descripcion'] . '</option>');
      $conteo++;
    }$db->sql_close();
    $html.=("</select>");
    return($html);
  }

  function causales_combo($selected, $servicios, $categoria, $onchange = '') {
    $name = "causales";
    $db = new MySQL();
    $sql = "SELECT * FROM `solicitudes_causales` WHERE(`categoria`='" . $categoria . "' AND `servicio`='" . $servicios . "') ORDER BY `categoria`,`servicio`";
    $consulta = $db->sql_query($sql);
    $html = ('<select name="' . $name . '"id="' . $name . '" onchange="' . $onchange . '">');
    $conteo = 0;
    while ($fila = $db->sql_fetchrow($consulta)) {
      $html.=('<option value="' . $fila['causal'] . '"' . (($selected == $fila['causal']) ? "selected" : "") . '>' . $fila['causal'] . " | " . $fila['titulo'] . '</option>');
      $conteo++;
    }$db->sql_close();
    $html.=("</select>");
    return($html);
  }

  function estructura() {
    $sql = "create table solicitudes(solicitud int(11) not null,tramite char(3),causal int(3) not null,servicio char(32) not null,fecha date not null,hora time not null,estado char(32) not null,expiracion date,primary key (solicitud));";
    $db = new MySQL();
    if (!$db->sql_tablaexiste("solicitudes")) {
      $consulta = $db->sql_query($sql);
    }$db->sql_close();
    return($consulta);
  }
  
  /** Estadisticas **/
  
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
  /**
   * Retorna un elemento html tipo select que contiene los posibles criterios a usar en la generación
   * de las estadisticas.
   * 
   * @param type $nombre
   * @param type $seleccionado
   * @return type
   */
  function estadistica_criterios($nombre, $seleccionado) {
    $etiquetas = array("Todo", "Acueducto","Alcantarillado");
    $valores = array("00","01","02");
    return($this->formularios->combo($nombre, $etiquetas, $valores, $seleccionado, ""));
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

  

  function conteo_reclamaciones_distribucion($inicio, $final) {
    $db = new MySQL();
    $sql = "SELECT Count(`solicitud`) AS `conteo` FROM `solicitudes_solicitudes` WHERE `servicio`='01' AND `categoria`='1' AND `equipo`='2' AND `radicacion` BETWEEN '" . $inicio . "' AND '" . $final . "' ";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['conteo']);
  }

  function conteo_reclamaciones_alcantarillado($inicio, $final) {
    $db = new MySQL();
    $sql = "SELECT Count(`solicitud`) AS `conteo` FROM `solicitudes_solicitudes` WHERE `servicio`='02' AND `categoria`='1' AND `equipo`='3' AND `radicacion` BETWEEN '" . $inicio . "' AND '" . $final . "' ";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['conteo']);
  }

  function conteo_peticiones_distribucion($inicio, $final) {
    $db = new MySQL();
    $sql = "SELECT Count(`solicitud`) AS `conteo` FROM `solicitudes_solicitudes` WHERE `servicio`='01' AND `categoria`='4' AND `equipo`='2' AND `radicacion` BETWEEN '" . $inicio . "' AND '" . $final . "' ";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['conteo']);
  }

  function conteo_peticiones_alcantarillado($inicio, $final) {
    $db = new MySQL();
    $sql = "SELECT Count(`solicitud`) AS `conteo` FROM `solicitudes_solicitudes` WHERE `servicio`='02' AND `categoria`='4' AND `equipo`='3'  AND `radicacion` BETWEEN '" . $inicio . "' AND '" . $final . "' ";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['conteo']);
  }

  function conteo_recursos_distribucion($inicio, $final) {
    $db = new MySQL();
    $sql = "SELECT Count(`solicitud`) AS `conteo` FROM `solicitudes_solicitudes` WHERE `servicio`='01' AND `categoria`='2' AND `equipo`='2' AND `radicacion` BETWEEN '" . $inicio . "' AND '" . $final . "' ";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['conteo']);
  }

  function conteo_recursos_alcantarillado($inicio, $final) {
    $db = new MySQL();
    $sql = "SELECT Count(`solicitud`) AS `conteo` FROM `solicitudes_solicitudes` WHERE `servicio`='02' AND `categoria`='2' AND `equipo`='3' AND `radicacion` BETWEEN '" . $inicio . "' AND '" . $final . "' ";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['conteo']);
  }

  function conteo_subsidia_distribucion($inicio, $final) {
    $db = new MySQL();
    $sql = "SELECT Count(`solicitud`) AS `conteo` FROM `solicitudes_solicitudes` WHERE  `servicio`='01' AND `categoria`='3' AND `equipo`='2' AND `radicacion` BETWEEN '" . $inicio . "' AND '" . $final . "' ";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['conteo']);
  }

  function conteo_subsidia_alcantarillado($inicio, $final) {
    $db = new MySQL();
    $sql = "SELECT Count(`solicitud`) AS `conteo` FROM `solicitudes_solicitudes` WHERE `servicio`='02' AND `categoria`='3' AND `equipo`='3' AND `radicacion` BETWEEN '" . $inicio . "' AND '" . $final . "' ";
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

  function conteo_equipo_solicitudes($tipo, $equipo, $inicio, $final) {
    
  }

  /**
   * Evalua si el usuario es el propietario, responsable o pertenece al equipo de trabajo encargado de
   * tramitar la solicitud   *
   * @param type $solicitud
   */
  function responsable($solicitud) {
    $usuario = $this->sesion->usuario();
    $solicitud = $this->consultar($solicitud);
    if (($solicitud['creador'] == $usuario['usuario'])) {
      return("creador");
    } elseif (($solicitud['responsable'] == $usuario['usuario'])) {
      return("responsable");
    } elseif (($solicitud['equipo'] == $usuario['equipo'])) {
      return("equipo");
    } else {
      return("ninguna");
    }
  }

  /**
   * Evalua y retorna el estado de una solicitud.
   * Sin Respuesta=Rojo
   * Respuesta, Sin Notificacion=Naranja
   * Respuesta,Notificacion=Verde
   * @param type $solicitud
   */
  function estado_adjuntos($solicitud) {
    $db = new MySQL();
    $sql = "SELECT * FROM `solicitudes_archivos` WHERE `solicitud`='" . $solicitud . "' ;";
    $consulta = $db->sql_query($sql);
    $conteo = $db->sql_numrows($consulta);
    $db->sql_close();
    if ($conteo > 0) {
      return("existentes");
    } else {
      return("ninguno");
    }
  }

  /**
   * Evalua y retorna el estado de una solicitud SSPD.
   * 
   * @param type $solicitud
   */
  function estado_sspd($solicitud) {
    $db = new MySQL();
    $sql = "SELECT * FROM `solicitudes_traslados_sspd` WHERE `solicitud`='" . $solicitud . "' ;";
    $consulta = $db->sql_query($sql);
    $conteo = $db->sql_numrows($consulta);
    $db->sql_close();
    if ($conteo > 0) {
      return("trasladado");
    } else {
      return("ninguno");
    }
  }

  function estado_solicitud($solicitud) {
    $respuestas = new Respuestas();
    $notificaciones = new Notificaciones();
    $estado_respuesta = $respuestas->estado_respuesta($solicitud);
    $estado_notificacion = $notificaciones->estado_notificacion($solicitud);
    $estado_sspd = $this->estado_sspd($solicitud);
    if ($estado_respuesta == "verde" && $estado_notificacion == "verde") {
      if ($estado_sspd == "trasladado") {
        return("azul");
      } else {
        return("verde");
      }
    } elseif ($estado_respuesta == "rojo" && $estado_notificacion == "rojo") {
      return("rojo");
    } else {
      return("naranja");
    }
  }

  /** Retorna el numero de dias habiles trascurridos desde la fecha de la radicacion de la solicitud.
   *
   * @param type $solicitud
   */
  function tiempo($solicitud) {
    $solicitud = $this->consultar($solicitud);
    $fechas = new Fechas();
    $dias_habiles = $fechas->habiles($solicitud['radicacion'], $fechas->hoy());
    return($dias_habiles["conteo"]);
  }

  function estado_tiempo($solicitud) {
    $tiempo = $this->tiempo($solicitud);
    $estado_solicitud = $this->estado_solicitud($solicitud);
    if ($estado_solicitud == "verde"||$estado_solicitud == "azul") {
      return("verde");
    } elseif ($tiempo < 3) {
      return("verde");
    } elseif ($tiempo < 6) {
      return("naranja");
    } else {
      return("rojo");
    }
  }

  /**
   * Este metodo retorna la fecha de la primera solicitud creada o asignada a este usuario.
   * @param type $usuario
   * @return type
   */
  function fecha_mas_antigua($usuario) {
    $db = new MySQL();
    $sql = "SELECT  "
            . "MIN(`radicacion`) AS `fecha` "
            . "FROM `solicitudes_solicitudes` "
            . "WHERE(`creador`='" . $usuario . "') OR (`responsable`='" . $usuario . "') "
            . "ORDER BY `radicacion`ASC;";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['fecha']);
  }

  function fecha_mas_antigua_equipo($equipo) {
    $db = new MySQL();
    $sql = "SELECT  MIN(`radicacion`) AS `fecha` FROM `solicitudes_solicitudes` WHERE(`equipo`='" . $equipo . "') ORDER BY `radicacion`ASC;";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['fecha']);
  }

  /**
   * Este metodo retorna la fecha de la ultima solicitud creada o asignada a este usuario.
   * @param type $usuario
   * @return type
   */
  function fecha_mas_reciente($usuario) {
    $db = new MySQL();
    $sql = "SELECT  MAX(`radicacion`) AS `fecha` FROM `solicitudes_solicitudes` WHERE(`creador`='" . $usuario . "') OR (`responsable`='" . $usuario . "') ORDER BY `radicacion` DESC;";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['fecha']);
  }

  function fecha_mas_reciente_equipo($equipo) {
    $db = new MySQL();
    $sql = "SELECT  MAX(`radicacion`) AS `fecha` FROM `solicitudes_solicitudes` WHERE(`equipo`='" . $equipo . "') ORDER BY `radicacion`DESC;";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    return($fila['fecha']);
  }

  /**
   *  Retorna un elemento html tipo select que contiene los posibles criterios a usar en el componente de 
   * busqueda
   * 
   * @param type $nombre
   * @param type $seleccionado
   * @return type
   */
  function criterios($nombre, $seleccionado) {
    $etiquetas = array("Código de Solicitud", "Radicado Recibido", "Código Suscriptor", "Identificación Radicante", "Nombre Radicante", "Apellidos Radicante", "Dirección", "Servicio Relacionado", "Causal de Solicitud", "Factura", "Detalles Solicitud");
    $valores = array("solicitud", "radicado", "suscriptor", "identificacion", "nombres", "apellidos", "direccion", "servicio", "causal", "factura", "detalle");
    return($this->formularios->combo($nombre, $etiquetas, $valores, $seleccionado, ""));
  }

  function combo_campos($nombre, $seleccionado) {
    $componentes = new Componentes();
    $etiquetas = array("Suscriptor", "Solicitud", "Dirección", "Fecha Radicación");
    $valores = array("suscriptor", "solicitud", "direccion", "radicacion");
    return($componentes->combo($nombre, $etiquetas, $valores, $seleccionado));
  }

  
  function combo_responsabilizables($id,  $selected,$class = "", $disabled = false) {
    $disabled = ($disabled) ? "disabled=\"disabled\"" : "";
    $db = new MySQL();
    $sql = "SELECT * FROM `usuarios_usuarios` ORDER BY `alias`";
    $consulta = $db->sql_query($sql);
    $html = ('<select name="' . $id . '"id="' . $id . '" class="' . $class . '" ' . $disabled . '>');
    $conteo = 0;
    while ($fila = $db->sql_fetchrow($consulta)) {
      //if ($this->usuarios->permiso("SOLICITUDES-RESPONSABILIZABLE", $fila['usuario'])) {
        $html.=('<option value="' . $fila['usuario'] . '"' . (($selected == $fila['usuario']) ? "selected" : "") . '>' . $fila['usuario'] . ":  " . $fila['alias'] . '</option>');
      //}
      $conteo++;
    }
    $db->sql_close();
    $html.=("</select>");
    return($html);
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  function combo_usuarios($selected) {
    return($this->combo_consulta_usuarios("usuario", "alias", "usuario", "usuarios_usuarios", $selected, "", "height:30px; width:160px; font-size:24px;margin:0; padding-bottom:3"));
  }

  function combo_consulta_usuarios($id, $etiquetas, $valores, $tabla, $selected, $condicion = "", $class = "", $disabled = false) {
    if (empty($selected)) {
      $selected = isset($_REQUEST['_' . $id]) ? $_REQUEST['_' . $id] : "";
    }
    $disabled = ($disabled) ? "disabled=\"disabled\"" : "";
    $condicion = empty($condicion) ? "" : "WHERE(" . $condicion . ")";
    $db = new MySQL();
    $sql = "SELECT * FROM `" . $tabla . "` " . $condicion . " ORDER BY `" . $etiquetas . "`";
    $consulta = $db->sql_query($sql);
    $html = ('<select name="' . $id . '"id="' . $id . '" class="' . $class . '" ' . $disabled . '>');
    $conteo = 0;
    while ($fila = $db->sql_fetchrow($consulta)) {
      if ($this->usuarios->permiso("SOLICITUDES-RESPONSABILIZABLE", $fila['usuario'])) {
        $html.=('<option value="' . $fila[$valores] . '"' . (($selected == $fila[$valores]) ? "selected" : "") . '>' . $fila['usuario'] . ":  " . $fila['alias'] . '</option>');
      }
      $conteo++;
    }
    $db->sql_close();
    $html.=("</select>");
    return($html);
  }

  function combo($id, $etiquetas, $valores, $selected, $clase = "campo") {
    $html = ('<select name="' . $id . '"id="' . $id . '"  class="' . $clase . '">');
    for ($i = 0; $i < count($valores); $i++) {
      $html.=('<option value="' . $valores[$i] . '"' . (($selected == $valores[$i]) ? "selected" : "") . '>' . $etiquetas[$i] . '</option>');
    }$html.=("</select>");
    return($html);
  }

  function fecha_ultima_solicitud($usuario) {
    
  }

  /**
   * Retorna el numero total de solicitudes que han sido recibidas o asignadas aun usuario determinado del sistema
   * si los parametros base no son ingresados, seran remplazados por datos automaticos segun el sistema y en
   * conformidad con criterios preestablecidos de la siguiente forma, la fecha inicial por defecto sera la fecha de 
   * radicacion de la primera solicitud ingresada por el usuario en el sistema, la fecha de finalizacion sera de 
   * radicación de la ultima solicitud  ingresada por el usuario al sistema, de no proporsionarse el usuario  consultar
   * se asume que el usuario en cuestion es el usuario activo.
   * @param type $inicio
   * @param type $final
   * @param type $usuario
   * @return type
   */
  function estadistica_solicitudes_usuario_total($inicio = "", $final = "", $usuario = "") {
//    $usuario = empty($usuario) ? $this->sesion->usuario() : $usuario;
//    $inicio = empty($inicio) ? $this->fecha_mas_antigua($usuario) : $inicio;
//    $final = empty($final) ? $this->fecha_mas_reciente($usuario) : $final;

    $db = new MySQL();
    $sql = ""
            . "SELECT Count(`solicitud`) AS `conteo` "
            . "FROM `solicitudes_solicitudes` "
            . "WHERE ("
            . "(`radicacion` BETWEEN '" . $inicio . "' AND '" . $final . "')AND"
            . "(`creador`='" . $usuario . "' OR `responsable`='" . $usuario . "')"
            . ");";

    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    $recibidas = (intval($fila['conteo']));
    $db->sql_close();
    return($recibidas);
  }

  function estadistica_solicitudes_equipo_total($inicio = "", $final = "", $equipo = "") {
    $usuario = empty($usuario) ? $this->sesion->usuario() : $usuario;
    $inicio = empty($inicio) ? $this->fecha_mas_antigua_equipo($usuario) : $inicio;
    $final = empty($final) ? $this->fecha_mas_reciente_equipo($usuario) : $final;
    $usuario = $this->usuarios->consultar($usuario);
    $db = new MySQL();
    $sql = ""
            . "SELECT Count(`solicitud`) AS `conteo` "
            . "FROM `solicitudes_solicitudes` "
            . "WHERE ("
            . "(`radicacion` BETWEEN '" . $inicio . "' AND '" . $final . "')AND"
            . "(`equipo`='" . $equipo. "')"
            . ");";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    $recibidas = (intval($fila['conteo']));
    $db->sql_close();
    return($recibidas);
  }

  /**
   * En concepto el numero total de solicitudes solucionadas sera igual al conteo de todas aquellas solicitudes 
   * que tengan una respuesta publica radicada y la notificación concerniente a la misma registrada. Por dicernimiento
   * la diferencia entre la cantidad de solicitudes solucionadas  y el total de solicitudes existente sera el numero
   * total de solicitudes pendientes de solución.
   * @param type $inicio
   * @param type $final
   * @param type $usuario
   * @return type
   */
  function estadistica_solicitudes_usuario_solucionadas($inicio, $final, $usuario) {
    $db = new MySQL();
    $sql = "
      SELECT 
        `solicitudes_solicitudes`.`solicitud`,
        `solicitudes_solicitudes`.`radicacion` AS `radicacion`,
        `solicitudes_solicitudes`.`creador` AS `creador`,
        `solicitudes_solicitudes`.`responsable`  AS `responsable`,
        `solicitudes_respuestas`.`solicitud` AS `solicitud_respuesta`, 
        `solicitudes_respuestas`.`categoria`,
        `solicitudes_notificaciones`.`solicitud` AS `solicitud_notificacion`, 
        `solicitudes_respuestas`.`respuesta`, 
        `solicitudes_notificaciones`.`notificacion`
    FROM 
        `solicitudes_solicitudes` 
        INNER JOIN `solicitudes_respuestas` ON `solicitudes_solicitudes`.`solicitud` = `solicitudes_respuestas`.`solicitud` 
        INNER JOIN `solicitudes_notificaciones` ON `solicitudes_solicitudes`.`solicitud` = `solicitudes_notificaciones`.`solicitud` 
    WHERE( 
        (`solicitudes_solicitudes`.`radicacion`  BETWEEN '" . $inicio . "' AND '" . $final . "')AND 
        (`solicitudes_solicitudes`.`creador`='" . $usuario . "' OR `solicitudes_solicitudes`.`responsable`='" . $usuario . "')
    )
    GROUP BY 
  `solicitudes_respuestas`.`solicitud`,
  `solicitudes_notificaciones`.`solicitud`
    ; ";
    //echo($sql);
    $consulta = $db->sql_query($sql);
    $solucionadas = $db->sql_numrows($consulta);
    $db->sql_close();
    return($solucionadas);
  }

  function estadistica_solicitudes_equipo_solucionadas($inicio, $final, $equipo) {
    $db = new MySQL();
    $sql = "
      SELECT 
        `solicitudes_solicitudes`.`solicitud`,
        `solicitudes_solicitudes`.`radicacion` AS `radicacion`,
        `solicitudes_solicitudes`.`equipo` AS `equipo`,
        `solicitudes_respuestas`.`solicitud` AS `solicitud_respuesta`, 
        `solicitudes_respuestas`.`categoria`,
        `solicitudes_notificaciones`.`solicitud` AS `solicitud_notificacion`, 
        `solicitudes_respuestas`.`respuesta`, 
        `solicitudes_notificaciones`.`notificacion`
    FROM 
        `solicitudes_solicitudes` 
        INNER JOIN `solicitudes_respuestas` ON `solicitudes_solicitudes`.`solicitud` = `solicitudes_respuestas`.`solicitud` 
        INNER JOIN `solicitudes_notificaciones` ON `solicitudes_solicitudes`.`solicitud` = `solicitudes_notificaciones`.`solicitud` 
    WHERE( 
        (`solicitudes_solicitudes`.`radicacion`  BETWEEN '" . $inicio . "' AND '" . $final . "')AND 
        (`solicitudes_solicitudes`.`equipo`='" . $equipo . "')
    )
    GROUP BY 
  `solicitudes_respuestas`.`solicitud`,
  `solicitudes_notificaciones`.`solicitud`
    ; ";
    $consulta = $db->sql_query($sql);
    $solucionadas = $db->sql_numrows($consulta);
    $db->sql_close();
    return($solucionadas);
  }

}

?>