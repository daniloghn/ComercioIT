<?php
// funcion para cargar la pagina
function CargarPagina($page)
{
    if (isset($page)) {        
        include($page . ".php");
    } else {
        include 'inicio.php';
    }
}