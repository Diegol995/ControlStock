<?php
    class Administracion extends Controller
    {
        public function __construct()
        {
            session_start();
            if (empty($_SESSION['activo'])){
                header("location: ".base_url);
            }
            parent::__construct();
        }

        public function index(){
            $data = $this->model->getEmpresa();
            $this->views->getView($this, "index", $data);
        }

        public function home(){
            $data['usuarios'] = $this->model->getDatos('usuarios');
            $data['clientes'] = $this->model->getDatos('clientes');
            $data['productos'] = $this->model->getDatos('productos');
            $this->views->getView($this, "home", $data);
        }

        public function modificar(){
            $nombre = $_POST['nombre'];
            $cuit_cuil = $_POST['cuit_cuil'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];
            $mensaje = $_POST['mensaje'];
            $id = $_POST['id'];
            $data = $this->model->modificar($nombre, $cuit_cuil, $telefono, $direccion, $mensaje, $id);
            if ($data == "Ok"){
                $msg = array('msg' => '¡Datos Modificados!', 'icono' => 'success');
            }else{
                $msg = array('msg' => '¡Error al modificar los datos!', 'icono' => 'error');
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function reporteStock(){
            $data = $this->model->getStockMinimo();
            echo json_encode($data);
            die();
        }

        public function productosVendidos(){
            $data = $this->model->getproductosVendidos();
            echo json_encode($data);
            die();
        }
    }
?>