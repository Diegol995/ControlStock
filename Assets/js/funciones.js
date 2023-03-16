let tblUsuarios, tblClientes, tblMedidas, tblCategorias, tblCajas, tblProductos, t_h_c, t_h_v,
t_arqueo;
//Si el contenido del DOM se cargó, se ejecuta la función
document.addEventListener('DOMContentLoaded', function(){
    $('#cliente').select2();
    //Se accede al tblUsuarios de la vista Usuarios/index.php
    tblUsuarios = $('#tblUsuarios').DataTable( {
        ajax: {
            //Se pasa la url de el método listar
            url: base_url + "Usuarios/listar",
            dataSrc: ''
        },
        columns: [
            {
                'data' : 'usuario'
            },
            {
                'data' : 'nombre'
            },
            {
                'data' : 'caja'
            },
            {
                'data' : 'estado'
            },
            {
                'data' : 'acciones'
            }
        ],
        //Se pasa el datatable a español y se agregan botones
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
            //Botón para Excel
            extend: 'excelHtml5',
            footer: true,
            title: 'Archivo',
            filename: 'Export_File',

            //Aquí es donde generas el botón personalizado
            text: '<span class="badge bg-success" title="Exportar Excel"><i class="fas fa-file-excel"></i></span>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            download: 'open',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  bg-danger" title="Exportar PDF"><i class="fas fa-file-pdf"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para copiar
        {
            extend: 'copyHtml5',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  bg-primary" title="Copiar"><i class="fas fa-copy"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Export_File_print',
            text: '<span class="badge bg-light" title="Imprimir"><i class="fas fa-print text-dark"></i></span>'
        },
        //Botón para cvs
        {
            extend: 'csvHtml5',
            footer: true,
            filename: 'Export_File_csv',
            text: '<span class="badge  bg-success" title="Exportar CSV"><i class="fas fa-file-csv"></i></span>'
        },
        {
            extend: 'colvis',
            text: '<span class="badge  bg-info" title="Visibilidad"><i class="fas fa-columns"></i></span>',
            postfixButtons: ['colvisRestore']
        }
        ]
    } );

    //FIN DE LA TABLA USUARIOS

    tblClientes = $('#tblClientes').DataTable( {
        ajax: {
            url: base_url + "Clientes/listar",
            dataSrc: ''
        },
        columns: [
            {
                'data' : 'nombre'
            },
            {
                'data' : 'cuit_cuil'
            },
            {
                'data' : 'telefono'
            },
            {
                'data' : 'direccion'
            },
            {
                'data' : 'estado'
            },
            {
                'data' : 'acciones'
            }
        ],
        //Se pasa el datatable a español y se agregan botones
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
            //Botón para Excel
            extend: 'excelHtml5',
            footer: true,
            title: 'Archivo',
            filename: 'Export_File',

            //Aquí es donde generas el botón personalizado
            text: '<span class="badge bg-success" title="Exportar Excel"><i class="fas fa-file-excel"></i></span>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            download: 'open',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  bg-danger" title="Exportar PDF"><i class="fas fa-file-pdf"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para copiar
        {
            extend: 'copyHtml5',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  bg-primary" title="Copiar"><i class="fas fa-copy"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Export_File_print',
            text: '<span class="badge bg-light" title="Imprimir"><i class="fas fa-print text-dark"></i></span>'
        },
        //Botón para cvs
        {
            extend: 'csvHtml5',
            footer: true,
            filename: 'Export_File_csv',
            text: '<span class="badge  bg-success" title="Exportar CSV"><i class="fas fa-file-csv"></i></span>'
        },
        {
            extend: 'colvis',
            text: '<span class="badge  bg-info" title="Visibilidad"><i class="fas fa-columns"></i></span>',
            postfixButtons: ['colvisRestore']
        }
        ]
    } );

    //FIN DE LA TABLA CLIENTES

    tblMedidas = $('#tblMedidas').DataTable( {
        ajax: {
            url: base_url + "Medidas/listar",
            dataSrc: ''
        },
        columns: [
            {
                'data' : 'id'
            },
            {
                'data' : 'nombre'
            },
            {
                'data' : 'nombre_corto'
            },
            {
                'data' : 'estado'
            },
            {
                'data' : 'acciones'
            }
        ],
        //Se pasa el datatable a español y se agregan botones
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
            //Botón para Excel
            extend: 'excelHtml5',
            footer: true,
            title: 'Archivo',
            filename: 'Export_File',

            //Aquí es donde generas el botón personalizado
            text: '<span class="badge bg-success" title="Exportar Excel"><i class="fas fa-file-excel"></i></span>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            download: 'open',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  bg-danger" title="Exportar PDF"><i class="fas fa-file-pdf"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para copiar
        {
            extend: 'copyHtml5',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  bg-primary" title="Copiar"><i class="fas fa-copy"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Export_File_print',
            text: '<span class="badge bg-light" title="Imprimir"><i class="fas fa-print text-dark"></i></span>'
        },
        //Botón para cvs
        {
            extend: 'csvHtml5',
            footer: true,
            filename: 'Export_File_csv',
            text: '<span class="badge  bg-success" title="Exportar CSV"><i class="fas fa-file-csv"></i></span>'
        },
        {
            extend: 'colvis',
            text: '<span class="badge  bg-info" title="Visibilidad"><i class="fas fa-columns"></i></span>',
            postfixButtons: ['colvisRestore']
        }
        ]
    } );

    //FIN DE LA TABLA MEDIDAS

    tblCategorias = $('#tblCategorias').DataTable( {
        ajax: {
            url: base_url + "Categorias/listar",
            dataSrc: ''
        },
        columns: [
            {
                'data' : 'id'
            },
            {
                'data' : 'nombre'
            },
            {
                'data' : 'estado'
            },
            {
                'data' : 'acciones'
            }
        ],
        //Se pasa el datatable a español y se agregan botones
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
            //Botón para Excel
            extend: 'excelHtml5',
            footer: true,
            title: 'Archivo',
            filename: 'Export_File',

            //Aquí es donde generas el botón personalizado
            text: '<span class="badge bg-success" title="Exportar Excel"><i class="fas fa-file-excel"></i></span>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            download: 'open',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  bg-danger" title="Exportar PDF"><i class="fas fa-file-pdf"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para copiar
        {
            extend: 'copyHtml5',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  bg-primary" title="Copiar"><i class="fas fa-copy"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Export_File_print',
            text: '<span class="badge bg-light" title="Imprimir"><i class="fas fa-print text-dark"></i></span>'
        },
        //Botón para cvs
        {
            extend: 'csvHtml5',
            footer: true,
            filename: 'Export_File_csv',
            text: '<span class="badge  bg-success" title="Exportar CSV"><i class="fas fa-file-csv"></i></span>'
        },
        {
            extend: 'colvis',
            text: '<span class="badge  bg-info" title="Visibilidad"><i class="fas fa-columns"></i></span>',
            postfixButtons: ['colvisRestore']
        }
        ]
    } );

    //FIN DE LA TABLA CATEGORÍAS

    tblCajas = $('#tblCajas').DataTable( {
        ajax: {
            url: base_url + "Cajas/listar",
            dataSrc: ''
        },
        columns: [
            {
                'data' : 'id'
            },
            {
                'data' : 'caja'
            },
            {
                'data' : 'estado'
            },
            {
                'data' : 'acciones'
            }
        ],
        //Se pasa el datatable a español y se agregan botones
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
            //Botón para Excel
            extend: 'excelHtml5',
            footer: true,
            title: 'Archivo',
            filename: 'Export_File',

            //Aquí es donde generas el botón personalizado
            text: '<span class="badge bg-success" title="Exportar Excel"><i class="fas fa-file-excel"></i></span>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            download: 'open',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  bg-danger" title="Exportar PDF"><i class="fas fa-file-pdf"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para copiar
        {
            extend: 'copyHtml5',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  bg-primary" title="Copiar"><i class="fas fa-copy"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Export_File_print',
            text: '<span class="badge bg-light" title="Imprimir"><i class="fas fa-print text-dark"></i></span>'
        },
        //Botón para cvs
        {
            extend: 'csvHtml5',
            footer: true,
            filename: 'Export_File_csv',
            text: '<span class="badge  bg-success" title="Exportar CSV"><i class="fas fa-file-csv"></i></span>'
        },
        {
            extend: 'colvis',
            text: '<span class="badge  bg-info" title="Visibilidad"><i class="fas fa-columns"></i></span>',
            postfixButtons: ['colvisRestore']
        }
        ]
    } );

    //FIN DE LA TABLA CAJAS

    tblProductos = $('#tblProductos').DataTable( {
        ajax: {
            url: base_url + "Productos/listar",
            dataSrc: ''
        },
        columns: [
            {
                'data' : 'id'
            },
            {
                'data' : 'imagen'
            },
            {
                'data' : 'codigo'
            },
            {
                'data' : 'descripcion'
            },
            {
                'data' : 'precio_venta'
            },
            {
                'data' : 'cantidad'
            },
            {
                'data' : 'estado'
            },
            {
                'data' : 'acciones'
            }
        ],
        //Se pasa el datatable a español y se agregan botones
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
            //Botón para Excel
            extend: 'excelHtml5',
            footer: true,
            title: 'Archivo',
            filename: 'Export_File',

            //Aquí es donde generas el botón personalizado
            text: '<span class="badge bg-success" title="Exportar Excel"><i class="fas fa-file-excel"></i></span>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            download: 'open',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  bg-danger" title="Exportar PDF"><i class="fas fa-file-pdf"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para copiar
        {
            extend: 'copyHtml5',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  bg-primary" title="Copiar"><i class="fas fa-copy"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Export_File_print',
            text: '<span class="badge bg-light" title="Imprimir"><i class="fas fa-print text-dark"></i></span>'
        },
        //Botón para cvs
        {
            extend: 'csvHtml5',
            footer: true,
            filename: 'Export_File_csv',
            text: '<span class="badge  bg-success" title="Exportar CSV"><i class="fas fa-file-csv"></i></span>'
        },
        {
            extend: 'colvis',
            text: '<span class="badge  bg-info" title="Visibilidad"><i class="fas fa-columns"></i></span>',
            postfixButtons: ['colvisRestore']
        }
        ]
    } );

    //FIN DE LA TABLA PRODUCTOS

    t_h_c = $('#t_historial_c').DataTable( {
        ajax: {
            url: base_url + "Compras/listar_historial",
            dataSrc: ''
        },
        columns: [
            {
                'data' : 'id'
            },
            {
                'data' : 'nombre'
            },
            {
                'data' : 'total'
            },
            {
                'data' : 'fecha'
            },
            {
                'data' : 'estado'
            },
            {
                'data' : 'acciones'
            }
        ],
        //Se pasa el datatable a español y se agregan botones
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
            //Botón para Excel
            extend: 'excelHtml5',
            footer: true,
            title: 'Archivo',
            filename: 'Export_File',

            //Aquí es donde generas el botón personalizado
            text: '<span class="badge bg-success" title="Exportar Excel"><i class="fas fa-file-excel"></i></span>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            download: 'open',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  bg-danger" title="Exportar PDF"><i class="fas fa-file-pdf"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para copiar
        {
            extend: 'copyHtml5',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  bg-primary" title="Copiar"><i class="fas fa-copy"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Export_File_print',
            text: '<span class="badge bg-light" title="Imprimir"><i class="fas fa-print text-dark"></i></span>'
        },
        //Botón para cvs
        {
            extend: 'csvHtml5',
            footer: true,
            filename: 'Export_File_csv',
            text: '<span class="badge  bg-success" title="Exportar CSV"><i class="fas fa-file-csv"></i></span>'
        },
        {
            extend: 'colvis',
            text: '<span class="badge  bg-info" title="Visibilidad"><i class="fas fa-columns"></i></span>',
            postfixButtons: ['colvisRestore']
        }
        ]
    } );

    //FIN DE LA TABLA HISTORIAL COMPRAS

    t_h_v = $('#t_historial_v').DataTable( {
        ajax: {
            url: base_url + "Compras/listar_historialVentas",
            dataSrc: ''
        },
        columns: [
            {
                'data' : 'id'
            },
            {
                'data' : 'userName'
            },
            {
                'data' : 'clientName'
            },
            {
                'data' : 'total'
            },
            {
                'data' : 'fecha'
            },
            {
                'data' : 'estado'
            },
            {
                'data' : 'acciones'
            }
        ],
        //Se pasa el datatable a español y se agregan botones
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
            //Botón para Excel
            extend: 'excelHtml5',
            footer: true,
            title: 'Archivo',
            filename: 'Export_File',

            //Aquí es donde generas el botón personalizado
            text: '<span class="badge bg-success" title="Exportar Excel"><i class="fas fa-file-excel"></i></span>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            download: 'open',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  bg-danger" title="Exportar PDF"><i class="fas fa-file-pdf"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para copiar
        {
            extend: 'copyHtml5',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  bg-primary" title="Copiar"><i class="fas fa-copy"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Export_File_print',
            text: '<span class="badge bg-light" title="Imprimir"><i class="fas fa-print text-dark"></i></span>'
        },
        //Botón para cvs
        {
            extend: 'csvHtml5',
            footer: true,
            filename: 'Export_File_csv',
            text: '<span class="badge  bg-success" title="Exportar CSV"><i class="fas fa-file-csv"></i></span>'
        },
        {
            extend: 'colvis',
            text: '<span class="badge  bg-info" title="Visibilidad"><i class="fas fa-columns"></i></span>',
            postfixButtons: ['colvisRestore']
        }
        ]
    } );

    //FIN DE LA TABLA HISTORIAL VENTAS

    t_arqueo = $('#t_arqueo').DataTable( {
        ajax: {
            url: base_url + "Cajas/listar_arqueo",
            dataSrc: ''
        },
        columns: [
            {
                'data' : 'id'
            },
            {
                'data' : 'monto_inicial'
            },
            {
                'data' : 'monto_final'
            },
            {
                'data' : 'fecha_apertura'
            },
            {
                'data' : 'fecha_cierre'
            },
            {
                'data' : 'total_ventas'
            },
            {
                'data' : 'monto_total'
            },
            {
                'data' : 'estado'
            }
        ],
        //Se pasa el datatable a español y se agregan botones
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
            //Botón para Excel
            extend: 'excelHtml5',
            footer: true,
            title: 'Archivo',
            filename: 'Export_File',

            //Aquí es donde generas el botón personalizado
            text: '<span class="badge bg-success" title="Exportar Excel"><i class="fas fa-file-excel"></i></span>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            download: 'open',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  bg-danger" title="Exportar PDF"><i class="fas fa-file-pdf"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para copiar
        {
            extend: 'copyHtml5',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  bg-primary" title="Copiar"><i class="fas fa-copy"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Export_File_print',
            text: '<span class="badge bg-light" title="Imprimir"><i class="fas fa-print text-dark"></i></span>'
        },
        //Botón para cvs
        {
            extend: 'csvHtml5',
            footer: true,
            filename: 'Export_File_csv',
            text: '<span class="badge  bg-success" title="Exportar CSV"><i class="fas fa-file-csv"></i></span>'
        },
        {
            extend: 'colvis',
            text: '<span class="badge  bg-info" title="Visibilidad"><i class="fas fa-columns"></i></span>',
            postfixButtons: ['colvisRestore']
        }
        ]
    } );

    //FIN DE LA TABLA ARQUEO DE CAJAS
})

