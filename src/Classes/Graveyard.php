<?php

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

echo '<pre>' . print_r($someCar, 1) . '</pre><hr>';
//echo '<pre>' . print_r($someCar->prepDetailsArray(), 1) . '</pre><hr>';




//
////
$db = Database::getInstance()->db_insert(
        "INSERT INTO `cars`(`name`, `color`) VALUES (?,?)", 'ss', array(generateRandomString(), 'this')
);


