<?php
include "start.php";
include "error.php";

if (!isset($_SESSION['interest'])){
	$_SESSION['interest'] = $_POST['interest'];
}

if(isset($_SESSION['username'])&& isset($_SESSION['interest'])){
	$name = $_SESSION['username'];
} else{
	header("Location:login.php");
}

if(!isset($_SESSION['totalTime'])){
    $_SESSION['totalTime'] = 0;
} else if (isset($_SESSION["time"])){
     $_SESSION['totalTime'] = round( $_SESSION['totalTime'] + ($_SESSION['time']/60)); 
	 unset ($_SESSION["time"]);
}

?>


<!DOCTYPE html>
<html>

<head>
	<title>In the Moment</title>
	
	<link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsenui.css">
	<link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsen-css-components.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css?version=2">
	<script src="https://unpkg.com/onsenui/js/onsenui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
</head>

<body>

	<ons-page id="bg">
		<?php
		$white = false;
		$back = false;
		include "header.php";		
		?>

		<div style="text-align: center; margin: auto;  max-width:800px;" id="textclr">

		<h1 class="intro">
			Welcome back

			<?php

			echo '' . $name; 
			?>
		</p>
	</div>

		<div>
			<img src="img/tired.png" style="margin:auto; display: block;"/>
		</div>

		<style type="text/css">
		.camera-view {
			width: 100%;
			height: 30%;
			text-align: center;
			background-color: #cacaca;
			display: table;
		}

		.camera-icon {
			vertical-align: middle !important;
			font-size: 100px;
			opacity: 1;
			display: table-cell;
		}

		.camera-button {
			width: 100%;
			height: 40%;
			text-align: center;
			display: table;
		}
	</style>


	<ons-card>
	<!-- Graph section --> 
	<section>
		<canvas id="myChart" width="80" height="50"></canvas>
		<script>
			var ctx = document.getElementById("myChart").getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: ["Mon", "Tues", "Wed", "Thurs", "Fri", "Sat", "Sun"],
					datasets: [{
						label: 'Free Time (# of Hours)',
						data: [0, 0, <?php echo ($_SESSION['totalTime']) ?>, 0, 0, 0, 0, 0, 0, 0],
						backgroundColor: [
						'rgba(54, 162, 235, 0.8)',
						'rgba(54, 162, 235, 0.8)',
						'rgba(54, 162, 235, 0.8)',
						'rgba(54, 162, 235, 0.8)',
						'rgba(54, 162, 235, 0.8)',
						'rgba(54, 162, 235, 0.8)',
						'rgba(54, 162, 235, 0.8)',
						'rgba(54, 162, 235, 0.8)',
						'rgba(54, 162, 235, 0.8)',
						],
						borderColor: [
						'rgba(54, 162, 235, 0.8)'
						],
						borderWidth: 1
					}]
				},
				options: {
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero:true,
								min: 0,
                        		max: 24,
							}
						}]
					}
				}
			});
		</script>
		<p>Average time:</p>
		<p>Comparison to the average:</p>
	</section>
</ons-card>

	<?php include "footer.php";?>

</ons-page>

</body>

</html>
