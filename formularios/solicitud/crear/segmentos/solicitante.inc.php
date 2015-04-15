<?php
$solicitudes = new Solicitudes();
$cadenas = new Cadenas();
$categorias = new Categorias();
$componentes = new Componentes();
$suscriptores = new Suscriptores();
$paises = new Paises();
$regiones = new Regiones();
$ciudades = new Ciudades();
$sectores = new Sectores();
$suscriptores=new Suscriptores();
$validaciones=new Validaciones();
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
/** Asignación De Valores * */
$valores['solicitud']=$validaciones->recibir("_solicitud");
$valores['dane']=$validaciones->recibir("_dane");
$valores['servicio']=$validaciones->recibir("_servicio");
$valores['radicado']=$validaciones->recibir("_radicado");
$valores['radicacion']=$validaciones->recibir("_radicacion");
$valores['trasferido']=$validaciones->recibir("_trasferido");
$valores['categoria']=$validaciones->recibir("_categoria");
$valores['causal']=$validaciones->recibir("_causal");
$valores['asunto']=$validaciones->recibir("_asunto");
$valores['detalle']=$validaciones->recibir("_detalle");
$valores['suscriptor']=$validaciones->recibir("_suscriptor");
$valores['factura']=$validaciones->recibir("_factura");
$valores['respuesta']=$validaciones->recibir("_respuesta");
$valores['contestacion']=$validaciones->recibir("_contestacion");
$valores['radicada']=$validaciones->recibir("_radicada");
$valores['notificado']=$validaciones->recibir("_notificado");
$valores['notificacion']=$validaciones->recibir("_notificacion");
$valores['sspd']=$validaciones->recibir("_sspd");
$valores['ejecucion']=$validaciones->recibir("_ejecucion");
$valores['orden']=$validaciones->recibir("_orden");
$valores['fecha']=$validaciones->recibir("_fecha");
$valores['documentos']=$validaciones->recibir("_documentos");
$valores['identificacion']=$validaciones->recibir("_identificacion");
$valores['nacimiento']=$validaciones->recibir("_nacimiento");
$valores['sexo']=$validaciones->recibir("_sexo");
$valores['telefono']=$validaciones->recibir("_telefono");
$valores['movil']=$validaciones->recibir("_movil");
$valores['correo']=$validaciones->recibir("_correo");
$valores['pais']=$validaciones->recibir("_pais");
$valores['region']=$validaciones->recibir("_region");
$valores['ciudad']=$validaciones->recibir("_ciudad");
$valores['pais'] =empty($valores['pais'])? "CO":$valores['pais'];
$valores['region'] =empty($valores['region'])? "076":$valores['region'];
$valores['ciudad'] = empty($valores['ciudad'])? "76111":$valores['ciudad'];
$valores['sector']=$validaciones->recibir("_sector");
$valores['direccion']=$validaciones->recibir("_direccion");
$valores['referencia']=$validaciones->recibir("_referencia");
$valores['expiracion']=$validaciones->recibir("_expiracion");
$valores['instalacion']=$validaciones->recibir("_instalacion");
$valores['estrato']=$validaciones->recibir("_estrato");
$valores['diametro']=$validaciones->recibir("_diametro");
$valores['legalizado']=$validaciones->recibir("_legalizado");
$valores['matricula']=$validaciones->recibir("_matricula");
$valores['tipoderespuesta']=$validaciones->recibir("_tipoderespuesta");
$valores['ordenservicio']=$validaciones->recibir("_ordenservicio");
$valores['ordencobro']=$validaciones->recibir("_ordencobro");
$valores['creador']=$validaciones->recibir("_creador");
$valores['responsable']=$validaciones->recibir("_responsable");
$valores['origen']=$validaciones->recibir("_origen");
$valores['equipo']=$validaciones->recibir("_equipo"); 
/** Datos del Suscriptor **/
$suscriptor=$suscriptores->consultar($validaciones->recibir("suscriptor"));
$valores['nombres']=  empty($valores['_nombres'])?$suscriptor['nombres']:$valores['_nombres'];
$valores['apellidos']=empty($valores['_apellidos'])?$suscriptor['apellidos']:$valores['_apellidos'];
$valores['direccion']=empty($valores['_direccion'])?$suscriptor['direccion']:$valores['_direccion'];
$valores['referencia']=empty($valores['_referencia'])?$suscriptor['referencia']:$valores['_referencia'];
/** Campos * */
$f->oculto("suscriptor",$validaciones->recibir("suscriptor")); 
$f->campos['solicitud'] = $f->text("solicitud", $valores['solicitud'], "10", "required codigo", true);
$f->campos['dane'] = $f->text("dane", $valores['dane'], "10", "", true, true);
$f->campos['servicio'] = $f->text("servicio", $valores['servicio'], "2", "required", false);
$f->campos['radicado'] = $f->text("radicado", $valores['radicado'], "20", "required", false);
$f->campos['radicacion'] = $f->text("radicacion", $valores['radicacion'], "10", "required automatico", false);
$f->campos['categoria'] = $f->text("categoria", $valores['categoria'], "2", "", false);
$f->campos['causal'] = $f->text("causal", $valores['causal'], "3", "", false);
$f->campos['asunto'] = $f->text("asunto", $valores['asunto'], "10", "", false);
$f->campos['detalle'] = $f->textarea("detalle", $valores['detalle'], "h150", "60", "", false);
$f->campos['suscriptor'] = $f->text("suscriptor", $valores['suscriptor'], "10", "", true, true);
$f->campos['suscriptor_nombre'] = $f->text("suscriptor", $cadenas->capitalizar($suscriptor['nombres'] . " " . $suscriptor['apellidos']), "10", "", true, true);
$f->campos['suscriptor_direccion'] = $f->text("suscriptor", ($suscriptor['direccion'] . "" . $suscriptor['referencia']), "10", "", true, true);
$f->campos['factura'] = $f->text("factura", $valores['factura'], "10", "", false);
$f->campos['respuesta'] = $f->text("respuesta", $valores['respuesta'], "1", "", false);
$f->campos['contestacion'] = $f->text("contestacion", $valores['contestacion'], "10", "", false);
$f->campos['radicada'] = $f->text("radicada", $valores['radicada'], "14", "", false);
$f->campos['notificado'] = $f->text("notificado", $valores['notificado'], "10", "", false);
$f->campos['notificacion'] = $f->text("notificacion", $valores['notificacion'], "1", "", false);
$f->campos['sspd'] = $f->text("sspd", $valores['sspd'], "10", "", false);
$f->campos['ejecucion'] = $f->text("ejecucion", $valores['ejecucion'], "10", "", false);
$f->campos['orden'] = $f->text("orden", $valores['orden'], "16", "", false);
$f->campos['fecha'] = $f->text("fecha", $valores['fecha'], "10", "", false);
$f->campos['documentos'] = $f->text("documentos", $valores['documentos'], "128", "", false);
$f->campos['identificacion'] = $f->text("identificacion", $valores['identificacion'], "128", "", false);
$f->campos['nombres'] = $f->text("nombres", $valores['nombres'], "128", "required", false);
$f->campos['apellidos'] = $f->text("apellidos", $valores['apellidos'], "128", "required", false);
$f->campos['sexo'] = $componentes->combo_sexo("sexo", $valores['sexo']);
$f->campos['nacimiento'] = $f->campos['fecha']=$f->calendario("nacimiento",$valores['nacimiento'],"0","1");
$f->campos['telefono'] = $f->text("telefono", $valores['telefono'], "128", "", false);
$f->campos['movil'] = $f->text("movil", $valores['movil'], "128", "", false);
$f->campos['correo'] = $f->text("correo", $valores['correo'], "128", "", false);
$f->campos['pais'] = $paises->combo("pais", $valores['pais'], "", true);
$f->campos['region'] = $regiones->combo("region", $valores['region'], $valores['pais'], "", true);
$f->campos['ciudad'] = $ciudades->combo("ciudad", $valores['ciudad'], $valores['region'], $valores['pais'], "", true);
$f->campos['sector'] = $sectores->combo("sector", "76111", $valores['sector']);
$f->campos['direccion'] = $f->text("direccion", $valores['direccion'], "128", "required", false);
$f->campos['referencia'] = $f->text("referencia", $valores['referencia'], "128", "", false);
$f->campos['expiracion'] = $f->text("expiracion", $valores['expiracion'], "10", "", false);
//$f->campos['instalacion'] = $f->text("instalacion", $valores['instalacion'], "128", "", false);
//$f->campos['instalacionsector'] = $f->text("instalacionsector", $valores['instalacionsector'], "3", "", false);
$f->campos['estrato'] = $f->text("estrato", $valores['estrato'], "2", "", false);
$f->campos['diametro'] = $f->text("diametro", $valores['diametro'], "3,2", "", false);
$f->campos['legalizado'] = $f->text("legalizado", $valores['legalizado'], "2", "", false);
$f->campos['matricula'] = $f->text("matricula", $valores['matricula'], "10", "", false);
$f->campos['tipoderespuesta'] = $f->text("tipoderespuesta", $valores['tipoderespuesta'], "2", "", false);
$f->campos['ordenservicio'] = $f->text("ordenservicio", $valores['ordenservicio'], "10", "", false);
$f->campos['ordencobro'] = $f->text("ordencobro", $valores['ordencobro'], "10", "", false);
$f->campos['creador'] = $f->text("creador", $valores['creador'], "10", "", false);
$f->campos['responsable'] = $f->text("responsable", $valores['responsable'], "10", "", false);
$f->campos['origen'] = $f->text("origen", $valores['origen'], "128", "", false);
$f->campos['equipo'] = $f->text("equipo", $valores['equipo'], "10", "", false);
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Cancelar");
$f->campos['continuar'] = $f->button("actualizar" . $f->id, "submit", "Continuar");
/** Celdas * */
$f->celdas["solicitud"] = $f->celda("Solicitud:", $f->campos['solicitud'], "", "w100");
$f->celdas["dane"] = $f->celda("Dane:", $f->campos['dane']);
$f->celdas["servicio"] = $f->celda("Servicio:", $f->campos['servicio']);
$f->celdas["radicado"] = $f->celda("Radicado:", $f->campos['radicado'], "", "w150");
$f->celdas["radicacion"] = $f->celda("Radicacion:", $f->campos['radicacion'], "", "w150");
$f->celdas["categoria"] = $f->celda("Categoria:", $f->campos['categoria']);
$f->celdas["causal"] = $f->celda("Causal:", $f->campos['causal']);
$f->celdas["asunto"] = $f->celda("Asunto:", $f->campos['asunto']);
$f->celdas["detalle"] = $f->celda("Detalle:", $f->campos['detalle']);
$f->celdas["suscriptor"] = $f->celda("Suscriptor:", $f->campos['suscriptor']);
$f->celdas["suscriptor_nombre"] = $f->celda("Nombre Completo:", $f->campos['suscriptor_nombre']);
$f->celdas["suscriptor_direccion"] = $f->celda("Dirección:", $f->campos['suscriptor_direccion']);
$f->celdas["factura"] = $f->celda("Factura:", $f->campos['factura']);
$f->celdas["respuesta"] = $f->celda("Respuesta:", $f->campos['respuesta']);
$f->celdas["contestacion"] = $f->celda("Contestacion:", $f->campos['contestacion']);
$f->celdas["radicada"] = $f->celda("Radicada:", $f->campos['radicada']);
$f->celdas["notificado"] = $f->celda("Notificado:", $f->campos['notificado']);
$f->celdas["notificacion"] = $f->celda("Notificacion:", $f->campos['notificacion']);
$f->celdas["sspd"] = $f->celda("Sspd:", $f->campos['sspd']);
$f->celdas["ejecucion"] = $f->celda("Ejecucion:", $f->campos['ejecucion']);
$f->celdas["orden"] = $f->celda("Orden:", $f->campos['orden']);
$f->celdas["fecha"] = $f->celda("Fecha:", $f->campos['fecha']);
$f->celdas["documentos"] = $f->celda("Documentos:", $f->campos['documentos']);
$f->celdas["identificacion"] = $f->celda("Identificacion:", $f->campos['identificacion']);
$f->celdas["nombres"] = $f->celda("Nombres:", $f->campos['nombres']);
$f->celdas["apellidos"] = $f->celda("Apellidos:", $f->campos['apellidos']);
$f->celdas["sexo"] = $f->celda("Sexo:", $f->campos['sexo'], "", "w100");
$f->celdas["nacimiento"] = $f->celda("Fecha De Nacimiento:", $f->campos['nacimiento'], "", "w150");
$f->celdas["telefono"] = $f->celda("Telefono Fijo:", $f->campos['telefono'], "", "w100");
$f->celdas["movil"] = $f->celda("Movil / Celular:", $f->campos['movil'], "", "w100");
$f->celdas["correo"] = $f->celda("Correo Electrónico:", $f->campos['correo']);
$f->celdas["pais"] = $f->celda("Pais:", $f->campos['pais']);
$f->celdas["region"] = $f->celda("Region:", $f->campos['region']);
$f->celdas["ciudad"] = $f->celda("Ciudad:", $f->campos['ciudad']);
$f->celdas["sector"] = $f->celda("Sector:", $f->campos['sector']);
$f->celdas["direccion"] = $f->celda("Direccion:", $f->campos['direccion']);
$f->celdas["referencia"] = $f->celda("Referencia:", $f->campos['referencia']);
$f->celdas["expiracion"] = $f->celda("Expiracion:", $f->campos['expiracion']);
//$f->celdas["instalacion"] = $f->celda("Instalacion:", $f->campos['instalacion']);
//$f->celdas["instalacionsector"] = $f->celda("Instalacionsector:", $f->campos['instalacionsector']);
$f->celdas["estrato"] = $f->celda("Estrato:", $f->campos['estrato']);
$f->celdas["diametro"] = $f->celda("Diametro:", $f->campos['diametro']);
$f->celdas["legalizado"] = $f->celda("Legalizado:", $f->campos['legalizado']);
$f->celdas["matricula"] = $f->celda("Matricula:", $f->campos['matricula']);
$f->celdas["tipoderespuesta"] = $f->celda("Tipoderespuesta:", $f->campos['tipoderespuesta']);
$f->celdas["ordenservicio"] = $f->celda("Ordenservicio:", $f->campos['ordenservicio']);
$f->celdas["ordencobro"] = $f->celda("Ordencobro:", $f->campos['ordencobro']);
$f->celdas["creador"] = $f->celda("Creador:", $f->campos['creador']);
$f->celdas["responsable"] = $f->celda("Responsable:", $f->campos['responsable']);
$f->celdas["origen"] = $f->celda("Origen:", $f->campos['origen']);
$f->celdas["equipo"] = $f->celda("Equipo:", $f->campos['equipo']);
/** Filas * */
$f->fila["solicitante1"] = $f->fila($f->celdas["identificacion"] . $f->celdas["nombres"] . $f->celdas["apellidos"] . $f->celdas["sexo"]);
$f->fila["solicitante2"] = $f->fila($f->celdas["nacimiento"] . $f->celdas["telefono"] . $f->celdas["movil"] . $f->celdas["correo"]);
$f->fila["solicitante3"] = $f->fila($f->celdas["direccion"] . $f->celdas["referencia"]);
$f->fila["solicitante4"] = $f->fila($f->celdas["pais"] . $f->celdas["region"]);
$f->fila["solicitante5"] = $f->fila($f->celdas["ciudad"] . $f->celdas["sector"]);
$f->fila["suscriptor1"] = $f->fila($f->celdas["suscriptor"] . $f->celdas["suscriptor_nombre"] . $f->celdas["suscriptor_direccion"] . $f->celdas["factura"]);
/** Compilando * */
$f->filas("<div id=\"perfiles" . $transaccion . "\">");
$f->filas($f->titulo("Datos del solicitante."));
$f->filas($f->fila['solicitante1']);
$f->filas($f->fila['solicitante2']);
$f->filas($f->fila['solicitante3']);
$f->filas($f->fila['solicitante4']);
$f->filas($f->fila['solicitante5']);
$f->filas("</div>");
/** Botones * */
$f->botones($f->campos['cancelar'],"inferior-derecha");
$f->botones($f->campos['continuar'],"inferior-derecha");
/** JavaScripts **/
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Modificar Solicitante \");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 680, height: 350});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
?>
