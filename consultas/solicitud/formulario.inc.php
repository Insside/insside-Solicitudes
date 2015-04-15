<?php

$root = (!isset($root)) ? "../../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
$cadenas = new Cadenas();
$fechas = new Fechas();
$paises = new Paises();
$regiones = new Regiones();
$ciudades = new Ciudades();
$sectores = new Sectores();
$sevicios = new Servicios();
$categorias = new Categorias();
$solicitudes = new Solicitudes();
$causales = new Causales();
$validaciones = new Validaciones();
$respuestas = new Respuestas();
$notificaciones = new Notificaciones();
$asuntos = new Asuntos();
$suscriptores = new Suscriptores();
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

/** Variables * */
/** Valores * */
$s = $solicitudes->consultar($validaciones->recibir('solicitud'));
$servicio = $servicios->consultar($s['servicio']);
$categoria = $categorias->consultar($s['categoria']);
$causal = $causales->consultar($servicio['servicio'], $s['causal']);
$asunto = $asuntos->consultar($s['asunto']);
$pais = $paises->consultar($s['pais']);
$region = $regiones->consultar($pais['pais'], $s['region']);
$ciudad = $ciudades->consultar($s['ciudad']);
$sector = $sectores->consultar($s['sector']);
$suscriptor = $suscriptores->consultar($s['suscriptor']);
$valores = $s;
require_once($root . "modulos/solicitudes/consultas/solicitud/componentes/encabezado.inc.php");
/** Analisis de Responsabilidades * */
$estado['responsabilidad'] = $solicitudes->responsable($s['solicitud']);
$estado['respuesta'] = $respuestas->estado_respuesta($s['solicitud']);
$estado['notificacion'] = $notificaciones->estado_notificacion($s['solicitud']);
$vinculo['editar_solicitud'] = "";
if ($estado['responsabilidad'] != "ninguna") {
  if ($estado['respuesta'] == "rojo") {
    if ($estado['responsabilidad'] == "creador") {
      $vinculo['modificar_solicitud'] = " [ <a href=\"#\" onClick=\"MUI.Solicitudes_Solicitud_Modificar_Solicitud('" . $s['solicitud'] . "');\"> Modificar </a>]";
      $vinculo['modificar_solicitante'] = " [ <a href=\"#\" onClick=\"MUI.Solicitudes_Solicitud_Modificar_Solicitante('" . $s['solicitud'] . "');\"> Modificar </a>]";
    }
//    $f->botones($f->campos['responder']);
  } elseif ($estado['respuesta'] == "verde") {
//    if ($estado['notificacion']== "rojo") {
    $vinculo['modificar_solicitud'] = " [ <a href=\"#\" onClick=\"MUI.Solicitudes_Solicitud_Modificar_Solicitud('" . $s['solicitud'] . "');\"> Modificar </a>]";
    $vinculo['modificar_solicitante'] = " [ <a href=\"#\" onClick=\"MUI.Solicitudes_Solicitud_Modificar_Solicitante('" . $s['solicitud'] . "');\"> Modificar </a>]";
    $vinculo['notificar'] = " [ <a href=\"#\" onClick=\"MUI.Solicitudes_Solicitud_Notificar('" . $s['solicitud'] . "');\"> Generar Documento </a>]";
//    } else {
//
//    }
  }
}
/** Campos * */
$f->campos['solicitud'] = $f->campo("solicitud", $valores['solicitud']);
$f->campos['dane'] = $f->campo("dane", $valores['dane']);
$f->campos['servicio'] = $f->campo("servicio", $servicio['servicio'] . ": " . $servicio['nombre']);
$f->campos['radicado'] = $f->campo("radicado", $valores['radicado']);
$f->campos['radicacion'] = $f->campo("radicacion", $valores['radicacion']);
$f->campos['categoria'] = $f->campo("categoria" . $f->id, $categoria['categoria'] . ": " . $categoria['nombre']);
$f->campos['causal'] = $f->campo("causal" . $f->id, $causal['causal'] . ": " . $causal['titulo']);
$f->campos['asunto'] = $f->campo("asunto", "" . ((int) $valores['asunto']) . ": " . $asunto['descripcion']);
$f->campos['detalle'] = $f->campo("detalle", urldecode($valores['detalle']), "overflowy textalignleft h100");
$f->campos['suscriptor'] = $f->campo("suscriptor", $valores['suscriptor']);
$f->campos['suscriptor_identificacion'] = $f->campo("suscriptor_identificacion", $suscriptor['documento'] . " " . $suscriptor['identificacion']);
$f->campos['suscriptor_nombres'] = $f->campo("suscriptor_nombres", $cadenas->capitalizar($suscriptor['nombres']));
$f->campos['suscriptor_apellidos'] = $f->campo("suscriptor_apellidos", $cadenas->capitalizar($suscriptor['apellidos']));
$f->campos['suscriptor_direccion'] = $f->campo("suscriptor_direccion", $cadenas->capitalizar($suscriptor['direccion'] . " " . $suscriptor['referencia']));
$f->campos['suscriptor_estrato'] = $f->campo("suscriptor_estrato", $suscriptor['estrato']);
$f->campos['suscriptor_predial'] = $f->campo("suscriptor_predial", $suscriptor['predial']);
$f->campos['suscriptor_telefonos'] = $f->campo("suscriptor_telefonos", $suscriptor['telefonos']);
$f->campos['suscriptor_correo'] = $f->campo("suscriptor_correo", $suscriptor['correo']);

