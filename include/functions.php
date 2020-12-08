<?php
/**
 * Funcion para cargar la pagina
 * Por default retorna la pagina inicio.php
 * Si la pagina no existe retorna un Error 404
 */
function CargarPagina($page)
{
    if (isset($_GET["page"])) {
        $modulo =$_GET["page"] . ".php";       
        if (file_exists($modulo)) {
            $page = $_GET["page"];
        } else {
            $page = "404";
        }
    } else {
        $page = "inicio";
    }
    return include($page . ".php");    
}

/**
 * Funcion para mostrar mensajes de error custumizados con CSS
 */
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

/**
 * Funcion para mostrar el listado de productos
 * Toma el archivo llamado listadoProductos.csv en modo lectura
 * Devuelve en inicio los productos listados y su imagen
 */
function MostrarProductos()
{    
    $archivo = fopen("listadoProductos.csv", 'r');
    if ($archivo) {
        while ($datos = fgetcsv($archivo, 1000)) {
            ?>
            <div class="product-grid">
                <div class="content_box">
                    <a href="index?page=producto">
                        <div class="left-grid-view grid-view-left">
                            <img src="images/productos/<?php echo $datos[0]; ?>.jpg" class="img-responsive watch-right" alt=""/>
                        </div>
                    </a>
                    <h4><a href="#"><?php echo $datos[4] . " ". $datos[1] . " ". $datos[5]; ?></a></h4>
                    <p>Stock: <?php echo $datos[3]; ?></p>
                    <span>$<?php echo $datos[2]; ?></span>
                </div>
            </div>
            <?php
        }
    } else {
        echo "El archivo No se abrio";
    }
    fclose($archivo);
}

/**
 * Funcion para registrar un nuevo cliente
 * 1. Primero valida que el cliente existe con el correo electronico
 * 2. Si el cliente existe, envia un mensaje "La cuenta ya existe" y retorna un token con valor 0
 * 3. Si el cliente no existe, lo crea y genera un token de validacion de cuenta y retorna el valor del token
 */
function RegistroCliente($nombre, $apellido, $email, $pass)
{
    require 'include/connection.php';
    // Validar conexion por metodo POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recolexion de variables
        $nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null; //Importante incluir la funcion para que valide que no sea numero y que lo pase la primera letra a mayusculas ucwords 
        $apellido = isset($_REQUEST['apellido']) ? $_REQUEST['apellido'] : null; //Importante incluir la funcion para que valide que no sea numero y que lo pase la primera letra a mayusculas ucwords 
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null; //Importante validar que el formato sea de correo electronico filter_var($email, FILTER_VALIDATE_EMAIL)
        $pass = isset($_REQUEST['pass']) ? $_REQUEST['pass'] : null; //Importante validar que tenga por lo menos una letra mayuscula, un numero y un simbolo raro y que sea longitud entre 6 y 12 caracteres

        // Validacion de que él email existe
        $querySel = "SELECT * FROM clientes WHERE email = :email";
        $stmtSel = $pdo->prepare($querySel);
        $stmtSel->execute([
            'email' => $email
        ]);
        $resultadoSel = $stmtSel->rowCount();           
        if ($resultadoSel > 0) {
            echo "<p class='rta rta-0x007'>La cuenta ya existe</p>";
            return $token = 0;            
        } elseif ($resultadoSel == 0) {
            $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
            $date = new DateTime('', new DateTimeZone('America/Tegucigalpa'));
            $dateSignon = $date -> format('Y-m-d h:i:s');
            
            // Generacion del token
            $token = bin2hex(openssl_random_pseudo_bytes(16));

            // Preparacion de la consulta para insertar datos
            $queryIns = 'INSERT INTO clientes (nombre, apellido, email, password, date_signon, token, validado) VALUES (:nombre, :apellido, :email, :pass_hash, :dateSignon, :token, :validado)';
            $stmtIns = $pdo->prepare($queryIns);
            $stmtIns->execute([
                'nombre' => $nombre, 
                'apellido' => $apellido, 
                'email' => $email, 
                'pass_hash' => $pass_hash, 
                'dateSignon' => $dateSignon, 
                'token' => $token, 
                'validado' => 0
            ]);                
            echo "<p class='rta rta-0x008'>Te enviamos un correo a tu cuenta para validar que te pertenece</br>Si no esta en tu bandeja de entrada, rogamos revises en el SPAM</p>";
            return $token;            
        }
    }
    $stmtSel = null;
    $stmtIns = null;
    $pdo = null;
}

