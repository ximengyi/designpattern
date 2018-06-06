<?php

//  访问者模式
// 何时使用：需要对一个对象结构中的对象进行很多不同的并且不相关的操作，
// 而需要避免让这些操作"污染"这些对象的类，使用访问者模式将这些封装到类中。

//声明一个接受访问的接口
interface ComputerPart {
   public function accept(ComputerPartVisitor $computerPartVisitor);
}

//键盘类实现对外提供访问接口
class Keyboard  implements ComputerPart {


    public function accept(ComputerPartVisitor $computerPartVisitor) {

       $computerPartVisitor->visit($this);
    }
 }

 //显示器类，对外提供访问接口
class Monitor  implements ComputerPart {

    
    public function accept(ComputerPartVisitor $computerPartVisitor) {
       $computerPartVisitor->visit($this);
    }
 }

 //鼠标类，对外提供访问接口
class Mouse  implements ComputerPart {

    public function accept(ComputerPartVisitor $computerPartVisitor) {
        $computerPartVisitor->visit($this);
    }
 }


 // 电脑类对外提供访问接口
 //元素的集合
 class Computer implements ComputerPart {
    
    public  $parts = [];

    public function __construct()
    {

     $this->parts = [new Mouse(),new Keyboard(),new Monitor()];

    }

    public function accept(ComputerPartVisitor $computerPartVisitor) {
         foreach($this->parts as $value)
        {
           $value->accept($computerPartVisitor);
        }

         $computerPartVisitor->visit($this);
    }
 }

 // 访问者接口
interface ComputerPartVisitor {

    public function visit(ComputerPart $parts);
   
}

//具体的访问者类，实现访问接口
class ComputerPartDisplayVisitor implements ComputerPartVisitor {

    // 加上如果要对不同的类有不同的操作，可以加上判断进行不同的操作

    public function visit(ComputerPart $parts) {
        
        echo "显示：".get_class($parts)."\n";
        //  $value = get_class($parts);

        // switch ($value) {
        //     case 'Mouse':
        //     echo "显示：".$value."\n";
        //         break;
        //     case 'Keyboard':
        //     echo "显示：".$value."\n";
        //         break;
        //     case 'Monitor':
        //     echo "显示：".$value."\n";
        //         break;
        //     case 'Computer':
        //     echo "显示：".$value."\n";
        //         break;
        //     default:
        //         # code...
        //         break;
        // }


    }

 }

 //--------------------------开始测试--------------------------

 $computer = new Computer();
 $computer->accept(new ComputerPartDisplayVisitor());