<?php

	include "functions.php";

	if(isset($_POST['stamp'])) {


		$sql = "INSERT INTO `otfstats` (`stamp`, `zone_gray`, `zone_blue`, `zone_green`, `zone_orange`, `zone_red`, `calories`, `splat_points`, `heart_rate_avg`, `heart_rate_peak`, `steps`, `notes`) VALUES (";

		# TODO: add scrubbing
		$sql .= "'" . $_POST['stamp'] . "', ";

		$sql .= $_POST['zone_gray'] . ", ";
		$sql .= $_POST['zone_blue'] . ", ";
		$sql .= $_POST['zone_green'] . ", ";
		$sql .= $_POST['zone_orange'] . ", ";
		$sql .= $_POST['zone_red'] . ", ";

		$sql .= $_POST['calories'] . ", ";
		$sql .= $_POST['splat_points'] . ", ";
		$sql .= $_POST['heart_rate_avg'] . ", ";
		$sql .= $_POST['heart_rate_peak'] . ", ";
		$sql .= $_POST['steps'] . ", ";

		$sql .= "'" . $_POST['notes'] . "')";

		$results = $db->query($sql) or die("QUERY FAILED\r\n<BR>SQL: $sql \r\n<BR>ERROR: " . $db->error);



	}

	header("Location: index.php");

?>