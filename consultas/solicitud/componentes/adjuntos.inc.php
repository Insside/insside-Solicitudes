<?php
$usuario=Sesion::usuario();
$archivos=new Solicitudes_Archivos();
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
$html['info']="<a name=\"adjuntos\"></a><h2>5. Archivos adjuntos. </h2>
  <p>En este segmento se visualizan todos los archivos adjuntos al expediente de la solicitud que actualmente 
  está siendo consultado, el orden de los archivos visualizados está en orden cronológico descendente del ingreso 
  o carga al sistema, cada archivo cargado y registrado esta categorizado según su tipo de contenido y en ese 
  orden de ideas se visualiza su acceso en el listado inferior a este mensaje. Si desea cargar un nuevo archivo 
  ingrese a  [ <a href=\"#\" 
  onClick=\"MUI.Solicitudes_Archivo_Adjuntar('".$s['solicitud']."');\">Adjuntar Nuevo Archivo!</a> ].</p>";
$f->celdas['info'] = $f->celda("", $html['info']);
$f->celdas['adjuntos'] = $f->celda("",$archivos->tabla($s['solicitud'],$usuario['usuario']),"archivos".$f->id,"tdatos");

$f->fila["adjuntos1"]=$f->fila($f->celdas['info']);
$f->fila["adjuntos2"]=$f->fila($f->celdas['adjuntos']);

$f->filas($f->fila["adjuntos1"]);
$f->filas($f->fila["adjuntos2"]); 
?>
