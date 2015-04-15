<?php
$root = (!isset($root)) ? "../../../../../../" : $root;
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
$u = new Usuarios();
$v = new Validaciones();
$s = new Solicitudes();
$equipos=new Usuarios_Equiposs();

$usuario = $v->recibir("usuario");
$servicio ="02";
$inicio = $v->recibir("inicio");
$final = $v->recibir("final");

$usuario = empty($usuario) ? $sesion->usuario() : $u->consultar($usuario);

$servicio = empty($servicio) ? "01" : $servicio;
$inicio = empty($inicio) ? $s->fecha_mas_antigua($usuario['usuario']) : $inicio;
$final = empty($final) ? $s->fecha_mas_reciente($usuario['usuario']) : $final;

$fi = $fechas->fecha($inicio);
$ff = $fechas->fecha($final);

// Reclamaciones


function conteo($servicio, $categoria, $inicio, $final, $equipo) {
  $db = new MySQL();
  $sql = ("SELECT
  Count(`solicitudes_solicitudes`.`solicitud`)AS `conteo`,
  `solicitudes_solicitudes`.`servicio`,
  `solicitudes_solicitudes`.`equipo`
FROM
  `solicitudes_solicitudes`
  INNER JOIN `solicitudes_servicios` ON `solicitudes_solicitudes`.`servicio` =
    `solicitudes_servicios`.`servicio`
WHERE(
  (`solicitudes_solicitudes`.`servicio`='" . $servicio . "' AND `solicitudes_solicitudes`.`categoria`='" . $categoria . "')AND
  (`solicitudes_solicitudes`.`radicacion` BETWEEN '" . $inicio . "' AND '" . $final . "')AND
  (`solicitudes_solicitudes`.`equipo` = " . $equipo . ")
)GROUP BY
  `solicitudes_solicitudes`.`servicio`,
  `solicitudes_solicitudes`.`equipo`;");
  $consulta = $db->sql_query($sql);
  $conteo = 0;
  $resultados = array();
  while ($fila = $db->sql_fetchrow($consulta)) {
    $retornar = $fila['conteo'];
  }
  $db->sql_close();
 if(!is_numeric($retornar)){$retornar=0;}
  return(intval($retornar));
}

$a['reclamaciones']=conteo("02","01",$inicio, $final, $usuario['equipo']);
$a['reposiciones']=conteo("02","02",$inicio, $final, $usuario['equipo']);
$a['subsidias']=conteo("02","03",$inicio, $final, $usuario['equipo']);
$a['peticiones']=conteo("02","04",$inicio, $final, $usuario['equipo']);

$t['reclamaciones'] = intval($a['reclamaciones']);
$t['reposiciones'] = intval($a['reposiciones']);
$t['subsidias'] = intval($a['subsidias']);
$t['peticiones'] = intval($a['peticiones']);
$t['maximo']=  max($t);

$t['total']=$t['reclamaciones']+$t['reposiciones']+$t['subsidias'] +$t['peticiones'];

$equipo=$equipos->consultar($usuario['equipo']);

$titulo['grafico'] = " Solicitudes del Servicio de Alcantarillado - Area(Equipo) ".$equipo['nombre'];
$titulo['vertical'] = "Categorias del Servicio";
$titulo['horizontal'] = $t['total']." Solicitudes Recibidas [ Periodo ".$inicio."-".$final." ]";
// Vinculos a categorias
$l['reclamaciones'] = "categorias/reclamaciones.iframe.php?uid=".$usuario['usuario']."&categoria=01&inicio=" . $inicio . "&final=" . $final . "&servicio=" . $servicio;
$l['reposiciones'] = "categorias/reposiciones.iframe.php?uid=".$usuario['usuario']."&categoria=02&inicio=" . $inicio . "&final=" . $final . "&servicio=" . $servicio;
$l['subsidias'] = "categorias/subsidias.iframe.php?uid=".$usuario['usuario']."&categoria=03&inicio=" . $inicio . "&final=" . $final . "&servicio=" . $servicio;
$l['peticiones'] = "categorias/peticiones.iframe.php?uid=".$usuario['usuario']."&categoria=04&inicio=" . $inicio . "&final=" . $final . "&servicio=" . $servicio;



?>
<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart', 'bar']});
      google.setOnLoadCallback(drawStacked);
      function drawStacked() {
        var data = google.visualization.arrayToDataTable([
                ['Categorias', 'Solicitudes',{ role: "style" }, { role: 'annotation' },'Vinculo'],
                ['Reclamaciones',<?php echo($a['reclamaciones']); ?>,"red","<?php echo($a['reclamaciones']); ?>",'<?php echo($l['reclamaciones']); ?>'],
                ['Reposiciónes',<?php echo($a['reposiciones']); ?>,"grey","<?php echo($a['reposiciones']); ?>",'<?php echo($l['reposiciones']); ?>'],
                ['Subsidias',<?php echo($a['subsidias']); ?>,"gold","<?php echo($a['subsidias']); ?>",'<?php echo($l['subsidias']); ?>'],
                ['Peticiónes',<?php echo($a['peticiones']); ?>,"blue","<?php echo($a['peticiones']); ?>",'<?php echo($l['peticiones']); ?>']
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1]);
        var options = {
          title: '<?php echo($titulo['grafico']); ?>',
          legend: { position: "none" },
          chartArea: {width: '60%'},
          isStacked: true,
          hAxis: {title: '<?php echo($titulo['horizontal']); ?>', minValue: 0, maxValue:<?php echo($t['maximo']); ?>},
          vAxis: {title: '<?php echo($titulo['vertical']); ?>'}
        };
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(view,options);
        var selectHandler = function(e) {window.location = data.getValue(chart.getSelection()[0]['row'], 4);}
        google.visualization.events.addListener(chart, 'select', selectHandler);
      }
    </script>
  </head>
  <body>
  <center>
    <div id="chart_div" style="height: 99.5%;"></div>
  </center>
</body>
</html>