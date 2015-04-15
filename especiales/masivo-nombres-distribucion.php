<?php

$root = (!isset($root)) ? "../../../" : $root;
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
$sesion = new Sesion();
$suscriptores=new Suscriptores();
$solicitudes = new Solicitudes();
$respuestas = new Respuestas();
$notificaciones = new Notificaciones();
$fechas = new Fechas();



$db = new MySQL();
$consulta = $db->sql_query("SELECT * FROM `solicitudes_solicitudes` WHERE(`servicio`='01' AND `creador`='1367877049');");
$conteo = 0;
while ($fila = $db->sql_fetchrow($consulta)) {
  $conteo++;
  $suscriptor= $suscriptores->consultar($fila['suscriptor']);
  if (!empty($suscriptor)) {
    $solicitudes->actualizar($fila['solicitud'], "nombres", $suscriptor['nombres']);
    $solicitudes->actualizar($fila['solicitud'], "apellidos", $suscriptor['apellidos']);
    $solicitudes->actualizar($fila['solicitud'], "direccion", $suscriptor['direccion']);
  }
}
$db->sql_close();
?>
