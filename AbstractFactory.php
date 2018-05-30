<?php

// 抽象工厂，其实就是工厂的工厂

// 意图：提供一个创建一系列相关或相互依赖对象的接口，而无需指定它们具体的类。

// 主要解决：主要解决接口选择的问题。

// 何时使用：系统的产品有多于一个的产品族，而系统只消费其中某一族的产品。

// 如何解决：在一个产品族里面，定义多个产品。

// 关键代码：在一个工厂里聚合多个同类产品。



//形状接口
interface Shape {

    function draw();

 }
//----------下面是图形的实体类
class Rectangle implements Shape {

    public function draw() {
        echo "这个是三角形里面的方法\n";
    }

 }

 class Square implements Shape {

    public function draw() {
        echo "这个是正方形里面的方法\n";
    }
 }

class Circle implements Shape {

    public function draw() {
      echo "这个是圆形里面的方法\n";
    }
 }


// 颜色接口
interface Color {
    function fill();
 }

class Red implements Color {

    public function fill() {

       echo "这个是红色方法\n";

    }
 }

class Green implements Color {

    public function fill() {
      echo "这个是红色方法\n";
    }
 }

class Blue implements Color {

    public function fill() {
      echo "这个是蓝色方法\n";
    }
 }

 // 抽象工厂，工厂的工厂
abstract class AbstractFactory {
     abstract static function getColor($color);
     abstract static function getShape($shape);
 }

//图形工厂 必须实现提供图形的方法
class ShapeFactory extends AbstractFactory {
    
   public static function getShape($shapeType){
      if($shapeType == null){

         return null;
      } 

      if(strcasecmp($shapeType,'CIRCLE')==0){

         return new Circle();

      } else if(strcasecmp($shapeType,'RECTANGLE')==0){

         return new Rectangle();

      } else if(strcasecmp($shapeType,'SQUARE')==0){

         return new Square();
      }
      return null;
   }
   
  public static function  getColor($color) {
      return null;
   }
}


class ColorFactory extends AbstractFactory {
    
    public static function getShape($shapeType){
       return null;
    }
    public  static function getColor($color) {
       if($color == null){
          return null;
       }        
       if(strcasecmp($color,'RED') == 0){
          return new Red();

       }else if(strcasecmp($color,'GREEN') == 0){
          return new Green();

       } else if(strcasecmp($color,'BLUE') == 0){
          return new Blue();
       }

       return null;
    }
 }

class FactoryProducer {
    public static function getFactory($choice){
       if(strcasecmp($choice,'SHAPE') == 0){
          return new ShapeFactory();
       } else if(strcasecmp($choice,'COLOR') == 0){
          return new ColorFactory();
       }
       return null;
    }
 }
//工厂提取一个圆
 $shapeFactory = FactoryProducer::getFactory("SHAPE");
 $shape1 = shapeFactory::getShape("CIRCLE");
 $shape1->draw();
 
//工厂提取一个三角形
 $shape2 = shapeFactory::getShape("rectangle");
 $shape2->draw();
 //工厂提取一个正方形
 $shape3 = shapeFactory::getShape("square");
 $shape3->draw();


$colorFactory = FactoryProducer::getFactory("COLOR");

//获取红色
$color1 = $colorFactory->getColor('red');
$color1->fill();
//获取蓝色

$color2 = $colorFactory->getColor('blue');
$color2->fill();

//获取绿色
$color3 = $colorFactory->getColor('Green');
$color3->fill();


