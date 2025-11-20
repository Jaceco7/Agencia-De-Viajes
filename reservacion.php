<?php 
include("codigo.php");
include("verificar.php");

// Conexión correcta
$conn = mysqli_connect("localhost", "root", "", "bd_agenciaViaje");

// Validar conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// ========================================================================
// OBTENER FECHA DEL VIAJE DEL USUARIO
// ========================================================================
$fechaSalida = "";

// Buscar el viaje del usuario usando id_codViaje (desde verificar.php)
$sql = "SELECT fecha FROM viajes WHERE codigoViaje = '$cod_v'";
$query = mysqli_query($conn, $sql);

if ($query && mysqli_num_rows($query) > 0) {
    $data = mysqli_fetch_assoc($query);
    $fechaSalida = $data["fecha"];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Sun Side🌞 Agencia de Viajes ✈</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">Sun Side 🌞</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav">
                <span class="oi oi-menu"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a href="perfilUser.php" class="nav-link text-dark">
                            <b><?php echo $nombreUser; ?></b>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link text-danger" href="#" data-toggle="modal" data-target="#logoutModal">
                            Cerrar sesión
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HEADER -->
    <div class="hero-wrap" style="background-image: url('images/bg_1.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 text-center ftco-animate">
            <h1 class="mb-3 bread pt-5">Reservación</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="container m-0 ">
        <div class="row">

            <!-- MENU LATERAL -->
            <div class="col-3 bg-dark">
                <div class="nav flex-column nav-pills">
                    <a class="nav-link" href="registro.php"><strong>Registrar Datos 📌</strong></a>
                    <a class="nav-link active"><strong>Reservación 🧳</strong></a>
                    <a class="nav-link" href="informe.php"><strong>Informes 📊</strong></a>
                    <a class="nav-link" href="perfilUser.php"><strong>Perfil 😎</strong></a>
                </div>
            </div>

            <!-- CONTENIDO INTERIOR -->
            <div class="col-9">
                <div class="p-4">

                    <!-- FORMULARIO -->
                    <h2>Reservación Para vuelo🧳</h2>
                    <hr>

                    <form action="codigo.php" method="post">
                        <div class="form-row">

                            <div class="form-group col-md-5">
                                <label>Código de reservación:</label>
                                <input type="text" name="codigoReservacion"
                                    class="text-success btn btn-lg bg-white font-weight-bold text-left"
                                    value="<?php echo mt_rand(250,3000); ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Fecha de la Reservación</label>
                                <input type="text" name="fecha" class="form-control"
                                    value="<?php echo $fechaSalida; ?>">
                            </div>

                            <div class="form-group col-md-12">
                                <label>Estado de la Reservación</label><br>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="estado" checked value="activa">
                                    <label class="form-check-label">Activa</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="estado" value="cancelada">
                                    <label class="form-check-label">Cancelada</label>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="cedViajero" value="<?php echo $IDUser; ?>">

                        <button type="submit" name="btn_add_reservacion"
                            class="btn btn-block btn-success py-3 px-5">
                            <strong>Registrar Reservación</strong>
                        </button>
                    </form>
                </div>

                <!-- LISTA RESERVAS -->
                <div class="p-4">
                    <h2>Sus Reservaciones 🏢</h2>
                    <hr>

                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Código Reservación</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                            // CONSULTA CORRECTA
                            $sql = "SELECT * FROM reservacion WHERE cedViajero='$IDUser'";
                            $consulta = mysqli_query($conn, $sql);

                            if ($consulta && mysqli_num_rows($consulta) > 0) {
                                while ($registro = mysqli_fetch_assoc($consulta)) {
                        ?>
                            <tr>
                                <td><?php echo $registro["codigoReservacion"]; ?></td>
                                <td><?php echo $registro["fecha"]; ?></td>
                                <td><?php echo $registro["estado"]; ?></td>
                            </tr>
                        <?php
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
