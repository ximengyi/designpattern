<?php

interface Image 
{
   function display();
}

class RealImage implements Image
{
    private $fileName;

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
        $this->loadFromDisk($fileName);
    }

    public function display()
    {
        echo "正在展示--->{$this->fileName}";
    }

    public function loadFromDisk($fileName)
    {
      echo "正在加载硬盘--->{$this->fileName}";
    }

}


class ProxyImage implements Image{
   private $realImage;
   private $fileName;

   public function __construct($fileName)
   {
      $this->fileName = $fileName; 
   }

   public function display(){
       if($this->realImage == null){
           $this->realImage = new RealImage($this->fileName);
       }
        $this->realImage->display();
   }
}

$image = new ProxyImage('王菲.jpg');
$image->display();
echo " \n\n";
$image->display();

