<?php
/* funcion para cargar la pagina */
function CargarPagina($page)
{
    if (isset($page)) {        
        include($page . ".php");
    } else {
        include 'inicio.php';
    }
}

/* funcion mensaje de error contacto */
function MostrarMensaje($rta)
{
    switch ($rta) {
        case '0x001':
            echo "<p class='rta rta-0x001'>El nombre ingresado no es válido</p>";
            break;
        case '0x002':
            echo "<p class='rta rta-0x002'>El email ingresado no es válido</p>";
            break;
        case '0x003':
            echo "<p class='rta rta-0x003'>El mensaje ingresado no es válido</p>";
            break;
        case '0x004':
            echo "<p class='rta rta-0x004'>La consulta fue enviada</p>";
            break;
        case '0x005':
            echo "<p class='rta rta-0x005'>La consulta no fue enviada</p>";
            break;
    }
}