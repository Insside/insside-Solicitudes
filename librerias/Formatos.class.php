<?php

$root = (!isset($root)) ? "../../" : $root;
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
 * Description of Formatos
 *
 * @author Alexis
 */
class Formatos {

  //put your code here

  function crear($nombre, $descripcion, $fecha, $hora, $creador) {
    $db = new MySQL();
    $sql = "INSERT INTO `solicitudes_respuestas_formatos` SET ";
    $sql.="`nombre`='" . $nombre . "',";
    $sql.="`descripcion`='" . $descripcion . "',";
    $sql.="`creador`='" . $creador . "',";
    $sql.="`fecha`='" . $fecha . "',";
    $sql.="`hora`='" . $hora . "';";
    //echo($sql);
    $consulta = $db->sql_query($sql);
    $db->sql_close();
    return($consulta);
  }

  function consultar($formato) {
    $db = new MySQL();
    $sql = "SELECT * FROM `solicitudes_respuestas_formatos` WHERE `formato`='" . $formato . "' ;";
    $consulta = $db->sql_query($sql);
    $fila = $db->sql_fetchrow($consulta);
    $db->sql_close();
    return($fila);
  }

  function actualizar($formato, $campo, $valor) {
    $db = new MySQL();
    $sql = "UPDATE `solicitudes_respuestas_formatos` SET ";
    $sql.="`" . $campo . "`='" . $valor . "'";
    $sql.=" WHERE `formato`='" . $formato . "';";
    $consulta = $db->sql_query($sql);
    $db->sql_close();
  }

  function eliminar($formato) {
    $db = new MySQL();
    $sql = "DELETE FROM `solicitudes_respuestas_formatos` WHERE `formato`='" . $formato . "';";
    $consulta = $db->sql_query($sql);
    $db->sql_close();
    return($consulta);
  }

  function combo($name, $selected) {
    $modulos = new Modulos();
    $db = new MySQL();
    $sql = "SELECT * FROM `solicitudes_respuestas_formatos` ORDER BY `formato` ASC";
    $consulta = $db->sql_query($sql);
    $html = ('<select name="' . $name . '"id="' . $name . '">');
    $conteo = 0;
    while ($fila = $db->sql_fetchrow($consulta)) {
      $html.=('<option value="' . $fila['formato'] . '"' . (($selected == $fila['formato']) ? "selected" : "") . '>' . $fila['formato'] . ": " . $fila['nombre'] . '</option>');
      $conteo++;
    } $db->sql_close();
    $html.=("</select>");
    return($html);
  }

  /**
   * Esta función lee un formato o plantilla de respuesta desde una tabla en la base de datos, procesando una 
   * serie de etiquetas y remplazando los datos que estas representan en una pseudo respuesta. La etiquetas son 
   * remplazadas por valores pertinentes a la solicitud indicada
   * @param type $solicitud
   * @param type $formato
   * @return type
   */
  function procesador($solicitud, $formato) {
    $cadenas=new Cadenas();
    $fechas=new Fechas();
    $suscriptores=new Suscriptores();
    $solicitudes = new Solicitudes();
    $formato = $this->consultar($formato);

    /** Valores de la Solicitud * */
    $solicitud = $solicitudes->consultar($solicitud);
    $tratamiento['formal'] = ($solicitud['sexo'] == "F") ? "Señora" : "Señor";
    $tratamiento['contextual'] = ($solicitud['sexo'] == "F") ? "la señora" : "el señor";
    $tratamiento['definitorio'] = ($solicitud['sexo'] == "F") ? "a la señora" : "al señor";
    $suscriptor = $suscriptores->consultar($solicitud['suscriptor']);
    $suscriptor['nombre'] = $cadenas->capitalizar($suscriptor['nombres'] . " " . $suscriptor['apellidos']);
    $suscriptor['direccion'] = $cadenas->capitalizar($suscriptor['direccion'] . " " . $suscriptor['referencia']);
    $fecha['hoy'] = $cadenas->capitalizar($fechas->hoy_textual());
    $solicitud['radicaciontextual'] = $fechas->textual($solicitud['radicacion']);
    $solicitante['nombre'] = ($solicitud['nombres'] . " " . $solicitud['apellidos']);
    $buscar = array(
        "%FECHA[HOY]%",
        "%TRATAMIENTO[DEFINITORIO]%",
        "%TRATAMIENTO[CONTEXTUAL]%",
        "%TRATAMIENTO[FORMAL]%",
        "%SUSCRIPTOR[SUSCRIPTOR]%",
        "%SUSCRIPTOR[NOMBRE]%",
        "%SUSCRIPTOR[DIRECCION]%",
        "%SOLICITANTE[NOMBRE]%",
        "%SOLICITUD[IDENTIFICACION]%",
        "%SOLICITUD[DIRECCION]%",
        "%SOLICITUD[SUSCRIPTOR]%",
        "%SOLICITUD[RADICADO]%",
        "%SOLICITUD[RADICACION]%",
        "%SOLICITUD[RADICACIONTEXTUAL]%"
    );
    $poner = array(
        $fecha['hoy'],
        $tratamiento['definitorio'],
        $tratamiento['contextual'],
        $tratamiento['formal'],
        $suscriptor['suscriptor'],
        $suscriptor['nombre'],
        $suscriptor['direccion'],
        $solicitante['nombre'],
        $solicitud['identificacion'],
        $solicitud['direccion'],
        $solicitud['suscriptor'],
        $solicitud['radicado'],
        $solicitud['radicacion'],
        $solicitud['radicaciontextual']
    );
    $formato['modelo'] = str_replace($buscar, $poner, urldecode($formato['modelo']));
    return($formato['modelo']);
  }

}
