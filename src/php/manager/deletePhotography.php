<?php
	/*Access to the database*/
	require_once '../persistance/file.php';
	require_once '../persistance/photography.php';
	require_once '../persistance/art.php';
	require_once '../persistance/admin.php';

	/*Get the arguments*/
	$photoName = $_POST['photo'];
	$nameArt = $_POST['nameArt'];
	$id_admin = $_POST['id_admin'];
	$token_admin = $_POST['token_admin'];

	/*Test if the user have admin cookies
	  If not, returned an error message*/
	if(empty($id_admin)) {
		$res = array('error' => true, 'key' => 'Entrer un ID');
	}
	else if(empty($token_admin)) {
		$res = array('error' => true, 'key' => 'Entrer un token');
	}
	/* If the user have admin cookies, we check in the database with the token if it is a valid admin
	   If not, we return an error message
	   If yes, we check if the data are empty or not. After that, we delete the image file how correspond to the photography of an art in the good folder. */
	else {
		$admin = new Admin($id_admin, "", "", "");
		$tokenDatabase = $admin->getTokenById();
		$tokenDatabase = $tokenDatabase[0]["token_admin"];
		if(strcmp($token_admin, $tokenDatabase) == 0)
		{
			if (empty($photoName)) {
				$res = array('error' => true, 'key' => 'Entrer le nom du fichier');
			}
			else if (empty($nameArt)) {
				$res = array('error' => true, 'key' => 'Entrer le nom de l\'art');
			}
			else {
				$file = new File($nameArt);
				$res = $file->removeFile($photoName);
				$art = new Art($nameArt);
				$photography = new Photography($photoName, $art->getId());
				$photography->delete();
				if (!$res) {
					$res = array('error' => true, 'key' => 'La photographie ' . $photoName .' n\'a pas pu être supprimée');
				}
				else {
					$res = array('error' => false, 'key' => 'La photographie ' . $photoName . ' a été supprimée');
				}
			}
		}
		else {
			$res = array('error' => true, 'key' => 'Vous n\'êtes pas admin');
		}
	}
	echo json_encode($res);