function frmCambiarPass(e){
    e.preventDefault();
    const actual = document.getElementById('clave_actual').value;
    const nueva = document.getElementById('clave_nueva').value;
    const confirm = document.getElementById('confirmar_clave').value;
    if (actual == '' || nueva == '' || confirm == ''){
        alertas('¡Todos los campos son obligatorios!', 'warning');
    }else{
        const url = base_url + "Usuarios/cambiarPass";
        const frm = document.getElementById("frmCambiarPass");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                const res = JSON.parse(this.responseText);
                if (res.icono != 'success'){
                    alertas(res.msg, res.icono);
                }
                else{
                    alertas(res.msg, res.icono);
                    $('#cambiarPass').modal('hide');
                    frm.reset();
                }
            }
        }
    }
}

function frmUsuario(){
    //Se resetea el formulario para que no queden los campos con datos de la última edición
    document.getElementById("frmUsuario").reset();
    document.getElementById("title").innerHTML = "Nuevo Usuario";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("claves").classList.remove("d-none");
    //Se accede al Modal de registro de usuario y se hace visible con "show"
    $("#nuevo_usuario").modal("show");
    //Se limpia el input 'id' para no tener conflictos con registrar después de editar
    document.getElementById("id").value = "";
}

function registrarUser(e){
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const nombre = document.getElementById("nombre");
    const clave = document.getElementById("clave");
    const confirmar = document.getElementById("confirmar");
    const caja = document.getElementById("caja");
    if (usuario.value == "" || nombre.value == "" || caja.value == "")
    {
        //Se utiliza el sweetalert2 para mostrar un mensaje de alerta
        alertas("¡Todos los campos son obligatorios!", 'warning');
    }else
    {
        //Si los datos ingresados pasan las validaciones, se envian al método registrar
        const url = base_url + "Usuarios/registrar";
        const frm = document.getElementById("frmUsuario");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                const res = JSON.parse(this.responseText);
                if (res.icono != 'success'){
                    alertas(res.msg, res.icono);
                }
                else{
                    alertas(res.msg, res.icono);
                    //Se resetea el formulario para limpiar sus campos
                    frm.reset();
                    //Se oculta
                    $('#nuevo_usuario').modal('hide');
                    //Se recarga el datatable para mostrar los datos ingresados/modificados
                    //sin recargar la página
                    tblUsuarios.ajax.reload();
                }
            }
        }
    }
}

