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
$sesion = new Sesion();
$u = new Usuarios();
$v = new Validaciones();
$s = new Solicitudes();

$usuario = $v->recibir("usuario");
$servicio = $v->recibir("servicio");
$inicio = $v->recibir("inicio");
$final = $v->recibir("final");
$usuario = empty($usuario) ? $sesion->usuario() : $u->consultar($usuario);

$servicio = empty($servicio) ? "01" : $servicio;
$inicio = empty($inicio) ? $s->fecha_mas_antigua($usuario['usuario']) : $inicio;
$final = empty($final) ? $s->fecha_mas_reciente($usuario['usuario']) : $final;

$fi = $fechas->fecha($inicio);
$ff = $fechas->fecha($final);
// Reclamaciones
$rd = $s->conteo_reclamaciones_distribucion($inicio, $final);
$ra = $s->conteo_reclamaciones_alcantarillado($inicio, $final);
$pd = $s->conteo_peticiones_distribucion($inicio, $final);
$pa = $s->conteo_peticiones_alcantarillado($inicio, $final);
$rrd = $s->conteo_recursos_distribucion($inicio, $final);
$rra = $s->conteo_recursos_alcantarillado($inicio, $final);
$rrsd = $s->conteo_subsidia_distribucion($inicio, $final);
$rrsa = $s->conteo_subsidia_alcantarillado($inicio, $final);

if ($servicio == "01") {
  $tipo = "'Distribución'";
  $tr = $rd;
  $tre = $rrd;
  $trs = $rrsd;
  $tp = $pd;
  $dtr = $rd;
  $dtre = $rrd;
  $dtrs = $rrsd;
  $dtp = $pd;
  $total = $rd + $pd + $rrd + $rrsd;
  $mensaje = "Distribución - Categorias - Periodo: " . $inicio . " - " . $final;
} elseif ($servicio == "02") {
  $tipo = "'Alcantarillado'";
  $tr = $ra;
  $tre = $rra;
  $trs = $rrsa;
  $tp = $pa;
  $dtr = $ra;
  $dtre = $rra;
  $dtrs = $rrsa;
  $dtp = $pa;
  $total = $ra + $pa + $rra + $rrsa;
  $mensaje = "Alcantarillado - Categorias - Periodo: " . $inicio . " - " . $final;
}

$l['reclamaciones'] = "../categorias/categoria.iframe.php?uid=".$usuario['usuario']."&categoria=01&inicio=" . $inicio . "&final=" . $final . "&servicio=" . $servicio;
$l['reposiciones'] = "../categorias/categoria.iframe.php?uid=".$usuario['usuario']."&categoria=02&inicio=" . $inicio . "&final=" . $final . "&servicio=" . $servicio;
$l['reposicionesysubsidia'] = "../categorias/categoria.iframe.php?uid=".$usuario['usuario']."&categoria=03&inicio=" . $inicio . "&final=" . $final . "&servicio=" . $servicio;
$l['peticion'] = "../categorias/categoria.iframe.php?uid=".$usuario['usuario']."&categoria=04&inicio=" . $inicio . "&final=" . $final . "&servicio=" . $servicio;
?>
<html>
  <head>
    <title><?php echo($inicio." - ".$final);?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages: ["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Tipo', 'Vinculo',<?php echo($tipo); ?>],
          ['Reclamaciones', '<?php echo($l['reclamaciones']); ?>',<?php echo($dtr); ?>],
          ['Reposiciónes', '<?php echo($l['reposiciones']); ?>',<?php echo($dtre); ?>],
          ['Reposición y Subsidia', '<?php echo($l['reposicionesysubsidia']); ?>',<?php echo($dtrs); ?>],
          ['Peticiónes', '<?php echo($l['peticion']); ?>',<?php echo($dtp); ?>]]
                );
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 2]);
        var options = {
          title: '<?php echo($mensaje); ?> ',
          vAxis: {title: 'Tipos De Solicitudes', titleTextStyle: {color: '#cccccc'}}
        };
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(view, options);
        var selectHandler = function(e) {  
          window.location = data.getValue(chart.getSelection()[0]['row'], 1);
        }
        google.visualization.events.addListener(chart, 'select', selectHandler);
      }
    </script>
  </head>
  <body>
    <div>MODULO DE ESTADISTICAS EN MANTENIMIENTO</div>
  <center><div id="chart_div" style="width: 100%; height: 100%;"></div></center>
</body>
</html>