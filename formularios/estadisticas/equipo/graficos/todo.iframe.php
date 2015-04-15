<?php
$root = (!isset($root)) ? "../../../../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
$v = new Validaciones();
$sesion = new Sesion();
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
$usuario = $sesion->usuario();
$servicio = $v->recibir("servicio");
$inicio = $v->recibir("inicio");
$final = $v->recibir("final");

function conteo($servicio,$categoria,$inicio, $final, $equipo) {
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
  (`solicitudes_solicitudes`.`servicio`='".$servicio."' AND `solicitudes_solicitudes`.`categoria`='".$categoria."')AND
  (`solicitudes_solicitudes`.`radicacion` BETWEEN '" . $inicio . "' AND '" . $final . "')AND
  (`solicitudes_solicitudes`.`equipo` = " . $equipo . ")
)GROUP BY
  `solicitudes_solicitudes`.`servicio`,
  `solicitudes_solicitudes`.`equipo`;");
  $consulta = $db->sql_query($sql);
  $conteo = 0;
  $resultados = array();
  while ($fila = $db->sql_fetchrow($consulta)) {
    $retornar =$fila['conteo'];
    
  }
  $db->sql_close();
  if(!is_numeric($retornar)){$retornar=0;}
  return(intval($retornar));
}

//print_r($resultados);
$d['reclamaciones']=conteo("01","01",$inicio, $final, $usuario['equipo']);
$d['reposiciones']=conteo("01","02",$inicio, $final, $usuario['equipo']);
$d['subsidias']=conteo("01","03",$inicio, $final, $usuario['equipo']);
$d['peticiones']=conteo("01","04",$inicio, $final, $usuario['equipo']);

$a['reclamaciones']=conteo("02","01",$inicio, $final, $usuario['equipo']);
$a['reposiciones']=conteo("02","02",$inicio, $final, $usuario['equipo']);
$a['subsidias']=conteo("02","03",$inicio, $final, $usuario['equipo']);
$a['peticiones']=conteo("02","04",$inicio, $final, $usuario['equipo']);

$t['reclamaciones']=intval($d['reclamaciones'])+intval($a['reclamaciones']);
$t['reposiciones']=intval($d['reposiciones'])+intval($a['reposiciones']);
$t['subsidias']=intval($d['subsidias'])+intval($a['subsidias']);
$t['peticiones']=intval($d['peticiones'])+intval($a['peticiones']);

$t['total']=$t['reclamaciones']+$t['reposiciones']+$t['subsidias']+$t['peticiones'];

$titulo = "Solicitudes Recibidas Area - Acueducto & Alcantarillado";
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart', 'bar']});
      google.setOnLoadCallback(drawStacked);

      function drawStacked() {
        var data = google.visualization.arrayToDataTable([
          ['Categorias', '1. Reclamaciones - <?php echo($t['reclamaciones']);?> ', '2. Reposición - <?php echo($t['reposiciones']);?>', '3. Reposición y Subsidia - <?php echo($t['subsidias']);?>', '4. Peticiones - <?php echo($t['peticiones']);?>'],
          ['Acueducto', <?php echo($d['reclamaciones']);?>,<?php echo( intval($d['reposiciones']));?>,<?php echo($d['subsidias']);?>,<?php echo($d['peticiones']);?>],
          ['Alcantarillado', <?php echo($a['reclamaciones']);?>,<?php echo(intval($a['reposiciones']));?>,<?php echo($a['subsidias']);?>,<?php echo($a['peticiones']);?>]
        ]);

        var options = {
          title: '<?php echo($titulo); ?>',
          chartArea: {width: '50%'},
          isStacked: true,
          hAxis: {
            title: '<?php echo($t['total']);?> Solicitudes Recibidas Periodo [<?php echo($inicio . " - " . $final); ?>]',
            minValue: 0,
          },
          vAxis: {title: 'Comparativa de Servicios'}
        };
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
  <center>
    <div id="chart_div" style="height: 95%;"></div>
    <center>
      </body>
      </html>