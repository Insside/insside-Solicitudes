<?php
$root = (!isset($root)) ? "../../../../" : $root;
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
$sesion=new Sesion();
$v=new Validaciones();
$s=new Solicitudes();
$u=new Usuarios();
$transaccion=$v->recibir("transaccion");
$trasmision = $v->recibir("trasmision");

$usuario=$v->recibir("usuario");
$servicio=$v->recibir("servicio");
$inicio=$v->recibir("inicio");
$final=$v->recibir("final");

$usuario=empty($usuario) ? $sesion->usuario(): $u->consultar($usuario);
$servicio=empty($servicio) ? "01": $servicio;
$inicio=empty($inicio) ? $s->fecha_mas_antigua($usuario['usuario']) :$inicio;
$final=empty($final) ? $s->fecha_mas_reciente($usuario['usuario']) :$final;
/** Reclamaciones **/
$rd=$s->conteo_reclamaciones_distribucion($inicio,$final);
$ra=$s->conteo_reclamaciones_alcantarillado($inicio,$final);
$pd=$s->conteo_peticiones_distribucion($inicio,$final);
$pa=$s->conteo_peticiones_alcantarillado($inicio,$final);
$rrd=$s->conteo_recursos_distribucion($inicio,$final);
$rra=$s->conteo_recursos_alcantarillado($inicio,$final);
$rrsd=$s->conteo_subsidia_distribucion($inicio,$final);
$rrsa=$s->conteo_subsidia_alcantarillado($inicio,$final);
$total=$rd+$ra+$pd+$pa+$rrd+$rra+$rrsd+$rrsa;
/************************************************************************/
$f = new Formularios($transaccion);
echo($f->apertura());
$f->campos['tsd'] =$f->campo("tsd",($rd+$rrd+$rrsd+$pd),"");
$f->campos['tsa'] =$f->campo("ta",($ra+$rra+$rrsa+$pa),"");
$f->campos['total'] =$f->campo("total",$total,"");

$f->campos['inicio'] =$f->campo("solicitudes","","");
$f->campos["ra"]=$ra;
$f->campos["rd"]=$rd;

$f->celdas["ed"] = $f->celda("Distribución",$f->campos['tsd'],"","center");
$f->celdas["ea"] = $f->celda("Alcantarillado",$f->campos['tsa'] ,"","center");

$f->celdas["rd"] = $f->celda("",$f->campos["rd"],"","center");
$f->celdas["ra"] = $f->celda("",$f->campos["ra"],"","center");

$f->celdas["rrd"] = $f->celda("",$rrd,"","center");
$f->celdas["rra"] = $f->celda("",$rra,"","center");

$f->celdas["rrsd"] = $f->celda("",$rrsd,"","center");
$f->celdas["rrsa"] = $f->celda("",$rrsa,"","center");

$f->celdas["pd"] = $f->celda("",$pd,"","center");
$f->celdas["pa"] = $f->celda("",$pa,"","center");
$f->celdas["total"] = $f->celda("Total Solicitudes",$f->campos['total'],"","center");

$f->fila["fila1"]="<h2>Consolidados</h2>";
$f->fila["fila2"] = $f->fila($f->celdas["total"]);
$f->fila["fila3"] = $f->fila($f->celdas["ed"].$f->celdas["ea"]);
$f->fila["fila4"]="<h2>Reclamaciones</h2>";
$f->fila["fila5"] = $f->fila($f->celdas["rd"].$f->celdas["ra"]);
$f->fila["fila6"]="<h2>Reposicion</h2>";
$f->fila["fila7"] = $f->fila($f->celdas["rrd"].$f->celdas["rra"]);
$f->fila["fila8"]="<h2>Reposición & Subsidia</h2>";
$f->fila["fila9"] = $f->fila($f->celdas["rrsd"].$f->celdas["rrsa"]);
$f->fila["fila10"]="<h2>Peticiones</h2>";
$f->fila["fila11"] = $f->fila($f->celdas["pd"].$f->celdas["pa"]);
$f->filas($f->fila['fila1']);
$f->filas($f->fila['fila2']);
$f->filas($f->fila['fila3']);
$f->filas($f->fila['fila4']);
$f->filas($f->fila['fila5']); 
$f->filas($f->fila['fila6']);
$f->filas($f->fila['fila7']);
$f->filas($f->fila['fila8']);
$f->filas($f->fila['fila9']);
$f->filas($f->fila['fila10']);
$f->filas($f->fila['fila11']);
echo($f->generar());
echo($f->controles());
echo($f->cierre());
?>