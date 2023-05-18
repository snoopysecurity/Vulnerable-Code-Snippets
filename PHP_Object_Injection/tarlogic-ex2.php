<?php
// Exercise - 2
// Author: @TheXC3LL
// Website: Tarlogic.com
// Modificado de: https://syssec.rub.de/media/emma/veroeffentlichungen/2014/09/10/POPChainGeneration-CCS14.pdf
class File {
  public function flag() {
    $this->innocent();
  }
  public function innocent() {
    echo "Aquí no pasa nada :D\n";
  }
}
class GiveFlag extends File {
  public $offset = 23;
  public function innocent() {
    $stuff = fopen("flag.txt", "r");
    fseek($stuff, $this->offset);
    print fread($stuff, filesize("flag.txt"));
  }
}
class entry {
  public function __destruct(){
    $this->awesome->flag();
  }
}
unserialize($argv[1]);
?>
