<?php
$formatos=new Formatos();
$formato=$formatos->consultar($validaciones->recibir("formato"));
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
/** Variables **/
$cadenas = new Cadenas();
$fechas = new Fechas();
$paises = new Paises();
$regiones = new Regiones();
$ciudades = new Ciudades();
$sectores = new Sectores();
$validaciones = new Validaciones();
/** Valores **/
$valores=$formato;
/** Campos **/
$f->oculto("modelo","");
$f->campos['formato']=$f->text("formato",$valores['formato'], "3","required codigo", true);
$f->campos['nombre']=$f->text("nombre",$valores['nombre'], "255","required", false);
$f->campos['descripcion']=$f->text("descripcion",$valores['descripcion'], "ex","", true);
$f->campos['modelo']=$f->textarea("modelo".$f->id,$valores['modelo'],"textarea",25,80,false,false,false,255);
$f->campos['fecha']=$f->text("fecha",$valores['fecha'], "10","", true);
$f->campos['hora']=$f->text("hora",$valores['hora'], "8","", true);
$f->campos['creador']=$f->text("creador",$valores['creador'], "10","", true);
$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button","Ayuda");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button","Cancelar");
$f->campos['continuar'] = $f->button("continuar" . $f->id, "submit","Guardar");
/** Celdas **/
$f->celdas["formato"] = $f->celda("Formato:", $f->campos['formato'],"","w100");
$f->celdas["nombre"] = $f->celda("Nombre:", $f->campos['nombre']);
$f->celdas["descripcion"] = $f->celda("Descripcion:", $f->campos['descripcion']);
$f->celdas["modelo"] = $f->celda("Modelo:", $f->campos['modelo']);
$f->celdas["fecha"] = $f->celda("Fecha:", $f->campos['fecha'],"","w100");
$f->celdas["hora"] = $f->celda("Hora:", $f->campos['hora'],"","w100");
$f->celdas["creador"] = $f->celda("Creador:", $f->campos['creador'],"","w100");
/** Filas **/
$f->fila["fila1"] = $f->fila($f->celdas["formato"].$f->celdas["nombre"].$f->celdas["fecha"].$f->celdas["hora"].$f->celdas["creador"]);
$f->fila["fila2"] = $f->fila($f->celdas["modelo"]);
/** Compilando **/
$f->filas($f->fila['fila1']);
$f->filas($f->fila['fila2']);
/** Botones **/
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['cancelar'], "inferior-derecha");
$f->botones($f->campos['continuar'], "inferior-derecha"); 
/** JavaScripts **/
$f->JavaScript("var ckInstance".$f->id."= CKEDITOR.replace('modelo".$f->id."');");
$f->JavaScript("function CKupdate() {ckInstance".$f->id.".updateElement();}");
$f->eClick("continuar" . $f->id, "\$('modelo').value=ckInstance".$f->id.".getData();");
$f->eClick("cancelar" . $f->id, "MUI.Solicitudes_Formatos_Respuesta();");
?>