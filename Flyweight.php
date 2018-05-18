<?php
//享元模式
//享元模式（Flyweight Pattern）主要用于减少创建对象的数量，
//以减少内存占用和提高性能。这种类型的设计模式属于结构型模式，它提供了减少对象数量从而改善应用所需的对象结构的方式。
//享元模式尝试重用现有的同类对象，如果未找到匹配的对象，则创建新对象。
//我们将通过创建 5 个对象来画出 20 个分布于不同位置的圆来演示这种模式。
//由于只有 5 种可用的颜色，所以 color 属性被用来检查现有的 Circle 对象。

interface Shape {
    function  draw();
 }


class Circle implements Shape {
    private  $color;
    private  $x;
    private  $y;
    private  $radius;
 
    public function __construct($color)
    {
        $this->color =$color; 
    }
    public function setX($x) {
       $this->x =$x;
    }
 
    public function setY($y) {
       $this->y = $y;
    }
 
    public function setRadius($radius) {
       $this->radius = $radius;
    }
 
    public function draw() {

        echo "调用圆的画画方法：颜色：{$this->color} x坐标：{$this->x} y坐标：{$this->y} 半径 {$this->radius}\n";
    }
 }
 
class ShapeFactory {

    private static $circleMap=[];
    public static function getCircle($color) {

    //从关联数组里面取对象如果取不到则创建

      if(empty(self::$circleMap[$color])){

          $circle = new Circle($color);
          self::$circleMap[$color] = $circle;
          echo "正在创建圆的颜色 + {$color}------>>>>>";

      }else{
          $circle =self::$circleMap[$color];
      }

       return $circle;
    }
 }

 // 定义随机函数返回不同颜色对象
 function  getRandomColor()
 {
     $arr = ['Red','green','blue','white','black','yellow'];

     return $arr[rand(0,5)];
 }


//-----------------创建对象测试-----------，当内存中已有对象时就直接返回,当内存中没有该对象时则创建

 for($i = 0; $i < 20; $i++)
 {

     $circle = ShapeFactory::getCircle(getRandomColor());
     $circle->setX(rand(0,100));
     $circle->setY(rand(0,100));
     $circle->setRadius(100);
     $circle->draw();
 }