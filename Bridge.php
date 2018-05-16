<?php

//桥接接口
interface DrawAPI
 {

    public function drawCircle($radius, $x, $y);

 }

class RedCircle implements DrawAPI {

    public function drawCircle($radius, $x, $y)
     { 
       echo "正在绘制一个红色的圆半径为{$radius}圆心坐标为{$x},{$y}\n";
     }

 }

 class GreenCircle implements DrawAPI {

    public function drawCircle($radius, $x, $y) {
        echo "正在绘制一个绿色的圆半径为{$radius}圆心坐标为{$x},{$y}\n";
    }

 }

  abstract class Shape {
    protected  $drawAPI;
    protected function __construct(DrawAPI $drawAPI)
    {
        $this->drawAPI= $drawAPI;

    }

    public abstract function draw(); 

 }

  class Circle extends Shape {
    private $x, $y, $radius;
    public function __construct($x,$y,$radius,DrawAPI $drawAPI)
    {
        parent::__construct($drawAPI);
        $this->x =$x;
        $this->y =$y;
        $this->radius= $radius; 
    }
 
    public function draw() {
       $this->drawAPI->drawCircle($this->radius,$this->x,$this->y);
    }

 }


 ///-------------------------------测试
  // 抽象类与实现类相分离，通过circle 将具体实现类与 抽象类分离，
  // 两者可以独立维护，互不影响
  //避免直接继承，在类很多的情况下，如果直接继承，抽象类Shape 增加一个方法，那么所有的子类都需要增加同样的方法，
 // redcircle， greencircle都要增加同样的方法
$red =  new RedCircle();
$redCircle = new Circle(100,100, 10,$red);

$green = new GreenCircle();
$greenCircle = new Circle(100,100, 10, $green);

$redCircle->draw();
$greenCircle->draw();