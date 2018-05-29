<?php
//备忘录模式
// 备忘录模式（Memento Pattern）保存一个对象的某个状态，以便在适当的时候恢复对象。备忘录模式属于行为型模式。

// 意图：在不破坏封装性的前提下，捕获一个对象的内部状态，并在该对象之外保存这个状态。

// 主要解决：所谓备忘录模式就是在不破坏封装的前提下，捕获一个对象的内部状态，并在该对象之外保存这个状态，这样可以在以后将对象恢复到原先保存的状态。

// 何时使用：很多时候我们总是需要记录一个对象的内部状态，这样做的目的就是为了允许用户取消不确定或者错误的操作，能够恢复到他原先的状态，使得他有"后悔药"可吃。
// 应用实例： 1、后悔药。 2、打游戏时的存档。 3、Windows 里的 ctri + z。 4、IE 中的后退。 4、数据库的事务管理。

// 优点： 1、给用户提供了一种可以恢复状态的机制，可以使用户能够比较方便地回到某个历史的状态。 2、实现了信息的封装，





//Memento负责存储Originator对象的内部状态,并可防止originator以外的其他对象访问备忘录Memento
class Memento {

    private  $state;

    public function __construct($state)
    {
      $this->state = $state;
    }
 
    public function getState()
    {
       return $this->state;
    }

 }

 //原始类 Originator //负责创建一个备忘录Memento，用以记录当前时刻
//它的内部状态,并可使用备忘录恢复内部状态
class Originator {

    private  $state;

    public function setState($state){

       $this->state = $state;

    }
 
    public function getState(){

       return $this->state;

    }
 
    public function saveStateToMemento(){
       return new Memento($this->state);
    }
 
    public function getStateFromMemento(Memento $Memento){
       $this->state = $Memento->getState();
    }
 }

//管理类，管理对象
 class CareTaker {
    
    private $mementArray=[];
 
    public function add(Memento $state){

       array_push($this->mementArray,$state);

    }
 
    public function get($index){
       return $this->mementArray[$index];
    }
 }

//----------------开始测试-------------------
 $originator = new Originator();
 $careTaker = new CareTaker(); //备忘录管理类
 $originator->setState("State #1");
 $originator->setState("State #2");
 $careTaker->add($originator->saveStateToMemento());
 $originator->setState("State #3");
 $careTaker->add($originator->saveStateToMemento());
 $originator->setState("State #4");



echo "Current State：".$originator->getState()."\n"; //当前状态 #4
$originator->getStateFromMemento($careTaker->get(0)); //回到第一个状态 
echo "First saved State: ".$originator->getState()."\n"; //当前状态为第一个状态#2
echo $originator->getStateFromMemento($careTaker->get(1)); //回到第二个状态 
echo "Second saved State: ".$originator->getState()."\n";  //当前状态为第一个状态#3
