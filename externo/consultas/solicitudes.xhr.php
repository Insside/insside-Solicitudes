<?php 
$root = (!isset($root)) ? "../../../../" : $root;
require_once($root . "librerias/Sesion.class.php");
require_once($root . "librerias/MySQL.class.php");
require_once($root . "librerias/Cadenas.class.php");
require_once($root . "librerias/Componentes.class.php");
require_once($root . "librerias/Sectores.class.php");
require_once($root . "librerias/Servicios.class.php");
require_once($root . "librerias/Fechas.class.php");
require_once($root . "modulos/solicitudes/librerias/PQRS.class.php");
require_once($root . "modulos/solicitudes/librerias/Categorias.class.php");
require_once($root . "modulos/usuarios/librerias/Usuarios.class.php");
require_once($root . "modulos/suscriptores/librerias/Suscriptores.class.php");
$pqrs =new PQRS();
//\\//\\//\\//\\//\\//\\//\\//\\ Configuracion Consulta
$sql['tabla'] = "solicitudes_solicitudes";
$sql['indice'] = "solicitud";
//\\//\\//\\//\\//\\//\\//\\//\\ Paginación
$pagina = @$_REQUEST['pagina'];
$pagina = (!empty($pagina) && $validaciones->numero($pagina)) ? $pagina : 1;
$pagina = (($pagina == 0) ? 1 : $pagina);
$limite = 1000;
$posicion = ($pagina - 1) * $limite;
$sql['paginacion'] = " LIMIT " . $posicion . "," . $limite;
//\\//\\//\\//\\//\\//\\//\\//\\ Organización [ Orden + Criterio ]
$sql['orden'] = ((!empty($_REQUEST['orden'])) ? !empty($_REQUEST['orden']) : $sql['indice']);
$sql['criterio'] = ((!empty($_REQUEST['criterio'])) ? !empty($_REQUEST['criterio']) : "DESC");
$sql['organizacion'] = "ORDER BY `radicacion` DESC "; //`".$sql['orden']."` ".$sql['criterio']."";
//\\//\\//\\//\\//\\//\\//\\//\\ Condiciones De La Consulta
$sql['suscriptor'] = @$_REQUEST['suscriptor'];
$sql['condiciones'] = "WHERE (`suscriptor`='" . $sql['suscriptor'] . " ')";
$db =new MySQL();
$sql['sql'] = "SELECT * FROM `" . $sql['tabla'] . "` " . $sql['condiciones'] . " " . $sql['organizacion'] . " " . $sql['paginacion'] . ";"; //echo($sql['sql']);
$total = $pqrs->conteo($sql['condiciones']);
$total_paginas = round($total / $limite);
$total_paginas = (($total_paginas == 0) ? 1 : $total_paginas);
//echo($sql['sql']);
$consulta = $db->sql_query($sql['sql']);
?>
<style>
 .datos { font-size: 14px;}
 .datos thead tr { background: url("../imagenes/fondos/tablas-encabezado-claro.png") repeat scroll 0 0 #CCCCCC;}
 .datos thead th { background-attachment: scroll; background-color: #D3DCE3; background-image: url("../imagenes/fondos/tablas-encabezado-claro.png"); background-position: 0 0; background-repeat: repeat; border: 1px solid #D0D0D0; color: #000000; font-weight: bold;}
 .datos tr { height: 14px;}
 .datos tr:hover { background-color: #8BA7C9; border-color: #8BA7C9; border-style: solid; border-width: 2px 0;}
 .datos tr.odd th, .odd { background: none repeat scroll 0 0 #E5E5E5;}
 .datos tr.even th, .even { background: none repeat scroll 0 0 #D5D5D5;}
 .datos tr.odd:hover th, .datos tr.even:hover th, .datos tr.hover th { background: none repeat scroll 0 0 #CCFFCC; color: #000000;}
 .datos td { border: 1px solid #D0D0D0; height: 14px;}
 .datos .even { background-attachment: scroll; background-color: #F1F4F7; background-image: none; background-position: 0 0; background-repeat: repeat;}
 .datos .odd { background-attachment: scroll; background-color: #FAFAFA; background-image: none; background-position: 0 0; background-repeat: repeat;}
 .datos a:link { text-decoration: none;}
 .datos a:visited {}
 .datos a:hover { color: #000000; text-decoration: underline;}
 .datos .exacta { white-space: nowrap; width: 1px;}
</style>




<div id="c<?php  echo(@$_REQUEST['transaccion']); ?>">
 <table class="datos" width="100%">
  <thead>
   <tr class="titulares">
    <th class="exacta" align="center"><a href="#" title="Numeral" onclick="MUI.Notificacion('Consecutivo De Visualización');">N</a></th>
    <th class="exacta" align="center"><a href="#" title="Solicitud" onclick="MUI.Notificacion('Solicitud');">Solicitud</a></th>
    <th class="exacta" align="center"><a href="#" title="Solicitud" onclick="MUI.Notificacion('Suscriptor');">Suscriptor</a></th>
    <th class="exacta" align="center"><a href="#" title="Servicio" onclick="MUI.Notificacion('Servicio');">-S-</a></th>
    <th align="center"><a href="#" title="Servicio" onclick="MUI.Notificacion('Detalled De La Solicitud');">Detalles De La Soicitud PQRS</a></th>
    <th class="exacta" align="center"><a href="#" title="Servicio" onclick="MUI.Notificacion('Fecha');">Fecha</a></th>
   </tr>
  </thead>

  <?php 
  $conteo = 0;
  while ($fila = $db->sql_fetchrow($consulta)) {
   // Datos Computados
   //$usuario=$usuarios->consultar($fila['creador']);

   $suscriptor = $suscriptores->consultar($fila['suscriptor']);
   $suscriptor['nombre'] = $cadenas->capitalizar($suscriptor['nombres'] . " " . $suscriptor['apellidos']);
   $asunto = $asuntos->consultar($fila['asunto']);
   $detalles = "<b>" . $suscriptor['nombre'] . "</b><i>" . $asunto['descripcion'] . "</i>";
   $servicio = $servicios->consultar($fila['servicio']);
   $servicio = "<a href=\"#\" title=\"Estado\" onclick=\"MochaUI.notification('" . $servicio['nombre'] . "');\"><img src=\"imagenes/iconos/servicios/" . ($fila['servicio']) . ".png\" width=\"10\" height=\"10\"/>";
   $causal = $causales->consultar($fila['servicio'], $fila['causal']);
   $detalles.="<i>(" . $causal['titulo'] . ") " . $fila['radicado'] . "</i>";
   $detalles = $cadenas->recortar($detalles, 80);
   //Datos isualizados
   if (!empty($fila['suscriptor']) && !empty($fila['servicio']) && $fila['servicio'] <= 2) {
    $conteo++;
    $class = 'even';
    if ($conteo % 2 == 0) {
     $class = 'odd';
    }
    echo("	<tr class=\"" . $class . "\">");
    echo("<td class=\"exacta\" align=\"right\">" . ($posicion + $conteo) . "</td>");
    echo("<td class=\"exacta\" align=\"left\"><b><a href=\"#\" onClick=\"MUI.PQRS_SE_Solicitud('" . $fila['solicitud'] . "');\">" . $fila['solicitud'] . "</a></b></td>");
    echo("<td class=\"exacta\"  align=\"center\">" . $fila['suscriptor'] . "</td>");
    echo("<td class=\"exacta\"  align=\"center\">" . $servicio . "</td>");
    echo("<td align=\"left\">" . $detalles . "</td>");
    echo("<td class=\"exacta\"  align=\"center\">" . $fila['radicacion'] . "</td>");
    echo('</tr>');
   }
  }
  $db->sql_close();
  ?>
 </table>
</div>
<script>
     $('central').setStyle('background', '');
     $('central').setStyle('background-repeat', 'no-repeat');
</script>