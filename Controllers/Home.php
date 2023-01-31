<?php
    class Home extends Controller { //hereda de la clase Controller y a raíz de eso también se accede a la vista

        public function __construct()
        {
            session_start();
            //Si existe una sesión activa se reedirecciona al panel de Usuarios
            if (!empty($_SESSION['activo'])){
                header("location: ".base_url."Usuarios/");
            }
            parent::__construct();
        }

        public function index() {
            $this->views->getView($this, "index"); //llama al método get_views() de la clase Views pasandole el controlador Home
        }
    }
?>