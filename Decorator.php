<?php

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



