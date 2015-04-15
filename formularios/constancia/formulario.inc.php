<?php
$solicitud = $_REQUEST['solicitud'];
$f->oculto("solicitud", $solicitud);
$html = "<div id=\"i100x100_impresora\" style=\"float: left;\"></div>";
$html.="<div class=\"notificacion\"><p><b>Imprimir Constancia de Radicación.</b><br>";
$html.="Se dispone a imprimir la constancia de radicación de una solicitud. ";
$html.="El numero de radicación impreso en este documento es el comprobante de acceso formal a la solicitud "
        . "y su estado, constituyendo una evidencia formal del proceso inciado por el cliente y/o suscriptor. Es su deber legal entregar la constancia de radicación formal cada vez que registre una nueva solicitud en el sistema.<br>";
$html.="<b>Solicitud</b>: RE-" . $solicitud;
$html.="</p></div>";
$f->campos['solicitud'] = $f->campo("solicitud", $solicitud);
$f->campos['observacion'] = $f->textarea("observacion", "", "textarea", 25, 80, false, false, false, 255);
$f->campos['imprimir'] = $f->button("imprimir".$f->id, "submit", "Imprimir");
$f->campos['cancelar'] = $f->button("cancelar". $f->id, "button", "Cancelar");
// Celdas
$f->celdas['info'] = $f->celda("", $html, "", "notificacion");
// Filas
$f->fila["info"] = $f->fila($f->celdas['info'], "notificacion");
//Compilacion
$f->filas($f->fila['info']);
$f->botones($f->campos['imprimir'],'inferior-derecha');
$f->botones($f->campos['cancelar'],'inferior-derecha');
/** JavaScripts **/
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Imprimir Constancia\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 480, height: 215});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
?>