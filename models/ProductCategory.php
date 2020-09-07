<?php

class ProductCategory {

	private $table;

	private $id;
	private $name;
	private $description;
	private $parent;
	private $children = [];

	private $productFilters = [];

	private $products = [];
	private $attributes = [];

	private $errors = [];

	public function __construct($table = 'productCategory')
	{
		$this->table = $table;
	}

	/**
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId(int $id)
	{
		$this->id = $id;
	}

	/**
	 * @return object
	 */
	public function getParent()
	{
		return $this->parent;
	}

	/**
	 * Set parent with object or id.
	 *
	 * @param object|integer $parent
	 */
	public function setParent($parent)
	{
		if(is_numeric($parent)) {
			$id = $parent;
			$parent = new ProductCategory();
			$parent->get($id);
		}

		if(is_a($parent, 'ProductCategory')) {
			$this->parent = $parent;
		} else {
			$this->parent = null;
		}
	}

	/**
	 * Set child categories in array.
	 */
	public function setChildren()
	{
		if(!$this->getId()) {
			$this->children = [];
			return;
		}

		global $db;

		$select = ['id'];
		$from = $this->table;
		$where = [
			'parent_id' => $this->getId()
		];
		$childIds = $db->select($select, $from, $where);

		$child = new ProductCategory();
		foreach($childIds as $childId) {
			$child->get($childId);
			$this->children[] = $child;
		}
	}

	/**
	 * @return array
	 */
	public function getChildren()
	{
		return $this->children;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName(string $name)
	{
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @param mixed $description
	 */
	public function setDescription(string $description)
	{
		$this->description = $description;
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
	public function setError(string $field, string $error) {
		$this->errors[$field] = $error;
	}

	public function setFilters($filters)
	{
		if(!is_array($filters))
			return;

		if(empty($filters))
			return;

		$this->productFilters = $filters;
	}

	public function getFilters()
	{
		return $this->productFilters;
	}

	/**
	 * @return array|null
	 */
	public function getProducts()
	{
		if(!$this->getId()) {
			return null;
		}

		if(!empty($this->products)) {
			return $this->products;
		}

		global $db;

		$results = false;

		if(!empty($this->productFilters)) {

			// Filters are active. Filter out results.
			$filterIds = [];
			foreach($this->productFilters as $id => $filter) {
				$filterIds[] = $id;
			}
			$filterIds = implode(',', $filterIds);

			$sql = "SELECT t1.ean FROM product t1
					LEFT JOIN product_attribute t2
					ON t1.ean = t2.product_ean
					LEFT JOIN attribute t3
					ON t2.attribute_id = t3.id
					WHERE t3.id IN ($filterIds)
					AND t1.productCategory_id={$this->getId()};";

			$results = $db->query($sql);

			if($results !== false) {
				$eanArray = [];
				while($product = $results->fetch_assoc()) {
					$eanArray[] = $product;
				}
			}

		}

		if(empty($this->productFilters) || $results === false) {

			// No filters active or no products found with filters.

			$select = ['ean'];
			$from = Product::getTable();
			$where = [
				[
					'column' => 'productCategory_id',
					'operator' => '=',
					'value' => $this->getId()
				]
			];
			$eanArray = $db->select($select, $from, $where);

		}

		foreach($eanArray as $result) {
			$product = new Product();
			$product->get($result['ean']);
			$this->products[] = $product;
		}

		return $this->products;
	}

	public function getAttributes()
	{
		if(!$this->getId()) {
			return null;
		}

		if(!empty($this->attributes)) {
			return $this->attributes;
		}

		global $db;

		// Get attributes through products.
		$sql = "SELECT t3.id FROM product t1
				LEFT JOIN product_attribute t2
				ON t1.ean = t2.product_ean
				LEFT JOIN attribute t3
				ON t2.attribute_id = t3.id
				WHERE productCategory_id = {$this->getId()}";

		$results = $db->query($sql);

		while($attribute = $results->fetch_assoc()) {
			$productAttribute = new ProductAttribute();
			$productAttribute->get($attribute['id']);
			$this->attributes[StringFormat::url($productAttribute->getName())]['id'] = ucfirst($productAttribute->getId());
			$this->attributes[StringFormat::url($productAttribute->getName())]['name'] = ucfirst($productAttribute->getName());
			$this->attributes[StringFormat::url($productAttribute->getName())]['values'][$productAttribute->getId()] = [
				'name' => $productAttribute->getName(),
				'value' => $productAttribute->getValue()
			];
		}

		return $this->attributes;
	}

	// DB

	/**
	 * Update product data
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
			'name' => $this->name,
			'description' => $this->description
		];

		$where = [
			'id' => [
				'column' => 'ean',
				'operator' => '=',
				'value' => $this->ean
			]
		];

		return $db->update($this->table, $data, $where);
	}

	/**
	 * Create product
	 *
	 * @return boolean
	 */
	public function create()
	{
		if(!empty($this->getErrors())) {
			// Errors exist.
			return false;
		}

		global $db;

		$data = [
			'ean' => $this->ean,
			'name' => $this->name,
			'description' => $this->description
		];

		return $db->insert($this->table, $data);
	}

	/**
	 * Get category by ID
	 *
	 * @param integer $id
	 * @return $this
	 */
	public function get(int $id)
	{
		global $db;

		$select = ['*'];
		$where = [
			[
				'column' => 'id',
				'operator' => '=',
				'value' => $id
			]
		];

		$data = $db->select($select, $this->table, $where);

		$this->setId($data[0]['id']);
		$this->setParent($data[0]['parent_id']);
		$this->setName($data[0]['name']);
		$this->setDescription($data[0]['description']);

		return $this;
	}

	/**
	 * Get product by random value.
	 *
	 * @param string $by
	 * @param string $value
	 * @return $this
	 */
	public function getBy(string $by, string $value)
	{
		global $db;

		$select = ['*'];
		$where = [
			[
				'column' => $by,
				'operator' => '=',
				'value' => $value
			]
		];

		$data = $db->select($select, $this->table, $where);

		$this->setId($data['id']);
		$this->setParent($data['parent_id']);
		$this->setName($data['name']);
		$this->setDescription($data['description']);

		return $this;
	}

}