$f->campos['factura'] = $f->campo("factura", $valores['factura']);
$f->campos['sspd'] = $f->campo("sspd", $valores['sspd']);
$f->campos['ejecucion'] = $f->campo("ejecucion", $valores['ejecucion']);
$f->campos['orden'] = $f->campo("orden", $valores['orden']);
$f->campos['fecha'] = $f->campo("fecha", $valores['fecha']);
$f->campos['documentos'] = $f->campo("documentos", $valores['documentos']);
$f->campos['identificacion'] = $f->campo("identificacion", $valores['documentos'] . " " . $valores['identificacion']);
$f->campos['nombres'] = $f->campo("nombres", $valores['nombres']);
$f->campos['apellidos'] = $f->campo("apellidos", $valores['apellidos']);
$f->campos['nombre'] = $f->campo("nombre", $valores['nombres'] . " " . $valores['apellidos']);
$f->campos['sexo'] = $f->campo("sexo", $valores['sexo']);
$f->campos['nacimiento'] = $f->campo("nacimiento", $valores['nacimiento']);
$f->campos['telefono'] = $f->campo("telefono", $valores['telefono']);
$f->campos['movil'] = $f->campo("movil", $valores['movil']);
$f->campos['correo'] = $f->campo("correo", $valores['correo']);
$f->campos['pais'] = $f->campo("pais", $valores['pais'] . ": " . $pais['nombre']);
$f->campos['region'] = $f->campo("region", $valores['region'] . ": " . $region['nombre']);
$f->campos['ciudad'] = $f->campo("ciudad", $valores['ciudad'] . ": " . $ciudad['nombre']);
$f->campos['sector'] = $f->campo("sector", $valores['sector'] . ": " . $sector['nombre']);
$f->campos['direccion'] = $f->campo("direccion", $valores['direccion']);
$f->campos['residencia'] = $f->campo("direccion", $valores['direccion'] . " " . $valores['referencia']);
$f->campos['referencia'] = $f->campo("referencia", $valores['referencia']);
$f->campos['expiracion'] = $f->campo("expiracion", $valores['expiracion']);
$f->campos['instalacion'] = $f->campo("instalacion", $valores['instalacion']);
$f->campos['instalacionsector'] = $f->campo("instalacionsector", @$valores['instalacionsector']);
$f->campos['estrato'] = $f->campo("estrato", $valores['estrato']);
$f->campos['diametro'] = $f->campo("diametro", $valores['diametro']);
$f->campos['legalizado'] = $f->campo("legalizado", $valores['legalizado']);
$f->campos['matricula'] = $f->campo("matricula", $valores['matricula']);
$f->campos['creador'] = $f->campo("creador", $valores['creador']);
$f->campos['responsable'] = $f->campo("responsable", $valores['responsable']);
$f->campos['origen'] = $f->campo("origen", $valores['origen']);
$f->campos['equipo'] = $f->campo("equipo", $valores['equipo']);


