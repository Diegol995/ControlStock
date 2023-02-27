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
    }
?>