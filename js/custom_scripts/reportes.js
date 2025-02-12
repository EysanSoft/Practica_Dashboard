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

  // Obtener la semana actual, los siete días de dicha semana.
  let semana = obtenerSemanaActual();

  // Petición que obtiene el total de mensajes enviados al día.
  jQuery.ajax({
    url: "./php/peticion_obtener_conteo_semanal.php",
    type: "POST",
    dataType: "JSON",
    data: {
      postFechaInicial: semana[1][0],
      postFechaFinal: semana[1][1],
    },
    success: function (result) {
      if (typeof result.message === "undefined" && result.data) {
        let datos = result.data;
        let diasContados = contarDias(datos, semana[0][0]);

        graficaMensajesDiarios(diasContados, semana);
      }
      else {
        Swal.fire({
          title: "¡Atención!",
          text: result,
          icon: "error",
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

  contarSemanas();
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
  let mesIni = semana[1][2];
  let mesFin = semana[1][3];
  
  const mensajesDiarios = Highcharts.chart("graficaMensajesDiarios", {
    chart: {
      type: "column",
    },
    title: {
      text:
        "Mensajes Enviados - " +
        semana[0][0] +
        " de " +
        mesIni +
        " a " +
        semana[0][6] +
        " de " +
        mesFin,
    },
    xAxis: {
      categories: [
        "Lunes, " + semana[0][0],
        "Martes, " + semana[0][1],
        "Miercoles, " + semana[0][2],
        "Jueves, " + semana[0][3],
        "Viernes, " + semana[0][4],
        "Sabado, " + semana[0][5],
        "Domingo, " + semana[0][6],
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
      }
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
  let ultimoDiaMes = new Date(fechaActual.getFullYear(), fechaActual.getMonth() + 1, 0).getDate();
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
  let mesSiguiente = mesActual + 1;
  let mesPasado = mesActual - 1;
  let semanaActualReverso = [];
  let rangoSemanal = [];
  let numDia = fechaActual.getDay();
  let dia = fechaActual.getDate();
  let diaInicial = dia;
  entroAlSiguienteMes = false;
  entroAlMesPasado = false;
  // Es domingo.
  if (numDia == 0) {
    numDia = 7;
  }
  // El primer día es un lunes.
  if (numDia == 1) {
    let diaFechaCompleta = new Date(fechaActual.setDate(dia)).toISOString().slice(0, 10);
    
    rangoSemanal.push(diaFechaCompleta);
  }
  semanaActualReverso.push(dia);
  // Mientras que no se llegue al día lunes, retrocedemos los días.
  while (numDia != 1) {
    numDia = numDia - 1;
    // Si el dia llega a 0, se tiene que retroceder al mes anterior...
    if(dia - 1 == 0) {
      entroAlMesPasado = true;
      let mesAnterior = new Date();

      mesAnterior.setDate(0);
      numDia = mesAnterior.getDay();
      dia = mesAnterior.getDate();
      // Si el día retrocedio resulta ser un lunes, se registra la fecha de inicio con el mes anterior...
      if (numDia == 1) {
        let diaFechaCompleta = new Date(fechaActual.setDate(dia));

        diaFechaCompleta.setMonth(fechaActual.getMonth() - 1);
        diaFechaCompleta = diaFechaCompleta.toISOString().slice(0, 10);
        rangoSemanal.push(diaFechaCompleta);
      }
      semanaActualReverso.push(dia);
    }
    // Si no, seguimos retrocediendo los días...
    else {
      dia = dia - 1;
      // Si el día retrocedio resulta ser un lunes, se registra la fecha de inicio con el mes actual.
      if (numDia == 1) {
        if (entroAlMesPasado == true) {
          let diaFechaCompleta = new Date(fechaActual.setDate(dia));

          diaFechaCompleta.setMonth(fechaActual.getMonth() - 1);
          diaFechaCompleta = diaFechaCompleta.toISOString().slice(0, 10);
          rangoSemanal.push(diaFechaCompleta);
        }
        else {
          let diaFechaCompleta = new Date(fechaActual.setDate(dia)).toISOString().slice(0, 10);
  
          rangoSemanal.push(diaFechaCompleta);
        }
      }
      semanaActualReverso.push(dia);
    }
  }
  // Mientras falten los 7 días de la semanas en el arreglo, agregaremos los días desde el día inicial.
  while (semanaActualReverso.length != 7) {
    diaInicial += 1;
    // Si el día supera el ultimo día del mes...
    if (diaInicial > ultimoDiaMes) {
      // Reiniciamos el día, y avisamos que se entró al siguinte mes.
      entroAlSiguienteMes = true;
      diaInicial = 1;
    }
    semanaActualReverso.unshift(diaInicial);
  }
  // ¿Se entró al siguiente mes?
  if (entroAlSiguienteMes == true) {
    // Asignar la fecha del día final con el mes siguiente...
    let diaFechaCompleta = new Date(fechaActual.setDate(diaInicial));

    diaFechaCompleta.setMonth(fechaActual.getMonth() + 2);
    diaFechaCompleta = diaFechaCompleta.toISOString().slice(0, 10);
    rangoSemanal.push(diaFechaCompleta);
  }
  else {
    let diaFechaCompleta = new Date(fechaActual.setDate(diaInicial)).toISOString().slice(0, 10);

    rangoSemanal.push(diaFechaCompleta);
  }
  semanaActualReverso.reverse();
  // Definir si la semana actual entró entre meses.
  if (entroAlMesPasado == true) {
    rangoSemanal.push(meses[mesPasado]);
  }
  else {
    rangoSemanal.push(meses[mesActual]);
  }
  if (entroAlSiguienteMes == true) {
    rangoSemanal.push(meses[mesSiguiente]);
  }
  else {
    rangoSemanal.push(meses[mesActual]);
  }
  let resultados = [semanaActualReverso, rangoSemanal];

  return resultados;
}

// Función que cuenta todos los mensajes obtenidos según el dia de su creación.
function contarDias(datos, diaInicial) {
  // Falta corregir un error de logica... De dia 30 a 01...
  let conteoDias = [0, 0, 0, 0, 0, 0, 0];
  let i = 0;

  datos.forEach((element) => {
    let dia = new Date(element.creado).getDate();

    if (dia == diaInicial) {
      conteoDias[i] += 1;
    }
    else {
      while (diaInicial < dia) {
        diaInicial += 1;
        i += 1;
      }
      conteoDias[i] += 1;
    }
  });
  return conteoDias;
}

function contarSemanas() {
  let fecha = new Date();
  let a = fecha.getFullYear();
  let numMes = fecha.getMonth() + 1;
  let semanasDisponibles = [];

  // Si no es lunes, retroceder e incluir el mes anterior...
  let primerDiaMes = new Date(a, numMes - 1, 1);

  // Si no es domingo, avanzar e incluir el siguiente mes...
  let ultimoDiaMes = new Date(a, numMes, 0);

  // Comenzaremos con el primer día del mes...
  let numDiaIndex = primerDiaMes.getDay();
  let mesAnterior = new Date();

  mesAnterior.setDate(0);
  let dia = mesAnterior.getDate();
  let diaFechaCompleta = mesAnterior;
  let semana = [];

  // Obtener lunes de la primera semana...
  if (numDiaIndex == 1) {
    diaFechaCompleta.setDate(dia);
    semana.push(diaFechaCompleta);
  }
  else if (numDiaIndex == 0) {
    numDiaIndex = 7;
  }
  else {
    while (numDiaIndex != 1) {
      numDiaIndex -= 1;
      if (numDiaIndex == 1) {
        diaFechaCompleta.setDate(dia);
        semana.push(diaFechaCompleta);
      }
      dia = dia - 1;
    }
  }
  numDiaIndex = primerDiaMes.getDay();
  dia = primerDiaMes.getDate();
  diaFechaCompleta = primerDiaMes;
  
  // Obtener domingo de la primera semana...
  if (numDiaIndex == 0) {
    diaFechaCompleta.setDate(dia);
    semana.push(diaFechaCompleta);
  }
  else {
    while (numDiaIndex != 7) {
      numDiaIndex += 1;
      dia = dia + 1;
      if (numDiaIndex == 7) {
        diaFechaCompleta.setDate(dia);
        semana.push(diaFechaCompleta);
      }
    }
  }
  semanasDisponibles.push(semana);

  // Obtener las demás semanas...
  let limDia = dia + 1;
  let primerCiclo = false;

  while (limDia < ultimoDiaMes.getDate()) {
    semana = [];
    dia = dia + 1;
    if (dia > ultimoDiaMes.getDate()) {
      let siguienteMes = new Date(fecha.setDate(1));

      siguienteMes.setMonth(fecha.getMonth() + 1);
      dia = siguienteMes.getDate();
      let numDia = siguienteMes.getDay();
      
      while (numDia != 0) {
        dia += 1;
        numDia += 1;
        if (numDia == 7) {
          numDia = 0;
        }
      }
      siguienteMes.setDate(dia);
      semana.push(siguienteMes);
      semanasDisponibles.push(semana);
      break;
    }
    else {
      diaFechaCompleta.setDate(dia);
      semana.push(diaFechaCompleta);
    }
    // Nota: Simplificar...
    dia = dia + 6;
    if (dia > ultimoDiaMes.getDate()) {
      let siguienteMes = new Date(fecha.setDate(1));

      siguienteMes.setMonth(fecha.getMonth() + 1);
      dia = siguienteMes.getDate();
      let numDia = siguienteMes.getDay();
      
      while (numDia != 0) {
        dia += 1;
        numDia += 1;
        if (numDia == 7) {
          numDia = 0;
        }
      }
      siguienteMes.setDate(dia);
      semana.push(siguienteMes);
      semanasDisponibles.push(semana);
      break;
    }
    else {
      diaFechaCompleta.setDate(dia);
      semana.push(diaFechaCompleta);
    }
    semanasDisponibles.push(semana);
    if (primerCiclo == false) {
      limDia = limDia + 6;
      primerCiclo = true;
    }
    else {
      limDia = limDia + 7;
    }
  }
  // console.log(semana);
  // console.log(semanasDisponibles[0][0]);
  // console.log(semanasDisponibles[0][1]);
  console.log(semanasDisponibles);
}
