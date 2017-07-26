//做棋盘类游戏时，注意精灵的“表现位置”和“实际位置”，
//表现位置：实际的x，y坐标，变化时可能通过动画
//实际位置：第几行、第几列，变化时直接指定

var game = new Phaser.Game(800, 600, Phaser.CANVAS, 'phaser-example');

var PIECE_WIDTH,
    PIECE_HEIGHT,
    BOARD_COLS,
    BOARD_ROWS;


//传入列数和行数自动算出 碎片的宽高
function PieceScene(a,b){
	BOARD_COLS=a;//列数
	BOARD_ROWS=b;//行数
    PIECE_WIDTH = game.world.width / BOARD_COLS;
    PIECE_HEIGHT = game.world.height / BOARD_ROWS;
}

var piecesGroup,
    piecesAmount,
    shuffledIndexArray = [];


var scene1={
	preload:function () {
		PieceScene(3,2);
    	game.load.spritesheet("background", "assets/puzzle/1.jpg", PIECE_WIDTH,PIECE_HEIGHT);
	},
	create:function() {
  	  prepareBoard();
	}
}
var scene2={
	preload:function () {
		PieceScene(4,3);
    	game.load.spritesheet("background", "assets/puzzle/1.jpg", PIECE_WIDTH,PIECE_HEIGHT);
	},
	create:function() {
  	  prepareBoard();
	}
}
var scene3={
	preload:function () {
		PieceScene(5,4);
    	game.load.spritesheet("background", "assets/puzzle/2.jpg", PIECE_WIDTH,PIECE_HEIGHT);
	},
	create:function() {
  	  prepareBoard();
	}
}

var scene4={
	preload:function () {
		PieceScene(6,5);
    	game.load.spritesheet("background", "assets/puzzle/2.jpg", PIECE_WIDTH,PIECE_HEIGHT);
	},
	create:function() {
  	  prepareBoard();
	}
}

function prepareBoard() {
    var piecesIndex = 0,
        i, j,
        piece;

    /*BOARD_COLS = Math.floor(game.world.width / PIECE_WIDTH);//列数
    BOARD_ROWS = Math.floor(game.world.height / PIECE_HEIGHT);//行数*/
   
	//碎片数量
    piecesAmount = BOARD_COLS * BOARD_ROWS;

    shuffledIndexArray = createShuffledIndexArray();//乱序数组

    //块组
    piecesGroup = game.add.group();

    for (i = 0; i < BOARD_ROWS; i++)
    {
        for (j = 0; j < BOARD_COLS; j++)
        {
            if (shuffledIndexArray[piecesIndex]) {
                piece = piecesGroup.create(j * PIECE_WIDTH, i * PIECE_HEIGHT, "background", shuffledIndexArray[piecesIndex]);
            }
            else { //initial position of black piece
                //把0的置为空
                piece = piecesGroup.create(j * PIECE_WIDTH, i * PIECE_HEIGHT);
                piece.black = true;
            }
            piece.name = 'piece' + i.toString() + 'x' + j.toString();
            piece.currentIndex = piecesIndex;//当前所在位置index
            piece.destIndex = shuffledIndexArray[piecesIndex];//本块该在的位置index
            piece.inputEnabled = true;
            piece.events.onInputDown.add(selectPiece, this);
            piece.posX = j;//当前位置x
            piece.posY = i;//当前位置y
            piecesIndex++;
        }
    }

}

function selectPiece(piece) {

    var blackPiece = canMove(piece);//寻找与点击块相邻的黑块

    //if there is a black piece in neighborhood
    if (blackPiece) {//如果找到了
        movePiece(piece, blackPiece);
    }

}

//寻找与点击块相邻的黑块
function canMove(piece) {

    var foundBlackElem = false;

    //遍历块组，看看黑块是否与点击块相邻
    piecesGroup.children.forEach(function(element) {
        if (element.posX === (piece.posX - 1) && element.posY === piece.posY && element.black ||
            element.posX === (piece.posX + 1) && element.posY === piece.posY && element.black ||
            element.posY === (piece.posY - 1) && element.posX === piece.posX && element.black ||
            element.posY === (piece.posY + 1) && element.posX === piece.posX && element.black) {
            foundBlackElem = element;
            return;
        }
    });

    return foundBlackElem;
}

//交换两个块的位置
function movePiece(piece, blackPiece) {

    var tmpPiece = {
        posX: piece.posX,
        posY: piece.posY,
        currentIndex: piece.currentIndex
    };

    //表现位置：移动点击块
    game.add.tween(piece).to({x: blackPiece.posX * PIECE_WIDTH, y: blackPiece.posY * PIECE_HEIGHT}, 300, Phaser.Easing.Linear.None, true);
    //黑块不可见，所以不用移动表现位置，如果移动就是下面这样
    //game.add.tween(blackPiece).to({x: piece.posX * PIECE_WIDTH, y: piece.posY * PIECE_HEIGHT}, 300, Phaser.Easing.Linear.None, true);

    //change places of piece and blackPiece
    //逻辑位置：交换点击块与黑块
    piece.posX = blackPiece.posX;
    piece.posY = blackPiece.posY;
    piece.currentIndex = blackPiece.currentIndex;
    piece.name ='piece' + piece.posX.toString() + 'x' + piece.posY.toString();

    //piece is the new black
    //逻辑位置：交换点击块与黑块
    blackPiece.posX = tmpPiece.posX;
    blackPiece.posY = tmpPiece.posY;
    blackPiece.currentIndex = tmpPiece.currentIndex;
    blackPiece.name ='piece' + blackPiece.posX.toString() + 'x' + blackPiece.posY.toString();

    //after every move check if puzzle is completed
    checkIfFinished();
}

//是否已完成拼图
function checkIfFinished() {

    var isFinished = true;

    piecesGroup.children.forEach(function(element) {
        if (element.currentIndex !== element.destIndex) {//找未完成的块
            isFinished = false;
            return;
        }
    });

    if (isFinished) {//如果已完成了，显示庆祝字样
        showFinishedText();
       	//game.state.start('scene2');
    }

}

//显示庆祝字样
function showFinishedText() {

    var style = { font: "40px Arial", fill: "#000", align: "center"};

    //var text = game.add.text(game.world.centerX, game.world.centerY, "Congratulations! \nYou made it!", style);
	var imgpiece=game.add.image(0,0,"background");
    //text.anchor.set(0.5);
    imgpiece.anchor.set(0);

}

//创造乱序数组，是先创造有序数组，再打乱之
function createShuffledIndexArray() {

    var indexArray = [];

    for (var i = 0; i < piecesAmount; i++)
    {
        indexArray.push(i);
    }

    return shuffle(indexArray);

}

//打乱数组顺序
//例如一共8个块，先随机找一个换到下标7的位置，再随机找一个换到下标6的位置..
function shuffle(array) {

    var counter = array.length,
        temp,
        index;

    while (counter > 0)
    {
        index = Math.floor(Math.random() * counter);

        counter--;

        temp = array[counter];
        array[counter] = array[index];
        array[index] = temp;
    }

    return array;
    
}

game.state.add('scene1',scene1);
game.state.add('scene2',scene2);
game.state.add('scene3',scene3);
game.state.add('scene4',scene4);
game.state.start('scene1');

window.addEventListener('load',function(){
	document.getElementById('scene1').onclick=function(){
		game.state.start('scene1');
	}
	document.getElementById('scene2').onclick=function(){
		game.state.start('scene2');
	}
	document.getElementById('scene3').onclick=function(){
		game.state.start('scene3');
	}
	document.getElementById('scene4').onclick=function(){
		game.state.start('scene4');
	}
});
 