<?php

/**
 * Actions:
 * create
 * login
 */
$action = isset($_GET['action']) ? $_GET['action'] : null;

$return = [];

if (!$action) {
    $return['status'] = 'error';
    $return['data'] = 'No action provided!';
    echo json_encode($return);
    exit;
}

require_once "../bootstrap.php";

if ($action === 'create') {

    if (!$_POST) {
        $return['status'] = 'error';
        $return['data'] = 'No POST data found!';
        echo json_encode($return);
        exit;
    }

    // Create account
    $account = new Account;

    // Get data
    $args['gender'] = $_POST['gender'];
    $args['firstName'] = $_POST['firstName'];
    $args['surNamePrefix'] = $_POST['surNamePrefix'];
    $args['surName'] = $_POST['surName'];
    $args['phone'] = $_POST['phone'];
    $args['mobile'] = $_POST['mobile'];
    $args['email'] = $_POST['email'];
    $args['password'] = $_POST['password'];
    $args['repeatPassword'] = $_POST['repeatPassword'];
    $args['termsOfService'] = $_POST['termsOfService'];

    if ($args['termsOfService'] !== 'on') {
        $account->setError('termsOfService', 'Ga alstublieft akkoord met onze algemene voorwaarden.');
    }

    // Set data
    $account->setGender($args['gender']);
    $account->setFirstName($args['firstName']);
    $account->setSurNamePrefix($args['surNamePrefix']);
    $account->setSurName($args['surName']);
    $account->setPhone($args['phone']);
    $account->setMobile($args['mobile']);
    $account->setEmail($args['email']);

    // Verify password
    if ($args['password'] === $args['repeatPassword']) {
        $account->setPassword($args['password']);
    } else {
        $account->setError('repeatPassword', 'De wachtwoorden komen niet overeen.');
    }

    $return['status'] = 'success';
    $return['data'] = $args;

    // Create account, save data
    if (!$account->create()) {
        // Account creation failed
        $return['status'] = 'error';

        foreach ($account->getSqlErrors() as $error) {
            if ($error['errno'] == 1062) {
                $account->setError('sqlError', 'Er is al een account geregistreerd met dit e-mailadres.');
            } else {
                $account->setError('sqlError', 'Er is iets fout gegaan bij het opslaan van uw account.');
            }
        }

        $return['sqlErrors'] = $account->getSqlErrors();
        $return['errors'] = $account->getErrors();
    }

    echo json_encode($return);

} elseif ($action === 'update') {

    if (!$_POST) {
        $return['status'] = 'error';
        $return['data'] = 'No POST data found!';
        echo json_encode($return);
        exit;
    }

    // Get data
    $args['accountId'] = $_POST['accountId'];
    $args['gender'] = $_POST['gender'];
    $args['firstName'] = $_POST['firstName'];
    $args['surNamePrefix'] = $_POST['surNamePrefix'];
    $args['surName'] = $_POST['surName'];
    $args['phone'] = $_POST['phone'];
    $args['mobile'] = $_POST['mobile'];
    $args['email'] = $_POST['email'];

    // Create account
    // Hier moet een account opgehaald worden met args['id']
    $account = new Account;

    // Set data
    $account->get($args['accountId']);
    $account->setGender($args['gender']);
    $account->setFirstName($args['firstName']);
    $account->setSurNamePrefix($args['surNamePrefix']);
    $account->setSurName($args['surName']);
    $account->setPhone($args['phone']);
    $account->setMobile($args['mobile']);
    $account->setEmail($args['email']);

    $return['status'] = 'success';
    $return['data'] = $args;

    // Create account, save data
    if (!$account->save()) {
        // Account creation failed
        $return['status'] = 'error';

        foreach ($account->getSqlErrors() as $error) {
            if ($error['errno'] == 1062) {
                $account->setError('sqlError', 'Er is al een account geregistreerd met dit e-mailadres.');
            } else {
                $account->setError('sqlError', 'Er is iets fout gegaan bij het opslaan van uw account.');
            }
        }

        $return['sqlErrors'] = $account->getSqlErrors();
        $return['errors'] = $account->getErrors();
    }

    echo json_encode($return);

} elseif ( $action === 'login' ) {

	// LoginController user
	$return['status'] = 'error';
	$return['redirect'] = '';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $rememberMe = isset($_POST['rememberMe']) ? $_POST['rememberMe'] : null;

    $remember = 'short';
    if ($rememberMe === 'on') {
        $remember = 'long';
    }

	$loggedIn = new LoginController($email, $password, $remember);

	if($loggedIn->getId() !== null) {
		// User is successfully logged in.
		$return['status'] = 'success';
		$return['redirect'] = LoginController::getRedirectUrl();
	}

	echo json_encode($return);

} elseif ($action === 'logout') {

	// Logout user
	$loggedOut = LoginController::logout();

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}