function btnEditarUser(id){
    //Con innerHTML se puede cambiar el valor de la etiqueta html
    document.getElementById("title").innerHTML = "Actualizar Usuario";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    //Se llama al método editar y se le pasa como parámetro el id para que haga la consulta
    //con el mismo
    const url = base_url + "Usuarios/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            //Se reciben los datos encontrados desde el método y se parsea como objeto
            const res = JSON.parse(this.responseText);
            //Se rellenan los campos del formulario editar con los datos encontrados
            document.getElementById("id").value = res.id;
            document.getElementById("usuario").value = res.usuario;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("caja").value = res.id_caja;
            //Se ocultan los inputs de las contraseñas
            document.getElementById("claves").classList.add("d-none");
            $("#nuevo_usuario").modal("show");
        }
    }
}

function btnEliminarUser(id){
    Swal.fire({
        title: '¿Seguro que desea eliminar este usuario?',
        text: "¡El usuario no se eliminará de forma permanente, solo cambiará su estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, eliminar!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/eliminar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblUsuarios.ajax.reload();
                }
            }
        }
    })
}

function btnRestaurarUser(id){
    Swal.fire({
        title: '¿Seguro que desea restaurar este usuario?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, restaurar!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/restaurar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblUsuarios.ajax.reload();
                }
            }
        }
    })
}

