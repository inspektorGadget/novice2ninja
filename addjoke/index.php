<?php
//Fix Magic Quotes
if (get_magic_quotes_gpc()) { $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
	while (list($key, $val) = each($process)) {
		foreach ($val as $k => $v) { unset($process[$key][$k]);
			if (is_array($v)) { $process[$key][stripslashes($k)] = $v;
				$process[] = &$process[$key][stripslashes($k)];
			} else { $process[$key][stripslashes($k)] = stripslashes($v);
			}
		}
	} unset($process);
}
//Check to see if add joke has been clicked
if (isset($_GET['addjoke'])) {
	include 'form.html.php';
	exit();
}
//Connect to database
try {
	$pdo = new PDO('mysql:host=localhost;dbname=ijdb', 'ijdbuser', 'mypassword');
	$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo -> exec('SET NAMES "utf8"');
} catch (PDOException $e) {
	$error = "Unable to connect to the database server. ";
	include 'error.html.php';
	exit();
}
//Run query to fetch jokes
try {
	$sql = 'SELECT joketext FROM joke';
	$result = $pdo -> query($sql);
} catch (PDOException $e) {
	$error = 'Error fetching jokes ' . $e -> getMessage();
	include 'error.html.php';
	exit();
}
//Loop through result to store in array
foreach ($result as $row) {
	$jokes[] = $row['joketext'];
}

include 'jokes.html.php';
?>