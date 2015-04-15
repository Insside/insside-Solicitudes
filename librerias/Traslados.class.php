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

/**
 * Description of Traslados
 *
 * @author Alexis
 */
class Traslados {

  function consultar($solicitud) {
    $db = new MySQL();
    $consulta = $db->sql_query("SELECT * FROM `solicitudes_traslados_sspd` WHERE `solicitud`='" . $solicitud . "' ;");
    $fila = $db->sql_fetchrow($consulta);
    $db->sql_close();
    return($fila);
  }
  
  /**
   * Retorna los datos datos de un tramite asociado a una solicitud
   * @param type $solicitud
   * @return type
   */
  function solicitud($solicitud) {
    $db = new MySQL();
    $consulta = $db->sql_query("SELECT * FROM `solicitudes_traslados_sspd` WHERE `solicitud`='" . $solicitud . "'  ORDER BY `fecha` DESC LIMIT 1;");
    $fila = $db->sql_fetchrow($consulta);
    $db->sql_close();
    return($fila);
  }
  
  function crear($solicitud, $forma, $radicado, $fecha, $hora, $creador) {
    $traslado = time();
    $db = new MySQL();
    $sql = "INSERT INTO `solicitudes_traslados_sspd` SET ";
    $sql.="`traslado`='" . $traslado . "',";
    $sql.="`solicitud`='" . $solicitud . "',";
    $sql.="`forma`='" . $forma . "',";
    $sql.="`radicado`='" . $radicado . "',";
    $sql.="`creador`='" . $creador . "',";
    $sql.="`fecha`='" . $fecha . "',";
    $sql.="`hora`='" . $hora . "';";
    $consulta = $db->sql_query($sql);
    $db->sql_close();
    echo($sql);
    return($traslado);
  }
  
    function eliminar($respuesta) {
    $db = new MySQL();
    $sql = "DELETE FROM `solicitudes_respuestas` WHERE `respuesta`='" . $respuesta . "';";
    $consulta = $db->sql_query($sql);
    $db->sql_close();
  }



  function actualizar($traslado, $campo, $valor) {
    $db = new MySQL();
    $sql = "UPDATE `solicitudes_traslados_sspd` SET ";
    $sql.="`" . $campo . "`='" . $valor . "'";
    $sql.=" WHERE `traslado`='" . $traslado . "';";
    //echo($sql);
    $consulta = $db->sql_query($sql);
    $db->sql_close();
    return($consulta);
  }

}
