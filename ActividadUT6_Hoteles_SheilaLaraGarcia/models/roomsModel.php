<?php

// Requerimiento del archivo que contiene la conexión a la base de datos
require_once $_SERVER['DOCUMENT_ROOT'] . '/ActividadUT6_Hoteles_SheilaLaraGarcia/db/db.php';

// Clase que representa el modelo de las habitaciones
class roomsModel{
    
    // Propiedades privadas para la conexión a la base de datos
    private $db;
    private $pdo;
    
    public function __construct() {
        $this->db = new DB();               // Instancia de la clase de la conexión a la base de datos
        $this->pdo = $this->db->getPDO();   // Objeto PDO para realizar operaciones en la base de datos
    }
    
    /**
     * Obtiene la información de las habitaciones de un hotel específico
     * 
     * Esta función realiza una consulta SQL para obtenes la información 
     * de las habitaciones de un hotel específico mediante su identificador (ID)
     * 
     * @return array    Retorna un array asociativo con la información de las habitaciones del hotel.
     *                  Cada elemento del array representa una habitación.
     */
    
    public function getRooms() {
        // Prepara la consulta SQL para obtener información de las habitaciones del hotel
        $stmt = $this->pdo->prepare("SELECT HO.id AS idhotel, HO.nombre, HA.id AS idhab, HA.num_habitacion, HA.tipo, HA.precio, HA.descripcion
                                    FROM hoteles HO JOIN habitaciones HA
                                    ON (HO.id = HA.id_hotel)
                                    WHERE HO.id = ?;");
        
        // Ejecuta la consulta con el ID del hotel proporcionado por el cliente a través de $_GET
        $stmt->execute(array($_GET["idHotel"]));
        
        // Devuelve todas las filas resultantes como un array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

