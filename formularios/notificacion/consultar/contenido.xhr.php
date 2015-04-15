<?php
$root = (!isset($root)) ? "../../../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
$validaciones=new Validaciones();
$notificaciones=new Notificaciones();
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

$transaccion=$validaciones->recibir("transaccion");
$f = new Formularios($transaccion);
echo($f->apertura());   
/** Variables **/
$cadenas = new Cadenas();
$fechas = new Fechas();
$paises = new Paises();
$regiones = new Regiones();
$ciudades = new Ciudades();
$sectores = new Sectores();
$notificacion=$notificaciones->consultar($validaciones->recibir("notificacion"));
/** Valores **/
$valores=$notificacion;
$valores['contenido']=urldecode($valores['contenido']);
$html="<p><img src=\"/agb/imagenes/logos/membrete.png\" style=\"left:-30px; top:0px; width:100%\" /></p>";
$html.=$valores['contenido'];
$html.="<p><img src=\"/agb/imagenes/logos/pie.png\" style=\"left:-30px; top:0px; width:100%\" /></p>";
$valores['contenido']=$html;

/** Campos **/
$f->campos['notificacion']=$f->campo("notificacion",$valores['notificacion']);
$f->campos['solicitud']=$f->campo("solicitud",$valores['solicitud']);
$f->campos['respuesta']=$f->campo("respuesta",$valores['respuesta']);
$f->campos['tipo']=$f->campo("tipo",$valores['tipo']);
$f->campos['formato']=$f->campo("formato",$valores['formato']);
$f->campos['contenido']=$f->textarea("ckcontenido".$f->id,$valores['contenido'],"textarea",25,80,false,false,false,6200);
$f->campos['fecha']=$f->campo("fecha",$valores['fecha']);
$f->campos['hora']=$f->campo("hora",$valores['hora']);
$f->campos['creador']=$f->campo("creador",$valores['creador']);
$f->campos['estado']=$f->campo("estado",$valores['estado']);
$f->campos['cerrar']=$f->button("cerrar".$f->id,"button","Cerrar","","MUI.closeWindow($('" . ($f->ventana) . "'));");
$f->campos['actualizar']=$f->button("actualizar".$f->id,"button","Modificar","","MUI.closeWindow($('" . ($f->ventana) . "'));MUI.Solicitudes_Notificacion_Actualizar_Contenido('".$notificacion['notificacion']."');");
/** Celdas **/
$f->celdas["notificacion"] = $f->celda("Notificacion:", $f->campos['notificacion']);
$f->celdas["solicitud"] = $f->celda("Solicitud:", $f->campos['solicitud']);
$f->celdas["respuesta"] = $f->celda("Respuesta:", $f->campos['respuesta']);
$f->celdas["tipo"] = $f->celda("Tipo:", $f->campos['tipo']);
$f->celdas["formato"] = $f->celda("Formato:", $f->campos['formato']);
$f->celdas["contenido"] =$f->celda("Contenido Textual Notificación:", $f->campos['contenido']);
$f->celdas["fecha"] = $f->celda("Fecha:", $f->campos['fecha']);
$f->celdas["hora"] = $f->celda("Hora:", $f->campos['hora']);
$f->celdas["creador"] = $f->celda("Creador:", $f->campos['creador']);
$f->celdas["estado"] = $f->celda("Estado:", $f->campos['estado']);
/** Filas **/
$f->fila["fila0"] = $f->fila("<h2>Formato – Preimpreso.</h2>");
$f->fila["fila1"] = $f->fila($f->celdas['contenido']);
/** Compilando **/
$f->filas($f->fila['fila1']);
$f->botones($f->campos["cerrar"],"inferior-derecha");
$f->botones($f->campos["actualizar"],"inferior-derecha");  
/** JavaScripts **/
$f->JavaScript(""
. "var ckInstance".$f->id."=CKEDITOR.replace('ckcontenido".$f->id."',{"
  . "readOnly:true,"
  . "toolbar :["
  . "{ name:'print', items : [ 'Print','Preview' ] },"
  . "{ name: 'tools', items : [ 'Maximize' ] },"
  . "{ name: 'image', items : [ 'Image' ] }"
. "]});"
. "");
echo($f->generar()); 
echo($f->controles());
echo($f->cierre());
?>
