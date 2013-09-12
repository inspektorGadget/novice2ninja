<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Jokes</title>
	</head>
	<body>
		<p>Here are the jokes!</p>
		<?php foreach ($jokes as $joke): ?>
			<blockquote>
				<p><?php echo $joke; ?></p>
			</blockquote>
		<?php endforeach; ?>
	</body>
</html>

