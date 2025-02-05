$(document).ready(function () {
  $("#formularioRegistrarCliente").submit(function (e) {
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
        $("#submitRegistrarCliente").prop("disabled", true);
        $("#submitRegistrarCliente").empty();
        $("#submitRegistrarCliente").append(`
          <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
          <span role="status">Registrando...</span>
        `);
      },
      success: function (response) {
        $("#submitRegistrarCliente").prop("disabled", false);
        $("#submitRegistrarCliente").empty();
        $("#submitRegistrarCliente").append("Registrar");
        if (response.status == true) {
          Swal.fire({
            title: "¡Registro Exitoso!",
            text: response.message,
            icon: "success",
            confirmButtonText: "Entendido",
          }).then((result) => {
            if (result.isConfirmed) {
              location.replace("./clientes.php");
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
        $("#submitRegistrarCliente").prop("disabled", false);
        $("#submitRegistrarCliente").empty();
        $("#submitRegistrarCliente").append("Registrar");
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
