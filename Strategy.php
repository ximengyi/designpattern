<?php

// 策略模式，将负杂的业务依靠if else 的业务拆成多个独立的模块
interface Strategy {
    public function doOperation($num1, $num2);
 }


 class OperationAdd implements Strategy{

    public function doOperation($num1, $num2) {
       return $num1 + $num2;
    }
 }

class OperationSubstract implements Strategy{

    public function doOperation($num1, $num2) {
       return $num1 - $num2;
    }
 }

 class OperationMultiply implements Strategy{
    
    public function doOperation($num1, $num2) {
       return $num1 * $num2;
    }
 }

  class Context {

    private  $strategy;
   
    public function __construct($strategy)
    {
        $this->strategy = $strategy;
    }
 
    public function executeStrategy($num1, $num2){

       return $this->strategy->doOperation($num1, $num2);
    }
 }

 //--------------------开始测试------------

 $context = new Context(new OperationAdd());  
 $result=$context->executeStrategy(10,5);
 echo "10 + 5 ={$result}\n";


 $context = new Context(new OperationSubstract());   
 $result=$context->executeStrategy(10,5);    
 echo "10 - 5 ={$result}\n";


 $context = new Context(new OperationMultiply());  
 $result=$context->executeStrategy(10,5);       
 echo "10 * 5 = {$result}\n";