<?php
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
$notificacion=$notificaciones->consultar($validaciones->recibir("notificacion"));
/** Campos **/
$f->oculto("solicitud".$f->id,$notificacion['solicitud']);
$f->oculto("notificacion".$f->id,$notificacion['notificacion']);
$f->oculto("contenido".$f->id,"");
$f->campos['info']="<p>Se le recuerda que si es la primera vez que está observando este documento, el mismo constituye solo un borrador de lo que debe ser el documento final, realice las modificaciones que estime convenientes y guarde cuantas veces sea necesario hasta que esté totalmente seguro de archivar la versión electrónica de este documento. Una vez archivado este documento no podrá realizar modificaciones en el mismo. Para imprimir recuerde guardar y luego presionar imprimir en el formato contiguo al presente formulario.</p> ";
$f->campos['contenido']=$f->textarea("ckcontenido".$f->id,urldecode($notificacion['contenido']),"textarea",25,80,false,false,false,6200);
$f->campos['nota']="<p><b><u>Nota</u></b>: Es de recordar que la fecha y la hora textuales contenidos en el documento deben coincidir con la fecha y la hora aquí registrados, de lo contrario se pondría en duda la validez del documento y la eficiencia del proceso.</p>";

$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button","Ayuda");$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button","Cancelar");
$f->campos['guardar'] = $f->button("guardar", "submit", "Guardar");
/** Celdas **/
$f->celdas["info"] =$f->celda("", $f->campos['info'],"","sinfondo");
$f->celdas["contenido"] =$f->celda("Contenido Textual Notificación:", $f->campos['contenido']);
/** Filas **/
$f->fila["f0"]=$f->fila($f->celdas["info"]);
$f->fila["f1"]=$f->fila($f->celdas["contenido"]);
/** Compilando **/
$f->filas("<div id=\"div" . $f->id . "\">");
$f->filas($f->fila['f0']);
$f->filas($f->fila['f1']);
$f->filas("</div>");
/** Botones **/
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['cancelar'], "inferior-derecha");
$f->botones($f->campos['guardar'], "inferior-derecha");
/** JavaScripts **/
$f->JavaScript("function CKupdate(){ckInstance.updateElement();}var ckInstance".$f->id."= CKEDITOR.replace( 'ckcontenido".$f->id."');");
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Redactar Notificación\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 870, height: 500});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
$f->eClick("guardar", "var contenido = ckInstance".$f->id.".getData();\$('contenido".$f->id."').value=contenido;");
?>