/** Celdas * */
$f->celdas["solicitud"] = $f->celda("Código Solicitud: [ <a href=\"#\" onClick=\"MUI.Solicitudes_Ayuda('codigosolicitud');\">?</a> ]", $f->campos['solicitud'], "", "w200");
$f->celdas["dane"] = $f->celda("Código Dane: [ <a href=\"#\" onClick=\"MUI.Solicitudes_Ayuda('codigodane');\">?</a> ]", $f->campos['dane']);
$f->celdas["servicio"] = $f->celda("Servicio Relacionado: [ <a href=\"#\" onClick=\"MUI.Solicitudes_Ayuda('servicio');\">?</a> ]", $f->campos['servicio']);
$f->celdas["radicado"] = $f->celda("Radicado Recibido: [ <a href=\"#\" onClick=\"MUI.Solicitudes_Ayuda('radicadorecibido');\">?</a> ]", $f->campos['radicado']);
$f->celdas["radicacion"] = $f->celda("Fecha de Radicación: [ <a href=\"#\" onClick=\"MUI.Solicitudes_Ayuda('fecharadicacion');\">?</a> ]", $f->campos['radicacion']);
$f->celdas["categoria"] = $f->celda("Categoría / Tipo de Trámite: [ <a href=\"#\" onClick=\"MUI.Solicitudes_Ayuda('categoriasolicitud');\">?</a> ]", $f->campos['categoria']);
$f->celdas["causal"] = $f->celda("Detalle de la Causal: [ <a href=\"#\" onClick=\"MUI.Solicitudes_Ayuda('causal');\">?</a> ]", $f->campos['causal']);
$f->celdas["asunto"] = $f->celda("Asunto:", $f->campos['asunto']);
$f->celdas["detalle"] = $f->celda("Detalle / Contenido Textual de la Solicitud Registrada:", $f->campos['detalle']);
$f->celdas["suscriptor"] = $f->celda("Número de Cuenta / Suscriptor: [ <a href=\"#\" onClick=\"MUI.Solicitudes_Ayuda('suscriptor');\">?</a> ]", $f->campos['suscriptor'], "", "w200");
$f->celdas["suscriptor_identificacion"] = $f->celda("Identificación:", $f->campos['suscriptor_identificacion']);
$f->celdas["suscriptor_nombres"] = $f->celda("Nombres:", $f->campos['suscriptor_nombres']);
$f->celdas["suscriptor_apellidos"] = $f->celda("Apellidos:", $f->campos['suscriptor_apellidos']);
$f->celdas["suscriptor_direccion"] = $f->celda("Dirección:", $f->campos['suscriptor_direccion']);
$f->celdas["suscriptor_estrato"] = $f->celda("Estrato:", $f->campos['suscriptor_estrato']);
$f->celdas["suscriptor_predial"] = $f->celda("Predial:", $f->campos['suscriptor_predial']);
$f->celdas["suscriptor_telefonos"] = $f->celda("Telefonos:", $f->campos['suscriptor_telefonos']);
$f->celdas["suscriptor_correo"] = $f->celda("Correo Electrónico:", $f->campos['suscriptor_correo']);

$f->celdas["factura"] = $f->celda("Factura en Reclamación: [ <a href=\"#\" onClick=\"MUI.Solicitudes_Ayuda('factura');\">?</a> ]", $f->campos['factura'], "", "w200");
$f->celdas["sspd"] = $f->celda("Sspd:", $f->campos['sspd']);
$f->celdas["ejecucion"] = $f->celda("Ejecucion:", $f->campos['ejecucion']);
$f->celdas["orden"] = $f->celda("Orden:", $f->campos['orden']);
$f->celdas["fecha"] = $f->celda("Fecha:", $f->campos['fecha']);
$f->celdas["documentos"] = $f->celda("Documentos:", $f->campos['documentos']);
$f->celdas["identificacion"] = $f->celda("Identificacion:", $f->campos['identificacion']);
$f->celdas["nombres"] = $f->celda("Nombres:", $f->campos['nombres']);
$f->celdas["apellidos"] = $f->celda("Apellidos:", $f->campos['apellidos']);
$f->celdas["nombre"] = $f->celda("Nombre Completo:", $f->campos['nombre']);
$f->celdas["sexo"] = $f->celda("Sexo:", $f->campos['sexo'], "", "w100");
$f->celdas["nacimiento"] = $f->celda("Nacimiento:", $f->campos['nacimiento'], "", "w100");
$f->celdas["telefono"] = $f->celda("Telefono:", $f->campos['telefono'], "", "w150");
$f->celdas["movil"] = $f->celda("Movil:", $f->campos['movil'], "", "w150");
$f->celdas["correo"] = $f->celda("Correo Electrónico:", $f->campos['correo']);
$f->celdas["pais"] = $f->celda("Pais:", $f->campos['pais']);
$f->celdas["region"] = $f->celda("Region:", $f->campos['region']);
$f->celdas["ciudad"] = $f->celda("Ciudad:", $f->campos['ciudad']);
$f->celdas["sector"] = $f->celda("Sector:", $f->campos['sector']);
$f->celdas["direccion"] = $f->celda("Direccion:", $f->campos['direccion']);
$f->celdas["referencia"] = $f->celda("Referencia:", $f->campos['referencia']);
$f->celdas["residencia"] = $f->celda("Dirección de Correspondencia:", $f->campos['residencia']);
$f->celdas["expiracion"] = $f->celda("Fecha Resolutoria Límite: [ <a href=\"#\" onClick=\"MUI.Solicitudes_Ayuda('fechalimite');\">?</a> ]", $f->campos['expiracion']);
$f->celdas["instalacion"] = $f->celda("Instalacion:", $f->campos['instalacion']);
$f->celdas["instalacionsector"] = $f->celda("Instalacionsector:", $f->campos['instalacionsector']);
$f->celdas["estrato"] = $f->celda("Estrato:", $f->campos['estrato']);
$f->celdas["diametro"] = $f->celda("Diametro:", $f->campos['diametro']);
$f->celdas["legalizado"] = $f->celda("Legalizado:", $f->campos['legalizado']);
$f->celdas["matricula"] = $f->celda("Matricula:", $f->campos['matricula']);
$f->celdas["creador"] = $f->celda("Creador:", $f->campos['creador']);
$f->celdas["responsable"] = $f->celda("Responsable:", $f->campos['responsable']);
$f->celdas["origen"] = $f->celda("Origen:", $f->campos['origen']);
$f->celdas["equipo"] = $f->celda("Equipo:", $f->campos['equipo']);

