<?php

// Clase que representa la vista para las habitaciones
class roomsViews{
    
    // Método que muestra la información de las habitaciones disponibles en un hotel
    public function showInfoRooms($rooms) {
        echo '<section class="text-center text-md-start section">'
        . '<h1 class="m-5 text-center display-3" id="h1__section">' . $rooms[0]['nombre'] . '</h1>'
        . '<h2 class="m-5 text-center display-4" id="h2__section">Habitaciones Disponibles</h2>'
        . '<div class="row row-cols-1 row-cols-md-2 g-4 mb-5">';
        
        // Itera sobre cada habitación y muestra una tarjeta por cada una
        foreach ($rooms as $room) {
            echo '<div class="col-sm-6">
                    <div class="card border-dark text-bg-light">
                        <div class="card-body">
                            <h3 class="card-title text-center"><strong>Habitación '.$room['num_habitacion'].'</strong></h3>
                            <p class="card-text"><strong class="card-strong">Precio/Noche: </strong>'.$room['precio'].'€</p>
                            <p class="card-text"><strong class="card-strong">Tipo: </strong>'.$room['tipo'].'</p>
                            <p class="card-text text-center">'.$room['descripcion'].'</p>
                            <div class="card-footer text-center">
                                 <a href="index.php?controller=booking&action=showFormBooking&idhotel='.$room['idhotel'].'&idhab='.$room['idhab'].'&num_habitacion='.$room['num_habitacion'].'&nombre='.$room['nombre'].'&precio='.$room['precio'].'&descripcion='.$room['descripcion'].'" class="btn btn-outline-success">Reservar</a>                              
                            </div>
                        </div>
                    </div>
                </div>';
        }
        echo '</div>'
        . '</section>';
    }
}