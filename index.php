 <!--  autor Gustavo Alan Sánchez Soto 
        mail    alsoto285@gmail.com
        date  28/03/2022
        gihub alsoto285 -->

 <!DOCTYPE html>
 <html lang="es">

 <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
 <link rel="stylesheet" type="text/css" href="../css/style.css">
 <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
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

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Prueba php</title>
 </head>

 <body>
     <!------ inicio de un login  ---------->

     <div class="login-reg-panel">

         <!-- inicio de registro-->
         <div class="register-info-box">
             <h2>¿No tienes Cuenta?</h2>
             <p>Registrate facilmente</p>
             <label id="label-login" for="loginRegister">Registrate</label>
             <input type="radio" name="active-log-panel" id="loginRegister">
         </div>
         <!-- inicio de olvio contraseña -->
         <!-- <div class="white-panel">
             <div class="login-show">
                 <h2>Inciar sesión</h2>

                 <input type="email" class="form-control" id="email" placeholder="you@example.com" required>
                 <div>
                     <strong style="color: red; " id="email_r" class="d-none"> Correo es un campo requerido</strong>
                 </div>
                 <input type="password" class="form-control" id="password" placeholder="" required>
                 <div>
                     <strong style="color: red; " id="email_r" class="d-none"> Contraseña es un campo requerido</strong>
                 </div>
                 <input type="button" value="Continuar" id="btnLogin">
                 <a href="">¿Olvidaste tu contraseña?</a> 

             </div>

            </div> -->

         <div class="white-panel">
             <div class="login-show">
             <h2>Inciar sesión</h2>
                 <div class="col-md-12 col-sm-12 col-lg-12">
                     <label  class="form-label" for="login-mail">Correo  </label>
                     <i class="fas fa-check fa-sm valid d-none" id="valid_1"></i>
                     <i class="fas fa-times fa-sm wrong d-none" id="wrong_1"></i>
                     <input type="email" class="form-control form-control-merge mb-3" name="login-mail"id="email" placeholder="you@example.com" required>
                     <div>
                         <strong style="color: red; " id="email_r" class="d-none"> Correo es un campo requerido</strong>
                     </div>
                 </div>
                 <div class="col-md-12 col-sm-12 col-lg-12">
                     <div class="col-md-6 col-sm-6 col-lg-12">
                         <label class="form-label" for="login_password">Contraseña</label>

                     </div>
                     <div class="input-group input-group-merge form-password-toggle">
                         <input class="form-control form-control-merge " id="password" type="password" name="login-password" placeholder="············" aria-describedby="login-password" tabindex="2"><span class="input-group-text cursor-pointer"><i class="fas fa-eye fa-sm" id="eye_1"></i></span>

                     </div>
                     <div>
                         <strong style="color: red; " id="password_1_r" class="d-none"> contraseña es un campo requerido</strong>
                     </div>
                 </div>
                 <input type="button" value="Continuar" id="btnLogin">

             </div>



         </div>
     </div>



 </body>


 </html>




 <script src="../js/login.js"></script>