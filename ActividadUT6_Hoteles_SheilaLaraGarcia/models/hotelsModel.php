<?php

// Requerimiento del archivo que contiene la conexión a la base de datos
require_once $_SERVER['DOCUMENT_ROOT'] . '/ActividadUT6_Hoteles_SheilaLaraGarcia/db/db.php';

// Clase que representa el modelo de los hoteles
class hotelsModel{
    
    // Propiedades privadas para la conexión a la base de datos
    private $db;
    private $pdo;
    
    public function __construct() {
        $this->db = new DB();               // Instancia de la clase de la conexión a la base de datos
        $this->pdo = $this->db->getPDO();   // Objeto PDO para realizar operaciones en la base de datos
    }
    
    /**
     * Obtiene la información de todos los hoteles
     * 
     * Esta función realiza una consulta SQL para recuperar la información 
     * de todos los hoteles de la base de datos
     * 
     * @return array    Retorna un array asociativo con la inforamcion de todos los hoteles.
     *                  Cada elemento del array representa un hotel y contiene todos los campos
     *                  presentes de la tabla 'hoteles'
     */
    
    public function getAllHotels() {
        // Prepara la consulta SQL para obtener la información de todos los hoteles
        $stmt = $this->pdo->prepare("SELECT * FROM hoteles;");
        
        // Ejecuta la consulta para obtener los hoteles
        $stmt->execute();
        
        // Devuelve todas las filas resultantes como un array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
