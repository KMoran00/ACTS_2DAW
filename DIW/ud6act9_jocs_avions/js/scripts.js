

// ----------------------------------------------------
// CONSTANTS I VARIABLES GLOBALS DEL JOC
// ----------------------------------------------------

//Aquesta constant simbolitza la velocitat.
//Realment és el número de píxels que ens movem
//en la pantalla quan prémem una de les tecles de
//moviment
const pixels_a_moure = 15;

// Variables globals del joc
let avio, joc, musicaFons, soAvio;
let musicaActiva = true;
let modalObert = false; //bloqueja accions mentre el modal està obert
let ultimaDireccio = "right"; //direcció cap a la dreta per defecte


// ----------------------------------------------------
// FUNCIONS DE MOVIMENT
// ----------------------------------------------------
/**
 * Moure l'avió cap a l'esquerra
 */
function moureEsquerra() {
  let pos = getAvioPos();
  if (pos.left > 0) {
    ultimaDireccio = "esquerra";
    avio.style.left = pos.left - pixels_a_moure + "px";
    avio.style.backgroundImage = "url('img/sprites/avioMovEsquerra.png')";
    reproduirSoMoviment();
    setTimeout(() => avio.style.backgroundImage = "url('img/sprites/avioEsquerra.png')", 150);
  }
}

/**
 * Moure l'avió cap a la dreta
 */
function moureDreta() {
  let pos = getAvioPos();
  const limitDret = window.innerWidth - avio.offsetWidth;
  if (pos.left < limitDret) {
    ultimaDireccio = "dreta";
    avio.style.left = pos.left + pixels_a_moure + "px";
    avio.style.backgroundImage = "url('img/sprites/avioMoviDreta.png')";
    reproduirSoMoviment();
    setTimeout(() => avio.style.backgroundImage = "url('img/sprites/avioDreta.png')", 150);
  }
}

/**
 * Moure l'avió cap amunt
 */
function moureAmunt() {
  let pos = getAvioPos();
  if (pos.top > 0) {
    avio.style.top = pos.top - pixels_a_moure + "px";
    //Imatge en moviment segons la direcció actual
    if (ultimaDireccio === "dreta")
      avio.style.backgroundImage = "url('img/sprites/avioMoviDreta.png')";
    else
      avio.style.backgroundImage = "url('img/sprites/avioMovEsquerra.png')";
    reproduirSoMoviment();
  }
}

/**
 * Moure l'avió cap avall
 */
function moureAvall() {
  let pos = getAvioPos();
  const limitBaix = window.innerHeight - avio.offsetHeight - 100;
  if (pos.top < limitBaix) {
    avio.style.top = pos.top + pixels_a_moure + "px";
    //Imatge en moviment segons la direcció actual
    if (ultimaDireccio === "dreta")
      avio.style.backgroundImage = "url('img/sprites/avioMoviDreta.png')";
    else
      avio.style.backgroundImage = "url('img/sprites/avioMovEsquerra.png')";
    reproduirSoMoviment();
  }
}

// ------------------------
// UTILITATS
// ------------------------
function passarANumero(n) {
  return parseInt(n == "auto" ? 0 : n);
}

/**
 * Aquesta funció en torna una objecte amb la posició actual de l'avió a la pantalla
 * return obj.left --> posició de l'avió de l'eix X
 *        obj.top --> posició de l'avió de l'eix Y
 */
function getAvioPos() {
  return {
    left: passarANumero(getComputedStyle(avio).left),
    top: passarANumero(getComputedStyle(avio).top),
  };
}

/**
 * Reproduir el so de moviment de l’avió
 */
function reproduirSoMoviment() {
  if (!soAvio) return;
  soAvio.currentTime = 0;
  soAvio.play().catch(() => {});
}

// ----------------------------------------------------
// CONTROL DEL TECLAT
// ----------------------------------------------------

/**
 * Funció encarregada de controlar quina tecla s'ha "apretat"
 * @param {*} evt: event que es llança
 */
function moureAvio(evt) {
  switch (evt.keyCode) {
    case 37:
      //Fletxa esquerra
      ultimaDireccio = "left";
      moureEsquerra();
      break;
    case 39:
      //Fletxa dreta
      ultimaDireccio = "right";
      moureDreta();
      break;
    case 38:
      /** hem apretat la tecla de fletxa amunt */
      moureAmunt();
      break;
    case 40:
      /** hem apretat la tecla de fletxa avall */
      moureAvall();
      break;
    case 49: // tecla "1"
      // Alternar la música de fons
      if (musicaActiva) {
        musicaFons.pause();
      } else {
        musicaFons.play();
      }
      musicaActiva = !musicaActiva;
      break;

  }
}

function pararAvio() {
  console.log("parem l'avió");
}


// ----------------------------------------------------
// CANVI DE NIVELL
// ----------------------------------------------------

function canviarNivell(num) {
  if (modalObert) return;
  document.body.style.backgroundImage = `url('img/fons_nivells/nivell${num}.jpg')`;
}
// ------------------------
// Finestra modal d’ajuda
// ------------------------
function configurarModal() {
  panellAjuda = document.getElementById("panellAjuda");
  const botoAjuda = document.getElementById("ajuda");
  const botoTancar = document.querySelector(".tancar");

  botoAjuda.addEventListener("click", () => {
    modalObert = true;
    panellAjuda.style.display = "block";
  });

  botoTancar.addEventListener("click", () => {
    modalObert = false;
    panellAjuda.style.display = "none";
  });

}

// ------------------------
// Inicialització
// ------------------------
function docReady() {
  avio = document.getElementById("avio");
  musicaFons = document.getElementById("musicaFons");
  soAvio = document.getElementById("soAvio");

  avio.style.left = "0px";
  avio.style.top = "0px";

  musicaFons.play().catch(() => {});

  window.addEventListener("keydown", moureAvio);
  window.addEventListener("keyup", pararAvio);


  configurarModal();
}