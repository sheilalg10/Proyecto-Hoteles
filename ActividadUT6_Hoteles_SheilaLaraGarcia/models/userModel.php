<?php

// Requerimiento del archivo que contiene la conexión a la base de datos
require_once $_SERVER['DOCUMENT_ROOT'] . '/ActividadUT6_Hoteles_SheilaLaraGarcia/db/db.php';

// Clase que representa el modelo de los usuarios
class userModel{
    
    // Propiedades privadas para la conexión a la base de datos
    private $db;
    private $pdo;
    
    public function __construct() {
        $this->db  = new DB();              // Instancia de la clase de la conexión a la base de datos
        $this->pdo = $this->db->getPDO();   // Objeto PDO para realizar operaciones en la base de datos
    }
    
    /**
     * Función que verifica el acceso de un usuario
     * 
     * Esta función realiza una consulta a la base de datos para verificar
     * las credenciales proporcionadas por el usuario.
     * 
     * @param string $user  Nombre de usuario
     * @param string $password  Contraseña de usuario
     * 
     * @return array|bool   Retorna un array asociativo con la información del usuario
     *                      si las credenciales son validas. En caso contrario, retorna false.
     */
    
    public function accessUser($user,$password) {
        // Prepara la consulta SQL para obtener información del usuario        
        $stmt = $this->pdo->prepare("SELECT id, nombre, contraseña, rol 
                  FROM usuarios
                  WHERE nombre = ? AND contraseña = SHA2(?,256);");
        
        // Ejecuta la consulta con los parametros proporcionados
        $stmt->execute(array($user,$password));
        
        // Verifica si se encontró exactamente el registro en la base de datos
        if($stmt->rowCount() === 1){
            // Devuelve la información del usuario como un array asociativo            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            // Si no encuentra el registro, devuelve falso
            return false;
        }        
    }
}