<?php

class Product_Factory implements iFactory {

    public function create($Param_array) {
        switch ($Param_array[0]) {
            case 'Vehicle':
                $product = $this->product = new Vehicle(
                        $Param_array[1], $Param_array[2], $Param_array[3], $Param_array[4], $Param_array[5]
                );
                break;
            case 'Wheel':
                $product = $this->product = new Wheel($Param_array);
                break;
            case 'Bumper':
                $product = $this->product = new Bumper($Param_array);
                break;
            default:
                echo 'wrong parameters,creation aborted';
        }
        return $product;
    }

}
