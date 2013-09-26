<?php
//Fix Magic Quotes
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
//Check to see if add joke has been clicked
if (isset($_GET['addjoke'])) {
	include 'form.html.php';
	exit();
}

//Check to see if new joke has been submitted
if (isset($_POST['joketext'])) {
	
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	
	try {
		$sql = 'INSERT INTO joke SET 
			joketext = :joketext, 
			jokedate = CURDATE()';
		$s = $pdo->prepare($sql);
		$s->bindValue(':joketext', $_POST['joketext']);
		$s->execute();
	} catch (PDOException $e) {
		$error = "Error adding submitted joke: " . $e->getMessage();
		include 'error.html.php';
		exit();
	}

	header('Location: .');
	exit();
}
//Check to see if a joke has been deleted
if (isset($_GET['deletejoke'])) {
	
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	
	try {
		$sql = 'DELETE FROM joke WHERE id = :id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $_POST['id']);
		$s->execute();
	} catch (PDOException $e) {
		$error = "Error deleting joke: " . $e->getMessage();
		include 'error.html.php';
		exit();
	}
	header('Location: .');
	exit();
}
//Run query to fetch jokes

include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

try {
	$sql = 'SELECT joke.id, joketext, name, email FROM joke INNER JOIN author ON authorid = author.id';
	$result = $pdo -> query($sql);
} catch (PDOException $e) {
	$error = 'Error fetching jokes ' . $e -> getMessage();
	include 'error.html.php';
	exit();
}
//Loop through result to store in array
foreach ($result as $row) {
	$jokes[] = array(
		'id'=>$row['id'], 
		'text'=>$row['joketext'],
		'name'=>$row['name'],
		'email'=>$row['email']
	);
}

include 'jokes.html.php';
?>