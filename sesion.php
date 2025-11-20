<?php 
include_once 'conexion.php';
include_once 'codigo.php';

if(!isset($_SESSION)) {
    session_start();
}

/* ============================================================
   REGISTRO DE USUARIO
   ============================================================ */
if (isset($_POST['addlogin'])) {

    $nombreUsuario = $_POST['nombreUsuario'];
    $cedula = $_POST['cedula'];
    $contraseña = $_POST['pass'];
    $nombreUser = $_POST['nombr'];
    $rol_Usuario = $_POST['rol_Usuario'];
    $codigoViajero = $_POST['codViajero'];

    $sql = "INSERT INTO usuarios (cedulaUser, username, password, nombre, codViaje, rol_id, direccion, telefono)
      VALUES ('$cedula', '$nombreUsuario', '$contraseña', '$nombreUser', '$codigoViajero', 2, '', '')";
    $consulta = mysqli_query($conn, $sql);

    mysqli_query($conn, "INSERT INTO viajero (cedula, nombre, direccion, telefono) VALUES ('$cedula', '$nombreUser', '', '')");
    mysqli_query($conn, "INSERT INTO destino (cedulaViajero, codigoDestino, nombreDestino, datosDestino) VALUES ('$cedula', '$codigoViajero', 'Pendiente', 'Sin datos')");
    mysqli_query($conn, "INSERT INTO origen (cedulaViajero, codigoOrigen, nombreOrigen, datosOrigen) VALUES ('$cedula', '$codigoViajero', 'Pendiente', 'Sin datos')");


    if ($consulta) {
        ?>
        <script>
            alert("Registro completado correctamente.");
            window.location = "login.php";
        </script>
        <?php
        exit();
    } else {
        ?>
        <script>
            alert("Error al registrar. Verifique los datos.");
            window.location = "registroUser.php";
        </script>
        <?php
        exit();
    }
}



/* ============================================================
   LOGIN DE ADMIN Y USUARIO
   ============================================================ */
if (isset($_POST['login'])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    /* ---------- ADMIN ---------- */
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {

        $admin = mysqli_fetch_assoc($result);

        $_SESSION["rol"] = 1;
        $_SESSION["id"] = $admin["id"];
        $_SESSION["id_username"] = $admin["username"];
        $_SESSION["id_nombre"] = $admin["nombre"];

        // datos vacíos porque admin no usa estos campos
        $_SESSION["id_cedulaUser"] = '';
        $_SESSION["id_codViaje"] = '';
        $_SESSION["id_direccion"] = '';
        $_SESSION["id_telefono"] = '';
        $_SESSION["id_pass"] = '';

        header("Location: dashboards/index.php");
        exit();
    }

    /* ---------- USUARIO NORMAL ---------- */
    // CORRECCIÓN: Cambiar 'passwor' por 'password'
    $sql = "SELECT * FROM usuarios WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {

        $u = mysqli_fetch_assoc($result);

        $_SESSION["rol"]            = $u["rol_id"];
        $_SESSION["id"]             = $u["id"];
        $_SESSION["id_username"]    = $u["username"];
        $_SESSION["id_nombre"]      = $u["nombre"];
        $_SESSION["id_cedulaUser"]  = $u["cedulaUser"];
        $_SESSION["id_codViaje"]    = $u["codViaje"];
        $_SESSION["id_direccion"]   = $u["direccion"] ?? '';
        $_SESSION["id_telefono"]    = $u["telefono"] ?? '';
        $_SESSION["id_pass"]        = $u["password"];

        header("Location: registro.php");
        exit();
    }

    /* ---------- SI NO EXISTE ---------- */
    ?>
    <script>
        alert("⚠ Usuario o contraseña incorrectos ⚠");
        window.location="login.php";
    </script>
    <?php
    exit();
}




/* ============================================================
   CHECKOUT VIAJE 1
   ============================================================ */
if (isset($_POST['btn_checkout'])) {  

    $precioTotal = $_POST["precioTotal"];
    $codX = $_POST["codX"];
    $telf = $_POST["telf"];
    $address = $_POST["address"];
    $username = $_POST["usernamex"];

    mysqli_query($conn, "UPDATE viajes SET costoViaje='$precioTotal' WHERE codigoViaje='$codX'");
    mysqli_query($conn, "UPDATE usuarios SET direccion='$address', telefono='$telf' WHERE username='$username'");

     $result = mysqli_query($conn, "SELECT cedulaUser FROM usuarios WHERE username='$username'");
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $cedula = $row['cedulaUser'];
        mysqli_query($conn, "UPDATE viajero SET direccion='$address', telefono='$telf' WHERE cedula='$cedula'");
    }

    header('Location: informe.php');
    exit();
}



/* ============================================================
   CHECKOUT VIAJE 2
   ============================================================ */
if (isset($_POST['btn_checkout2'])) {  

    $priceTotal = $_POST["priceTotal"];
    $codiV = $_POST["codiV"];

    mysqli_query($conn, "UPDATE viajes SET costo_Viaje='$priceTotal' WHERE codigo_Viaje='$codiV'");

    header('Location: informe.php');
    exit();
}

if (isset($_POST['btn_add_reservacion'])) {
    $codigoReservacion = $_POST['codigoReservacion'];
    $fechaReservacion = $_POST['fechaReservacion'];
    $estado = $_POST['estado'];
    $ced_Usuario = $_SESSION['id_cedulaUser']; // siempre usa la sesión

    $sql = "INSERT INTO reservacion (cedViajero, codigoReservacion, fecha, estado) 
            VALUES ('$ced_Usuario', '$codigoReservacion', '$fechaReservacion', '$estado')";
    mysqli_query($conn, $sql);

    header('Location: reservacion.php');
    exit();
}
?>