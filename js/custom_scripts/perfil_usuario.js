$(document).ready(function () {
  // Obtener la foto de perfil del usuario.
  $("#perfilUsuario").empty();

  jQuery.ajax({
    url: "./php/peticion_obtener_foto_perfil.php",
    type: "GET",
    dataType: "JSON",
    success: function (result) {
      let data = result.data;

      if(data[0].imageUrl === null) {
        $("#perfilUsuario").append(`
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">${data[0].nombre} ${data[0].apellidos}</span>
          <img class="img-profile rounded-circle" src="./img/perfil/default.png"/>
        `);
        $("#contenedorFotoDePerfil").append(`
          <img src="./img/perfil/default.png" class="img-fluid" alt="Sin foto de perfil."></img>
        `);
      }
      else {
        $("#perfilUsuario").append(`
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">${data[0].nombre} ${data[0].apellidos}</span>
          <img class="img-profile rounded-circle" src="./img/perfil/${data[0].imageUrl}"/>
        `);
        $("#contenedorFotoDePerfil").append(
          `<img src="./img/perfil/${data[0].imageUrl}" class="img-fluid" alt="Foto de perfil."></img>`
        );
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
//   $("#editarFotoPerfilForm").submit(function (e) {
//     e.preventDefault();
//     let idUser = $("#hiddenIdUser").val();
//     let currentImageName = $("#hiddenUserImage").val();
//     let datos = new FormData(this);
//     datos.append("idUser", idUser);
//     if ($("#hiddenUserImage").val() != null) {
//       datos.append("imageName", currentImageName);
//     }
//     try {
//       let urlForm = $(this).attr("action");
//       $.ajax({
//         url: urlForm,
//         type: "POST",
//         data: datos,
//         dataType: "json",
//         processData: false,
//         contentType: false,
//         success: function (response) {
//           if (response.status == true) {
//             Swal.fire({
//               title: "Atención",
//               text: response.message,
//               icon: "success",
//               confirmButtonText: "Entendido",
//             }).then((result) => {
//               if (result.isConfirmed) {
//                 $("#modalEditarUsuario").modal("hide");
//                 location.reload();
//               }
//             });
//           } else {
//             // Error del servidor...
//             Swal.fire({
//               title: "Ha ocurrido un error...",
//               text: response.message,
//               icon: "error",
//               confirmButtonText: "Entendido",
//             });
//           }
//         },
//         error: function (error) {
//           Swal.fire({
//             title: "Ha ocurrido un error técnico...",
//             html:
//               error + "<br>" + "Comuníquese con el administrador del sistema.",
//             icon: "error",
//             confirmButtonText: "Entendido",
//           });
//         },
//       });
//     } catch (error) {
//       Swal.fire({
//         title: "Atención",
//         text: "Ninguna imagen seleccionada.",
//         icon: "warning",
//         confirmButtonText: "Entendido",
//       });
//     }
//   });
});
