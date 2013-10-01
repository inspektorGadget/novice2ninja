<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/Novice2Ninja/includes/helpers.inc.php'; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Jokes</title>
	</head>
	<body>
		<p>
			<a href="?addjoke">Add your own joke!</a>
		</p>
		<p>Here are the jokes!</p>
		<?php foreach ($jokes as $joke): ?>
			<form action="?deletejoke" method="post">
			<blockquote>
				<p>
					<?php htmlout($joke['text']); ?>
					<a href="mailto:<?php htmlout($joke['email']); ?>">
						<?php htmlout($joke['name']); ?>
					</a>
					<input type="hidden" name="id" value="<?php echo $joke['id']; ?>" />
					<input type="submit" value="Delete" />
				</p>
			</blockquote>
			</form>
		<?php endforeach; ?>
	</body>
</html>

