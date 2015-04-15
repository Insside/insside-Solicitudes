<?php 
$v['archivo']=@$_REQUEST['archivo'];
$f->oculto("archivo",$v['archivo']);

$html="<div id=\"i100x100_irreversible\" style=\"float: left;\"></div>";
$html.="<div class=\"notificacion\"><p><b>Eliminar Archivo Adjunto.</b><br>";
$html.="Se dispone a eliminar un archivo relacionado con una solicitud se le solicita considere que esta ";
$html.="acción es irreversible antes de proceder, confirme o cancele la presente solicitud para poder continuar.";
$html.="<b>Proveedor</b>: ";
$html.="<b>Archivo</b>: ".$v['archivo'];
$html.="</p></div>";
$f->campos['archivo']=$f->archivo("archivo","application/pdf","");
$f->campos['observacion']=$f->textarea("observacion","","textarea",25,80,false,false,false,255);
$f->campos['eliminar']=$f->button("eliminar".$f->id,"submit","Confirmar");
$f->campos['cancelar']=$f->button("cancelar".$f->id,"button","Cancelar");
// Celdas
$f->celdas['info']=$f->celda("",$html,"","notificacion");
// Filas
$f->fila["info"]=$f->fila($f->celdas['info'],"notificacion");
//Compilacion
$f->filas($f->fila['info']);
$f->botones($f->campos['eliminar'],"inferior-derecha");
$f->botones($f->campos['cancelar'],"inferior-derecha");
/** JavaScripts **/
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 390, height: 205});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
?>