<?php 
$root=(!isset($root))?"../../../":$root;
require_once($root."modulos/solicitudes/librerias/Configuracion.cnf.php");
$validaciones=new Validaciones();
$fecha=new Fechas();
$archivos=new Solicitudes_Archivos();
// Variables recibidas
$transaccion=$validaciones->recibir("transaccion");
$solicitud=$validaciones->recibir("solicitud");
$categoria=$validaciones->recibir("categoria");
$observacion=$validaciones->recibir("observacion");
// Elementos declarados

// Varidables definidas
$v['prefijo']=$fecha->prefijo();
$v['nombre']=$v['prefijo']."-".$categoria;
//print_r($_REQUEST); // data is store in get
//print_r($_FILES); // our images
$ruta=$solicitud;

if(!file_exists($ruta)){
 mkdir($ruta);
}else{

}
// Establecemos el directorio donde se guardan los ficheros
$conteo=0;
// Recorremos los archivos recibidos
foreach($_FILES as $archivo){
 // Tipo de archivo recibido
 $extension=$archivos->extension($archivo["name"]);
 // Se establece el nombre del archivo
 $nombre=$ruta."/".$v["nombre"].".".$extension;
 // Si el archivo ya existe, no lo guardamos
 if(file_exists($nombre)){
  echo "<br/>El archivo ".$archivo["name"]." ya existe, ".$ruta."<br/>";
  continue;
 }
 // Copiamos de la dirección temporal al directorio final
 if(filesize($archivo["tmp_name"])){
  if(!(move_uploaded_file($archivo["tmp_name"],$nombre))){
   $html="<p>Error al escribir el archivo ".$archivo["name"]."</p>";
  }else{
   $archivos->registrar(time(),$solicitud,$categoria,$v['nombre'],$observacion,"modulos/solicitudes/archivos/".$nombre,$archivo["size"]);
   $html=("<p>El archivo ha sido almacenado satisfactoriamente, al presionar cerrar se actualizara el contenido del proveedor, donde podrá observar el archivo que ha cargado al sistema como un adjunto entre los documentos presentados por el proveedor. Recuerde que por cada archivo que se actualice el proveedor quedara a la espera de aprobación.</p>");
   $html.="<div style=\"text-align: center\">";
   $html.="<input"
           . " type=\"button\" "
           . "value=\"Terminar\" "
           . "name=\"terminar".$transaccion."\" "
           . "id=\"terminar".$transaccion."\" "
           . "onClick=\"parent.terminar". ($transaccion) . "();\""
           . "/>";
   $html.="</div>";
   chmod($nombre,0666);
   $conteo++;
  }
 }
}
echo($html);
//echo "<br/>Fin de ejecución de 'GuardaArchivosFormulario', $conteo archivos subidos.<br/>";
?>