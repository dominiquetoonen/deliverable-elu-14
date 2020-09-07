<?php

/**
 * API to process login form submit
 */

class LoginController extends Account {

	// COOKIE SETTINGS
	private const LONG_TOKEN = 86400 * 7; // Cookie lifetime (86400 = 1 day)
	private const SHORT_TOKEN = 3600; // Cookie lifetime (3600 = 1 hour)
	private const COOKIE_ID = 'deliverableUserIdCookie';
	private const COOKIE_SECURE = 'deliverableSecureCookie';

	// Set login redirect
	private const LOGINREDIRECT = '/dashboard/index.php';

	/**
	 * LoginController constructor.
	 *
	 * @param string $email
	 * @param string $password
	 * @param string $remember
	 */
	public function __construct(string $email, string $password, string $remember = 'short')
	{
		parent::__construct();
		if($this->getBy('email', $email) === null) {
			return false;
		}

		$passwordVerified = $this->verifyPassword($password);
		if($passwordVerified) {
			$this->createLoginCookie($remember);
			return true;
		}

		return false;
	}

	/**
	 * Get login redirect url
	 *
	 * @return string
	 */
	public static function getRedirectUrl()
	{
  		$redirect = HOME_URL . self::LOGINREDIRECT;
		return $redirect;
	}

	/**
	 * Verify password
	 *
	 * @param string $password
	 * @return bool
	 */
	private function verifyPassword(string $password)
	{
		$dbPassword = $this->getPassword();
		return password_verify($password, $dbPassword);
	}

	/**
	 * Create login session
	 *
	 * @param string $remember
	 * @return bool
	 */
	private function createLoginCookie($remember)
	{
		$hashString = $this->getEmail() . $this->getPassword() . time();
		$cookieValue = Secure::hash($hashString);

		// Determine how long the user should stay logged in.
		if($remember === 'long') {
			$rememberFor = self::LONG_TOKEN;
		} else {
			$rememberFor = self::SHORT_TOKEN;
		}

		$userId = $this->getId();

		// Save loginCookie to object
		$userIdCookie = false;
		$secureCookie = false;
		$this->setLoginCookie($cookieValue);
		if($this->saveCookie()) {
			$userIdCookie = setcookie(self::COOKIE_ID, $userId, time() + $rememberFor, "/");
			$secureCookie = setcookie(self::COOKIE_SECURE, $cookieValue, time() + $rememberFor, "/");
		}

		if($userIdCookie && $secureCookie) {
			return true;
		}

		return false;
	}

    /**
     * Check if user is logged in.
     *
     * @return Account|bool
     */
	public static function check()
	{
		$userId = $_COOKIE[self::COOKIE_ID];
		$secureCookie = $_COOKIE[self::COOKIE_SECURE];
		// Check if cookie is saved client side.
		if(!$userId || !$secureCookie) {
			return false;
		}

		$account = new Account;
		$account->get($userId);

		// Check if client side cookie value is equal to server side cookie value.
		if($account->getLoginCookie() !== $secureCookie) {
			return false;
		}
		// All checks are passed. User is logged in.
		return $account;
	}

    /**
     * Function to log user out.
     *
     * @return bool
     */
	public static function logout()
	{
		$account = LoginController::check();
		if(!$account) {
			return true;
		}

		$step1 = $account->setLoginCookie('');
		$step2 = setcookie(self::COOKIE_ID, 'expired', 1, "/");
		$step3 = setcookie(self::COOKIE_SECURE, 'expired', 1, "/");

		// Check if most important (secure cookie) is deleted from db or expired.
		if($step1 || $step2) {
			return true;
		}

		return false;
	}

	public static function numDaysLongToken()
    {
        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@" . self::LONG_TOKEN);
        return $dtF->diff($dtT)->format('%a');
    }

}