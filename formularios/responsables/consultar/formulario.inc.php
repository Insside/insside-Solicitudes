<?php

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
 */
$solicitudes=new Solicitudes();
$solicitud = $solicitudes->consultar($validaciones->recibir("solicitud"));


/** Campos * */
$f->oculto("solicitud", $solicitud['solicitud']);
$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button", "Ayuda");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Cerrar");
$f->campos['responsabilizar'] = $f->button("responsabilizar" . $f->id, "button", "Modificar");

require_once($root."modulos/solicitudes/formularios/responsables/consultar/segmentos/responsable.inc.php");
require_once($root."modulos/solicitudes/formularios/responsables/consultar/segmentos/creador.inc.php");
require_once($root."modulos/solicitudes/formularios/responsables/consultar/segmentos/equipo.inc.php");

$f->fila["tabs"] = ""
        . "<ul id = \"tabs\">"
        . "<li><a class=\"tab\" href=\"#\" id=\"one\">Responsable</a></li>"
        . "<li><a class=\"tab\" href=\"#\" id=\"two\">Creador</a></li>"
        . "<li><a class=\"tab\" href=\"#\" id=\"two\">Equipo</a></li>"
        . "</ul>";

$f->fila["home"] = ""
        . "<div id=\"home\">"
        . "<div class=\"feature\">" . $f->fila['responsable'] . "</div>"
        . "<div class=\"feature\">" . $f->fila['creador'] . "</div>"
        . "<div class=\"feature\">" . $f->fila['equipo'] . "</div>"
        . "</div>";
/** Compilando * */
$f->filas($f->fila['tabs']);
$f->filas($f->fila['home']);

//if($sesion->consultar("SUSCRIPTORES-SUCRIPTOR-U")){$f->botones($f->campos['actualizar']);}
/** Botones * */
$f->botones($f->campos['ayuda'], "inferior-izquierda");
//$f->botones($f->campos['georeferenciar'], "inferior-izquierda");
$f->botones($f->campos['responsabilizar'], "inferior-derecha");
$f->botones($f->campos['cancelar'], "inferior-derecha");
/** JavaScripts * */
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'),\"Responsables de Recepción & Tramite v2.0</span>\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'),{width:640,height:380});");
$f->JavaScript("var tabs = new iTabs('.tab','.feature',{autoplay: false,transitionDuration:500,slideInterval:3000,hover:true});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
$f->eClick("responsabilizar" . $f->id,"MUI.closeWindow($('" . $f->ventana . "'));MUI.Solicitudes_Solicitud_Responsabilizar('".$solicitud['solicitud']."');");
?>