<?php
    require_once("php/connection.php");
    require_once("controller/ControllerExpediente.php");
    require_once("controller/ControllerDiagnostico.php");

    session_start();

    if(!isset($_SESSION['rol'])) {
        header('Location: index.php');
    } else {
        if ($_SESSION['rol'] != 3) {
        header('Location: index.php');
        }
    }

    $Paciente_ID = $_GET['paciente'];

    $expediente = new expediente();
    $diagnostico = new diagnostico();

    $create = $expediente->nuevo_expediente($Paciente_ID);
    $cargar_expediente = $expediente->cargar_datos($Paciente_ID);
    $id_expediente = $cargar_expediente[0]['ID'];
    $cargar_diagnostico = $diagnostico->select_diagnostico($id_expediente);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medico | Expediente médico</title></title>

    <!-- Fuentes de tipografia -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Noto+Sans:wght@300;400&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/fec945242f.js" crossorigin="anonymous"></script>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="resource/img/favicon.png">
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styleMain.css">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
        .themed-grid-col {
            padding-top: .75rem;
            padding-bottom: .75rem;
            background-color: rgba(86, 61, 124, .15);
            border: 2px solid rgba(86, 61, 124, .2);
        }

        .themed-container {
            padding: .75rem;
            margin-bottom: 1.5rem;
            background-color: rgba(0, 123, 255, .15);
            border: 1px solid rgba(0, 123, 255, .2);
        }

        .pricing-header {
            max-width: 700px;
        }
    </style>
