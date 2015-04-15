<?php
$sesion=new Sesion();
$cadenas = new Cadenas();
$fechas = new Fechas();
$notificaciones=new Notificaciones();
$validaciones = new Validaciones();
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


/** Valores **/
$solicitud=$validaciones->recibir("solicitud");
$valores['tipo']=$validaciones->recibir("_tipo");
$valores['nombre']=$validaciones->recibir("_nombre");
$valores['descripcion']=$validaciones->recibir("_descripcion");
/** Campos **/
$f->oculto("creador",$sesion->consultar("usuario"));
$f->campos['info']="<p>Seleccione el tipo de notificación que desea redactar, recuerde que los documentos generados no son modificables una vez se hallan archivado, la opciones de edición y destrucción de estos documentos generados dependen de sus permisos en el sistema, lo cual en ningún momento exime la necesidad de adjuntar la imagen física del documento con las respectivas firmas en comprobación del envió trátese de la solicitud de comparecencia, notificación personal o constancia del edicto.</p> ";
$f->campos['solicitud']=$f->text("solicitud",$solicitud, "10","required codigo", true);
$f->campos['respuesta']=$f->text("respuesta","0", "10","required", false);

$f->campos['tipo']=$notificaciones->tipos("tipo","");
$f->campos['formato']=$notificaciones->formatos("formato","");

$f->campos['notificacion']=$f->text("notificacion",time(), "10","required codigo", true);
$f->campos['fecha']=$f->calendario("fecha",$fechas->hoy(),"0","1");
$f->campos['hora']=$f->text("hora",$fechas->ahora(), "10","required automatico", true);
$f->campos['nota']="<p><b><u>Nota</u></b>: Es de recordar que la fecha y la hora textuales contenidos en el documento deben coincidir con la fecha y la hora aquí registrados, de lo contrario se pondría en duda la validez del documento y la eficiencia del proceso.</p>";

$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button","Ayuda");$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button","Cancelar");
$f->campos['continuar'] = $f->button("continuar" . $f->id, "submit","Continuar");
/** Celdas **/
$f->celdas["info"] =$f->celda("", $f->campos['info'],"","sinfondo");
$f->celdas["solicitud"] =$f->celda("Código de la Solicitud:", $f->campos['solicitud']);
$f->celdas["respuesta"] =$f->celda("Código de la Respuesta:", $f->campos['respuesta']);
$f->celdas["tipo"] = $f->celda("Tipo de Notificación:", $f->campos['tipo']);
$f->celdas["formato"] = $f->celda("Formato / Planilla:", $f->campos['formato']);
$f->celdas["fecha"] = $f->celda("Fecha:", $f->campos['fecha']);
$f->celdas["hora"] = $f->celda("Hora:", $f->campos['hora']);
$f->celdas["notificacion"] = $f->celda("Codigo Notificación (Asignado):", $f->campos['notificacion']);
$f->celdas["nota"] =$f->celda("", $f->campos['nota'],"","sinfondo");
/** Filas **/
$f->fila["f0"]=$f->fila($f->celdas["info"]);
$f->fila["f1"]=$f->fila($f->celdas["solicitud"].$f->celdas["respuesta"]);
$f->fila["f2"]=$f->fila($f->celdas["tipo"]);
$f->fila["f3"]=$f->fila($f->celdas["formato"]);
$f->fila["f4"]=$f->fila($f->celdas["notificacion"].$f->celdas["fecha"].$f->celdas["hora"]);
$f->fila["f5"]=$f->fila($f->celdas["nota"]);
/** Compilando **/
$f->filas($f->fila['f0']);
$f->filas($f->fila['f1']);
$f->filas($f->fila['f2']);
$f->filas($f->fila['f3']);
$f->filas($f->fila['f4']);
$f->filas($f->fila['f5']);
/** Botones **/
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['cancelar'], "inferior-derecha");
$f->botones($f->campos['continuar'], "inferior-derecha");
/** JavaScripts **/
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Redactar Notificación\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 390, height: 440});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
?>