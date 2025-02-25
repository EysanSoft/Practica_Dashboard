$(document).ready(function () {
  let permisoCrear, permisoEliminar;
  
  jQuery.ajax({
    url: "./php/peticion_obtener_permisos.php",
    type: "GET",
    dataType: "JSON",
    success: function (result) {
      if (typeof result.message === "undefined" && result.data) {
        let data = result.data;

        data.forEach((element) => {
          permisoCrear = element.crear;
          permisoEliminar = element.eliminar;
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

  let tablaMensajes;

  $("#cuerpoTablaMensajes").empty();

  jQuery.ajax({
    url: "./php/peticion_obtener_mensajes.php",
    type: "GET",
    dataType: "JSON",
    success: function (result) {
      if (typeof result.message === "undefined" && result.data) {
        let data = result.data;
        
        data.forEach((element) => {
          let fechaYHora = formatearFecha(element.creado);

          $("#cuerpoTablaMensajes").append(
            `<tr>` +
              `<th scope'row' class='text-center align-middle'>${element.id}</th>` +
              `<td class='align-middle'>${element.cuerpo}</td>` +
              `<td class='text-center align-middle'>${element.contacto}</td>` +
              `<td class='text-center align-middle'>${element.tipo}</td>` +
              `<td class='text-center align-middle'>${element.status}</td>` +
              `<td class='text-center align-middle'>${element.cliente}</td>` +
              `<td class='text-center align-middle'>${fechaYHora}</td>` +
              `<td class='text-center align-middle'><button class="btn btn-danger botonEliminarMensaje" onClick="eliminarMensaje(${element.id})">Eliminar</button></td>` +
            `</tr>`
          );
        });
        if (permisoEliminar == 0) {
          $(".botonEliminarMensaje").prop("disabled", true);
        }
        if (permisoCrear == 0) {
          tablaMensajes = new DataTable("#tablaMensajes", {
            responsive: true,
            layout: {
              topStart: 'search',
              topEnd: 'pageLength'
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
          tablaMensajes = new DataTable("#tablaMensajes", {
            responsive: true,
            layout: {
              topStart: {
                buttons: ['csv', 'excel', 'pdf']
              },
              topEnd: 'pageLength'
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
      }
      else {
        Swal.fire({
          title: "¡Atención!",
          text: result.message,
          icon: "error",
          confirmButtonText: "Entendido",
        });
        $("#cuerpoTablaMensajes").append(`
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
      $("#cuerpoTablaMensajes").append(`
        <tr>
          <td colspan="8"><b>Sin datos...</b></td>
        </tr>
      `);
    },
  });

  $("#fechaIni").on("change", function () {
    if($("#fechaFin").val() != "") {
      if($("#fechaIni").val() > $("#fechaFin").val()) {
        Swal.fire({
          title: "¡Atención!",
          text: "La fecha de inicial no puede ser mayor a la fecha final...",
          icon: "warning",
          confirmButtonText: "Entendido",
        });
      }
      else {
        filtrarTablaPorFechas($(this).val(), $("#fechaFin").val(), tablaMensajes);
      }
    }
  });

  $("#fechaFin").on("change", function () {
    if($("#fechaIni").val() != "") {
      if($("#fechaIni").val() > $("#fechaFin").val()) {
        Swal.fire({
          title: "¡Atención!",
          text: "La fecha de inicial no puede ser mayor a la fecha final...",
          icon: "warning",
          confirmButtonText: "Entendido",
        });
      }
      else {
        filtrarTablaPorFechas($("#fechaIni").val(), $(this).val(), tablaMensajes);
      }
    }
  });

});

function formatearFecha(fechaOriginal) {
  let fecha = new Date(fechaOriginal);
  let d = fecha.getUTCDate();
  let m = fecha.getUTCMonth() + 1;
  let a = fecha.getUTCFullYear();
  let h = fecha.getUTCHours();
  let min = fecha.getUTCMinutes();
  let fechaFormateada = `${d}-${m}-${a}, ${h}:${min}`;
  return fechaFormateada;
}

function desformatearFecha(fechaOriginal) {
  let fecha = fechaOriginal.split(",");

  fecha = fecha[0].split("-");
  if(fecha[1].length == 1) {
    fecha[1] = "0" + fecha[1];
  }
  if(fecha[0].length == 1) {
    fecha[0] = "0" + fecha[0];
  }
  let fechaFormateada = `${fecha[2]}-${fecha[1]}-${fecha[0]}`;

  return fechaFormateada;
}

function filtrarTablaPorFechas(fechaI, fechaF, tablaMensajes) {
  let fechaIni = new Date(fechaI + "T00:00");
  let fechaFin = new Date(fechaF + "T00:00");

  DataTable.ext.search.push(function (settings, data, dataIndex) {
    let creadoOriginal = desformatearFecha(data[6]);
    let creado = new Date(creadoOriginal + "T00:00");
  
    if (
        (fechaIni === null && fechaFin === null) ||
        (fechaIni === null && creado <= fechaFin) ||
        (fechaIni <= creado && fechaFin === null) ||
        (fechaIni <= creado && creado <= fechaFin)
    ) {
        return true;
    }
    return false;
  });
  tablaMensajes.draw();
  DataTable.ext.search.pop();
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
