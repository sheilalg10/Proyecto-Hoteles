<?php

// Clase que representa el controlador para las habitaciones
class roomsController{
    
    // Propiedades que almacenan instancias del modelo y la vista
    public function __construct() {
        $this->model = new roomsModel();    // Instancia del modelo de las habitaciones
        $this->view = new roomsViews();     // Instancia de la vista de las habitaciones
    }
    
    // Método que muestra las habitaciones
    public function showRooms() {
        // Obtiene todas las habitaciones del modelo
        $rooms = $this->model->getRooms();
        
        // Muestra todas las habitaciones en la vista
        $this->view->showInfoRooms($rooms);
    }
}

