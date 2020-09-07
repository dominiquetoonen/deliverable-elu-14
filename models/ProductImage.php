<?php

class ProductImage extends Database
{

    private $table;

    private $id;
    private $name;
    private $description;
    private $path;
    private $product_ean;

    /**
     * Product Image constructor.
     *
     * @param string $table
     */
    public function __construct($table = 'productImage')
    {
        $this->table = $table;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getProductEan()
    {
        return $this->product_ean;
    }

    /**
     * @param mixed $product_ean
     */
    public function setProductEan($product_ean)
    {
        $this->product_ean = $product_ean;
    }

    /**
     * Get image by ID
     *
     * @param int $id
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

        $data = $db->select($select, $this->table, $where)[0];

        $this->setId($data['id']);
        $this->setName($data['name']);
        $this->setDescription($data['description']);
        $this->setPath($data['path']);
        $this->setProductEan($data['product_ean']);

        return $this;
    }


    public static function getImage($ean)
    {
        global $db;

        $select = ['*'];

        $where = [
            'id' => [
                'column' => 'product_ean',
                'operator' => '=',
                'value' => $ean
            ]
        ];

        return $db->select($select, 'productimage', $where);
    }
}