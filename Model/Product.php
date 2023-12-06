<?php 

class Product 
{
  protected float $price;
  private float $discount;
  protected int $quantity;

  public function __construct($price,$quantity)
  {
    $this->price = $price;
    $this->quantity = $quantity;
  }

  // public function setDiscount($perc)
  // {
  //   if($perc < 5 || $perc > 90){
  //     throw new Exception("Yuor percentage is out of range");
  //   } else {  
  //     $this->discount = $perc;
  //   }
  // }

  // public function getDiscount()
  // {
  //   return $this->discount;
  // }

}

?>