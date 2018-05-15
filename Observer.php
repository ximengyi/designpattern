<?php
// 观测者模式定义了对象之间的一对多依赖，当一个对象状态发生改变时，其依赖者便会收到通知并做相应的更新。
// 其原则是：为交互对象之间松耦合。
 class Subject {
    
   // private List<Observer> observers  = new ArrayList<Observer>();
    public  $array=[];
    private $state;
 
    public function getState() {
       return state;
    }
 
    public function setState($state) {
       $this->state = state;
       notifyAllObservers();
    }
 
    public function  attach($observer){
       observers.add(observer);  
             
    }
 
    public function  notifyAllObservers(){
    //    for (Observer observer : observers) {
    //       observer.update();
    //    }
     foreach($this->array as $value){

     }

    }     
 }