function btnCerrar(){
    $('#nuevo_usuario').modal('hide');
    $('#nuevo_cliente').modal('hide');
    $('#nueva_medida').modal('hide');
    $('#nueva_categoria').modal('hide');
    $('#nueva_caja').modal('hide');
    $('#nuevo_producto').modal('hide');
    $('#abrir_caja').modal('hide');
}

//FIN USUARIOS

function frmCliente(){
    document.getElementById("frmCliente").reset();
    document.getElementById("title").innerHTML = "Nuevo Cliente";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    $("#nuevo_cliente").modal("show");
    document.getElementById("id").value = "";
}

function registrarCli(e){
    e.preventDefault();
    const cuit_cuil = document.getElementById("cuit_cuil");
    const nombre = document.getElementById("nombre");
    const telefono = document.getElementById("telefono");
    const direccion = document.getElementById("direccion");
    if (cuit_cuil.value == "" || nombre.value == "" || telefono.value == "" || direccion.value == "")
    {
        alertas('¡Todos los campos son obligatorios!', 'warning');
    }else
    {
        const url = base_url + "Clientes/registrar";
        const frm = document.getElementById("frmCliente");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                const res = JSON.parse(this.responseText);
                if (res.icono != 'success'){
                    alertas(res.msg, res.icono);
                }
                else{
                    alertas(res.msg, res.icono);
                    frm.reset();
                    $('#nuevo_cliente').modal('hide');
                    tblClientes.ajax.reload();
                }
            }
        }
    }
}

