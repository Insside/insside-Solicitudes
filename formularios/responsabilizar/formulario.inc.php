<?php
$solicitudes=new Solicitudes();
$validaciones=new validaciones();
$usuarios=new Usuarios();
$solicitud=$solicitudes->consultar($validaciones->recibir("solicitud"));
/** Campos **/
$f->campos['info']="<p>En este formulario podrá adjuntar los archivos de la digitalización de los diferentes documentos físicos solicitados a los proveedores. Para adjuntar un documento deberá hacer clic en Adjuntar archivo local-Examinar. Recuerde que “no debe tener el archivo abierto” cuando lo vaya a adjuntar y debe verificar que el archivo esté guardado con un nombre “corto”.</p>";
$f->campos['solicitud']=$f->text("solicitud", $solicitud['solicitud'], "10", "required codigo", true);
$f->campos['responsable']=$solicitudes->combo_responsabilizables("usuario",$solicitud['responsable']);
$f->campos['cancelar']=$f->button("cancelar".$f->id,"button","Cancelar");
$f->campos['actualizar']=$f->button("actualizar".$f->id,"submit","Actualizar");
// Celdas
$f->celdas['info']=$f->celda("",$f->campos['info'],"","sinfondo");
$f->celdas['solicitud']=$f->celda("Solicitud:",$f->campos['solicitud']);
$f->celdas['responsable']=$f->celda("Responsable:",$f->campos['responsable']);
// Filas
$f->fila["f0"]=$f->fila($f->celdas['info']);
$f->fila["f1"]=$f->fila($f->celdas['solicitud']);
$f->fila["f2"]=$f->fila($f->celdas['responsable']);
//Compilacion
$f->filas($f->fila['f0']);
$f->filas($f->fila['f1']);
$f->filas($f->fila['f2']);
/** Botones **/
$f->botones($f->campos['cancelar'],"inferior-derecha");
$f->botones($f->campos['actualizar'],"inferior-derecha");
/** JavasScripts **/
//$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Responsabilizar\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 390, height: 250});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
?>