$(document).ready(function () {
  $("#formularioRecuCon").submit(function (e) {
    e.preventDefault();
    let datos = new FormData(this);
    let urlForm = $(this).attr("action");

    $.ajax({
      url: urlForm,
      type: "POST",
      data: datos,
      dataType: "json",
      processData: false,
      contentType: false,
      beforeSend: function () {
        $("#submitRecuCon").prop("disabled", true);
        $("#submitRecuCon").empty();
        $("#submitRecuCon").append(`
              <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
              <span role="status">Buscando Cuenta...</span>
          `);
      },
      success: function (response) {
        $("#submitRecuCon").prop("disabled", false);
        $("#submitRecuCon").empty();
        $("#submitRecuCon").append("Enviar");
        if (typeof response.message !== "undefined" && response.success == false) {
          Swal.fire({
            title: "¡Atención!",
            text: response.message,
            icon: "warning",
            confirmButtonText: "Entendido",
          });
        }
        else {
            Swal.fire({
                title: "Cuenta Encontrada",
                text: "Se ha enviado un correo con las instrucciones para recuperar su contraseña.",
                icon: "success",
                confirmButtonText: "Entendido",
            }).then((result) => {
                if (result.isConfirmed) {
                  location.replace("./login");
                }
            });
        }
      },
      error: function (error) {
        $("#submitLogin").prop("disabled", false);
        $("#submitLogin").empty();
        $("#submitLogin").append("Enviar");
        Swal.fire({
          title: "Ha ocurrido un error técnico...",
          html:
            error + "<br>" + "Comuníquese con el administrador del sistema.",
          icon: "error",
          confirmButtonText: "Entendido",
        });
      },
    });
  });
});
