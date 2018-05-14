<?php

interface Prototype {
    public function copy();
   }

class ConcretePrototype implements Prototype{
  
  private $_name;
   
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
  /* 深拷贝实现
  $serialize_obj = serialize($this); // 序列化
  $clone_obj = unserialize($serialize_obj); // 反序列化       
  return $clone_obj;
  */
  return clone $this; // 浅拷贝
  }

}

class Demo {
    public $array;

   }
     
 class Client {
     
    /**
    * Main program.
    */
    public static function main() {
     
    $demo = new Demo();
    $demo->array = array(1, 2);
    $object1 = new ConcretePrototype($demo);
    $object2 = $object1->copy();
     
    var_dump($object1->getName());
    echo '<br />';
    var_dump($object2->getName());
    echo '<br />';
     
    $demo->array = array(3, 4);
    var_dump($object1->getName());
    echo '<br />';
    var_dump($object2->getName());
    echo '<br />';
     
    }
     
   }

 


















//  补充：浅拷贝与深拷贝

// 浅拷贝
// 被拷贝对象的所有变量都含有与原对象相同的值，而且对其他对象的引用仍然是指向原来的对象。
// 即 浅拷贝只负责当前对象实例，对引用的对象不做拷贝。

// 深拷贝
// 被拷贝对象的所有的变量都含有与原来对象相同的值，除了那些引用其他对象的变量。那些引用其他对象的变量将指向一个被拷贝的新对象，而不再是原有那些被引用对象。
// 即 深拷贝把要拷贝的对象所引用的对象也都拷贝了一次，而这种对被引用到的对象拷贝叫做间接拷贝。
// 深拷贝要深入到多少层，是一个不确定的问题。
// 在决定以深拷贝的方式拷贝一个对象的时候，必须决定对间接拷贝的对象是采取浅拷贝还是深拷贝还是继续采用深拷贝。
// 因此，在采取深拷贝时，需要决定多深才算深。此外，在深拷贝的过程中，很可能会出现循环引用的问题。

// 利用序列化来做深拷贝
// 利用序列化来做深拷贝,把对象写到流里的过程是序列化（Serilization）过程，但在业界又将串行化这一过程形象的称为“冷冻”或“腌咸菜”过程；而把对象从流中读出来的过程则叫做反序列化（Deserialization）过程，也称为“解冻”或“回鲜”过程。
// 在PHP中使用serialize和unserialize函数实现序列化和反序列化。

// 在上面的代码中的注释就是一个先序列化再反序列化实现深拷贝的过程。