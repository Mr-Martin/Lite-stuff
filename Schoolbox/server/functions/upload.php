<?php
	session_start();
	include('../includes/pdo.inc.php');
	include('templating.php');
	
	function makeDir() {
		// Skapa mapp i currentDir från SESSION
		if(isset($_POST) && $_POST['folderName'] != ''){
			$currentDir = '../../' . $_SESSION['user']['currentDirectory'] . '/' . $_POST['folderName'];
			mkdir($currentDir, 0777);
		}else {
			echo 'Folder must include characters';
		}
		return jsonEncoder($passback = array('oliwer'));
	}

	function upload() {
		global $db; //Använder vår databasuppkoppling

		function fileInCurrDir(){
			$fileName = $_FILES['uploadFile']['name'];
			$currentDir = '../../' . $_SESSION['user']['currentDirectory'];
			$filesInCurrentDir = scandir($currentDir);

			foreach ($filesInCurrentDir as $key => $value) {
				if($value == $fileName){
					return true;
				} 
			}
			return false;
		}

		function checkFileType(){
			$fileType = $_FILES['uploadFile']['type'];
			$fileTypesAllowed = array('image/jpeg');

			if(in_array($fileType, $fileTypesAllowed)){
				return true;
			} else{
				return false;
			}
		}

		function checkStorageAndFileSize(){
			if(100 - $_SESSION['user']['storageused'] > ($_FILES['uploadFile']['size'] / (1024 * 1024))){
				return true;
			}
		}

		if(isset($_FILES)){
			if(!fileInCurrDir()){
				if(checkFileType()){	
					if(checkStorageAndFileSize()){
						$fileName = $_FILES['uploadFile']['name'];
						$fullPath = '../../' . $_SESSION['user']['currentDirectory'];

						$destFilePath = $fullPath . '/' . $fileName;
						$destFilePath = str_replace('//', '/', $destFilePath);

						move_uploaded_file($_FILES['uploadFile']['tmp_name'], $destFilePath);

						$newStorageUsed = $_SESSION['user']['storageused'] + ($_FILES['uploadFile']['size'] / (1024 * 1024));
						$statement = $db->prepare("INSERT INTO files (filename, filesize, userid, created) values (:filename, :filesize, :userid, NOW())");
						$statement->bindParam(":filename", $_FILES['uploadFile']['name']);
						$statement->bindParam(":filesize", $_FILES['uploadFile']['size']);
						$statement->bindParam(":userid", $_SESSION['user']['userid']);
							if($statement->execute()){
								echo $newStorageUsed;
								$statement = $db->prepare("UPDATE users set storageused=:newstorageused where userid=:userid"); //Om användaren har tre misslyckade inloggningsförsök så blockas denne, genom att active sätts till en tidpunkt om 24timmar.
								$statement->bindParam(":newstorageused", $newStorageUsed);
								$statement->bindParam(":userid", $_SESSION['user']['userid']);
								$statement->execute();
								$_SESSION['user']['storageused'] = $newStorageUsed;
							}
						//return jsonEncoder($passback = array('html' => dressWithTemplate('blocked')));
							echo "Fixat";

					} else{
						//return 'Error: No space left. Please radera some filer!';
						echo 'Error: No space left. Please radera some filer!';
					}
				} else{
					//return 'Error: Filetype not allowed';
					echo 'Error: Filetype not allowed';
				}
			} else{
				//return 'Error: File already exists in this directory. Please rename or select another directory. Do it, do it!';
				echo 'Error: File already exists in this directory. Please rename or select another directory. Do it, do it!';
			}
		}
	}

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
		//Plockar ut querystring för att använda switch och få rätt funktion
		switch ($uri) {
			case "upload":
				upload();
				break;
			case "makedir":
				makeDir();
				break;
			default:
				echo "error";
		}
