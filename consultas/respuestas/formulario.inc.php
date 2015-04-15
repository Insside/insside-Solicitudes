<?php

$root = (!isset($root)) ? "../../../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
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
/** Definicion De Variables * */
$solicitudes = new Solicitudes();
$cadenas = new Cadenas();
$categorias = new Categorias();
$componentes = new Componentes();
$suscriptores = new Suscriptores();
$paises = new Paises();
$regiones = new Regiones();
$ciudades = new Ciudades();
$sectores = new Sectores();
/** Inicialización De Valores * */
$solicitud = $solicitudes->consultar(@$_REQUEST['solicitud']);
$servicio = $servicios->consultar($solicitud['servicio']);
$categoria = $categorias->consultar($solicitud['categoria']);
$causal = $causales->consultar($solicitud['servicio'], $solicitud['causal']);
$asunto = $asuntos->consultar($solicitud['asunto']);
$suscriptor = $suscriptores->consultar($solicitud['suscriptor']);
/** Asignación De Valores * */
$valores = $solicitud;
$html = "<table>";
$html.= "<tr><td>Respuesta</td><td>Radicado</td><td>Fecha</td><td>Hora</td><td>Tipo</td><td>Creador</td></tr>";
$db = new MySQL();
$sql = "SELECT * FROM `solicitudes_respuestas` WHERE(`solicitud`='" . $solicitud['solicitud'] . "') ORDER BY `respuesta`";
$consulta = $db->sql_query($sql);
while ($fila = $db->sql_fetchrow($consulta)) {
  $html.= "<tr><td>" . $fila['respuesta'] . "</td><td>" . $fila['radicado'] . "</td><td>" . $fila['fecha'] . "</td><td>" . $fila['hora'] . "</td><td>" . $fila['tipo'] . "</td><td>" . $fila['creador'] . "</td></tr>";
}
$db->sql_close();
$html.= "</table>";
/** Campos * */
//$f->campos['solicitud'] = $f->text("solicitud", $valores['solicitud'], "10", "required codigo", true);
$f->campos['generar'] = $f->button("generar" . $f->id, "button", "Generar");
$f->campos['actualizar'] = $f->button("actualizar" . $f->id, "button", "Actualizar");
$f->campos['responder'] = $f->button("responder" . $f->id, "iconotextual", "Generar Respuesta", "publicacion");
/** Celdas * */
//$f->celdas["solicitud"] = $f->celda("Solicitud:", $f->campos['solicitud'], "", "w100");
//$f->celdas["dane"] = $f->celda("Dane:", $f->campos['dane']);
//$f->celdas["servicio"] = $f->celda("Servicio:", $f->campos['servicio']);
/** Filas * */
//$f->fila["solicitante1"] = $f->fila($f->celdas["identificacion"] . $f->celdas["nombres"] . $f->celdas["apellidos"] . $f->celdas["sexo"]);
/** Compilando * */
$f->filas("<div id=\"respuestas" . $transaccion . "\">");
$f->filas($f->titulo("Listado De Respuestas Generadas"));
$f->filas($html);
$f->filas("</div>");
/** Botones * */
//$f->botones($f->campos['actualizar'], "inferior-derecha");
$f->botones($f->campos['responder'], "superior-izquierda");
/** JavaScript Declaraciones * */
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Respuestas Publica E Internas\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 680, height: 365});");
$f->JavaScript("MUI.centerWindow($('" . ($f->ventana) . "'));");
$f->eClick("responder" . $f->id, "MUI.Solicitudes_Solicitud_Responder('" . $solicitud['solicitud'] . "');");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . ($f->ventana) . "'));");
?>