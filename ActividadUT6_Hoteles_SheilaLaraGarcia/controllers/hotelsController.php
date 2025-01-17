<?php

// Clase que representa el controlador para los hoteles
class hotelsController{
    
    // Propiedades que almacenan instancias del modelo y la vista
    public function __construct() {
        $this->model = new hotelsModel();   // Instancia del modelo de hoteles
        $this->view = new hotelsView();     // Instancia de la vista de hoteles
    }
    
    // Método que muestra todos los hoteles
    public function showHotels() {
        // Obtiene todos los hoteles del modelo
        $allHotels = $this->model->getAllHotels();
        
        // Muestra todos los hoteles en la vista
        $this->view->showAllHotels($allHotels);
    }       
}

