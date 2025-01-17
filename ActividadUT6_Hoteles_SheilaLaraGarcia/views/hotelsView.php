<?php

// Clase que reprenta la vista para los hoteles
class hotelsView {

    // Método que muestra todos los hoteles
    public function showAllHotels($hotels) {
        echo '<section class="text-center text-md-start section">'
        . '<h1 class="m-5 text-center display-3" id="h1__section">Hoteles</h1>'
        . '<div class="row row-cols-1 row-cols-md-2 g-4 mb-5">';
        
        //Itera cada hotel y muestra una tarjeta por cada uno
        foreach ($hotels as $hotel) {
            echo ' <div class="col">
                    <div class="card border-dark text-bg-light">
                        <img style="height: 400px" src="data:image/jpeg;base64,' . base64_encode($hotel['foto']) . '" class="card-img-top" alt='.$hotel['id'].'>
                        <div class="card-body">
                            <h2 class="card-title text-center">' . $hotel['nombre'] . '</h2>
                            <p class="card-text"><strong class="card-strong">Dirección: </strong>' . $hotel['direccion'] . ', ' . $hotel['ciudad'] . ' (' . $hotel['pais'] . ')</p>
                            <p class="card-text"><strong class="card-strong">Habitaciones Disponibles: </strong>' . $hotel['num_habitaciones'] . '</p>
                            <p class="card-text text-center">' . $hotel['descripcion'] . '</p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="index.php?controller=rooms&action=showRooms&idHotel='.$hotel['id'].'" class="btn btn-outline-dark">Habitaciones Disponibles</a>
                        </div>
                    </div>
                </div>';
        }
        echo '</div>'
        . '</section>';
    }    
}
