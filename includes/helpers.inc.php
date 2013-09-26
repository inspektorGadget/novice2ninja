<?php
function htmlout($text) {
	$output = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
	echo $output;
}
