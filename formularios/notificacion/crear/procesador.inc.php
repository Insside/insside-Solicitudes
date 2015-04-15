<?php
$cadenas = new Cadenas();
$fechas = new Fechas();
$solicitudes=new Solicitudes();
$notificaciones=new Notificaciones();
$validaciones = new Validaciones();
$suscriptores=new Suscriptores();
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
$notificacion=$validaciones->recibir("notificacion");
$solicitud=$validaciones->recibir("solicitud");
$respuesta=$validaciones->recibir("respuesta");
$tipo=$validaciones->recibir("tipo");
$formato=$notificaciones->formato($validaciones->recibir("formato"));
$fecha=$validaciones->recibir("fecha");
$hora=$validaciones->recibir("hora");
$creador=$validaciones->recibir("creador");
$notificaciones->crear($notificacion, $solicitud, $respuesta, $tipo, $formato['tipo'], $fecha, $hora, $creador);

$solicitud=$solicitudes->consultar($solicitud);
$tratamiento=($solicitud['sexo']=="F")?"Señora":"Señor";
$tratamientocontextual=($solicitud['sexo']=="F")?"la señora":"el señor";
$tratamientodefinitorio=($solicitud['sexo']=="F")?"a la señora":"al señor";
$suscriptor=$suscriptores->consultar($solicitud['suscriptor']);
$suscriptornombre=$cadenas->capitalizar($suscriptor['nombres']." ".$suscriptor['apellidos']);
$suscriptordireccion=$cadenas->capitalizar($suscriptor['direccion']." ".$suscriptor['referencia']);
$fecha=$cadenas->capitalizar($fechas->hoy_textual());
$radicacion=$solicitud['radicacion'];
$radicaciontextual=$fechas->textual($radicacion);
$identificacion=$solicitud['identificacion'];
$solicitante=($solicitud['nombres']." ".$solicitud['apellidos']);
$direccion=$solicitud['direccion'];
$original=$formato['formato'];
$buscar= array("%TRATAMIENTODEFINITORIO%","%TRATAMIENTOCONTEXTUAL%","%TRATAMIENTO%","%SUSCRIPTORDIRECCION%","%SUSCRIPTORNOMBRE%","%NOTIFICACION%","%FECHA%","%IDENTIFICACION%","%SOLICITANTE%","%DIRECCION%","%SUSCRIPTOR%","%SOLICITUD%","%RADICACION%","%RADICACIONTEXTUAL%");
$poner= array($tratamientodefinitorio,$tratamientocontextual,$tratamiento,$suscriptordireccion,$suscriptornombre,$notificacion,$fecha,$identificacion,$solicitante,$direccion,$solicitud['suscriptor'],$solicitud['radicado'],$radicacion,$radicaciontextual);
$formato['formato']= str_replace($buscar, $poner, $original);

$notificaciones->actualizar($notificacion,"contenido", urlencode($formato['formato']));
/** JavaScripts **/
$f->JavaScript("MUI.closeWindow($('" . ($f->ventana) . "'));");
$f->JavaScript("MUI.Solicitudes_Solicitud_Consultar('".$solicitud['solicitud']."');");