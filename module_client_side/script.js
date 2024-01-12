let cnv;
let ctx;
let canvasW;
let canvasH;

let board;

function onload() {
  cnv = document.getElementById("cnv");
  ctx = cnv.getContext("2d");
  canvasW = cnv.width;
  canvasH = cnv.height;

  window.addEventListener("keydown", keyType);
}

let gridSize = 20;
let totalGridW = 48;
let totalGridH = 30;
let trail = [];
let tail = 6;
let snakeX = 4;
let snakeY = 5;
let snakeXV = 1;
let snakeYV = 0;
let pelletX = 6;
let pelletY = 7;
let pellet = [
  {
    pelletX: 3,
    pelletY: 4,
  },
  {
    pelletX: 5,
    pelletY: 6,
  },
  {
    pelletX: 12,
    pelletY: 9,
  },
];

function game() {
  //draw background
  //   ctx.fillStyle = "black";
  //   ctx.fillRect(0, 0, canvasW, canvasW);

  board = new Image();
  board.src = "./assets/images/board2.jpg";

  ctx.drawImage(board, 0, 0);

  //draw snake
  ctx.fillStyle = "yellow";
  for (let i = 0; i < trail.length; i++) {
    ctx.fillRect(
      trail[i].x * gridSize + 1,
      trail[i].y * gridSize + 1,
      gridSize - 2,
      gridSize - 2
    );
    if (trail[i].x === snakeX && trail[i].y === snakeY) {
     gameOver()
    }
  }

  //collision
  if (snakeX * gridSize + gridSize > canvasW) {
    snakeX = 0;
  } else if (snakeX * gridSize < 0) {
    snakeX = canvasW / gridSize;
  } else if (snakeY * gridSize + gridSize > canvasH) {
    snakeY = 0;
  } else if (snakeY * gridSize < 0) {
    snakeY = canvasH / gridSize;
  }

  //push tail to trail array
  trail.push({ x: snakeX, y: snakeY });
  //splice if trail > tail
  while (trail.length > tail) {
    trail.splice(0, 1);
  }

  //vilositi
  snakeX += snakeXV;
  snakeY += snakeYV;

  //draw pellet
  ctx.fillStyle = "red";
  for (let i = 0; i < pellet.length; i++) {
    ctx.fillRect(
      pellet[i].pelletX * gridSize,
      pellet[i].pelletY * gridSize,
      gridSize,
      gridSize
    );
    //if pallet == snakeX & snakeY
    if (pellet[i].pelletX === snakeX && pellet[i].pelletY === snakeY) {
      pellet[i].pelletX = parseInt(Math.random(0, 1) * 48 + 1);
      pellet[i].pelletY = parseInt(Math.random(0, 1) * 30 + 1);
      tail++;
    }
  
  }

  //draw score
  ctx.textFill("lasd")
  ctx.drawText("sldkf");
}

function keyType(env) {
  switch (env.keyCode) {
    case 37: //kiri
      if (snakeXV != 1) {
        snakeXV = -1;
        snakeYV = 0;
      }
      break;
    case 38:
      if (snakeYV != 1) {
        snakeXV = 0;
        snakeYV = -1;
      }
      break;
    case 39:
      if (snakeXV != -1) {
        snakeXV = 1;
        snakeYV = 0;
      }
      break;
    case 40:
      if (snakeYV != -1) {
        snakeXV = 0;
        snakeYV = 1;
      }
      break;
  }
}

function startGame() {

  document.getElementById("start").style.display = "none"
  document.getElementById("game").style.display = "block"
  document.getElementById("end").style.display = "none"

  onload();
  setInterval(() => {
    game();
  }, 1000 / 5);
}

function gameOver() {
  document.getElementById("start").style.display = "none"
  document.getElementById("game").style.display = "none"
  document.getElementById("end").style.display = "block"
}
