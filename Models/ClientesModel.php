<?php
    class ClientesModel extends Query{
        private $cuit_cuil, $nombre, $telefono, $direccion, $id, $estado;

        public function __construct () {
            parent::__construct();
        }

        public function getClientes(){
            $sql = "SELECT * FROM clientes";
            $data = $this->selectAll($sql);
            return $data;
        }

        public function registrarCliente(string $cuit_cuil, string $nombre, string $telefono, string $direccion){
            $this->cuit_cuil = $cuit_cuil;
            $this->nombre = $nombre;
            $this->telefono = $telefono;
            $this->direccion = $direccion;
            $verificar = "SELECT * FROM clientes WHERE cuit_cuil = '$this->cuit_cuil'";
            $existe = $this->select($verificar);
            //Se valida que el usuario que se quiere ingresar no exista
            if (empty($existe)){
                $sql = "INSERT INTO clientes(cuit_cuil,nombre,telefono,direccion) VALUES(?,?,?,?)";
                $datos = array($this->cuit_cuil,
                           $this->nombre,
                           $this->telefono,
                           $this->direccion);
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

        public function modificarCliente(string $cuit_cuil, string $nombre, string $telefono, string $direccion, int $id){
            $this->cuit_cuil = $cuit_cuil;
            $this->nombre = $nombre;
            $this->telefono = $telefono;
            $this->direccion = $direccion;
            $this->id = $id;
            $verificar = "SELECT * FROM clientes WHERE cuit_cuil = '$this->cuit_cuil'";
            $existe = $this->select($verificar);
            if (empty($existe) || $existe['id'] == $this->id){
                $sql = "UPDATE clientes SET cuit_cuil = ?, nombre = ?, telefono = ?, direccion = ? WHERE id = ?";
                $datos = array($this->cuit_cuil,
                           $this->nombre,
                           $this->telefono,
                           $this->direccion,
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

        public function editarCli(int $id){
            $sql = "SELECT * FROM clientes
                        WHERE id = $id
                        ORDER BY nombre";
            $data = $this->select($sql);
            return $data;
        }

        public function accionCli(int $estado, int $id){
            $this->id = $id;
            $this->estado = $estado;
            $sql = "UPDATE clientes SET estado = ? WHERE id = ?";
            $datos = array($this->estado,
                           $this->id);
            $data = $this->save($sql, $datos);
            return $data;
        }
    }
?>