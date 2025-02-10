$(document).ready(function () {
  // Petición que obtiene el total de mensajes enviados al mes.
  jQuery.ajax({
    url: "./php/peticion_obtener_tipos.php",
    type: "GET",
    dataType: "JSON",
    success: function (result) {
      if (typeof result.message === "undefined" && result.data) {
        let data = result.data;
        let meses = [];
        let mesActual = 0;
        let conteoDeTipos = [0, 0, 0];

        data.forEach((element) => {
          let fecha = new Date(element.creado);
          let mes = fecha.getMonth();

          if (mes != mesActual) {
            meses[mesActual] = conteoDeTipos;
            mesActual += 1;
            conteoDeTipos = [0, 0, 0];
          }
          switch (element.tipo) {
            case "Correo Electrónico":
              conteoDeTipos[0] += 1;
              break;
            case "SMS":
              conteoDeTipos[1] += 1;
              break;
            case "WhatsApp":
              conteoDeTipos[2] += 1;
              break;
          }
        });
        meses[mesActual] = conteoDeTipos;
        graficaMensajesMensuales(meses);
      } else {
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

  // Obtener la semana actual, los siete días de dicha semana.
  let semana = obtenerSemanaActual();

  // Petición que obtiene el total de mensajes enviados al día.
  jQuery.ajax({
    url: "./php/peticion_obtener_conteo_semanal.php",
    type: "POST",
    dataType: "JSON",
    data: {
      postFechaInicial: semana[2][0],
      postFechaFinal: semana[2][1],
    },
    success: function (result) {
      if (typeof result.message === "undefined" && result.data) {
        let datos = result.data;
        let diasContados = contarDias(datos);
        graficaMensajesDiarios(diasContados, semana);
      }
      else {
        Swal.fire({
          title: "¡Atención!",
          html: `<p>${result.message}</p>` +
                `<p>Espere a que los clientes registren mensajes durante el transcurso de la semana.</p>`,
          icon: "warning",
          confirmButtonText: "Entendido",
        });
        diasContados = [0, 0, 0, 0, 0, 0, 0];
        graficaMensajesDiarios(diasContados, semana);
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
});
/*
  Esta función genera un gráfico de barras de todos los mensajes enviados al mes.
  Recibe un arreglo bidimensional de conteo de mensajes por tipo según el mes de registro.
*/
function graficaMensajesMensuales(conteoMensual) {
  let fecha = new Date();
  let aActual = fecha.getFullYear();
  const mensajesMensuales = Highcharts.chart("graficaMensajesMensuales", {
    chart: {
      type: "bar",
    },
    title: {
      text: "Mensajes Enviados - " + aActual,
    },
    xAxis: {
      categories: ["Correo Electrónico", "SMS", "WhatsApp"],
    },
    yAxis: {
      title: {
        text: "Conteo Mensual",
        align: "high",
      },
    },
    plotOptions: {
      bar: {
        borderRadius: "30%",
      },
    },
    series: [
      {
        name: "Enero",
        data: conteoMensual[0],
      },
      {
        name: "Febrero",
        data: conteoMensual[1],
      },
      {
        name: "Marzo",
        data: conteoMensual[2],
      },
      {
        name: "Abril",
        data: conteoMensual[3],
      },
      {
        name: "Mayo",
        data: conteoMensual[4],
      },
      {
        name: "Junio",
        data: conteoMensual[5],
      },
      {
        name: "Julio",
        data: conteoMensual[6],
      },
      {
        name: "Agosto",
        data: conteoMensual[7],
      },
      {
        name: "Septiembre",
        data: conteoMensual[8],
      },
      {
        name: "Octubre",
        data: conteoMensual[9],
      },
      {
        name: "Noviembre",
        data: conteoMensual[10],
      },
      {
        name: "Diciembre",
        data: conteoMensual[11],
      },
    ],
  });
  let j = 0;
  // Ocultar series sin datos en el resto de los meses.
  $(mensajesMensuales.series).each(function () {
    if (typeof conteoMensual[j] === "undefined") {
      this.setVisible(false, false);
    }
    j += 1;
  });
  mensajesMensuales.redraw();
}

/*
  Esta función genera un gráfico de columnas de todos los mensajes enviados al día.
  Recibe un arreglo de conteo de mensajes registrados durante la semana actual.
*/
function graficaMensajesDiarios(conteoDiario, semana) {
  const mensajesDiarios = Highcharts.chart("graficaMensajesDiarios", {
    chart: {
      type: "column",
    },
    title: {
      text:
        "Mensajes Enviados - " +
        semana[1][0] +
        " a " +
        semana[1][6] +
        " de " +
        semana[0],
    },
    xAxis: {
      categories: [
        "Lunes, " + semana[1][0],
        "Martes, " + semana[1][1],
        "Miercoles, " + semana[1][2],
        "Jueves, " + semana[1][3],
        "Viernes, " + semana[1][4],
        "Sabado, " + semana[1][5],
        "Domingo, " + semana[1][6],
      ],
      crosshair: true,
    },
    yAxis: {
      min: 0,
      title: {
        text: "Mensajes al día",
      },
    },
    plotOptions: {
      column: {
        pointPadding: 0.1,
        borderWidth: 0,
      },
    },
    series: [
      {
        name: "Días de la Semana",
        data: conteoDiario,
        color: "#ffff00",
      },
    ],
  });
}

// Función qur obtiene la semana actual.
function obtenerSemanaActual() {
  let fechaActual = new Date();
  let meses = [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre",
  ];
  let mesActual = fechaActual.getMonth();
  let semanaActual = [];
  let rangoSemanal = [];

  mesActual = meses[mesActual];
  for (let i = 1; i <= 7; i++) {
    let first = fechaActual.getDate() - fechaActual.getDay() + i;
    let dia = new Date(fechaActual.setDate(first)).getDate();
    let diaFechaCompleta = new Date(fechaActual.setDate(first))
      .toISOString()
      .slice(0, 10);
    semanaActual.push(dia);
    if (i == 1 || i == 7) {
      rangoSemanal.push(diaFechaCompleta);
    }
  }
  let resultados = [mesActual, semanaActual, rangoSemanal];

  return resultados;
}

// Función que cuenta todos los mensajes obtenidos según el dia de su creación.
function contarDias(datos) {
  let conteoDias = [0, 0, 0, 0, 0, 0, 0];
  let diaActual = new Date(datos[0].creado).getDate();
  let i = 0;
  datos.forEach((element) => {
    let fecha = new Date(element.creado).getDate();
    if (fecha == diaActual) {
      conteoDias[i] += 1;
    }
    else {
      i += 1;
      diaActual = fecha;
      conteoDias[i] += 1;
    }
  });
  return conteoDias;
}
