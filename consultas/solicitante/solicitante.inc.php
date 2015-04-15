<?php

$root = (!isset($root)) ? "../../../../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
$solicitudes = new Solicitudes();
$cadenas = new Cadenas();
$componentes = new Componentes();
$suscriptores = new Suscriptores();
$respuestas = new Respuestas();
$notificaciones = new Notificaciones();
$servicios = new Servicios();
$categorias = new Categorias();
$causales = new Causales();
/** Variables Recibidas & Generadas * */
$transaccion = isset($_REQUEST['transaccion']) ? $_REQUEST['transaccion'] : time();
$solicitud = $solicitudes->consultar(@$_REQUEST['solicitud']);
$servicio = $servicios->consultar($solicitud['servicio']);
$estado_respuesta = $respuestas->estado_respuesta($solicitud['solicitud']);
$estado_notificacion = $notificaciones->estado_notificacion($solicitud['solicitud']);
$categoria = $categorias->consultar($solicitud['categoria']);
$asunto = $asuntos->consultar($solicitud['asunto']);
$suscriptor = $suscriptores->consultar($solicitud['suscriptor']);
$f = new Formularios($transaccion);
//echo($f->apertura());
/* * ************************************************************************************************** */
/** Valores * */
$valores = $solicitud;
/** Campos * */
$f->campos['solicitud'] = $f->campo("solicitud", $valores['solicitud']);
$f->campos['dane'] = $f->campo("dane", $valores['dane']);
$f->campos['servicio'] = $f->campo("servicio", $servicio['servicio'] . ": " . $servicio['nombre']);
$f->campos['radicado'] = $f->campo("radicado", $valores['radicado']);
$f->campos['radicacion'] = $f->campo("radicacion", $valores['radicacion']);
$f->campos['categoria'] = $f->campo("categoria", $categoria['categoria'] . ": " . $categoria['nombre']);
$f->campos['asunto'] = $f->campo("asunto", $valores['asunto']);
$f->campos['detalle'] = $f->campo("detalle", $valores['detalle']);
$f->campos['suscriptor'] = $f->campo("suscriptor", $valores['suscriptor']);
$f->campos['suscriptor_nombre'] = $f->campo("suscriptornombre", $cadenas->capitalizar($suscriptor['nombres'] . " " . $suscriptor['apellidos']));
$f->campos['suscriptor_direccion'] = $f->campo("suscriptordireccion", ($suscriptor['direccion'] . "" . $suscriptor['referencia']));
$f->campos['suscriptor_telefonos'] = $f->campo("suscriptortelefonos", $suscriptor['telefonos']);
$f->campos['suscriptor_correo'] = $f->campo("suscriptorcorreo", $suscriptor['correo']);
$f->campos['factura'] = $f->campo("factura", $valores['factura']);
$f->campos['respuesta'] = $f->campo("respuesta", $valores['respuesta']);
$f->campos['contestacion'] = $f->campo("contestacion", $valores['contestacion']);
$f->campos['radicada'] = $f->campo("radicada", $valores['radicada']);
$f->campos['notificado'] = $f->campo("notificado", $valores['notificado']);
$f->campos['notificacion'] = $f->campo("notificacion", $valores['notificacion']);
$f->campos['sspd'] = $f->campo("sspd", $valores['sspd']);
$f->campos['ejecucion'] = $f->campo("ejecucion", $valores['ejecucion']);
$f->campos['orden'] = $f->campo("orden", $valores['orden']);
$f->campos['fecha'] = $f->campo("fecha", $valores['fecha']);
$f->campos['documentos'] = $f->campo("documentos", $valores['documentos']);
$f->campos['identificacion'] = $f->campo("identificacion", $valores['identificacion']);
$f->campos['nombres'] = $f->campo("nombres", $valores['nombres']);
$f->campos['apellidos'] = $f->campo("apellidos", $valores['apellidos']);
$f->campos['nombre'] = $f->campo("nombre", $cadenas->capitalizar($valores['nombres'] . " " . $valores['apellidos']));
$f->campos['sexo'] = $f->campo("sexo", $valores['sexo']);
$f->campos['nacimiento'] = $f->campo("nacimiento", $valores['nacimiento']);
$f->campos['telefono'] = $f->campo("telefono", $valores['telefono']);
$f->campos['movil'] = $f->campo("movil", $valores['movil']);
$f->campos['correo'] = $f->campo("correo", $valores['correo']);
$f->campos['pais'] = $f->campo("pais", $valores['pais']);
$f->campos['region'] = $f->campo("region", $valores['region']);
$f->campos['ciudad'] = $f->campo("ciudad", $valores['ciudad']);
$f->campos['sector'] = $f->campo("sector", $valores['sector']);
$f->campos['direccion'] = $f->campo("direccion", $valores['direccion']);
$f->campos['referencia'] = $f->campo("referencia", $valores['referencia']);
$f->campos['expiracion'] = $f->campo("expiracion", $valores['expiracion']);
$f->campos['instalacion'] = $f->campo("instalacion", $valores['instalacion']);
$f->campos['instalacionsector'] = $f->campo("instalacionsector", $valores['instalacionsector']);
$f->campos['estrato'] = $f->campo("estrato", $valores['estrato']);
$f->campos['diametro'] = $f->campo("diametro", $valores['diametro']);
$f->campos['legalizado'] = $f->campo("legalizado", $valores['legalizado']);
$f->campos['matricula'] = $f->campo("matricula", $valores['matricula']);
$f->campos['tipoderespuesta'] = $f->campo("tipoderespuesta", $valores['tipoderespuesta']);
$f->campos['ordenservicio'] = $f->campo("ordenservicio", $valores['ordenservicio']);
$f->campos['ordencobro'] = $f->campo("ordencobro", $valores['ordencobro']);
$f->campos['creador'] = $f->campo("creador", $valores['creador']);
$f->campos['responsable'] = $f->campo("responsable", $valores['responsable']);
$f->campos['origen'] = $f->campo("origen", $valores['origen']);
$f->campos['equipo'] = $f->campo("equipo", $valores['equipo']);
$f->campos['actualizar'] = $f->button("actualizar" . $f->id, "button", "Actualizar");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Cerrar");
$f->campos['responder'] = $f->button("responder" . $f->id, "button", "Responder");
$f->campos['notificar'] = $f->button("notificar" . $f->id, "button", "Notificar");
$f->campos['modificar'] = $f->button("modificar" . $f->id, "button", "Modificar");
/** Celdas * */
$f->celdas["solicitud"] = $f->celda("Solicitud (Código):", $f->campos['solicitud'], "", "w150");
$f->celdas["dane"] = $f->celda("dane:", $f->campos['dane']);
$f->celdas["servicio"] = $f->celda("Servicio Relacionado:", $f->campos['servicio']);
$f->celdas["radicado"] = $f->celda("Radicado:", $f->campos['radicado']);
$f->celdas["radicacion"] = $f->celda("Fecha de Radicación:", $f->campos['radicacion']);
$f->celdas["categoria"] = $f->celda("Categoría:", $f->campos['categoria'], "", "w200");
$f->celdas["asunto"] = $f->celda("asunto:", $f->campos['asunto']);
$f->celdas["detalle"] = $f->celda("Detalle / Contenido / Descripción:", $f->campos['detalle']);
$f->celdas["suscriptor"] = $f->celda("suscriptor:", $f->campos['suscriptor']);
$f->celdas["suscriptor_nombre"] = $f->celda("Nombre Completo:", $f->campos['suscriptor_nombre']);
$f->celdas["suscriptor_direccion"] = $f->celda("Dirección Del Inmueble / Propiedad:", $f->campos['suscriptor_direccion']);
$f->celdas["suscriptor_telefonos"] = $f->celda("Teléfonos:", $f->campos['suscriptor_telefonos']);
$f->celdas["suscriptor_correo"] = $f->celda("Correo Electrónico:", $f->campos['suscriptor_correo']);
$f->celdas["factura"] = $f->celda("factura:", $f->campos['factura']);
$f->celdas["respuesta"] = $f->celda("Respuesta:", $f->campos['respuesta']);
$f->celdas["contestacion"] = $f->celda("Fecha Contestación:", $f->campos['contestacion']);
$f->celdas["radicada"] = $f->celda("Radicado (Respuesta):", $f->campos['radicada']);
$f->celdas["notificado"] = $f->celda("notificado:", $f->campos['notificado']);
$f->celdas["notificacion"] = $f->celda("notificacion:", $f->campos['notificacion']);
$f->celdas["sspd"] = $f->celda("sspd:", $f->campos['sspd']);
$f->celdas["ejecucion"] = $f->celda("ejecucion:", $f->campos['ejecucion']);
$f->celdas["orden"] = $f->celda("orden:", $f->campos['orden']);
$f->celdas["fecha"] = $f->celda("fecha:", $f->campos['fecha']);
$f->celdas["nombres"] = $f->celda("nombres:", $f->campos['nombres']);
$f->celdas["apellidos"] = $f->celda("apellidos:", $f->campos['apellidos']);
$f->celdas["nombre"] = $f->celda("Nombre Completo (Solicitante): ", $f->campos['nombre'], "", "w300");
$f->celdas["documentos"] = $f->celda("Tipo de idenificación:", $f->campos['documentos']);
$f->celdas["identificacion"] = $f->celda("Identificación:", $f->campos['identificacion']);
$f->celdas["nacimiento"] = $f->celda("Fecha de nacimiento:", $f->campos['nacimiento'], "", "w150");
$f->celdas["sexo"] = $f->celda("Sexo:", $f->campos['sexo']);
$f->celdas["telefono"] = $f->celda("Telefono Fijo:", $f->campos['telefono']);
$f->celdas["movil"] = $f->celda("movil (movil):", $f->campos['movil']);
$f->celdas["correo"] = $f->celda("Correo Electrónico:", $f->campos['correo']);
$f->celdas["pais"] = $f->celda("pais:", $f->campos['pais']);
$f->celdas["region"] = $f->celda("region:", $f->campos['region']);
$f->celdas["ciudad"] = $f->celda("ciudad:", $f->campos['ciudad']);
$f->celdas["sector"] = $f->celda("sector:", $f->campos['sector']);
$f->celdas["direccion"] = $f->celda("Dirección Del Solicitante:", $f->campos['direccion']);
$f->celdas["referencia"] = $f->celda("Referencia:", $f->campos['referencia']);
$f->celdas["expiracion"] = $f->celda("expiracion:", $f->campos['expiracion']);
$f->celdas["instalacion"] = $f->celda("instalacion:", $f->campos['instalacion']);
$f->celdas["estrato"] = $f->celda("estrato:", $f->campos['estrato']);
$f->celdas["diametro"] = $f->celda("diametro:", $f->campos['diametro']);
$f->celdas["legalizado"] = $f->celda("legalizado:", $f->campos['legalizado']);
$f->celdas["matricula"] = $f->celda("matricula:", $f->campos['matricula']);
$f->celdas["tipoderespuesta"] = $f->celda("tipoderespuesta:", $f->campos['tipoderespuesta']);
$f->celdas["creador"] = $f->celda("creador:", $f->campos['creador']);
$f->celdas["ordenservicio"] = $f->celda("ordenservicio:", $f->campos['ordenservicio']);
$f->celdas["ordencobro"] = $f->celda("ordencobro:", $f->campos['ordencobro']);
$f->celdas["respuesta_archivo"] = $f->celda("Archivo Digital: <a href=\"modulos/comercial/archivos/salida/" . $solicitud['radicada'] . ".pdf#toolbar=1\" target=\"_blank\">Pantalla Completa</a>", "<embed src=\"modulos/comercial/archivos/salida/" . $solicitud['radicada'] . ".pdf#toolbar=1\" width=\"100%\" height=\"230\">");
/** Filas * */
$f->fila["solicitante1"] = $f->fila($f->celdas["identificacion"] . $f->celdas["nombre"] . $f->celdas["nacimiento"] . $f->celdas["sexo"]);
$f->fila["solicitante2"] = $f->fila($f->celdas["telefono"] . $f->celdas["movil"] . $f->celdas["correo"]);
$f->fila["solicitante3"] = $f->fila($f->celdas["direccion"] . $f->celdas["referencia"]);
$f->fila["suscriptor1"] = $f->fila($f->celdas["suscriptor"] . $f->celdas["suscriptor_nombre"] . $f->celdas["suscriptor_direccion"]);
$f->fila["suscriptor2"] = $f->fila($f->celdas["suscriptor_telefonos"] . $f->celdas["suscriptor_correo"]);
$divcarga = "divcarga" . time();
$f->filas("<div id=\"" . $divcarga . "\">");
$f->filas($f->titulo("Datos del solicitante."));
$f->filas($f->fila['solicitante1']);
$f->filas($f->fila['solicitante2']);
$f->filas($f->fila['solicitante3']);
$f->filas($f->titulo("Datos del suscriptor."));
$f->filas($f->fila['suscriptor1']);
$f->filas($f->fila['suscriptor2']);
$f->filas("</div>");
/** Botones * */
$f->botones($f->campos['cancelar']);
$responsabilidad = $solicitudes->responsable($solicitud['solicitud']);
if ($responsabilidad != "ninguna") {
  if ($estado_respuesta == "rojo") {
    if ($responsabilidad == "creador") {
      $f->botones($f->campos['modificar']);
    }
    $f->botones($f->campos['responder']);
  } elseif ($estado_respuesta == "verde") {
    if ($estado_notificacion == "rojo") {
      $f->botones($f->campos['notificar']);
    } else {

    }
  }
}
/* * ************************************************************************************************** */
//echo($f->cierre());
?>
