<?php
    class Productos extends Controller{
        public function __construct()
        {
            session_start();
            parent::__construct();
        }
        public function index(){
            if (empty($_SESSION['activo'])){
                header("location: ".base_url);
            }
            $data['medidas'] = $this->model->getMedidas();
            $data['categorias'] = $this->model->getCategorias();
            $this->views->getView($this, "index", $data);
        }

        public function listar(){
            $data = $this->model->getProductos();
            for ($i=0; $i < count($data); $i++){
                //class="img-thumbnail" permite que la imagen se adapte a la lista
                //En src se le pasa la ruta de donde se encuentra el archivo/imagen concatenado con el nombre que tiene en la DB
                $data[$i]['imagen'] = '<img class="img-thumbnail" src="' . base_url . "Assets/img/" . $data[$i]['imagen'] . '" width="100">';
                if($data[$i]['estado'] == 1){
                    $data[$i]['estado'] = '<span class="badge badge-success" style="background:#5cb85c">Activo</span>';
                    $data[$i]['acciones'] = '<div>
                    <button class="btn btn-primary" title="Editar" type="button" onclick="btnEditarProd('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" title="Eliminar" type="button" onclick="btnEliminarProd('.$data[$i]['id'].');"><i class="fas fa-trash"></i></button>
                    </div>';
                }else{
                    $data[$i]['estado'] = '<span class="badge badge-danger" style="background:#d9534f">Inactivo</span>';
                    $data[$i]['acciones'] = '<div>
                    <button class="btn btn-success" title="Restaurar" type="button" onclick="btnRestaurarProd('.$data[$i]['id'].');"><i class="fa-solid fa-trash-can-arrow-up"></i></button>
                    </div>';
                }
            }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function registrar(){
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $precio_compra = $_POST['precio_compra'];
            $precio_venta = $_POST['precio_venta'];
            $medida = $_POST['medida'];
            $categoria = $_POST['categoria'];
            $id = $_POST['id'];
            //Se guardan los datos del archivo que viene por $_FILES
            $img = $_FILES['imagen'];
            $imgName = $img['name'];
            $tmpName = $img['tmp_name'];
            $fecha = date('YmdHis');
            if ($id == ""){
                if (empty($codigo) || empty($nombre) || empty($precio_compra) || empty($precio_venta)){
                    $msg = '¡Todos los campos son obligatorios!';
                }else{
                    //Si no está vacío...
                    if (!empty($imgName)){
                        $imgNombre = $fecha . ".jpg";
                        //El destino de donde se va a guardar el archivo
                        $destino = "Assets/img/".$imgNombre;
                    }else if (!empty($_POST['img_actual']) && empty($imgName)){
                        $imgNombre = $_POST['img_actual'];
                    }else{
                        $imgNombre = "default.jpg";
                    }
                    $data = $this->model->registrarProducto($codigo,$nombre,$precio_compra,$precio_venta,$medida,$categoria,$imgNombre);
                    if ($data == 'Ok'){
                        if (!empty($imgName)){
                            //Se guarda el archivo cargado indicando el nombre temporal y el destino de la carpeta
                            move_uploaded_file($tmpName, $destino);
                        }
                        $msg = 'Si';
                    }else if ($data == 'existe'){
                        $msg = '¡Ya existe un producto con ese código de barras!';
                    }else{
                        $msg = "¡Error al registrar el Producto!";
                    }
                }
            }else{
                if (empty($codigo) || empty($nombre) || empty($precio_compra) || empty($precio_venta)){
                    $msg = '¡Todos los campos son obligatorios!';
                }else{
                    $imgDelete = $this->model->editarProd($id);
                    //Se elimina el archivo solo si es distinto de default para que no se borre el mismo
                    //y solo se elimine cuando el usuario de click en eliminar ya que al hacerlo el valor de
                    //$_POST['img_actual'] pasa a ser vacío desde la función deleteImg() en funciones.js
                        if ($imgDelete['imagen'] != "default.jpg" && $_POST['img_actual'] == ''){
                            if (file_exists('Assets/img/' . $imgDelete['imagen'])){
                                unlink('Assets/img/' . $imgDelete['imagen']);
                            }
                        }
                        if (!empty($imgName)){
                            $imgNombre = $fecha . ".jpg";
                            //El destino de donde se va a guardar el archivo
                            $destino = "Assets/img/".$imgNombre;
                        }else if (!empty($_POST['img_actual']) && empty($imgName)){
                            $imgNombre = $_POST['img_actual'];
                        }else{
                            $imgNombre = "default.jpg";
                        }
                        $data = $this->model->modificarProducto($codigo,$nombre,$precio_compra,$precio_venta,$medida,$categoria,$imgNombre,$id);
                        if ($data == 'modificado'){
                            if (!empty($imgName)){
                                move_uploaded_file($tmpName, $destino);
                            }
                            $msg = 'modificado';
                        }else if ($data == 'existe'){
                            $msg = "¡Ya existe un producto con ese código de barras!";
                        }else{
                            $msg = "¡Error al registrar el Producto!";
                        }
                }
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function editar(int $id){
            $data = $this->model->editarProd($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function eliminar(int $id){
            $data = $this->model->accionProducto(0, $id);
            if ($data == 1){
                $msg = "Ok";
            }else{
                $msg = "Error al eliminar el producto";
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function restaurar(int $id){
            $data = $this->model->accionProducto(1, $id);
            if ($data == 1){
                $msg = "Ok";
            }else{
                $msg = "Error al restaurar el producto";
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function salir(){
            session_destroy();
            header("location: ".base_url);
        }
    }
?>