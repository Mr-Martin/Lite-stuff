<?php
	session_start();
	include('../includes/pdo.inc.php');
	include('templating.php');
	include('files.php');
	
	function login() {
	
		global $db; //Använder vår databasuppkoppling
		
		if(isset($_POST)) {
			$values = $_POST; 
			$today = date("Y-m-d H:i:s");
			$statement = $db->prepare("SELECT userid, firstname, lastname, storageused, active FROM users WHERE email = :email AND password = :password");
			$statement->bindParam(":email", $values['email']);
			$statement->bindParam(":password", $values['password']);
			$statement->execute();
			
			$result = $statement->fetchAll();
			if (count($result) == 1) { //Finns användaren?
				if ($result[0]['active'] <= $today) { //Är användaren blockad?
					$_SESSION['loginattempts'] = 0;
					$_SESSION['user'] = array(
						'name' => $result[0]['firstname'] . " " . $result[0]['lastname'],
						'userid' => $result[0]['userid'],
						'storageused' => $result[0]['storageused'],
						'activedirectory' => 'server/files/' . str_pad($result[0]['userid'], 8, "0", STR_PAD_LEFT)
						);
					$_SESSION['user']['currentDirectory'] = $_SESSION['user']['activedirectory'];

					$fsBasePath = str_replace('server/functions', '', dirname(__FILE__));
					$relPath = $_SESSION['user']['currentDirectory'];
					$dirAndFileListData = ffList($fsBasePath, $relPath);

					$passback = array(
						'htmlDir' => dressWithTemplate('dirandfilelist', $dirAndFileListData),
						'html' => dressWithTemplate('user')
					);

					return jsonEncoder($passback); 
				}
				else {
					$_SESSION['user'] = array(
							'active' => $result[0]['active']
							);
					$passback = array(
						'html' => dressWithTemplate('blocked')
					);

					return jsonEncoder($passback);
				}
			}
			else { //Vid en misslyckad inloggning
				$statement = $db->prepare('SELECT active, email FROM users where email = :email');
				$statement->bindParam(":email", $values['email']);
				$statement->execute();
				$result = $statement->fetchAll();

				if (count($result) > 0) { //Finns epostadressen i databasen?
					if ($result[0]['active'] <= $today) { //Är användaren blockad?
						if (isset($_SESSION['loginattempts'])) { //Kolla efter loginattempts i $_SESSION-arrayen
							$_SESSION['loginattempts']++;
							if ($_SESSION['loginattempts'] >= 3) {
								$_SESSION['blocked'] = true;
								$tomorrow = date("Y-m-d H:i:s", time()+86400);
								$statement = $db->prepare("UPDATE users set active=:active where email=:email"); //Om användaren har tre misslyckade inloggningsförsök så blockas denne, genom att active sätts till en tidpunkt om 24timmar.
								$statement->bindParam(":active", $tomorrow);
								$statement->bindParam(":email", $_POST['email']);
								$statement->execute();
								$_SESSION['loginattempts'] = 0;
								$_SESSION['user'] = array(
									'active' => $result[0]['active']
								);
								return jsonEncoder($passback = array('html' => dressWithTemplate('blocked')));
							}
						
							return jsonEncoder($passback = array('html' => dressWithTemplate('wrongpassword')));
						}

						else { //Finns loginattempts inte i $_SESSION så skapar vi den och blocked
							$_SESSION['loginattempts'] = 1;
							$_SESSION['blocked'] = false;
						}
					
					return jsonEncoder($passback = array('html' => dressWithTemplate('wrongpassword')));
					}
					else {
						$_SESSION['user'] = array(
									'active' => $result[0]['active']
								);
						return jsonEncoder($passback = array('html' => dressWithTemplate('blocked'))); //Användaren är blockad och har angett fel lösenord
					}
				}

				return jsonEncoder($passback = array('html' => dressWithTemplate('tryagain')));

			}
		}
	}
	
	function logout() {
		session_unset();
		session_destroy();

		$passback = array(
			'html' => dressWithTemplate('index')
		);

		return jsonEncoder($passback);
	} //Köttar sessionen.
	
	function register() {
		
		global $db;
		
		if(isset($_POST)) {
			$values = $_POST;
			$today = date("Y-m-d H:i:s"); //Tar "nu" för att använda det som created och active vid skapandet av en user.
			$storageUsedNewUser = 0;
			$statement = $db->prepare("SELECT userid FROM users WHERE email=:email"); //Kollar först om vi har en användare med den epostadressen
			$statement->bindParam(":email", $values['email']);
			$statement->execute();
			$result = $statement->fetchAll();
			
			if (!$result) { //Finns inte epostadressen i db så skapar vi en ny user
				$statement = $db->prepare("INSERT INTO users (firstname, lastname, email, password, schoolname, active, created, storageused) values (:firstname, :lastname, :email, :password, :schoolname, :active, :created, :storageused)");
				$statement->bindParam(":firstname", $values['firstname']);
				$statement->bindParam(":lastname", $values['lastname']);
				$statement->bindParam(":email", $values['email']);
				$statement->bindParam(":password", $values['password']);
				$statement->bindParam(":schoolname", $values['schoolname']);
				$statement->bindParam(":active", $today);
				$statement->bindParam(":created", $today);
				$statement->bindParam(":storageused", $storageUsedNewUser);
				if($statement->execute()) {
								$statement = $db->query("SELECT LAST_INSERT_ID() as latest_id from users");
								$statement->execute();
								$result = $statement->fetchAll();			
			
								$latest_id =  $result[0]['latest_id'];
					
					mkdir('../files/' . str_pad($latest_id, 8, "0", STR_PAD_LEFT), 0777); //Skapar en mapp i files som har samma namn som userid fast leftpaddat med nollor så att det är åtta tecken dvs userid '123' har mappnamnet '00000123'

					$_SESSION['signup'] = 'Your account is now created, Enjoy!';
					return jsonEncoder($passback = array('html' => dressWithTemplate('index')));
				}
			}
			else {
				return jsonEncoder("Email already connected to user, try another email");
			}
		}
	}
	
	function check() {
		if (isset($_SESSION['user']['userid']) && $_SESSION['user']['userid'] != null) {
			
			$fsBasePath = str_replace('server/functions', '', dirname(__FILE__));
			$relPath = $_SESSION['user']['currentDirectory'];
			$dirAndFileListData = ffList($fsBasePath, $relPath);
			
			$passback = array(
				'loggedin' => true,
				'userid' => $_SESSION['user']['userid'],
				'htmlDir' => dressWithTemplate('dirandfilelist', $dirAndFileListData),
				'html' => dressWithTemplate('user')
			);
			return jsonEncoder($passback);
		}
		else {
			return jsonEncoder($passback = array('loggedin' => false, 'html' => dressWithTemplate('index')));
		}
	}
	
	$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
	//Plockar ut querystring för att använda switch och få rätt funktion
	switch ($uri) {
		case "login":
			login();
			break;
		case "logout":
			logout();
			break;
		case "check":
			check();
			break;
		case "register":
			register();
			break;
		default:
			echo "error";
	}