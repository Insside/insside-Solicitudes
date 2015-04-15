<?php
$root = (!isset($root)) ? "../../../../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
$solicitudes = new Solicitudes();
$validaciones=new Validaciones();
/*
 * Copyright (c) 2013, Alexis
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
 *
 */
$solicitud = $validaciones->recibir('solicitud');
$solicitudes->actualizar($solicitud, "identificacion", $validaciones->recibir('identificacion'));
$solicitudes->actualizar($solicitud, "nombres", $validaciones->recibir('nombres'));
$solicitudes->actualizar($solicitud, "apellidos",$validaciones->recibir('apellidos'));
$solicitudes->actualizar($solicitud, "sexo", $validaciones->recibir('sexo'));
$solicitudes->actualizar($solicitud, "nacimiento", $validaciones->recibir('nacimiento'));
$solicitudes->actualizar($solicitud, "telefono", $validaciones->recibir('telefono'));
$solicitudes->actualizar($solicitud, "movil", $validaciones->recibir('movil'));
$solicitudes->actualizar($solicitud, "correo", $validaciones->recibir('correo'));
$solicitudes->actualizar($solicitud, "direccion", $validaciones->recibir('direccion'));
$solicitudes->actualizar($solicitud, "referencia", $validaciones->recibir('referencia'));
$solicitudes->actualizar($solicitud, "sector", $validaciones->recibir('sector'));
/** JavaScripts **/
$f->JavaScript("MUI.Solicitudes_Solicitud_Consultar('".$solicitud."');");
$f->JavaScript("MUI.closeWindow($('" . ($f->ventana) . "'));");
?>