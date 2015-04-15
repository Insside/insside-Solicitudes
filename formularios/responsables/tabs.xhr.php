<?php
$root = (!isset($root)) ? "../../../../" : $root;
require_once($root . "modulos/aplicacion/librerias/Configuracion.cnf.php");
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
$transaccion = isset($_REQUEST['transaccion']) ? $_REQUEST['transaccion'] : time();
$solicitud = $validaciones->recibir("solicitud");

$f = new Formularios($transaccion);
echo($f->apertura());
$etiquetas = array("Responsable", "Creador", "Equipo");
$valores = array("responsable", "creador", "equipo");
$ruta = "modulos/solicitudes/formularios/responsables/";
$urls[0] = $ruta . "responsable/responsable.xhr.php?transaccion=" . $transaccion . "&solicitud=".$solicitud;
$urls[1] = $ruta . "creador/creador.xhr.php?transaccion=" . $transaccion . "&solicitud=" . $solicitud;
$urls[2] = $ruta . "equipo/equipo.xhr.php?transaccion=" . $transaccion . "&solicitud=" . $solicitud;
echo($f->Tabs("solicitudes", $etiquetas, $valores, $urls));
echo($f->generar());
echo($f->cierre());
?>
