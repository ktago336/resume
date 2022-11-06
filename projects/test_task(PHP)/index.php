<!DOCTYPE html>
<html>
<body>

<?php

class Bacteria {
    private $nOfReds=1;
    private $nOfGreens=1;
    private $nOfTicks=1;
    public function setnOfTicks($n){
        $this->nOfTicks=$n;
    }
    public function setnOfGreens($n){
        $this->nOfGreens=$n;
    
    }
    public function setnOfReds($n){
        $this->nOfReds=$n;
    }
    public function getnOfBacteria(){
        while ($this->nOfTicks>0){
            $bufReds=$bufGreens=0;
            $this->nOfTicks--;
            $bufReds=$this->nOfGreens*4+$this->nOfReds*5;
            
            $bufGreens=$this->nOfGreens*3+$this->nOfReds*7;
            $this->nOfGreens=$bufGreens;
            $this->nOfReds=$bufReds;
            
            
        }
        
        return $this->nOfGreens+$this->nOfReds;
    }

}

?>

<form action='index.php' method='post'>
        <p>
            Введите имя:
        </p>
        <input type='text' name='name' required>
        <p>
            Введите номер телефона:
        </p>
        <input type='text' name='number' required>
        <p>
            Введите адрес электронной почты:
        </p>
        <input type='email' name='email' required>
        <p>
            Введите число тиков:
        </p>
        <input type='text' name='ticks' required/>
        <input type='submit' />
</form>

<?php
//validation
if (isset($_POST['name'])&&isset($_POST['number'])&&isset($_POST['email'])&&isset($_POST['ticks'])){
    $name=$_POST['name'];
    $number=$_POST['number'];
    $email=$_POST['email'];
    $ticks=$_POST['ticks'];
    if (
        (preg_match("/^[а-я А-Я]+$/u",$name)||
        preg_match("/^[a-z A-Z]+$/i",$name))
        &&preg_match("/^[0-9+-]+$/",$number)
        &&is_numeric($ticks))
        {
        $ticks=intval($ticks);
        $bacteria=new Bacteria;
        $bacteria->setnOfTicks($ticks);
        //below choose start count of reds and greens
        $bacteria->setnOfGreens(1);
        $bacteria->setnOfReds(1);
        echo "\nИтого число бактерий: ".$bacteria->getnOfBacteria();
        
    }
    else echo "\nInput error occured";
    
}else echo "\nComplete form above\n";

?>
</body>
</html>
