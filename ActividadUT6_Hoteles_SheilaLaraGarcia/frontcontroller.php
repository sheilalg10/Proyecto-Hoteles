<?php

// Incluir modelos, vistas y controladores necesarios

include 'models/userModel.php';
include 'views/userView.php';
include 'controllers/userController.php';

include 'models/hotelsModel.php';
include 'views/hotelsView.php';
include 'controllers/hotelsController.php';

include 'models/roomsModel.php';
include 'views/roomsView.php';
include 'controllers/roomsController.php';

include 'models/bookingModel.php';
include 'views/bookingView.php';
include 'controllers/bookingController.php';

// Función que carga una acción en el controlador dado
function loadAction($controllerObjet){
    // Verifica si la acción está definida y que existe en el controlador
    if(isset($_GET['action']) && method_exists($controllerObjet, $_GET['action'])){        
        // Verifica la sesión del usuario
        controllerSession();
        
        // Si el controlador no es 'user', incluye el encabezado
        if($_GET['controller'] !== 'user'){
            include './views/templates/header.php';
        }
        
        // Ejecutar la acción en el controlador
        executeAction($controllerObjet, $_GET['action']);
    }else{
        // Si la acción no esta definida, ejecutar la acción por defecto
        executeAction($controllerObjet, ACCION_DEFECTO);
    }
}

// Función que carga un controlador
function loadController($nameController){
    $controller = $nameController . "Controller";
    
    // Verifica si la clase del controlador existe
    if(class_exists($controller)){
        return new $controller();
    }else{
        // Si la clase no existe, muestra un mensaje de error
        die("El controlador no existe");     
    }
}

//Función que maneja la sesión del usuario
function controllerSession(){
    // Verifica que el controlador es diferente a 'user' y que existen las variables de sesión
    if($_GET['controller'] != "user"){
        if(!isset($_SESSION['user']) || !isset($_SESSION['id'])){
            //Redirige a la página de inicio si no hay sesión
            header("Location: index.php");
        }
    }
    
    // Cierra la sesión si se envia el formulario de cierre de sesión
    if(isset($_POST['close_session'])){
    session_destroy();
    setcookie(session_name(),123, time() - 3600);
    header("Location: index.php");
}
}

// Función que ejecuta una acción en un controlador
function executeAction($controllerObjet,$action){
    $Action = $action;
    $controllerObjet->$Action();
}

// Iniciar sesión
session_start();

// Define acciones y controladores por defecto
define('ACCION_DEFECTO', 'showLogin');
define('CONTROLADOR_DEFECTO', 'user');

// Carga el controlador y ejecuta la acción correspondiente
if(isset($_GET['controller'])){
    $controller = loadController($_GET['controller']);
    
    loadAction($controller);
}else{
    $controller = loadController(CONTROLADOR_DEFECTO);
    loadAction($controller);
}