function btnEditarCli(id){
    document.getElementById("title").innerHTML = "Actualizar Cliente";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    const url = base_url + "Clientes/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("cuit_cuil").value = res.cuit_cuil;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("telefono").value = res.telefono;
            document.getElementById("direccion").value = res.direccion;
            $("#nuevo_cliente").modal("show");
        }
    }
}

function btnEliminarCli(id){
    Swal.fire({
        title: '¿Seguro que desea eliminar este cliente?',
        text: "¡El cliente no se eliminará de forma permanente, solo cambiará su estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, eliminar!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Clientes/eliminar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblClientes.ajax.reload();
                }
            }
        }
    })
}

function btnRestaurarCli(id){
    Swal.fire({
        title: '¿Seguro que desea restaurar este cliente?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, restaurar!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Clientes/restaurar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblClientes.ajax.reload();
                }
            }
        }
    })
}

//FIN CLIENTES

function frmMedidas(){
    document.getElementById("frmMedida").reset();
    document.getElementById("title").innerHTML = "Nueva Medida";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    $("#nueva_medida").modal("show");
    document.getElementById("id").value = "";
}

function registrarMed(e){
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    const nombre_corto = document.getElementById("nombre_corto");
    if (nombre.value == "" || nombre_corto.value == "")
    {
        alertas('¡Todos los campos son obligatorios!', 'warning');
    }else
    {
        const url = base_url + "Medidas/registrar";
        const frm = document.getElementById("frmMedida");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                const res = JSON.parse(this.responseText);
                if (res.icono != 'success'){
                    alertas(res.msg, res.icono);
                }
                else{
                    alertas(res.msg, res.icono);
                    frm.reset();
                    $('#nueva_medida').modal('hide');
                    tblMedidas.ajax.reload();
                }
            }
        }
    }
}

function btnEditarMed(id){
    document.getElementById("title").innerHTML = "Actualizar Medida";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    const url = base_url + "Medidas/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("nombre_corto").value = res.nombre_corto;
            $("#nueva_medida").modal("show");
        }
    }
}

function btnEliminarMed(id){
    Swal.fire({
        title: '¿Seguro que desea eliminar esta medida?',
        text: "La medida no se eliminará de forma permanente, solo cambiará su estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, eliminar!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Medidas/eliminar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblMedidas.ajax.reload();
                }
            }
        }
    })
}

function btnRestaurarMed(id){
    Swal.fire({
        title: '¿Seguro que desea restaurar esta medida?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, restaurar!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Medidas/restaurar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblMedidas.ajax.reload();
                }
            }
        }
    })
}

//FIN MEDIDAS

function frmCategorias(){
    document.getElementById("frmCategoria").reset();
    document.getElementById("title").innerHTML = "Nueva Categoría";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    $("#nueva_categoria").modal("show");
    document.getElementById("id").value = "";
}

function registrarCat(e){
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    if (nombre.value == "")
    {
        alertas('¡El campo es obligatorio!', 'warning');
    }else
    {
        const url = base_url + "Categorias/registrar";
        const frm = document.getElementById("frmCategoria");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                const res = JSON.parse(this.responseText);
                if (res.icono != 'success'){
                    alertas(res.msg, res.icono);
                }
                else{
                    alertas(res.msg, res.icono);
                    frm.reset();
                    $('#nueva_categoria').modal('hide');
                    tblCategorias.ajax.reload();
                }
            }
        }
    }
}

function btnEditarCat(id){
    document.getElementById("title").innerHTML = "Actualizar Categoría";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    const url = base_url + "Categorias/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("nombre").value = res.nombre;
            $("#nueva_categoria").modal("show");
        }
    }
}

function btnEliminarCat(id){
    Swal.fire({
        title: '¿Seguro que desea eliminar esta categoría?',
        text: "La categoría no se eliminará de forma permanente, solo cambiará su estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, eliminar!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Categorias/eliminar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblCategorias.ajax.reload();
                }
            }
        }
    })
}

function btnRestaurarCat(id){
    Swal.fire({
        title: '¿Seguro que desea restaurar esta categoría?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, restaurar!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Categorias/restaurar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblCategorias.ajax.reload();
                }
            }
        }
    })
}

//FIN CATEGORÍAS

function frmCajas(){
    document.getElementById("frmCaja").reset();
    document.getElementById("title").innerHTML = "Nueva Caja";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    $("#nueva_caja").modal("show");
    document.getElementById("id").value = "";
}

