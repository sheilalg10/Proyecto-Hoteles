<nav class="navbar navbar-expand-lg mb-4 bg-body-tertiary" id="navbar">
            <div class="container-fluid">
                <!-- Título del navbar -->
                <h2 class="navbar-brand" id="nav__titulo">Hoteles</h2>

                <!-- Contenido del navbar -->
                <div class="collapse navbar-collapse">
                    <!-- Lista de elementos de navegación -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <!-- Enlace a la página de inicio de hoteles -->
                            <a class="nav-link active" id="nav__link" aria-current="page" href="index.php?controller=hotels&action=showHotels">Inicio</a>
                        </li> 
                        <li class="nav-item">
                            <!-- Enlace a la página de reservas del usuario -->
                            <a class="nav-link" id="nav__link2" aria-current="page" href="index.php?controller=booking&action=showBookings">Mis Reservas</a>
                        </li>                 
                    </ul>
                    
                    <!-- Información del usuario y botón de cierre de sesión -->
                    <span class="navbar-text pe-3" id="navbar__text1">
                        <!-- Muestra la última visita del usuario -->
                        <strong class="nav__strong">Última visita: </strong>
                        <span>
                            <?php
                            if (isset($_COOKIE['lastvisit'])) {
                                echo $_COOKIE['lastvisit'];
                            }
                            ?>
                        </span>                        
                    </span>
                    <span class="navbar-text pe-3" id="navbar__text">
                        <!-- Muestra el nombre del usuario que ha iniciado sesión -->
                        <strong class="nav__strong">Usuario: </strong>
                        <span>
                            <?php
                            /**
                             * Muestra el usuario que ha iniciado sesion.
                             */
                            if (isset($_SESSION['user'])) {
                                echo $_SESSION['user'];
                            }
                            ?>
                        </span>                        
                    </span>
                    <form method="POST">
                        <!-- Botón para cerrar la sesión del usuario -->
                        <button class="btn btn-outline-danger me-4" name="close_session" type="submit">Cerrar Sesión</button>  
                    </form>                                          
                </div>
            </div>
        </nav>
