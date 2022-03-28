
// autor: Alan sánchez Soto
// email:alsoto85@gmail.com
// date:25/3/2022

const bodytableUser = document.querySelector("#bodytableUser");
const user =document.getElementById('user');
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
  rfc = document.getElementById('textRF'),
  validaRFC = false,
  validaMail = false,
  id_usuario,
  validaPass = false;


window.addEventListener('load', () => {
    showData();
    user.innerHTML=localStorage.getItem('name');


});


// muestra la tabla 
const showData = () => {

    $("#tabla_user").DataTable().destroy();
    bodytableUser.innerHTML = "";

    let tbody = "";
    $.ajax({
        url: '../prueba_ws/wsGetUser',
        type: "GET",
        dataType: "json",
        async: false,
        success: function (response) {
            if (response.status == 'OK') {
                response.data.forEach(element => {
                  
                    tbody += `
                    <tr>
                        <td> ${element.id_usuario} </td>
                        <td>${element.nombre}</td>
                        <td>${element.telefono}</td>
                        <td>${element.email}</td>  
                        <td>${element.rfc.toLocaleUpperCase()}</td>
                        <td>${element.notas}</td> 
                        <td>
                           
                            <button type="button" data-toggle="tooltip" data-placement="left" title="Modificar" class="btn btn-sm btn-warning" onclick="modificar(${element.id_usuario})"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                         
                        </td>     
                    </tr>        
                    `;
                });

            
               
            }
        }
    });

    bodytableUser.innerHTML = tbody;
    setDataTable();


}
const modificar=(id)=>{
 $("#modal-info").modal("show")
 validaRFC = true,
 validaMail = true,
        id_usuario=id;
        jsonData = {
            id:id,
           
        }; 

        $.ajax({
            url: "../prueba_ws/wsGetUserInfo",
            type: "POST",
            data: jsonData,
            dataType: "JSON",
            cache: false,
            success: function (response) {
                console.log(response);
                if (response.status=='OK') {
                    nombre.value= response.data[0].nombre,
                    telephone.value=response.data[0].telefono,
                    mail.value=response.data[0].email,
                    notas.value=response.data[0].notas,
                    rfc.value=response.data[0].rfc.toLocaleUpperCase();
                }
          
            }
        });
   

  }
// Declarar Datatable
const setDataTable = () => {
    $('#tabla_user').DataTable({

        order: [
            [1, "desc"]
        ],
        dom: '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-75"<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l><"col-sm-12 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"<"me-1"f>B>>>t<"d-flex justify-content-between mx-2 row mb-1"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json",
            sLengthMenu: "Show _MENU_",
            search: "Buscar",
            searchPlaceholder: "Buscar.."
        },
        buttons: [{
            extend: "collection",
            className: "btn btn-outline-secondary dropdown-toggle me-2",
            text: feather.icons["external-link"].toSvg({
                class: "font-small-4 me-50"
            }) + "Exportar",
            buttons: [{
                extend: "print",
                text: feather.icons.printer.toSvg({
                    class: "font-small-4 me-50"
                }) + "Print",
                className: "dropdown-item",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: "excel",
                text: feather.icons.file.toSvg({
                    class: "font-small-4 me-50"
                }) + "Excel",
                className: "dropdown-item",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: "pdf",
                text: feather.icons.clipboard.toSvg({
                    class: "font-small-4 me-50"
                }) + "Pdf",
                className: "dropdown-item",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            ],
            init: function (e, t, a) {
                $(t).removeClass("btn-secondary"), $(t).parent().removeClass("btn-group"), setTimeout((function () {
                    $(t).closest(".dt-buttons").removeClass("btn-group").addClass("d-inline-flex mt-50")
                }), 50)
            }
        },
        // {
        //     text: "Agregar Usuario",
        //     className: "add-new btn btn-success",
        //     init: function (e, t, a) {
        //         $(t).removeClass("btn-secondary");
        //         $(t).click(function (e) {
        //             e.preventDefault();
        //             location.href = '../register/'
        //         })
        //     }
        // }
        ],
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function (e) {
                        return "Details of " + e.data().full_name
                    }
                }),
                type: "column",
                renderer: function (e, t, a) {
                    var s = $.map(a, (function (e, t) {
                        return 6 !== e.columnIndex ? '<tr data-dt-row="' + e.rowIdx + '" data-dt-column="' + e.columnIndex + '"><td>' + e.title + ":</td> <td>" + e.data + "</td></tr>" : ""
                    })).join("");
                    return !!s && $('<table class="table"/>').append("<tbody>" + s + "</tbody>")
                }
            }
        },
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json",
            paginate: {
                url: "https://cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json",
                previous: "&nbsp;",
                next: "&nbsp;"
            }
        }
    });
    // Inicializa los tooltips
    $('[data-toggle="tooltip"]').tooltip();
};

// inicio de update 


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
// validación de mail
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
                id: id_usuario,  
                nombre: nombre.value,
                mail: mail.value,
                telephone: telephone.value,
                password: password_2.value,
                notas: notas.value,
                rfc: rfc.value

              }

              $.ajax({
                url: "../prueba_ws/wsUpdateUser",
                type: "POST",
                data: jsonData,
                dataType: "JSON",
                cache: false,
                success: function (response) {
                    if (response.status =='OK') {
                      Swal.fire({
                        icon: "success",
                        html: `El usuario ${nombre.value} se actualizo con éxito `,
                        showConfirmButton: true,
                        confirmButtonText: "Aceptar",
                        confirmButtonColor: "#0d6efd",
                        allowOutsideClick: false,
                    }).then((result) => {
                     
                        location.href = '../dashboard/'
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

  location.href = '../dashboard/'

});




