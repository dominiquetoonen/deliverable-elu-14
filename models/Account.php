<?php

class Account {

	public static $genderOptions = [
		'male' => 'Man',
		'female' => 'Vrouw',
		'other' => 'Anders'
	];

	private $table;

	protected $id;
	protected $gender;
	protected $firstName;
	protected $surNamePrefix;
	protected $surName;
	protected $phone;
	protected $mobile;
	protected $email;
	protected $password;
	protected $loginCookie;

	protected $errors = [];

	/**
	 * Account constructor.
	 *
	 * @param string $table
	 */
	public function __construct($table = 'account')
	{
		$this->table = $table;
	}

	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getGender() {
		return $this->gender;
	}

	/**
	 * @param string $gender
	 */
	public function setGender(string $gender) {
		if(!array_key_exists($gender, self::$genderOptions)) {
			$this->setError('gender','Incorrecte waarde voor het geslacht.');
			return;
		}

		$this->gender = $gender;
	}

	/**
	 * @return string
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * @param string $firstName
	 */
	public function setFirstName(string $firstName) {
		$this->firstName = $firstName;
	}

	/**
	 * @return string
	 */
	public function getSurNamePrefix() {
		return $this->surNamePrefix;
	}

	/**
	 * @param string|null $surNamePrefix
	 */
	public function setSurNamePrefix(string $surNamePrefix = null) {
		$this->surNamePrefix = $surNamePrefix;
	}

	/**
	 * @return mixed
	 */
	public function getSurName() {
		return $this->surName;
	}

	/**
	 * @param string $surName
	 */
	public function setSurName(string $surName) {
		$this->surName = $surName;
	}

	/**
	 * @return string
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * @param string $phone
	 */
	public function setPhone(string $phone = null) {
		$this->phone = $phone;
	}

	/**
	 * @return string
	 */
	public function getMobile() {
		return $this->mobile;
	}

	/**
	 * @param string $mobile
	 */
	public function setMobile(string $mobile = null) {
		$this->mobile = $mobile;
	}

	/**
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param string $email
	 */
	public function setEmail(string $email) {
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->setError('email','Dit e-mailadres is incorrect.');
			return;
		}

		// Write e-mail in lowercase to database.
		$this->email = mb_strtolower($email);
	}

	/**
	 * @return string
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @param string $password
	 */
	public function setPassword(string $password) {
		if(strlen($password) < 8) {
			$this->setError('password', 'Het wachtwoord is te kort.');
			return;
		}

		$this->password = password_hash($password, PASSWORD_BCRYPT);
	}

	/**
	 * @return string
	 */
	public function getLoginCookie() {
		return $this->loginCookie;
	}

	/**
	 * @param string $loginCookie
	 */
	public function setLoginCookie(string $loginCookie) {
		$this->loginCookie = $loginCookie;
	}

	/**
	 * @return array
	 */
	public function getErrors() {
		return $this->errors;
	}

	/**
	 * @param string $field
	 * @param string $error
	 */
	public function setError($field, string $error) {
		$this->errors[$field] = $error;
	}

	/**
	 * Save cookie to remember login
	 *
	 * @return bool
	 */
	public function saveCookie() {

		global $db;

		if(!empty($this->getErrors())) {
			// Errors exist.
			return false;
		}

        global $db;

        $data = [
			'loginCookie' => $this->loginCookie
		];

		$where = [
			'id' => [
				'column' => 'id',
				'operator' => '=',
				'value' => $this->id
			]
		];

		return $db->update($this->table, $data, $where);
	}

	/**
	 * Update user data
	 *
	 * @return bool
	 */
	public function save()
	{
		if(!empty($this->getErrors())) {
			// Errors exist.
			return false;
		}

		global $db;

		$data = [
			'gender' => $this->gender,
			'firstName' => $this->firstName,
			'surNamePrefix' => $this->surNamePrefix,
			'surName' => $this->surName,
			'phone' => $this->phone,
			'mobile' => $this->mobile,
			'email' => $this->email,
			'password' => $this->password
		];

		$where = [
			'id' => [
				'column' => 'id',
				'operator' => '=',
				'value' => $this->id
			]
		];

		return $db->update($this->table, $data, $where);
	}

	/**
	 * Create user
	 *
	 * @return boolean
	 */
	public function create()
	{
		global $db;

		if(!empty($this->getErrors())) {
			// Errors exist.
			return false;
		}

		$data = [
			'gender' => $this->gender,
			'firstName' => $this->firstName,
			'surNamePrefix' => $this->surNamePrefix,
			'surName' => $this->surName,
			'phone' => $this->phone,
			'mobile' => $this->mobile,
			'email' => $this->email,
			'password' => $this->password
		];

		return $db->insert($this->table, $data);
	}

	/**
	 * Get user by ID
	 *
	 * @param int $userId
	 * @return $this
	 */
	public function get(int $userId)
	{
		global $db;

		$select = ['*'];
		$where = [
			[
				'column' => 'id',
				'operator' => '=',
				'value' => $userId
			]
		];

		$data = $db->select($select, $this->table, $where)[0];

		$this->id = $data['id'];
		$this->gender = $data['gender'];
		$this->firstName = $data['firstName'];
		$this->surNamePrefix = $data['surNamePrefix'];
		$this->surName = $data['surName'];
		$this->phone = $data['phone'];
		$this->mobile = $data['mobile'];
		$this->email = $data['email'];
		$this->password = $data['password'];
		$this->loginCookie = $data['loginCookie'];

		return $this;
	}

	/**
	 * Get user by email
	 *
	 * @param string $by
	 * @param string $email
	 * @return $this | null
	 */
	public function getBy(string $by, string $email)
	{
		global $db;

		$select = ['*'];
		$where = [
			[
				'column' => $by,
				'operator' => '=',
				'value' => $email
			]
		];

		$data = $db->select($select, $this->table, $where)[0];

		if(empty($data)) {
			return null;
		}

		$this->id = $data['id'];
		$this->gender = $data['gender'];
		$this->firstName = $data['firstName'];
		$this->surNamePrefix = $data['surNamePrefix'];
		$this->surName = $data['surName'];
		$this->phone = $data['phone'];
		$this->mobile = $data['mobile'];
		$this->email = $data['email'];
		$this->password = $data['password'];
		$this->loginCookie = $data['loginCookie'];

		return $this;
	}
}