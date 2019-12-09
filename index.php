<?php

	include "functions.php";

	if(isset($_GET['passwd']) && $_GET['passwd'] == $passwd)
		$admin = true;
	else
		$admin = false;

	# Get all class data
	$sql = "select * from otfstats order by stamp desc";
	$results = $db->query($sql) or die("QUERY FAILED\r\n<BR>SQL: $sql \r\n<BR>ERROR: " . $db->error);
	$results->data_seek(0); # only for selects

	$zone_minutes['gray'] = 0;
	$zone_minutes['blue'] = 0;
	$zone_minutes['green'] = 0;
	$zone_minutes['orange'] = 0;
	$zone_minutes['red'] = 0;
	$zone_minutes['total'] = 0;

	while($RS = $results->fetch_assoc()) {
	    $classes[] = $RS;
	    $first_class = $RS['stamp'];

	    $zone_minutes['gray'] += $RS['zone_gray'];
	    $zone_minutes['blue'] += $RS['zone_blue'];
		$zone_minutes['green'] += $RS['zone_green'];
		$zone_minutes['orange'] += $RS['zone_orange'];
		$zone_minutes['red'] += $RS['zone_red'];
	}


?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Orange Theory Fitness States">
    <title>OTF Stats</title>

    <!-- Bootstrap core CSS -->
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


</head>

<body>

<div class="container-fluid bg-dark text-white">
    <div class="row">
        <div class="col text-center">
  			<a href='?' class='text-white'>OTF Stats</a>          
        </div>
    </div>
</div>

<div class="container">

	<div class="row">
	    <div class="col">

			<h1 class='display-4'>Orange Theory Fitness Stats</h1>
			<p class='lead'>You have been to <?=count($classes); ?> classes since <?=$first_class; ?>.</p>


			<h4>Time Spent in Each Zone</h4>

			<div class="row">
			    <div class="col text-center">
			    	<b>Gray</b><br>
			    	<?=$zone_minutes['gray']; ?>
			    </div>
			    <div class="col text-center">
			    	<b>Blue</b><br>
			    	<?=$zone_minutes['blue']; ?>
			    </div>
			    <div class="col text-center">
			    	<b>Green</b><br>
			    	<?=$zone_minutes['green']; ?>
			    </div>
			    <div class="col text-center">
			    	<b>Orange</b><br>
			    	<?=$zone_minutes['orange']; ?>
			    </div>
			    <div class="col text-center">
			    	<b>Red</b><br>
			    	<?=$zone_minutes['red']; ?>
			    </div>
			</div>

	    </div>
	</div>

	<?php if($admin) { ?>

	<div class="row">
	    <div class="col">

			<h4>Add Class</h4>

			<form class="form" action="process.php" method="post">

				<div class="form-group">
					<label>Class Date</label>
					<input type="date" class="form-control" name="stamp">
				</div>

				<div class="row mb-2">

				    <div class="col">
				    	<label>Gray</label>
   						<input type="number" class="form-control" name="zone_gray">
				    </div>

				    <div class="col">
				    	<label>Blue</label>
   						<input type="number" class="form-control" name="zone_blue">
				    </div>

				    <div class="col">
				    	<label>Green</label>
   						<input type="number" class="form-control" name="zone_green">
				    </div>

				    <div class="col">
				    	<label>Orange</label>
   						<input type="number" class="form-control" name="zone_orange">
				    </div>

				    <div class="col">
				    	<label>Red</label>
   						<input type="number" class="form-control" name="zone_red">
				    </div>

				</div>

				<div class="row mb-2">
				    <div class="col">
				    	<label>Calories</label>
   						<input type="number" class="form-control" name="calories">
				    </div>
				    <div class="col">
				    	<label>Splat Points</label>
   						<input type="number" class="form-control" name="splat_points">
				    </div>
				    <div class="col">
				    	<label>Heart Rate Avg</label>
   						<input type="number" class="form-control" name="heart_rate_avg">
				    </div>
				    <div class="col">
				    	<label>Heart Rate Peak</label>
   						<input type="number" class="form-control" name="heart_rate_peak">
				    </div>
				    <div class="col">
				    	<label>Steps</label>
   						<input type="number" class="form-control" name="steps">
				    </div>
				</div>

				<div class="form-group">
					<label>Notes</label>
					<input type="text" class="form-control" name="notes">
				</div>

				
				<button type="submit" class="btn btn-primary mt-2">Submit</button>
			</form>	                 

	    </div>
	</div>



	<?php } ?>

	<!-- Debug Table Dump -->

	<div class="row mt-4">
	    <div class="col">

	    	<h4>Debug</h4>

	    	<pre><?php

	    		$sql = "select * from otfstats order by stamp desc limit 200";
				$results = $db->query($sql) or die("QUERY FAILED\r\n<BR>SQL: $sql \r\n<BR>ERROR: " . $db->error);
				$results->data_seek(0); # only for selects

				while($RS = $results->fetch_assoc()) {
				    
					foreach($RS as $key=>$value) {

						if($key == "id")
							echo $value;
						else
							echo ", " . $value;

					}

					echo "\r\n";
				}



	    	?></pre>             

	    </div>
	</div>


</div> <!-- /container -->

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>