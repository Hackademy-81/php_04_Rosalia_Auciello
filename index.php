<?php
// esercizio1
class Computer{
    public $RAM; 
    public $ROM; 
    public $cardVideo; 
    public $CPU; 
    public function __construct(RAM $RAM, ROM $ROM, CardVideo $cardVideo, CPU $CPU){
        $this->RAM = $RAM;
        $this->ROM = $ROM; 
        $this->cardVideo = $cardVideo;
        $this->CPU = $CPU; 
    }

    public function presentation(){
        return $this->RAM->presentation1().$this->ROM->presentation2().$this->cardVideo->presentation3().$this->CPU->presentation4(); 
    }

}

class RAM{
    public $gb;
    public function __construct($gb){
        $this->gb= $gb; 
    }
    public function presentation1 (){
        return "Sono la memoria del computer e valgo"." ".$this->gb."gb\n";
    }
}

class ROM {
    public function presentation2 (){
        return "Sono progettato per conservare i dati in maniera permanente\n";
    }
}

class CardVideo {
    public function presentation3(){
        return "Sono progettato per mostrare i miei contenuti\n"; 
    }
}

class CPU {
    public function presentation4(){
        return "Sono il cuore operativo del computer\n"; 
    }
}

$ram= new RAM(4); 
$rom= new ROM(); 
$cardVideo= new CardVideo(); 
$cpu= new CPU(); 

$computer= new Computer($ram, $rom, $cardVideo, $cpu); 
// echo $ram->presentation1(); 

 

// echo $computer->presentation(); 

// esercizio2
// abstract class Army{
//     public $numberComponents; 
//     public $weapon;
//     public $field; 
    
//     public function __construct($numberComponents, $weapon, $field) {
//         $this->numberComponents= $numberComponents;
//         $this->weapon= $weapon; 
//         $this->field= $field; 

//     }

//     abstract function fight(); 

// }

// class Attack extends Army{
//     public $name; 
//     public function __construct($numberComponents, $weapon, $field, $name){
//         parent::__construct($numberComponents, $weapon, $field); 
//         $this->name= $name; 

//     }

//     public function fight(){
//         return $this->name." "."combatte per attaccare con l'arma"." ".$this->weapon." "."nel luogo di combattimento"." ".$this->field." "."ed è costituita da"." ".$this->numberComponents."componenti\n"; 
//     }

//     public function fanteria(){
//         return $this->name." "."combatte correndo\n"; 
//     }
//     public function cavalleria(){
//         return $this->name." "."combatte correndo sui cavalli\n"; 
//     }
//     public function arcieri(){
//         return $this->name." "."combatte lanciando le frecce\n"; 
//     }
//     public function catapulte(){
//         return $this->name." "."servono per distruggere le difese nemiche\n"; 
//     }

// }
// class Difesa extends Army{
//     public $name; 
//     public function __construct($numberComponents, $weapon, $field, $name){
//         parent::__construct($numberComponents, $weapon, $field); 
//         $this->name= $name; 

//     }

//     public function fight(){
//         return $this->name." "."difende con i"." ".$this->weapon." "."nel luogo di combattimento"." ".$this->field." "."ed è costituita da"." ".$this->numberComponents."componenti\n"; 
//     }

//     public function fossato(){
//         return $this->name." "."serve per nascondersi\n"; 
//     }
//     public function fortezza(){
//         return $this->name." "."serve per difendersi dai nemici\n"; 
//     }
//     public function mura(){
//         return $this->name." "."serve per fifendersi dai nemici con le mura\n"; 
//     }

// }

// $attacco1= new Attack(30, "lance", "campo", "fanteria"); 
// echo $attacco1-> fight(); 
// echo $attacco1->fanteria(); 

// $difesa1= new Difesa(30, "fossi", "campo", "fossato"); 
// echo $difesa1->fight(); 
// echo $difesa1->fossato(); 


abstract class Attack {
    abstract public function attacca(); 
}

class Fanteria extends Attack{
    public $name; 
    public function __construct($name){
        $this->name=$name;  
    }
    public function attacca(){
        return $this->name."attacca correndo con le lance\n";
    }
}

class Cavalleria extends Attack{
    public $name; 
    public function __construct($name){
        $this->name=$name; 
    }
    public function attacca(){
        return $this->name."attacca correndo con i cavalli\n";
    }
}

class Arcieri extends Attack{
    public $name; 
    public function __construct($name){
        $this->name=$name; 
    }
    public function attacca(){
        return $this->name."attacca lanciando le frecce\n"; 
    }
}

abstract class Defense{
    abstract public function difendi(); 
}

class Fossato extends Defense{
  public $name; 
  public function __construct($name){
    $this->name= $name; 
  }
  public function difendi(){
    return $this->name."serve per tenere alla larga i nemici\n"; 
  }
}

class Fortezza extends Defense{
    public $name; 
    public function __construct($name){
      $this->name= $name; 
    }
    public function difendi(){
      return $this->name."serve per nascondersi dai nemici\n"; 
    }
  
}

class Mura extends Defense{
    public $name; 
    public function __construct($name){
      $this->name= $name; 
    }
    public function difendi(){
      return $this->name."serve per proteggersi dai bombardamenti dei nemici\n"; 
    }
  
}

// $difesa1= new Fossato("fossato"); 
// echo $difesa1->difendi(); 

class Army {
    public $fanteria; 
    public $cavalleria; 
    public $arcieri;
    public $fossato;
    public $fortezza; 
    public $mura; 
    static public $counter=0; 
// vado a valorizzare gli attributi della class Army con le variabili delle classi create precedentemente con la dipendent injection
    public function __construct(Fanteria $fanteria, Cavalleria $cavalleria, Arcieri $arcieri, Fossato $fossato, Fortezza $fortezza, Mura $mura){
        $this->fanteria= $fanteria;
        $this->cavalleria= $cavalleria;  
        $this->arcieri= $arcieri; 
        $this->fossato= $fossato; 
        $this->fortezza= $fortezza; 
        $this->mura= $mura; 
        self::countArmy(); 

    }

    public function attaccaEdifendi(){
        // avendo valorizzato gli attributi con le variabili oggetto di ogni classe posso anche accedere ai metodi della classe da cui dipende
        return $this->fanteria->attacca()."\n".$this->cavalleria->attacca()."\n".$this->arcieri->attacca()."\n".$this->fossato->difendi()."\n".$this->fortezza->difendi()."\n".$this->mura->difendi()."\n"; 
    }

    static public function countArmy(){
        return self::$counter++; 
    }

    

}

$fanteria= new Fanteria("fanteria"); 
$cavalleria= new Cavalleria("cavalleria"); 
$arcieri= new Arcieri("arcieri"); 
$fossato= new Fossato("fossato"); 
$fortezza= new Fortezza("fortezza"); 
$mura= new Mura("mura"); 

$esercito= new Army($fanteria, $cavalleria, $arcieri, $fossato, $fortezza, $mura); 
echo $esercito->attaccaEdifendi(); 

echo Army::$counter; 



  


