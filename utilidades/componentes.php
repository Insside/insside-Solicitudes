<?php
$root = (!isset($root)) ? "../../../" : $root;
require_once($root . "librerias/Configuracion.cnf.php");
require_once($root . "modulos/aplicacion/librerias/Configuracion.cnf.php");
/* 
 * Este archivo permite recrear los componentes desplegados por el modulo solicitudes en los 
 * diferentes modulos de las areas comerciales.
 * 
 * 
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
$modulo['comercial']="003";
$modulo['distribucion']="005";
$modulo['alcantarillado']="006";


$db = new MySQL();
$sql ="SELECT * FROM `aplicacion_modulos_componentes` WHERE();";
$consulta=$db->sql_query($sql);
while($fila =$db->sql_fetchrow($consulta)){
   echo(implode(",",$fila)."<br>");
}
$db->sql_close();





//$validaciones=new Validaciones();
//$datos['componente']=$validaciones->recibir('componente');
//$datos['herencia']=$validaciones->recibir('herencia');
//$datos['titulo']=$validaciones->recibir('titulo');
//$datos['descripcion']=$validaciones->recibir('descripcion');
//$datos['funcion']=$validaciones->recibir('funcion');
//$datos['icono']=$validaciones->recibir('icono');
//$datos['peso']=$validaciones->recibir('peso');
//$datos['estado']=$validaciones->recibir('estado');
//$datos['permiso']=$validaciones->recibir('permiso');
//$datos['fecha']=$validaciones->recibir('fecha');
//$datos['hora']=$validaciones->recibir('hora');
//$datos['creador']=$validaciones->recibir('creador');
$componentes= new Aplicacion_Modulos_Componentes();
//$componentes->crear($datos);



?>
