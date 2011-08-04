<?php

include_once("includes/markdown.php");
include_once("config.php");

function navigation($currentPage) {
	if ($handle = opendir('content')) {
		$liPages = array("home");
		while (false !== ($file = readdir($handle))) {
			if($file == "home.txt");
			elseif($file == ".");
			elseif($file == "..");
			else $liPages[] = rtrim(rtrim($file, "txt"), "."); // Weird nesting thing
		}
		closedir($handle);
		
		$list = '<ul>';
    	foreach($liPages as $liPage) {
    		$liClass = "";
    		if($liPage == $currentPage) $liClass = "active";
    		if($liPage == "home") $list .= '<li class="' . $liClass . '"><a href="/">' . ucwords($liPage) . '</a></li>';
    		else $list .= '<li class="' . $liClass . '"><a href="/' . $liPage . '">' . ucwords($liPage) . '</a></li>';
    	}
		$list .= '</ul>';
		
		return $list;
	}
}

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
	$content = "404 Not Found";
    $content = Markdown($content);
    $navigation = navigation("");
}

include_once("template/index.php");

?>