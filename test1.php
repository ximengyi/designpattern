<?php

class test{
    public $name;
    public function __construct($name)
    {
        $this->name = $name;
    }
}

$test1 = new test("张三");
$test2 = new test("李四");
$test3 = new test("王二");
$arr = [$test1,$test2,$test3];
$key =array_search($test3,$arr);

var_dump($arr);
unset($arr[$key]);
var_dump($arr); 


