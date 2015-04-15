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
$inicio = $v->recibir("inicio");
$final = $v->recibir("final");

$usuario = empty($usuario) ? $sesion->usuario() : $usuarios->consultar($usuario);
$categoria= empty($categoria) ? "01" : $categoria;
$servicio = empty($servicio) ? "01" : $servicio;
$inicio = empty($inicio) ? $s->fecha_mas_antigua($usuario['usuario']) : $inicio;
$final = empty($final) ? $s->fecha_mas_reciente($usuario['usuario']) : $final;

$fi=$fechas->fecha($inicio);
$ff=$fechas->fecha($final);

$mensaje="Solicitudes Servicio: ".$servicio." Categoria: ".$categoria." Periodo: ".$inicio." - ".$final;

?>
<html>
 <head>
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript">
   google.load("visualization", "1", {packages:["corechart"]});
   google.setOnLoadCallback(drawChart);
   function drawChart() {
    var data = google.visualization.arrayToDataTable([
     ['Tipo','Vinculo','<?php  echo(($servicio=="1")?"Distribución":"Alcantarillado");?>'],
			<?php 
			$db=new MySQL();
			$acentos = $db->sql_query("SET NAMES 'utf8'");
			$sql=("
					SELECT HIGH_PRIORITY STRAIGHT_JOIN SQL_BIG_RESULT
                `solicitudes_solicitudes`.`servicio`,
                `solicitudes_solicitudes`.`categoria`,
                `solicitudes_solicitudes`.`causal`,
                `solicitudes_solicitudes`.`equipo`,
                Count(`solicitudes_solicitudes`.`solicitud`) AS `conteo`
					FROM `solicitudes_solicitudes`
					WHERE(
                `solicitudes_solicitudes`.`servicio`='".$servicio."' AND
                `solicitudes_solicitudes`.`categoria`='".$categoria."' AND
                (`solicitudes_solicitudes`.`equipo`='02' OR `solicitudes_solicitudes`.`equipo`='03')AND
                `solicitudes_solicitudes`.`radicacion` BETWEEN '".$inicio."' AND '".$final."')
					GROUP BY 
                `solicitudes_solicitudes`.`causal` 
           ;
			");		
			
			$consulta=$db->sql_query($sql);
			$conteo=0;
			$filas=NULL;
			while($fila=$db->sql_fetchrow($consulta)){
     $filas[$conteo]=$fila;
     $conteo++;
     
   }
			$db->sql_close();		
			$_causales=$filas;//echo("<pre>");print_r($_causales);echo("</pre>");
			//Toca veriguar los datos de la causal y adjuntalos al conteo que representa la fila
			// Diseño el bloque que se emtrea en el JS
			$columnas="";
			$total=0;
			for($i=0;$i<count($_causales);$i++){
				$datos=$_causales[$i]['conteo'];//[2,2.7,2.9,3.5];
				$vinculo="../causales/causal.iframe.php?categoria=".$categoria."&causal=".$_causales[$i]['causal']."&inicio=".$inicio."&final=".$final."&servicio=".$servicio;
				$causal=$causales->consultar($_causales[$i]['servicio'],$_causales[$i]['causal']);
				//$columnas.="[".$datos.",'".((($_causales[$i]['servicio']=='01')?'D':'A').''.$_causales[$i]['causal'])."','','','".$causal['titulo']."']";
				$nombre=$_causales[$i]['causal']."-".$causal['titulo'];
				$valor=$datos;
				$columnas.="['".$nombre."', '".$vinculo."',".$valor."]";
				$total+=$_causales[$i]['conteo'];
				if($i<(count($_causales)-1)){$columnas.=",";}
			}
			echo($columnas);
			?>
    ]);
	var view =new google.visualization.DataView(data);
	view.setColumns([0, 2]);
	var options={
	title: '<?php echo($mensaje);?> ',
	vAxis: {title: 'Tipos De Solicitudes', titleTextStyle: {color: '#cccccc'}}
	};
	var chart =new google.visualization.BarChart(document.getElementById('chart_div'));
	chart.draw(view, options);
	var selectHandler = function(e){window.location = data.getValue(chart.getSelection()[0]['row'],1 );}
	google.visualization.events.addListener(chart, 'select', selectHandler);
}
</script>
</head>
<body>
<center>
<div id="chart_div" style="width: 100%; height: 100%;"></div>
</center>
<?php echo($sql);?>
<script>
parent.MUI.Solicitudes_Estadisticas_Complemento_Categoria('<?php echo($servicio);?>','<?php echo($categoria);?>','<?php echo($inicio);?>','<?php echo($final);?>');
  </script>
</body>
</html>