<?php

namespace App\Http\Controllers;
class Binary{
     public function __construct($binarystring){
          $this->binarystring = $binarystring;
     }

     public function __toString(){
          return $this->binarystring;
     }
}