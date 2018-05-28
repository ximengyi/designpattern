<?php

// 解释器模式
// 解释器模式（Interpreter Pattern）提供了评估语言的语法或表达式的方式，它属于行为型模式。
// 这种模式实现了一个表达式接口，该接口解释一个特定的上下文。这种模式被用在 SQL 解析、符号处理引擎等。
// 1、可以将一个需要解释执行的语言中的句子表示为一个抽象语法树。
// 2、一些重复出现的问题可以用一种简单的语言来进行表达。
// 3、一个简单语法需要解释的场景。

//解释器接口
 interface Expression {

    public function interpret($context);

 }

 //具体的解释器
class TerminalExpression implements Expression {
    
  private  $data;
 
  public function __construct($data)
  {
      $this->data = $data;
  }
    public function interpret( $context) {
       if(strpos($context, $this->data)!==false){
         // echo "true\n";
          return true;
       }else{
       //  echo "false\n";
         return false;
       }
    
    }
 }

class OrExpression implements Expression {
     
    private  $expr1 = null;
    private  $expr2 = null;
 
public function __construct(Expression $expr1, Expression $expr2)
 {
    $this->expr1 = $expr1;
    $this->expr2 = $expr2;
 }

    public function interpret($context) {        
       return $this->expr1->interpret($context) || $this->expr2->interpret($context);
    }

 }

class AndExpression implements Expression {
     
    private  $expr1 = null;
    private  $expr2 = null;
 
    public function __construct(Expression $expr1, Expression $expr2)
    {
        $this->expr1 = $expr1;
        $this->expr2 = $expr2;
    }

    public function interpret($context) {        
       return $this->expr1->interpret($context) && $this->expr2->interpret($context);
    }
 }

//规则：robert和john是男性
 function  getMaleExpression()
 {
    $robert = new TerminalExpression("Robert");
    $john = new TerminalExpression("John");
    return new OrExpression($robert, $john);     
 }
 
 // 朱莉是一个已婚的女性

  function getMarriedWomanExpression(){
    $julie = new TerminalExpression("Julie");
    $married = new TerminalExpression("Married");
    return new AndExpression($julie, $married);        
 }

 //---------------------开始测试-----------------------

  $isMale = getMaleExpression();
  $isMarriedWoman = getMarriedWomanExpression();

  echo "John 是 男人吗？\n";
  $isMale->interpret('John');
  echo "Julie是一个已婚的女性吗?\n";
  $isMarriedWoman->interpret('Julie');