/** Filas * */
$f->fila["i1"] = "<h2>1. Información de la Solicitud" . @$vinculo['modificar_solicitud'] . ".</h2>";
$f->fila["f1"] = $f->fila($f->celdas["solicitud"] . $f->celdas["dane"] . $f->celdas["radicado"] . $f->celdas["radicacion"] . $f->celdas["expiracion"]);
$f->fila["f2"] = $f->fila($f->celdas["suscriptor"] . $f->celdas["factura"] . $f->celdas["servicio"] . $f->celdas["categoria"]);
$f->fila["f3"] = $f->fila($f->celdas["causal"] . $f->celdas["asunto"]);
$f->fila["f4"] = $f->fila($f->celdas["detalle"]);
$f->fila["i2"] = "<h2>2. Datos del Solicitante" . @$vinculo['modificar_solicitante'] . ".</h2>";
$f->fila["solicitante1"] = $f->fila($f->celdas["identificacion"] . $f->celdas["nombre"] . $f->celdas["sexo"] . $f->celdas["nacimiento"]);
$f->fila["solicitante2"] = $f->fila($f->celdas["telefono"] . $f->celdas["movil"] . $f->celdas["correo"] . $f->celdas["residencia"]);
$f->fila["solicitante3"] = $f->fila($f->celdas["sector"] . $f->celdas["ciudad"] . $f->celdas["region"] . $f->celdas["pais"]);



$f->fila["i5"] = $f->fila("<h2>5. Notificación.</h2>");
$f->fila["f14"] = $f->fila($f->celdas["instalacion"] . $f->celdas["instalacionsector"] . $f->celdas["estrato"]);
$f->fila["f15"] = $f->fila($f->celdas["diametro"] . $f->celdas["legalizado"] . $f->celdas["matricula"]);
$f->fila["f17"] = $f->fila($f->celdas["creador"] . $f->celdas["responsable"] . $f->celdas["origen"]);
$f->fila["f18"] = $f->fila($f->celdas["equipo"]);
/** Compilando * */
$f->filas($f->fila['i1']);
$f->filas($f->fila['f1']);
$f->filas($f->fila['f2']);
$f->filas($f->fila['f3']);
$f->filas($f->fila['f4']);
$f->filas($f->fila['i2']);
$f->filas($f->fila['solicitante1']);
$f->filas($f->fila['solicitante2']);
$f->filas($f->fila['solicitante3']);

/** Componentes **/
if($s['causal']!="211"){require_once($root . "modulos/solicitudes/consultas/solicitud/componentes/suscriptor.inc.php");}
require_once($root . "modulos/solicitudes/consultas/solicitud/componentes/respuestas.inc.php");
require_once($root . "modulos/solicitudes/consultas/solicitud/componentes/notificaciones.inc.php");
require_once($root . "modulos/solicitudes/consultas/solicitud/componentes/adjuntos.inc.php");
require_once($root . "modulos/solicitudes/consultas/solicitud/componentes/botones.inc.php");
?>