<?php
// Cerrar sesión y eliminar todas las variables de session
session_start();
session_unset();
session_destroy();
header('Location: ./');
