$(document).ready(function () {
  $("#cliente").empty();

  // Cargar los datos de cliente en el select con una solicitud ajax GET.
  jQuery.ajax({
    url: "./php/peticion_obtener_clientes.php",
    type: "GET",
    dataType: "JSON",
    success: function (result) {
      let data = result.data;
      $("#cliente").append(`<option value="D" selected>Elige un cliente</option>`);
      data.forEach((element) => {
        $("#cliente").append(
          `<option value="${element.id}">${element.nombre} ${element.apellidos}</option>`
        );
      });
    },
    error: function (error) {
      Swal.fire({
        title: "Ha ocurrido un error técnico...",
        html: error + "<br>" + "Comuníquese con el administrador del sistema.",
        icon: "error",
        confirmButtonText: "Entendido",
      });
    },
  });

  // Cambiar el tipo de input según la opción seleccionada en el select.
  $("#tipo-select").on("change", function () {
    if ($(this).val() == "C") {
      $("#tipo-div-dinamico").empty();
      $("#tipo-div-dinamico").append(
        `<label for="tipo" class="form-label">Referencia (Correo)</label>`
      );
      $("#tipo-div-dinamico").append(
        `<input type="email" class="form-control" id="tipo" name="tipo" maxlength="30" required />`
      );
      $("#tipo").prop("disabled", false);
    }
    if ($(this).val() == "T") {
      $("#tipo-div-dinamico").empty();
      $("#tipo-div-dinamico").append(
        `<label for="tipo" class="form-label">Referencia (Teléfono)</label>`
      );
      $("#tipo-div-dinamico").append(
        `<input type="tel" class="form-control" id="tipo" name="tipo" maxlength="20" required />`
      );
      $("#tipo").prop("disabled", false);
    }
    if ($(this).val() == "D") {
      $("#tipo").prop("disabled", true);
    }
  });

  // Responder al evento submit del formulario de registro de mensajes.
  $("#formularioRegistrarMensaje").submit(function (e) {
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
        $("#submitRegistrarMensaje").prop("disabled", true);
        $("#submitRegistrarMensaje").empty();
        $("#submitRegistrarMensaje").append(`
            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
            <span role="status">Registrando...</span>
        `);
      },
      success: function (response) {
        $("#submitRegistrarMensaje").prop("disabled", false);
        $("#submitRegistrarMensaje").empty();
        $("#submitRegistrarMensaje").append("Registrar");
        if (response.status == true) {
          Swal.fire({
            title: "¡Registro Exitoso!",
            text: response.message,
            icon: "success",
            confirmButtonText: "Entendido",
          }).then((result) => {
            if (result.isConfirmed) {
              location.replace("./mensajes.html");
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
        $("#submitRegistrarMensaje").prop("disabled", false);
        $("#submitRegistrarMensaje").empty();
        $("#submitRegistrarMensaje").append("Registrar");
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
