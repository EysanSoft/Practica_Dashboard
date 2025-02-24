$(document).ready(function () {
  $("#logOut").on("click", function (e) {
    $.ajax({
      url: "./php/logout.php",
      type: "GET",
      dataType: "JSON",
      success: function (response) {
        location.replace("./login");
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
  });
});
