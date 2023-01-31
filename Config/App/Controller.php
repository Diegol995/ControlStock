<?php
//Conexión del controlador al modelo
    class Controller {
        public function __construct() { 
            $this->views = new Views(); // Se accede a la clase Views
            $this->cargarModel(); //llama a la función cargarModel
        }
        public function cargarModel() { 
            //trae el nombre de archivo de la carpeta Models
            //obteniendo con get_class el nombre del controlador y concatenarlo a Model
            $model = get_class($this)."Model"; 
            $ruta = "Models/".$model.".php";
            if (file_exists($ruta)){
                require_once $ruta;
                $this->model = new $model();
            }
        }
    }
?>