const videoPlayer = document.querySelector("#player");
const canvasElement = document.querySelector("#canvas");
const capture = document.querySelector("#capture");
const post = document.querySelector("#post");
const card = document.querySelector("#card");

const width = 320;
const height = 240;
let zIndex = 1;

const createImage = (src, alt, title, width, height, className) => {
  let newImg = document.createElement("img");

  if (src !== null) newImg.setAttribute("src", src);
  if (alt !== null) newImg.setAttribute("alt", alt);
  if (title !== null) newImg.setAttribute("title", title);
  if (width !== null) newImg.setAttribute("width", width);
  if (height !== null) newImg.setAttribute("height", height);
  if (className !== null) newImg.setAttribute("class", className);

  return newImg;
};

const startMedia = () => {
  if (!("mediaDevices" in navigator)) {
    navigator.mediaDevices = {};
  }

  if (!("getUserMedia" in navigator.mediaDevices)) {
    navigator.mediaDevices.getUserMedia = constraints => {
      const getUserMedia =
        navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

      if (!getUserMedia) {
        return Promise.reject(new Error("getUserMedia is not supported"));
      } else {
        return new Promise((resolve, reject) =>
          getUserMedia.call(navigator, constraints, resolve, reject)
        );
      }
    };
  }

  navigator.mediaDevices
    .getUserMedia({ video: true })
    .then(stream => {
      videoPlayer.srcObject = stream;
      videoPlayer.style.display = "block";
    })
    .catch(err => {
      imagePickerArea.style.display = "block";
    });
};

capture.addEventListener("click", event => {
  canvasElement.style.display = "block";
  const context = canvasElement.getContext("2d");
  context.drawImage(videoPlayer, 0, 0, canvas.width, canvas.height);

  videoPlayer.srcObject.getVideoTracks().forEach(track => {
  });

  let video = document.getElementById("video");
  if (video.getAttribute("class") === "m-3") {
    capture.innerText = "Cancelar";
    capture.setAttribute("class", "btn btn-outline-danger");
    video.setAttribute("class", "d-none");
    canvasElement.setAttribute("class", "m-3 border rounded border-2 border-dark");
    canvasElement.style.width = "320px";
    canvasElement.style.height = "240px";

    let picture = canvasElement.toDataURL();

    fetch("/newvisitor", {
      method: "post",
      body: JSON.stringify({ data: picture })
    })
  } else {
    video.setAttribute("class", "m-3");
    canvasElement.setAttribute("class", "d-none");
    capture.innerText = "Capturar";
    capture.setAttribute("class", "btn btn-danger");
  }
});

post.addEventListener("click", event => {
  let image = document.createElement("input");
  image.type = 'text';
  image.name = 'image';
  image.value = new Date().toISOString().replace(/T/, ' ').replace(/\..+/, '') + '.png';
  card.appendChild(image);
});

window.addEventListener("load", event => startMedia());