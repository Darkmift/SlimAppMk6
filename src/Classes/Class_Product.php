<?php

abstract class Product {

    protected $name;
    protected $type;
    protected $price;
    protected $date_sold;

//protected $table;
    public function getName() {
        return $this->name;
    }

    public function __construct($name, $type, $price, $date_sold) {
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
        $this->date_sold = $date_sold;
    }

    public function insertSQLArray() {
        $details = array();
        $details[0] = $this->name;
        $details[1] = $this->type;
        $details[2] = $this->price;
        $details[3] = $this->date_sold;
        return $details;
    }

    function returnClassType() {
        //return __CLASS__;
        return get_called_class();
    }

    public function SortKeys() {
        $keysArrayThis = array_keys(get_class_vars(get_class($this)));
        $keysArrayParent = array_keys(get_class_vars(get_class()));
        if (count($keysArrayParent) !== count($keysArrayThis)) {
            $nameKeyPos = array_search('name', $keysArrayThis);
            $ParentChunk = array_slice($keysArrayThis, $nameKeyPos);
//            echo "<br>Parent_chunk<hr>";
//            print_r($ParentChunk);
//            echo "<br>Child_chunk<hr>";
            $ChildChunk = array_slice($keysArrayThis, 0, $nameKeyPos);
//            print_r($ChildChunk);
            $sortedKeys = $ParentChunk;
            foreach ($ChildChunk as $key => $value) {
                array_push($sortedKeys, $value);
            }
//            echo "<br>sorted<hr>";
//            print_r($sortedKeys);
            return $sortedKeys;
        } else {
            return $sortedKeys;
        }
    }

    public function create_SqlParams() {
        $columns = $this->SortKeys();
        $column_names = '';
        $queryValues = '';
        $types = '';
        for ($index = 0; $index < count($columns); $index++) {
            $column_names .= $columns[$index] . ',';
            $queryValues .= "?,";
            $types .= 's';
        }
        $queryString = "INSERT INTO " .
                lcfirst($this->returnClassType()) .
                "(" . substr($column_names, 0, -1) . ") " .
                "VALUES (" . substr($queryValues, 0, -1) . ")";
        return array($queryString, $types);
    }

    public static function read_SqlParams($param) {
        $queryString = '';
        if ($param === 'All') {
            $queryString = "SELECT * FROM " . lcfirst(self::returnClassType());
        } else {
            $queryString = "SELECT * FROM " . lcfirst(self::returnClassType()) . " WHERE `name`='$param'";
        }
        return $queryString;
    }

    public static function return_id_SqlParams($param) {
        $queryString = '';
        $queryString = "SELECT id FROM " . lcfirst(self::returnClassType()) . " WHERE `name`='$param'";
        return $queryString;
    }

    public static function update_SqlParams($where_Column, $param_to_update, $param_update_value) {
        $queryString = "UPDATE " . lcfirst(self::returnClassType()) . " "
                . "SET $where_Column = $param_update_value "
                . "WHERE $where_Column = $param_to_update";
        echo $queryString . "<hr>";
        return $queryString;
    }

    public static function delete_SqlParams($where_Column, $param_to_delete) {
        $queryString = "delete from " . lcfirst(self::returnClassType())
                . " where $where_Column = $param_to_delete "
                . "limit 1";
        echo $queryString . "<hr>";
        return $queryString;
    }

}
