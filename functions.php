<?php
function __autoload($class_name) {
	$class_name = strtolower($class_name);
	$path = "classes/{$class_name}.php";
	if (file_exists($path)) {
		require_once $path;
	} else {
		die("The file {$class_name}.php could not be found.");
	}
}
function redirect_to($location = NULL) {
	if ($location != NULL) {
		header("Location: {$location}");
		exit;
	}
}

function output_message($message = "") {
	if (!empty($message)) {
		return "<p class=\"message\">{$message}</p>";
	} else {
		return "wrong";
	}
}
function strip_zeros_from_date($marked_string = "") {
	// first remove the marked zeros
	$no_zeros = str_replace('*0', '', $marked_string);
	// then remove any remaining marks
	$cleaned_string = str_replace('*', '', $no_zeros);
	return $cleaned_string;
}

function render($view_name, $params = []) {
	$view_path = __DIR__ . "/views/partials/$view_name.php";

	extract($params);
	require $view_path;
}

function dd($variable) {
	var_dump($variable);
	die();
}