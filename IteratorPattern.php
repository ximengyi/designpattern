<?php
//迭代器模式
// 意图：提供一种方法顺序访问一个聚合对象中各个元素, 而又无须暴露该对象的内部表示。

// 主要解决：不同的方式来遍历整个整合对象。

// 何时使用：遍历一个聚合对象。

// 如何解决：把在元素之间游走的责任交给迭代器，而不是聚合对象。
// 关键代码：定义接口：hasNext, next

// 迭代器接口
// 在软件开发中，我们经常需要使用聚合对象来存储一系列数据。聚合对象拥有两个职责：
// 一是存储数据；二是遍历数据。从依赖性来看，前者是聚合对象的基本职责；
// 而后者既是可变化的，又是可分离的。因此，可以将遍历数据的行为从聚合对象中分离出来，封装在一个被称之为“迭代器”的对象中，
// 由迭代器来提供遍历聚合对象内部数据的行为，这将简化聚合对象的设计，更符合“单一职责原则”的要求

//本质上是将存储对象的本身与迭代器分离，解耦;
interface Iterators {

    public function hasNext();
    public function next();

 }


interface Container {

    public function getIterator();

 }

// 姓名迭代器
class NameIterator implements Iterators {
 
    public  $index = 0;
    public  $names=[];

public function __construct($names)
{
  $this->names = $names;
}

public function hasNext() {
       if($this->index < sizeof($this->names)){
          return true;
       }
       return false;
    }

 public function next() {
       if($this->hasNext()){
          return $this->names[$this->index++];
       }
       return null;
    }        
 }

 //姓名容器
 class NameRepository implements Container {
    public  $names = ["Robert" , "John" ,"Julie" , "Lora"];

    public function getIterator() {
       return new NameIterator($this->names);
    }

 }


 $namesRepository = new NameRepository();
 $iter = $namesRepository->getIterator();

while($iter->hasNext()){
    echo "Name: {$iter->next()}\n";
}