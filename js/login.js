$(document).ready(function () {
    $('.login-info-box').fadeOut();
    $('.login-show').addClass('show-log-panel');
});

const btnLogin = document.getElementById("btnLogin");
const btnRegister = document.getElementById("loginRegister");
const btnEye = document.getElementById('eye_1');
let mail = document.getElementById('email'),
     password = document.getElementById('password');
// validacion de los campos
const validateinputs = () => {
    e = true;
   
    if (mail.value == "") {
     
      document.getElementById('email_r').classList.remove("d-none");
      e = false;
    } else {
      
      document.getElementById('email_r').classList.add("d-none");
    }
  
    if (password.value == "") {
      
      document.getElementById('password_1_r').classList.remove("d-none");
      e = false;
    } else {
      
      document.getElementById('password_1_r').classList.add("d-none");
    }
 
  
    return e;
  
  };
  

btnLogin.addEventListener("click", () => {
   console.log(validateinputs());
 
    if (validateinputs()) {

     jsonData = {
            password:password.value,
            email:mail.value
        }; 
      
        $.ajax({
            url: "../prueba_ws/wsLogin",
            type: "POST",
            data: jsonData,
            dataType: "JSON",
            cache: false,
            success: function (response) {
                console.log(response);
                 if(response.status =='OK'){
                    Swal.fire({
                        icon: "success",
                        html: `Bienvenido: <b>${response.data[0].nombre}</b>  `,
                        showConfirmButton: true,
                        confirmButtonText: "Aceptar",
                        confirmButtonColor: "#0d6efd",
                        allowOutsideClick: false,
                    }).then((result) => {
                        localStorage.setItem('name', response.data[0].nombre);
                        location.href = '../dashboard/'
                    });
                    
                    
                 }else{
                    Swal.fire({
                        icon: "warning",
                        html: `Lo sentimos no tienes acceso, favor de verificar el email y la contraseña`,
                        showConfirmButton: true,
                        confirmButtonText: "Aceptar",
                        confirmButtonColor: "#0d6efd",
                        allowOutsideClick: false,
                    }).then((result) => {
                        location.href = '../index.php'
                    });
                 }
            }
        });
    }


});
// mostrar contraseña
btnEye.addEventListener("click", () => {

    if (password.type == "password") {
      password.type = "text";
    } else {
      password.type = "password";
    }
  });


btnRegister.addEventListener("click", () => {
    location.href = '../register/'
   
});