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
 	<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<style type="text/css">
.table{
	padding-top: 20%;
}
.take-btn{
	
	background-color: #ff1a75;
	color: #fff;
}
a.take-btn {
	display: block;
	text-decoration: none;
}
.take-btn:hover{
	background-color: #ff0065;
}

.roll-btn{
	
	background-color: #4dff86;
	color: #fff;
}
a.roll-btn {
	display: block;
	text-decoration: none;
}
.roll-btn:hover{
	background-color: #1aff63;
}

.hide-btn{
	
	background-color: #404040;
	color: #fff;
}
a.hide-btn {
	display: block;
	text-decoration: none;
}
.hide-btn:hover{
	background-color: #303030;
}

html,body{
    height: 100%
}
</style>
</head>

<body>
<div style="height:50px;"class="cheat-proof"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-1 table"></div>
		</div>
	</div>
	<div class="container btn-row">
		<div class="row">
			<a href="#" id="hide">
				<div class="col-xs-6 col-xs-offset-3 hide-btn">
					<h3 align="center">Hide</h3>
				</div>
			</a>
		</div>
		<div class="row">
			<a href="#" id="take">
				<div class="col-xs-6 take-btn">
					<h3 align="center">Take!</h3>
				</div>
			</a>
			<a href="#" id="roll">
				<div class="col-xs-6 roll-btn">
					<h3 align="center">Roll!</h3>
				</div>
			</a>
		</div>
	</div>
</body>

<script type="text/javascript">
	var dice_count = 5;
	var cheat_colors = ["#ff6600","#00ccff","#00ff00","#ffff00", "#ff0000"];
	var num_colors = cheat_colors.length;
	var index = 0

	var wheight = $(window).height();
	$(window).resize(function() {
        wheight = $(window).height(); //get the height of the window 
        var height_adj = $(".btn-row").height();
		$(".table").css("height", wheight - height_adj - 70);
    });

	function roll(){
   		side = Math.floor((Math.random() * 6) + 1);
		$(".table").append("<div class='col-xs-3 col-sm-2'><img src=" + side.toString() + ".svg></div>");
	}
	function cycle(){
		if (index == num_colors){
			index = 0;
		} 
		$(".cheat-proof").css("background-color", cheat_colors[index]);
		index++;
	}
	function clear_table(){
		$(".table").html("");
	}
	cycle();
	for(w=0; w < 5; w++){
		roll();
	}
	$('#take').click(function () {
		clear_table();
		dice_count--;
		for(c=0; c < dice_count; c++){
			roll();
		}
		cycle();
		if (dice_count <= 0){
			$(".table").html("<h1>You have lost.</h1>");
		}
    });
	$('#roll').click(function (){
		clear_table();
		for(c=0; c < dice_count; c++){
			roll();
		}
		cycle();
		if (dice_count <= 0){
			$(".table").html("<h1>You have lost.</h1>");
		}
	});

	var height_adj = $(".btn-row").height();
	$(".table").css("height", wheight - height_adj - 70);

	(function($) {
    $.fn.clickToggle = function(func1, func2) {
        var funcs = [func1, func2];
        this.data('toggleclicked', 0);
        this.click(function() {
            var data = $(this).data();
            var tc = data.toggleclicked;
            $.proxy(funcs[tc], this)();
            data.toggleclicked = (tc + 1) % 2;
        });
        	return this;
    	};
	}(jQuery));

$('#hide').clickToggle(function() {
            holding = $(".table").html();
            $(".table").html("<h1>Dice Hidden</h1>");
          },function() {
            $(".table").html(holding.toString());
          }
        );

</script>



</html>