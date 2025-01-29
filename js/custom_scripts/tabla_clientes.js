$(document).ready(function () {
  // Eliminar el mensaje "Sin datos." en la tabla.
  $("#tablaClientes").empty();

  // Cargar los datos de usuario en la tabla con una solicitud Ajax GET.
  jQuery.ajax({
    url: "./php/peticion_obtener_clientes.php",
    type: "GET",
    dataType: "JSON",
    success: function (result) {
      let data = result.data;
      data.forEach((element) => {
        $("#tablaClientes").append(
          `<tr>` +
            `<th scope'row'>${element.id}</th>` +
            `<td>${element.nombre}</td>` +
            `<td>${element.apellidos}</td>` +
            `<td>${element.correo}</td>` +
            `<td>${element.telefono}</td>` +
            `<td><button class="btn btn-primary" id="${element.id}" onClick="abrirModalEditarCliente(${element.id})">Editar</button><button class="btn btn-danger" id="${element.id}" onClick="abrirModalEliminarCliente(${element.id})">Eliminar</button></td>` +
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
