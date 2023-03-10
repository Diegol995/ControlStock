<?php
    class Cajas extends Controller{
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

        public function arqueo(){
            $this->views->getView($this, "arqueo");
        }

        public function listar(){
            $data = $this->model->getCajas('caja');
            for ($i=0; $i < count($data); $i++){
                if($data[$i]['estado'] == 1){
                    $data[$i]['estado'] = '<span class="badge badge-success" style="background:#5cb85c">Activo</span>';
                    $data[$i]['acciones'] = '<div>
                    <button class="btn btn-primary" title="Editar" type="button" onclick="btnEditarCaja('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" title="Eliminar" type="button" onclick="btnEliminarCaja('.$data[$i]['id'].');"><i class="fas fa-trash"></i></button>
                    </div>';
                }else{
                    $data[$i]['estado'] = '<span class="badge badge-danger" style="background:#d9534f">Inactivo</span>';
                    $data[$i]['acciones'] = '<div>
                    <button class="btn btn-success" title="Restaurar" type="button" onclick="btnRestaurarCaja('.$data[$i]['id'].');"><i class="fa-solid fa-trash-can-arrow-up"></i></button>
                    </div>';
                }
            }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function registrar(){
            $caja = $_POST['caja'];
            $id = $_POST['id'];
            if ($id == ""){
                if (empty($caja)){
                    $msg = array('msg' => '¡El campo es obligatorio!', 'icono' => 'warning');
                }else{
                    $data = $this->model->registrarCaja($caja);
                    if ($data == 'Ok'){
                        $msg = array('msg' => '¡Caja Registrada!', 'icono' => 'success');
                    }else if ($data == 'existe'){
                        $msg = array('msg' => '¡Ya se encuentra registrada una caja con ese nombre!', 'icono' => 'warning');
                    }else{
                        $msg = array('msg' => '¡Error al registrar la caja!', 'icono' => 'error');
                    }
                }
            }else{
                if (empty($caja)){
                    $msg = array('msg' => '¡El campo es obligatorio!', 'icono' => 'warning');
                }else{
                    $data = $this->model->modificarCaja($caja,$id);
                    if ($data == 'modificado'){
                        $msg = array('msg' => '¡Datos Modificados!', 'icono' => 'success');
                    }else if ($data == 'existe'){
                        $msg = array('msg' => '¡Ya se encuentra registrada una caja con ese nombre!', 'icono' => 'warning');
                    }else{
                        $msg = array('msg' => '¡Error al modificar los datos!', 'icono' => 'error');
                    }
                }
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function editar(int $id){
            $data = $this->model->editarCaja($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function eliminar(int $id){
            $data = $this->model->accionCaja(0, $id);
            if ($data == 1){
                $msg = array('msg' => '¡Caja Eliminada!', 'icono' => 'success');
            }else{
                $msg = array('msg' => '¡Error al eliminar la caja!', 'icono' => 'error');
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function restaurar(int $id){
            $data = $this->model->accionCaja(1, $id);
            if ($data == 1){
                $msg = array('msg' => '¡Caja Restaurada!', 'icono' => 'success');
            }else{
                $msg = array('msg' => '¡Error al restaurar la caja!', 'icono' => 'error');
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function abrirArqueo(){
            $monto_inicial = $_POST['monto_inicial'];
            //La fecha_apertura sirve tanto para la apertura como para el cierre
            $fecha_apertura = date('Y-m-d');
            $id_usuario = $_SESSION['id_usuario'];
            $id = $_POST['id'];
            if (empty($monto_inicial)){
                $msg = array('msg' => '¡El campo es obligatorio!', 'icono' => 'warning');
            }else{
                if ($id == '') {
                    $data = $this->model->registrarArqueo($id_usuario, $monto_inicial, $fecha_apertura);
                    if ($data == 'Ok'){
                        $msg = array('msg' => '¡Caja abierta con éxito!', 'icono' => 'success');
                    }else if ($data == 'abierta'){
                        $msg = array('msg' => '¡La caja ya se encuentra abierta!', 'icono' => 'warning');
                    }else{
                        $msg = array('msg' => '¡Error al abrir la caja!', 'icono' => 'error');
                    }
                }else{
                    $monto_inicial = $this->model->getMontoInicial($id_usuario);
                    $id = $monto_inicial['id'];
                    $monto_final = $this->model->getVentas($id_usuario);
                    $monto_total = $monto_inicial['monto_inicial'] + $monto_final['total'];
                    $total_ventas = $this->model->getTotalVentas($id_usuario);
                    $data = $this->model->actualizarArqueo($monto_final['total'], $fecha_apertura, $total_ventas['total'], $monto_total, $id);
                    if ($data == 'Ok'){
                        $msg = array('msg' => '¡Caja cerrada con éxito!', 'icono' => 'success');
                    }else{
                        $msg = array('msg' => '¡Error al cerrar la caja!', 'icono' => 'error');
                    }
                }
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function listar_arqueo(){
            $data = $this->model->getCajas('cierre_caja');
            for ($i=0; $i < count($data); $i++){
                if($data[$i]['estado'] == 1){
                    $data[$i]['estado'] = '<span class="badge badge-success" style="background:#5cb85c">Abierta</span>';
                }else{
                    $data[$i]['estado'] = '<span class="badge badge-danger" style="background:#d9534f">Cerrada</span>';
                }
            }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getVentas(){
            $id_usuario = $_SESSION['id_usuario'];
            $data['monto_inicial'] = $this->model->getMontoInicial($id_usuario);
            $data['monto_final'] = $this->model->getVentas($id_usuario);
            $data['total_ventas'] = $this->model->getTotalVentas($id_usuario);
            $data['monto_general'] = $data['monto_inicial']['monto_inicial'] + $data['monto_final']['total'];
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
?>