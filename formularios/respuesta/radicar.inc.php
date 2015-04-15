<?php
$root = (!isset($root)) ? "../../../../" : $root;
require_once($root . "modulos/comercial/librerias/Configuracion.cnf.php");
$configuraciones = new Configuraciones();
$solicitud = $solicitudes->consultar($_REQUEST['solicitud']);
$solicitud['radicante'] = $cadenas->mayusculas($solicitud['nombres'] . " " . $solicitud['apellidos']);
$solicitud['direccion'] = $cadenas->mayusculas($solicitud['direccion'] . " " . $solicitud['referencia']);
$causal = $causales->consultar($solicitud['servicio'], $solicitud['causal']);
$solicitud['causal'] = "<b>" . $solicitud['causal'] . "</b>: " . $causal['titulo'];
$solicitud['categoria'] = ($solicitud['categoria'] == "1") ? "una <b>RECLAMACIÓN</b>" : $solicitud['categoria'];
$solicitud['categoria'] = ($solicitud['categoria'] == "4") ? "una <b>SOLICITUD</b>" : $solicitud['categoria'];
$solicitud['servicio'] = ($solicitud['servicio'] == "1") ? "ACUEDUCTO" : "ALCANTARILLADO";


$suscriptor = $suscriptores->consultar($solicitud ['suscriptor']);
$servicio = $_REQUEST['servicio'];
$cobro = $_REQUEST['cobro'];
$identificacion = $suscriptor['identificacion'];
$nombre = $cadenas->mayusculas($suscriptor['nombres'] . " " . $suscriptor['apellidos']);
$direccion = $cadenas->capitalizar($suscriptor['direccion']);
$sexo = $suscriptor['sexo'];
$respuesta['id'] = time();
$valor['servicio'] = strtoupper(isset($_REQUEST['servicio']) ? $_REQUEST['servicio'] : "");
$valor['cobro'] = strtoupper(isset($_REQUEST['cobro']) ? $_REQUEST['cobro'] : "");

$respuesta['lugaryfecha'] = "" . $configuraciones->ciudad . ", " . $configuraciones->region . " " . ($fechas->hoy_textual()) . "";
$respuesta['lugaryfecha'] = '<p style="font-size:14px;">' . ($cadenas->capitalizar($respuesta['lugaryfecha'])) . '</p>';
$respuesta['formalidad'] = '<p style="padding-top:30px; font-size:14px;">Suscriptor';
$respuesta['formalidad'].="<br><b>" . $suscriptor['suscriptor'] . "</b>: " . $nombre;
$respuesta['formalidad'].="<br><b>Dirección</b>: " . $suscriptor['direccion'] . "</p>";
$respuesta['formalidad'].="<p style=\"padding-top:30px;font-size:14px;\">Cordial Saludo.</p>";

$respuesta['contenido'] = '<p style="padding-top:30px; font-size:14px;">Por medio del presente documento y en contestación formal a la solicitud radicada en
nuestros sistemas con el código de referencia <b>RES-' . $solicitud['solicitud'] . '</b> el día <b>' . $solicitud['radicacion'] . '</b>, presentada por <b>' . $solicitud['radicante'] . '</b>con documento de
identidad <b>' . $solicitud['identificacion'] . '</b> , con domicilio en <b>' . $solicitud['direccion'] . '</b>, la cual tenia por asunto
la presentación de ' . $solicitud['categoria'] . ' por la prestación del servicio de <b>' . $solicitud['servicio'] . '</b> tipificada en
nuestra labor bajo la causal <b>' . $solicitud['causal'] . '</b>.
Me permito formalmente expresarle que se a dado normal tramite a la misma y solución mediante
la ejecución de la orden de servicio <b>' . $valor['servicio'] . '</b>. Para mayor información no dude en contactarnos.
</p><p style="padding-top:10px; font-size:14px;">En constancia de lo anterior se radica el presente documento bajo el código <b>RER-' . $respuesta['id'] . '</b>, siendo el ' . $fechas->hoy_textual() . ', a las <b>' . $fechas->ahora() . '</b>,
en Guadalajara de Buga, Valle del Cauca.</p>';

$respuesta['final'] = '<p style="padding-top:20px"><br>Atentamente.</p>';
$respuesta['final'].="<p style=\"padding-top:20px\">________________________________________________";
$respuesta['final'].="<br><b>Maria Idalith Cifuentes</b>";
$respuesta['final'].="<br>Correo Electrónico: comercial@aguasdebuga.com.co</p>";

