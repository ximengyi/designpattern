<?php

// 允许向一个现有的对象添加新的功能，同时又不改变其结构。这种类型的设计模式属于结构型模式，它是作为现有的类的一个包装。
// 这种模式创建了一个装饰类，用来包装原有的类，并在保持类方法签名完整性的前提下，提供了额外的功能。
// 我们通过下面的实例来演示装饰器模式的用法。其中，我们将把一个形状装饰上不同的颜色，同时又不改变形状类。


interface Shape
{
    function draw();
}

class Rectangle implements Shape {
    public $name = "三角形";
    
    public function draw()
    {
       echo "绘制形状：三角形\n";
    }
 }

 class Circle implements Shape {
    public  $name = "圆";
    public function draw()
    {
       echo "绘制形状:圆\n";
    }
 }

 // 定义抽象类约束子类都应当可以调用对原来的类的方法，并可以修饰原来的类方法
//将原来的类传进来，并调用原来的方法
abstract class ShapeDecorator implements Shape {

    protected  $decoratedShape;

    public function __construct(Shape $decoratedShape)
    {
       $this->decoratedShape = $decoratedShape;
    }
 
    public function draw(){

      $this->decoratedShape->draw();

    }

 }

class RedShapeDecorator extends ShapeDecorator {

   public function __construct(Shape $decoratedShape)
   {
       parent::__construct($decoratedShape);
   }

    public function draw() {
        $this->decoratedShape->draw();       
        $this->setRedBorder();
    }
 
    private function  setRedBorder(){
     //   System.out.println("Border Colo: Red");
       echo "{$this->decoratedShape->name}边框颜色为红色\n";
    }
 }

 //----------------开始测试-------------------

$circle  = new Circle();
//可以绘制圆，下面用装饰器绘制红色的圆
$redCircle = new RedShapeDecorator($circle);
echo "----绘制没有颜色的圆----\n";
$circle->draw();
echo "----绘制带颜色的圆----\n";
$redCircle->draw();

echo "--------下面是三角形案例-------\n";
//三角形为例
$redRectangle = new RedShapeDecorator(new Rectangle());
$redRectangle->draw();



