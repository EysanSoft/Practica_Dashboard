$(document).ready(function () {
  // Eliminar el mensaje "Sin datos." en la tabla.
  $("#tablaUsuarios").empty();

  // Cargar los datos de usuario en la tabla con una solicitud ajax GET.
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
            `<td><button class="btn btn-primary" onClick="abrirModalEditarUsuario(${element.id})">Editar</button><button class="btn btn-danger" onClick="eliminarUsuario(${element.id})">Eliminar</button></td>` +
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

  // Responder al submit del formulario editar usuario con un ajax POST.
  $("#formularioEditarUsuario").submit(function (e) {
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
        $("#submit").prop("disabled", true);
        $(".submitEditarUsuario").empty();
        $(".submitEditarUsuario").append(`
          <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
          <span role="status">Guardando los Cambios...</span>
        `);
      },
      success: function (response) {
        $("#submit").prop("disabled", false);
        $(".submitEditarUsuario").empty();
        $(".submitEditarUsuario").append("Guardar Cambios");
        if (response.status == true) {
          Swal.fire({
            title: "Atención",
            text: response.message,
            icon: "success",
            confirmButtonText: "Entendido",
          }).then((result) => {
            if (result.isConfirmed) {
              $("#modalEditarUsuario").modal("hide");
              location.reload();
            }
          });
        }
        else {
          // Error de la API, mostrar el mensaje de este.
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
  });
});

/*
  Función que obtiene el usuario desde la tabla, con su respectivo ID,
  carga los datos en el formulario editar usuario, y abre la respectiva modal.
*/
function abrirModalEditarUsuario(id) {
  /*
    Vacia el contenido del formulario cada vez que la función es llamado,
    para que pueda ser llenado de nuevo con los datos del usuario con un ajax POST.
  */
  $("#formularioEditarUsuario").empty();
  jQuery.ajax({
    url: "./php/peticion_obtener_usuario.php",
    type: "POST",
    dataType: "JSON",
    data: {
      postID: id,
    },
    success: function (result) {
      let data = result.data;
      data.forEach((element) => {
        $("#formularioEditarUsuario").append(
          `<div class="d.none">` +
            `<input type="hidden" class="form-control" id="idOculto" name="idOculto" value="${element.id}"/>` +
            `</div>` +
            `<div class="mb-3">` +
            `<label for="nombre" class="form-label">Nombre</label>` +
            `<input type="text" class="form-control" id="nombre" name="nombre" maxlength="15" value="${element.nombre}"/>` +
            `</div>` +
            `<div class="mb-3">` +
            `<label for="apellido" class="form-label">Apellido</label>` +
            `<input type="text" class="form-control" id="apellido" name="apellido" maxlength="30" value="${element.apellidos}"/>` +
            `</div>` +
            `<div class="mb-3">` +
            `<label for="telefono" class="form-label">Telefono</label>` +
            `<input type="tel" class="form-control" id="telefono" name="telefono" value="${element.telefono}"/>` +
            `</div>` +
            `<div class="mb-4">` +
            `<label for="correo" class="form-label">Correo</label>` +
            `<input type="email" class="form-control" id="correo" name="correo" value="${element.correo}"/>` +
            `</div>` +
            `<div class="mb-3">` +
            `<button class="btn btn-primary submitEditarUsuario" id="submit">Guardar Cambios</button>` +
            `</div>`
        );
        $("#modalEditarUsuario").modal("show");
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
}

function eliminarUsuario(id) {
  Swal.fire({
    title: 'Atención',
    text: "¿Estás seguro de que quieres eliminar a este usuario?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#4e73df',
    cancelButtonColor: '#e74a3b',
    confirmButtonText: 'SÍ',
    cancelButtonText: 'NO',
  }).then((result) => {
    if (result.isConfirmed) {
      jQuery.ajax({
        url: "./php/peticion_eliminar_usuario.php",
        type: "POST",
        dataType: "JSON",
        data: {
          postID: id,
        },
        success: function (response) {
          if (response.status == true) {
            Swal.fire({
              title: 'Atención',
              text: response.message,
              icon: 'success',
              confirmButtonText: 'Entendido'
            }).then((result) => {
              if (result.isConfirmed) {
                location.reload();
              }
            });
          }
          else {
            // Error del servidor...
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
            html: error + "<br>" + "Comuníquese con el administrador del sistema.",
            icon: "error",
            confirmButtonText: "Entendido",
          });
        },
      });
    }
  });
}