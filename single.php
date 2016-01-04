<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" type="image/x-icon" href="img/logo-small.ico" />
    <title>Liar's Dice</title>

    <!-- Bootstrap Core CSS -->
 	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

</head>
<body>
<style type="text/css">
a{
	display: block;
	text-decoration: none;
	color: #000;
}
#spot-on div{
	background-color: yellow;
	color: #000;
	padding: 5px;
	text-decoration: none;
}
#bluff div{
	background-color: blue;
	color: #fff;
	padding: 5px;
	text-decoration: none;
}
#bid div{
	background-color: green;
	color: #fff;
	padding: 5px;
	text-decoration: none;
}
.black{
	background-color: black;
}

h1{
	text-align:center;
}
.minus div{
	background-color: #000;
	color: #fff;
	border-style: solid;
    border-width: 5px;
    border-color: #000;
}
.plus div{
	background-color: #fff;
	color: #000;
	border-style: solid;
    border-width: 5px;
    border-color: #000;
}
html,body{
	height: 100%;
}
.face-preview{
	padding-bottom: 20px;
	max-width: 57px;
}
.player-card{
	border-style: solid;
	border-width: 5px;
    border-color: #000;
}
.player-card img{
	width:75px;
}
.active{
	background-color: #909090;
}
</style>








<div class="container">
	<div class="field">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="players">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="log">	
			</div>
		</div>
	</div>
	<div class="row selection">
		<div class="col-xs-6">
			<div class="row">
				<a id="count-up"class="plus"href="#">
					<div  class="col-xs-4">
						<h1>+</h1>
					</div>
				</a>
				<a class="plus" id="face-up" href="#">
					<div class="col-xs-4 col-xs-offset-2">
						<h1>+</h1>
					</div>
				</a>
			</div>
			<div class="row">
				<div id="count" class="col-xs-4">
					<h1>hi</h1>
				</div>
				<div class="col-xs-2">
					<h1>X</h1>
				</div>
				<div id="face" class="col-xs-4">
					<h1>hi</h1>
				</div>
			</div>
			<div class="row">
				<a id="count-down" class="minus" href="#">
					<div class="col-xs-4">
						<h1>-</h1>
					</div>
				</a>
				<a class="minus" id="face-down" href="#">
					<div class="col-xs-4 col-xs-offset-2">
						<h1>-</h1>
					</div>
				</a>
			</div>
		</div>
		<div class="col-xs-2">
			<a id="bluff"href="#">
				<div>
					<h1>Call Bluff!</h1>
				</div>
			</a>
			<a id="spot-on" href="#">
				<div>
					<h1>Spot On!</h1>
				</div>
			</a>
			<a id="bid"href="#">
				<div>
					<h1>Bid!</h1>
				</div>
			</a>
		</div>
	</div>
</div>	
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript">

var wheight = $(window).height();
	$(window).resize(function() {
        wheight = $(window).height(); //get the height of the window 
		$(".field").css("height", wheight - 300);
    });
$(".field").css("height", wheight - 300);


/*
NOTES

when passing turn call the move function

finish other options spot-on etc




*/









////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////// GLOBAL FUNCTIONS///////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////

//All bids follow the convention [number, face, signature]
var current_bid = [1, 1, "You"];



function int2s(int){
	if (int == 1){
		return "one";
	}else if(int == 2){
		return "two";
	}else if (int == 3){
		return "three";
	}else if (int == 4){
		return "four";
	}else{
		return "five";
	}
}

function show_dice(){
	User.drawRoll();
	Player2.drawRoll();
	Player3.drawRoll();
	Player4.drawRoll();
	Player5.drawRoll();
}

function teamShuffle(){
	User.updateDice(true);
	Player2.updateDice(true);
	Player3.updateDice(true);
	Player4.updateDice(true);
	Player5.updateDice(true);
}






////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////// PLAYER FUNCTIONS///////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
var num_players = 5;

var Player = function (id, name) {
  this.id = id;
  this.name = name;
  this.inGame = true;
  this.numDice = 5;
  this.myRoll = [];
  this.draw();

  this.updateDice(true);
};

Player.prototype.takeDie = function() {
	//take a die from a Player
  this.numDice--;
};

Player.prototype.draw = function(){
	//draw the player card on the DOM
	$(".players").append("<div id='player-field-"+ this.id+"' class='row player-field'><div class='col-sm-12 player-card'><div class='col-xs-2'><img src='p"+ this.id +".svg'></div><div class='col-xs-1'>"+this.name+"</div><div id='player"+this.id+"' class='col-xs-6'></div></div></div>");
};

