<?php

use Slim\Http\Request;
use Slim\Http\Response;

include 'Class_Interface.php';
// Routes

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello There!, $name");
    return $response;
});
////////////////////
////////PRODUCT/VEHICLE ROUTES
////
$app->get('/product/vehicle/{name}', function (Request $request, Response $response, array $args) {
    $name_url = $args['name'];
    $db = Database::getInstance();
    $output = $db->db_fetch(Vehicle::read_SqlParams($name_url), 'SELECT');
    return $response->getBody()->write("{$output}");
});
////
$app->post(
        '/product/class_type/{class_type}'
        . '/name={Obj_property_name}'
        . '&type={Obj_property_type}'
        . '&price={Obj_property_price}'
        . '&date_sold={Obj_property_date_sold}'
        . '&licensePlate={Obj_property_licensePlate}', function ($request, $response, array $args) {
    $class_type = $args['class_type'];
    $name = $args['Obj_property_name'];
    $type = $args['Obj_property_type'];
    $price = $args['Obj_property_price'];
    $date_sold = $args['Obj_property_date_sold'];
    $licensePlate = $args['Obj_property_licensePlate'];

    //////
    $factory = new Product_Factory;
    $someVehicle = $factory->create(array($class_type, $name, $type, $price, $date_sold, $licensePlate));
    $db = Database::getInstance();
    $injectarray = $someVehicle->create_SqlParams();
    $db->db_insert($injectarray[0], $injectarray[1], $someVehicle->addToInsertSQLArray());
    //////
    $last_id = $db->db_fetch(Vehicle::return_id_SqlParams($name), 'SELECT_ID');
    return $response->getBody()->write("the new ID is {$last_id}");
});
////