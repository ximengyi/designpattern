<?php
interface Shape 
{
  public function draw();
}

class Rectangle implements Shape {

    public function draw() {
       //System.out.println("Rectangle::draw()");
       echo "调用三角形的draw方法"; 
    }
 }