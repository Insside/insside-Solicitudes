<?php 
$categoria = @$_REQUEST['categoria' . $transaccion];
$servicio = @$_REQUEST['servicio' . $transaccion];
$causal = @$_REQUEST['causal' . $transaccion];
$descripcion = @$_REQUEST['descripcion'];
$claves = @$_REQUEST['claves'];
$asuntos->crear($categoria, $servicio, $causal, $descripcion, $claves);
?>
<script type="text/javascript">
 MUI.closeWindow($('<?php  echo($formulario->ventana); ?>'));
 iTableAsuntos.refresh();
</script>