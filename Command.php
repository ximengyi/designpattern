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

 class Broker{
     public  $orderArray = [];

     public function takeOrder(Order $order){
        array_push($this->orderArray,$order);

     }
  
     public function placeOrders(){
      foreach($this->orderArray as $value){
          $value->execute();

      }

         $this->orderArray = [];
     }

 }

$abcstock = new Stock();

$buyStockOrder = new BuyStock($abcstock);
$sellStockOrder = new SellStock($abcstock);

$broker = new Broker();
$broker->takeOrder($buyStockOrder);
$broker->takeOrder($sellStockOrder); 

$broker->placeOrders();