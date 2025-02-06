$(document).ready(function () {
  $("#tablaMensajes").empty();

  jQuery.ajax({
    url: "./php/peticion_obtener_mensajes.php",
    type: "GET",
    dataType: "JSON",
    success: function (result) {
      if (typeof result.message === "undefined" && result.data) {
        let data = result.data;
        data.forEach((element) => {
          let fechaYHora = formatearFecha(element.creado);
          $("#tablaMensajes").append(
            `<tr>` +
              `<th scope'row' class='text-center align-middle'>${element.id}</th>` +
              `<td class='align-middle'>${element.cuerpo}</td>` +
              `<td class='text-center align-middle'>${element.contacto}</td>` +
              `<td class='text-center align-middle'>${element.tipo}</td>` +
              `<td class='text-center align-middle'>${element.status}</td>` +
              `<td class='text-center align-middle'>${element.cliente}</td>` +
              `<td class='text-center align-middle'>${fechaYHora}</td>` +
              `<td class='text-center align-middle'><button class="btn btn-danger" onClick="eliminarMensaje(${element.id})">Eliminar</button></td>` +
              `</tr>`
          );
        });
      }
      else {
        Swal.fire({
          title: "¡Atención!",
          text: result.message,
          icon: "error",
          confirmButtonText: "Entendido",
        });
        $("#tablaMensajes").append(`
          <tr>
            <td colspan="6"><b>Sin datos...</b></td>
          </tr>
        `);
      }
    },
    error: function (error) {
      Swal.fire({
        title: "Ha ocurrido un error técnico...",
        html: error + "<br>" + "Comuníquese con el administrador del sistema.",
        icon: "error",
        confirmButtonText: "Entendido",
      });
      $("#tablaMensajes").append(`
        <tr>
          <td colspan="6"><b>Sin datos...</b></td>
        </tr>
      `);
    },
  });
});

function formatearFecha(fechaOriginal) {
  let fecha = new Date(fechaOriginal);
  let d = fecha.getDate();
  let m = fecha.getMonth() + 1;
  let a = fecha.getFullYear();
  let h = fecha.getHours();
  let min = fecha.getMinutes();
  let fechaFormateada = `${d}-${m}-${a}, ${h}:${min}`;
  return fechaFormateada;
}

function eliminarMensaje(id) {
  Swal.fire({
    title: "Atención",
    text: "¿Estás seguro de que quieres eliminar el mensaje?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#4e73df",
    cancelButtonColor: "#e74a3b",
    confirmButtonText: "SÍ",
    cancelButtonText: "NO",
  }).then((result) => {
    if (result.isConfirmed) {
      jQuery.ajax({
        url: "./php/peticion_eliminar_mensaje.php",
        type: "POST",
        dataType: "JSON",
        data: {
          postID: id,
        },
        success: function (response) {
          if (response.status == true) {
            Swal.fire({
              title: "Atención",
              text: response.message,
              icon: "success",
              confirmButtonText: "Entendido",
            }).then((result) => {
              if (result.isConfirmed) {
                location.reload();
              }
            });
          }
          else {
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
  });
}
