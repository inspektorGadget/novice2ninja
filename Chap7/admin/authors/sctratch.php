<?php
if (isset($_POST['action']) && $_POST['action']=='Delete') {
	include $_SERVER['DOCUMENT_ROOT'] . '/Novice2Ninja/includes/db.inc.php';
	
	//Get jokes belonging to selected author
	try	{
		$sql = 'SELECT id FROM joke WHERE authorid = :id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $_POST['id']);
		$s->execute();
	}	
	catch(PDOException $e) {
		$error = 'Error getting list of jokes to delete' . $e->getMessage();
		include 'error.html.php';
		exit();
	}
	
	//Get all from $s and store in $result
	$result = $s->fetchAll();
	
	//Delete joke category entries
	try {
		$sql = 'DELETE FROM jokecategory WHERE jokeid = :id';
		$s = $pdo->prepare($sql);
		//foreach joke
		foreach ($result as $row) {			
		$jokeid = $row['id'];
		$s->bindValue(':id', $jokeid);
		$s->execute();
		}
	}
	catch(PDOException $e) {
		$error = 'Error deleting category entries for joke' . $e->getMessage();
		include 'error.html.php';
		exit();
	}
	
	//Delete jokes belonging to author
	try {
		$sql = 'DELETE FROM joke WHERE authorid = :id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $_POST['id']);
		$s->execute();
	}
	catch(PDOException $e) {
		$error = 'Error deleting jokes belonging to author' . $e->getMessage();
		include 'error.html.php';
		exit();
	}
	
	//Delete the author
	try {
		$sql = 'DELETE from author WHERE id = :id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $_POST['id']);
		$s->execut();
	}
	catch(PDOException $e) {
		$error = 'Error deleting author ' . $e->getMessage();
		include 'error.html.php';
		exit();
	}
	
	//Direct back to controller index
	header('Location: .');
	exit();
}//endif for delete check