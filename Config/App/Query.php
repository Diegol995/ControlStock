<?php
    class Query extends Conexion{
        private $pdo, $con, $sql, $datos;
        public function __construct()
        {
            $this->pdo = new Conexion(); //Se crea instancia de Conexion para acceder al método conect()
            $this->con = $this->pdo->conect();
        }
        public function select(string $sql){
            $this->sql = $sql; //Se accede a la varibale sql y se le asigna un valor por parámetro
            //el valor va a ser la consulta sql
            $resul = $this->con->prepare($this->sql); //prepare() prepara la consulta sql
            $resul->execute(); //Ejecuta la consulta
            $data = $resul->fetch(PDO::FETCH_ASSOC); //Con fetch() le indicamos que solo devuelva una fila de resultados posibles
            //PDO::FETCH_ASSOC devuelve el resultado indexado por las columnas de la DB
            return $data;
        }

        //Creamos el mismo método pero ésta vez traemos más de un registro si es que los hay
        //con fechAll
        public function selectAll(string $sql){
            $this->sql = $sql;
            $resul = $this->con->prepare($this->sql); 
            $resul->execute(); 
            $data = $resul->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        //Método para registrar datos en la DB
        public function save(string $sql, array $datos){
            $this->sql = $sql;
            $this->datos = $datos;
            $insert = $this->con->prepare($this->sql);
            $data = $insert->execute($this->datos);
            if ($data){
                $res = 1;
            }else{
                $res = 0;
            }
            return $res;
        }
    }
?>