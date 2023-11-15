<?php
include "Tier.php";
include "PropulsionSystem.php";


class Car{
    public $tires = [];
    private $PropulsionSystem = [];

    function __construct(public $color, 
                         public $brand, 
                         private $releaseYear,
                         private $milage,
                         $tireSize,
                         $tirePressure,
                         $type
                        ){
        
        for ($i=0; $i<4; $i++){
        $this->tires[] = new Tire($tirePressure, $tireSize);
        }
        if ($type == "Electric" ){
            $this->PropulsionSystem[] = new ElectricMotor(780, "electricity", 0.9);
        }else if ($type ==="Hybrid") {
            $this->PropulsionSystem[] = new ElectricMotor(780, "electricity", 0.9);
            $this->PropulsionSystem[] = new ICEngine(900, "Hybrid", 3.0);
        }else{
            $this->PropulsionSystem[] = new ICEngine(900, "Hybrid", 3.0);
        }
            

            
        }
    }
    function makeNoise(){

    }
    function move(){

    }
}

?>