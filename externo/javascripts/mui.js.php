<?php 
$root = (!isset($root)) ? "../../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
?>
<?php  if (isset($debug)) { ?><script type="text/javascript"><?php  } ?>

 initializeWindows = function() {
//\\//\\//\\ Funciones Cargadas Desde La Base De Datos //\\//\\//\\
  //\\//\\//\\ Cargadas Desde La Base De Datos //\\//\\//\\
  if ($('accordiantestLinkCheck')) {
   $('accordiantestLinkCheck').addEvent('click', function(e) {
    e.stop();
    MUI.XaccordiantestWindow();
   });
  }
// Deactivate menu header links
  $$('a.returnFalse').each(function(el) {
   el.addEvent('click', function(e) {
    e.stop();
   });
  });
// Form Window
  MUI.Proveedores_Registrar = function() {
   var titulo = "Inscripción De Proveedores";
   //MUI.Notificacion(titulo);
   var transaccion = (new Date()).valueOf();
   var xhr = MUI.path.proveedores + 'formularios/proveedor.xhr.php?transaccion=' + transaccion;
   MUI.updateContent({
    'element': $('central'),
    'title': titulo,
    'loadMethod': 'xhr',
    'url': xhr,
    'padding': {top: 10, right: 10, bottom: 10, left: 10}
   });
   $('central').setStyle('background', '');
   $('central').setStyle('background-repeat', 'no-repeat');
  };















  MUI.Notificacion = function(mensaje) {
   MUI.notification(mensaje);
  };

  MUI.PQRS_SE_Solicitud = function(solicitud) {
   var titulo = "Solicitud [ " + solicitud + "]";
   //MUI.Notificacion(titulo);
   var transaccion = (new Date()).valueOf();
   var xhr = MUI.path.pqrs + 'externo/consultas/solicitud.xhr.php?transaccion=' + transaccion + "&solicitud=" + solicitud;
   MUI.updateContent({
    'element': $('central'),
    'title': titulo,
    'loadMethod': 'xhr',
    'url': xhr,
    'padding': {top: 10, right: 10, bottom: 10, left: 10}
   });
  };




  MUI.PQRS_SE_Solicitudes = function(suscriptor) {
   var titulo = "Solicitudes Radicadas [ " + suscriptor + "]";
   //MUI.Notificacion(titulo);
   var transaccion = (new Date()).valueOf();
   var xhr = MUI.path.pqrs + 'externo/consultas/solicitudes.xhr.php?transaccion=' + transaccion + "&suscriptor=" + suscriptor;
   MUI.updateContent({
    'element': $('central'),
    'title': titulo,
    'loadMethod': 'xhr',
    'url': xhr,
    'padding': {top: 0, right: 0, bottom: 0, left: 0}
   });
  };




  MUI.PQRS_SE_Formulario = function(suscriptor) {
   var titulo = "Formulario De Radicación De Nueva Solicitud [ " + suscriptor + "]";
   var transaccion = (new Date()).valueOf();
   var xhr = MUI.path.pqrs + 'externo/formularios/radicacion.xhr.php?transaccion=' + transaccion + "&suscriptor=" + suscriptor;
   MUI.updateContent({
    'element': $('central'),
    'title': titulo,
    'loadMethod': 'xhr',
    'url': xhr,
    'padding': {top: 10, right: 10, bottom: 10, left: 10}
   });
  };




  MUI.AcercaDe = function() {
   var transaccion = (new Date()).valueOf();
   var url = MUI.path.pqrs + 'externo/bienvenidos.xhr.php?transaccion=' + transaccion;
   new MUI.Window({
    id: 'v' + transaccion,
    title: 'AGUAS DE BUGA S.A. E.S.P - Bienvenid@',
    icon: 'images/icons/16x16/page.gif',
    loadMethod: 'xhr',
    contentURL: url,
    width: 822, height: 480,
    padding: {top: 0, bottom: 0, left: 0, right: 0},
    maximizable: false,
    resizable: false,
    closeAfter: 40000,
    scrollbars: false
   });
  };

  MUI.SinSolicitudes = function() {
   var transaccion = (new Date()).valueOf();
   var url = MUI.path.pqrs + 'externo/sinsolicitudes.xhr.php?transaccion=' + transaccion;
   new MUI.Window({
    id: 'v' + transaccion,
    title: 'Notificación',
    icon: 'images/icons/16x16/page.gif',
    loadMethod: 'xhr',
    contentURL: url,
    width: 822, height: 480,
    padding: {top: 0, bottom: 0, left: 0, right: 0},
    maximizable: false,
    resizable: false,
    closeAfter: 10000,
    scrollbars: false
   });
  };


  MUI.PQRS_SE_Consultar = function() {
   var transaccion = (new Date()).valueOf();
   var url = MUI.path.pqrs + 'externo/consultar.xhr.php?transaccion=' + transaccion;
   new MUI.Window({
    id: 'v' + transaccion,
    title: 'Consultar - AGUAS DE BUGA S.A. E.S.P - Bienvenid@',
    icon: 'images/icons/16x16/page.gif',
    loadMethod: 'xhr',
    contentURL: url,
    width: 480, height: 250,
    padding: {top: 0, bottom: 0, left: 0, right: 0},
    maximizable: false,
    resizable: false,
    scrollbars: false
   });
  };




  MUI.PQRS_SE_Radicar = function() {
   var transaccion = (new Date()).valueOf();
   var url = MUI.path.pqrs + 'externo/radicar.xhr.php?transaccion=' + transaccion;
   new MUI.Window({
    id: 'v' + transaccion,
    title: 'Radicar - AGUAS DE BUGA S.A. E.S.P - Bienvenid@',
    icon: 'images/icons/16x16/page.gif',
    loadMethod: 'xhr',
    contentURL: url,
    width: 480, height: 250,
    padding: {top: 0, bottom: 0, left: 0, right: 0},
    maximizable: false,
    resizable: false,
    scrollbars: false
   });
  };



  MUI.Terminos = function() {
   var transaccion = (new Date()).valueOf();
   var url = MUI.path.pqrs + 'externo/terminos.xhr.php?transaccion=' + transaccion;
   new MUI.Modal({
    id: 'v' + transaccion,
    title: 'Portal De Servicios - Aguas De Buga S.A. E.S.P',
    icon: 'images/icons/16x16/page.gif',
    loadMethod: 'xhr',
    contentURL: url,
    width: 750, height: 480,
    padding: {top: 20, bottom: 20, left: 20, right: 20},
    maximizable: false,
    resizable: false,
    scrollbars: false,
    closable: false,
    modalOverlayClose: false
   });
  };






























// Build windows onLoad

  MUI.Terminos();
  MUI.myChain.callChain();
 };
 /*
  INITIALIZE COLUMNS AND PANELS
  Creating a Column and Panel Layout:
  - If you are not using panels then these columns are not required.
  - If you do use panels,the main column is required. The side columns are optional.
  Columns
  - Create your columns from left to right.
  - One column should not have it's width set. This column will have a fluid width.
  Panels
  - After creating Columns,create your panels from top to bottom,left to right.
  - One panel in each column should not have it's height set. This panel will have a fluid height.
  - New Panels are inserted at the bottom of their column.
  -------------------------------------------------------------------- */
 initializeColumns = function() {
  new MUI.Column({id: 'sideColumn1', placement: 'left', width: 200, resizeLimit: [200, 200]});
  new MUI.Column({id: 'mainColumn', placement: 'main', resizeLimit: [800, 2000]});
  new MUI.Column({id: 'sideColumn2', placement: 'right', width: 200, resizeLimit: [200, 200]});
  // Agregando Paneles A La Columna
  new MUI.Panel({
   id: 'componentes', title: 'Modulos',
   contentURL: MUI.path.pqrs + 'externo/componentes.xhr.php', column: 'sideColumn1',
   headerToolbox: true,
   headerToolboxURL: MUI.path.pqrs + 'externo/componentes.toolbox.xhr.html',
   padding: {top: 0, bottom: 0, left: 0, right: 0},
   require: {
    css: [MUI.path.estilos + 'componentes.css'],
    js: [MUI.path.plugins + 'tree/scripts/tree.js'],
    onload: function() {
    }
   }, onContentLoaded: function() {
   }
  });
// Add panels to main column
  new MUI.Panel({
   id: 'central',
   title: 'i:MIS',
   padding: {top: 0, bottom: 0, left: 0, right: 0},
   contentURL: 'modulos/solicitudes/externo/inicio.xhr.php',
   column: 'mainColumn',
   footer: true
       //headerToolbox: true,
       // headerToolboxURL: 'pages/toolbox-demo2.html'
  });
// Agrega los paneles a la segunda columna
  new MUI.Panel({
   id: 'complementos', title: 'FAQs',
   contentURL: MUI.path.pqrs + 'externo/complementos.xhr.php', column: 'sideColumn2',
   padding: {top: 0, bottom: 0, left: 0, right: 0},
   require: {css: [MUI.path.estilos + 'externo.css']}
  });

  MUI.splitPanelPanel = function() {
   if ($('central')) {
    new MUI.Column({container: 'central', id: 'sideColumn3', placement: 'left', width: 200, resizeLimit: [100, 300]});
    new MUI.Column({container: 'central', id: 'mainColumn2', placement: 'main', width: null, resizeLimit: [100, 300]});
    new MUI.Panel({header: false, id: 'splitPanel_central', contentURL: 'license.html', column: 'mainColumn2'});
    new MUI.Panel({header: false, id: 'splitPanel_sidePanel', addClass: 'panelAlt', contentURL: 'pages/lipsum.html', column: 'sideColumn3'});
   }
  };
  MUI.myChain.callChain();
 };
// Initialize MochaUI when the DOM is ready
 window.addEvent('load', function() { //using load instead of domready for IE8
  MUI.myChain =new Chain();
  MUI.myChain.chain(
      function() {
       MUI.Desktop.initialize();
      }, function() {
   MUI.Dock.initialize();
  }, function() {
   initializeColumns();
  },
      function() {
       initializeWindows();
      }
  ).callChain();
 });
<?php  if (isset($debug)) { ?></script><?php 
}?>