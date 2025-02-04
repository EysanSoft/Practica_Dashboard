$(document).ready(function () {
  $("#formularioRegistrarUsuario").submit(function (e) {
    let contra_1 = $("#contra").val();
    let contra_2 = $("#conContra").val();
    if (contra_1 == contra_2) {
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
          $("#submitRegistrarUsuario").prop("disabled", true);
          $("#submitRegistrarUsuario").empty();
          $("#submitRegistrarUsuario").append(`
              <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
              <span role="status">Registrandote...</span>
          `);
        },
        success: function (response) {
          $("#submitRegistrarUsuario").prop("disabled", false);
          $("#submitRegistrarUsuario").empty();
          $("#submitRegistrarUsuario").append("Registrarte");
          if (response.status == true) {
            Swal.fire({
              title: "¡Registro Exitoso!",
              text: response.message,
              icon: "success",
              confirmButtonText: "Entendido",
            }).then((result) => {
              if (result.isConfirmed) {
                location.replace("./usuarios.html");
              }
            });
          }
          else {
            Swal.fire({
              title: "¡Registro Fallido!",
              text: response.message,
              icon: "error",
              confirmButtonText: "Entendido",
            });
          }
        },
        error: function (error) {
          $("#submitRegistrarUsuario").prop("disabled", false);
          $("#submitRegistrarUsuario").empty();
          $("#submitRegistrarUsuario").append("Registrarte");
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
