<?php
	if (!isset($_REQUEST['firstname'])) {
		include 'form.html.php';
	}
	else {
		$firstname = $_REQUEST['firstname'];
		$lastname = $_REQUEST['lastname'];
		$firstnamecapped = strtoupper($firstname);
		$lastnamecapped = strtoupper($lastname);
		if ($firstnamecapped == "DAVID" && $lastnamecapped == "HERSCHER") {						
			$output = "Welcome to the website, " . htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8') .' '. htmlspecialchars($lastname, ENT_QUOTES, "UTF-8") . '!';
		} else {
			$firstname = "Stranger";
			$output = "Who are you? " . $firstname . "! Get out of here!";
		}
		include 'output.html.php';
	}
?>