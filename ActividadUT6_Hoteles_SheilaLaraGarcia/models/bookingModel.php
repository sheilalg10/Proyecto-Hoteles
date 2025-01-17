<?php

// Requerimiento del archivo que contiene la conexión a la base de datos
require_once $_SERVER['DOCUMENT_ROOT'] . '/ActividadUT6_Hoteles_SheilaLaraGarcia/db/db.php';

// Clase que representa el modelo de las reservas
class bookingModel{
    
    // Propiedades privadas para la conexión a la base de datos
    private $db;
    private $pdo;
    
    public function __construct() {
        $this->db = new DB();               // Instancia de la clase de la conexión a la base de datos
        $this->pdo = $this->db->getPDO();   // Objeto PDO para realizar operaciones en la base de datos
    }
    
    /**
     * Obtiene la información de todas las reservas de un usuario
     * 
     * Esta función realiza una consulta SQL que recupera la información
     * de las reservas de un usuario identifiacado por su ID de sesión.
     * 
     * @return array    Retorna un array asociativo con la inforamción de las reservas.
     *                  Cada elemento del array representa una reserva.
     *                  Las reservas ser ordenan por fecha de entrada en orden descendente.
     */
    
    public function getAllBookings() {
        // Prepara la consulta SQL para obtener la información de las reservas del usuario actual
        $stmt = $this->pdo->prepare("SELECT H.nombre, HA.num_habitacion, R.id, HA.precio, R.fecha_entrada, R.fecha_salida
                                    FROM reservas R JOIN usuarios U
                                    ON (R.id_usuario = U.id) JOIN hoteles H
                                    ON (R.id_hotel = H.id) JOIN habitaciones HA
                                    ON (R.id_habitacion = HA.id)
                                    WHERE R.id_usuario = ?
                                    ORDER BY R.fecha_entrada DESC;");
        
        // Ejecuta la consulta con el ID de usuario alamcenado en la sesión
        $stmt->execute(array($_SESSION['id']));
        
        // Devuelve todas las filas resultantes como un array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);;
    }
    
    /**
     * Obtiene los detalles de una reserva específica
     * 
     * Esta función realiza una consulta SQL para recuperar los detalles de una reserva
     * identifiacada por su ID.
     * 
     * @return array|bool   Retorna un array asociativo con los detalles de la reserva si existe.
     *                      En caso contrario, retorna false.
     */
    
    public function getDetailsBooking() {
        // Prepara la consulta SQL para obtener los detalles de la reserva
        $stmt = $this->pdo->prepare("SELECT H.nombre, H.foto, HA.num_habitacion, HA.tipo, HA.descripcion, HA.precio, R.fecha_entrada, R.fecha_salida, 
                                    DATEDIFF(R.fecha_salida , R.fecha_entrada) * HA.precio AS PRECIO_TOTAL, DATEDIFF(R.fecha_salida , R.fecha_entrada) AS DIAS_TOTALES
                                    FROM reservas R JOIN usuarios U
                                    ON (R.id_usuario = U.id) JOIN hoteles H
                                    ON (R.id_hotel = H.id) JOIN habitaciones HA
                                    ON (R.id_habitacion = HA.id)
                                    WHERE R.id = ?;");
        
        // Ejecuta la consulta con el ID de la reserva proporcionado por el cliente a través de $_GET
        $stmt->execute(array($_GET['idbook']));
        
        // Devuelve los detalles de la reserva como array asociativo o false si no encuentra la reserva
        return $stmt->fetch(PDO::FETCH_ASSOC);        
    }
    
    /**
     * Inserta un nueva reserva en la base de datos
     * 
     * Esta función realiza una inserción en la tabla 'reservas' con la información
     * proporcionada por el usuario.
     * 
     * @return bool Retorna true si la reserva se inserta con exito o false si hay algún error
     */
    
    public function insertBooking() {
        // Prepara la consulta SQL para insertar una nueva reserva
        $stmt = $this->pdo->prepare("INSERT INTO reservas (id, id_usuario, id_hotel, id_habitacion, fecha_entrada, fecha_salida)
                                    VALUES (NULL,?,?,?,?,?);");
        
        // Obtener la fecha actual
        $fechaActual = date('d-m-Y');
        
        // Verifica que las fechas son validas y cumplen las condiciones
        if(strtotime($_POST["fecha_entrada"]) <= strtotime($_POST["fecha_salida"])
            && strtotime($_POST["fecha_entrada"]) >= strtotime($fechaActual) && strtotime($_POST["fecha_salida"]) >= strtotime($fechaActual)){
            // Ejecuta la consulta con los valores proporcionados
            $stmt->execute(array($_SESSION['id'],$_GET['idhotel'],$_GET['idhab'],$_POST['fecha_entrada'],$_POST['fecha_salida']));
            return true;
        }else{
            return false;
        }                       
    }
}

