<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Name</title>
    </head>
    <body>
        <h1>Yup</h1>
        <div>
        	<?php
        	$firstname = $_POST['firstname'];
					$lastname = $_POST['lastname'];
					$firstnamecapped = strtoupper($firstname);
					$lastnamecapped = strtoupper($lastname);
					if ($firstnamecapped == "DAVID" && $lastnamecapped == "HERSCHER") {						
						echo "Welcome to the website, " . htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8') .' '. htmlspecialchars($lastname, ENT_QUOTES, "UTF-8") . '!';
					} else {
						echo "Who are you? What the hell are you doing here!";
					}
					?>
        </div>
    </body>
</html>

