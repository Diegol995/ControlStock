<?php
    require_once "Config/Config.php"; // se llama a Config.php que tiene la ruta raíz
    //Si existe la url, que la traiga, de lo contrario trae "home/index" por defecto
    $ruta = !empty($_GET['url']) ? $_GET['url'] : "home/index";
    $array = explode("/", $ruta); //se convierte $ruta en un array
    $controller = $array[0];
    $method = "index";
    $parametro = "";
    if (!empty($array[1]) && !empty($array[1]) != "") //validación de $method
    {
        $method = $array[1]; //toma lo que hay en la posición 1
    }
    if (!empty($array[2]) && !empty($array[2]) != "") //validación de $parametro
    {
        for($i = 2; $i<count($array); $i++)
        {
            $parametro .= $array[$i] . ","; //toma lo que hay en la posición 2 en adelante
        }
        $parametro = trim($parametro, ","); //elimina la coma del final
    }
    //Se llama a autoload para ir cargando las clases
    require_once "Config/App/autoload.php";
    $dirControllers = "Controllers/".$controller.".php"; //Guardo la ruta del controlador
    if (file_exists($dirControllers)) //validación de $dirControllers
    {
        require_once $dirControllers;
        $controller = new $controller();
        if (method_exists($controller,$method)) //se valida si existe el método dentro del controlador
        {
            $controller->$method($parametro); //Si existe, se llama al method junto con el parametro que posea
        } else {
            header('Location: '.base_url.'Errors');
        }
    }else {
        header('Location: '.base_url.'Errors');
    }
?>