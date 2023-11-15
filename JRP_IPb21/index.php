<?php
include "Car.php";

$carParams = [
    "color"=>"red",
    "brand"=>"year",
    "year"=> 2005,
    "milage"=>200000,
    "tireSize"=>16,
    "tirePressure"=>2.2,
    "type"=>"Hybrid"

]
$justCar = new Car("red","year",2005, 200000,16,2.2,"Hybrid");
$tiers = [new Tire()];

print_r($CarParams);

?>