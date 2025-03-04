$(document).ready(function () {
  let fotoDePerfil;

  $("#perfilUsuario").empty();

  jQuery.ajax({
    url: "./php/peticion_obtener_foto_perfil.php",
    type: "GET",
    dataType: "JSON",
    success: function (result) {
      let data = result.data;

      if (data[0].imageUrl === null) {
        $("#perfilUsuario").append(`
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">${data[0].nombre} ${data[0].apellidos}</span>
          <img class="img-profile rounded-circle" src="./img/perfil/default.png"/>
        `);
        $("#contenedorFotoDePerfil").append(`
          <img src="./img/perfil/default.png" class="img-fluid" alt="Sin foto de perfil."></img>
        `);
        fotoDePerfil = "";
      }
      else {
        $("#perfilUsuario").append(`
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">${data[0].nombre} ${data[0].apellidos}</span>
          <img class="img-profile rounded-circle" src="${data[0].imageUrl}"/>
        `);
        $("#contenedorFotoDePerfil").append(
          `<img src="${data[0].imageUrl}" class="img-fluid" alt="Foto de perfil."></img>`
        );
        fotoDePerfil = data[0].imageUrl;
      }
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

  // Responder al submit del formulario editar el foto de perfil con un ajax POST.
  $("#editarFotoPerfilForm").submit(function (e) {
    e.preventDefault();
    let datos = new FormData(this);
    
    datos.append("imageName", fotoDePerfil);
    try {
      let urlForm = $(this).attr("action");

      $.ajax({
        url: urlForm,
        type: "POST",
        data: datos,
        dataType: "json",
        processData: false,
        contentType: false,
        beforeSend: function () {
          $("#submitEditarFotoPerfil").prop("disabled", true);
          $("#submitEditarFotoPerfil").empty();
          $("#submitEditarFotoPerfil").append(`
              <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
              <span role="status">Subiendo Imagen...</span>
          `);
        },
        success: function (response) {
          $("#submitEditarFotoPerfil").prop("disabled", false);
          $("#submitEditarFotoPerfil").empty();
          $("#submitEditarFotoPerfil").append("Subir Imagen");
          if (response.status == true) {
            Swal.fire({
              title: "Atención",
              text: response.message,
              icon: "success",
              confirmButtonText: "Entendido",
            }).then((result) => {
              if (result.isConfirmed) {
                $("#cambiarFotoPerfilModal").modal("hide");
                location.reload();
              }
            });
          }
          else {
            $("#submitEditarFotoPerfil").prop("disabled", false);
            $("#submitEditarFotoPerfil").empty();
            $("#submitEditarFotoPerfil").append("Subir Imagen");
            Swal.fire({
              title: "Ha ocurrido un error...",
              text: response.message,
              icon: "error",
              confirmButtonText: "Entendido",
            });
          }
        },
        error: function (error) {
          $("#submitEditarFotoPerfil").prop("disabled", false);
          $("#submitEditarFotoPerfil").empty();
          $("#submitEditarFotoPerfil").append("Subir Imagen");
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
    catch (error) {
      Swal.fire({
        title: "Atención",
        text: "Ninguna imagen seleccionada.",
        icon: "warning",
        confirmButtonText: "Entendido",
      });
    }
  });
});
