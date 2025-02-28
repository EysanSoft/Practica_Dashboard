$(document).ready(function () {
  // Obtener los valores de QueryString de la URL.
  const QueryStrings = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
  });
  let token = QueryStrings.token;
  let userId = QueryStrings.userId;

  // Responder al submit del formulario editar la contraseña con un ajax POST.
  $("#editarContraForm").submit(function (e) {
    let contra_1 = $("#contra").val();
    let contra_2 = $("#conContra").val();

    if (contra_1 == contra_2) {
      e.preventDefault();
      let datos = new FormData(this);
      let urlForm = $(this).attr("action");

      if(token != null || userId != null){
        datos.append('token', token);
        datos.append('userId', userId);
      }
      $.ajax({
        url: urlForm,
        type: "POST",
        data: datos,
        dataType: "json",
        processData: false,
        contentType: false,
        beforeSend: function () {
          $("#submitCambiarContra").prop("disabled", true);
          $("#submitCambiarContra").empty();
          $("#submitCambiarContra").append(`
                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                <span role="status">Cambiando Contraseña...</span>
            `);
        },
        success: function (response) {
          $("#submitCambiarContra").prop("disabled", false);
          $("#submitCambiarContra").empty();
          $("#submitCambiarContra").append("Cambiar Contraseña");
          if (response.status == true) {
            Swal.fire({
              title: "Atención",
              text: response.message,
              icon: "success",
              confirmButtonText: "Entendido",
            }).then((result) => {
              if (result.isConfirmed) {
                $("cambiarContraModal").modal("hide");
                location.replace("./index");
              }
            });
          }
          else {
            $("#submitCambiarContra").prop("disabled", false);
            $("#submitCambiarContra").empty();
            $("#submitCambiarContra").append("Cambiar Contraseña");
            Swal.fire({
              title: "Ha ocurrido un error...",
              text: response.message,
              icon: "error",
              confirmButtonText: "Entendido",
            });
          }
        },
        error: function (error) {
          Swal.fire({
            title: "Ha ocurrido un error técnico...",
            html:
              error + "<br>" + "Comuníquese con el administrador del sistema.",
            icon: "error",
            confirmButtonText: "Entendido",
          });
        },
      });
    }
    else {
      Swal.fire({
        title: "¡Atención!",
        text: "Las contraseñas no coinciden.",
        icon: "warning",
        confirmButtonText: "Entendido",
      });
      return false;
    }
  });
});
