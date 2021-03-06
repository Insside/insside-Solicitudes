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


$f->campos['info-notificaciones']="<p>El presente listado corresponde a los documentos resultantes del proceso "
        . "de notificación cada documento en instancia es un paso lógico para realizar la notificación según procede "
        . "agotada la instancia correspondiente. La existencia de los archivos es indiferente al dato de la notificación "
        . "ya que este es una determinación y referencia directa por criterio.</p>";
$f->celdas["info-notificaciones"] = $f->celda("", $f->campos['info-notificaciones']);
$f->celdas["notificaciones-tabla"] = $f->celda("", $notificaciones->tabla($s['solicitud']),"","tdatos");
$f->fila['info-notificaciones']=$f->fila($f->celdas["info-notificaciones"]);
$f->fila['notificaciones-tabla']=$f->fila($f->celdas["notificaciones-tabla"] );
$f->filas($f->titulo("4. Notificación".@$vinculo['notificar']."."));
$f->filas($f->fila['info-notificaciones']);
$f->filas($f->fila['notificaciones-tabla']);