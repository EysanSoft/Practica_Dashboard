$(document).ready(function () {
  let tablaUsuarios;
  // Eliminar el mensaje "Sin datos." en la tabla.
  $("#cuerpoTablaUsuarios").empty();

  // Cargar los datos de usuario en la tabla con una solicitud ajax GET.
  jQuery.ajax({
    url: "./php/peticion_obtener_usuarios.php",
    type: "GET",
    dataType: "JSON",
    success: function (result) {
      if (typeof result.message === "undefined" && result.data) {
        let data = result.data;

        data.forEach((element) => {
          let crear = element.crear == 1 ? "Sí" : "No";
          let eliminar = element.eliminar == 1 ? "Sí" : "No";

          $("#cuerpoTablaUsuarios").append(
            `<tr>` +
              `<th scope'row' class='text-center align-middle'>${element.id}</th>` +
              `<td class='text-center align-middle'>${element.nombre}</td>` +
              `<td class='text-center align-middle'>${element.apellidos}</td>` +
              `<td class='text-center align-middle'>${element.telefono}</td>` +
              `<td class='text-center align-middle'>${element.correo}</td>` +
              `<td class='text-center align-middle'>${crear}</td>` +
              `<td class='text-center align-middle'>${eliminar}</td>` +
              `<td class='text-center align-middle'><button class="btn btn-primary" onClick="abrirModalEditarUsuario(${element.id})">Editar</button><button class="btn btn-danger" onClick="eliminarUsuario(${element.id})">Eliminar</button></td>` +
            `</tr>`
          );
        });
        tablaUsuarios = new DataTable("#tablaUsuarios", {
          responsive: true,
          layout: {
            topStart: 'search',
            topEnd: 'pageLength',
          },
          language: {
            "decimal":        "",
            "emptyTable":     "No hay datos.",
            "info":           "Mostrando _START_ a _END_ de _TOTAL_ entradas",
            "infoEmpty":      "Mostrando 0 a 0 de 0 entradas",
            "infoFiltered":   "(Filtrado de _MAX_ entradas totales)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Mostrando _MENU_ entrada(s)",
            "loadingRecords": "Cargando...",
            "processing":     "",
            "search":         "Buscar:",
            "zeroRecords":    "No se encontraron coincidencias.",
            "paginate": {
                "first":      "Primero",
                "last":       "Último",
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
            "aria": {
                "orderable":  "Ordenar esta columna",
                "orderableReverse": "Ordenar esta columna en orden inverso"
            }
          }
        });
      }
      else {
        Swal.fire({
          title: "¡Atención!",
          text: result.message,
          icon: "error",
          confirmButtonText: "Entendido",
        });
        $("#cuerpoTablaUsuarios").append(`
          <tr>
            <td colspan="8"><b>Sin datos...</b></td>
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
      $("#cuerpoTablaUsuarios").append(`
        <tr>
          <td colspan="8"><b>Sin datos...</b></td>
        </tr>
      `);
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
      if (typeof result.message === "undefined" && result.data) {
        let data = result.data;
        let rol, crear, eliminar;

        data.forEach((element) => {
          rol = element.rolId;
          crear = element.crear;
          eliminar = element.eliminar;
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
              `<div class="mb-3">` +
              `<label for="correo" class="form-label">Correo</label>` +
              `<input type="email" class="form-control" id="correo" name="correo" value="${element.correo}"/>` +
              `</div>` +
              `<div class="mb-3" id="permisosContainer">` +
              `</div>` +
              `<div class="mb-3">` +
              `<button class="btn btn-primary submitEditarUsuario" id="submit">Guardar Cambios</button>` +
              `</div>`
          );
          // Sucio hack para que el select refleje los permisos del usuario.
          if(rol == 2) {
            if(crear == 1 && eliminar == 1) {
              $("#permisosContainer").append(
                `<label for="permisos" class="form-label">Permisos de Empleado</label>` +
                `<select class="form-control" id="permisos" name="permisos">` +
                  `<option value="">Sin Permisos</option>` +
                  `<option value="C">Crear (Reportes de sus Mensajes)</option>` +
                  `<option value="E">Eliminar</option>` +
                  `<option value="C&E" selected>Crear y Eliminar</option>` +
                `</select>`
              );
            }
            else if(crear == 1) {
              $("#permisosContainer").append(
                `<label for="permisos" class="form-label">Permisos de Empleado</label>` +
                `<select class="form-control" id="permisos" name="permisos">` +
                  `<option value="">Sin Permisos</option>` +
                  `<option value="C" selected>Crear (Reportes de sus Mensajes)</option>` +
                  `<option value="E">Eliminar</option>` +
                  `<option value="C&E">Crear y Eliminar</option>` +
                `</select>`
              );
            }
            else if(eliminar == 1) {
              $("#permisosContainer").append(
                `<label for="permisos" class="form-label">Permisos de Empleado</label>` +
                `<select class="form-control" id="permisos" name="permisos">` +
                  `<option value="">Sin Permisos</option>` +
                  `<option value="C">Crear (Reportes de sus Mensajes)</option>` +
                  `<option value="E" selected>Eliminar</option>` +
                  `<option value="C&E">Crear y Eliminar</option>` +
                `</select>`
              );
            }
            else {
              $("#permisosContainer").append(
                `<label for="permisos" class="form-label">Permisos de Empleado</label>` +
                `<select class="form-control" id="permisos" name="permisos">` +
                  `<option value="" selected>Sin Permisos</option>` +
                  `<option value="C">Crear (Reportes de sus Mensajes)</option>` +
                  `<option value="E">Eliminar</option>` +
                  `<option value="C&E">Crear y Eliminar</option>` +
                `</select>`
              );
            }
          }
          $("#modalEditarUsuario").modal("show");
        });
      }
      else {
        Swal.fire({
          title: "¡Atención!",
          text: result.message,
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