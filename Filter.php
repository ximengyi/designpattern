<?php

//过滤接口
interface Criteria {
   public  function meetCriteria($persions);
}

//人类
class Person {
    
    private $name;
    private $gender;
    private $maritalStatus;
 
    public function __construct($name,$gender,$maritalStatus)
    {
        $this->name = $name;
        $this->gender = $gender;
        $this->maritalStatus = $maritalStatus;
    }
 
    public function getName() {
       return $this->name;
    }
    public function getGender() {
       return $this->gender;;
    }
    public function getMaritalStatus() {
       return  $this->maritalStatus;
    }    
 }

 //男人的标准
  class CriteriaMale implements Criteria {
    
    public function meetCriteria($persons) {
    $malePersons =[] ; 
    foreach ($persons as  $value) {
        if(strcasecmp($value->getGender(), "MALE") == 0)
        {
            array_push($malePersons,$value);
        }
        
       }
       return $malePersons;
    }

  }

  
 //女人的标准
 class CriteriaFemale implements Criteria {
    
    public function meetCriteria($persons) {
    $femalePersons =[] ; 
    foreach ($persons as  $value) {
        if(strcasecmp($value->getGender(), "FEMALE") == 0)
        {
            array_push($femalePersons,$value);
        }
        
       }
       return $femalePersons;
    }

  }

   //单身狗的标准
 class CriteriaSingle implements Criteria {
    
    public function meetCriteria($persons) {
    $singlePersons =[] ; 
    foreach ($persons as  $value) {
        if(strcasecmp($value->getMaritalStatus(), "SINGLE") == 0)
        {
            array_push($singlePersons,$value);
        }
        
       }
       return $singlePersons;
    }

  }

  //连续过滤两次的规则标准
class AndCriteria implements Criteria {

   private  $criteria;
   private  $otherCriteria;
                             
   public function __construct(Criteria $criteria, Criteria $otherCriteria)
   {
       $this->criteria = $criteria;
       $this->otherCriteria = $otherCriteria;
   }

  
   public function meetCriteria( $persons) {
      $firstCriteriaPersons = $this->criteria->meetCriteria($persons);        
      return $this->otherCriteria->meetCriteria($firstCriteriaPersons);
   }
}


function printPerson($persons)
{
    foreach($persons as $value)
    {
        echo "姓名：{$value->getName()}----性别:{$value->getGender()}----是否恋爱:{$value->getMaritalStatus()}\n";
    }

}
//--------------------------开始测试-------------------------
//创建人
$persons =[];
array_push($persons,new person("Robert","Male", "Single"));
array_push($persons,new person("John","Male", "Married"));
array_push($persons,new person("Laura","Female", "Married"));
array_push($persons,new person("Diana","Female", "Single"));
array_push($persons,new person("Mike","Male", "Single"));
array_push($persons,new person("Bobby","Male", "Single"));

//创建过滤标准
$male = new CriteriaMale();
$female = new CriteriaFemale();
$single = new CriteriaSingle();
$singleMale = new AndCriteria($single,$male);

//过滤男人
echo "Males: \n";
$result = $male->meetCriteria($persons);
printPerson($result);

//过滤女人
echo "FeMales: \n";
$result = $female->meetCriteria($persons);
printPerson($result);

//过滤单身狗
echo "Singles: \n";
$result = $single->meetCriteria($persons);
printPerson($result);

//过滤单身男人
echo "SingleMale: \n";
$result = $singleMale->meetCriteria($persons);
printPerson($result);






