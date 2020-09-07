<?php

class CompanyProduct extends Database
{

    private $table;

    private $company_id;
    private $product_id;
    private $status;
    private $price;
    private $instock;

    private $errors = [];

    /**
     * Product constructor.
     *
     * @param string $table
     */
    public function __construct($table = 'company_product')
    {
        parent::__construct();

        $this->table = $table;
    }

    public function getCompanyId()
    {
        return $this->company_id;
    }

    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price = null)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getInstock()
    {
        return $this->instock;
    }

    /**
     * @param bool $instock
     */
    public function setInstock(bool $instock = null)
    {
        $this->instock = $instock;
    }

    public static function getBy($column, $value)
    {
        global $db;

        $select = ['*'];

        $where = [
            'id' => [
                'column' => $column,
                'operator' => '=',
                'value' => $value
            ]
        ];

        return $db->select($select, 'company_product', $where);
    }

    public static function getAvaibleBy($column, $value)
    {
        global $db;

        $select = ['*'];

        $where = [
            'id' => [
                'column' => $column,
                'operator' => '=',
                'value' => $value,
            ],
            'avaible' => [
                'column' => 'status',
                'operator' => '=',
                'value' => 'beschikbaar',
            ]
        ];

        return $db->select($select, 'company_product', $where);
    }

    public static function getCheapestByEan($ean) {
        global $db;

        $select = ['price'];

        $where = [
            'ean' => [
                'column' => 'product_id',
                'operator' => '=',
                'value' => $ean,
            ],
            'avaible' => [
                'column' => 'status',
                'operator' => '=',
                'value' => 'beschikbaar',
            ]
        ];

        $order = [
            'column' => 'price',
            'order' => 'ASC'
        ];

        return $db->select($select, 'company_product', $where, [], $order)[0]??null;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

}