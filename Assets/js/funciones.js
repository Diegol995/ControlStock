let tblUsuarios, tblClientes, tblMedidas, tblCategorias, tblCajas, tblProductos;
//Si el contenido del DOM se cargó, se ejecuta la función
document.addEventListener('DOMContentLoaded', function(){
    //Se accede al tblUsuarios de la vista Usuarios/index.php
    tblUsuarios = $('#tblUsuarios').DataTable( {
        ajax: {
            //Se pasa la url de el método listar
            url: base_url + "Usuarios/listar",
            dataSrc: ''
        },
        columns: [
            {
                'data' : 'id'
            },
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
                'data' : 'id'
            },
            {
                'data' : 'cuit_cuil'
            },
            {
                'data' : 'nombre'
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
        ]
    } );
})

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
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: '¡Todos los campos son obligatorios!',
            showConfirmButton: false,
            timer: 3000
          })
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
                if (res == 'Si'){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '¡Usuario registrado con éxito!',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    //Se resetea el formulario para limpiar sus campos
                    frm.reset();
                    //Se oculta
                    $('#nuevo_usuario').modal('hide');
                    //Se recarga el datatable para mostrar los datos ingresados/modificados
                    //sin recargar la página
                    tblUsuarios.ajax.reload();
                }else if (res == "modificado"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '¡Usuario modificado con éxito!',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $('#nuevo_usuario').modal('hide');
                    tblUsuarios.ajax.reload();
                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        //el valor de res, es el que proviene de el método registrar del controlador
                        //Usuarios
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    })
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
                    if (res == "Ok"){
                        Swal.fire(
                          '¡Usuario Eliminado!',
                          'Este usuario se eliminó correctamente.',
                          'success'
                        )
                        tblUsuarios.ajax.reload();
                    }else{
                        Swal.fire(
                            'Error!',
                            res,
                            'error'
                        )
                    }
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
                    if (res == "Ok"){
                        Swal.fire(
                          '¡Usuario Restaurado!',
                          'Este usuario se restauró correctamente.',
                          'success'
                        )
                        tblUsuarios.ajax.reload();
                    }else{
                        Swal.fire(
                            'Error!',
                            res,
                            'error'
                        )
                    }
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
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: '¡Todos los campos son obligatorios!',
            showConfirmButton: false,
            timer: 3000
          })
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
                if (res == 'Si'){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '¡Cliente registrado con éxito!',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    frm.reset();
                    $('#nuevo_cliente').modal('hide');
                    tblClientes.ajax.reload();
                }else if (res == "modificado"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '¡Cliente modificado con éxito!',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $('#nuevo_cliente').modal('hide');
                    tblClientes.ajax.reload();
                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    })
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
                    if (res == "Ok"){
                        Swal.fire(
                          '¡Cliente Eliminado!',
                          'Este cliente se eliminó correctamente.',
                          'success'
                        )
                        tblClientes.ajax.reload();
                    }else{
                        Swal.fire(
                            'Error!',
                            res,
                            'error'
                        )
                    }
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
                    if (res == "Ok"){
                        Swal.fire(
                          '¡Cliente Restaurado!',
                          'Este cliente se restauró correctamente.',
                          'success'
                        )
                        tblClientes.ajax.reload();
                    }else{
                        Swal.fire(
                            'Error!',
                            res,
                            'error'
                        )
                    }
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
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: '¡Todos los campos son obligatorios!',
            showConfirmButton: false,
            timer: 3000
          })
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
                if (res == 'Si'){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '¡Medida registrada con éxito!',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    frm.reset();
                    $('#nueva_medida').modal('hide');
                    tblMedidas.ajax.reload();
                }else if (res == "modificado"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '¡Medida modificada con éxito!',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $('#nueva_medida').modal('hide');
                    tblMedidas.ajax.reload();
                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    })
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
                    if (res == "Ok"){
                        Swal.fire(
                          '¡Medida Eliminada!',
                          'Esta medida se eliminó correctamente.',
                          'success'
                        )
                        tblMedidas.ajax.reload();
                    }else{
                        Swal.fire(
                            'Error!',
                            res,
                            'error'
                        )
                    }
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
                    if (res == "Ok"){
                        Swal.fire(
                          '¡Medida Restaurada!',
                          'Esta medida se restauró correctamente.',
                          'success'
                        )
                        tblMedidas.ajax.reload();
                    }else{
                        Swal.fire(
                            'Error!',
                            res,
                            'error'
                        )
                    }
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
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: '¡El campo es obligatorio!',
            showConfirmButton: false,
            timer: 3000
          })
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
                if (res == 'Si'){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '¡Categoría registrada con éxito!',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    frm.reset();
                    $('#nueva_categoria').modal('hide');
                    tblCategorias.ajax.reload();
                }else if (res == "modificado"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '¡Categoría modificada con éxito!',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $('#nueva_categoria').modal('hide');
                    tblCategorias.ajax.reload();
                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    })
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
                    if (res == "Ok"){
                        Swal.fire(
                          '¡Categoria Eliminada!',
                          'Esta categoría se eliminó correctamente.',
                          'success'
                        )
                        tblCategorias.ajax.reload();
                    }else{
                        Swal.fire(
                            'Error!',
                            res,
                            'error'
                        )
                    }
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
                    if (res == "Ok"){
                        Swal.fire(
                          '¡Categoría Restaurada!',
                          'Esta categoría se restauró correctamente.',
                          'success'
                        )
                        tblCategorias.ajax.reload();
                    }else{
                        Swal.fire(
                            'Error!',
                            res,
                            'error'
                        )
                    }
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
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: '¡El campo es obligatorio!',
            showConfirmButton: false,
            timer: 3000
          })
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
                if (res == 'Si'){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '¡Caja registrada con éxito!',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    frm.reset();
                    $('#nueva_caja').modal('hide');
                    tblCajas.ajax.reload();
                }else if (res == "modificado"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '¡Caja modificada con éxito!',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $('#nueva_caja').modal('hide');
                    tblCajas.ajax.reload();
                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    })
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
                    if (res == "Ok"){
                        Swal.fire(
                          '¡Caja Eliminada!',
                          'Esta caja se eliminó correctamente.',
                          'success'
                        )
                        tblCajas.ajax.reload();
                    }else{
                        Swal.fire(
                            'Error!',
                            res,
                            'error'
                        )
                    }
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
                    if (res == "Ok"){
                        Swal.fire(
                          '¡Caja Restaurada!',
                          'Esta caja se restauró correctamente.',
                          'success'
                        )
                        tblCajas.ajax.reload();
                    }else{
                        Swal.fire(
                            'Error!',
                            res,
                            'error'
                        )
                    }
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
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: '¡Todos los campos son obligatorios!',
            showConfirmButton: false,
            timer: 3000
          })
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
                if (res == 'Si'){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '¡Producto registrado con éxito!',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    frm.reset();
                    $('#nuevo_producto').modal('hide');
                    tblProductos.ajax.reload();
                }else if (res == "modificado"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '¡Producto modificado con éxito!',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $('#nuevo_producto').modal('hide');
                    tblProductos.ajax.reload();
                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    })
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
                    if (res == "Ok"){
                        Swal.fire(
                          '¡Producto Eliminado!',
                          'Este producto se eliminó correctamente.',
                          'success'
                        )
                        tblProductos.ajax.reload();
                    }else{
                        Swal.fire(
                            'Error!',
                            res,
                            'error'
                        )
                    }
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
                    if (res == "Ok"){
                        Swal.fire(
                          '¡Producto Restaurado!',
                          'Este producto se restauró correctamente.',
                          'success'
                        )
                        tblProductos.ajax.reload();
                    }else{
                        Swal.fire(
                            'Error!',
                            res,
                            'error'
                        )
                    }
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
    //El valor 13 hace referencia a la tecla enter
    if (e.which == 13){
        const cod = document.getElementById("codigo").value;
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
                document.getElementById('cantidad').focus();
            }else{
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: '¡No se encuentra el producto con ese código!',
                    showConfirmButton: false,
                    timer: 2000
                })
                document.getElementById('codigo').value = '';
                document.getElementById('codigo').focus();
            }
        }
    }
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
                    if (res == "Ok"){
                        frm.reset();
                        cargarDetalle();
                    }
                }
            }
        }
    }
}
cargarDetalle();
function cargarDetalle(){
    const url = base_url + "Compras/listar";
    const frm = document.getElementById('frmCompra');
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            console.log(this.responseText);
        }
    }
}