</head>
<body>
    <!-- SVG -->
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="facebook" viewBox="0 0 16 16">
            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
        </symbol>
        <symbol id="instagram" viewBox="0 0 16 16">
            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
        </symbol>
        <symbol id="twitter" viewBox="0 0 16 16">
            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
        </symbol>
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
    </svg>

    <!-- Navegación de la página -->
    <header>
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="menu_recepcionista.php">
                    <img src="resource/img/favicon.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
                    Medical Control System
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="menu_medico.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="agenda_medica.php">Agenda médica</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="php/eliminarSesion.php">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- <div class="cover d-flex justify-content-end align-items-start p-5 flex-column" style="background-image: url(resource/img/img-8.jpg);">
            <h1>Mostrar expediente</h1>
            <p>Tus datos están a salvo.</p>
            <form action="agenda_medica.php">
                <button type="submit" class="btn btn-info"> Agendar médica</button>
            </form>
        </div> -->
    </header>

    <!-- Datos del expediente -->
    <section>
        <?php
            foreach ($cargar_expediente as $row) {
        ?>
            <div class="container mt-5 mb-2 pt-4">
                <div class="row">
                    <div class="col-sm-4 themed-grid-col bg-dark text-white">
                        <img src="resource/img/logo.png" class="img-fluid" alt="...">
                    </div>
                    <div class="col-sm-8 themed-grid-col bg-dark text-white text-center">
                        <h2 class="pt-3"><?php echo $row['Nombre'].' '.$row['Apellidos']; ?></h2> <!--text-uppercase-->
                        <h4 class="text-white">Expediente médico</h4><br>
                        <p class="lh-1 text-muted">El presente Aviso de Privacidad se pone a disposición del TITULAR, en cumplimiento a lo dispuesto por la Ley Federal de Protección de Datos Personales en posesión de los Particulares, así como demás disposiciones legales aplicables.</p>
                        <!-- Botones -->
                        <div class="d-flex pt-2 justify-content-center">
                            <form action="agenda_medica.php">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa-solid fa-angles-left sizeSimbol"></i>
                                    Regresar
                                </button>
                            </form>
                            <button type="button" class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="fa-solid fa-notes-medical sizeSimbol"></i>
                                Diagnóstico
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 themed-grid-col bg-dark text-white">
                        <h4 class="text-center">Datos del paciente</h4>
                    </div>
                </div>
                <!-- CURP -->
                <div class="row">
                    <div class="col-sm-4 themed-grid-col bg-dark text-white">
                        <h4>CURP</h4>
                    </div>
                    <div class="col-sm-8 themed-grid-col">
                        <h4 class=""><?php echo $row['CURP'];?></h4>
                    </div>
                </div>
                <!-- Fecha de nacimiento -->
                <div class="row">
                    <div class="col-sm-4 themed-grid-col bg-dark text-white">
                        <h4>Nacimiento</h4>
                    </div>
                    <div class="col-sm-8 themed-grid-col">
                        <h4 class=""><?php echo $row['Fecha_nacimiento'];?></h4>
                    </div>
                </div>
                <!-- Sexo -->
                <div class="row">
                    <div class="col-sm-4 themed-grid-col bg-dark text-white">
                        <h4>Sexo</h4>
                    </div>
                    <div class="col-sm-8 themed-grid-col">
                        <h4 class=""><?php echo $row['Sexo'];?></h4>
                    </div>
                </div>
                <!-- Teléfono -->
                <div class="row">
                    <div class="col-sm-4 themed-grid-col bg-dark text-white">
                        <h4>Teléfono</h4>
                    </div>
                    <div class="col-sm-8 themed-grid-col">
                        <h4 class=""><?php echo $row['Telefono'];?></h4>
                    </div>
                </div>
                <!-- Email -->
                <div class="row">
                    <div class="col-sm-4 themed-grid-col bg-dark text-white">
                        <h4>Correo</h4>
                    </div>
                    <div class="col-sm-8 themed-grid-col">
                        <h4 class=""><?php echo $row['Email'];?></h4>
                    </div>
                </div>
                <!-- Dirección -->
                <div class="row">
                    <div class="col-sm-4 themed-grid-col bg-dark text-white">
                        <h4>Dirección</h4>
                    </div>
                    <div class="col-sm-8 themed-grid-col">
                        <h4 class=""><?php echo $row['Direccion'];?></h4>
                    </div>
                </div>
            </div>
        <?php
            }
        ?>
    </section>
    <main class="container mt-5 mb-5">
        <div class="row row-cols-1 row-cols-md-12 mb-3 text-center">
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm border-dark">
                    <div class="card-header py-3 text-white bg-dark border-dark">
                        <h4 class="my-0 fw-normal">Enterprise</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">$29<small class="text-muted fw-light">/mo</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                        <li>30 users included</li>
                        <li>15 GB of storage</li>
                        <li>Phone and email support</li>
                        <li>Help center access</li>
                        </ul>
                        <button type="button" class="w-100 btn btn-lg btn-dark">Contact us</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Diagnostic Content -->
    <section>
        <div class="container mt-1 mb-5 col-8">
            <?php
             if ($cargar_diagnostico) {
                foreach ($cargar_diagnostico as $row) {
                    $ID = $row['ID'];
            ?>

                <div class="row justify-content-center">
                    <div class="col-10 border border-2 bg-dark text-white bg-gradient">
                        <h4 class="p-2">Diagnóstico</h4>
                    </div>
                    <div class="col-2 border border-2 bg-dark text-white bg-gradient">
                        <h4 class="p-2">Diagnóstico</h4>
                    </div>
                </div>
                <!-- Datos del diagnóstico -->
                <div class="row justify-content-center">
                    <div class="col-3 p-2 border border-2 bg-dark text-white bg-gradient">
                        <h5>Número</h5>
                    </div>
                    <div class="col-9 p-2 border border-2 bg-dark text-white bg-gradient">
                        <h5>Creación de expediente</h5>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-3 p-2 border border-2">
                        <p><?php echo $row['ID']; ?></p>
                    </div>
                    <div class="col-9 p-2 border border-2">
                        <p><?php echo $row['FechaTiempo_diagnostico'];?></p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 p-2 border border-2 text-center bg-dark text-white bg-gradient">
                        <h5>Medicación</h5>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 p-2 border border-2">
                        <p><?php echo $row['Medicacion']; ?></p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 p-2 border border-2 text-center bg-dark text-white bg-gradient">
                        <h5>Observaciones</h5>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 p-2 border border-2">
                        <p><?php echo $row['Observaciones']; ?></p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 p-2 border border-2 text-center bg-dark text-white bg-gradient">
                        <h5>Examen físico</h5>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 p-2 border border-2">
                        <p><?php echo $row['Examen_fisico']; ?></p>
                    </div>
                </div>
            <?php
                }
             } else {
            ?>
                <div class="alert alert-primary d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                    <div>
                    No se encuentran diagnósticos registrados en la base de datos.
                    </div>
                </div>
            <?php
             }
            ?>
        </div>
    </section>


    

    <!-- Footer -->
    <div class="container-fluid color-footer-g">
        <div class="container">
            <footer class="pt-5 pb-1">
                <div class="row">
                <div class="col-2">
                    <h5>Section</h5>
                    <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                    </ul>
                </div>
    
                <div class="col-2">
                    <h5>Section</h5>
                    <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                    </ul>
                </div>
    
                <div class="col-2">
                    <h5>Section</h5>
                    <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                    </ul>
                </div>
    
                <div class="col-4 offset-1">
                    <form>
                    <h5>Subscribe to our newsletter</h5>
                    <p>Monthly digest of whats new and exciting from us.</p>
                    <div class="d-flex w-100 gap-2">
                        <label for="newsletter1" class="visually-hidden">Email address</label>
                        <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                        <button class="btn btn-primary" type="button">Subscribe</button>
                    </div>
                    </form>
                </div>
                </div>
    
                <div class="d-flex justify-content-between py-4 my-4 border-top">
                <p>&copy; 2021 Company, Inc. All rights reserved.</p>
                <ul class="list-unstyled d-flex">
                    <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"/></svg></a></li>
                    <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"/></svg></a></li>
                    <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"/></svg></a></li>
                </ul>
                </div>
            </footer>
        </div>
    </div>

    <!-- Funciones paciente y alerta -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="js/funDiagnostico.js"></script>
    <!-- Bootstrap JS JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>