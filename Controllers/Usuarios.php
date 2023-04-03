<?php
    class Usuarios extends Controller{
        public function __construct()
        {
            session_start();
            parent::__construct();
        }
        public function index(){
            //Se toma la sesión de la función validar()
            //Si no existe una sesión activa, se reedirecciona al Login
            if (empty($_SESSION['activo'])){
                header("location: ".base_url);
            }
            //Se accede llama al método getCajas del modelo Usuarios y se guarda en la variable $data
            //posteriormente se pasa esa variable en el llamado a getView como 3er parámetro
            //para que cargue al resultado al cargar la vista
            $data['cajas'] = $this->model->getCajas();
            //Esta es la vista a la que se reedirecciona si el usuario y contraseña del login
            //son correctos
            $this->views->getView($this, "index", $data);
        }

        public function listar(){
            $data = $this->model->getUsuarios();
            for ($i=0; $i < count($data); $i++){
                //Se agrega el campo 'estado' con la etiqueta <span> como valores en cada iteración
                //para mostrar si está activo o inactivo
                if($data[$i]['estado'] == 1){
                    $data[$i]['estado'] = '<span class="badge bg-success" style="background:#5cb85c">Activo</span>';
                    //Se agrega el campo 'acciones' con los botones como valores en cada iteración.
                    //Y en la accion de los botones se llaman a las funciones pasándole como parámetro
                    //el id del usuario en ese momento de iteración
                    $data[$i]['acciones'] = '<div>
                    <a class="btn btn-dark" title="Permisos" href="'.base_url.'Usuarios/permisos/'.$data[$i]['id'].'"><i class="fas fa-key"></i></a>
                    <button class="btn btn-primary" title="Editar" type="button" onclick="btnEditarUser('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" title="Eliminar" type="button" onclick="btnEliminarUser('.$data[$i]['id'].');"><i class="fas fa-trash"></i></button>
                    </div>';
                }else{
                    $data[$i]['estado'] = '<span class="badge bg-danger" style="background:#d9534f">Inactivo</span>';
                    $data[$i]['acciones'] = '<div>
                    <button class="btn btn-success" title="Restaurar" type="button" onclick="btnRestaurarUser('.$data[$i]['id'].');"><i class="fa-solid fa-trash-can-arrow-up"></i></button>
                    </div>';
                }
            }
            //Se envían los resultados de la consulta en formato JSON
            //*JSON_UNESCAPED_UNICODE reconoce carácteres particulares como la "ñ"
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
        //Valida los vampos vacíos del Login
        public function validar(){
            //Se valída que que los campos no estén vacíos
            if (empty($_POST['usuario']) || empty($_POST['clave'])){
                $msg = "Los campos están vacíos";
            }else{
                //Si los campos no están vacíos, se almacenan sus valores en variables
                $usuario = $_POST['usuario'];
                $clave = $_POST['clave'];
                $hash = hash("SHA256", $clave);
                //Se hace un consulta y se almacena la respuesta en la variable $data
                $data = $this->model->getUsuario($usuario, $hash);
                //Si el usuario y la clave existen...
                if ($data){
                    //Se guardan los datos recuperados de la DB en SESIONES para utilizarlos
                    $_SESSION['id_usuario'] = $data['id'];
                    $_SESSION['usuario'] = $data['usuario'];
                    $_SESSION['nombre'] = $data['nombre'];
                    //Se crea esta sesión para privar las URLs y que no se pueda acceder a secciones del sistema
                    //mediante las mismas si el usuario no está logeado
                    $_SESSION['activo'] = true;
                    //El "Ok" se utiliza para hacer la reedireccion en funciones.js
                    $msg = "Ok";
                }else{
                    $msg = "Usuario o Contraseña incorrecta";
                }
            }
            //Se envia el contenido de $msg para que lo reciba funciones.js y realizar las
            //acciones correspondientes
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function registrar(){
            $usuario = $_POST['usuario'];
            $nombre = $_POST['nombre'];
            $clave = $_POST['clave'];
            $confirmar = $_POST['confirmar'];
            $caja = $_POST['caja'];
            $id = $_POST['id'];
            //Se encripta la contraseña
            $hash = hash("SHA256", $clave);
            //Si el $id es vacío significa que se está ingresando un usuario nuevo
            //de lo contrario se está modificando uno ya existente
            if ($id == ""){
                if (empty($usuario) || empty($nombre) || empty($clave) || empty($caja)){
                    $msg = array('msg' => '¡Todos los campos son obligatorios!', 'icono' => 'warning');
                }else{
                    if ($clave != $confirmar){
                        $msg = array('msg' => '¡Las contraseñas deben coincidir!', 'icono' => 'warning');
                    }else{
                        $data = $this->model->registrarUsuario($usuario,$nombre,$hash,$caja);
                        if ($data == 'Ok'){
                            $msg = array('msg' => '¡Usuario registrado con éxito!', 'icono' => 'success');
                        }else if ($data == 'existe'){
                            $msg = array('msg' => '¡El usuario que desea registrar ya existe!', 'icono' => 'error');
                        }else{
                            $msg = array('msg' => '¡Error al registrar el usuario!', 'icono' => 'error');
                        }
                    }
                }
            }else{
                if (empty($usuario) || empty($nombre) || empty($caja)){
                    $msg = array('msg' => '¡Todos los campos son obligatorios!', 'icono' => 'warning');
                }else{
                    $data = $this->model->modificarUsuario($usuario,$nombre,$caja,$id);
                    if ($data == 'modificado'){
                        $msg = array('msg' => '¡Usuario modificado con éxito!', 'icono' => 'success');
                    }else if ($data == 'existe'){
                        $msg = array('msg' => '¡Ya existe ese usuario!', 'icono' => 'error');
                    }else{
                        $msg = array('msg' => '¡Error al registrar el usuario!', 'icono' => 'error');
                    }
                }
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function editar(int $id){
            $data = $this->model->editarUser($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function eliminar(int $id){
            $data = $this->model->accionUser(0, $id);
            if ($data == 1){
                $msg = array('msg' => '¡Usuario Eliminado!', 'icono' => 'success');
            }else{
                $msg = array('msg' => '¡Error al eliminar el usuario!', 'icono' => 'error');
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function restaurar(int $id){
            $data = $this->model->accionUser(1, $id);
            if ($data == 1){
                $msg = array('msg' => '¡Usuario Restaurado!', 'icono' => 'success');
            }else{
                $msg = array('msg' => '¡Error al restaurar el usuario!', 'icono' => 'error');
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function cambiarPass(){
            $actual = $_POST['clave_actual'];
            $nueva = $_POST['clave_nueva'];
            $confirm = $_POST['confirmar_clave'];
            if (empty($actual) || empty($nueva) || empty($confirm)){
                $msg = array('msg' => '¡Todos los campos son obligatorios!', 'icono' => 'warning');
            }else{
                if ($nueva != $confirm){
                    $msg = array('msg' => '¡Las contraseñas deben coincidir!', 'icono' => 'warning');
                }else{
                    $id = $_SESSION['id_usuario'];
                    $hash = hash('SHA256', $actual);
                    $data = $this->model->getPass($hash, $id);
                    if (!empty($data)){
                        $verificar = $this->model->modificarPass(hash('SHA256', $nueva), $id);
                        if ($verificar == 1){
                            $msg = array('msg' => '¡Constraseña Modificada!', 'icono' => 'success');
                        }else{
                            $msg = array('msg' => '¡Error al modificar la contraseña!', 'icono' => 'error');
                        }
                    }else{
                        $msg = array('msg' => '¡La contraseña actual es incorrecta!', 'icono' => 'error');
                    }
                }
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function permisos($id){
            if (empty($_SESSION['activo'])){
                header("location: ".base_url);
            }
            $data['datos'] = $this->model->getPermisos();
            $permisos = $this->model->getDetallePermisos($id);
            $data['asignados'] = array();
            foreach ($permisos as $permiso) {
                $data['asignados'][$permiso['id_permiso']] = true;
            }
            $data['id_usuario'] = $id;
            $this->views->getView($this, "permisos", $data);
        }

        public function registrarPermiso(){
            $id_user = $_POST['id_usuario'];
            $eliminar = $this->model->eliminarPermisos($id_user);
            if ($eliminar == 'Ok') {
                foreach ($_POST['permisos'] as $id_permiso) {
                    $registrar = $this->model->registrarPermisos($id_user, $id_permiso);
                    if ($registrar == 'Ok') {
                        $msg = array('msg' => '¡Permisos registrados con éxito!', 'icono' => 'success');
                    }else{
                        $msg = array('msg' => '¡Error al registrar los permisos!', 'icono' => 'error');
                    }
                }
            }else{
                $msg = array('msg' => '¡Error al eliminar los permisos anteriores!', 'icono' => 'error');
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        }

        public function salir(){
            session_destroy();
            header("location: ".base_url);
        }
    }
?>