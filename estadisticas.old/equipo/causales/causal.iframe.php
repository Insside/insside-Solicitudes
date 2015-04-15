<?php
$root = (!isset($root)) ? "../../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
//print_r($_REQUEST);
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
$usuarios = new Usuarios();
$v = new Validaciones();
$s = new Solicitudes();

$usuario = $v->recibir("usuario");
$categoria = $v->recibir("categoria");
$servicio = $v->recibir("servicio");
$causal = $v->recibir("causal");
$inicio = $v->recibir("inicio");
$final = $v->recibir("final");

$usuario = empty($usuario) ? $sesion->usuario() : $usuarios->consultar($usuario);
$categoria = empty($categoria) ? "01" : $categoria;
$servicio = empty($servicio) ? "01" : $servicio;
$causal = empty($causal) ? "217" : $causal;
$inicio = empty($inicio) ? $s->fecha_mas_antigua($usuario['usuario']) : $inicio;
$final = empty($final) ? $s->fecha_mas_reciente($usuario['usuario']) : $final;

$titulo="Servicio: ".$servicio." Categoria: ".$categoria." Causal: ".$causal." Periodo: ".$inicio." - ".$final;

$fi = $fechas->fecha($inicio);
$ff = $fechas->fecha($final);
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages: ["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Fecha', ' ', 'Solicitudes'],
<?php
$db = new MySQL();
$acentos = $db->sql_query("SET NAMES 'utf8'");
$sql = ("
SELECT 
`solicitudes_solicitudes`.`solicitud`, 
`solicitudes_solicitudes`.`radicacion`, 
`solicitudes_solicitudes`.`servicio`, 
`solicitudes_solicitudes`.`categoria`, 
`solicitudes_solicitudes`.`causal`, 
`solicitudes_solicitudes`.`equipo`,
Count(`solicitudes_solicitudes`.`solicitud`) AS `conteo`
FROM `solicitudes_solicitudes` 
WHERE( 
`solicitudes_solicitudes`.`servicio` = '".$servicio."' AND 
`solicitudes_solicitudes`.`categoria` = '".$categoria."' AND 
`solicitudes_solicitudes`.`causal` = '".$causal."' AND 
(`solicitudes_solicitudes`.`radicacion` BETWEEN '".$inicio."' AND '".$final."') 
AND(`equipo`='02' OR `equipo`='03')
) 
GROUP BY
`solicitudes_solicitudes`.`radicacion`;
     ");
$consulta = $db->sql_query($sql);
$total = $db->sql_numrows($consulta);
$conteo = 0;
$filas = NULL;
$html = "";
while ($fila = $db->sql_fetchrow($consulta)) {
  $filas[$conteo] = $fila;
  $html.=("['" . $fila['radicacion'] . "',0," . $fila['conteo'] . "]");
  $html.=(($conteo < ($total - 1)) ? "," : "");
  $conteo++;
}
$db->sql_close();
echo($html);
?>

        ]);

        var options = {
          title: '<?php echo($titulo); ?>'
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>

    <div id="chart_div" style="width: 100%; height: 100%;"></div>
  </body>
</html>