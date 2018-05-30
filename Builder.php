<?php 

// 角色：
// Builder：抽象构造者类，为创建一个Product对象的各个部件指定抽象接口。
// ConcreteBuilder：具体构造者类，实现Builder的接口以构造和装配该产品的各个部件。定义并明确它所创建的表示。提供一个检索产品的接口
// Director：指挥者，构造一个使用Builder接口的对象。
// Product：表示被构造的复杂对象。ConcreateBuilder创建该产品的内部表示并定义它的装配过程。
// 包含定义组成部件的类，包括将这些部件装配成最终产品的接口。

// 故事: 小明是个富二代，有一天他想造一辆奔驰， 造一辆宝马
// 于是小明找到他爸爸的手下的一个厂长，厂长有多年的生产经验，但是厂长是管理层，不能去干技术的活
// 于是厂长发布了一个招聘启事，招聘一个经验丰富，技术牛逼的工程师，要求如下,会造发动机，会造轮子，会造外形，年薪1000万



// 招聘启事
abstract class Builder
{
    // 定义造车者的岗位需求
  protected $car;   //汽车工程师
  abstract public function buildEngine($Engine);  //会造发动机
  abstract public function buildWheel($Wheel);   //会造轮子
  abstract public function buildShell($Shell);   //会造车子的外形
  abstract public function getResult();  //造完车，需要将车交给厂长 ,返回对象
}

// 应聘者需要有能力满足招聘的要求
class CarBuilder extends Builder
{
  function __construct($buildName)
  {
      echo "---- i am {$buildName}-----\n";
      $this->car = new Car(); // 根据汽车品牌造车
  }
  public function buildEngine($Engine){
      $this->car->setEngine($Engine); 
      echo "----{$Engine}引擎造好了----\n";
  }

  public function buildWheel($Wheel){
      $this->car->setWheel($Wheel);
      echo "----{$Wheel}轮子造好了----\n";
  }

  public function buildShell($Shell){
      $this->car->setShell($Shell);
      echo "----{$Shell}外壳造好了----\n";
  }

  public function getResult(){
    echo "----恭喜老板喜提爱车----\n";

      return $this->car; //造好车，提车
     
      }

}

//产品需求

class Car
{
  
  protected $Engine;
  protected $Wheel;
  protected $Shell;

  public function setEngine($str){
      $this->Engine = $str;
  }

  public function setWheel($str){
      $this->Wheel = $str;
  }

  public function setShell($str){
      $this->Shell = $str;
  }

  public function show()
  {
      echo "这辆定制车由：".$this->Engine.'引擎,'.$this->Wheel.'轮子,和'.$this->Shell.'外壳组成'."\n";
  }

}
// 导演 -----厂长
class Director
{
  public $myBuilder;

  public function startBuild($carName)
  {
      $this->myBuilder->buildEngine($carName);
      $this->myBuilder->buildWheel($carName);
      $this->myBuilder->buildShell($carName);
      return $this->myBuilder->getResult();
  }

  public function setBuilder(Builder $builder)
  {
      $this->myBuilder = $builder;
  }
}

$carBuilder = new CarBuilder('小红'); //雇人, 有人了，厂长才能指挥他干活
$director = new Director(); // 厂长
$director->setBuilder($carBuilder); //厂长任命小红为造车负责人
$newCar = $director->startBuild('宝马'); //宝马
$newCar->show();

echo "\n\n";
//有一天小明又想造辆定制的奔驰
$newCar = $director->startBuild('奔驰'); //宝马
$newCar->show();
