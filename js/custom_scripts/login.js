$(document).ready(function () {
  $("#formularioLogin").submit(function (e) {
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
        $("#submitLogin").prop("disabled", true);
        $("#submitLogin").empty();
        $("#submitLogin").append(`
            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
            <span role="status">Ingresando...</span>
        `);
      },
      success: function (response) {
        $("#submitLogin").prop("disabled", false);
        $("#submitLogin").empty();
        $("#submitLogin").append("Ingresar");
        if (typeof response.message !== "undefined" && response.success == false) {
          Swal.fire({
            title: "¡Atención!",
            text: response.message,
            icon: "warning",
            confirmButtonText: "Entendido",
          });
        }
        else {
          location.replace("./index.php");
        }
      },
      error: function (error) {
        $("#submitLogin").prop("disabled", false);
        $("#submitLogin").empty();
        $("#submitLogin").append("Ingresar");
        Swal.fire({
          title: "Ha ocurrido un error técnico...",
          html: error + "<br>" + "Comuníquese con el administrador del sistema.",
          icon: "error",
          confirmButtonText: "Entendido",
        });
      },
    });
  });
});
