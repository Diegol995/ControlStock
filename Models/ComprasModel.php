<?php
    class ComprasModel extends Query{
        private $nombre, $id, $estado;

        public function __construct () {
            parent::__construct();
        }

        public function getClientes(){
            $sql = "SELECT * FROM clientes WHERE estado = 1 ORDER BY nombre";
            $data = $this->selectAll($sql);
            return $data;
        }

        public function getProdCod(string $cod){
            $sql = "SELECT * FROM productos WHERE codigo = '$cod'";
            $data = $this->select($sql);
            return $data;
        }

        public function getProductos(int $id){
            $sql = "SELECT * FROM productos WHERE id = $id";
            $data = $this->select($sql);
            return $data;
        }
        //Se utilizan los mismos métodos para las compras y para las ventas
        //solo se cambia el parámetro $table para acceder a la tabla temporal de cada una
        public function registrarDetalle(string $table, int $id_producto, int $id_usuario, string $precio, int $cantidad, string $sub_total_actual,string $sub_total){
            $sql = "INSERT INTO $table(id_producto,id_usuario,precio,cantidad,sub_total_actual,sub_total) VALUES(?,?,?,?,?,?)";
            $datos = array($id_producto,$id_usuario,$precio,$cantidad,$sub_total_actual,$sub_total);
            $data = $this->save($sql, $datos);
            if ($data == 1){
                $res = "Ok";
            }else{
                $res = "error";
            }
            return $res;
        }
        
        public function getDetalle(string $table, int $id){
            //El parámetro $id es por si mas de un usuario hacen la consulta al mismo tiempo
            $sql = "SELECT d.*, p.id AS id_prod, p.descripcion FROM $table d INNER JOIN productos p ON d.id_producto = p.id WHERE d.id_usuario = $id";
            $data = $this->selectAll($sql);
            return $data;
        }

        public function calcularCompra(string $table, int $id_usuario){
            $sql = "SELECT sub_total_actual, SUM(sub_total_actual) AS total FROM $table WHERE id_usuario = $id_usuario";
            $data = $this->select($sql);
            return $data;
        }

        public function deleteDetalle(string $table, int $id){
            $sql = "DELETE FROM $table WHERE id = ?";
            $datos = array($id);
            $data = $this->save($sql, $datos);
            if ($data == 1)
            {
                $res = "Ok";
            }
            else
            {
                $res = "error";
            }
            return $res;
        }
        
        public function consultarDetalle(string $table, int $id_producto, int $id_usuario){
            $sql = "SELECT * FROM $table WHERE id_producto = $id_producto AND id_usuario = $id_usuario";
            $data = $this->select($sql);
            return $data;
        }
        
        public function actualizarDetalle(string $table, string $precio, int $cantidad, string $sub_total_actual,string $sub_total, int $id_producto, int $id_usuario){
            $sql = "UPDATE $table SET precio = ?, cantidad = ?, sub_total_actual = ?,sub_total = ? WHERE id_producto = ? AND id_usuario = ?";
            $datos = array($precio,$cantidad,$sub_total_actual,$sub_total,$id_producto,$id_usuario);
            $data = $this->save($sql, $datos);
            if ($data == 1){
                $res = "modificado";
            }else{
                $res = "error";
            }
            return $res;
        }

        public function registrarCompra(int $id_usuario, string $total){
            $sql = "INSERT INTO compras(id_usuario,total) VALUES(?,?)";
            $datos = array($id_usuario, $total);
            $data = $this->save($sql, $datos);
            if ($data == 1){
                $res = "Ok";
            }else{
                $res = "error";
            }
            return $res;
        }

        public function getId(string $table){
            $sql = "SELECT MAX(id) as id FROM $table";
            $data = $this->select($sql);
            return $data;
        }

        public function registarDetalleCompra(int $id_compra, int $id_producto,int $cantidad, string $precio, string $sub_total){
            $sql = "INSERT INTO detalle_compras(id_compra,id_producto,cantidad,precio,sub_total) VALUES(?,?,?,?,?)";
            $datos = array($id_compra, $id_producto,$cantidad, $precio, $sub_total);
            $data = $this->save($sql, $datos);
            if ($data == 1){
                $res = "Ok";
            }else{
                $res = "error";
            }
            return $res;
        }

        public function registarDetalleVenta(int $id_venta, int $id_producto,int $cantidad, string $desc,string $precio, string $sub_total){
            $sql = "INSERT INTO detalle_ventas(id_venta,id_producto,cantidad,descuento,precio,sub_total) VALUES(?,?,?,?,?,?)";
            $datos = array($id_venta, $id_producto, $cantidad, $desc, $precio, $sub_total);
            $data = $this->save($sql, $datos);
            if ($data == 1){
                $res = "Ok";
            }else{
                $res = "error";
            }
            return $res;
        }

        public function getEmpresa(){
            $sql = "SELECT * FROM configuracion";
            $data = $this->select($sql);
            return $data;
        }

        public function vaciarDetalle(string $table, int $id_usuario){
            $sql = "DELETE FROM $table WHERE id_usuario = ?";
            $datos = array($id_usuario);
            $data = $this->save($sql, $datos);
            if ($data == 1)
            {
                $res = "Ok";
            }else
            {
                $res = "error";
            }
            return $res;
        }

        public function getProdCompra(int $id_compra){
            $sql = "SELECT c.*, d.*,p.id, p.descripcion, u.nombre
            FROM compras c 
            INNER JOIN detalle_compras d ON c.id = d.id_compra
            INNER JOIN productos p ON d.id_producto = p.id
            INNER JOIN usuarios u ON c.id_usuario = u.id
            WHERE id_compra = $id_compra";
            $data = $this->selectAll($sql);
            return $data;
        }

        public function getProdVenta(int $id_venta){
            $sql = "SELECT v.*, d.*,p.id, p.descripcion, u.nombre
            FROM ventas v 
            INNER JOIN detalle_ventas d ON v.id = d.id_venta
            INNER JOIN productos p ON d.id_producto = p.id
            INNER JOIN usuarios u ON v.id_usuario = u.id
            WHERE id_venta = $id_venta";
            $data = $this->selectAll($sql);
            return $data;
        }

        public function getHistorialCompras(){
            $sql = "SELECT c.*, u.nombre as nombre FROM compras c INNER JOIN usuarios u ON c.id_usuario = u.id";
            $data = $this->selectAll($sql);
            return $data;
        }

        public function getHistorialVentas(){
            $sql = "SELECT v.*, u.nombre as userName, c.nombre as clientName
                        FROM ventas v 
                        INNER JOIN usuarios u ON v.id_usuario = u.id
                        INNER JOIN clientes c ON v.id_cliente = c.id";
            $data = $this->selectAll($sql);
            return $data;
        }

        public function actualizarStock(int $cantidad, $id_producto){
            $sql = "UPDATE productos SET cantidad = ? WHERE id = ?";
            $datos = array($cantidad, $id_producto);
            $data = $this->save($sql, $datos);
            return $data;
        }

        public function registrarVenta(int $id_usuario, int $id_cliente, string $total){
            $sql = "INSERT INTO ventas(id_usuario, id_cliente, total) VALUES(?,?,?)";
            $datos = array($id_usuario, $id_cliente, $total);
            $data = $this->save($sql, $datos);
            if ($data == 1){
                $res = "Ok";
            }else{
                $res = "error";
            }
            return $res;
        }

        public function clienteVenta($id_venta){
            $sql = "SELECT c.*
                FROM clientes c
                INNER JOIN ventas v ON c.id = v.id_cliente
                WHERE v.id = $id_venta";
            $data = $this->select($sql);
            return $data;
        }

        public function verificarDescuento(int $id){
            $sql = "SELECT * FROM detalle_temp WHERE id = $id";
            $data = $this->select($sql);
            return $data;
        }

        public function actualizarDescuento(string $desc, string $sub_total,int $id){
            $sql = "UPDATE detalle_temp SET descuento = ?, sub_total_actual = ? WHERE id = ?";
            $datos = array($desc, $sub_total, $id);
            $data = $this->save($sql, $datos);
            if ($data == 1){
                $res = "Ok";
            }else{
                $res = "error";
            }
            return $res;
        }

        public function getDescuento(int $id_venta){
            $sql = "SELECT descuento, SUM(descuento) AS total FROM detalle_ventas WHERE id_venta = $id_venta";
            $data = $this->select($sql);
            return $data;
        }

        public function getAnular(string $table,int $id_compra){
            $sql = "UPDATE $table SET estado = ? WHERE id = ?";
            $datos = array(0, $id_compra);
            $data = $this->save($sql, $datos);
            if ($data == 1){
                $res = "Ok";
            }else{
                $res = "error";
            }
            return $res;
        }

        public function verificarCaja(int $id_usuario){
            $sql = "SELECT * FROM cierre_caja WHERE id_usuario = $id_usuario AND estado = 1";
            $data = $this->select($sql);
            return $data;
        }

        public function verificarPermiso(int $id_user, string $nombre){
            $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso
                    FROM permisos p
                    INNER JOIN detalle_permisos d ON p.id = d.id_permiso
                    WHERE d.id_usuario = $id_user AND p.permiso = '$nombre'";
            $data = $this->selectAll($sql);
            return $data;
        }
    }
?>