/**
 * Funcion para validar el token de un nuevo cliente
 * 1. Recibe el token y valida que por lo menos exista un cliente registrado con ese token
 * 2. Si el token existe, actualiza la cuenta del cliente en la base de datos con un validado = 1
 * 3. Redirecciona a la pagina ingreso.php
 * 3. Si el token no existe, envia un mensaje, notificando problemas con el link para que se comunique con el administrador
 */
function ValidacionEmail($token)
{
    require 'include/connection.php';
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // Recibe la variable $token para validar que la cuenta de correo existe
        $token = isset($_REQUEST['token']) ? $_REQUEST['token'] : null;
        
        $querySel = 'SELECT * FROM clientes WHERE token = :token';
        $stmtSel = $pdo->prepare($querySel);
        $stmtSel->execute([
            'token' => $token
        ]);
        $resultadoSel = $stmtSel->rowCount();        

        // Valida que realmente exista la cuenta con el token enviado
        if ($resultadoSel == 1) {
            $queryUp = "UPDATE clientes SET validado = '1' WHERE token = :token";
            $stmtUp = $pdo->prepare($queryUp);
            $stmtUp->execute([
                'token' => $token
            ]);
            header('Location: index?page=ingreso');                       
        } else {
            echo "<p class='rta rta-0x007'>Problemas con el link, comunicacte con el administrador</p>";            
        }        
    }
    $stmtUp = null;
    $stmtSel = null;
    $pdo = null;
}

/**
 * Funcion para hacer el proceso de ingreso a la plataforma
 * 1. Recibe por POST el email y la contraseña
 * 2. Valida que el usuario este activo, sino notifica que la cuenta no esta activa
 * 3. Valida que el password sea el correcto, sino notifica que las credenciales no son correctas
 * 4. Si las credenciales son correctas y el usuario esta activo crea la secion y lo redirecciona a la pagina de inicio. 
 */
function LoginUser($email, $password)
{
    require 'include/connection.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
        $password = isset($_REQUEST['pass']) ? $_REQUEST['pass'] : null;        
        $query = "SELECT nombre, apellido, password, validado FROM clientes WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'email' => $email,            
        ]);        
        $resultado = $stmt->fetch();
        if ($resultado['validado'] == '1') {
            if (password_verify($password, $resultado['password'])) {                
                $_SESSION['email'] = $email;
                $_SESSION['nombre'] = $resultado['nombre'];
                $_SESSION['apellido'] = $resultado['apellido'];
                $resultado = null;                                

                header('Location: index?page=inicio');
                die();
            } else {
                echo "<p class='rta rta-0x007'>Credenciales no validas</p>";                    
            }
        } else {
            echo "<p class='rta rta-0x007'>El usuario no ha sido validado</p>";            
        }
    }
    $stmt = null;
    $pdo = null;
}

/**
 * Funcion para realizar el logout del comercio
 * 1. Valida si el metodo es GET y si la variable $salir = 1
 * 2. Sino no hace nada
 * 3. Si es verdadero borra seciones, destruye la sesion y redirecciona a la pagina ingreso
 */
function LogOut($salir)
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $salir = isset($_REQUEST['logout']) ? $_REQUEST['logout'] : null;
        if ($salir == '1') {
            unset($_SESSION['email']);
            unset($_SESSION['nombre']);
            unset($_SESSION['apellido']);
            session_destroy();
            header('Location: index?page=ingreso');            
        }
    }
}