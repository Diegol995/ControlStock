<?php
    class Categorias extends Controller{
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
            $verificar = $this->model->verificarPermiso($id_user, 'categorias');
            if (!empty($verificar) || $id_user == 1) {
                $this->views->getView($this, "index");
            } else {
                header('Location: '.base_url.'Errors/permisos');
            }  
        }

        public function listar(){
            $data = $this->model->getCategorias();
            for ($i=0; $i < count($data); $i++){
                if($data[$i]['estado'] == 1){
                    $data[$i]['estado'] = '<span class="badge badge-success" style="background:#5cb85c">Activo</span>';
                    $data[$i]['acciones'] = '<div>
                    <button class="btn btn-primary" title="Editar" type="button" onclick="btnEditarCat('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" title="Eliminar" type="button" onclick="btnEliminarCat('.$data[$i]['id'].');"><i class="fas fa-trash"></i></button>
                    </div>';
                }else{
                    $data[$i]['estado'] = '<span class="badge badge-danger" style="background:#d9534f">Inactivo</span>';
                    $data[$i]['acciones'] = '<div>
                    <button class="btn btn-success" title="Restaurar" type="button" onclick="btnRestaurarCat('.$data[$i]['id'].');"><i class="fa-solid fa-trash-can-arrow-up"></i></button>
                    </div>';
                }
            }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function registrar(){
            $nombre = $_POST['nombre'];
            $id = $_POST['id'];
            if ($id == ""){
                if (empty($nombre)){
                    $msg = array('msg' => '¡El campo es obligatorio!', 'icono' => 'warning');
                }else{
                    $data = $this->model->registrarCategoria($nombre);
                    if ($data == 'Ok'){
                        $msg = array('msg' => '¡Categoría Registrada!', 'icono' => 'success');
                    }else if ($data == 'existe'){
                        $msg = array('msg' => '¡Ya se encuentra registrada una categoría con ese nombre!', 'icono' => 'warning');
                    }else{
                        $msg = array('msg' => '¡Error al registrar la categoría!', 'icono' => 'error');
                    }
                }
            }else{
                if (empty($nombre)){
                    $msg = array('msg' => '¡El campo es obligatorio!', 'icono' => 'warning');
                }else{
                    $data = $this->model->modificarCategoria($nombre,$id);
                    if ($data == 'modificado'){
                        $msg = array('msg' => '¡Datos Modificados!', 'icono' => 'success');
                    }else if ($data == 'existe'){
                        $msg = array('msg' => '¡Ya se encuentra registrada una categoría con ese nombre!', 'icono' => 'warning');
                    }else{
                        $msg = array('msg' => '¡Error al modificar los datos!', 'icono' => 'error');
                    }
                }
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function editar(int $id){
            $data = $this->model->editarCat($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function eliminar(int $id){
            $data = $this->model->accionCat(0, $id);
            if ($data == 1){
                $msg = array('msg' => '¡Categoría Eliminada!', 'icono' => 'success');
            }else{
                $msg = array('msg' => '¡Error al eliminar la categoría!', 'icono' => 'error');
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function restaurar(int $id){
            $data = $this->model->accionCat(1, $id);
            if ($data == 1){
                $msg = array('msg' => '¡Categoría Restaurada!', 'icono' => 'success');
            }else{
                $msg = array('msg' => '¡Error al restaurar la categoría!', 'icono' => 'error');
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
?>