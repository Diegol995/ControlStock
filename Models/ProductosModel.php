<?php
    class ProductosModel extends Query{
        private $codigo, $nombre, $precio_compra, $precio_venta, $cantidad, $medida, $categoria, $id, $estado, $img;

        public function __construct () {
            parent::__construct();
        }

        public function getMedidas(){
            $sql = "SELECT * FROM medidas WHERE estado = 1";
            $data = $this->selectAll($sql);
            return $data;
        }

        public function getCategorias(){
            $sql = "SELECT * FROM categorias WHERE estado = 1";
            $data = $this->selectAll($sql);
            return $data;
        }

        public function getProductos(){
            $sql = "SELECT p.*, m.id AS medida_id, m.nombre AS medida, c.id AS categoria_id, c.nombre AS categoria FROM productos p
                        JOIN medidas m ON p.id_medida = m.id
                        JOIN categorias c ON p.id_categoria = c.id";
            $data = $this->selectAll($sql);
            return $data;
        }

        public function registrarProducto(string $codigo, string $nombre, string $precio_compra, string $precio_venta, int $medida, int $categoria, string $img){
            $this->codigo = $codigo;
            $this->nombre = $nombre;
            $this->precio_compra = $precio_compra;
            $this->precio_venta = $precio_venta;
            $this->medida = $medida;
            $this->categoria = $categoria;
            $this->img = $img;
            $verificar = "SELECT * FROM productos WHERE codigo = '$this->codigo'";
            $existe = $this->select($verificar);
            if (empty($existe)){
                $sql = "INSERT INTO productos(codigo,descripcion,precio_compra,precio_venta,id_medida,id_categoria,imagen) VALUES(?,?,?,?,?,?,?)";
                $datos = array($this->codigo,
                           $this->nombre,
                           $this->precio_compra,
                           $this->precio_venta,
                           $this->medida,
                           $this->categoria,
                           $this->img);
                $data = $this->save($sql, $datos);
                if ($data == 1){
                    $res = 'Ok';
                }else{
                    $res = 'error';
                }
            }else{
                $res = "existe";
            }
            
            return $res;
        }

        public function modificarProducto(string $codigo, string $nombre, string $precio_compra, $precio_venta, int $medida, int $categoria, string $img,int $id){
            $this->codigo = $codigo;
            $this->nombre = $nombre;
            $this->precio_compra = $precio_compra;
            $this->precio_venta = $precio_venta;
            $this->medida = $medida;
            $this->categoria = $categoria;
            $this->id = $id;
            $this->img = $img;
            $verificar = "SELECT * FROM productos WHERE codigo = '$this->codigo'";
            $existe = $this->select($verificar);
            if (empty($existe) || $existe['id'] == $this->id){
                $sql = "UPDATE productos SET codigo = ?, descripcion = ?, precio_compra = ?, precio_venta = ?, id_medida = ?, id_categoria = ? , imagen = ? WHERE id = ?";
                $datos = array($this->codigo,
                           $this->nombre,
                           $this->precio_compra,
                           $this->precio_venta,
                           $this->medida,
                           $this->categoria,
                           $this->img,
                           $this->id);
                $data = $this->save($sql, $datos);
                if ($data == 1){
                    $res = 'modificado';
                }else{
                    $res = 'error';
                }
            }else{
                $res = "existe";
            }
            return $res;
        }

        public function editarProd(int $id){
            $sql = "SELECT * FROM productos WHERE id = $id";
            $data = $this->select($sql);
            return $data;
        }

        public function accionProducto(int $estado, int $id){
            $this->id = $id;
            $this->estado = $estado;
            $sql = "UPDATE productos SET estado = ? WHERE id = ?";
            $datos = array($this->estado,
                           $this->id);
            $data = $this->save($sql, $datos);
            return $data;
        }
    }
?>