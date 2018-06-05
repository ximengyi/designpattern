<?php
//意图：为子系统中的一组接口提供一个一致的界面，外观模式定义了一个高层接口，这个接口使得这一子系统更加容易使用。

//主要解决：降低访问复杂系统的内部子系统时的复杂度，简化客户端与之的接口。
//在客户端和复杂系统之间再加一层，这一层将调用顺序、依赖关系等处理好

//像给糖果包装一样加一层糖纸，这样可以解决糖不粘手的问题
interface Shape 
{
  public function draw();
}

class Rectangle implements Shape {

    public function draw() {
       //System.out.println("Rectangle::draw()");
       echo "调用三角形的draw方法\n"; 
    }
 }

class Square implements Shape {

  public function draw() {
     echo "调用正方形的draw方法\n";
  }
}

class Circle implements Shape {

  public function draw() {
     echo "调用圆的draw方法\n";
  }
}


class ShapeMaker {
  public  $circle;
  private  $rectangle;
  private  $square;

 public function __construct()
 {
      $this->circle = new Circle();
      $this->rectangle  = new Rectangle();
      $this->square = new square();
 }

  public function drawCircle(){

     $this->circle->draw();
  }

  public function drawRectangle(){
     $this->rectangle->draw();
  }

  public function drawSquare(){
     $this->square->draw();
  }
}

// --------------测试------------
 $shapeMaker = new ShapeMaker();

$shapeMaker->drawCircle();
$shapeMaker->drawRectangle();
$shapeMaker->drawSquare();