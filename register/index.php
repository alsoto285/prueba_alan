<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>Registro de usuario</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/checkout/">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

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
    </style>

    <style>
        .req {
            border: solid 1px red;
        }

        .valid {
            color: green;
        }

        .wrong {
            color: red;
        }

        .uppercase {
            text-transform: uppercase;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container">
        <main>
            <div class="py-5 text-center">
                <img class="d-block mx-auto mb-4" src="../assets/brand/avatar.png" alt="" width="72" height="57">
                <h2>Formulario de Registro</h2>
                <p class="lead">Por favor ingrese los datos que le requiere el formulario, todos los campos con un * son obligatorios y recuerda que debes ingresar un RFC valido</p>
            </div>

            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">



                </div>
                <div class="col-md-7 col-lg-12">
                    <h4 class="mb-3">Datos del Nuevo Usuario</h4>

                    <div class="needs-validation" novalidate>


                        <div class="row g-3">
                            <div class="col-sm-12 col-lg-6">
                                <label for="firstName" class="form-label">Nombre completo *</label>
                                <input type="text" class="form-control" id="name" placeholder="" value="" required>
                                <div>
                                    <strong style="color: red; " id="name_r" class="d-none"> Nombre es un campo requerido</strong>
                                </div>
                            </div>



                            <div class="col-sm-12 col-lg-6">
                                <label for="username" class="form-label">Telefono *</label>


                                <input type="text" class="form-control" id="telephone" placeholder=" 55 40 80 95 10" required>
                                <div>
                                    <strong style="color: red; " id="telephone_r" class="d-none"> Telefono es un campo requerido</strong>
                                </div>

                            </div>

                            <div class="col-sm-12 col-lg-6">
                                <label for="email" class="form-label">Correo * <span class="text-muted"></span></label>
                                <i class="fas fa-check fa-sm valid d-none" id="valid_1"></i>
                                <i class="fas fa-times fa-sm wrong d-none" id="wrong_1"></i>
                                <input type="email" class="form-control" id="email" placeholder="you@example.com" required>
                                <div>
                                    <strong style="color: red; " id="email_r" class="d-none"> Correo es un campo requerido</strong>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">

                                <label class="form-label" for="helperText">RFC *</label>
                                <i class="fas fa-check fa-sm valid d-none" id="valid"></i>
                                <i class="fas fa-times fa-sm wrong d-none" id="wrong"></i>
                                <input type="text" id="textRFC" maxlength="13" class="form-control uppercase" autocomplete="off" placeholder="SAS9010" required>
                                <div>
                                    <strong style="color: red; " id="rfc_r" class="d-none"> RFC es un campo requerido</strong>
                                </div>



                            </div>

                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <label class="form-label" for="login_password">Contraseña</label>

                                </div>
                                <div class="input-group input-group-merge form-password-toggle">
                                    <input class="form-control form-control-merge" id="password_1" type="password" name="login-password" placeholder="············" aria-describedby="login-password" tabindex="2"><span class="input-group-text cursor-pointer"><i class="fas fa-eye fa-sm" id="eye_1"></i></span>

                                </div>
                                <div>
                                    <strong style="color: red; " id="password_1_r" class="d-none"> contraseña es un campo requerido</strong>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <label class="form-label" for="login_password"> Confirmar </label>
                                    <i class="fas fa-check fa-sm valid d-none" id="valid_p"></i>
                                    <i class="fas fa-times fa-sm wrong d-none" id="wrong_p"></i>
                                </div>
                                <div class="input-group input-group-merge form-password-toggle">
                                    <input class="form-control form-control-merge" id="password_2" type="password" name="login-password" placeholder="············" aria-describedby="login-password" tabindex="2"><span class="input-group-text cursor-pointer"><i class="fas fa-eye fa-sm" id="eye_2"></i></span>

                                </div>
                                <div>
                                    <strong style="color: red; " id="password_2_r" class="d-none"> Confirmar Contraseña es un campo requerido</strong>
                                </div>
                            </div>


                           

                            <div class="col-12">
                                <label for="notas" class="form-label"> notas <span class="text-muted"></span></label>
                                <input type="text" class="form-control" id="notas">

                            </div>
                            <hr class="my-4">

                            <button class="w-100 btn btn-primary " id="aceptar">Continuar</button>
                            
                            <button class="w-100 btn btn-secondary " id="cancelar">Cancelar</button>
                        </div>

                    </div>
                </div>
        </main>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2022 ALAN Company </p>

        </footer>
    </div>

    <script src="../validate-rfc-master/dist/index.js"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../js/form_validation.js"></script>
</body>

</html>