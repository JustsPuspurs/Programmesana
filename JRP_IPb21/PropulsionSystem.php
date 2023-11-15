<?php

abstract class PropulsionSystem{
    function __construct(public $fuleType, 
                         public $power,
                         protected $efficiency){

    }
    abstract public function work();

}

?>