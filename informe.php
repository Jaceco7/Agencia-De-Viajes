<?php 
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);
    include("verificar.php");
    include("conexion.php");
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
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" /> 
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">Sun Side 🌞</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="perfilUser.php" class="nav-link text-dark"><b><?php  echo "$nombreUser";?></b></a></li>
                    <li class="nav-item active"><a class="nav-link text-danger" href="#" data-toggle="modal" data-target="#logoutModal">Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Preparado para irte?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión
                    actual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="cerrar.php">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-wrap" style="background-image: url('images/bg_1.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text  align-items-center justify-content-center" data-scrollax-parent="true">
                <div class="col-md-9 text-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                    <h1 class="mb-3 bread pt-5" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Informe viajes</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container m-0">
        <div class="row">
            <div class="col-3 bg-dark">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link" href="registro.php"><strong>Registrar Datos 📌</strong></a>
                    <a class="nav-link" href="reservacion.php"><strong>Reservación 🧳</strong></a>
                    <a class="nav-link active" href="informe.php"><strong>Informes 📊</strong></a>
                    <a class="nav-link" href="perfilUser.php"><strong>Perfil 😎</strong></a>
                </div>
            </div>

            <div class="col-9">
                <div class="tab-content" id="v-pills-tabContent container">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel">

                        <div class="p-4">
                            <h2>Informe de sus viajes ✈</h2> <hr> 

                            <!-- Tabla viajes PRINCIPAL CORREGIDA -->
                            <?php
                                $sql = "SELECT * FROM viajes WHERE cedulaViajero ='$IDUser'";
                                $consulta = mysqli_query($conn, $sql);                       
                                if ($consulta) {
                                    $linea = mysqli_num_rows($consulta);
                                    echo "<table class='table table-bordered'>";
                                    echo "<thead class='bg-dark text-white'>";
                                    echo "<tr>";
                                    echo "<th>Código Viaje</th>";
                                    echo "<th>Cantidad Asientos</th>";
                                    echo "<th>Costo</th>";
                                    echo "<th>Fecha Salida</th>";
                                    echo "<th>Hora Viaje</th>";
                                    echo "<th>Código Origen</th>";
                                    echo "<th>Código Destino</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";

                                    if ($linea > 0) {
                                        while ($registro = mysqli_fetch_assoc($consulta)) {
                                            echo "<tr>";
                                            echo "<td>".$registro["codigoViaje"]."</td>";
                                            echo "<td>".$registro['numAsientos']."</td>";
                                            echo "<td>$ ".$registro['costo']."</td>";
                                            echo "<td>".$registro['fecha']."</td>";
                                            echo "<td>".$registro['hora']."</td>";
                                            echo "<td>".$registro['codigo_Origen']."</td>";
                                            echo "<td>".$registro['codigo_Destino']."</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='7' class='text-center'>No hay viajes registrados</td></tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                } else {
                                    echo "Error en la consulta viajes: ".mysqli_error($conn);
                                }
                            ?>

                            <!-- Tabla viajes SECUNDARIA (eliminada porque duplica información) -->
                            <?php
                                // Esta sección la puedes eliminar ya que duplica la información
                                // o mantenerla solo si necesitas mostrar viajes específicos por código
                                /*
                                if(isset($cod_v)) {
                                    $sql = "SELECT * FROM viajes WHERE codigoViaje = '$cod_v'";
                                    $consulta = mysqli_query($conn, $sql);
                                    if($consulta) {
                                        $linea = mysqli_num_rows($consulta);
                                        echo "<h4>Viaje Específico:</h4>";
                                        echo "<table class='table table-bordered'>";
                                        echo "<thead class='bg-dark text-white'>";
                                        echo "<tr>";
                                        echo "<th>Código Viaje</th>";
                                        echo "<th>Cantidad Asientos</th>";
                                        echo "<th>Costo</th>";
                                        echo "<th>Fecha Salida</th>";
                                        echo "<th>Hora Viaje</th>";
                                        echo "<th>Código Origen</th>";
                                        echo "<th>Código Destino</th>";
                                        echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody>";

                                        if ($linea > 0) {
                                            while ($registro = mysqli_fetch_assoc($consulta)) {
                                                echo "<tr>";
                                                echo "<td>".$registro["codigoViaje"]."</td>";
                                                echo "<td>".$registro['numAsientos']."</td>";
                                                echo "<td>$ ".$registro['costo']."</td>";
                                                echo "<td>".$registro['fecha']."</td>";
                                                echo "<td>".$registro['hora']."</td>";
                                                echo "<td>".$registro['codigo_Origen']."</td>";
                                                echo "<td>".$registro['codigo_Destino']."</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='7' class='text-center'>No se encontró el viaje específico</td></tr>";
                                        }
                                        echo "</tbody>";
                                        echo "</table>";
                                    } else {
                                        echo "Error en la consulta viajes: ".mysqli_error($conn);
                                    }
                                }
                                */
                            ?>

                        </div>  
                        <hr>
                        <div class="p-4">
                            <h2>Informe de la Reservación 🏢</h2> <hr> 
                            <!-- Tabla de reservacion  -->
                            <div class="container">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Código Reservación</th>
                                            <th scope="col">Fecha de Reservación</th>
                                            <th scope="col">Estado de la Reservación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql = "SELECT * FROM reservacion WHERE cedViajero ='$IDUser'";
                                        $consulta = mysqli_query($conn, $sql);
                                        if ($consulta) {
                                            $fila = mysqli_num_rows($consulta);
                                            if($fila > 0) {
                                                while($registro = mysqli_fetch_assoc($consulta)) {
                                                    echo "<tr>";
                                                    echo "<td>".$registro["codigoReservacion"]."</td>";
                                                    echo "<td>".$registro["fecha"]."</td>";
                                                    echo "<td>".$registro["estado"]."</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='3' class='text-center'>No hay reservaciones registradas</td></tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='3' class='text-center'>Error en la consulta reservaciones: ".mysqli_error($conn)."</td></tr>";
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!--Fin de la ventana principal -->
                </div>
            </div>
        </div>
    </div>

    <!-- <footer class="ftco-footer ftco-bg-dark ftco-section p-4" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>
                        Copyright &copy;
                        <script>document.write(new Date().getFullYear());</script>
                        All rights reserved Sun Side🌞 | The Project made <i class="icon-heart" aria-hidden="true"></i> by <a href="" target="_blank">M</a>
                    </p>
                </div>
            </div>
        </div>
    </footer> -->

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>

</body>
</html>