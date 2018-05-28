<?php
 ini_set('date.timezone','Asia/Shanghai');
//中介者模式
// 图：用一个中介对象来封装一系列的对象交互，中介者使各对象不需要显式地相互引用，从而使其耦合松散，而且可以独立地改变它们之间的交互。

// 主要解决：对象与对象之间存在大量的关联关系，这样势必会导致系统的结构变得很复杂，同时若一个对象发生改变，我们也需要跟踪与之相关联的对象，同时做出相应的处理。

// 何时使用：多个类相互耦合，形成了网状结构。

// 如何解决：将上述网状结构分离为星型结构。

class ChatRoom {
    public static function showMessage(User $user,  $message){
    //    System.out.println(new Date().toString() + " [" + user.getName() +"] : " + message);
      $time= date("H:i:s");
       echo "{$time}:"."[{$user->getName()}]:".$message."\n";
    }

 }

class User {
    public  $name;
 

    public function __construct($name){
        $this->name  = $name;
     }

    public function getName() {

       return $this->name;
    }
 
    public function setName( $name) {
       $this->name = $name;
    }
 
    
 
    public function sendMessage($message){

       ChatRoom::showMessage($this,$message);

    }
 }


  $robert = new User("Robert");
  $john = new User("John");

 $robert->sendMessage("Hi! John!");
 $john->sendMessage("Hello! Robert!");