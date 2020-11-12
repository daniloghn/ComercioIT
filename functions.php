<?php
/* funcion para cargar la pagina */
function CargarPagina($page)
{
    return include($page . ".php");    
}

/* funcion mensaje de error contacto */
function MostrarMensaje($rta)
{
    switch ($rta) {
        case '0x001':
            $mensaje = "El nombre ingresado no es valido";            
            break;
        case '0x002':
            $mensaje = "El email ingresado no es valido";
            break;
        case '0x003':
            $mensaje = "El mensaje ingresado no es valido";
            break;
        case '0x004':
            $mensaje = "La consulta fue enviada";
            break;
        case '0x005':
            $mensaje = "La consulta NO fue enviada";
            break;
    }    
    return "<p class='rta rta-". $rta . "'>" . $mensaje . "</p>";
}

/*funcion para Mostrar Productos*/

function MostrarProductos()
{
    $archivo = "listadoProductos.csv";
    $fp = fopen($archivo, 'r');
    $flag = false;
    $encabezado = array();

    while ($linea = fgetcsv($fp)) {
        if (!$flag) {
            $encabezado = $linea;
            $flag = true;
        }
        var_dump($linea);
    }
    fclose($fp);
}