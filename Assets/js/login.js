//Funcion para el Login, la 'e' del parámetro es de evento
function frmLogin(e){
    e.preventDefault(); //preventDefault() hace que la página no se recargue al dar click en el botón
    //Se toman los valores de los inputs del formulario mediante sus IDs
    const usuario = document.getElementById("usuario");
    const clave = document.getElementById("clave");
    //Se valídan que no estén vacíos
    if (usuario.value == "")
    {
        //Se remueve la clase para que no quede pegada por la primera vez que se adhiere
        clave.classList.remove('is-invalid');
        //Se agrega al input una clase de bootstrap
        usuario.classList.add('is-invalid');
        //Se agrega un focus para que el cursor quede en ese input listo para escribir
        usuario.focus();
    }else if (clave.value == "")
    {
        usuario.classList.remove('is-invalid');
        clave.classList.add('is-invalid');
        clave.focus();
    }else
    {
        //Se concatena a base_url el controlador Usuarios para acceder al método validar
        const url = base_url + "Usuarios/validar";
        //Se guarda en una variable el Id del Formulario
        const frm = document.getElementById("frmLogin");
        //Se crea un instancia del objeto XMLHttpRequest() para acceder a su método open()
        const http = new XMLHttpRequest();
        //Se pasan los datos de los inputs por POST, se accede al método validar
        //y con el true se le indica que lo ejecute de forma asíncrona, es decir al oir el evento
        http.open("POST", url, true);
        //con send() se ejecuta la solicitud al mismo tiempo que se activa el evento
        //siempre y cuando la solicitud sea asíncrona
        //Se le pasa como parámetro el formulario HTML mediante el objeto FormData()
        http.send(new FormData(frm));
        //Se verifíca el estado
        /*
            0 No inicializado (el método open no a sido llamado)
            1 Cargando (se llamó al método open)
            2 Cargado (se llamó al método send y ya tenemos la cabecera de la petición HTTP y el status)
            3 Interactivo (la propiedad responseText tiene datos parciales)
            4 Completado (la propiedad responseText tiene todos los datos pedidos al servidor)
            */
        http.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                // En la variable res se guarda el mensaje del método validar() del controlador Usuarios
                const res = JSON.parse(this.responseText);
                // Si la respuesta es 'Ok' se reedirecciona
                if (res == "Ok"){
                    //Se reedirecciona al método home del controlador Administración
                    window.location = base_url + "Administracion/home";
                }else{
                    //Se muestra el mensaje de alerta al ingresar un usuario/contraseña incorrectos
                    /*document.getElementById("alerta").classList.remove('d-none');
                    document.getElementById("alerta").innerHTML = res*/
                }
            }
        }
    }
}