function registrarCaja(e){
    e.preventDefault();
    const caja = document.getElementById("caja");
    if (caja.value == "")
    {
        alertas('¡El campo es obligatorio!', 'warning');
    }else
    {
        const url = base_url + "Cajas/registrar";
        const frm = document.getElementById("frmCaja");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                const res = JSON.parse(this.responseText);
                if (res.icono != 'success'){
                    alertas(res.msg, res.icono);
                }
                else{
                    alertas(res.msg, res.icono);
                    frm.reset();
                    $('#nueva_caja').modal('hide');
                    tblCajas.ajax.reload();
                }
            }
        }
    }
}

function btnEditarCaja(id){
    document.getElementById("title").innerHTML = "Actualizar Caja";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    const url = base_url + "Cajas/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("caja").value = res.caja;
            $("#nueva_caja").modal("show");
        }
    }
}

function btnEliminarCaja(id){
    Swal.fire({
        title: '¿Seguro que desea eliminar esta caja?',
        text: "La caja no se eliminará de forma permanente, solo cambiará su estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, eliminar!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Cajas/eliminar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblCajas.ajax.reload();
                }
            }
        }
    })
}

function btnRestaurarCaja(id){
    Swal.fire({
        title: '¿Seguro que desea restaurar esta caja?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, restaurar!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Cajas/restaurar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblCajas.ajax.reload();
                }
            }
        }
    })
}

//FIN CAJAS

function frmProducto(){
    document.getElementById("frmProducto").reset();
    document.getElementById("title").innerHTML = "Nuevo Producto";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    $("#nuevo_producto").modal("show");
    document.getElementById("id").value = "";
    deleteImg();
}

function registrarProd(e){
    e.preventDefault();
    const codigo = document.getElementById("codigo");
    const nombre = document.getElementById("nombre");
    const precio_compra = document.getElementById("precio_compra");
    const precio_venta = document.getElementById("precio_venta");
    if (codigo.value == "" || nombre.value == "" || precio_compra.value == "" || precio_venta.value == "")
    {
        alertas('¡Todos los campos son obliatorios!', 'warning');
    }else
    {
        const url = base_url + "Productos/registrar";
        const frm = document.getElementById("frmProducto");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                const res = JSON.parse(this.responseText);
                if (res.icono != 'success'){
                    alertas(res.msg, res.icono);
                }
                else{
                    alertas(res.msg, res.icono);
                    frm.reset();
                    $('#nuevo_producto').modal('hide');
                    tblProductos.ajax.reload();
                }
            }
        }
    }
}

function btnEditarProd(id){
    document.getElementById("title").innerHTML = "Actualizar Producto";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    const url = base_url + "Productos/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("codigo").value = res.codigo;
            document.getElementById("nombre").value = res.descripcion;
            document.getElementById("precio_compra").value = res.precio_compra;
            document.getElementById("precio_venta").value = res.precio_venta;
            document.getElementById("medida").value = res.id_medida;
            document.getElementById("categoria").value = res.id_categoria;
            document.getElementById("img-preview").src = base_url + "Assets/img/" + res.imagen;
            document.getElementById("img-icon").classList.add("d-none");
            document.getElementById("icon-cerrar").innerHTML = `<button class="btn btn-danger" onclick="deleteImg();"><i class="fas fa-times"></i></button>`;
            document.getElementById("img_actual").value = res.imagen;
            $("#nuevo_producto").modal("show");
        }
    }
}

function btnEliminarProd(id){
    Swal.fire({
        title: '¿Seguro que desea eliminar este producto?',
        text: "¡El producto no se eliminará de forma permanente, solo cambiará su estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, eliminar!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Productos/eliminar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblProductos.ajax.reload();
                }
            }
        }
    })
}

function btnRestaurarProd(id){
    Swal.fire({
        title: '¿Seguro que desea restaurar este producto?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, restaurar!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Productos/restaurar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblProductos.ajax.reload();
                }
            }
        }
    })
}

function preview(e){
    //target.files muestra los datos del archivo cargado como objeto
    const url = e.target.files[0];
    //crea un DOMString del archivo para mostrar la imagen
    const urlTmp = URL.createObjectURL(url);
    //se muestra la imagen
    console.log(urlTmp);
    document.getElementById("img-preview").src = urlTmp;
    document.getElementById("img-icon").classList.add("d-none");
    //Se agrega un botón para quitar el archivo cargado llamando a la función deleteImg()
    document.getElementById("icon-cerrar").innerHTML = `<button class="btn btn-danger" onclick="deleteImg();"><i class="fas fa-times"></i></button>
    ${url['name']}`;
}

function deleteImg(){
    document.getElementById("icon-cerrar").innerHTML = '';
    document.getElementById("img-icon").classList.remove("d-none");
    document.getElementById("img-preview").src = '';
    document.getElementById("imagen").value = '';
    document.getElementById("img_actual").value = '';
}

//FIN PRODUCTOS

function buscarCodigo(e){
    e.preventDefault();
    const cod = document.getElementById("codigo").value;
    if (cod != ""){
        //El valor 13 hace referencia a que se presionó la tecla enter
        if (e.which == 13){
            const url = base_url + "Compras/buscarCodigo/"+cod;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                const res = JSON.parse(this.responseText);
                if (res){
                    document.getElementById('nombre').value = res.descripcion;
                    document.getElementById('precio').value = res.precio_compra;
                    document.getElementById('id').value = res.id;
                    document.getElementById('cantidad').removeAttribute('disabled');
                    document.getElementById('cantidad').focus();
                }else{
                    alertas('¡No se encuentra el producto con ese código!', 'error');
                    document.getElementById('codigo').value = '';
                    document.getElementById('codigo').focus();
                }
            }
        }
        } 
    }else{
        alertas('¡Ingrese el código de barras del producto!', 'warning');
    }
}

