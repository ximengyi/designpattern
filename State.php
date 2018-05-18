<?php


//允许对象在内部状态发生改变时改变它的行为，对象看起来好像修改了它的类。

interface State {
    public function doAction(context $context);
 }


 class StartState implements State {

    public function doAction(context $context) {
       echo "运动员在准备状态\n";
       $context->setState($this);    
    }
 
    public function  toString(){
       return "准备\n";
    }
 }

class StopState implements State {

    public function doAction(Context $context) {
       //System.out.println("Player is in stop state");
       echo "运动员在停止状态\n";
      // context.setState(this);
       $context->setState($this);    
    }
 
    public function toString(){
       return "停止\n";
    }

 }

class Context {

    private  $state;
    public function __construct()
    {
        $this->state= null;
    }
    public function setState(State $state){
       $this->state = $state;        
    }
 
    public function  getState(){
       return $this->state;
    }
 }

 //---------开始测试
$context = new Context();


$startState = new StartState();
$startState->doAction($context);
$info = $context->getState()->toString();
echo "{$info}";



$stopState = new StopState();
$stopState->doAction($context);
$info = $context->getState()->toString();
echo "{$info}";


