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
$f->fila["i3"] = "<h2>2.1. Suscriptor Referenciado.</h2>";
$f->fila["suscriptor1"] = $f->fila($f->celdas["suscriptor"] . $f->celdas["suscriptor_identificacion"] . $f->celdas["suscriptor_nombres"] . $f->celdas["suscriptor_apellidos"]);
$f->fila["suscriptor2"] = $f->fila($f->celdas["suscriptor_direccion"] . $f->celdas["suscriptor_telefonos"] . $f->celdas["suscriptor_correo"] . $f->celdas["suscriptor_estrato"] . $f->celdas["suscriptor_predial"]);
$f->fila["f8"] = $f->fila($f->celdas["orden"] . $f->celdas["fecha"]);
$f->filas($f->fila['i3']);
$f->filas($f->fila['suscriptor1']);
$f->filas($f->fila['suscriptor2']);
?>
