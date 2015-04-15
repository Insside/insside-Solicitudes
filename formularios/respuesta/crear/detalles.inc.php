<?php
$root = (!isset($root)) ? "../../../../" : $root;
require_once($root . "modulos/comercial/librerias/Configuracion.cnf.php");
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
$validaciones=new Validaciones();
$cadenas = new Cadenas();
$fechas = new Fechas();
$paises = new Paises();
$regiones = new Regiones();
$ciudades = new Ciudades();
$sectores = new Sectores();
$solicitudes = new Solicitudes();
$respuestas = new Respuestas();
$formatos=new Formatos();
$solicitud =$solicitudes->consultar($validaciones->recibir('solicitud'));
$formato=$validaciones->recibir("formato");
$modelo=$formatos->procesador($solicitud['solicitud'], $formato);
/** Valores * */
$valores['respuesta'] = time();
$valores['solicitud'] = $solicitud['solicitud'];
$valores['tipo'] = @$_REQUEST["_tipo"];
$valores['radicado'] = "IMIS-RES-" . $valores['respuesta'];
$valores['detalle'] = $modelo;
$valores['fecha'] = $fechas->hoy();
$valores['hora'] = $fechas->ahora();
$valores['creador'] = $sesion->consultar("usuario");
/** Avance * */
$f->avance("establecer", "procesador");
/** Campos * */
$f->oculto("fecha",$validaciones->recibir('fecha'));
$f->oculto("formato",$validaciones->recibir('formato'));
$f->oculto("categoria",$validaciones->recibir('categoria'));
$f->oculto("detalle","xxdetallexx");
$f->campos['respuesta'] = $f->text("respuesta", $valores['respuesta'], "10", "required codigo", true);
$f->campos['solicitud'] = $f->text("solicitud", $valores['solicitud'], "10", "required codigo", true);
$f->campos['solicitud_radicado'] = $f->campo("solicitud", $solicitud['radicado']);
$f->campos['solicitud_radicacion'] = $f->campo("solicitud", $solicitud['radicacion']);
$f->campos['tipo'] = $respuestas->tipos("tipo", $valores['tipo']);
$f->campos['radicado'] = $f->text("radicado", $valores['radicado'], "16", "automatico", false);
$f->campos['detalle'] = $f->textarea("detalle" . $f->id, $valores['detalle'], "h150");
$f->campos['fecha'] = $f->text("fecha", $valores['fecha'], "10", "required automatico", false);
$f->campos['hora'] = $f->text("hora", $valores['hora'], "8", "required automatico", false);
$f->campos['creador'] = $f->text("creador", $valores['creador'], "10", "required automatico", true);
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Cancelar");
$f->campos['continuar'] = $f->button("continuar" . $f->id, "submit", "Radicar");
/** Celdas * */
$f->celdas["respuesta"] = $f->celda("Respuesta:", $f->campos['respuesta'], "", "w100");
$f->celdas["solicitud"] = $f->celda("Solicitud:", $f->campos['solicitud'], "", "w100");
$f->celdas["solicitud_radicado"] = $f->celda("Radicado:", $f->campos['solicitud_radicado'], "", "");
$f->celdas["solicitud_radicacion"] = $f->celda("Fecha de Radicación:", $f->campos['solicitud_radicacion'], "", "");
$f->celdas["tipo"] = $f->celda("Tipo:", $f->campos['tipo']);
$f->celdas["radicado"] = $f->celda("Radicado:", $f->campos['radicado'], "", "w200");
$f->celdas["detalle"] = $f->celda("Detalle:", $f->campos['detalle']);
$f->celdas["fecha"] = $f->celda("Fecha:", $f->campos['fecha']);
$f->celdas["hora"] = $f->celda("Hora:", $f->campos['hora']);
$f->celdas["creador"] = $f->celda("Creador:", $f->campos['creador']);
/** Filas * */
$f->fila["fila1"] = $f->fila($f->celdas["solicitud"] . $f->celdas["solicitud_radicado"] . $f->celdas["respuesta"] . $f->celdas["radicado"] . $f->celdas["fecha"] . $f->celdas["hora"]);
$f->fila["fila2"] = $f->fila($f->celdas["tipo"] . $f->celdas["creador"]);
$f->fila["fila3"] = $f->fila($f->celdas["detalle"]);
/** Compilando * */
$f->filas($f->titulo("Contenido Textual & Formal de Respuesta."));
//$f->filas($f->fila['fila1']);
//$f->filas($f->fila['fila2']);
$f->filas($f->fila['fila3']);
$f->botones($f->campos['cancelar'],"inferior-derecha");
$f->botones($f->campos['continuar'],"inferior-derecha");
/** JavaScripts **/
$f->JavaScript("var ckInstance".$f->id."= CKEDITOR.replace('detalle".$f->id."');");
$f->JavaScript("function CKupdate() {ckInstance".$f->id.".updateElement();}");
$f->eClick("continuar" . $f->id, "\$('detalle".$f->id."').value=ckInstance".$f->id.".getData();");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 750, height: 480});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
?>