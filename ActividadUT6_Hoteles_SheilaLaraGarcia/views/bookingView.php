<?php

// Clase que representa la vista para las reservas
class bookingView {

    // Método que muestra todas las reservas
    public function showAllBookings($bookings) {
        echo '<section class="text-center text-md-start section">'
        . '<h1 class="m-5 text-center display-3" id="h1__section">Reservas</h1>'
        . '<table class="table text-center table-striped table-hover">'
        . '<thead>'
        . '<tr class="table-dark table__tr">'
        . '<th class="table__th" scope="col">Hotel</th>'
        . '<th class="table__th" scope="col">Habitación</th>'
        . '<th class="table__th" scope="col">Precio/Día</th>'
        . '<th class="table__th" scope="col">Fecha Entrada</th>'
        . '<th class="table__th" scope="col">Fecha Salida</th>'
        . '<th class="table__th" scope="col">Detalles Reserva</th>'
        . '</tr>'
        . '</thead>'
        . '<tbody>';
        foreach ($bookings as $booking) {
            echo '<tr class="table__tr">'
            . '<td class="table__td">' . $booking['nombre'] . '</td>'
            . '<td class="table__td">' . $booking['num_habitacion'] . '</td>'
            . '<td class="table__td">' . $booking['precio'] . ' €</td>'
            . '<td class="table__td">' . $booking['fecha_entrada'] . '</td>'
            . '<td class="table__td">' . $booking['fecha_salida'] . '</td>'
            . '<td class="table__td"><a href="index.php?controller=booking&action=DetailsBooking&idbook=' . $booking['id'] . '" class="btn btn-primary">Más Información</a></td>'
            . '</tr>';
        }
        echo '</tbody>'
        . '</table>'
        . '</section>';
    }

    // Método que muestra los detalles de una reservas específica
    public function showDetailsBooking($booking) {
        echo '<section class="text-center text-md-start d-flex justify-content-center section">
            <div class="card mb-3" style="max-width: 800px;">
                <div class="row g-0">
                    <div class="col-md-5">
                        <img style="height: 100%" src="data:image/jpeg;base64,' . base64_encode($booking['foto']) . '" class="img-fluid rounded-start" alt="...">
                    </div>        
                    <div class="col-md-7">
                        <div class="card-body">
                            <h1 class="card-title text-center">' . $booking['nombre'] . '</h1>
                            <p class="card-text"><strong class="card-strong" >Habitación ' . $booking['num_habitacion'] . '</strong></p>
                            <p class="card-text"><strong class="card-strong">Tipo: </strong>' . $booking['tipo'] . '</p>
                            <p class="card-text"><strong class="card-strong">Precio/Dia: </strong>' . $booking['precio'] . ' €</p>
                            <p class="card-text"><strong class="card-strong">Precio Total: </strong>' . $booking['PRECIO_TOTAL'] . ' €</p>
                            <p class="card-text"><strong class="card-strong">' . $booking['descripcion'] . '</strong></p>
                            <table class="table text-center table-striped table-hover">
                                <thead>
                                <tr class="table-dark table__tr">
                                <th scope="col">DESDE</th>
                                <th scope="col"></th>
                                <th scope="col">HASTA</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                <td>' . $booking['fecha_entrada'] . '</td>
                                <td></td>
                                <td>' . $booking['fecha_salida'] . '</td>
                                </tr>
                                <tr>
                                <td colspan="3"><strong class="card-strong">Días Totales: </strong>' . $booking['DIAS_TOTALES'] . '</td>
                                </tr>
                                </tbody>
                            </table>                                                                                            
                            <a href="index.php?controller=booking&action=showBookings" class="btn btn-primary mt-3 text-center">Ir a Reservas</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>';
    }

    // Método que muestra el formulario de reserva
    public function makeBooking($confirm = false) {
        echo '<section class="text-center text-md-start d-flex justify-content-center section">'
        . '<div class="card">
                        <div class="card-header">
                            <h1 class="m-5 text-center display-3">' . $_GET['nombre'] . '</h1>
                            <div class="m-5 div__section">
                                <p class="text-start display-5">Habitación ' . $_GET['num_habitacion'] . '
                                <p class="text-start display-5">Precio/Noche: ' . $_GET['precio'] . ' €<p>
                                <p class="card-text text-center"><strong>' . $_GET['descripcion'] . '</strong></p>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="index.php?controller=booking&action=doBooking&idhotel=' . $_GET['idhotel'] . '&idhab=' . $_GET['idhab'] . '&nombre=' . $_GET['nombre'] . '&precio=' . $_GET['precio'] . '&descripcion=' . $_GET['descripcion'] . '&num_habitacion=' . $_GET['num_habitacion'] . '">
                                <div class="mb-3">
                                    <label for="exampleInputEntrada" class="form-label">Fecha Entrada</label>
                                    <input type="date" name="fecha_entrada" class="form-control" id="exampleInputEntrada" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputSalida" class="form-label">Fecha Salida</label>
                                    <input type="date" name="fecha_salida" class="form-control" id="exampleInputSalida" required>
                                </div>
                                <button type="submit" class="btn btn-success">Reservar</button>                                           
                            </form>
                        </div>
        </div>                                   
        </section>';
        
        // Muestra un mensaje de error si el parametro $confirm es true
        if($confirm === true){
            echo '<div class="d-flex justify-content-center">
                    <div class="alert alert-danger d-grid gap-2 col-3 m-4 text-center" role="alert">
                        Datos incorrectos.
                    </div>
                </div>';
        }
        
    }
}
