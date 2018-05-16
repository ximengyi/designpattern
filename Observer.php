<?php
// 观测者模式定义了对象之间的一对多依赖，当一个对象状态发生改变时，其依赖者便会收到通知并做相应的更新。
// 其原则是：为交互对象之间松耦合。

//某公司有一个女明星属于十八线不知名女名星，公司为了炒作她，聘请了 Bill jack 等狗仔来拍照，炒作她。
//女明星会通知狗仔自己在干啥，狗仔负责观察偷拍，公司怕某个狗仔不能及时排到信息会雇佣多个狗仔偷拍

 class Subject {
    
   // private List<Observer> observers  = new ArrayList<Observer>();
    public  $array=[];
    private $state;
    public $name;

    public function __construct($name)
    {
      $this->name=$name;
    }
 
    public function getState() {
       return $this->state;
    }
 
    public function setState($state) {
       $this->state = $state;
       $this->notifyAllObservers();
    }
 
    public function attach($observer){

      $this->array[] = $observer;  
             
    }
 
    public function  notifyAllObservers(){

     foreach($this->array as $value){
         $value->update();
     }

    }     
 }

 // 抽象类
 abstract class Observer {
  protected  $subject;
  public abstract function update();
}



class BillObserver extends Observer{

  public function __construct($subject)
  {
    $this->subject = $subject;
    $this->subject->attach($this);
  }
 
  public function  update() {
     
     echo "Bill 看到了女明星{$this->subject->name}正在{$this->subject->getState()}\n";
  }

}

class JackObserver extends Observer{

  public function __construct($subject)
  {
    $this->subject = $subject;
    $this->subject->attach($this);
  }
 
  public function  update() {
     
     echo "jack 看到了女明星{$this->subject->name}正在{$this->subject->getState()}\n";
  }
  
}


//-----------开始模拟--------------\\

$subject = new Subject("小红");

new BillObserver($subject);
new JackObserver($subject);
$subject->setState("与绯闻男友吃饭");

echo "--------分割线-------\n";

$subject->setState("与绯闻男友洗澡");

echo "--------分割线-------\n";
$subject->setState("与绯闻男友接吻");