Player.prototype.roll = function(){
	//randomize myRoll
	this.myRoll = [];
	for(i=0; i < this.numDice; i++){
		this.myRoll.push(Math.floor((Math.random() * 6) + 1));
	}
};

Player.prototype.drawRoll = function(){
	//draw the user's dice on the DOM
	var dest = "#player"+this.id;
	$(dest).html('');
	for(i=0;i<this.numDice;i++){
   		side = this.myRoll[i];
		$(dest).append("<div class='col-xs-2'><img style='padding:5px;' width='50px'src=" + side.toString() + ".svg></div>");
	}
};

Player.prototype.drawBlank = function(){
	//draw blanks on the DOM
	var dest = "#player"+this.id;
	$(dest).html('');
	for(i=0;i<this.numDice;i++){
   		side = this.myRoll[i];
		$(dest).append("<div class='col-xs-2'><img style='padding:5px;' width='50px'src='1.svg'></div>");
	}
};

Player.prototype.updateDice = function(bool){
	if(bool){
		this.roll();
	}
  	if (this.id == 1){
  		this.drawRoll();
  	}else{
  		this.drawBlank();
  	}
};
Player.prototype.roundUp = function(){
	this.takeDie();
	this.updateDice(false);
	teamShuffle();
	current_bid=[1,1,"default"];
	updateSelection(current_bid);
};

Player.prototype.passTurn = function(){
	//passes the turn to the next player in the sequence
	if (this.myTurn){
		this.myTurn = false;
		if (this.id == 1) {
			Player2.myTurn = true;
			$("#player-field-2").addClass("active");
			$("#player-field-1").removeClass("active");
			$(".log").html("<h1>"+Player2.name+"'s Turn</h1>");
		}
		else if (this.id == 2) {
			Player3.myTurn = true;
			$("#player-field-3").addClass("active");
			$("#player-field-2").removeClass("active");
			$(".log").html("<h1>"+Player3.name+"'s Turn</h1>");
		}
		 else if (this.id == 3) {
			Player4.myTurn = true;
			$("#player-field-4").addClass("active");
			$("#player-field-3").removeClass("active");
			$(".log").html("<h1>"+Player4.name+"'s Turn</h1>");
		}
		else if (this.id == 4) {
			Player5.myTurn = true;
			$("#player-field-5").addClass("active");
			$("#player-field-4").removeClass("active");
			$(".log").html("<h1>"+Player5.name+"'s Turn</h1>");
		}
		else{
			Player1.myTurn = true;
			$("#player-field-1").addClass("active");
			$("#player-field-5").removeClass("active");
			$(".log").html("<h1>"+Player1.name+"'s turn.</h1>");
		}
	}
};

Player.prototype.callBluff = function(bid){
	//initiate bluff sequence
	//--all players dice reveled
	//--total calculated and winer determined
	
	$(".log").html("<h1>"+ this.name + " called the bluff.</h1>");
	
	show_dice();
	var user_has = User.totalDice(bid[1]);
	var p2_has = Player2.totalDice(bid[1]);
	var p3_has = Player3.totalDice(bid[1]);
	var p4_has = Player4.totalDice(bid[1]);
	var p5_has = Player5.totalDice(bid[1]);
	
	setTimeout(function(){($(".log").html("<h1>You show "+user_has+" " + int2s(bid[1]) +"'s, totaling " + user_has +".</h1>"));}, 2000);
	setTimeout(function(){$(".log").html("<h1>"+Player2.name+" shows "+p2_has+" " + int2s(bid[1]) +"'s, totaling " + (user_has+p2_has)+".</h1>");}, 4000);
	setTimeout(function(){$(".log").html("<h1>"+Player3.name+" shows "+p3_has+" " + int2s(bid[1]) +"'s, totaling " + (user_has+p2_has+p3_has)+".</h1>");}, 6000);
	setTimeout(function(){$(".log").html("<h1>"+Player4.name+" shows "+p4_has+" " + int2s(bid[1]) +"'s, totaling " + (user_has+p2_has+p3_has+p4_has)+".</h1>");}, 8000);
	setTimeout(function(){$(".log").html("<h1>"+Player5.name+" shows "+p5_has+" " + int2s(bid[1]) +"'s, totaling " + (user_has+p2_has+p3_has+p4_has+p5_has)+".</h1>");}, 10000);
	if ((user_has+p2_has+p3_has+p4_has+p5_has) > bid[0]){
	setTimeout(function(){$('.log').html("<h1>"+this.name+" was wrong. There was at least " + bid[0] + ".</h1>");}, 12000);
	setTimeout(function(){$('.log').html("<h1>"+this.name+" lost a die for lying.");}, 14000);
	}else{
	setTimeout(function(){$('.log').html("<h1>"+this.name+" was right. There was not " + bid[0] + " "+ int2s(bid[1]) +"'s.</h1>");}, 12000);
	setTimeout(function(){$('.log').html("<h1>"+bid[2]+" lost a die for bluffing.");}, 14000);
	}
	
	setTimeout(function doit(){
		this.roundUp();
	},16000);
		
	
};


