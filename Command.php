<?php


// 命令模式（Command Pattern）是一种数据驱动的设计模式，它属于行为型模式。请求以命令的形式包裹在对象中，并传给调用对象。
// 调用对象寻找可以处理该命令的合适的对象，并把该命令传给相应的对象，该对象执行命令。

 interface Order {
    function execute();
 }


 class Stock {
    
    private  $name = "ABC";
    private  $quantity = 10;
 
    public function buy(){

          echo "Stock [ 名称: +{$this->name}+ 数量:  + {$this->quantity} + ] bought\n";

    }
    public function sell(){

           echo "Stock [ 名称: +{$this->name}+  数量:  + {$this->quantity} + ] sold\n";
     
    }
 }


class BuyStock implements Order {
    private  $abcStock;
 
    public function __construct(Stock $abcStock){

       $this->abcStock = $abcStock;

    }
 
    public function execute() {

        $this->abcStock->buy();

    }
 }

 class SellStock implements Order {
    private  $abcStock;
 
    public function __construct(Stock $abcStock){

       $this->abcStock = $abcStock;

    }
 
    public function execute() {

        $this->abcStock->sell();

    }

 }
//命令执行管理者
 class Broker{
     public  $orderArray = [];

     //将命令拿进来
     public function takeOrder(Order $order){
        array_push($this->orderArray,$order);

     }
   //一条一条执行命令
     public function placeOrders(){
      foreach($this->orderArray as $value){
          $value->execute();

      }
        //执行完命令队列清空
         $this->orderArray = [];
     }

 }

 //创建一条袜子
$abcstock = new Stock();

//创建买袜子命令和卖袜子命令
$buyStockOrder = new BuyStock($abcstock);
$sellStockOrder = new SellStock($abcstock);

//创建命令执行管理者
$broker = new Broker();
$broker->takeOrder($buyStockOrder);
$broker->takeOrder($sellStockOrder); 

$broker->placeOrders();