//Se reutiliza el mismo codigo de buscarCodigo() cambiando solo la variable res.precio_venta
function buscarCodigoVenta(e){
    e.preventDefault();
    const cod = document.getElementById("codigo").value;
    if (cod != ""){
        //El valor 13 hace referencia a que se presionó la tecla enter
        if (e.which == 13){
            const url = base_url + "Compras/buscarCodigo/"+cod;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                const res = JSON.parse(this.responseText);
                if (res){
                    document.getElementById('nombre').value = res.descripcion;
                    document.getElementById('precio').value = res.precio_venta;
                    document.getElementById('id').value = res.id;
                    document.getElementById('cantidad').removeAttribute('disabled');
                    document.getElementById('cantidad').focus();
                }else{
                    alertas('¡No se encuentra el producto con ese código!', 'error');
                    document.getElementById('codigo').value = '';
                    document.getElementById('codigo').focus();
                }
            }
        }
        } 
    }else{
        alertas('¡Ingrese el código de barras del producto!', 'warning');
    }
}

function calcularPrecio(e){
    e.preventDefault();
    const cant = document.getElementById('cantidad').value;
    const precio = document.getElementById('precio').value;
    document.getElementById('sub_total').value = cant * precio;

    if (e.which == 13){
        if(cant > 0){
            const url = base_url + "Compras/ingresar";
            const frm = document.getElementById('frmCompra');
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    if (res.icono != "success"){
                        alertas(res.msg, res.icono);
                    }else{
                        frm.reset();
                        cargarDetalle();
                    }
                }
            }
            document.getElementById('cantidad').setAttribute('disabled', 'disabled');
            document.getElementById('codigo').focus();
        }
    }
}

function calcularPrecioVenta(e){
    e.preventDefault();
    const cant = document.getElementById('cantidad').value;
    const precio = document.getElementById('precio').value;
    document.getElementById('sub_total').value = cant * precio;

    if (e.which == 13){
        if(cant > 0){
            const url = base_url + "Compras/ingresarVenta";
            const frm = document.getElementById('frmVenta');
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    if (res.icono != "success"){
                        alertas(res.msg, res.icono);
                    }else{
                        frm.reset();
                        cargarDetalleVenta();
                    }
                }
            }
            document.getElementById('cantidad').setAttribute('disabled', 'disabled');
            document.getElementById('codigo').focus();
        }
    }
}
//También se llama la función acá para mostrar la lista de detalles al entrar a la sección compras
//y no solo cuándo se agrega un nuevo producto a la compra
if (document.getElementById("tblDetalle")){
    cargarDetalle();
}
function cargarDetalle(){
    const url = base_url + "Compras/listar/detalle";
    const frm = document.getElementById('frmCompra');
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            const res = JSON.parse(this.responseText);
            let html = '';
            //Se recorre la tabla detalles
            //y se dibuja concatenando por fila cada producto agregado a la compra
            res.detalle.forEach(row => {
                html += `<tr>
                            <td>${row['id']}</td>
                            <td>${row['descripcion']}</td>
                            <td>${row['cantidad']}</td>
                            <td>${row['precio']}</td>
                            <td>${row['sub_total']}</td>
                            <td>
                                <button class="btn btn-danger" type="button" onclick="deleteDetalle(${row['id']}, 1)"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>`
            });
            document.getElementById("tblDetalle").innerHTML = html;
            document.getElementById("total").value = res.total_pagar.total;
        }
    }
}
if (document.getElementById("tblDetalleVenta")){
    cargarDetalleVenta();
}
function cargarDetalleVenta(){
    const url = base_url + "Compras/listar/detalle_temp";
    const frm = document.getElementById('frmCompra');
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            const res = JSON.parse(this.responseText);
            let html = '';
            //Se recorre la tabla detalles
            //y se dibuja concatenando por fila cada producto agregado a la compra
            res.detalle.forEach(row => {
                html += `<tr>
                            <td>${row['id']}</td>
                            <td>${row['descripcion']}</td>
                            <td>${row['cantidad']}</td>
                            <td><input class="form-control" placeholder="Descuento %" type="text" onkeyup="calcularDescuento(event, ${row['id']})"></td>
                            <td>${row['descuento']}</td>
                            <td>${row['precio']}</td>
                            <td>${row['sub_total_actual']}</td>
                            <td>
                                <button class="btn btn-danger" type="button" onclick="deleteDetalle(${row['id']}, 0)"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>`
            });
            document.getElementById("tblDetalleVenta").innerHTML = html;
            document.getElementById("total").value = res.total_pagar.total;
        }
    }
}

