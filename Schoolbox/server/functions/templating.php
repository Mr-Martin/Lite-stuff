<?php 
define('TEMPLATE_DIRECTORY', '/Users/kenthsoderholm/sites/schoolbox/tpl/');
function dressWithTemplate($templateName, array $data = array()){
	extract($data);
	ob_start();
	require(TEMPLATE_DIRECTORY . $templateName . '.tpl.php');
	return ob_get_clean();
}

function jsonEncoder($data){
	header('Content-type: application/json; charset=utf-8');
	print json_encode($data);
}