<?php
    class AdministracionModel extends Query{

        public function __construct () {
            parent::__construct();
        }

        public function getEmpresa(){
            $sql = "SELECT * FROM configuracion";
            $data = $this->select($sql);
            return $data;
        }

        public function getDatos(string $table){
            $sql = "SELECT COUNT(*) AS total FROM $table";
            $data = $this->select($sql);
            return $data;
        }

        public function modificar(string $nombre, string $cuit_cuil, string $telefono, string $direccion, string $mensaje, int $id){
            $sql = "UPDATE configuracion SET nombre = ?, cuit_cuil = ?, telefono = ?, direccion = ?, mensaje = ? WHERE id = ?";
            $datos = array($nombre, $cuit_cuil, $telefono, $direccion, $mensaje, $id);
            $data = $this->save($sql, $datos);
            if ($data == 1){
                $res = 'Ok';
            }else{
                $res = 'error';
            }
            return $res;
        }

        public function getStockMinimo(){
            $sql = "SELECT * FROM productos WHERE cantidad < 130 ORDER BY cantidad limit 4";
            $data = $this->selectAll($sql);
            return $data;
        }

        public function getproductosVendidos(){
            $sql = "SELECT d.id_producto, d.cantidad, p.id, p.descripcion, SUM(d.cantidad) AS total
                        FROM detalle_ventas d 
                        INNER JOIN productos p ON p.id = d.id_producto
                        GROUP BY d.id_producto
                        ORDER BY total DESC
                        LIMIT 4";
            $data = $this->selectAll($sql);
            return $data;
        }
    }
?>