<?php

require_once "ProductImage.php";

class Product {

    private static $table = 'product';

    private $ean;
    private $name;
    private $description;
    private $minPrice;
    private $maxPrice;
    private $totalStock;

    private $categoryId;
    private $productImages = [];

    private $errors = [];

    /**
     * Account constructor.
     *
     * @param string $table
     */
    public function __construct($table = 'product')
    {
        self::$table = $table;
    }

    public static function getTable()
    {
        return self::$table;
    }

    /**
     * @return string
     */
    public function getEan() {
        return $this->ean;
    }

    /**
     * @param string $ean
     */
    public function setEan($ean) {
        $this->ean = $ean;
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
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getMinPrice() {
        return $this->minPrice;
    }

    /**
     * @param mixed $minPrice
     */
    public function setMinPrice( $minPrice ) {
        $this->minPrice = $minPrice;
    }

    /**
     * @return mixed
     */
    public function getMaxPrice() {
        return $this->maxPrice;
    }

    /**
     * @param mixed $maxPrice
     */
    public function setMaxPrice( $maxPrice ) {
        $this->maxPrice = $maxPrice;
    }

    /**
     * @return mixed
     */
    public function getTotalStock() {
        return $this->totalStock;
    }

    /**
     * @param mixed $totalStock
     */
    public function setTotalStock( $totalStock ) {
        $this->totalStock = $totalStock;
    }

    /**
     * @return mixed
     */
    public function getCategoryId() {
        return $this->categoryId;
    }

    /**
     * @param mixed $categoryId
     */
    public function setCategoryId( $categoryId ) {
        $this->categoryId = $categoryId;
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

    public function getAttributes()
    {
        // Select query for all attributes from product.
    }

    /**
     * Return first image of all product images.
     *
     * @return bool|object
     */
    public function getFirstImage()
    {
        if(empty($images = $this->getImages()))
            return false;

        return $images[0];
    }

    /**
     * Set product image objects.
     */
    private function setImages()
    {
        global $db;

        $ean = $this->getEan();

        $sql = "SELECT id 
				FROM productImage
				WHERE product_ean = '$ean';";

        $result = $db->query($sql);
        if($result === false)
            return;

        $images = $result->fetch_assoc();

        foreach($images as $image) {
            $productImage = new ProductImage();
            $this->productImages[] = $productImage->get($image['id']);
        }
    }

    /**
     * Return array of image objects.
     *
     * @return array
     */
    public function getImages()
    {
        return $this->productImages;
    }

    public function getCategory()
    {
        // Select query for all categories from product.
    }

    public function getCompanies()
    {
        // Select query for all companies from product.
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

        return $db->update(self::$table, $data, $where);
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

        return $db->insert(self::$table, $data);
    }

    /**
     * Get product by EAN
     *
     * @param string $ean
     * @return $this
     */
    public function get(string $ean)
    {
        global $db;

        $sql = "SELECT ean, parent_id, productCategory_id, productImage_id, name, description, vat_type, status, MIN(price) minPrice, MAX(price) maxPrice, SUM(instock) totalStock
				FROM product t1
				LEFT JOIN company_product t2
				ON t1.ean=t2.product_id
				WHERE ean='$ean'
				AND t2.instock > 0";

        $result = $db->query($sql);
        $data = $result->fetch_assoc();

        $this->setEan($data['ean']);
        $this->setName($data['name']);
        $this->setDescription($data['description']);
        $this->setMinPrice($data['minPrice']);
        $this->setMaxPrice($data['maxPrice']);
        $this->setTotalStock($data['totalStock']);
        $this->setCategoryId($data['productCategory_id']);

        $this->setImages();

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

        $data = $db->select($select, self::$table, $where);

        $this->ean = $data['ean'];
        $this->name = $data['name'];
        $this->description = $data['description'];

        return $this;
    }

    /**
     * Get all user by LIKE
     *
     * @param string $by
     * @param string $value
     * @return [$this]
     */
    public function getAllLike(string $by, string $value)
    {
        global $db;

        if (!in_array($by, ['name', 'description']) ) {
            return false;
        }
        $select = ['*'];
        $where = [
            [
                'column' => $by,
                'operator' => 'LIKE',
                'value' => '%'.$value.'%'
            ]
        ];

        $data = $db->select($select, self::$table, $where);

        return $data;
    }

    /**
     * Get all user by LIKE
     *
     * @param string $by
     * @param string $value
     * @return [$this]
     */
    public function getAll()
    {
        global $db;

        $select = ['*'];

        $data = $db->select($select, self::$table);

        return $data;
    }

}