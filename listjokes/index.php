<?php
//Connect to database
		try {
		$pdo = new PDO('mysql:host=localhost;dbname=ijdb', 'ijdbuser', 'mypassword');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec('SET NAMES "utf8"');
	} 
	catch (PDOException $e) {
		$error = "Unable to connect to the database server. ";
		include 'error.html.php';
		exit();
	}
	//Run query to fetch jokes
	try {
		$sql = 'SELECT joketext FROM joke';
		$result = $pdo->query($sql);
	}
	catch (PDOException $e) {
		$error = 'Error fetching jokes ' . $e->getMessage();
		include 'error.html.php';
		exit();
	}
	//Loop through result to store in array
	foreach ($result as $row) {
		$jokes[] = $row['joketext'];
	}
	
	include 'jokes.html.php';
?>