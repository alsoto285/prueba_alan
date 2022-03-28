// Example starter JavaScript for disabling form submissions if there are invalid fields


const btnAceptar = document.getElementById('aceptar');
const btnCancelar = document.getElementById('cancelar');
const btnEye = document.getElementById('eye_1');
const btnEye2 = document.getElementById('eye_2');
let nombre = document.getElementById('name'),
  telephone = document.getElementById('telephone'),
  mail = document.getElementById('email'),
  password_1 = document.getElementById('password_1'),
  password_2 = document.getElementById('password_2'),
  notas = document.getElementById('notas'),
  rfc = document.getElementById('textRFC'),
  validaRFC = false,
  validaMail = false,
  validaPass = false;



// validacion de los campos
const validateinputs = () => {
  e = true;
  if (nombre.value == "") {
    nombre.classList.add("req");
    document.getElementById('name_r').classList.remove("d-none");
    e = false;
  } else {
    nombre.classList.remove("req");
    document.getElementById('name_r').classList.add("d-none");
  }


  if (rfc.value == "") {
    rfc.classList.add("req");
    document.getElementById('rfc_r').classList.remove("d-none");
    e = false;
  } else {
    rfc.classList.remove("req");
    document.getElementById('rfc_r').classList.add("d-none");
  }

  if (mail.value == "") {
    mail.classList.add("req");
    document.getElementById('email_r').classList.remove("d-none");
    e = false;
  } else {
    mail.classList.remove("req");
    document.getElementById('email_r').classList.add("d-none");
  }

  if (password_1.value == "") {
    password_1.classList.add("req");
    document.getElementById('password_1_r').classList.remove("d-none");
    e = false;
  } else {
    password_1.classList.remove("req");
    document.getElementById('password_1_r').classList.add("d-none");
  }
  if (password_2.value == "") {
    password_2.classList.add("req");
    document.getElementById('password_2_r').classList.remove("d-none");
    e = false;
  } else {
    password_2.classList.remove("req");
    document.getElementById('password_2_r').classList.add("d-none");
  }

  if (telephone.value == "") {
    telephone.classList.add("req");
    document.getElementById('telephone_r').classList.remove("d-none");
    e = false;
  } else {
    telephone.classList.remove("req");
    document.getElementById('telephone_r').classList.add("d-none");
  }



  return e;

};


// valida rfc
rfc.addEventListener('keyup', e => {
  rfc.value.toLocaleUpperCase()

  var rfcValid = validateRfc(rfc.value),
    valid = document.getElementById("valid"),
    wrong = document.getElementById("wrong")

  if (rfcValid.isValid) {
    wrong.classList.add("d-none")
    valid.classList.remove("d-none")
    validaRFC = true
  } else {
    valid.classList.add("d-none")
    wrong.classList.remove("d-none")
    validaRFC = false
  }

});
// validacion de mail
mail.addEventListener('keyup', e => {
  const regxt = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
  regxt.test(mail.value),
    validMail = document.getElementById("valid_1"),
    wrongMail = document.getElementById("wrong_1")

  if (regxt.test(mail.value)) {
    wrongMail.classList.add("d-none")
    validMail.classList.remove("d-none")
    validaMail = true
  } else {
    validMail.classList.add("d-none")
    wrongMail.classList.remove("d-none")
    validaMail = false
  }


});
// valida pass
password_2.addEventListener('keyup', e => {


  valid_p = document.getElementById("valid_p"),
    wrong_p = document.getElementById("wrong_p")

  if (password_1.value == password_2.value) {
    wrong_p.classList.add("d-none")
    valid_p.classList.remove("d-none")
    validaPass = true
  } else {
    valid_p.classList.add("d-none")
    wrong_p.classList.remove("d-none")
    validaPass = false
  }

});
// valida pass
password_1.addEventListener('keyup', e => {


  valid_p = document.getElementById("valid_p"),
    wrong_p = document.getElementById("wrong_p")

  if (password_1.value == password_2.value) {
    wrong_p.classList.add("d-none")
    valid_p.classList.remove("d-none")
    validaPass = true
  } else {
    valid_p.classList.add("d-none")
    wrong_p.classList.remove("d-none")
    validaPass = false
  }

});
// mostrar contraseña
btnEye.addEventListener("click", () => {

  if (password_1.type == "password") {
    password_1.type = "text";
  } else {
    password_1.type = "password";
  }
});
// mostrar contraseña
btnEye2.addEventListener("click", () => {

  if (password_2.type == "password") {
    password_2.type = "text";
  } else {
    password_2.type = "password";
  }
});


// funcion del boton de aceptar
btnAceptar.addEventListener("click", () => {

  if (validateinputs() & validaRFC & validaMail & validaPass) {

              jsonData = {
                nombre: nombre.value,
                mail: mail.value,
                telephone: telephone.value,
                password: password_2.value,
                notas: notas.value,
                rfc: rfc.value

              }

              $.ajax({
                url: "../prueba_ws/wsAddUser",
                type: "POST",
                data: jsonData,
                dataType: "JSON",
                cache: false,
                success: function (response) {
                    if (response.status =='OK') {
                      Swal.fire({
                        icon: "success",
                        html: `El usuario ${nombre.value} con email ${mail.value}, se dio de alta con éxito `,
                        showConfirmButton: true,
                        confirmButtonText: "Aceptar",
                        confirmButtonColor: "#0d6efd",
                        allowOutsideClick: false,
                    }).then((result) => {
                        localStorage.setItem('name', response.data[0].nombre);
                        location.href = '../index.php/'
                    });
                      
                    }
                }

              });



  } else {
    Swal.fire({
      icon: "warning",
      html: `verifique que todos los datos sean correctos`,
      showConfirmButton: true,
      confirmButtonText: "Aceptar",
      confirmButtonColor: "#0d6efd",
      allowOutsideClick: false,
  })
  
  }

});

// funcion del boton de aceptar
btnCancelar.addEventListener("click", () => {

  location.href = '../index.php/'

});