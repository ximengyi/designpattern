<?php

interface Prototype {
    public function copy();
   }

class ConcretePrototype implements Prototype{
  
  public $_name;
   
  public function __construct($name) {
  $this->_name = $name;
  }
   
  public function setName($name) {
  $this->_name = $name;
  }
   
  public function getName() {
  return $this->_name;
  }
   
  public function copy() {
  
  return clone $this; 
  }

}

     
    $demo = "jack";

    $object1 = new ConcretePrototype($demo);
    $object2 = $object1->copy();
      
    echo "{$object1->getName()}\n";
    echo "{$object2->getName()}\n";
     
    $object1->setName("tom");

    echo "{$object1->getName()}\n";
    echo "{$object2->getName()}\n";

 


