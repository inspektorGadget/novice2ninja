<?php
//Include magic quotes fix
include_once $_SERVER['DOCUMENT_ROOT'] . '/Novice2Ninja/includes/magicquotes.inc.php';

//Check if add author has been clicked
if (isset($_GET['add'])) {
	$pageTitle = 'New Author';
	$action = 'addform';
	$name = '';
	$email = '';
	$id = '';
	$button = 'Add Author';
	
	include 'form.html.php';
	exit();
}

//Check if addform has been submitted
if (isset($_GET['addform'])) {
	include $_SERVER['DOCUMENT_ROOT'] . '/Novice2Ninja/includes/db.inc.php';
	
	try {
		$sql = 'INSERT INTO author SET
			name = :name,
			email = :email';
		$s = $pdo->prepare($sql);
		$s->bindValue(':name', $_POST['name']);
		$s->bindValue(':email', $_POST['email']);
		$s->execute();
	}
	catch(PDOException $e) {
		$error = 'Error adding author' . $e->getMessage();
		include 'error.html.php';
		exit();
	}
	
	//Submit back to controller index
	header('Location: .');
	exit();
}

//Check if edit author has been submitted
if (isset($_POST['action']) && $_POST['action']=='Edit') {
	include $_SERVER['DOCUMENT_ROOT'] . '/Novice2Ninja/includes/db.inc.php';
	
	//Get author info from author table
	try {
		$sql = 'SELECT id, name, email FROM author WHERE id = :id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $_POST['id']);
		$s->execute();
	}
	catch(PDOException $e) {
		$error = 'Error fetching author details' . $e->getMessage();
		include 'error.html.php';
		exit();
	}
	
	//store result from author query in $row
	$row = $s->fetch();
	
	//Set variables for populated author form
	$pageTitle = 'Edit Author';
	$action = 'editform';
	$name = $row['name'];
	$email = $row['email'];
	$id = $row['id'];
	$button = 'Update Author';
	
	include 'form.html.php';
	exit();
}

//Check if editform has been submitted
if (isset($_GET['editform'])) {
	include $_SERVER['DOCUMENT_ROOT'] . '/Novice2Ninja/includes/db.inc.php';
	
	try {
		$sql = 'UPDATE author SET
			name = :name,
			email = :email
			WHERE id = :id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $_POST['id']);
		$s->bindValue(':name', $_POST['name']);
		$s->bindValue(':email', $_POST['email']);
		$s->execute();
	}
	catch(PDOException $e) {
		$error = 'Error updating author' . $e->getMessage();
		include 'error.html.php';
		exit();
	}
	
	header('Location: .');
	exit();
}

//Check if author has been deleted
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
		$s->execute();
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

//Display author list
include $_SERVER['DOCUMENT_ROOT'] . '/Novice2Ninja/includes/db.inc.php';
try {
	$result = $pdo->query('SELECT id, name FROM author');
}
catch(PDOException $e) {
	$error = 'Error fetching authors from the database' . $e->getMessage();
	include 'error.html.php';
	exit();
}

//Loop through results
foreach ($result as $row) {
	$authors[] = array('id' => $row['id'], 'name' => $row['name']);
}

include 'authors.html.php';