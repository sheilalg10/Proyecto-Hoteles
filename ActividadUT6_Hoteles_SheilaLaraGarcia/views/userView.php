<?php

// Clase que representa la vista para el inicio de sesión
class userView {

    // Método que muestra el formulario de inicio de sesión
    public function showLogin($access = false) {
        ?>
        <div class="wrapper">
            <form method="POST" action="index.php?controller=user&action=controlUser">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="text" name="user" id="user" placeholder="Usuario" required>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                        </svg>
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="password" placeholder="Contraseña" required>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                        </svg>
                </div>
                <button type="submit" class="button">Iniciar Sesión</button>
            </form>
        </div>
        <?php
        
        // Si el parametro $access es true, se muestra un mensaje de error
        if ($access === true) {
            echo '<div class="d-flex justify-content-center">
                    <div class="alert alert-danger d-grid gap-2 col-3 m-4 text-center" role="alert">
                        Usuario o contraseña incorrecto
                    </div>
                </div>';
        }
    }
}
