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
	.start:hover{
		background-color: #AAA;
		margin-top:60px;
	}
	.start{
		margin-top: 50px;
		padding:20px; 
		border-style: solid; 
		border-width: 5px;
	}
	a.choice{
		display:block; 
		text-decoration:none; 
		color:#000;
	}
</style>
	<div class="container">
		<div class="row">
			<h1 align="center">Liar's Dice</h1>
			<hr width="400px" style="border-color:#000;">
		</div>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-3 col-md-offset-2">
				<a class="choice" href="single.php">
				<div class="start">
					<img src="cpu.svg">
					<h1 align="center">Single Player</h1>
					<hr style="border-color: #000">
					<p align="center">Play against 1-5 CPU opponents. Test your skill and practice your lying!</p>
				</div>
				</a>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-3 col-md-offset-2">
				<a class = "choice" href="friends.php">
				<div class="start">
					<img src="friends.svg">
					<h1 align="center">Multi-player</h1>
					<hr style="border-color:#000">
					<p align="center">Play with your firends! Every player needs to access this URL to play!</p>
				</div>
				</a>
			</div>
		</div>
	</div>
</body>

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</html>