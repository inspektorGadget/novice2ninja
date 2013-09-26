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
					<?php echo htmlspecialchars($joke['text'], ENT_QUOTES, 'UTF-8'); ?>
					<a href="mailto:<?php echo htmlspecialchars($joke['email'], ENT_QUOTES, 'UTF-8'); ?>">
						<?php echo htmlspecialchars($joke['name'], ENT_QUOTES, 'UTF-8'); ?>
					</a>
					<input type="hidden" name="id" value="<?php echo $joke['id']; ?>" />
					<input type="submit" value="Delete" />
				</p>
			</blockquote>
			</form>
		<?php endforeach; ?>
	</body>
</html>

