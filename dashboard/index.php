<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.87.0">
  <title>Dashboard</title>


  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/vendors.min.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/forms/select/select2.min.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css">
  <link href="https://unpkg.com/filepond@4.30.3/dist/filepond.min.css" rel="stylesheet" />
  <link href="https://unpkg.com/filepond-plugin-image-preview@4.6.10/dist/filepond-plugin-image-preview.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js"></script>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
  <script src="../app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
  <script src="../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
  <script src="../app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js"></script>
  <script src="../app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
  <script src="../app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
  <script src="../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
  <script src="../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
  <script src="../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
  <script src="../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
  <script src="../app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
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
  <link href="dashboard.css" rel="stylesheet">
</head>

<div class="content-body">

  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">

    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#" id="user"> </a>


    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>



    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="../index.php">Salir</a>
      </div>
    </div>
  </header>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">
                <span data-feather="home"></span>
                INICIO
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file"></span>
                Usuarios
              </a>
            </li>

          </ul>


      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">




        <h2> Usuarios</h2>
        <div class="table-responsive">
          <table class="user-list-table table" id="tabla_user">
            <thead>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>RFC</th>
                <th>Notas</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody id="bodytableUser">

            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>


</div>




</html>



<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>



<!-- 
 modal editar -->
<div class="modal fade show"  tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-modal="true" role="dialog" id="modal-info">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Modificar Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
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
                                <input type="text" id="textRF" maxlength="13" class="form-control uppercase" autocomplete="off" placeholder="SAS9010" required>
                                <div>
                                    <strong style="color: red; " id="rfc_r" class="d-none"> RFC es un campo requerido</strong>
                                </div>



                            </div>
                               <div> <h6>Cambiar contraseña</h6></div>
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

                            <div> <span> nota: es necesario cambiar la contraseña para actualizar los  datos</span></div>

                           
                        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelar">Cerrar</button>
        <button type="button" class="btn btn-primary" id="aceptar">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>

<script src="../js/user_all.js"></script>
<!-- <script src="../js/update_user.js"></script> -->
<script src="../validate-rfc-master/dist/index.js"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

  