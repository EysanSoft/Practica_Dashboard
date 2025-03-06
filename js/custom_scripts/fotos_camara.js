(() => {
  let width = 320;
  let height = 0;
  let streaming = false;
  let video = null;
  let canvas = null;
  let photo = null;
  let startButton = null;
  let saveButton = null;
  let outputDiv = null;

  function startup() {
    video = document.getElementById("video");
    canvas = document.getElementById("canvas");
    photo = document.getElementById("photo");
    startButton = document.getElementById("start-button");
    saveButton = document.getElementById("save-button");
    // Esto es adicional, por estética y para evitar guardar el canvas en gris.
    outputDiv = document.getElementById("output-div");

    navigator.mediaDevices
      .getUserMedia({ video: true, audio: false })
      .then((stream) => {
        video.srcObject = stream;
        video.play();
      })
      .catch((err) => {
        console.error(`An error occurred: ${err}`);
      });

    video.addEventListener(
      "canplay",
      (ev) => {
        if (!streaming) {
          height = (video.videoHeight / video.videoWidth) * width;

          video.setAttribute("width", width);
          video.setAttribute("height", height);
          canvas.setAttribute("width", width);
          canvas.setAttribute("height", height);
          streaming = true;
        }
      },
      false
    );

    startButton.addEventListener(
      "click",
      (ev) => {
        takePicture();
        ev.preventDefault();
      },
      false
    );

    saveButton.addEventListener(
      "click",
      (ev) => {
        savePicture();
        ev.preventDefault();
      },
      false
    );

    clearPhoto();
  }

  function clearPhoto() {
    const context = canvas.getContext("2d");
    context.fillStyle = "#AAA";
    context.fillRect(0, 0, canvas.width, canvas.height);

    const data = canvas.toDataURL("image/png");
    photo.setAttribute("src", data);
  }

  function takePicture() {
    const context = canvas.getContext("2d");

    outputDiv.style.display = 'block';
    if (width && height) {
      canvas.width = width;
      canvas.height = height;
      context.drawImage(video, 0, 0, width, height);

      const data = canvas.toDataURL("image/png");
      photo.setAttribute("src", data);
    }
    else {
      clearPhoto();
    }
  }

  function savePicture() {
    let a = document.createElement('a');
    let url = photo.getAttribute("src");

    a.href = url;
    a.download = url.split('/').pop();
    a.click();
  }

  window.addEventListener("load", startup, false);
})();
