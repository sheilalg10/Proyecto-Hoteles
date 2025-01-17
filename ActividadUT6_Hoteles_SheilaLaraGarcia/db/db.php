<?php

// Clase que representa la conexión a la base de datos
class db {
    
    // Propiedad privada que almacena la instancia de PDO
    private $pdo;

    // Constructor de la clase
    public function __construct() {
        // Incluir el archivo config con los datos de de base de datos
        require $_SERVER['DOCUMENT_ROOT'] . '/ActividadUT6_Hoteles_SheilaLaraGarcia/config/config.php';
        
        try {
            // Intenta establecer la conexión a la base de datos utilizando PDO
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $usuario, $pwd);
            
            // Establece el modo de eeror para manejar excepciones
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $ex) {
            //En caso de error en la conexión, muestra un mensaje de error
            echo '<div class="d-flex justify-content-center">
                    <div class="alert alert-warning d-grid gap-2 col-3 m-4 text-center" role="alert">
                        La página se encuentra en mantenimiento.
                    </div>
                </div>';
        }
    }

    // Método para obtener la instancia de PDO
    public function getPDO() {
        return $this->pdo;
    }
}
