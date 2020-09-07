<?php

class ProductAttribute {

	private $table;

	private $id;
	private $name;
	private $value;

	/**
	 * Product Attribute constructor.
	 *
	 * @param string $table
	 */
	public function __construct($table = 'attribute')
	{
		$this->table = $table;
	}

	/**
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param integer $id
	 */
	private function setId( int $id ) {
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName( string $name ) {
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @param string $value
	 */
	public function setValue( string $value ) {
		$this->value = $value;
	}

	/**
	 * Get image by ID
	 *
	 * @param int $id
	 * @return $this
	 */
	public function get(int $id) {
		global $db;

		$select = [ '*' ];
		$where  = [
			[
				'column'   => 'id',
				'operator' => '=',
				'value'    => $id
			]
		];

		$data = $db->select( $select, $this->table, $where )[0];

		$this->setId( $data['id'] );
		$this->setName( $data['name'] );
		$this->setValue( $data['value'] );

		return $this;
	}

}