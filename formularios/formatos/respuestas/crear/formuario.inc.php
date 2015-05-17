<?php

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
$sesion=new Sesion();
$validaciones = new Validaciones();
$fechas=new Fechas();
$usuario=Sesion::usuario();
/** Valores **/
$valores['formato']=$validaciones->recibir("_formato");
$valores['nombre']=$validaciones->recibir("_nombre");
$valores['descripcion']=$validaciones->recibir("_descripcion");
$valores['modelo']=$validaciones->recibir("_modelo");
$valores['fecha']=$fechas->hoy();
$valores['hora']=$fechas->ahora();
$valores['creador']=$usuario['usuario'];
/** Campos **/
$f->campos['formato']=$f->text("formato",$valores['formato'], "3","required", true);
$f->campos['nombre']=$f->text("nombre",$valores['nombre'], "255","required", false);
$f->campos['descripcion']=$f->textarea("descripcion","","textarea required",25,80,false,false,false,255);
$f->campos['modelo']=$f->text("modelo",$valores['modelo'], "","", true);
$f->campos['fecha']=$f->text("fecha",$valores['fecha'], "10","automatico", true);
$f->campos['hora']=$f->text("hora",$valores['hora'], "8","automatico", true);
$f->campos['creador']=$f->text("creador",$valores['creador'], "10","automatico", true);
$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button","Ayuda");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button","Cancelar");
$f->campos['continuar'] = $f->button("continuar" . $f->id, "submit","Continuar");
/** Celdas **/
$f->celdas["formato"] = $f->celda("Formato:", $f->campos['formato']);
$f->celdas["nombre"] = $f->celda("Nombre del Formato a Crear:", $f->campos['nombre']);
$f->celdas["descripcion"] = $f->celda("Descripcion del Formato / Utilización:", $f->campos['descripcion']);
$f->celdas["modelo"] = $f->celda("Modelo:", $f->campos['modelo']);
$f->celdas["fecha"] = $f->celda("Fecha:", $f->campos['fecha']);
$f->celdas["hora"] = $f->celda("Hora:", $f->campos['hora']);
$f->celdas["creador"] = $f->celda("Creador:", $f->campos['creador']);
/** Filas **/
$f->fila["fila1"] = $f->fila($f->celdas["nombre"]);
$f->fila["fila2"] = $f->fila($f->celdas["descripcion"]);
$f->fila["fila3"] = $f->fila($f->celdas["fecha"].$f->celdas["hora"].$f->celdas["creador"]);
/** Compilando **/
$f->filas($f->fila['fila1']);
$f->filas($f->fila['fila2']);
$f->filas($f->fila['fila3']);
/** Botones **/
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['cancelar'], "inferior-derecha");
$f->botones($f->campos['continuar'], "inferior-derecha");
/** JavaScript **/
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Crear - Formato De Respuesta \");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 320, height: 285});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
?>