$contenido = $respuesta['lugaryfecha'];
$contenido .= $respuesta['formalidad'];
$contenido .= $respuesta['contenido'];
$contenido .= $respuesta['final'];
// Campos
$campo['servicio'] = $componentes->text('servicio', $valor['servicio'], '32', 'required', true, false, "[ Requerido ]");
$campo['cobro'] = $componentes->text('cobro', $valor['cobro'], '32', 'required', true, false, "[ Requerido ]");
$campo['radicar'] = "<input name=\"radicar\"  id=\"radicar\" type=\"submit\" value=\"Radicar\"/>";
?>
<style>
  #encabezado{font-size: 14px;background-color: #DADADA;width:620px;}
  #divFormulario{ position: relative; width: 100%; }
  #divFormulario  h2{display: block;font-size: 14px;font-weight: bold;height: 14px;line-height: 14px;width: 639px;margin-top: 5px;padding-left: 5px;text-align: left;}
  #divFormulario .titular{  font-size: 12px; font-style: bold; width: 100%; height: 18px; background-color: #EEEEEE}
  #divFormulario p{ font-size: 14px ; line-height: 13px ; padding-bottom: 10px;}
  #divFormulario .row {display:table; width:100%;}
  #divFormulario .cell {display:table-cell;vertical-align:top;padding:2px;border-collapse: collapse;  border-spacing: 0; background-color: #eeeeee; padding: 4px; border: 1px solid #F6F7F8;}
  #divFormulario input{ font-size:16px; height: 20px !important;padding: 0px; width: 100%;border:1px solid #cccccc;}
  #divFormulario select{  border: 1px solid #CCCCCC;  font-size: 16px;  height: 22px;  padding: 0;  width: 100%;}
  #divFormulario #servicio{font-size:20px;width: 100%;  text-transform: uppercase; color: #000000; border-color: #cccccc; text-align: center; }
  #divFormulario #cobro{font-size:20px;width: 100%;  text-transform: uppercase; color: #000000; border-color: #cccccc; text-align: center; }
  #divFormulario #identificacion{width: 80px; }
  #divFormulario #nombres{width: 100%;  text-transform: capitalize;}
  #divFormulario #apellidos{width: 100%;  text-transform: capitalize;}
  #divFormulario #cancelar{width: 150px; height: 22px! important ; font-size: 12px; }
  #divFormulario #radicar{width: 150px; height: 22px! important ; font-size: 12px; }
  #divFormulario #enviar{width: 150px; height: 22px !important ; font-size: 12px;}
  #divFormulario #radios{ float: right; margin: 0px; padding-right: 10px;padding-top: 3px;}
  #divFormulario  #radios .some-class { float:right; clear:none; }
  #divFormulario #radios label { float:left; clear:none; display:block; padding: 1px !important; }
  #divFormulario  #radios input{ float:left; clear:none; margin: 2px 0 0 2px; height: 16px !important; width: 16px !important; }
  .validation-passed { background-color: lightgreen !important; } /* campo valido */
  .validation-failed { border-color: red; } /* campo invalido */
  .validation-advice {   color: #FFFFFF;    font-size: 11px;  line-height: 11px; } /* mensaje de error */
  .overTxtLabel{color: #cccccc;}
</style>
<input type="hidden" name="accion" id="accion" value="radicar" />
<input type="hidden" name="solicitud" id="solicitud" value="<?php echo(@$_REQUEST['solicitud']); ?>" />
<input type="hidden" name="respuesta" id="respuesta" value="<?php echo($respuesta['id']) ?>" />
<div id="divFormulario">
  <textarea class="input" name="contenido" id="contenido" rows="2" cols="180"><?php echo $contenido ?></textarea>
  <div class="row">
    <div class="cell" style=""><div class="titular">Orden De Servicio: </div><?php echo($campo['servicio']); ?></div>
    <div class="cell" style=""><div class="titular">Orden De Cobro: </div><?php echo($campo['cobro']); ?></div>
    <div class="cell" style="text-align:center;"><div class="titular"> </div><?php echo($campo['radicar']); ?></div>
  </div>
</div>





















<script type="text/javascript">
  MUI.resizeWindow($('<?php echo($formulario->ventana); ?>'), {width: 750, height: 400, top: 0, left: 0});
  MUI.centerWindow($('<?php echo($formulario->ventana); ?>'));
  var ckInstance; // CKeditor instances
  ckInstance = CKEDITOR.replace('contenido');

  function CKupdate() {
    //for ( instance in CKEDITOR.instances )
    //  CKEDITOR.instances[instance].updateElement();
    ckInstance.updateElement();

  }

</script>
