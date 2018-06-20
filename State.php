<?php

//允许对象在内部状态发生改变时改变它的行为，对象看起来好像修改了它的类。\

//举一个灯的案例，
//1 灯有两个状态，要么是开着要么是关闭，
//2 当灯开着的状态不能再打开灯，只能关闭灯
//3 当灯是关闭状态只能打开灯，不能再关闭灯

//开灯接口
interface LightState
{
    public function turnOff(); //关灯
    public function turnOn(); //开灯
}

//关灯状态
class OffState implements LightState
{

    private $context;

    public function __construct(Context $contextNow)
    {
        $this->context = $contextNow;

    }

    public function turnOff()
    {
        echo "灯已经在关闭状态了-----按钮没有反应\n";

    }

    public function turnOn()
    {
        $this->context->setState($this->context->getOnState());
        echo "您打开的了灯，灯亮了\n";
       
    }
}
//开灯状态
class OnState implements LightState
{
    private $context;

    public function __construct(Context $contextNow)
    {
        $this->context = $contextNow;

    }

    public function turnOff()
    {
        $this->context->setState($this->context->getOffState());
        echo "您关闭了灯，灯灭了\n";
       
    }

    public function turnOn()
    {
        
        echo "灯已经在打开的状态了-----按钮没有反应\n";
    }

}

class Context
{

    private $offState;
    private $onState;
    private $currentState;
    //依赖注入
    public function __construct()
    {
       $this->offState =  new OffState($this);
       $this->onState =  new OnState($this);
   //当前状态默认为关闭状态
       $this->currentState = $this->offState; 
        
    }
    public function setState(LightState $state)
    {
        $this->currentState = $state;
    }

    public function turnOff(){

        $this->currentState->turnOff();
    }

    public function turnOn(){
           
        $this->currentState->turnOn();
        
    }
    //获取开状态
    public function getOnState()
    {
        return $this->onState;
    }

    //获取关闭状态
    public function getOffState()
    {
        return $this->offState;
    }
}

//---------开始测试
$context = new Context();

$context->turnOff();
$context->turnOn();
$context->turnOn();
$context->turnOff();
$context->turnOff();
echo"-------------------------------------\n";
$context->turnOn();
$context->turnOff();
$context->turnOn();
$context->turnOff();
