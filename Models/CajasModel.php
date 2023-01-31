<?php
    class CajasModel extends Query{
        private $caja, $id, $estado;

        public function __construct () {
            parent::__construct();
        }

        public function getCajas(){
            $sql = "SELECT * FROM caja";
            $data = $this->selectAll($sql);
            return $data;
        }

        public function registrarCaja(string $caja){
            $this->caja = $caja;
            $verificar = "SELECT * FROM caja WHERE caja = '$this->caja'";
            $existe = $this->select($verificar);
            if (empty($existe)){
                $sql = "INSERT INTO caja(caja) VALUES(?)";
                $datos = array($this->caja);
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

        public function modificarCaja(string $caja, int $id){
            $this->caja = $caja;
            $this->id = $id;
            $verificar = "SELECT * FROM caja WHERE caja = '$this->caja'";
            $existe = $this->select($verificar);
            if (empty($existe) || $existe['id'] == $this->id){
                $sql = "UPDATE caja SET caja = ? WHERE id = ?";
                $datos = array($this->caja,
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

        public function editarCaja(int $id){
            $sql = "SELECT * FROM caja WHERE id = $id";
            $data = $this->select($sql);
            return $data;
        }

        public function accionCaja(int $estado, int $id){
            $this->id = $id;
            $this->estado = $estado;
            $sql = "UPDATE caja SET estado = ? WHERE id = ?";
            $datos = array($this->estado,
                           $this->id);
            $data = $this->save($sql, $datos);
            return $data;
        }
    }
?>