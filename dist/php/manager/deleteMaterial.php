<?php
	/*Access to the database*/
	require_once '../persistance/compose.php';
	require_once '../persistance/admin.php';

	/*Get the arguments*/
	$artId = $_POST['artId'];
	$materialName = $_POST['materialName'];
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
	   If yes, we delete the relation between the material and the art. */
	else {
		$admin = new Admin($id_admin, "", "", "");
		$tokenDatabase = $admin->getTokenById();
		$tokenDatabase = $tokenDatabase[0]["token_admin"];
		if(strcmp($token_admin, $tokenDatabase) == 0)
		{
			$compose = new Compose($materialName, $artId);
			$compose->delete();
			$res = array('error' => false, 'key' => $materialName . ' a été supprimé.');
		}
		else {
			$res = array('error' => true, 'key' => 'Vous n\'êtes pas admin');
		}
	}
	echo json_encode($res);