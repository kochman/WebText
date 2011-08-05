<?php

include_once("includes/markdown.php");
include_once("config.php");

function navigation($currentPage) {

	$dir    = 'content';
	$liPages = scandir($dir);

	foreach($liPages as $key => $liPage) {
		$liPage = rtrim(rtrim($liPage, "txt"), "."); // yay
		$liPages[$key] = $liPage;
		if($liPage == "home") unset($liPages[$key]);
		elseif($liPage == ".") unset($liPages[$key]);
		elseif($liPage == "..") unset($liPages[$key]);
	}
		
	$list = '<ul>';
	if($currentPage == "home") $liClass = "active";
	$list .= '<li class="' . $liClass . '"><a href="./">Home</a></li>';
	foreach($liPages as $liPage) {
		$liClass = "";
		if($liPage == $currentPage) $liClass = "active";
		$list .= '<li class="' . $liClass . '"><a href="' . $liPage . '">' . ucwords($liPage) . '</a></li>';
	}
	$list .= '</ul>';
	
	return $list;
}

if(file_exists('.htaccess')) {
	if(file_exists('content/' . $page . '.txt')) {
		$content = file_get_contents('content/' . $page . '.txt');
		$content = Markdown($content);
		$navigation = navigation($page);
		$title = ucwords($page);
	} elseif(file_exists('content/home.txt') && !$page) {
		$content = file_get_contents('content/home.txt');
		$content = Markdown($content);
		$navigation = navigation("home");
		$title = "Home";
	} elseif(!file_exists('content/home.txt') && !$page) {
		$content = "Customize this page by creating a 'home.txt' file in the 'content' directory.";
		$content = Markdown($content);
		$navigation = navigation("home");
		$title = "Home";
	} else {
		header('HTTP/1.0 404 Not Found');
		$content = $error404;
		$content = Markdown($content);
		$navigation = navigation("");
	}
} else {
	$content = "There isn't a .htaccess file. WebText requires this file to operate properly.";
	$content = Markdown($content);
}

include_once("template/index.php");

?>
