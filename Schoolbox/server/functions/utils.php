<?php
	session_start();
	include('../includes/pdo.inc.php');
	include('templating.php');
		function settings() {
				return jsonEncoder($passback = array('html' => dressWithTemplate('settings')));
			}

		function backDir() {
			$currentDirectory = $_SESSION['user']['currentDirectory'];
		  $currentDirectory = explode('/', $currentDirectory);
		  array_pop($currentDirectory);
		  $currentDirectory = implode('/', $currentDirectory);

		  $_SESSION['user']['currentDirectory'] = $currentDirectory;
		return jsonEncoder($passback = array('oliwer'));
		}

		function updateDir() {

			if(isset($_POST) && $_POST['newDir'] != '') {
				$_SESSION['user']['currentDirectory'] .= '/' . $_POST['newDir'];
				if (strlen($_SESSION['user']['currentDirectory']) < strlen($_SESSION['user']['activedirectory'])) {
					$_SESSION['user']['currentDirectory'] = $_SESSION['user']['activedirectory'];
				}
			}
		return jsonEncoder($passback = array('oliwer'));
		}
		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
		//Plockar ut querystring för att använda switch och få rätt funktion
		switch ($uri) {
			case "settings":
				settings();
				break;
			case "updatedir":
				updateDir();
				break;
			case "backdir":
				backDir();
				break;
			default:
				echo "error";
		}