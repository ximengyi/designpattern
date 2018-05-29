<?php
// 在空对象模式（Null Object Pattern）中，一个空对象取代 NULL 对象实例的检查。Null 对象不是检查空值，而是反应一个不做任何动作的关系。
// 这样的 Null 对象也可以在数据不可用的时候提供默认的行为。

// 在空对象模式中，我们创建一个指定各种要执行的操作的抽象类和扩展该类的实体类，
// 还创建一个未对该类做任何实现的空对象类，该空对象类将无缝地使用在需要检查空值的地方

abstract class AbstractCustomer {
    protected  $name;
    public abstract function isNil();
    public abstract function getName();
 }

class RealCustomer extends AbstractCustomer {

   public function __construct($name)
{       
    $this->name = $name;
}
    public function getName() {
       return $this->name;
    }

    public function isNil() {
       return false;
    }
 }


class NullCustomer extends AbstractCustomer {

    public function getName() {
       return "没有数据列表里找到该顾客";
    }
 
    public function isNil() {
       return true;
    }
 }

 //从工厂里提货，如果工厂里有货则提货（对象），如果无该对象则返回一个空对象
class CustomerFactory {
    
    public static  $names = ["Rob", "Joe", "Julie"];
 
    public static function getCustomer($name){
     foreach(self::$names as $i){

       if(strcasecmp($i,$name)==0){
        return new RealCustomer($name);
       }

     }
     return new NullCustomer();
    }
 }


 //-------------------------------开始测试

$customer1 = CustomerFactory::getCustomer("Rob");
$customer2 = CustomerFactory::getCustomer("Bob");
$customer3 = CustomerFactory::getCustomer("Julie");
$customer4 = CustomerFactory::getCustomer("Laura");

echo "---------展示customers 顾客----------\n\n";

echo "{$customer1->getName()}\n";
echo "{$customer2->getName()}\n";
echo "{$customer3->getName()}\n";
echo "{$customer4->getName()}\n";


