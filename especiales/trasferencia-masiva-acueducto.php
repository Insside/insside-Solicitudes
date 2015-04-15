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
$solicitudes = new Solicitudes();
$respuestas = new Respuestas();
$notificaciones = new Notificaciones();
$suscriptores = new Suscriptores();
$fechas = new Fechas();
$cadenas=new Cadenas();
$validaciones=new Validaciones();



$db = new MySQL();
$consulta = $db->sql_query("SELECT * FROM `unificacion-acueducto`;");
$conteo = 0;
while ($fila = $db->sql_fetchrow($consulta)) {
  $conteo++;
  echo($conteo );
  $fecha = $fila['radicacion'];
  $hora = "08:00:00";
  $suscriptor = $suscriptores->consultar($fila['suscriptor']);
  list($annos, $meses, $dias) = explode('-', $fecha);
  list($horas, $minutos, $segundos) = explode(':', $hora);
  $solicitud = mktime($horas, $minutos, $segundos, $meses, $dias, $annos);
  $solicitud = $solicitud + $conteo;
  $creador = ($fila['servicio'] == "01") ? "1367877049" : "1378134478";
  $responsable = ($fila['servicio'] == "01") ? "1367877049" : "1378134478";
  $equipo = ($fila['servicio'] == "01") ? "02" : "03";
  $nombre=$cadenas->condenzar($fila['nombres']);
  $nombre=explode(" ",$nombre);
  $nombres=$nombre[0];
  $apellidos=$nombre[1];
  $count=  count($nombre); 
  $identificacion=$cadenas->limpiar($nombre[$count-1]);
  $identificacion=$validaciones->numero($identificacion)?$identificacion:"";
  
  
  /** Registro La Solicitud * */
  $solicitudes->crear(array(
      "solicitud" => $solicitud, 
      "dane" => $fila['dane'],
      "servicio" => $fila['servicio'],
      "radicado" => $fila['radicado'],
      "radicacion" => $fila['radicacion'],
      "categoria" => $fila['categoria'],
      "causal" => $fila['causal'],
      "asunto" => "00",
      "detalle" => $fila['detalle'],
      "nombres" =>$nombres,
       "apellidos" => $apellidos,
       "identificacion" => $identificacion,
      "suscriptor" => $fila['suscriptor'],
      "factura" => $fila['factura'],
      "equipo" => $equipo,
      "creador" => $creador,
      "responsable" => $responsable
          //"nombres" => $fila['nombres'],
          //"apellidos" => $fila['apellidos'],
          //"direccion" => $fila['direccion']
          )
  );
  /** Registro La Respuesta* */
  $respuestas->insertar(array(
      "respuesta" => $solicitud,
      "solicitud" => $solicitud,
      "tipo" => $fila['respuesta_tipo'],
      "formato" => "000",
      "radicado" => $fila['respuesta_radicado'],
      "orden" => "",
      "cobro" => "",
      "detalle" => "",
      "fecha" => $fila['respuesta_fecha'],
      "hora" => "08:00:00",
      "categoria" => "PUBLICA",
      "estado" => "ACTIVA",
      "creador" => $creador
  ));
  /** Registro La Notificacion* */
  $notificaciones->insertar(array(
      "notificacion" =>  $solicitud,
      "solicitud" =>  $solicitud,
      "respuesta" => $solicitud,
      "tipo" => $fila['notificacion_tipo'],
      "formato: " => "06",
      "contenido" => "",
      "fecha" => $fila['notificacion_fecha'],
       "hora" => "08:00:00",
      "creador" =>$creador,
      "estado" => "EDITABLE",
      "radicacion" => "",
  ));
}
$db->sql_close();
?>