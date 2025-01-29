$(document).ready(function () {
  // Eliminar el mensaje "Sin datos." en la tabla.
  $("#tablaUsuarios").empty();

  // Cargar los datos de usuario en la tabla con una solicitud Ajax GET.
  jQuery.ajax({
    url: "./php/peticion_obtener_usuarios.php",
    type: "GET",
    dataType: "JSON",
    success: function (result) {
      let data = result.data;
      data.forEach((element) => {
        $("#tablaUsuarios").append(
          `<tr>` +
            `<th scope'row'>${element.id}</th>` +
            `<td>${element.nombre}</td>` +
            `<td>${element.apellidos}</td>` +
            `<td>${element.telefono}</td>` +
            `<td>${element.correo}</td>` +
            `<td><button class="btn btn-primary" id="${element.id}" onClick="abrirModalEditarUsuario(${element.id})">Editar</button><button class="btn btn-danger" id="${element.id}" onClick="abrirModalEliminarUsuario(${element.id})">Eliminar</button></td>` +
            `</tr>`
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
});
