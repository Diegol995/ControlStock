<?php
    class Clientes extends Controller{
        public function __construct()
        {
            session_start();
            if (empty($_SESSION['activo'])){
                header("location: ".base_url);
            }
            parent::__construct();
        }
        
        public function index(){
            $id_user = $_SESSION['id_usuario'];
            $verificar = $this->model->verificarPermiso($id_user, 'clientes');
            if (!empty($verificar) || $id_user == 1) {
                $this->views->getView($this, "index");
            } else {
                header('Location: '.base_url.'Errors/permisos');
            }           
        }

        public function listar(){
            $data = $this->model->getClientes();
            for ($i=0; $i < count($data); $i++){
                if($data[$i]['estado'] == 1){
                    $data[$i]['estado'] = '<span class="badge badge-success" style="background:#5cb85c">Activo</span>';
                    $data[$i]['acciones'] = '<div>
                    <button class="btn btn-primary" title="Editar" type="button" onclick="btnEditarCli('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" title="Eliminar" type="button" onclick="btnEliminarCli('.$data[$i]['id'].');"><i class="fas fa-trash"></i></button>
                    </div>';
                }else{
                    $data[$i]['estado'] = '<span class="badge badge-danger" style="background:#d9534f">Inactivo</span>';
                    $data[$i]['acciones'] = '<div>
                    <button class="btn btn-success" title="Restaurar" type="button" onclick="btnRestaurarCli('.$data[$i]['id'].');"><i class="fa-solid fa-trash-can-arrow-up"></i></button>
                    </div>';
                }
            }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function registrar(){
            $id_user = $_SESSION['id_usuario'];
            $verificar = $this->model->verificarPermiso($id_user, 'registrar_clientes');
            if (!empty($verificar) || $id_user == 1) {         
                $cuit_cuil = $_POST['cuit_cuil'];
                $nombre = $_POST['nombre'];
                $telefono = $_POST['telefono'];
                $direccion = $_POST['direccion'];
                $id = $_POST['id'];
                if ($id == ""){
                    if (empty($cuit_cuil) || empty($nombre) || empty($telefono) || empty($direccion)){
                        $msg = array('msg' => '¡Todos los campos son obligatorios!', 'icono' => 'warning');
                    }else{
                        $data = $this->model->registrarCliente($cuit_cuil,$nombre,$telefono,$direccion);
                        if ($data == 'Ok'){
                            $msg = array('msg' => '¡Cliente Registrado!', 'icono' => 'success');
                        }else if ($data == 'existe'){
                            $msg = array('msg' => '¡Ya se encuentra registrado un cliente con ese Cuit/Cuil!', 'icono' => 'warning');
                        }else{
                            $msg = array('msg' => '¡Error al registrar el cliente!', 'icono' => 'error');
                        }
                    }
                }else{
                    if (empty($cuit_cuil) || empty($nombre) || empty($telefono) || empty($direccion)){
                        $msg = array('msg' => '¡Todos los campos son obligatorios!', 'icono' => 'warning');
                    }else{
                        $data = $this->model->modificarCliente($cuit_cuil,$nombre,$telefono,$direccion,$id);
                        if ($data == 'modificado'){
                            $msg = array('msg' => '¡Datos Modificados!', 'icono' => 'success');
                        }else if ($data == 'existe'){
                            $msg = array('msg' => '¡Ya se encuentra registrado un cliente con ese Cuit/Cuil!', 'icono' => 'warning');
                        }else{
                            $msg = array('msg' => '¡Error al registrar el cliente!', 'icono' => 'error');
                        }
                    }
                }
            } else {
                $msg = array('msg' => '¡No tienes permisos para registrar clientes!', 'icono' => 'warning');
            } 
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function editar(int $id){
            $data = $this->model->editarCli($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function eliminar(int $id){
            $id_user = $_SESSION['id_usuario'];
            $verificar = $this->model->verificarPermiso($id_user, 'eliminar_clientes');
            if (!empty($verificar) || $id_user == 1) {
                $data = $this->model->accionCli(0, $id);
                if ($data == 1){
                    $msg = array('msg' => '¡Cliente Eliminado!', 'icono' => 'success');
                }else{
                    $msg = array('msg' => '¡Error al eliminar el cliente!', 'icono' => 'error');
                }
            } else {
                $msg = array('msg' => '¡No tienes permisos para eliminar clientes!', 'icono' => 'warning');
            }    
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function restaurar(int $id){
            $id_user = $_SESSION['id_usuario'];
            $verificar = $this->model->verificarPermiso($id_user, 'restaurar_clientes');
            if (!empty($verificar) || $id_user == 1) {
                $data = $this->model->accionCli(1, $id);
                if ($data == 1){
                    $msg = array('msg' => '¡Cliente Restaurado!', 'icono' => 'success');
                }else{
                    $msg = array('msg' => '¡Error al restaurar el cliente!', 'icono' => 'error');
                }
            }else {
                $msg = array('msg' => '¡No tienes permisos para restaurar clientes!', 'icono' => 'warning'); 
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
?>