<?php
$respuesta = $_REQUEST['respuesta'];
$solicitud = $_REQUEST['solicitud'];
$servicio = $_REQUEST['servicio'];
$cobro = $_REQUEST['cobro'];
$detalle = $_REQUEST['contenido'];
$solicitudes = new Solicitudes();
$respuestas = new Respuestas();
$respuestas->crear($respuesta, $solicitud, $detalle);
$solicitudes->actualizar($solicitud, 'respuesta', $respuesta);
$solicitudes->actualizar($solicitud, 'contestacion', $fechas->hoy());
?>
<script type="text/javascript">
  MUI.closeWindow($('<?php echo($formulario->ventana ); ?>'));
</script>