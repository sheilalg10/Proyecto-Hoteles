<?php

// Clase que representa el controlador para el usuario
class userController{    
    
    // Propiedades que almacenan instancias del modelo y la vista
    public function __construct() {
        $this->userModel = new userModel(); //Instancia del modelo de usuario
        $this->userView = new userView(); //Instancia de la vista de usuario
    }
    
    // Método que controla las cookies del usuario
    public function controlCookies() {
        // Verifica si existen las cookies de usuario y contraseña y si existen borrarlas
        if(isset($_COOKIE['user'])){
            setcookie('user',0,time() + 3600*24, "/");            
        }if(isset($_COOKIE['password'])){
            setcookie('password',0,time() + 3600*24, "/");
        }
        
        // Obtiene la hora actual y establece la cookie 'lastvisit' con la hora
        $date = date("H:i");
        setcookie("lastvisit", $date, time() + 3600 * 24);
        
        // Establece las cookies usuario y contraseña con los valores del formulario por un día
        setcookie('user',$_POST['user'],time() + 3600*24, "/");
        setcookie('user',$_POST['password'],time() + 3600*24, "/");
    }
    
    // Método que controla las sesiones del usuario
    public function controlSessions($nombre,$id) {
        //Variables de sesión del nombre del usuario y del ID del usuario
        $_SESSION['user'] = $nombre;
        $_SESSION['id'] = $id;
    }
    
    // Método que muestra la vista de inicio de sesión
    public function showLogin() {
        //Muestra la vista de inicio de sesión
        $this->userView->showLogin();
    }
    
    // Método que muestra la vista de error de inicio de sesión
    public function showErrorLogin() {
        // Muestra la vista de inicio de sesión con un indicador de error
        $this->userView->showLogin(true);
    }
    
    //Método para controlar el acceso del usuario
    public function controlUser() {
        // Obtiene la información del usuario llamando al modelo
        $user = $this->userModel->accessUser($_POST['user'], $_POST['password']);
        
        // Verifica si el acceso es correcto o fallido        
        if($user === false){
            //Si el acceso es fallido, redirige a la pagina de inicio de sesión con un mensaje de error
            header("Location:index.php?controller=user&action=showErrorLogin");
        }else{
            // Si el acceso es correcto, controla las cookies y sesiones y redirige a la página de hoteles
            $this->controlCookies();
            $this->controlSessions($user['nombre'], $user['id']);
            
            header("Location:index.php?controller=hotels&action=showHotels");
        }
    }    
}
