<?php

// 组合模式（Composite Pattern），又叫部分整体模式，是用于把一组相似的对象当作一个单一的对象。
// 组合模式依据树形结构来组合对象，用来表示部分以及整体层次。这种类型的设计模式属于结构型模式，它创建了对象组的树形结构。
// 这种模式创建了一个包含自己对象组的类。该类提供了修改相同对象组的方式。

class Employee {

    private $name;
    private $dept;
    private $salary;
    private $subordinates=[];
 
    //构造函数

   public function __construct($name, $dept, $sal)
   {
       $this->name = $name;
       $this->dept = $dept;
       $this->salary = $sal;

   }

    public function add(Employee $Employee) {
       array_push($this->subordinates,$Employee);
    }
 
    public function remove(Employee $Employee) {

       $key =array_search($Employee,$this->subordinates);
       unset($this->subordinates[$key]);
    }
 
    public function getSubordinates(){
      return $this->subordinates;
    }
 
    public function toString(){
       echo "员工 :[ 姓名 : ". "{$this->name}"  .", 部门 : " . "{$this->dept}" . ", 工资 :". "{$this->salary}"." ]\n";

      foreach($this->getSubordinates() as $value)
      {
        $value->toString(); 
      }

    }   
 }

  //初始化员工

 function initEmploy(){
     $CEO = new Employee("John","CEO", 30000);

     $headSales = new Employee("Robert","Head Sales", 20000); //销售总裁

    $headMarketing = new Employee("Michel","Head Marketing", 20000); //市场总监

    $clerk1 = new Employee("Laura","Marketing", 10000); // 员工1
    $clerk2 = new Employee("Bob","Marketing", 10000);   //员工2

    $salesExecutive1 = new Employee("Richard","Sales", 10000); //销售专员
    $salesExecutive2 = new Employee("Rob","Sales", 10000);   //销售专员

    $CEO->add($headSales);
    $CEO->add($headMarketing);

    $headSales->add($salesExecutive1);
    $headSales->add($salesExecutive2);

    $headMarketing->add($clerk1);
    $headMarketing->add($clerk2);
   return $CEO;
 }

 //------------开始测试---------------
 
 $CEO =initEmploy();

 //查看该对象的所有结构
 //var_dump($CEO);


//打印公司所有成员
$CEO->toString();