function calcularDescuento(e, id){
    e.preventDefault();
    if (e.target.value == ''){
        alertas('Ingrese el Descuento', 'warning');
    }else{
        if (e.which == 13){
            const url = base_url + "Compras/calcularDescuento/"+id+"/"+e.target.value;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    cargarDetalleVenta();
                }
            }
        }
    }
}

function deleteDetalle(id, accion){
    let url;
    if (accion == 1){
        url = base_url + "Compras/delete/"+id;
    }else{
        url = base_url + "Compras/deleteVenta/"+id;
    }
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            const res = JSON.parse(this.responseText);
            if (res == "Ok")
            {
                if (accion == 1){
                    cargarDetalle();
                }else{
                    cargarDetalleVenta();
                }
            }else
            {
                alertas(res, 'error');
            }
        }
    }
}

function procesar(accion){
    Swal.fire({
        title: '¿Está seguro de realizar la operación?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, continuar!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            let url;
            if (accion == 1){
                url = base_url + "Compras/registrarCompra/";
            }else{
                const id_cliente = document.getElementById("cliente").value;
                url = base_url + "Compras/registrarVenta/" + id_cliente;
            }
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    if (res.msg == "Ok"){
                        let rutaPDF;
                        if (accion == 1){
                            //Se abre una nueva pestaña generando un pdf de lo comprado
                            rutaPDF = base_url + "Compras/generarPdf/" + res.id_compra;
                        }else{
                            rutaPDF = base_url + "Compras/generarPdfVenta/" + res.id_venta;
                        }
                        window.open(rutaPDF);
                        window.location.reload();
                    }else{
                        alertas(res.msg, res.icono);
                    }
                }
            }
        }
    })
}

function ModificarEmpresa(){
    const frm = document.getElementById("frmEmpresa");
    const url = base_url + "Administracion/modificar/";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
            const res = JSON.parse(this.responseText);
            alertas(res.msg, res.icono);
        }
    }
}

function alertas(mensaje, icono){
    Swal.fire({
        position: 'top-end',
        icon: icono,
        title: mensaje,
        showConfirmButton: false,
        timer: 2000
    })
}

if (document.getElementById('stockMinimo')){
    reporteStock();
    productosVendidos();
}
function reporteStock(){
    const url = base_url + "Administracion/reporteStock";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
            const res = JSON.parse(this.responseText);
            let nombre = [];
            let cantidad = [];
            for (let i = 0; i < res.length; i++) {
                nombre.push(res[i]['descripcion']);
                cantidad.push(res[i]['cantidad']);
                
            }
            var ctx = document.getElementById("stockMinimo");
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: nombre,
                    datasets: [{
                        data: cantidad,
                        backgroundColor: ['#E74C3C', '#8E44AD', '#3498DB', '#16A085', '#2ECC71'],
                    }],
                },
            });
        }
    }
}

function productosVendidos(){
    const url = base_url + "Administracion/productosVendidos";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
            const res = JSON.parse(this.responseText);
            let nombre = [];
            let cantidad = [];
            for (let i = 0; i < res.length; i++) {
                nombre.push(res[i]['descripcion']);
                cantidad.push(res[i]['total']);
                
            }
            var ctx = document.getElementById("ProductosVendidos");
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: nombre,
                    datasets: [{
                        data: cantidad,
                        backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745', '#D35400'],
                    }],
                },
            });
        }
    }
}

function btnAnularC(id){
    Swal.fire({
        title: '¿Está seguro de realizar la operación?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, continuar!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Compras/anularCompra/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    t_h_c.ajax.reload();
                }
            }
        }
    })
}

function btnAnularV(id){
    Swal.fire({
        title: '¿Está seguro de realizar la operación?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, continuar!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Compras/anularVenta/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    t_h_v.ajax.reload();
                }
            }
        }
    })
}

function arqueoCaja(){
    document.getElementById('ocultar_campos').classList.add('d-none');
    document.getElementById('btnAccion').textContent = 'Abrir caja';
    document.getElementById('monto_inicial').value = '';
    $('#abrir_caja').modal('show');
}

function abrirArqueo(e){
    e.preventDefault();
    const monto_inicial = document.getElementById('monto_inicial').value;
    if (monto_inicial == ''){
        alertas('¡Ingrese el monto inicial!', 'warning');
    }else{
        const frm = document.getElementById('frmAbrirCaja');
        const url = base_url + "Cajas/abrirArqueo";
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
                const res = JSON.parse(this.responseText);
                alertas(res.msg, res.icono);
                t_arqueo.ajax.reload();
                $('#abrir_caja').modal('hide');
            }
        }
    }
}

function cerrarCaja(){
    const url = base_url + "Cajas/getVentas";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            const res = JSON.parse(this.responseText);
            document.getElementById('monto_inicial').value = res.monto_inicial.monto_inicial;
            document.getElementById('monto_final').value = res.monto_final.total;
            document.getElementById('total_ventas').value = res.total_ventas.total;
            document.getElementById('monto_general').value = res.monto_general;
            document.getElementById('id').value = res.monto_inicial.id;
            document.getElementById('btnAccion').textContent = 'Cerrar caja';
            document.getElementById('ocultar_campos').classList.remove('d-none');
            $('#abrir_caja').modal('show');
        }
    }
}



