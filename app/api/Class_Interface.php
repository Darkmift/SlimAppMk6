<?php

include '../src/Classes/Class_Product.php';
include '../src/Classes/Class_db.php';
include '../src/Classes/Class_Vehicle.php';
include '../src/Classes/Class_Product_Factory.php';
include '../src/Classes/Class_requestLog.php';

//vehicle interface
interface iVehicle {

    //fetch query for insert to db
    public function addToInsertSQLArray();

    //fetch query for select from db
    public static function read_SqlParams($param);

    public static function update_SqlParams($where_Column, $param_to_update, $param_update_value);

    public static function delete_SqlParams($where_Column, $param_to_delete);

    public static function return_id_SqlParams($param);
}

//db interface
interface InsertInterface {

    public function db_insert($queryString, $types, array $bindParamString);

    public function db_fetch($queryString, $action);
}

//factory interface

interface iFactory {

    public function create($Param_array);
}

//logs all requests
(new DumpHTTPRequestToFile)->execute('../logs/dumprequest.txt');
