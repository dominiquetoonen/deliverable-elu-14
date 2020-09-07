<?php

class Database
{

    private $mysqli;

    /**
     * Return array of Database credentials
     * @return array
     */
    private static function getCredentials()
    {
        $credentialsFile = file_get_contents(dirname(__DIR__) . '/credentials.json');
        $credentials = json_decode($credentialsFile);
        $dbCredentials = $credentials->database;
        return $dbCredentials;
    }

    /**
     * Database constructor.
     * Connect with Database
     */
    public function __construct()
    {
        $dbCredentials = self::getCredentials();

        $host = $dbCredentials->host;
        $username = $dbCredentials->username;
        $password = $dbCredentials->password;
        $database = $dbCredentials->database;

        $mysqli = new mysqli($host, $username, $password, $database);

        if ($mysqli->connect_errno) {
            exit("Failed to connect to MySQL: " . $mysqli->connect_error);
        }

        $this->mysqli = $mysqli;
    }

	/**
	 * Get errors from mysqli.
	 *
	 * @return array
	 */
	public function getSqlErrors()
	{
		return $this->mysqli->error_list;
	}

    /**
     * Close mysqli connection
     */
    public function close()
    {
        $this->mysqli->close();
    }

	/**
	 * Select query
	 * @param array $select
	 * @param string $table
	 * @param array $where
	 * @example = [
	 *      [
	 *          'column' => 'column1',
	 *          'operator' => '=',
	 *          'value' => 'value1'
	 *      ],
	 *      [
	 *          'column' => 'column2',
	 *          'operator' => 'LIKE',
	 *          'value' => 'value2'
	 *      ]
	 * ]
	 * @param array $limit
	 * @example = [
	 *      [
	 *          'limit' => 10,
	 *          'offset' => 20
	 *      ]
	 * ]
	 * @param array $order
	 * @example = [
	 *      [
	 *          'column' => 'column1',
	 *          'order' => 'DESC'
	 *      ]
	 * ]
	 * @return array
	 */
	public function select(array $select, string $table, array $where = [], array $limit = [], array $order = [])
	{
		$sql = "SELECT";

        $count = 0;
        foreach ($select as $value) {
            $count++;
            $sql .= " {$value}";
            if (count($select) < $count) {
                $sql .= ",";
            }
        }

        $sql .= " FROM {$table}";

        if (!empty($where)) {
            $sql .= self::formatWhere($where);
        }

		if(!empty($limit)) {
			$sql .= " LIMIT {$limit['limit']} OFFSET {$limit['offset']}";
		}

		if(!empty($order)) {
			$sql .= " ORDER BY {$order['column']} {$order['order']}";
		}

        $result = $this->mysqli->query($sql);

		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$returnArr[] = $row;
	        }
		} else {
			$returnArr = [];
		}

        return $returnArr;
    }

    /**
     * Insert query
     * @param string $table
     * @param array $data
     * @example = [
     *      'column1' => 'value1',
     *      'column2' => 'value2
     * ]
     * @return boolean
     */
    public function insert(string $table, array $data)
    {
        $columns = " (";
        $values = " (";
        $count = 0;

        foreach ($data as $column => $value) {

            $count++;
            if (!isset($value)) {
                continue;
            }

            $columns .= $column;
            $values .= "'{$value}'";
            if (count($data) > $count) {
                $columns .= ", ";
                $values .= ", ";
            }
        }
        $columns .= ")";
        $values .= ")";

        $sql = "INSERT INTO {$table} {$columns} VALUES {$values}";

        if ($this->mysqli->query($sql) === true) {
            return true;
        }

        return false;
    }

    /**
     * Update query
     * @param string $table
     * @param array $data
     * @example = [
     *      'column1' => 'value1',
     *      'column2' => 'value2
     * ]
     * @param array $where
     * @example = [
     *      [
     *          'column' => 'column1',
     *          'operator' => '=',
     *          'value' => 'value1'
     *      ],
     *      [
     *          'column' => 'column2',
     *          'operator' => 'LIKE',
     *          'value' => 'value2'
     *      ]
     * ]
     * @return boolean
     */
    public function update(string $table, array $data, array $where = [])
    {
        $sql = "UPDATE {$table} SET";

        $count = 0;
        foreach ($data as $column => $value) {
            $count++;
            $sql .= " {$column}='{$value}'";
            if ($count < count($data)) {
                $sql .= ",";
            }
        }

        $sql .= self::formatWhere($where);

        if ($this->mysqli->query($sql) === true) {
            return true;
        }

        return false;
    }

    /**
     * Delete query
     * @param string $table
     * @param array $where
     * @example = [
     *      [
     *          'column' => 'column1',
     *          'operator' => '=',
     *          'value' => 'value1'
     *      ],
     *      [
     *          'column' => 'column2',
     *          'operator' => 'LIKE',
     *          'value' => 'value2'
     *      ]
     * ]
     * @return boolean
     */
    public function delete(string $table, array $where)
    {
        $sql = "DELETE FROM {$table}";
        $sql .= self::formatWhere($where);

        if ($this->mysqli->query($sql) === true) {
            return true;
        }

        return false;
    }
	/**
	 * Do a manual query on the database.
	 *
	 * @param string $query
	 *
	 * @return bool|mysqli_result
	 */
	public function query(string $query)
	{
		$result = $this->mysqli->query($query);
		return $result;
	}


    /**
     * @param array $where
     * @return string
     */
    private static function formatWhere($where)
    {
        $sql = " WHERE";
        $count = 0;
        foreach ($where as $data) {
            $count++;

            $operator = html_entity_decode($data['operator']);

            $sql .= " {$data['column']} {$operator} '{$data['value']}'";

            if (count($where) > $count) {
                $sql .= " AND";
            }
        }
        return $sql;
    }

}