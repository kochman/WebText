<?php

$page = $_GET['page'];

if(file_exists('content/' . $page . '.txt')) {
	$content = file_get_contents('content/' . $page . '.txt');
	echo $content;
} elseif(file_exists('content/home.txt') && !$page) {
	$content = file_get_contents('content/home.txt');
	echo $content;
} elseif(!file_exists('content/home.txt') && !$page) {
	$content = "Customize this page by creating a 'home.txt' file in the 'content' directory.";
	echo $content;
} else {
	header('HTTP/1.0 404 Not Found');
	$content = "404 Not Found";
	echo $content;
}

?>
