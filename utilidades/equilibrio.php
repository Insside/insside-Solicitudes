<?php
$root = (!isset($root)) ? "../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
/* 
 * Copyright (c) 2015, Alexis
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
$respuestas=new Respuestas();
$notificaciones=new Notificaciones();

$usuario="1367668842";
$db = new MySQL();
    $sql = "SELECT * FROM `solicitudes_solicitudes` WHERE `creador` = 1367668842 OR `responsable` = 1367668842  ORDER BY `solicitud`;";
    echo($sql);
    $consulta = $db->sql_query($sql);
    $solucionadas = $db->sql_numrows($consulta);
    $conteo=0;
    echo("<table>");
    while ($fila = $db->sql_fetchrow($consulta)) {
      $conteo++;
      $r=$respuestas->solicitud($fila['solicitud']);
      $n=$notificaciones->solicitud($fila['solicitud']);
      echo("<tr><td>".$conteo."</td><td>".$fila["solicitud"]."</td><td>".$r['respuesta']."</td><td>".$n['notificacion']."</td></tr>");
    }
    echo("<table>");
    $db->sql_close();


?>