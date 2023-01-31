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
            $this->views->getView($this, "index");
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
                    $msg = '¡El campo es obligatorio!';
                }else{
                    $data = $this->model->registrarCategoria($nombre);
                    if ($data == 'Ok'){
                        $msg = 'Si';
                    }else if ($data == 'existe'){
                         $msg = '¡Ya se encuentra registrada una categoría con ese nombre!';
                    }else{
                        $msg = "¡Error al registrar la categoría!";
                    }
                }
            }else{
                if (empty($nombre)){
                    $msg = '¡El campo es obligatorio!';
                }else{
                    $data = $this->model->modificarCategoria($nombre,$id);
                    if ($data == 'modificado'){
                        $msg = 'modificado';
                    }else if ($data == 'existe'){
                        $msg = "¡Ya se encuentra registrada una categoría con ese Nombre!";
                    }else{
                        $msg = "¡Error al registrar la categoría!";
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
                $msg = "Ok";
            }else{
                $msg = "Error al eliminar la categoría";
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function restaurar(int $id){
            $data = $this->model->accionCat(1, $id);
            if ($data == 1){
                $msg = "Ok";
            }else{
                $msg = "Error al restaurar la categoría";
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
?>