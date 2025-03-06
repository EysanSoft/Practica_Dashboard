(() => {
  let preview = document.getElementById("preview");
  let recording = document.getElementById("recording");
  let startButton = document.getElementById("startButton");
  let stopButton = document.getElementById("stopButton");
  let downloadButton = document.getElementById("downloadButton");
  let logElement = document.getElementById("log");
  let outputDiv = document.getElementById("output-div-2");
  let recordingTimeMS = 5000;

  function log(msg) {
    logElement.innerText += `${msg}\n`;
  }

  function wait(delayInMS) {
    return new Promise((resolve) => setTimeout(resolve, delayInMS));
  }

  function startRecording(stream, lengthInMS) {
    let recorder = new MediaRecorder(stream);
    let data = [];

    recorder.ondataavailable = (event) => data.push(event.data);
    recorder.start();
    log(`Grabando por ${lengthInMS / 1000} segundos…`);

    let stopped = new Promise((resolve, reject) => {
      recorder.onstop = resolve;
      recorder.onerror = (event) => reject(event.name);
    });

    let recorded = wait(lengthInMS).then(() => {
      if (recorder.state === "recording") {
        recorder.stop();
      }
    });

    return Promise.all([stopped, recorded]).then(() => data);
  }

  function stop(stream) {
    stream.getTracks().forEach((track) => track.stop());
  }

  startButton.addEventListener(
    "click",
    () => {
      preview.style.display = "inline";
      logElement.innerHTML = "";
      navigator.mediaDevices
        .getUserMedia({
          video: true,
          audio: true,
        })
        .then((stream) => {
          preview.srcObject = stream;
          downloadButton.href = stream;
          preview.captureStream =
            preview.captureStream || preview.mozCaptureStream;
          return new Promise((resolve) => (preview.onplaying = resolve));
        })
        .then(() => startRecording(preview.captureStream(), recordingTimeMS))
        .then((recordedChunks) => {
          let recordedBlob = new Blob(recordedChunks, { type: "video/webm" });
          recording.src = URL.createObjectURL(recordedBlob);
          downloadButton.href = recording.src;
          downloadButton.download = recording.src.split("/").pop();
          outputDiv.style.display = "block";
          log(
            `Se grabó con éxito ${recordedBlob.size} bytes de video tipo ${recordedBlob.type}.`
          );
        })
        .catch((error) => {
          if (error.name === "NotFoundError") {
            log("No se encontró camara o micrófono.");
          } else {
            log(error);
          }
        });
    },
    false
  );

  stopButton.addEventListener(
    "click",
    () => {
      stop(preview.srcObject);
    },
    false
  );
})();
