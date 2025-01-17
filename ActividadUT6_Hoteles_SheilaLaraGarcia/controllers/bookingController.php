<?php

// Clase que representa el controlador de las reservas
class bookingController {

    // Propiedades que almacenan instancias del modelo y la vista
    public function __construct() {
        $this->model = new bookingModel();  // Instancia del modelo de reservas
        $this->view = new bookingView();    // Instancia de la vista de reservas
    }

    // Método para mostrar todas las reservas
    public function showBookings() {
        // Obtiene todas las reservas del modelo
        $bookings = $this->model->getAllBookings();
        
        // Muestra todas las reservas en la vista
        $this->view->showAllBookings($bookings);
    }

    // Método para mostrar los detalles de una reserva específica
    public function DetailsBooking() {
        // Obtiene los detalles de la reserva del modelo
        $booking = $this->model->getDetailsBooking();
        
        // Muestra los detalles de la reserva en la vista
        $this->view->showDetailsBooking($booking);
    }

    // Método que muestra el formulario de reserva
    public function showFormBooking() {
        // Muestra el formulario de reserva de la vista
        $this->view->makeBooking();
    }

    // Método que realiza una reserva
    public function doBooking() {
        // Intenta realizar una reserva llamando al modelo
        $booking = $this->model->insertBooking();

        // Verifica el resultado de la reserva
        if ($booking === true) {
            // Si la reserva se realiza correctamente, redirige a la página de todas la reservas
            header("Location:index.php?controller=booking&action=showBookings");
        }else {
            // Si hay un error en la reserva, se vuelve a mostrar el formulario con un mensaje de error
            $this->view->makeBooking(true);
        }
    }
}
