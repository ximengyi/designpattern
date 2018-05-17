<?php

//老板批钱问题，组长只能批3000以下的生请款，经理可以批6000，ceo可以批20000；如果钱超过限额就要申请上级领导批钱

abstract class Manager
{
    protected $position;  // 管理者职位,

    protected $leader; //上级管理者

    public function __construct($position)
    {
        $this->position = $position;
    }
  
    public function setLeader(Manager $leader)  //设置上级领导
    {
      $this->leader = $leader;  
    }

   abstract public function apply($money);  //审批方法
}


class Groupleader extends Manager
{
    public function __construct($position)
    {
        parent::__construct($position);
    }

    public function apply($money)
    {
        if($money<=3000){
            echo "{$this->position} 批准了{$money}\n";
        }else{

            if($this->leader != null){
                $this->leader->apply($money);
            }
      
        }

    }

}


class Managerleader extends Manager
{
    public function __construct($position)
    {
        parent::__construct($position);
    }

    public function apply($money)
    {
        if($money<=6000){
            echo "{$this->position} 批准了{$money}\n";
        }else{

            if($this->leader != null){
                $this->leader->apply($money);
            }
      
        }

    }

}


class Ceoleader extends Manager
{
    public function __construct($position)
    {
        parent::__construct($position);
    }

    public function apply($money)
    {
        if($money<=20000){
            echo "{$this->position} 批准了{$money}\n";
        }else{

            if($this->leader != null){
                $this->leader->apply($money);
            }
      
        }

    }

}

//----------------开始测试,模拟场景

function  initPerson()
{
   $xiaowang = new GroupLeader("王组长");
   $xiaoli = new Managerleader("李经理");
   $xiaozhang = new Ceoleader("张CEO");
   $xiaowang->setLeader($xiaoli);
   $xiaoli->setLeader($xiaozhang);

   return $xiaowang;
}


//小明是普通员工

$xiaoming =  initPerson();
//----------------开始测试-----------------

$xiaoming->apply(2000);

$xiaoming->apply(4000);

$xiaoming->apply(8000);














//另一个案例

// abstract class AbstractLogger {

//       const INFO =  1;
//       const DEBUG = 2;
//       const ERROR = 3;
 
//     protected  $level;
//     //责任链中的下一个元素
//     protected  $nextLogger;
 
//     public function setNextLogger($nextLogger)
//     {
//        $this->nextLogger = $nextLogger;
//     }
 
//     public  function  logMessage($level, $message)
//     {
//        if($this->level <= $level){
//           $this->write($message);
//        }
//        if($this->nextLogger !=null){
//           $this->nextLogger->logMessage($level, $message);
//        }
//     }
 
//     abstract protected function write($message);
// }


//  class ConsoleLogger extends AbstractLogger {

//     public function __construct($level)
//     {
//         $this->level = $level; 
//     }
//     protected function write($message) {
//         echo "标准消息+{$message}\n";        
  
//     }
//  }


// class ErrorLogger extends AbstractLogger {

//      public function __construct($level)
//      {
//       $this->level = $level;
//      }

//     protected function write($message) {        
     
//        echo "错误消息+{$message}\n";
//     }

//  }


//  class FileLogger extends AbstractLogger {

//     public function __construct($level)
//     {
//      $this->level = $level;
//     }
 
//     protected function write($message) {        

//        echo "文件消息+{$message}\n";
//     }
//  }


//  function getChainOfLoggers(){

//       $errorLogger = new ErrorLogger(AbstractLogger::ERROR);
//       $fileLogger  = new FileLogger(AbstractLogger::DEBUG);
//       $consoleLogger = new ConsoleLogger(AbstractLogger::INFO);

//       $errorLogger->setNextLogger($fileLogger);
//       $fileLogger->setNextLogger($consoleLogger);
  
//       return $errorLogger;

//  }

// //-----开始测试-----

// $loggerChain = getChainOfLoggers();

// //$loggerChain->logMessage(AbstractLogger::INFO,"这是一条普通消息");
// $loggerChain->logMessage(AbstractLogger::DEBUG,"这是一条debug消息");
// //$loggerChain->logMessage(AbstractLogger::ERROR,"这是一条错误消息");