Player.prototype.spotOn = function(){
	//init spotOn sequence 
	//--all players dice revealed
	//total calculated and winner determined

};

Player.prototype.makeBid = function(bid){
	//generic make bid function
	//
	current_bid = bid;
	$('.log').html("<h1>"+this.name +" says there are "+ bid[0] + " " + int2s(bid[1]) +"'s.</h1>")
};

Player.prototype.incBid = function(){
	//make bid that is an increment of current bid
	var bid = jQuery.extend([], current_bid);
	this.makeBid(bid[0]++);
};

Player.prototype.calcBid = function(){
	//calculate a reasonable bid dependant on curren situation
	// -- decide if should lie
	// -- if myRoll can form elegeble bid then do so
	// -- otherwise calculate a safe bid

};

Player.prototype.totalDice = function(face){
	//tallys the total number of dice for a give face that a player has
	var what_i_got = 0;
	for(i=0;i<this.numDice;i++){
		if(this.myRoll[i] == face){
			what_i_got++;
			console.log(what_i_got);
		}
	}
	return what_i_got;
};

Player.prototype.move = function(){
	//Player decides what move to make
	var unknown_dice = num_dice - this.numDice;
	var probability = (1/6) * unknown_dice;
	//count how many of a face player has
	if (current_bid[0] > probability + this.totalDice(current_bid[1])){
		callBluff(this.id);
	}else if(current_bid[0] == probability + what_i_got){
		if (Math.floor((Math.random() * 6) + 1) > 3){
			spotOn();
		}else{
			incBid();
		}
	}else{
		calcBid();
	}

};

var User = new Player(1, 'You');
//User.drawRoll();

var Player2 = new Player(2, 'Rachel');
var Player3 = new Player(3, 'Mike');
var Player4 = new Player(4, 'Peter');
var Player5 = new Player(5, 'Marcy');


var num_dice =User.numDice + Player2.numDice + Player3.numDice + Player4.numDice + Player5.numDice;

////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////// SELECTION FUNCTIONS////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////

function updateSelection(bid){
	$("#count").html("<h1>" + bid[0].toString() +"</h1>");
	$("#face").html("<img class='center-block face-preview' src='"+ bid[1].toString() + ".svg'>");
}

$('#count-up').click(function () {
	if(my_bid[0] < num_dice){
		my_bid[0]++;
		updateSelection(my_bid);
	}
});

$('#count-down').click(function () {
	if (my_bid[0] > current_bid[0]){
		my_bid[0]--;
		updateSelection(my_bid);	
	}
	if(my_bid[0] == current_bid[0]){
		updateSelection(current_bid);
		my_bid = jQuery.extend([], current_bid);
	}
});
$('#face-down').click(function () {
	if ((my_bid[1] > 1)&&(my_bid[0] > current_bid[0])){
		my_bid[1]--;
		updateSelection(my_bid);
	}
});
$('#face-up').click(function () {
	if (my_bid[1] < 6){
		my_bid[1]++;
		updateSelection(my_bid);
	}
});

$('#bid').click(function(){
	if (my_bid == current_bid){
		$('.log').html("<h1>You must bid higher than the current bid.</h1");
	}else{
		User.makeBid(my_bid);
		User.passTurn();
	}
});

$('#bluff').click(function(){
	User.callBluff(current_bid);
});

////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////// USER FUNCTIONS///////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////

var my_bid = jQuery.extend([], current_bid);


updateSelection(current_bid);

$('#player-field-1').addClass('active');





////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////// GAME FUNCTIONS///////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////


</script>		
	
</body>


</html>