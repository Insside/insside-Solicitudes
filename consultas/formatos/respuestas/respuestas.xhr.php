<?php
/*
 * Copyright (c) 2013, Alexis
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
?>
<?php
$transaccion = @$_REQUEST["transaccion"];
$opcion = @$_REQUEST["opcion"];
$buscar = @$_REQUEST['buscar'];
?>
<script type="text/javascript">

  function filterGrid() {
    tabla.filter($('filter').value);
  }
  function clearFilter() {
    tabla.clearFilter();
  }
  function onGridSelect(evt) {
    //var str = 'row: ' + evt.row + ' indices: ' + evt.indices;
    //str += ' id: ' + evt.target.getDataByRow(evt.row).proveedor;
    //$(codigo<?php echo($transaccion ); ?>) = evt.target.getDataByRow(evt.row).proveedor;
  }
  function buscarClick(button, grid) {
    parent.MUI.Suscriptores_Buscar('');
  }
  function imprimirClick(button, grid) {
    MUI.Distribucion_Instalaciones_Imprimir();
  }


  function Editar_Click<?php echo($transaccion ); ?>(button, grid) {
    var indices = tabla.getSelectedIndices();
    if (indices.length == 0) {
      //MUI.Proveedores_Advertencia_Seleccion();
      return;
    }
    var str = '';
    for (var i = 0; i < indices.length; i++) {
      str += 'row: ' + indices[i] + ' data: ' + tabla.getDataByRow(indices[i]).proveedor + '\n';
      var formato = tabla.getDataByRow(indices[i]).formato;
      MUI.Solicitudes_Formatos_Respuesta_Editar(formato);
    }
  }












  function Eliminar_Click<?php echo($transaccion ); ?>(button, grid) {
    var indices = tabla.getSelectedIndices();
    if (indices.length == 0) {
      //MUI.Proveedores_Advertencia_Seleccion();
      return;
    }
    var str = '';
    for (var i = 0; i < indices.length; i++) {
      str += 'row: ' + indices[i] + ' data: ' + tabla.getDataByRow(indices[i]).proveedor + '\n';
      var formato = tabla.getDataByRow(indices[i]).formato;
      MUI.Solicitudes_Formatos_Respuesta_Eliminar(formato);
    }
  }

  function Responsabilidades_Click<?php echo($transaccion ); ?>(button, grid) {
    var indices = tabla.getSelectedIndices();
    if (indices.length == 0) {
      //MUI.Proveedores_Advertencia_Seleccion();
      return;
    }
    var str = '';
    for (var i = 0; i < indices.length; i++) {
      str += 'row: ' + indices[i] + ' data: ' + tabla.getDataByRow(indices[i]).proveedor + '\n';
      var creador = tabla.getDataByRow(indices[i]).creador;
      MUI.Usuarios_Creador(creador);
    }
  }

  var cmu = [
    {header: "Formato", dataIndex: 'formato', dataType: 'string', width: 50, align: 'center', hidden: false},
    {header: "Nombre", dataIndex: 'nombre', dataType: 'string', width: 500, align: 'left', hidden: false},
    {header: "Fecha", dataIndex: 'fecha', dataType: 'date', align: 'center', width: 75},
    {header: "Hora", dataIndex: 'hora', dataType: 'time', align: 'center', width: 75}
  ];
  window.addEvent("domready", function() {
    tabla = new iTable('itable', {
      columnModel: cmu,
      buttons: [
        {name: 'Agregar', bclass: 'pNuevo', onclick: MUI.Solicitudes_Formatos_Respuesta_Crear},
        {name: 'Editar', bclass: 'pEditar', onclick: Editar_Click<?php echo($transaccion ); ?>},
        {name: 'Eliminar', bclass: 'pEliminar', onclick: Eliminar_Click<?php echo($transaccion ); ?>},
        //{name: 'Buscar', bclass: 'pBuscar', onclick: MUI.Comercial_Complementos_Busqueda},
        //{name: 'Filtrar', bclass: 'pFiltrar', onclick: MUI.Comercial_Complementos_Filtrar},
        {name: 'Información', bclass: 'pInformacion', onclick: Responsabilidades_Click<?php echo($transaccion ); ?>}
      ],
      url: "modulos/solicitudes/consultas/formatos/respuestas/respuestas.json.php?opcion=<?php echo($opcion); ?>&buscar=<?php echo($buscar); ?>",
      perPageOptions: [40, 80, 160, 320, 640],
      perPage: 40,
      page: 1,
      pagination: true,
      serverSort: true,
      showHeader: true,
      alternaterows: true,
      sortHeader: true,
      resizeColumns: false,
      multipleSelection: true,
      width: $('central').getSize().x,
      height: $('central').getSize().y
    });

    tabla.addEvent('click', onGridSelect);
  });
</script>
<?php echo("<div id=\"itable\" style=\"width:100%\" ></div>"); ?>
